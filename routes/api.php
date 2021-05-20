<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AtividadeComercialController,
    AssinaturaPropostaController,
    ClienteController,
    DocumentoPropostaController,
    DominiosController,
    PdfController,
    PorteEmpresaController,
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

Route::post('/cliente', [ClienteController::class, 'store']);

Route::middleware('auth:api')->prefix('cliente')->group(function () {
    Route::get('/', [ClienteController::class, 'index']);
    Route::get('/{id_cliente}', [ClienteController::class, 'show']);

    Route::put('/{id_cliente}', [ClienteController::class, 'update']);
    Route::delete('/{id_cliente}', [ClienteController::class, 'destroy']);
});

Route::middleware('auth:api')->get('/cliente-busca/{cnpj}', [ClienteController::class, 'findByCnpj'])->where(['cnpj' => '[0-9]+']);

Route::middleware('auth:api')->prefix('atividade-comercial')->group(function () {
    Route::get('/', [AtividadeComercialController::class, 'index']);
    Route::get('/{id_atividade_comercial}', [AtividadeComercialController::class, 'show']);
    Route::post('/', [AtividadeComercialController::class, 'store']);
    Route::put('/{id_atividade_comercial}', [AtividadeComercialController::class, 'update']);
    Route::delete('/{id_atividade_comercial}', [AtividadeComercialController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('porte-empresa')->group(function () {
    Route::get('/', [PorteEmpresaController::class, 'index']);
    Route::get('/{id_porte_empresa}', [PorteEmpresaController::class, 'show']);
    Route::post('/', [PorteEmpresaController::class, 'store']);
    Route::put('/{id_porte_empresa}', [PorteEmpresaController::class, 'update']);
    Route::delete('/{id_porte_empresa}', [PorteEmpresaController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('simulacao')->group(function () {
    Route::post('/', [SimulacaoController::class, 'novaSimulacao']);
    Route::get('/{id_simulacao}', [SimulacaoController::class, 'show']);
});

Route::middleware('auth:api')->prefix('proposta')->group(function () {
    Route::post('/', [PropostaController::class, 'novaProposta']);
    Route::get('/{id_proposta}', [PropostaController::class, 'dadosProposta'])
        ->where(['id_proposta' => '[0-9]+']);

    Route::get('/numero/{numero_proposta}', [PropostaController::class, 'dadosPropostaPorNumero'])
        ->where(['numero_proposta' => '[0-9]+']);
});

Route::middleware('auth:api')->prefix('documento-proposta')->group(function () {
    Route::post('/upload/{id_proposta}', [DocumentoPropostaController::class, 'createMany'])
        ->where(['id_proposta' => '[0-9]+']);

    Route::post('/upload-por-proposta/{numero_proposta}', [DocumentoPropostaController::class, 'createManyByNumero'])
        ->where(['numero_proposta' => '[0-9]+']);
});

Route::prefix('pdf')->group(function () {
    Route::get('/contrato-pj-interno/{hash}', [PdfController::class, 'contratoPjInterno'])
        ->name('pdf.contrato-pj-interno.show');

    Route::get('/contrato-pj/{hash}', [PdfController::class, 'contratoPj'])
        ->name('pdf.contrato-pj.show');

    Route::get('link/contrato-pj/{id_proposta}', [PdfController::class, 'linkContratoPj'])
        ->where('id_proposta', '[0-9]+')
        ->name('link.pdf.contrato-pj');
});

Route::prefix('assinatura/link')->group(function () {

    Route::get('/contrato-pj/{id_proposta}/{id_pessoa_assinatura}', [AssinaturaPropostaController::class, 'linkAssinatura'])
        ->where(['id_proposta' => '[0-9]+', 'id_pessoa_assinatura' => '[0-9]+'])
        ->name('assinatura.link.contrato-pj');

    Route::get('/contrato-pj/{id_proposta}', [AssinaturaPropostaController::class, 'linkContratoAssinado'])
        ->where(['id_proposta' => '[0-9]+'])
        ->name('assinatura.link.contrato-pj-assinado');
});

Route::middleware('auth:api')->prefix('send-mail')->group(function () {
    Route::post('/contrato-pj/link-assinatura', [AssinaturaPropostaController::class, 'enviaLinkAssinatura'])
        ->name('send-mail.contrato-pj.assinatura');

    Route::post('/contrato-pj/link-assinatura/all', [AssinaturaPropostaController::class, 'enviaTodosLinkAssinatura'])
        ->name('send-mail.contrato-pj.link-assinatura.todos');

});

Route::get('/dominios', [DominiosController::class, '__invoke']);

Route::get('/teste', [TesteController::class, 'teste']);
