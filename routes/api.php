<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AnalisePropostaController,
    AtividadeComercialController,
    AssinaturaPropostaController,
    ClienteController,
    CosifController,
    DocumentoPropostaController,
    DominiosController,
    ObservacaoProposta,
    PdfController,
    PorteEmpresaController,
    PropostaController,
    SimulacaoController,
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
| Domínios
|--------------------------------------------------------------------------
*/
Route::get('/dominios', [DominiosController::class, '__invoke']);



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



/*
|--------------------------------------------------------------------------
| Simulação
|--------------------------------------------------------------------------
*/
Route::group([

    // 'middleware' => ['auth:api'],
    'prefix' => 'simulacao',

], function () {

    Route::post('/', [SimulacaoController::class, 'novaSimulacao']);
    Route::get('/{id_simulacao}', [SimulacaoController::class, 'show']);

});



/*
|--------------------------------------------------------------------------
| Proposta
|--------------------------------------------------------------------------
*/
Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'proposta',

], function () {

    Route::post('/', [PropostaController::class, 'novaProposta']);
    Route::get('/{id_proposta}', [PropostaController::class, 'dadosProposta'])
        ->where(['id_proposta' => '[0-9]+']);

    Route::get('/numero/{numero_proposta}', [PropostaController::class, 'dadosPropostaPorNumero'])
        ->where(['numero_proposta' => '[0-9]+']);

});




/*
|--------------------------------------------------------------------------
| Documento Proposta
|--------------------------------------------------------------------------
*/
Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'documento-proposta',

], function () {

    Route::post('/upload/{id_proposta}', [DocumentoPropostaController::class, 'createMany'])
        ->where(['id_proposta' => '[0-9]+']);

    Route::post('/upload-por-proposta/{numero_proposta}', [DocumentoPropostaController::class, 'createManyByNumero'])
        ->where(['numero_proposta' => '[0-9]+']);

});




/*
|--------------------------------------------------------------------------
| Observacao Proposta
|--------------------------------------------------------------------------
*/
Route::group([

    // 'middleware' => ['auth:api'],
    'prefix' => 'observacao-proposta',

], function () {

    Route::post('/', [ObservacaoProposta::class, 'store']);

    Route::get('/{id_proposta}', [ObservacaoProposta::class, 'index'])
        ->where(['id_proposta' => '[0-9]+']);

});



/*
|--------------------------------------------------------------------------
| Análise Proposta
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'analise-proposta',
], function () {

    Route::post('/atualizar-proposta', [AnalisePropostaController::class, 'alterarDadosProposta']);
    Route::get('/proposta', [AnalisePropostaController::class, 'dadosPropostaAnalise'])
        ->where(['id_proposta' => '[0-9]+']);

    Route::post('/concluir/{id_proposta}', [AnalisePropostaController::class, 'concluirAnaliseProposta'])
        ->where(['id_proposta' => '[0-9]+']);

});



/*
|--------------------------------------------------------------------------
| PDF Contrato
|--------------------------------------------------------------------------
*/
Route::prefix('pdf')->group(function () {
    Route::get('/contrato-pj-interno/{hash}', [PdfController::class, 'contratoPjInterno'])
        ->name('pdf.contrato-pj-interno.show');

    Route::get('/contrato-pj/{hash}', [PdfController::class, 'contratoPj'])
        ->name('pdf.contrato-pj.show');

    Route::get('link/contrato-pj/{id_proposta}', [PdfController::class, 'linkContratoPj'])
        ->where('id_proposta', '[0-9]+')
        ->name('link.pdf.contrato-pj');
});



/*
|--------------------------------------------------------------------------
| Assinatura Contrado
|--------------------------------------------------------------------------
*/
Route::prefix('assinatura/link')->group(function () {

    Route::get('/contrato-pj/{id_proposta}/{id_pessoa_assinatura}', [AssinaturaPropostaController::class, 'linkAssinatura'])
        ->where(['id_proposta' => '[0-9]+', 'id_pessoa_assinatura' => '[0-9]+'])
        ->name('assinatura.link.contrato-pj');

    Route::get('/contrato-pj/{id_proposta}', [AssinaturaPropostaController::class, 'linkContratoAssinado'])
        ->where(['id_proposta' => '[0-9]+'])
        ->name('assinatura.link.contrato-pj-assinado');
});



/*
|--------------------------------------------------------------------------
| Envio E-mail
|--------------------------------------------------------------------------
*/
Route::group([

    'middleware' => ['auth:api'],
    'prefix' => 'send-mail',

], function () {

    Route::post('/contrato-pj/link-assinatura', [AssinaturaPropostaController::class, 'enviaLinkAssinatura'])
        ->name('send-mail.contrato-pj.assinatura');

    Route::post('/contrato-pj/link-assinatura/all', [AssinaturaPropostaController::class, 'enviaTodosLinkAssinatura'])
        ->name('send-mail.contrato-pj.link-assinatura.todos');

});
