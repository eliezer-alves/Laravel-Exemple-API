<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AtividadeComercialController,
    CosifController,
    EmpresaController,
    PorteEmpresaController,
    TipoEmpresaController,
    UserController,
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
| User
|--------------------------------------------------------------------------
*/
Route::post('user/', [UserController::class, 'store']);

Route::group([

    // 'middleware' => ['auth:api'],
    'middleware' => ['client'],
    'prefix' => 'user',

], function () {

    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id_user}', [UserController::class, 'show'])
        ->where(['id_user' => '[0-9]+']);

    Route::put('/{id_user}', [UserController::class, 'update'])
        ->where(['id_user' => '[0-9]+']);

    Route::delete('/{id_user}', [UserController::class, 'destroy'])
        ->where(['id_user' => '[0-9]+']);

});


/*
|--------------------------------------------------------------------------
| Atividade Comercial
|--------------------------------------------------------------------------
*/
Route::group([

    // 'middleware' => ['auth:api'],
    'middleware' => ['client'],
    'prefix' => 'atividade-comercial',

], function () {

    Route::get('/', [AtividadeComercialController::class, 'index']);
    Route::post('/', [AtividadeComercialController::class, 'store']);
    Route::get('/{id_atividade_comercial}', [AtividadeComercialController::class, 'show'])
        ->where(['id_atividade_comercial' => '[0-9]+']);
        
    Route::put('/{id_atividade_comercial}', [AtividadeComercialController::class, 'update'])
        ->where(['id_atividade_comercial' => '[0-9]+']);

    Route::delete('/{id_atividade_comercial}', [AtividadeComercialController::class, 'destroy'])
        ->where(['id_atividade_comercial' => '[0-9]+']);

});



/*
|--------------------------------------------------------------------------
| Cosif
|--------------------------------------------------------------------------
*/
Route::group([

    // 'middleware' => ['auth:api'],
    'middleware' => ['client'],
    'prefix' => 'cosif',

], function () {

    Route::get('/', [CosifController::class, '__invoke']);
        
    Route::get('/', [CosifController::class, 'index']);
    Route::post('/', [CosifController::class, 'store']);
    Route::get('/{id_cosif}', [CosifController::class, 'show'])
        ->where(['id_cosif' => '[0-9]+']);

    Route::put('/{id_cosif}', [CosifController::class, 'update'])
        ->where(['id_cosif' => '[0-9]+']);

    Route::delete('/{id_cosif}', [CosifController::class, 'destroy'])
        ->where(['id_cosif' => '[0-9]+']);

});



/*
|--------------------------------------------------------------------------
| Tipo Empresa
|--------------------------------------------------------------------------
*/
Route::group([

    // 'middleware' => ['auth:api'],
    'middleware' => ['client'],
    'prefix' => 'tipo-empresa',

], function () {

    Route::get('/', [TipoEmpresaController::class, 'index']);
    Route::post('/', [TipoEmpresaController::class, 'store']);
    Route::get('/{id_tipo_empresa}', [TipoEmpresaController::class, 'show'])
        ->where(['id_tipo_empresa' => '[0-9]+']);

    Route::put('/{id_tipo_empresa}', [TipoEmpresaController::class, 'update'])
        ->where(['id_tipo_empresa' => '[0-9]+']);

    Route::delete('/{id_tipo_empresa}', [TipoEmpresaController::class, 'destroy'])
        ->where(['id_tipo_empresa' => '[0-9]+']);

});


/*
|--------------------------------------------------------------------------
| Porte Empresa
|--------------------------------------------------------------------------
*/
Route::group([

    // 'middleware' => ['auth:api'],
    'middleware' => ['client'],
    'prefix' => 'porte-empresa',

], function () {

    Route::get('/', [PorteEmpresaController::class, 'index']);
    Route::post('/', [PorteEmpresaController::class, 'store']);
    Route::get('/{id_porte_empresa}', [PorteEmpresaController::class, 'show'])
        ->where(['id_porte_empresa' => '[0-9]+']);

    Route::put('/{id_porte_empresa}', [PorteEmpresaController::class, 'update'])
        ->where(['id_porte_empresa' => '[0-9]+']);

    Route::delete('/{id_porte_empresa}', [PorteEmpresaController::class, 'destroy'])
        ->where(['id_porte_empresa' => '[0-9]+']);

});

/*
|--------------------------------------------------------------------------
| Empresa
|--------------------------------------------------------------------------
*/

Route::group([

    // 'middleware' => ['auth:api'],
    'middleware' => ['client'],
    'prefix' => 'empresa',

], function () {

    Route::get('/', [EmpresaController::class, 'index']);
    Route::post('/', [EmpresaController::class, 'store']);
    Route::get('/{id_empresa}', [EmpresaController::class, 'show'])
        ->where(['id_empresa' => '[0-9]+']);

    Route::put('/{id_empresa}', [EmpresaController::class, 'update'])
        ->where(['id_empresa' => '[0-9]+']);

    Route::delete('/{id_empresa}', [EmpresaController::class, 'destroy'])
        ->where(['id_empresa' => '[0-9]+']);

});

Route::middleware('auth:api')->get('/cliente-busca/{cnpj}', [EmpresaController::class, 'findByCnpj'])->where(['cnpj' => '[0-9]+']);


