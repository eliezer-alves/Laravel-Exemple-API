<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RequestSicredService
{
	protected $accessToken;
	protected $grant_type;
	protected $username;
	protected $password;
	protected $client_id;
	protected $client_secret;
	protected $scope;
	protected $baseUrl = 'https://sicred-api-hml.agil.com.br';
	protected $urlSimulacao = '/simulacao/api/simulacao/simular';

	public function createSession()
	{
		$url = $this->baseUrl . '/auth/connect/token';
		$form = [
			'grant_type' => 'password',
			'username' => 'master',
			'password' => 'MASTER123',
			'client_id' => 'sicred-client',
			'client_secret' => '49e8a585-3785-42ca-b4da-a10b6300776f',
			'scope' => 'sicred.usuario'
		];

		$response = Http::asForm()->post($url, $form);

		$this->accessToken = $response['access_token'];
	}

	public function simular($parms)
	{
		$this->createSession();
		$response = Http::withToken($this->accessToken)->post($this->baseUrl . $this->urlSimulacao, $parms);

		return $response;
	}
}
