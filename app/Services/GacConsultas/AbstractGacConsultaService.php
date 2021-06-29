<?php

namespace App\Services\GacConsultas;

// use App\Services\Contracts\GacConsultaServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service Layer - Class responsible for managing as requests for the GAC Query API Queries
 *
 * @author Eliezer Alves
 * @since 31/05/2021
 *
 */
abstract class AbstractGacConsultaService
{
    private $baseUrl;
    private $numeroMaximoTentativasRequest;
    private $cpfCnpjId;
    private $motivo;
    protected $periodo;

    public function __construct($cpfCnpjId)
    {
        $this->numeroMaximoTentativasRequest = 0;
        $this->baseUrl = 'https://api-consultas-prod.agil.com.br';
        $this->cpfCnpjId = $cpfCnpjId;
        $this->motivo = 1;
        $this->periodo = 30;
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

    public function setcpfCnpjId($cpfCnpjId)
    {
        return $this->cpfCnpjId = $cpfCnpjId;
    }

    protected function request($urlServico, $errorMessage = "Erro ao utilizar serviço GAC Consultas.")
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = "{$this->baseUrl}{$urlServico}";
        $attributes = [
            'cpf' => $this->cpfCnpjId,
            'cnpj' => $this->cpfCnpjId,
            'cpf_cnpj' => $this->cpfCnpjId,
            'documento' => $this->cpfCnpjId,
            'motivo' => $this->motivo,
            'periodo' => $this->periodo
        ];

        do {
            $response = Http::get($url, $attributes);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            Log::channel('gacConsultas')->critical($errorMessage, $response->json());
        }

        return json_decode($response->body());
    }

    protected function requestById($urlServico, $errorMessage = "Erro ao utilizar serviço GAC Consultas.")
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = "{$this->baseUrl}{$urlServico}/{$this->cpfCnpjId}";

        do {
            $response = Http::get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            Log::channel('gacConsultas')->critical($errorMessage, $response->json());
        }

        return json_decode($response->body());
    }
}

