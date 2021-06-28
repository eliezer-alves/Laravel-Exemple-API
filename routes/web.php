<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AppController,
    ClientSicredController,
    ModeloSicredController,
    AssinaturaPropostaController,
    UrlSicredController
};

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

    Route::prefix('modelo-sicred')->group(function () {
        Route::get('/', [ModeloSicredController::class, 'index'])->name('admin.modelo-sicred');
        Route::post('/', [ModeloSicredController::class, 'store'])->name('admin.modelo-sicred.store');
        Route::post('/{id}', [ModeloSicredController::class, 'update'])->name('admin.modelo-sicred.update');
        Route::post('/url/{id}', [ModeloSicredController::class, 'bindUrl'])->name('admin.modelo-sicred-url.update');
        Route::get('/{id}', [ModeloSicredController::class, 'destroy'])->name('admin.modelo-sicred.destroy');
    });

    Route::prefix('client-sicred')->group(function () {
        Route::get('/', [ClientSicredController::class, 'index'])->name('admin.client-sicred');
        Route::post('/', [ClientSicredController::class, 'store'])->name('admin.client-sicred.store');
        Route::post('/{id}', [ClientSicredController::class, 'update'])->name('admin.client-sicred.update');
        Route::get('/{id}', [ClientSicredController::class, 'destroy'])->name('admin.client-sicred.destroy');
    });

    Route::prefix('url-sicred')->group(function () {
        Route::get('/', [UrlSicredController::class, 'index'])->name('admin.url-sicred');
        Route::post('/', [UrlSicredController::class, 'store'])->name('admin.url-sicred.store');
        Route::post('/{id}', [UrlSicredController::class, 'update'])->name('admin.url-sicred.update');
        Route::get('/{id}', [UrlSicredController::class, 'destroy'])->name('admin.url-sicred.destroy');
    });
});

Route::get('/solicitacao', function () {
    return view('solicitacao.index');
});

Route::prefix('assinatura')->group(function () {
    Route::get('/contrato-pj/contrato/{hash}', [AssinaturaPropostaController::class, 'showContrato'])
        ->name('assinatura.contrato-pj.show');

    Route::get('/{hash}', [AssinaturaPropostaController::class, 'showAceite1'])
        ->name('assinatura.contrato-pj-1.show');

    Route::get('/contrato-pj/aceite-1/{hash}', [AssinaturaPropostaController::class, 'aceite1'])
        ->name('assinatura.contrato-pj-1');

    Route::get('/contrato-pj/show-aceite-2/{hash}', [AssinaturaPropostaController::class, 'showAceite2'])
        ->name('assinatura.contrato-pj-2.show');

    Route::get('/contrato-pj/aceite-2/{hash}', [AssinaturaPropostaController::class, 'aceite2'])
        ->name('assinatura.contrato-pj-2');
});

Route::get('app/{any?}', [AppController::class, 'index'])->where('any', '.*');

require __DIR__ . '/auth.php';
