<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;
use App\Repositories\Contracts\AtividadeComercialRepositoryInterface;
use App\Repositories\Contracts\CosifRepositoryInterface;
use App\Repositories\Contracts\PorteEmpresaRepositoryInterface;
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
    protected $atividadeComercialRepository;
    protected $cosifRepository;
    protected $porteEmpresaRepository;
    protected $tipoLogradouroRepository;

    public function __construct(ApiSicredServiceInterface $apiSicred, AtividadeComercialRepositoryInterface $atividadeComercialRepository, CosifRepositoryInterface $cosifRepository, PorteEmpresaRepositoryInterface $porteEmpresaRepository, TipoLogradouroRepositoryInterface $tipoLogradouroRepository)
    {
        $this->apiSicred = $apiSicred;
        $this->atividadeComercialRepository = $atividadeComercialRepository;
        $this->cosifRepository = $cosifRepository;
        $this->porteEmpresaRepository = $porteEmpresaRepository;
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
        $dominios['cosif'] = $this->cosifRepository->all();
        $dominios['porte_empresa'] = $this->porteEmpresaRepository->all();
        $dominios['tipo_logradouro'] = $this->tipoLogradouroRepository->all();
        $dominios['atividade_comercial'] = $this->atividadeComercialRepository->all();

        return $dominios;
    }
}
