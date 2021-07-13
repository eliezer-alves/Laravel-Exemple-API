<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AtividadeComercialController,
    ClienteController,
    CosifController,
    PorteEmpresaController,
    TipoEmpresaController,
};

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

/*
|--------------------------------------------------------------------------
| Atividade Comercial
|--------------------------------------------------------------------------
*/
Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'atividade-comercial',

], function () {

    Route::get('/', [AtividadeComercialController::class, 'index']);
    Route::get('/{id_atividade_comercial}', [AtividadeComercialController::class, 'show']);
    Route::post('/', [AtividadeComercialController::class, 'store']);
    Route::put('/{id_atividade_comercial}', [AtividadeComercialController::class, 'update']);
    Route::delete('/{id_atividade_comercial}', [AtividadeComercialController::class, 'destroy']);

});



/*
|--------------------------------------------------------------------------
| Cosif
|--------------------------------------------------------------------------
*/
Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'cosif',

], function () {

    Route::get('/', [CosifController::class, '__invoke']);

});



/*
|--------------------------------------------------------------------------
| Tipo Empresa
|--------------------------------------------------------------------------
*/
Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'tipo-empresa',

], function () {

    Route::get('/', [TipoEmpresaController::class, '__invoke']);

});

/*
|--------------------------------------------------------------------------
| Cliente
|--------------------------------------------------------------------------
*/

Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'cliente',

], function () {

    Route::get('/', [ClienteController::class, 'index']);
    Route::get('/{id_cliente}', [ClienteController::class, 'show']);
    Route::put('/{id_cliente}', [ClienteController::class, 'update']);
    Route::delete('/{id_cliente}', [ClienteController::class, 'destroy']);

});

Route::post('/cliente', [ClienteController::class, 'store']);

Route::middleware('auth:api')->get('/cliente-busca/{cnpj}', [ClienteController::class, 'findByCnpj'])->where(['cnpj' => '[0-9]+']);



/*
|--------------------------------------------------------------------------
| Porte Empresa
|--------------------------------------------------------------------------
*/
Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'porte-empresa',

], function () {

    Route::get('/', [PorteEmpresaController::class, 'index']);
    Route::get('/{id_porte_empresa}', [PorteEmpresaController::class, 'show'])
        ->where(['id_porte_empresa' => '[0-9]+']);

    Route::post('/', [PorteEmpresaController::class, 'store']);
    Route::put('/{id_porte_empresa}', [PorteEmpresaController::class, 'update'])
        ->where(['id_porte_empresa' => '[0-9]+']);

    Route::delete('/{id_porte_empresa}', [PorteEmpresaController::class, 'destroy']);

});
