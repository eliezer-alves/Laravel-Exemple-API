<?php

namespace App\Services;

use App\Repositories\Contracts\ClientSicredRepositoryInterface;
use App\Services\Contracts\ApiSicredServiceInterface;

use Illuminate\Support\Facades\Http;

class ApiSicredService implements ApiSicredServiceInterface
{
	protected $clientSicredRepository;
	protected $environment = 'hml';
	protected $urls;
	protected $accessToken;

	public function __construct(ClientSicredRepositoryInterface $clientSicredRepository)
	{
		$this->clientSicredRepository = $clientSicredRepository->findEnvironment($this->environment);
		$this->urls = $this->clientSicredRepository->urls;
	}

	public function novaSessao()
	{
		$url = $this->urls->base_url . $this->urls->athentication_url;
		$response = Http::asForm()->post($url, $this->clientSicredRepository->toArray());

		$this->accessToken = $response['access_token'];
	}

	public function novaSimulacao($request)
	{
		$this->novaSessao();
		$url = $this->urls->base_url . $this->urls->simulacao_url . 'simular';
		$parms = [
			'empresa' => '01',
			'agencia' => '0001',
			'cpf' => $request['cpf'],
			'lojista' => '000002',
			'loja' => '0001',
			'dataInicio' => '2021-02-26',
			'dataPrimeiroVencimento' => $request['dataPrimeiroVencimento'],
			'produto' => '000080',
			'plano' => '0054',
			'prazo' => $request['prazo'],
			'valorSolicitado' => $request['valorSolicitado'],
			'valorParcela' => 0,
			'valorSeguro' => 0,
			'taxa' => 9.99,
			'prazoMin' => 0,
			'prazoMax' => 0
		];
		$response = Http::withToken($this->accessToken)->post($url, $parms);

		return response($response->body(), $response->status());
	}

	public function exibeSimulacao($idSimulacao)
	{
		$this->novaSessao();
		$url = $this->urls->base_url . $this->urls->simulacao_url . '01/' . $idSimulacao . '/detalhe';

		$response = Http::withToken($this->accessToken)->get($url);
		return response($response->body(), $response->status());
	}
}
