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
class DebitosService extends AbstractGacConsultaService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function consulta($cpf)
    {
        return $this->request('/debitos', $cpf);
    }

}
