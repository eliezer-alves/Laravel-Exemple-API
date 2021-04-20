<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AtividadeComercialController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DominiosController;
use App\Http\Controllers\PropostaController;
use App\Http\Controllers\SimulacaoController;
use App\Http\Controllers\TesteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/cliente', [ClienteController::class, 'store']);
Route::middleware('auth:api')->namespace('cliente')->group(function () {
    Route::get('/cliente', [ClienteController::class, 'index']);
    Route::get('/cliente/{id_cliente}', [ClienteController::class, 'show']);
    Route::get('/cliente-busca/{cnpj}', [ClienteController::class, 'findByCnpj']);
    Route::put('/cliente/{id_cliente}', [ClienteController::class, 'update']);
    Route::delete('/cliente/{id_cliente}', [ClienteController::class, 'destroy']);
});

// Route::middleware('auth:api')->namespace('atividade_comercial')->group(function () {
Route::namespace('atividade_comercial')->group(function () {
    Route::get('/atividade_comercial', [AtividadeComercialController::class, 'index']);
    Route::get('/atividade_comercial/{id_atividade_comercial}', [AtividadeComercialController::class, 'show']);
    Route::middleware('auth:api')->post('/atividade_comercial', [AtividadeComercialController::class, 'store']);
    Route::middleware('auth:api')->put('/atividade_comercial/{id_atividade_comercial}', [AtividadeComercialController::class, 'update']);
    Route::middleware('auth:api')->delete('/atividade_comercial/{id_atividade_comercial}', [AtividadeComercialController::class, 'destroy']);
});

Route::middleware('auth:api')->namespace('simulacao')->group(function () {
    Route::post('/simulacao', [SimulacaoController::class, 'novaSimulacao']);
    Route::get('/simulacao/{id_simulacao}', [SimulacaoController::class, 'show']);
});

Route::middleware('auth:api')->namespace('proposta')->group(function () {
    Route::post('/proposta', [PropostaController::class, 'novaProposta']);
    Route::get('/proposta/{numero_proposta}', [PropostaController::class, 'exibeProposta']);
    Route::get('/simulacao/cliente', [PropostaController::class, 'novaProposta']);
});

Route::get('/dominios', [DominiosController::class, '__invoke']);

Route::get('/teste', [TesteController::class, 'teste']);
