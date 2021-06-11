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
class InfoMaisEnderecoService extends AbstractGacConsultaService implements GacConsultaServiceInterface
{
    public function __construct($cpf)
    {
        parent::__construct($cpf);
        $this->periodo = 30;
    }

    public function consultar()
    {
        return $this->request('/info-mais/endereco');
    }

    public function consultarById()
    {
        return $this->requestById('/info-mais/endereco');
    }
}
