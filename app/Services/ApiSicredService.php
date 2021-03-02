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

	public function novaSessao()
	{
		$url = $this->urls->base_url . $this->urls->athentication_url;
		$response = Http::asForm()->post($url, $this->clientSicredRepository->toArray());

		Session::put('accessToken', $response['access_token']);
		Session::put('refreshToken', $response['refresh_token']);
		return $response;
	}

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

	public function novaSimulacao($request)
	{
		$url = $this->urls->base_url . $this->urls->simulacao_url . '/simular';
		$form = array_merge($this->modeloSicredRepository->toArray(), $request);
		$response = Http::withToken(Session::get('accessToken'))->post($url, $form);

		return response($response->body(), $response->status());
	}

	public function exibeSimulacao($idSimulacao)
	{
		$url = $this->urls->base_url . $this->urls->simulacao_url . '/' . $this->empresa . '/' . $idSimulacao . '/detalhe';

		$response = Http::withToken(Session::get('accessToken'))->get($url);
		return response($response->body(), $response->status());
	}

	public function novaProposta($request)
	{
		$this->novaSessao();
		$url = $this->urls->base_url . $this->urls->proposta_url;
		$body = [
			'empresa' => '01',
			'idSimulacao' => $request['idSimulacao']
		];

		$response = Http::withToken(Session::get('accessToken'))->post($url, $body);
		return response($response->body(), $response->status());
	}

	public function exibeProposta($numeroProposta)
	{
		$url = $this->urls->base_url . $this->urls->proposta_url . '/' . $this->empresa . '/' . $numeroProposta;

		$response = Http::withToken(Session::get('accessToken'))->get($url);
		return response($response->body(), $response->status());
	}

	public function ufDominio()
	{
		$url = $this->urls->base_url . $this->urls->dominios_url . '/uf';
		$response = Http::withToken(Session::get('accessToken'))->get($url);
		return $response->json();
	}

	public function estadoCivilDominio()
	{
		$url = $this->urls->base_url . $this->urls->dominios_url . '/EstadoCivil/' . $this->empresa;

		$response = Http::withToken(Session::get('accessToken'))->get($url);
		return $response->json();
	}

	public function profissaoDominio()
	{
		$url = $this->urls->base_url . $this->urls->dominios_url . '/profissao/' . $this->empresa;

		$response = Http::withToken(Session::get('accessToken'))->get($url);
		return $response->json();
	}

	public function bancoDominio()
	{
		$url = $this->urls->base_url . '/registroboletoapi/api/Banco';

		$response = Http::withToken(Session::get('accessToken'))->get($url);
		return $response->json();
	}
}
