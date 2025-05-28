<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cliente\FilterRequest;
use App\Http\Requests\Cliente\StoreRequest;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $clientes = Cliente::with('cidade');

        if ($request->filled('cpf')) {
            $clientes->where('cpf', 'like', '%' . $request->cpf . '%');
        }

        if ($request->filled('nome')) {
            $clientes->where('nome', 'like', '%' . $request->nome . '%');
        }

        if ($request->filled('datanasc')) {
            $clientes->whereDate('datanasc', $request->datanasc);
        }

        if ($request->filled('sexo')) {
            $clientes->where('sexo', $request->sexo);
        }

        if ($request->filled('estado')) {
            // Filtro pelo estado da tabela `cidades`
            $clientes->whereHas('cidade', function ($query) use ($request) {
                $query->where('estado', $request->estado);
            });
        }

        if ($request->filled('cidade')) {
            $clientes->where('cidade_id', $request->cidade);
        }

        return $clientes->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $cliente = Cliente::create($request->all());

        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->update($request->validated());

        $cliente->load('cidade');

        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->noContent();
    }
}
