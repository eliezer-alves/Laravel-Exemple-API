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
class ScpcScoreService extends AbstractGacConsultaService implements GacConsultaServiceInterface
{
    public function __construct($cpf)
    {
        parent::__construct($cpf);
        $this->periodo = 7;
    }

    public function consultar()
    {
        return $this->request('/scpc-score');
    }

    public function consultarById()
    {
        return $this->requestById('/scpc-score');
    }

}
