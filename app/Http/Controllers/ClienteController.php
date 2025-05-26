<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\Cliente\FilterRequest;
use App\Http\Requests\Cliente\StoreRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $clientes = Cliente::query();

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
            $clientes->where('estado', $request->estado);
        }

        if ($request->filled('cidade')) {            
            $clientes->where('cidade', 'like', '%' . $request->cidade . '%');
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
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->update($request->validated());

        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente->delete();
        return response()->noContent();
    }
}
