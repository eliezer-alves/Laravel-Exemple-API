<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AtividadeComercialController;

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


Route::namespace('cliente')->group(function () {
	Route::middleware('auth:api')->get('/cliente', [ClienteController::class, 'index']);
	Route::middleware('auth:api')->get('/cliente/{id_cliente}', [ClienteController::class, 'show']);
	Route::post('/cliente', [ClienteController::class, 'store']);
	Route::middleware('auth:api')->put('/cliente/{id_cliente}', [ClienteController::class, 'update']);
	Route::middleware('auth:api')->delete('/cliente/{id_cliente}', [ClienteController::class, 'destroy']);
});

Route::middleware('auth:api')->namespace('atividade_comercial')->group(function () {
	Route::get('/atividade_comercial', [AtividadeComercialController::class, 'index']);
	Route::get('/atividade_comercial/{id_atividade_comercial}', [AtividadeComercialController::class, 'show']);
	Route::post('/atividade_comercial', [AtividadeComercialController::class, 'store']);
	Route::put('/atividade_comercial/{id_atividade_comercial}', [AtividadeComercialController::class, 'update']);
	Route::delete('/atividade_comercial/{id_atividade_comercial}', [AtividadeComercialController::class, 'destroy']);
});
