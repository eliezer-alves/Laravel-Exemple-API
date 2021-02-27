<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;

class SimulacaoService
{
	protected $apiSicred;

	public function __construct(ApiSicredServiceInterface $apiSicred)
	{
		$this->apiSicred = $apiSicred;
	}

	public function simular()
	{
		$parms = [
			'empresa' => '01',
			'agencia' => '0001',
			'cpf' => '77511565620',
			'lojista' => '000002',
			'loja' => '0001',
			'dataInicio' => '2021-02-26',
			'dataPrimeiroVencimento' => '2021-03-26',
			'produto' => '000078',
			'plano' => '0041',
			'prazo' => 0,
			'valorSolicitado' => 200,
			'valorParcela' => 0,
			'valorSeguro' => 0,
			'taxa' => 9.99,
			'prazoMin' => 0,
			'prazoMax' => 0
		];
		// $response = $this->apiSicred->exibeSimulacao();
		$response = $this->apiSicred->novaSimulacao($parms);

		return $response;
	}
}
