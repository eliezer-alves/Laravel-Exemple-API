<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SolicitacaoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Cliente')->group(function(){

	Route::get('/login', [LoginController::class, 'index']);

	Route::get('/', [HomeController::class, 'index']);

	Route::get('/solicitar', [SolicitacaoController::class, 'index']);

});