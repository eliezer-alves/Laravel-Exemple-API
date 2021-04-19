<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;

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

    public function __construct(ApiSicredServiceInterface $apiSicred)
    {
        $this->apiSicred = $apiSicred;
    }

    /**
     * Service Layer - Make a proposal simulation at Sicredi
     *
     * @param  array  $attributes
     * @return json  $dataProposta
     */
    public function novaSimulacao($attributes)
    {
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
