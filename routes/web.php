<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ModeloSicredController;
use App\Http\Controllers\ClientSicredController;
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

Route::middleware(['auth'])->prefix('admin/')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::namespace('modelo-sicred')->group(function () {
        Route::get('/modelo-sicred', [ModeloSicredController::class, 'index'])->name('admin.modelo-sicred');
        Route::post('/modelo-sicred', [ModeloSicredController::class, 'store'])->name('admin.modelo-sicred.store');
        Route::post('/modelo-sicred/{id}', [ModeloSicredController::class, 'update'])->name('admin.modelo-sicred.update');
        Route::get('/modelo-sicred/{id}', [ModeloSicredController::class, 'destroy'])->name('admin.modelo-sicred.destroy');
    });

    Route::get('/client-sicred', [ClientSicredController::class, 'index'])->name('admin.client-sicred');
});

Route::get('/solicitacao', function () {
    return view('solicitacao.index');
});

Route::get('app/{any?}', [AppController::class, 'index'])->where('any', '.*');

require __DIR__ . '/auth.php';
