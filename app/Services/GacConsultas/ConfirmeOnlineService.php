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
    }

    public function consultar()
    {
        return $this->request('/confirme-online');
    }
}
