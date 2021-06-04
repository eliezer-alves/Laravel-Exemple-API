<?php

namespace App\Services\GacConsultas;

use App\Services\GacConsultas\AbstractGacConsultaService;

/**
 * Service Layer - Class responsible for managing InfoMais queries
 *
 * @author Eliezer Alves
 * @since 31/05/2021
 *
 */
class ScpcService extends AbstractGacConsultaService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function debito($cpf)
    {
        return $this->request('/scpc-debito', $cpf);
    }

    public function score($cpf)
    {
        return $this->request('/scpc-score', $cpf);
    }

}
