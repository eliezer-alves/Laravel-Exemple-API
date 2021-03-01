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

	public function store($request)
	{
		return $this->apiSicred->novaSimulacao($request);
	}

	public function show($idSimulacao)
	{
		return $this->apiSicred->exibeSimulacao($idSimulacao);
	}
}
