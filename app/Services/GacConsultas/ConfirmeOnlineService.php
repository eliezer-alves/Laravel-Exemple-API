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
class ConfirmeOnlineService extends AbstractGacConsultaService implements GacConsultaServiceInterface
{
    public function __construct($cpfCnpj)
    {
        parent::__construct($cpfCnpj);
        $this->periodo = 7;
    }

    public function consultar()
    {
        return $this->request('/confirme-online');
    }

    public function consultarById()
    {
        return $this->requestById('/confirme-online');
    }
}
