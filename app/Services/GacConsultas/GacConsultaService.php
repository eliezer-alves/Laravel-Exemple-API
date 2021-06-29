<?php

namespace App\Services\GacConsultas;

use App\Services\Contracts\GacConsultaServiceInterface;

class GacConsultaService
{
    public static function consultar(GacConsultaServiceInterface $orgaoConsulta)
    {
        return $orgaoConsulta->consultar();
    }

    public static function consultarById(GacConsultaServiceInterface $orgaoConsulta)
    {
        return $orgaoConsulta->consultarById();
    }
}
