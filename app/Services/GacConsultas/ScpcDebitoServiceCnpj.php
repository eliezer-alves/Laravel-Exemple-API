<?php

namespace App\Services\GacConsultas;

use App\Services\Contracts\GacConsultaServiceInterface;
use App\Services\GacConsultas\AbstractGacConsultaService;

/**
 * Service Layer - Class responsible for managing InfoMais queries
 *
 * @author Eliezer Alves
 * @since 31/05/2021
 *
 */
class ScpcDebitoServiceCnpj extends AbstractGacConsultaService implements GacConsultaServiceInterface
{
    public function __construct($cnpj)
    {
        parent::__construct($cnpj);
        $this->periodo = 15;
    }

    public function consultar()
    {
        return $this->request('/scpc/cnpj');
    }

    public function consultarById()
    {
        return $this->requestById('/scpc/cnpj');
    }
}
