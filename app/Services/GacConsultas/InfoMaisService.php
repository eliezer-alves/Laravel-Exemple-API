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
class InfoMaisService extends AbstractGacConsultaService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function endereco($cpf)
    {
        $this->cpf_cnpj = $cpf;
        return $this->request('/info-mais/endereco', $cpf);
    }

    public function telefone($cpf)
    {
        $this->cpf_cnpj = $cpf;
        return $this->request('/info-mais/telefone', $cpf);
    }

    public function situacao($cpf)
    {
        $this->cpf_cnpj = $cpf;
        return $this->request('/info-mais/situacao', $cpf);
    }

}
