<?php

namespace App\Services\GacConsultas;

/**
 * Service Layer - Class responsible for managing as requests for the GAC Query API Queries
 *
 * @author Eliezer Alves
 * @since 31/05/2021
 *
 */
class AbstractConsultasService
{
    protected $numeroMaximoTentativasRequest;
    protected $baseUrl;

    public function __construct()
    {
        $this->numeroMaximoTentativasRequest = 3;
        // $this->baseUrl = env('BASE_URL_GAC_CONSULTAS');
        $this->baseUrl = 'https://api-consultas-prod.agil.com.br';
    }
}

