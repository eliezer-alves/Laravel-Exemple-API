<?php

namespace App\Services\GacConsultas;

use App\Services\Contracts\GacConsultaServiceInterface;

class GacConsultaService
{
    public function consultar(GacConsultaServiceInterface $orgaoConsulta)
    {
        return $orgaoConsulta->consultar();
    }

    public function consultarById(GacConsultaServiceInterface $orgaoConsulta)
    {
        return $orgaoConsulta->consultarById();
    }
}
