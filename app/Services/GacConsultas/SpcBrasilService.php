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
class SpcBrasilService extends AbstractGacConsultaService implements GacConsultaServiceInterface
{
    public function __construct($cpf)
    {
        parent::__construct($cpf);
    }

    public function consultar()
    {
        return $this->request('/spc-brasil');
    }

    public function consultarById()
    {
        return $this->requestById('/spc-brasil');
    }

}
