<?php

namespace App\Services\Contracts;

interface ApiSicredServiceInterface
{
    public function novaSessao();

    public function novaSimulacao(array $parms);

    public function exibeSimulacao(int $idSimulacao);

    public function novaProposta(int $idSimulacao);

    public function vincularClienteProposta(array $attributes, int $numeroProposta);

    public function exibeProposta(int $numeroProposta);

    public function ufDominio();

    public function estadoCivilDominio();

    public function profissaoDominio();

    public function bancoDominio();
}
