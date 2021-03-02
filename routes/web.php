<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ModeloSicredController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('admin')->group(function () {
    Route::get('/admin/modelo-sicred', [ModeloSicredController::class, 'index']);
});

Route::get('/solicitacao', function () {
    return view('solicitacao.index');
});

Route::get('app/{any?}', [AppController::class, 'index'])->where('any', '.*');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
