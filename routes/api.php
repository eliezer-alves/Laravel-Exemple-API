<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RamoAtividadeController;

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


Route::namespace('cliente')->group(function(){
 	Route::get('/cliente', [ClienteController::class, 'index']);
 	Route::post('/cliente', [ClienteController::class, 'store']);
});


Route::get('/ramo_atividade', [RamoAtividadeController::class, 'index']);

