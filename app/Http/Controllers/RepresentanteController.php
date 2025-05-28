<?php

namespace App\Http\Controllers;

use App\Http\Requests\Representante\FilterRequest;
use App\Http\Requests\Representante\StoreRequest;
use App\Models\Representante;

class RepresentanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $representantes = Representante::query();

        if ($request->filled('nome')) {
            $representantes->where('nome', 'like', '%' . $request->nome . '%');
        }

        return $representantes->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $representante = Representante::create([
            'nome' => $request->nome,
        ]);

        return response()->json($representante, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Representante::findOrFail($id);
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
    public function destroy(string $id)
    {
        $representante = Representante::findOrFail($id);
        $representante->delete();

        return response()->noContent();
    }
}
