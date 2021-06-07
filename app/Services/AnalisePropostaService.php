<?php

namespace App\Services;

use App\Repositories\Contracts\{
    AnalisePropostaRepositoryInterface,
    AnalisePessoaPropostaRepositoryInterface,
};
use App\Repositories\Eloquent\PropostaRepository;
use App\Services\KeysInterfaceService;

use App\Services\GacConsultas\{
    ConfirmeOnlineService,
    DebitosService,
    InfoMaisService,
    ScpcService,
    SpcBrasilService,
};

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
    private $keysInterfaceService;

    private $statusNaoAssinado;
    private $statusAguardandoAnaliseManual;
    private $statusEmAnaliseManual;

    public function __construct(AnalisePropostaRepositoryInterface $analisePropostaRepository, AnalisePessoaPropostaRepositoryInterface $analisePessoaPropostaRepository, PropostaRepository $propostaRepository, KeysInterfaceService $keysInterfaceService, ConfirmeOnlineService $confirmeOnline, DebitosService $debito, InfoMaisService $infomais, ScpcService $scpc, SpcBrasilService $spcBrasil)
    {
        $this->analisePropostaRepository = $analisePropostaRepository;
        $this->analisePessoaPropostaRepository = $analisePessoaPropostaRepository;
        $this->propostaRepository = $propostaRepository;
        $this->keysInterfaceService = $keysInterfaceService;

        $this->confirmeOnline = $confirmeOnline;
        $this->debito = $debito;
        $this->infomais = $infomais;
        $this->scpc = $scpc;
        $this->spcBrasil = $spcBrasil;

        $this->statusNaoAssinado = 0;
        $this->statusAguardandoAnaliseManual = 1;
        $this->statusEmAnaliseManual = 2;
    }


    /**
     * Service Layer - Method responsible for classifying a score value
     *
     * @param  int $score
     * @return string $classificacaoScore
     */
    public function classificacaoScore($score)
    {
        $classificacaoScore = 'SEM INFORMACAO';

        if ($score == ''  || ($score >= 0 && $score <= 1))
            $classificacaoScore = 'SEM INFORMACAO';
        else if ($score >= 2 && $score <= 322)
            $classificacaoScore = 'ALTISSIMO RISCO';
        else if ($score > 322 && $score <= 365)
            $classificacaoScore = 'ALTO RISCO';
        else if ($score > 365 && $score <= 529)
            $classificacaoScore = 'MEDIO RISCO';
        else if ($score > 529 && $score <= 747)
            $classificacaoScore = 'BAIXO RISCO';
        else if ($score > 747 && $score <= 1000)
            $classificacaoScore = 'BAIXISSIMO RISCO';
        else
            $classificacaoScore = 'SEM INFORMACAO';

        return $classificacaoScore;
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
        return $this->analisePropostaRepository->registrarAnaliseProposta($attributtesAnaliseProposta, $idProposta);
    }

    /**
     * Service Layer - Method responsible for registering proposal analysis.
     *
     * @param  array  $attributes
     * @param  int  $idProposta
     * @return App\Repositories\Contracts\AnalisePropostaRepositoryInterface
     */
    public function registrarAnalisePessoaProposta($attributes)
    {
        $attributesAnalisePessoaProposta = $this->keysInterfaceService->hydrator($attributes, $this->keysInterfaceService->registrarAnalisePessoaProposta());
        return $this->analisePessoaPropostaRepository->registrarAnalisePessoaProposta($attributesAnalisePessoaProposta);
    }


        /**
     * Service Layer - Get proposal data for analysis process
     *
     * @since 31/05/2021
     *
     * @param  int  $idProposta
     * @return array  $dataProposta
     */
    public function getDadosPropostaAnalise($idProposta)
    {
        ini_set('max_execution_time', 3000);
        ini_set('memory_limit','4096M');

        /*
        |--------------------------------------------------------------------------
        | Dados da Proposta
        |--------------------------------------------------------------------------
        |
        | Resgatando todos os dados da Proposta para a análise
        */
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $proposta->parcelas;
        $proposta->clienteAssinatura->atividadeComercial;
        $proposta->clienteAssinatura->tipoEmpresa;
        $proposta->clienteAssinatura->porte;
        $proposta->clienteAssinatura->cosif;
        $proposta->clienteAssinatura->tipoLogradouro;
        $proposta->representante->tipoLogradouro;
        $proposta->socios->map(function ($socio) {
            return $socio->tipoLogradouro;
        });
        $proposta->documentos;
        $proposta->statusAnalise;
        // $proposta->toArray();

        $analiseProposta = $this->registrarAnaliseProposta([], $proposta->id_proposta);

        /*
        |--------------------------------------------------------------------------
        | Consultas - Cliente Assinatura
        |--------------------------------------------------------------------------
        |
        | Fazendo Consultas do Cliente Assinatura
        |   - Confirme Online
        */
        $proposta['clienteAssinatura']['confirme_online'] = $this->confirmeOnline->consulta($proposta['clienteAssinatura']['cnpj']);


        /*
        |--------------------------------------------------------------------------
        | Análise Pessoa Proposta
        |--------------------------------------------------------------------------
        |
        | Registering customer review of the proposal
        */
        $analiseClienteProposta = $this->registrarAnalisePessoaProposta([
            'id_proposta' => $proposta->id_proposta,
            'id_analise_proposta' => $analiseProposta->getKey(),
            'id_pessoa_assinatura' => $proposta->clienteAssinatura->id_pessoa_assinatura,
            'id_confirme_online' => $proposta->clienteAssinatura->confirme_online->pessoal->id_confirme_online ?? null
        ], $proposta->id_proposta);

        /*
        |--------------------------------------------------------------------------
        | Consultas - Representante Legal
        |--------------------------------------------------------------------------
        |
        | Fazendo Consultas do Representante Legal
        |   - Info Mais
        |   - SCPC
        |   - SPC Brasil
        |   - Confirme Online
        |   - Débito
        */
        $proposta['representante']['infomais'] = [
            'endereco' => $this->infomais->endereco($proposta['representante']['cpf']),
            'telefone' => $this->infomais->telefone($proposta['representante']['cpf']),
            'situacao' => $this->infomais->situacao($proposta['representante']['cpf'])
        ];
        $proposta['representante']['scpc'] = [
            'debito' => $this->scpc->debito($proposta['representante']['cpf']),
            'score' => $this->scpc->score($proposta['representante']['cpf']),
        ];
        $proposta['representante']['spc_brasil'] = $this->spcBrasil->consulta($proposta['representante']['cpf']);
        $proposta['representante']['confirme_online'] = $this->confirmeOnline->consulta($proposta['representante']['cpf']);
        $proposta['representante']['debito'] = $this->debito->consulta($proposta['representante']['cpf']);
        $proposta['representante']['valor_score'] = $proposta->representante->scpc['score']->resultado ?? null;
        $proposta['representante']['classificacao_score'] = $this->classificacaoScore(intval($proposta->representante->scpc['score']->resultado ?? null));


        /*
        |--------------------------------------------------------------------------
        | Análise Pessoa Proposta
        |--------------------------------------------------------------------------
        |
        | Registering analysis of the legal representative related to the proposal
        */
        $analiseRepresentanteProposta = $this->registrarAnalisePessoaProposta([
            'id_proposta' => $proposta->id_proposta,
            'id_analise_proposta' => $analiseProposta->getKey(),
            'id_pessoa_assinatura' => $proposta->representante->id_pessoa_assinatura ?? null,
            'id_infomais' => $proposta->representante->infomais->endereco->id_infomais ?? null,
            'id_scpc' => $proposta->representante->scpc->debito->id_scpc ?? null,
            'id_scpc' => $proposta->representante->spc_brasil->id_spc_brasil ?? null,
            'id_confirme_online' => $proposta->representante->confirme_online->pessoal->id_confirme_online ?? null,
            'restricao' => $proposta->representante->debito->valor_total_debitos ?? null,
            'score' => $proposta->representante->scpc['score']->resultado ?? null,
            'classificacao_score' => $proposta->representante->classificacao_score,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Consultas - Sócios
        |--------------------------------------------------------------------------
        |
        | Fazendo Consultas dos Sócios
        |   - Info Mais
        |   - SCPC
        |   - SPC Brasil
        |   - Confirme Online
        |   - Débito
        */
        $analiseSociosProposta = [];
        foreach ($proposta['socios'] as $key => $socio) {
            $proposta['socios'][$key]['infomais'] = [
                'endereco' => $this->infomais->endereco($socio['cpf']),
                'telefone' => $this->infomais->telefone($socio['cpf']),
                'situacao' => $this->infomais->situacao($socio['cpf'])
            ];
            $proposta['socios'][$key]['scpc'] = [
                'debito' => $this->scpc->debito($socio['cpf']),
                'score' => $this->scpc->score($socio['cpf']),
            ];
            $proposta['socios'][$key]['spc_brasil'] = $this->spcBrasil->consulta($socio['cpf']);
            $proposta['socios'][$key]['confirme_online'] = $this->confirmeOnline->consulta($socio['cpf']);
            $proposta['socios'][$key]['debito'] = $this->debito->consulta($socio['cpf']);
            $proposta['socios'][$key]['valor_score'] = $proposta['socios'][$key]->scpc['score']->resultado ?? null;
            $proposta['socios'][$key]['classificacao_score'] = $this->classificacaoScore(intval($proposta['socios'][$key]->scpc['score']->resultado ?? null));

            /*
            |--------------------------------------------------------------------------
            | Análise Pessoa Proposta
            |--------------------------------------------------------------------------
            |
            | Registering analysis of the legal representative related to the proposal
            */
            $analiseSocioProposta = $this->registrarAnalisePessoaProposta([
                'id_proposta' => $proposta->id_proposta,
                'id_analise_proposta' => $analiseProposta->getKey(),
                'id_pessoa_assinatura' => $socio->id_pessoa_assinatura ?? null,
                'id_infomais' =>  $proposta['socios'][$key]->infomais->endereco->id_infomais ?? null,
                'id_scpc' =>  $proposta['socios'][$key]->scpc->debito->id_scpc ?? null,
                'id_scpc' =>  $proposta['socios'][$key]->spc_brasil->id_spc_brasil ?? null,
                'id_confirme_online' =>  $proposta['socios'][$key]->confirme_online->pessoal->id_confirme_online ?? null,
                'restricao' => $proposta['socios'][$key]->debito->valor_total_debitos ?? null,
                'score' => $proposta['socios'][$key]->scpc['score']->resultado ?? null,
                'classificacao_score' => $proposta['socios'][$key]->classificacao_score,
            ]);
            array_push($analiseSociosProposta, $analiseSocioProposta);
        }

        $proposta['analise_caliban'] = [
            'analise_proposta' => $analiseProposta,
            'analise_cliente_proposta' => $analiseClienteProposta,
            'analise_representante_proposta' => $analiseRepresentanteProposta,
            'analise_socios_proposta' => $analiseSociosProposta,
        ];


        /*
        |--------------------------------------------------------------------------
        | Analise Proposta
        |--------------------------------------------------------------------------
        |
        | Changing proposal review status
        */
        if($proposta->id_status_analise_proposta == $this->statusAguardandoAnaliseManual){
            $this->propostaRepository->alterarStatusAnalise($this->statusEmAnaliseManual, $proposta->id_proposta);
            $proposta['id_status_analise_proposta'] = $this->statusEmAnaliseManual;
        }


        return $proposta;
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
