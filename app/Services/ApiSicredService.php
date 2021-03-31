<?php

namespace App\Services;

use App\Repositories\Contracts\ClientSicredRepositoryInterface;
use App\Repositories\Contracts\ModeloSicredRepositoryInterface;
use App\Services\Contracts\ApiSicredServiceInterface;

use Session;
use Illuminate\Support\Facades\Http;

class ApiSicredService implements ApiSicredServiceInterface
{
    protected $clientSicredRepository;
    protected $modeloSicredRepository;
    protected $environment = 'hml';
    protected $modelo = 'capital-de-giro';
    protected $urls;

    protected $empresa = '01';

    public function __construct(ClientSicredRepositoryInterface $clientSicredRepository, ModeloSicredRepositoryInterface $modeloSicredRepository)
    {
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
        $url = $this->urls->base_url . $this->urls->athentication_url;
        $response = Http::asForm()->post($url, $this->clientSicredRepository->toArray());

        Session::put('accessToken', $response['access_token']);
        Session::put('refreshToken', $response['refresh_token']);
        return $response;
    }

    /**
     * Requests renewal of access token at Sicred.
     *
     */
    public function renovaSessao()
    {
        $url = $this->urls->base_url . $this->urls->athentication_url;
        $form = $this->clientSicredRepository->toArray();
        $form['grant_type'] = 'refresh_token';
        $form['refresh_token'] = Session::get('refreshToken') ? Session::get('refreshToken') : '';
        $response = Http::asForm()->post($url, $this->clientSicredRepository->toArray());

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
        $url = $this->urls->base_url . $this->urls->simulacao_url . '/simular';
        $form = array_merge($this->modeloSicredRepository->toArray(), $request);
        $response = Http::withToken(Session::get('accessToken'))->post($url, $form);

        return response($response->body(), $response->status());
    }

    /**
     * Request detailed data for a proposal simulation at Sicred.
     *
     * @return Illuminate\Support\Facades\Http
     */
    public function exibeSimulacao($idSimulacao)
    {
        $url = $this->urls->base_url . $this->urls->simulacao_url . '/' . $this->empresa . '/' . $idSimulacao . '/detalhe';

        $response = Http::withToken(Session::get('accessToken'))->get($url);
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
        $url = $this->urls->base_url . $this->urls->proposta_url;
        $body = [
            'empresa' => $this->empresa,
            'idSimulacao' => $idSimulacao
        ];

        $response = Http::withToken(Session::get('accessToken'))->post($url, $body);
        $numeroProposta = json_decode($response->body())->numeroProposta;

        return $numeroProposta;
    }


    /**
     * Links a customer to the proposal at Sicred
     *
     * @param array $attributes
     * @param int $numeroProposta
     * @return int $numeroProposta
     */
    public function vincularClienteProposta($attributes, $numeroProposta)
    {
        $url = $this->urls->base_url . $this->urls->proposta_url . "/$this->empresa/$numeroProposta";
        $body = [
            'cnpj' => $attributes['cnpj'],
            'razaoSocial' => $attributes['razao_social'],
            'fundacao' => $attributes['data_fundacao'],
            // 'cosif' => $attributes['cosif'],
            'inscricaoEstadual' => $attributes['inscricao_estadual'],
            // 'capitalSocial'=> $attributes['capitalSocial'],
            // 'numeroFuncionarios'=> $attributes['numeroFuncionarios'],
            // 'anoFaturamento'=> $attributes['anoFaturamento'],
            // 'valorFaturamentoAnual'=> $attributes['valorFaturamentoAnual'],
            // 'porte'=> $attributes['porte'],
            'email' => $attributes['email'],
            'cepResidencial' => $attributes['cep'],
            'enderecoResidencial' => $attributes['logradouro'],
            'numeroResidencial' => $attributes['numero'],
            'complementoResidencial' => $attributes['complemento'],
            'bairroResidencial' => $attributes['bairro'],
            'cidadeResidencial' => $attributes['cidade'],
            'ufResidencial' => $attributes['uf']
            // 'codigoExterno'=> $attributes['codigoExterno'],
            // 'dataInclusao'=> $attributes['dataInclusao'],
        ];

        $response = Http::withToken(Session::get('accessToken'))->post($url, $body);
        return $response;
    }


    /**
     * Links bank details to a proposal at Sicred
     *
     * @param array $attributes
     * @return int $numeroProposta
     */
    public function vincularLibercoesProposta($idSimulacao)
    {
        return 0;
    }


    /**
     * Request detailed data for a proposal at Sicred.
     *
     * @param int $numeroProposta
     * @return Illuminate\Support\Facades\Http
     */
    public function exibeProposta($numeroProposta)
    {
        $url = $this->urls->base_url . $this->urls->proposta_url . '/' . $this->empresa . '/' . $numeroProposta;

        $response = Http::withToken(Session::get('accessToken'))->get($url);
        return response($response->body(), $response->status());
    }

    /**
     * Request list of Sicredi marital federative unit (UF).
     *
     * @return array
     */
    public function ufDominio()
    {
        $url = $this->urls->base_url . $this->urls->dominios_url . '/uf';
        $response = Http::withToken(Session::get('accessToken'))->get($url);
        return $response->json();
    }

    /**
     * Request list of Sicredi marital status.
     *
     * @return array
     */
    public function estadoCivilDominio()
    {
        $url = $this->urls->base_url . $this->urls->dominios_url . '/EstadoCivil/' . $this->empresa;

        $response = Http::withToken(Session::get('accessToken'))->get($url);
        return $response->json();
    }

    /**
     * Request list of Sicredi professions.
     *
     * @return array
     */
    public function profissaoDominio()
    {
        $url = $this->urls->base_url . $this->urls->dominios_url . '/profissao/' . $this->empresa;
        $response = Http::withToken(Session::get('accessToken'))->get($url);
        return $response->json();
    }

    /**
     * Request list of Sicredi banks.
     *
     * @return array
     */
    public function bancoDominio()
    {
        $url = $this->urls->base_url . '/registroboletoapi/api/Banco';
        $response = Http::withToken(Session::get('accessToken'))->get($url);
        return $response->json();
    }
}
