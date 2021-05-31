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
class InfoMaisService extends AbstractConsultasService
{
    public function __construct()
    {
        parent::__construct();
    }


    private function request($attributes, $urlServico)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = "{$this->baseUrl}/info-mais/{$urlServico}";

        do {
            $response = Http::get($url, $attributes);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            Log::channel('gacConsultas')->critical("Info Mais - Erro ao consultar endereço {$urlServico}.", $response->json());
            // throw new FailedRequestGacConsultas($response, "Info Mais - Erro ao consultar endereço {$urlServico}.", ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
    }



    public function endereco($cpf, $periodo = 1, $motivo = 1)
    {
        $attributes = [
            'cpf' => $cpf,
            'motivo' => $motivo,
            'periodo' => $periodo
        ];

        return $this->request($attributes, 'endereco');
    }

    public function telefone($cpf, $periodo = 1, $motivo = 1)
    {
        $attributes = [
            'cpf' => $cpf,
            'motivo' => $motivo,
            'periodo' => $periodo
        ];

        return $this->request($attributes, 'telefone');
    }

    public function situacao($cpf, $periodo = 1, $motivo = 1)
    {
        $attributes = [
            'cpf' => $cpf,
            'motivo' => $motivo,
            'periodo' => $periodo
        ];

        return $this->request($attributes, 'situacao');
    }

}
