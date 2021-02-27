<?php

namespace App\Services\Contracts;

interface ApiSicredServiceInterface
{
	public function novaSessao();

	public function novaSimulacao(array $parms);

	public function exibeSimulacao(int $idSimulacao);
}
