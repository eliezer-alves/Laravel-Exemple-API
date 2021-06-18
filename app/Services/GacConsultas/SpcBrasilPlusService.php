<?php

namespace App\Services\GacConsultas;

use App\Services\Contracts\GacConsultaServiceInterface;
use App\Services\GacConsultas\AbstractGacConsultaService;

/**
 * Service Layer - Class responsible for managing InfoMais queries
 *
 * @author Eliezer Alves
 * @since 17/06/2021
 *
 */
class SpcBrasilPlusService extends AbstractGacConsultaService implements GacConsultaServiceInterface
{
    public function __construct($cpfCnpj)
    {
        parent::__construct($cpfCnpj);
        $this->periodo = 15;
        $this->setMotivo(2);//BRASIL CARD - POIS PARA ESSA CONSULTA NÃO EXISTE USUÁRIO PARA A ÀGIL
    }

    public function consultar()
    {
        return $this->request('/spc-brasil-plus');
    }

    public function consultarById()
    {
        return $this->requestById('/spc-brasil-plus');
    }

}
