<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    ArquivoPropostaController,
    AtividadeComercialController,
    ClienteController,
    DominiosController,
    PdfController,
    PropostaAssinaturaController,
    PropostaController,
    SimulacaoController,
    TesteController,
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/cliente', [ClienteController::class, 'store']);
Route::middleware('auth:api')->namespace('cliente')->group(function () {
    Route::get('/cliente', [ClienteController::class, 'index']);
    Route::get('/cliente/{id_cliente}', [ClienteController::class, 'show']);
    Route::get('/cliente-busca/{cnpj}', [ClienteController::class, 'findByCnpj'])
        ->where(['cnpj' => '[0-9]+']);
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
    Route::get('/proposta/{numero_proposta}', [PropostaController::class, 'dadosProposta'])
        ->where(['numero_proposta' => '[0-9]+']);
    Route::get('/simulacao/cliente', [PropostaController::class, 'novaProposta']);
});

Route::middleware('auth:api')->prefix('arquivo-proposta')->group(function () {
    Route::post('/upload/{id_proposta}', [ArquivoPropostaController::class, 'createMany'])
        ->where(['id_proposta' => '[0-9]+']);
});

Route::prefix('pdf')->group(function () {
    Route::get('/contrato-pj/{hash}', [PdfController::class, 'contratoPj'])
        ->name('pdf.contrato-pj.show');

        Route::get('link/contrato-pj/{id_proposta}', [PdfController::class, 'linkContratoPj'])
        ->where('id_proposta', '[0-9]+')
        ->name('link.pdf.contrato-pj');
});

Route::prefix('assinatura')->group(function () {

    Route::get('/link/contrato-pj/{id_proposta}/{id_pessoa_assinatura}', [PropostaAssinaturaController::class, 'linkAssinatura'])
        ->where(['id_proposta' => '[0-9]+', 'id_pessoa_assinatura' => '[0-9]+'])
        ->name('assinatura.link.contrato-pj');

    Route::get('/link/contrato-pj/{id_proposta}', [PropostaAssinaturaController::class, 'linkContratoAssinado'])
        ->where(['id_proposta' => '[0-9]+'])
        ->name('assinatura.link.contrato-pj-assinado');
});

Route::middleware('auth:api')->prefix('send-mail')->group(function () {
    Route::post('/contrato-pj/link-assinatura', [PropostaAssinaturaController::class, 'enviaLinkAssinatura'])
        ->name('send-mail.contrato-pj.assinatura');

    Route::post('/contrato-pj/link-assinatura/all', [PropostaAssinaturaController::class, 'enviaTodosLinkAssinatura'])
        ->name('send-mail.contrato-pj.link-assinatura.todos');

});

Route::get('/dominios', [DominiosController::class, '__invoke']);

Route::get('/teste', [TesteController::class, 'teste']);
