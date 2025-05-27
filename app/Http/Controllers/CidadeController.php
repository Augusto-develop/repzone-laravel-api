<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cidade\FilterRequest;
use App\Http\Requests\Cidade\StoreRequest;
use App\Models\Cidade;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $cidades = Cidade::query();

        if ($request->filled('estado')) {
            $cidades->where('estado', $request->estado);
        }

        if ($request->filled('nome')) {
            $cidades->where('nome', 'like', '%' . $request->nome . '%');
        }

        return $cidades->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $cidade = Cidade::create($request->all());

        return response()->json($cidade, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cidade = Cidade::findOrFail($id);
        return response()->json($cidade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $cidade = Cidade::findOrFail($id);

        $cidade->update($request->validated());

        return response()->json($cidade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $cidade = Cidade::findOrFail($id);
        // $cidade->delete();
        // return response()->noContent();

        try {
            $cidade = Cidade::findOrFail($id);
            $cidade->delete();

            return response()->json(['message' => 'Cidade excluída com sucesso']);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return response()->json([
                    'message' => 'Não é possível excluir esta cidade porque ela está vinculada a um ou mais clientes.'
                ], 409);
            }

            return response()->json(['message' => 'Erro ao excluir cidade.'], 500);
        }
    }

    public function cidadesByUf(string $uf)
    {
        $cidades = Cidade::where('estado', strtoupper($uf))
            ->orderBy('nome')
            ->get(['id', 'nome']);

        return response()->json($cidades);
    }
}
