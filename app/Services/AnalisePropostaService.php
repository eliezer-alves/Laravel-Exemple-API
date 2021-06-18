<?php

namespace App\Services;

use App\Repositories\Contracts\{
    AnalisePropostaRepositoryInterface,
    AnalisePessoaPropostaRepositoryInterface,
    LogAnalisePropostaRepositoryInterface,
};
use App\Repositories\Eloquent\PropostaRepository;
use App\Services\KeysInterfaceService;

/**
 * Service Layer - Class responsible for managing the proposal analysis process
 *
 * @author Eliezer Alves
 * @since 31/05/2021
 *
 */
class AnalisePropostaService
{
    private $propostaRepository;
    private $analisePropostaRepository;
    private $analisePessoaPropostaRepository;
    private $logAnalisePropostaRepository;
    private $keysInterfaceService;

    private $statusAguardandoAnaliseManual;
    private $statusEmAnaliseManual;
    private $statusAprovadoAnalise;
    private $statusNegadoAnalise;

    private $proposta;

    public function __construct(AnalisePropostaRepositoryInterface $analisePropostaRepository, AnalisePessoaPropostaRepositoryInterface $analisePessoaPropostaRepository, LogAnalisePropostaRepositoryInterface $logAnalisePropostaRepository, PropostaRepository $propostaRepository, KeysInterfaceService $keysInterfaceService)
    {
        $this->analisePropostaRepository = $analisePropostaRepository;
        $this->analisePessoaPropostaRepository = $analisePessoaPropostaRepository;
        $this->logAnalisePropostaRepository = $logAnalisePropostaRepository;
        $this->propostaRepository = $propostaRepository;
        $this->keysInterfaceService = $keysInterfaceService;

        $this->statusAguardandoAnaliseManual = 1;
        $this->statusEmAnaliseManual = 2;
        $this->statusAprovadoAnalise = 8;
        $this->statusNegadoAnalise = 9;
    }


    /**
     * Service Layer - Method responsible for standardizing related to the conclusion
     * of the analysis of the proposal
     *
     * @param  array  $attributes
     * @param  int  $idProposta
     * @param  int  $idAnaliseProposta
     * @return array $attributes
     */
    private function normalizeAttributes($attributes, $idProposta, $idAnaliseProposta)
    {
        $attributes['cliente']['id_proposta'] = $idProposta;
        $attributes['cliente']['id_analise_proposta'] = $idAnaliseProposta;

        $attributes['representante']['id_proposta'] = $idProposta;
        $attributes['representante']['id_analise_proposta'] = $idAnaliseProposta;

        foreach ($attributes['socios'] as $key => $socio) {
            $attributes['socios'][$key]['id_proposta'] = $idProposta;
            $attributes['socios'][$key]['id_analise_proposta'] = $idAnaliseProposta;
        }
        return $attributes;
    }

    /**
     * Service Layer - Method responsible for registering proposal analysis.
     *
     * @param  array  $attributes
     * @param  int  $idProposta
     * @return App\Repositories\Contracts\AnalisePropostaRepositoryInterface
     */
    public function registrarAnaliseProposta($attributes, $idProposta)
    {
        $attributtesAnaliseProposta = $this->keysInterfaceService->hydrator($attributes, $this->keysInterfaceService->registrarAnaliseProposta());
        $attributtesAnaliseProposta['id_proposta'] = $idProposta;
        return $this->analisePropostaRepository->registrarAnaliseProposta($attributtesAnaliseProposta, $idProposta);
    }

    /**
     * Service Layer - Method responsible for registering proposal analysis.
     *
     * @param  array  $attributes
     * @param  int  $idProposta
     * @return App\Repositories\Contracts\AnalisePropostaRepositoryInterface
     */
    private function registrarAnalisePessoaProposta($attributes)
    {
        $attributesAnalisePessoaProposta = $this->keysInterfaceService->hydrator($attributes, $this->keysInterfaceService->registrarAnalisePessoaProposta());
        return $this->analisePessoaPropostaRepository->registrarAnalisePessoaProposta($attributesAnalisePessoaProposta);
    }

    /**
     * Service Layer - Method responsible for normalizing the attributes to insert an
     * analysis of the person related to the proposal.
     *
     * @param  object  $pessoaProposta
     * @return App\Repositories\Contracts\AnalisePropostaRepositoryInterface
     */
    private function attributesRegistrarAnalisePessoaProposta($pessoaProposta)
    {
        return [
            'id_proposta' => $this->proposta->id_proposta,
            'id_analise_proposta' => $this->proposta->analise->id_analise_proposta,
            'id_pessoa_assinatura' => $pessoaProposta->id_pessoa_assinatura ?? null,
            'id_confirme_online' => $pessoaProposta->confirme_online->pessoal->id_confirme_online ?? null,
            'id_info_mais' => $pessoaProposta->infomais_endereco->id_info_mais ?? null,
            'id_score' => $pessoaProposta->scpc_score->id_score ?? null,
            'id_scpc' => $pessoaProposta->scpc_debito->id_scpc ?? null,
            'id_spc_brasil' => $pessoaProposta->spc_brasil->id_spc_brasil ?? null,
            'id_scr' => $pessoaProposta->scr->id_scr ?? null,
            'restricao' => $pessoaProposta->debito->valor_total_debitos ?? null,
            'score' => $pessoaProposta->scpc_score->resultado ?? null,
            'classificacao_score' => $pessoaProposta->classificacao_score,
        ];
    }

        /**
     * Service Layer - Method responsible for the proposal analysis log.
     *
     * @param  int  $idUsuario
     * @return App\Repositories\Contracts\AnalisePropostaRepositoryInterface
     */
    public function registrarLogAnaliseProposta($idUsuario)
    {
        $attributtesLogAnaliseProposta = [
            'id_proposta' => $this->proposta->id_proposta,
            'id_analise_proposta' => $this->proposta->analise->id_analise_proposta,
            'id_usuario_analise_manual' => $idUsuario,
            'id_tipo_proposta' => 2,
            'id_status_anterior' => $this->proposta->id_status_analise_proposta,
            'id_status_atual' => $this->proposta->id_status_analise_proposta,
            'valor_liberacao' => $this->proposta->valor_liberacao,
            'data_hora_inicio_analise' => date('Y-m-d H:i:s'),
        ];
        return $this->logAnalisePropostaRepository->create($attributtesLogAnaliseProposta);
    }

    /**
     * Service Layer - Method responsible for the proposal analysis log.
     *
     * @param  int  $idLogAnaliseProposta
     * @return App\Repositories\Contracts\AnalisePropostaRepositoryInterface
     */
    public function finalizarLogAnaliseProposta($attributtesFinalizarAnaliseProposta, $idLogAnaliseProposta)
    {
        return $this->logAnalisePropostaRepository->update($attributtesFinalizarAnaliseProposta, $idLogAnaliseProposta);
    }


    /**
     * Service Layer - Get proposal data for analysis process
     *
     * @since 31/05/2021
     *
     * @param  int  $idProposta
     * @return array  $dataProposta
     */
    public function getDadosPropostaAnalise($idProposta, $idUsuario)
    {
        ini_set('max_execution_time', 3000);
        ini_set('memory_limit','4096M');

        /*
        |--------------------------------------------------------------------------
        | Proposal Data
        |--------------------------------------------------------------------------
        |
        | Redeeming all Proposal data for analysis
        */
        $this->proposta = $this->propostaRepository->findOrFail($idProposta);
        $this->proposta->parcelas;
        $this->proposta->clienteAssinatura->atividadeComercial;
        $this->proposta->clienteAssinatura->tipoEmpresa;
        $this->proposta->clienteAssinatura->porte;
        $this->proposta->clienteAssinatura->cosif;
        $this->proposta->clienteAssinatura->tipoLogradouro;
        $this->proposta->representante->tipoLogradouro;
        $this->proposta->socios->map(function ($socio) {
            return $socio->tipoLogradouro;
        });
        $this->proposta->documentos;
        $this->proposta->statusAnalise;

        /*
        |--------------------------------------------------------------------------
        | Proposal Analysis
        |--------------------------------------------------------------------------
        |
        | Registering Proposal Analysis
        */
        $this->registrarAnaliseProposta([], $this->proposta->id_proposta);
        $this->proposta->analise;

        /*
        |--------------------------------------------------------------------------
        | Proposal Analysis Log
        |--------------------------------------------------------------------------
        |
        | Registering the Proposal Analysis Log
        */
        $logAnalise = $this->registrarLogAnaliseProposta($idUsuario);
        $this->proposta['id_log_analise'] = $logAnalise->getKey();

        /*
        |--------------------------------------------------------------------------
        | Inquiries - Customer Subscription
        |--------------------------------------------------------------------------
        |
        | Making Subscription Customer Inquiries
        |   - Confirme Online
        */
        $analisClienteProposta = null;
        if(in_array($this->proposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analisClienteProposta = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($this->proposta->analise->id_analise_proposta, $this->proposta->clienteAssinatura->id_pessoa_assinatura);
        }
        // $this->proposta->clienteAssinatura->consultarConfirmeOnline($analisClienteProposta->id_confirme_online ?? null);
        $this->proposta->clienteAssinatura->consultarScr($analisClienteProposta->id_scr ?? null);
        // $this->proposta->clienteAssinatura->consultarScpcDebitoCnpj($analisClienteProposta->id_scpc ?? null);

        /*
        |--------------------------------------------------------------------------
        | Proposed Person Analysis
        |--------------------------------------------------------------------------
        |
        | Registering customer review of the proposal
        */
        $attributesAnalise = $this->attributesRegistrarAnalisePessoaProposta($this->proposta->clienteAssinatura);
        $this->registrarAnalisePessoaProposta($attributesAnalise);

        /*
        |--------------------------------------------------------------------------
        | Inquiries - Legal Representative
        |--------------------------------------------------------------------------
        |
        | Making inquiries from the Legal Representative
        |   - Info Mais
        |   - SCPC
        |   - SPC Brasil
        |   - Confirme Online
        |   - Débito
        */

        $analiseRepresentanteProposta = null;
        if(in_array($this->proposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analiseRepresentanteProposta = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($this->proposta->analise->id_analise_proposta, $this->proposta->representante->id_pessoa_assinatura);
        }

        // $this->proposta->representante->consultarConfirmeOnline($analiseRepresentanteProposta->id_confirme_online ?? null);
        // $this->proposta->representante->consultarDebito($analiseRepresentanteProposta->id_scpc ?? null);
        // $this->proposta->representante->consultarInfomaisEndereco($analiseRepresentanteProposta->id_info_mais ?? null);
        // // $this->proposta->representante->consultarInfomaisSituacao($analiseRepresentanteProposta->id_info_mais ?? null);
        // $this->proposta->representante->consultarInfomaisTelefone($analiseRepresentanteProposta->id_info_mais ?? null);
        // $this->proposta->representante->consultarScpcDebito($analiseRepresentanteProposta->id_scpc ?? null);
        // $this->proposta->representante->consultarScpcScore($analiseRepresentanteProposta->id_score ?? null);
        // $this->proposta->representante->consultarSpcBrasil($analiseRepresentanteProposta->id_spc_brasil ?? null);
        // $this->proposta->representante->consultarScr($analiseRepresentanteProposta->scr->id_scr ?? null);

        /*
        |--------------------------------------------------------------------------
        | Proposed Person Analysis
        |--------------------------------------------------------------------------
        |
        | Registering analysis of the legal representative related to the proposal
        */
        $attributesAnalise = $this->attributesRegistrarAnalisePessoaProposta($this->proposta->representante);
        $this->registrarAnalisePessoaProposta($attributesAnalise);

        /*
        |--------------------------------------------------------------------------
        | Inquiries - Partners
        |--------------------------------------------------------------------------
        |
        | Making Partner Inquiries
        |   - Info Mais
        |   - SCPC
        |   - SPC Brasil
        |   - Confirme Online
        |   - Débito
        */
        $this->proposta->socios->map(function ($socio) {
            $analiseRepresentanteProposta = null;
            if(in_array($this->proposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
            {
                $analiseSocioProposta = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($this->proposta->analise->id_analise_proposta, $socio->id_pessoa_assinatura);
            }

            // $socio->consultarConfirmeOnline($analiseSocioProposta->id_confirme_online ?? null);
            // $socio->consultarDebito($analiseSocioProposta->id_scpc ?? null);
            // $socio->consultarInfomaisEndereco($analiseSocioProposta->id_info_mais ?? null);
            // // $socio->consultarInfomaisSituacao($analiseSocioProposta->id_info_mais ?? null);
            // $socio->consultarInfomaisTelefone($analiseSocioProposta->id_info_mais ?? null);
            // $socio->consultarScpcDebito($analiseSocioProposta->id_scpc ?? null);
            // $socio->consultarScpcScore($analiseSocioProposta->id_score ?? null);
            // $socio->consultarSpcBrasil($analiseSocioProposta->id_spc_brasil ?? null);
            // $socio->consultarScr($analiseSocioProposta->scr->id_scr ?? null);

            /*
            |--------------------------------------------------------------------------
            | Proposed Person Analysis
            |--------------------------------------------------------------------------
            |
            | Registering analysis of the partners linked to the proposal
            */
            $attributesAnalise = $this->attributesRegistrarAnalisePessoaProposta($socio);
            $this->registrarAnalisePessoaProposta($attributesAnalise);
        });


        /*
        |--------------------------------------------------------------------------
        | Proposal Analysis
        |--------------------------------------------------------------------------
        |
        | Changing proposal review status
        */
        if($this->proposta->id_status_analise_proposta == $this->statusAguardandoAnaliseManual){
            $this->propostaRepository->alterarStatusAnalise($this->statusEmAnaliseManual, $this->proposta->id_proposta);
            $this->proposta['id_status_analise_proposta'] = $this->statusEmAnaliseManual;
        }


        return $this->proposta;
    }


    /**
     * Service Layer - Method responsible for completing the analysis of the proposal.
     *
     * @param  array  $attributes
     * @param  int  $idProposta
     * @return App\Repositories\Contracts\AnalisePropostaRepositoryInterface
     */
    public function concluirAnaliseProposta($attributes, $idProposta)
    {
        /*
        |--------------------------------------------------------------------------
        | Proposta
        |--------------------------------------------------------------------------
        |
        | Changing proposal review status
        */
        $this->propostaRepository->alterarStatusAnalise($attributes['id_status_analise_proposta'], $idProposta);


        /*
        |--------------------------------------------------------------------------
        | Análise Proposta
        |--------------------------------------------------------------------------
        |
        | Registering proposal analysis
        */
        $analiseProposta = $this->registrarAnaliseProposta($attributes, $idProposta);


        /*
        |--------------------------------------------------------------------------
        | Attributes
        |--------------------------------------------------------------------------
        |
        | Normalizing attributes to continue the process
        */
        $attributes = $this->normalizeAttributes($attributes, $idProposta, $analiseProposta->getKey());


        /*
        |--------------------------------------------------------------------------
        | Análise Pessoa Proposta
        |--------------------------------------------------------------------------
        |
        | Registering customer review of the proposal
        */
        $analiseClienteProposta = $this->registrarAnalisePessoaProposta($attributes['cliente']);


        /*
        |--------------------------------------------------------------------------
        | Análise Pessoa Proposta
        |--------------------------------------------------------------------------
        |
        | Registering analysis of the legal representative related to the proposal
        */
        $analiseRepresentanteProposta = $this->registrarAnalisePessoaProposta($attributes['representante']);


        /*
        |--------------------------------------------------------------------------
        | Análise Pessoa Proposta
        |--------------------------------------------------------------------------
        |
        | Registering analysis of the partners related to the proposal
        */
        $analiseSociosProposta = [];
        foreach ($attributes['socios'] as $socio) {
            $analiseSocioProposta = $this->registrarAnalisePessoaProposta($socio);
            array_push($analiseSociosProposta, $analiseSocioProposta);
        }

        return [
            'analise_proposta' => $analiseProposta,
            'analise_cliente_proposta' => $analiseClienteProposta,
            'analise_representante_proposta' => $analiseRepresentanteProposta,
            'analise_socios_proposta' => $analiseSociosProposta,
        ];
    }
}
