<?php

namespace App\Services;

use App\Repositories\Contracts\ClientSicredRepositoryInterface;
use App\Repositories\Contracts\ModeloSicredRepositoryInterface;
use App\Services\Contracts\ApiSicredServiceInterface;

use App\Exceptions\FailedResquestSicred;
use Session;
use Illuminate\Support\Facades\Http;

/**
 * Service Layer - Class responsible for managing requests for Sicred's API
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class ApiSicredService implements ApiSicredServiceInterface
{
    private $numeroMaximoTentativasRequest;
    private $clientSicredRepository;
    private $modeloSicredRepository;
    private $environment;
    private $modelo;
    private $urls;
    private $empresa;

    public function __construct(ClientSicredRepositoryInterface $clientSicredRepository, ModeloSicredRepositoryInterface $modeloSicredRepository)
    {
        $this->numeroMaximoTentativasRequest = 3;
        $this->environment = 'hml';
        $this->modelo = 'capital-de-giro';
        // $this->modelo = 'pessoa-fisica-1';
        $this->empresa = '01';

        $this->clientSicredRepository = $clientSicredRepository->findEnvironment($this->environment);
        $this->modeloSicredRepository = $modeloSicredRepository->findModelo($this->modelo);
        $this->urls = $this->clientSicredRepository->urls;
        $this->renovaSessao();
    }


    /**
     * Requests a new access token at Sicred.
     *
     */
    public function novaSessao()
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->athentication_url;

        do {
            $response = Http::asForm()->post($url, $this->clientSicredRepository->toArray());
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() == 200) {
            Session::put('accessToken', $response['access_token']);
            Session::put('refreshToken', $response['refresh_token']);
        }

        return response($response->body(), $response->status());
    }


    /**
     * Requests renewal of access token at Sicred.
     *
     */
    public function renovaSessao()
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->athentication_url;
        $form = $this->clientSicredRepository->toArray();
        $form['grant_type'] = 'refresh_token';
        $form['refresh_token'] = Session::get('refreshToken') ? Session::get('refreshToken') : '';

        do {
            $response = Http::asForm()->post($url, $this->clientSicredRepository->toArray());
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() == 200) {
            Session::put('accessToken', $response['access_token']);
            Session::put('refreshToken', $response['refresh_token']);
        } else {
            $this->novaSessao();
        }
    }


    /**
     * Request a new proposal at Sicred.
     *
     * @return Illuminate\Support\Facades\Http
     */
    public function novaSimulacao($request)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->simulacao_url . '/simular';
        $form = array_merge($this->modeloSicredRepository->toArray(), $request);

        do {
            $response = Http::withToken(Session::get('accessToken'))->post($url, $form);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200 || true) {
            // if (empty($response->body()) || $response->body() != null || true) {
            //     return response(["message" => "Foram feitas " . $numeroTentativasRequest . " requisições porém nenhuma com sucesso! Tente novamente!"], $response->status());
            // }
            // return response($response->body(), $response->status());

            throw new FailedResquestSicred($response);
        }

        return response($response->body(), $response->status());
    }


    /**
     * Request detailed data for a proposal simulation at Sicred.
     *
     * @return Illuminate\Support\Facades\Http
     */
    public function exibeSimulacao($idSimulacao)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->simulacao_url . '/' . $this->empresa . '/' . $idSimulacao . '/detalhe';

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        return response($response->body(), $response->status());
    }


    /**
     * Create a new proposal at Sicred.
     *
     * @param int $idSimulacao
     * @return int $numeroProposta
     */
    public function novaProposta($idSimulacao)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $numeroProposta = false;
        $url = $this->urls->base_url . $this->urls->proposta_url;
        $body = [
            'empresa' => $this->empresa,
            'idSimulacao' => $idSimulacao
        ];

        do {
            $response = Http::withToken(Session::get('accessToken'))->post($url, $body);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() == 200) {
            $numeroProposta = json_decode($response->body())->numeroProposta;
        }

        return $numeroProposta;
    }


    /**
     * Links a customer to the proposal at Sicred
     *
     * @param array $attributes
     * @return int $numeroProposta
     */
    public function vincularClienteProposta($attributes, $numeroProposta)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->proposta_url . "/$this->empresa/$numeroProposta/cliente";

        $attributes['cosif'] = $this->modeloSicredRepository->cosif;

        do {
            $response = Http::withToken(Session::get('accessToken'))->post($url, $attributes);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() == 200) {
            return json_decode($response->body());
        }

        return $response;
    }


    /**
     * Links bank details to a proposal at Sicred
     *
     * @param array $attributesProposta
     * @param array $attributesCliente
     * @return int $numeroProposta
     */
    public function vincularLibercoesProposta($attributes, $numeroProposta)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->proposta_url . "/$this->empresa/$numeroProposta/liberacao";

        do {
            $response = Http::withToken(Session::get('accessToken'))->post($url, [$attributes]);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        return $response;
    }


    /**
     * Request detailed data for a proposal at Sicred.
     *
     * @param int $numeroProposta
     * @return Illuminate\Support\Facades\Http
     */
    public function dadosProposta($numeroProposta)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->proposta_url . '/' . $this->empresa . '/' . $numeroProposta;
        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() == 200) {
            return  json_decode($response->body());
        }

        return false;
    }


    /**
     * Request bank details for a proposal at Sicred.
     *
     * @param int $numeroProposta
     * @return Illuminate\Support\Facades\Http
     */
    public function exibeLiberacoesProposta($numeroProposta)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->proposta_url . '/' . $this->empresa . "/$numeroProposta/liberacao";

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && ($numeroTentativasRequest <= $this->numeroMaximoTentativasRequest));

        if ($response->status() == 200) {
            return  json_decode($response->body())[0];
        }

        return $response;
    }


    /**
     * Request list of Sicredi marital federative unit (UF).
     *
     * @return array
     */
    public function ufDominio()
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->dominios_url . '/uf';

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        return $response->json();
    }


    /**
     * Request list of Sicredi marital status.
     *
     * @return array
     */
    public function estadoCivilDominio()
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->dominios_url . '/EstadoCivil/' . $this->empresa;

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        return $response->json();
    }


    /**
     * Request list of Sicredi professions.
     *
     * @return array
     */
    public function profissaoDominio()
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . $this->urls->dominios_url . '/profissao/' . $this->empresa;

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        return $response->json();
    }


    /**
     * Request list of Sicredi banks.
     *
     * @return array
     */
    public function bancoDominio()
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urls->base_url . '/registroboletoapi/api/Banco';

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        return $response->json();
    }
}
