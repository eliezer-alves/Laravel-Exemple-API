<?php

namespace App\Services\GacConsultas;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service Layer - Class responsible for managing as requests for the GAC Query API Queries
 *
 * @author Eliezer Alves
 * @since 31/05/2021
 *
 */
class AbstractGacConsultaService
{
    private $baseUrl;
    private $motivo;
    private $numeroMaximoTentativasRequest;
    protected $periodo;

    public function __construct()
    {
        $this->numeroMaximoTentativasRequest = 3;
        $this->baseUrl = 'https://api-consultas-prod.agil.com.br';
        $this->motivo = 1;
        $this->periodo = 7;
    }

    public function setNumeroMaximoTentativasRequest($numeroMaximoTentativasRequest)
    {
        return $this->numeroMaximoTentativasRequest = $numeroMaximoTentativasRequest;
    }

    public function setMotivo($motivo)
    {
        return $this->motivo = $motivo;
    }

    public function setPeriodo($periodo)
    {
        return $this->periodo = $periodo;
    }

    protected function request($urlServico, $cpf_cnpj, $errorMessage = "Erro ao utilizar serviço GAC Consultas.")
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = "{$this->baseUrl}{$urlServico}";
        $attributes = [
            'cpf' => $cpf_cnpj,
            'cpf_cnpj' => $cpf_cnpj,
            'motivo' => $this->motivo,
            'periodo' => $this->periodo
        ];

        do {
            $response = Http::get($url, $attributes);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            Log::channel('gacConsultas')->critical($errorMessage, $response->json());
            // throw new FailedRequestGacConsultas($response, "{$errorMessage}.", ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
    }
}

