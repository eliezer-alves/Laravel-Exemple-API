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
		$form = [
			'grant_type' => $this->clientSicredRepository->grant_type,
			'username' => $this->clientSicredRepository->username,
			'password' => $this->clientSicredRepository->password,
			'client_id' => $this->clientSicredRepository->client_id,
			'client_secret' => $this->clientSicredRepository->client_secret,
			'scope' => $this->clientSicredRepository->scope,
		];
		$url = $this->urls->base_url . $this->urls->athentication_url;
		$response = Http::asForm()->post($url, $form);

		$this->accessToken = $response['access_token'];
	}

	public function novaSimulacao($parms)
	{
		$this->novaSessao();
		$url = $this->urls->base_url . $this->urls->simulacao_url . 'simular';
		$response = Http::withToken($this->accessToken)->post($url, $parms);

		return $response;
	}

	public function exibeSimulacao()
	{
		return $this->clientSicredRepository;
	}
}
