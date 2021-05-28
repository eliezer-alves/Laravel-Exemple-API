<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;
use DateTime;

/**
 * Service Layer - Class responsible for managing the loan simulations
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class SimulacaoService
{
    protected $apiSicred;
    private $modeloPropostaAbaixo;
    private $modeloPropostaAcima;

    public function __construct(ApiSicredServiceInterface $apiSicred)
    {
        $this->apiSicred = $apiSicred;
        $this->modeloPropostaAbaixo = 'capital-de-giro-abaixo';
        $this->modeloPropostaAcima = 'capital-de-giro-acima';
    }

    /**
     * Service Layer - Method responsible for calculating the number
     * of days between the issuance of the proposal and the last
     * maturity of the loan.
     *
     * @param  array  $attributes
     * @return json  $dataProposta
     */
    private function calculaIntervaloUltimoVencimento($attributes)
    {
        $hoje = new DateTime();
        $ultimo_vencimento = new DateTime($attributes['dataPrimeiroVencimento']);
        $ultimo_vencimento->modify('+' . (intVal($attributes['prazo'])-1) . ' month');
        $intervaloDias = $hoje->diff($ultimo_vencimento)->days;

        return $intervaloDias;
    }

    /**
     * Service Layer - Method responsible for defining the proposal
     * model based on the range of days the proposal was issued
     * and the last maturity of the loan.
     *
     * @param  array  $attributes
     * @return string  $modeloProposta
     */
    private function defineModeloProposta($attributes):string
    {
        $intervaloDias = $this->calculaIntervaloUltimoVencimento($attributes);

        if($intervaloDias > 365)
            return $this->modeloPropostaAcima;

        return $this->modeloPropostaAbaixo;
    }

    /**
     * Service Layer - Make a proposal simulation at Sicredi
     *
     * @param  array  $attributes
     * @return json  $dataProposta
     */
    public function novaSimulacao($attributes)
    {
        $modeloProposta = $this->defineModeloProposta($attributes);
        $this->apiSicred->setModeloProposta($modeloProposta);
        return $this->apiSicred->novaSimulacao($attributes);
    }

    /**
     * Service Layer - Get data from a proposal simulation at Sicredi
     *
     * @param  int  $idSimulacao
     * @return json  $dataProposta
     */
    public function show($idSimulacao)
    {
        return $this->apiSicred->exibeSimulacao($idSimulacao);
    }
}
