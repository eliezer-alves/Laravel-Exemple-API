<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;
use App\Services\{
    ClienteService
};

class PropostaService
{
    private $apiSicred;
    private $clienteService;

    public function __construct(ApiSicredServiceInterface $apiSicred, ClienteService $clienteService)
    {
        $this->apiSicred = $apiSicred;
        $this->clienteService = $clienteService;
    }

    /**
     * Service Layer - Creates a new Agile Proposal from the data in a request
     *
     * @param  array  $attributes
     * @return json  $dataProposta
     */
    public function novaProposta($attributes)
    {
        $attributesProposta = $attributes['proposta'];
        $attributesCliente = $attributes['cliente'];
        $attributesSocios = $attributes['socios'];

        // $cliente = $this->clienteService->create($attributesCliente);
        $numeroProposta = $this->apiSicred->novaProposta($attributesProposta['idSimulacao']);
        return  $this->apiSicred->vincularClienteProposta($attributesCliente, $numeroProposta);
    }


    /**
     * Service Layer - Fetch data from a proposal at Sicred
     *
     * @param  int  $numeroProposta
     * @return json  $dataProposta
     */
    public function exibeProposta($numeroProposta)
    {
        return $this->apiSicred->exibeProposta($numeroProposta);
    }
}
