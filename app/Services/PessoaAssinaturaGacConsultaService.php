<?php

namespace App\Services;

use App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface;


/**
 * Service Layer - Class responsible for consult entity in the consultation bodies
 *
 * @author Eliezer Alves
 * @since 15/06/2021
 *
 */
class PessoaAssinaturaGacConsultaService
{
    protected $pessoaAssinaturaRepository;

    public function __construct(PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository)
    {
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
    }

    /**
     * Service Layer - Confirme Online.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function confirmeOnline($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
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
    public function debito($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
        $pessoa->consultarDebito();

        return (array)$pessoa->debito;
    }

    /**
     * Service Layer - Infomais Endereco.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function infomaisEndereco($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
        $pessoa->consultarInfomaisEndereco();

        return (array)$pessoa->infomais_endereco;
    }


    /**
     * Service Layer - Infomais Situação.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function infomaisSituacao($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
        $pessoa->consultarInfomaisSituacao();

        return (array)$pessoa->infomais_situacao;
    }

    /**
     * Service Layer - Infomais Telefone.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function infomaisTelefone($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
        $pessoa->consultarInfomaisTelefone();

        return (array)$pessoa->infomais_telefone;
    }

    /**
     * Service Layer - SCPC Débito.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function scpcDebito($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
        $pessoa->consultarScpcDebito();

        return (array)$pessoa->scpc_debito;
    }

    /**
     * Service Layer - SCPC Score.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function scpcScore($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
        $pessoa->consultarScpcScore();

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
    public function scr($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
        $pessoa->consultarScr($analise-);

        return (array)$pessoa->scr;
    }

    /**
     * Service Layer - SPC Brasil.
     *
     * @param $idAnaliseProposta
     * @param $idPessoaAssinatura
     * @return App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface
     */
    public function spcBrasil($request)
    {
        $pessoa = $this->pessoaAssinaturaRepository->fill([
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);
        $pessoa->consultarSpcBrasil();

        return (array)$pessoa->spc_brasil;
    }
}
