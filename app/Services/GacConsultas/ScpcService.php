<?php

namespace App\Services\GacConsultas;

use App\Exceptions\FailedRequestGacConsultas;
use App\Services\GacConsultas\AbstractConsultasService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service Layer - Class responsible for managing InfoMais queries
 *
 * @author Eliezer Alves
 * @since 31/05/2021
 *
 */
class ScpcService extends AbstractConsultasService
{
    public function __construct()
    {
        parent::__construct();
    }


    private function request($attributes, $urlServico)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = "{$this->baseUrl}/{$urlServico}";

        do {
            $response = Http::get($url, $attributes);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            Log::channel('gacConsultas')->critical("SCPC - Erro ao consultar {$urlServico}.", $response->json());
            // throw new FailedRequestGacConsultas($response, "SCPC - Erro ao consultar {$urlServico}.", ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
    }



    public function debito($cpf, $periodo = 1, $motivo = 1)
    {
        $attributes = [
            'cpf' => $cpf,
            'motivo' => $motivo,
            'periodo' => $periodo
        ];

        return $this->request($attributes, 'scpc-debito');
    }

    public function score($cpf, $periodo = 1, $motivo = 1)
    {
        $attributes = [
            'cpf' => $cpf,
            'motivo' => $motivo,
            'periodo' => $periodo
        ];

        return $this->request($attributes, 'scpc-score');
    }

}
