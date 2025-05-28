<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\ZonaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::apiResource('clientes', ClienteController::class);

        Route::get('/cidades/estado/{uf}', [CidadeController::class, 'cidadesByUf']);
        Route::apiResource('cidades', CidadeController::class);

        Route::get('/zonas/cidade/{cidadeId}', [ZonaController::class, 'getByCidade']);
        Route::get('/zonas/cliente/{clienteId}', [ZonaController::class, 'getByCliente']);
        Route::post('/zonas', [ZonaController::class, 'store']);
        Route::delete('/zonas/{cidadeId}/{representanteId}', [ZonaController::class, 'destroy']);

        Route::apiResource('representantes', RepresentanteController::class);
    });
});
