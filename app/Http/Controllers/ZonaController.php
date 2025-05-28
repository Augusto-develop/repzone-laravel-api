<?php

namespace App\Http\Controllers;

use App\Http\Requests\Zona\StoreRequest;
use App\Models\Representante;
use App\Models\Zona;
use App\Models\Cliente;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getByCidade(String $cidadeId)
    {
        $representantes = Representante::whereHas('cidades', function ($query) use ($cidadeId) {
            $query->where('cidades.id', $cidadeId);
        })
            ->with(['cidades' => function ($query) use ($cidadeId) {
                $query->where('cidades.id', $cidadeId)
                    ->select('id', 'nome', 'estado');
            }])
            ->get()
            ->map(function ($representante) {
                $cidade = $representante->cidades->first();

                return [
                    'representante' => [
                        'id' => $representante->id,
                        'nome' => $representante->nome,
                    ],
                    'cidade' => [
                        'id' => optional($cidade)->id,
                        'nome' => optional($cidade)->nome,
                        'estado' => optional($cidade)->estado,
                    ],
                ];
            });

        return response()->json($representantes);
    }

    public function getByCliente(String $clienteId)
    {
        $cliente = Cliente::with('cidade')->findOrFail($clienteId);

        if (!$cliente->cidade) {
            return response()->json([], 200); // Ou um erro, se preferir
        }

        $cidadeId = $cliente->cidade->id;

        $representantes = Representante::whereHas('cidades', function ($query) use ($cidadeId) {
            $query->where('cidades.id', $cidadeId);
        })
            ->select('id', 'nome')
            ->get();

        return response()->json($representantes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $zona = Zona::create($request->validated());
        return response()->json($zona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $representante = Representante::findOrFail($id);
        return $representante;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $representante = Representante::findOrFail($id);

        $representante->update($request->validated());

        return response()->json($representante);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cidadeId, $representanteId)
    {
        $deleted = Zona::where('cidade_id', $cidadeId)
            ->where('representante_id', $representanteId)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Zona deletada com sucesso']);
        } else {
            return response()->json(['message' => 'Zona não encontrada'], 404);
        }
    }
}
