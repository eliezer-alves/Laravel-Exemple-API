<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;

class DominiosService
{
    protected $apiSicred;

    public function __construct(ApiSicredServiceInterface $apiSicred)
    {
        $this->apiSicred = $apiSicred;
    }

    public function dominios()
    {
        return $this->apiSicred->estadoCivilDominio();
    }
}
