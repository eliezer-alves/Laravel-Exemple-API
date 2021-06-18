<?php

namespace App\Services;

use App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface;
use App\Repositories\Contracts\AnalisePropostaRepositoryInterface;
use App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface;


/**
 * Service Layer - Class responsible for managing business activities of PJ clients
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class AnalisePropostaConsultaService
{
    protected $analisePropostaRepository;
    protected $analisePessoaPropostaRepository;
    protected $pessoaAssinaturaRepository;

    private $statusAguardandoAnaliseManual;
    private $statusEmAnaliseManual;
    private $statusAprovadoAnalise;
    private $statusNegadoAnalise;

    public function __construct(AnalisePropostaRepositoryInterface $analisePropostaRepository, AnalisePessoaPropostaRepositoryInterface $analisePessoaPropostaRepository, PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository)
    {
        $this->analisePropostaRepository = $analisePropostaRepository;
        $this->analisePessoaPropostaRepository = $analisePessoaPropostaRepository;
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
        $this->statusAguardandoAnaliseManual = 1;
        $this->statusEmAnaliseManual = 2;
        $this->statusAprovadoAnalise = 8;
        $this->statusNegadoAnalise = 9;
    }

    /**
     * Service Layer - Confirme Online.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function confirmeOnline($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarConfirmeOnline($analise->id_confirme_online ?? null);

        return (array)$pessoa->confirme_online;
    }

    /**
     * Service Layer - Debito.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function debito($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarDebito($analise->id_scpc ?? null);

        return (array)$pessoa->debito;
    }

    /**
     * Service Layer - Infomais Endereco.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function infomaisEndereco($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarInfomaisEndereco($analise->id_info_mais ?? null);

        return (array)$pessoa->infomais_endereco;
    }


    /**
     * Service Layer - Infomais Situação.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function infomaisSituacao($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarInfomaisSituacao($analise->id_info_mais ?? null);

        return (array)$pessoa->infomais_situacao;
    }

    /**
     * Service Layer - Infomais Telefone.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function infomaisTelefone($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarInfomaisTelefone($analise->id_info_mais ?? null);

        return (array)$pessoa->infomais_telefone;
    }

    /**
     * Service Layer - SCPC Débito.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function scpcDebito($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarScpcDebito($analise->id_scpc ?? null);

        return (array)$pessoa->scpc_debito;
    }

    /**
     * Service Layer - SCPC Débito.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function scpcDebitoCnpj($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarScpcDebitoCnpj($analise->id_scpc ?? null);

        return (array)$pessoa->scpc_debito;
    }

    /**
     * Service Layer - SCPC Score.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function scpcScore($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarScpcScore($analise->id_score ?? null);

        return [
            'scpc_score' => (array)$pessoa->scpc_score,
            'valor_score' => $pessoa->valor_score,
            'classificacao_score' => $pessoa->classificacao_score,
        ];
    }

    /**
     * Service Layer - SCR.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function scr($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarScr($analise->scr->id_scr ?? null);

        return (array)$pessoa->scr;
    }

    /**
     * Service Layer - SPC Brasil.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function spcBrasil($idAnaliseProposta, $idPessoaAssinatura)
    {
        $analiseProposta = $this->analisePropostaRepository->find($idAnaliseProposta);

        if(in_array($analiseProposta->id_status_analise_proposta, [$this->statusAprovadoAnalise, $this->statusNegadoAnalise]))
        {
            $analise = $this->analisePessoaPropostaRepository->findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura);
        }

        $pessoa = $this->pessoaAssinaturaRepository->find($idPessoaAssinatura);
        $pessoa->consultarSpcBrasil($analise->id_spc_brasil ?? null);

        return (array)$pessoa->spc_brasil;
    }
}
