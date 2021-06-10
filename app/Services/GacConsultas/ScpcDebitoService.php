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
class ScpcDebitoService extends AbstractGacConsultaService implements GacConsultaServiceInterface
{
    public function __construct($cpf)
    {
        parent::__construct($cpf);
    }

    public function consultar()
    {
        return $this->request('/scpc-debito');
    }

    public function consultarById()
    {
        return $this->requestById('/scpc-debito');
    }
}
