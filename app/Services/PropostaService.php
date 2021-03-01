<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;

class PropostaService
{
    protected $apiSicred;

    public function __construct(ApiSicredServiceInterface $apiSicred)
    {
        $this->apiSicred = $apiSicred;
    }

    public function novaProposta($request)
    {
        return $this->apiSicred->novaProposta($request);
    }

    public function exibeProposta($numeroProposta)
    {
        return $this->apiSicred->exibeProposta($numeroProposta);
    }
}
