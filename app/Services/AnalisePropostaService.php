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
        $analisClienteProposta = NULL;
        if(in_array($this->proposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]) or true)
        {
            $analisClienteProposta = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($this->proposta->analise->id_analise_proposta, $this->proposta->clienteAssinatura->id_pessoa_assinatura);
        }
        // $this->proposta->clienteAssinatura->consultarConfirmeOnline($analisClienteProposta->id_confirme_online ?? NULL);
        // $this->proposta->clienteAssinatura->consultarScr($analisClienteProposta->id_scr ?? NULL);
        // $this->proposta->clienteAssinatura->consultarScpcDebitoCnpj($analisClienteProposta->id_scpc ?? NULL);
        // $this->proposta->clienteAssinatura->consultarSpcBrasilPlus($analisClienteProposta->id_spc_brasil_plus ?? NULL);

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

        $analiseRepresentanteProposta = NULL;
        if(in_array($this->proposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]) || true)
        {
            $analiseRepresentanteProposta = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($this->proposta->analise->id_analise_proposta, $this->proposta->representante->id_pessoa_assinatura);
        }

        // $this->proposta->representante->consultarConfirmeOnline($analiseRepresentanteProposta->id_confirme_online ?? NULL);
        // $this->proposta->representante->consultarDebito($analiseRepresentanteProposta->id_scpc ?? NULL);
        // $this->proposta->representante->consultarInfomaisEndereco($analiseRepresentanteProposta->id_info_mais ?? NULL);
        // // $this->proposta->representante->consultarInfomaisSituacao($analiseRepresentanteProposta->id_info_mais ?? NULL);
        // $this->proposta->representante->consultarInfomaisTelefone($analiseRepresentanteProposta->id_info_mais ?? NULL);
        // $this->proposta->representante->consultarScpcDebito($analiseRepresentanteProposta->id_scpc ?? NULL);
        // $this->proposta->representante->consultarScpcScore($analiseRepresentanteProposta->id_score ?? NULL);
        // $this->proposta->representante->consultarSpcBrasil($analiseRepresentanteProposta->id_spc_brasil ?? NULL);
        // $this->proposta->representante->consultarScr($analiseRepresentanteProposta->id_scr ?? NULL);

        $this->proposta->representante->assinou();

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
            $analiseRepresentanteProposta = NULL;
            $socio->assinou();
            if(in_array($this->proposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
            {
                $analiseSocioProposta = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($this->proposta->analise->id_analise_proposta, $socio->id_pessoa_assinatura);
            }

            // $socio->consultarConfirmeOnline($analiseSocioProposta->id_confirme_online ?? NULL);
            // $socio->consultarDebito($analiseSocioProposta->id_scpc ?? NULL);
            // $socio->consultarInfomaisEndereco($analiseSocioProposta->id_info_mais ?? NULL);
            // // $socio->consultarInfomaisSituacao($analiseSocioProposta->id_info_mais ?? NULL);
            // $socio->consultarInfomaisTelefone($analiseSocioProposta->id_info_mais ?? NULL);
            // $socio->consultarScpcDebito($analiseSocioProposta->id_scpc ?? NULL);
            // $socio->consultarScpcScore($analiseSocioProposta->id_score ?? NULL);
            // $socio->consultarSpcBrasil($analiseSocioProposta->id_spc_brasil ?? NULL);
            // $socio->consultarScr($analiseSocioProposta->id_scr ?? NULL);
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
     * Service Layer - Manual proposal review process logs
     *
     * @author Eliezer Alves
     *
     * @param  int $idProposta
     * @return \Illuminate\Http\Response
     */
    public function logsAnaliseProposta($idProposta)
    {
        $analiseProposta = $this->analisePropostaRepository->where('id_proposta', $idProposta)->first();

        $analiseProposta->logs->map(function ($log){

            $log->nome_analista = $log->analista->nome;
            $log->data_hora_inicio_analise = date('d/m/Y H:i:s', strtotime($log->data_hora_inicio_analise));
            $log->data_hora_fim_analise_manual = date('d/m/Y H:i:s', strtotime($log->data_hora_fim_analise_manual));
            $log->status_anterior = $log->statusAnterior->descricao;
            $log->status_atual = $log->statusAtual->descricao;

            unset($log->analista);
            unset($log->statusAnterior);
            unset($log->statusAtual);
        });

        return $analiseProposta->logs;
    }
}
