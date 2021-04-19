<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;
use App\Repositories\Contracts\TipoLogradouroRepositoryInterface;

/**
 * Service Layer - Class responsible for managing the Sicred API access domains
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class DominiosService
{
    protected $apiSicred;
    protected $tipoLogradouroRepository;

    public function __construct(ApiSicredServiceInterface $apiSicred, TipoLogradouroRepositoryInterface $tipoLogradouroRepository)
    {
        $this->apiSicred = $apiSicred;
        $this->tipoLogradouroRepository = $tipoLogradouroRepository;
    }


    /**
     * Service Layer - Get Sicred Domains (varied information)
     *
     * @return array $dominios
     */
    public function dominios()
    {
        $dominios = [];
        $dominios['uf'] = $this->apiSicred->ufDominio();
        $dominios['estadoCivil'] = $this->apiSicred->estadoCivilDominio();
        $dominios['profissao'] = $this->apiSicred->profissaoDominio();
        $dominios['banco'] = $this->apiSicred->bancoDominio();
        $dominios['tipoLogradouro'] = $this->tipoLogradouroRepository->all();

        return $dominios;
    }
}
