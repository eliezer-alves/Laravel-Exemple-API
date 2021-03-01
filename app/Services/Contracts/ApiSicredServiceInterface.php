<?php

namespace App\Services\Contracts;

interface ApiSicredServiceInterface
{
	public function novaSessao();

	public function novaSimulacao(array $parms);

	public function exibeSimulacao(int $idSimulacao);

	public function novaProposta(int $idSimulacao);

	public function exibeProposta(int $numeroProposta);

	public function estadoCivilDominio();
}
