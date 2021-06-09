<?php

namespace App\Services;

use App\Repositories\Contracts\ClientSicredRepositoryInterface;
use App\Repositories\Contracts\ModeloSicredRepositoryInterface;
use App\Services\Contracts\ApiSicredServiceInterface;

use App\Exceptions\FailedResquestSicred;
use Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
    private $clientSicred;
    private $modeloSicred;
    private $environment;
    private $modelo;
    private $urls;
    private $empresa;

    public function __construct(ClientSicredRepositoryInterface $clientSicredRepository, ModeloSicredRepositoryInterface $modeloSicredRepository)
    {
        $this->numeroMaximoTentativasRequest = 3;
        $this->environment = 'hml';
        $this->modelo = 'capital-de-giro-abaixo';
        $this->empresa = '01';

        $this->clientSicredRepository = $clientSicredRepository;
        $this->modeloSicredRepository = $modeloSicredRepository;
        $this->clientSicred = $this->clientSicredRepository->findEnvironment($this->environment);
        $this->modeloSicred = $this->modeloSicredRepository->findModelo($this->modelo);
        $this->urls = $this->modeloSicred->urls;
        $this->renovaSessao();
    }

    public function setmodeloProposta($modelo)
    {
        $this->modelo = $modelo;
        $this->modeloSicred = $this->modeloSicredRepository->findModelo($modelo);
        $this->urls = $this->modeloSicred->urls;
        $this->renovaSessao();
    }

    private function urlServico($servico)
    {
        return $this->urls->firstWhere('servico', $servico)->url ?? '';
    }


    /**
     * Requests a new access token at Sicred.
     *
     */
    public function novaSessao()
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urlServico('base_url') . $this->urlServico('athentication_url');

        do {
            $response = Http::asForm()->post($url, $this->clientSicred->toArray());
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            Log::channel('sicred')->critical('Sessão Sicred - Houve um problema ao criar uma nova sessão.', $response->json());
            throw new FailedResquestSicred($response, 'Sessão Sicred - Houve um problema ao criar uma nova sessão.', ['url_servico' => $url, 'status' => $response->status()]);
        }


        Session::put('accessToken', $response['access_token']);
        Session::put('refreshToken', $response['refresh_token']);


        return response($response->body(), $response->status());
    }


    /**
     * Requests renewal of access token at Sicred.
     *
     */
    public function renovaSessao()
    {
        $this->novaSessao();
        return;
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urlServico('base_url') . $this->urlServico('athentication_url');
        $form = $this->clientSicred->toArray();
        $form['grant_type'] = 'refresh_token';
        $form['refresh_token'] = Session::get('refreshToken') ? Session::get('refreshToken') : '';

        do {
            $response = Http::asForm()->post($url, $this->clientSicred->toArray());
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
        $url = $this->urlServico('base_url') . $this->urlServico('simulacao_url') . '/simular';
        $form = array_merge($this->modeloSicred->toArray(), $request);
        do {
            $response = Http::withToken(Session::get('accessToken'))->post($url, $form);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Simulação - Impossibilidado de gerar uma nova simulação.', ['url_servico' => $url, 'status' => $response->status()]);
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
        $url = $this->urlServico('base_url') . $this->urlServico('simulacao_url') . '/' . $this->empresa . '/' . $idSimulacao . '/detalhe';

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Simulação - Impossibilidado de resgatar os dados da simulação.', ['url_servico' => $url, 'status' => $response->status()]);
        }

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
        $url = $this->urlServico('base_url') . $this->urlServico('proposta_url');
        $body = [
            'empresa' => $this->empresa,
            'idSimulacao' => $idSimulacao
        ];

        do {
            $response = Http::withToken(Session::get('accessToken'))->post($url, $body);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Proposta - Impossibilidado de gerar uma nova proposta.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        $numeroProposta = json_decode($response->body())->numeroProposta;

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
        $url = $this->urlServico('base_url') . $this->urlServico('proposta_v2_url') . "/$this->empresa/$numeroProposta" . $this->urlServico('cliente');

        do {
            $response = Http::withToken(Session::get('accessToken'))->post($url, $attributes);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Cliente Proposta - Impossibilitado de vincular clienta à proposta.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
    }


    /**
     * Links bank details to a proposal at Sicred
     *
     * @param array $attributesProposta
     * @param array $attributesCliente
     * @return int $numeroProposta
     */
    public function vincularLiberacoesProposta($attributes, $numeroProposta)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urlServico('base_url') . $this->urlServico('proposta_url') . "/$this->empresa/$numeroProposta/liberacao";

        do {
            $response = Http::withToken(Session::get('accessToken'))->post($url, [$attributes]);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Liberações Proposta - Impossibilitado de vincular liberações à proposta.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
    }

    /**
     * Request detailed data for a proposal at Sicred.
     *
     * @param int $numeroProposta
     * @return Illuminate\Support\Facades\Http
     */
    public function finalizarProposta($numeroProposta)
    {
        $numeroTentativasRequest = 0;
        $response = null;
        $url = $this->urlServico('base_url') . $this->urlServico('proposta_url') . '/' . $this->empresa . '/' . $numeroProposta . '/Finalizar';
        do {
            $response = Http::withToken(Session::get('accessToken'))->put($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Proposta - Impossibilitado de finalizar proposta.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
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
        $url = $this->urlServico('base_url') . $this->urlServico('proposta_url') . '/' . $this->empresa . '/' . $numeroProposta;
        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Proposta - Impossibilitado de resgatar os dados da proposta.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
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
        $url = $this->urlServico('base_url') . $this->urlServico('proposta_url') . '/' . $this->empresa . "/$numeroProposta/liberacao";

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && ($numeroTentativasRequest <= $this->numeroMaximoTentativasRequest));

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Liberações Proposta - Impossibilitado de resgatar os dados de liberações da proposta.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
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
        $url = $this->urlServico('base_url') . $this->urlServico('dominios') . '/uf';

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Domínios: indisponibilidade de resgatar uf\'s.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
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
        $url = $this->urlServico('base_url') . $this->urlServico('dominios') . '/EstadoCivil/' . $this->empresa;

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Domínios: indisponibilidade de resgatar estados civis.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
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
        $url = $this->urlServico('base_url') . $this->urlServico('dominios') . '/profissao/' . $this->empresa;

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Domínios: indisponibilidade de resgatar profissões.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
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
        $url = $this->urlServico('base_url') . '/registroboletoapi/api/Banco';

        do {
            $response = Http::withToken(Session::get('accessToken'))->get($url);
            $numeroTentativasRequest++;
        } while (($response->status() != 200) && $numeroTentativasRequest <= $this->numeroMaximoTentativasRequest);

        if ($response->status() != 200) {
            throw new FailedResquestSicred($response, 'Domínios: indisponibilidade de resgatar instituições bancárias.', ['url_servico' => $url, 'status' => $response->status()]);
        }

        return json_decode($response->body());
    }
}
