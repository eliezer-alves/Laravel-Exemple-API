<?php

namespace App\Services\Contracts;

interface ApiSicredServiceInterface
{
    public function novaSessao();

    public function novaSimulacao(array $parms);

    public function exibeSimulacao(int $idSimulacao);

    public function novaProposta(int $idSimulacao);

    public function vincularClienteProposta(array $attributes, int $numeroProposta);

    public function vincularLiberacoesProposta(array $attributes, int $numeroProposta);

    public function dadosProposta(int $numeroProposta);

    public function exibeLiberacoesProposta(int $numeroProposta);

    public function ufDominio();

    public function estadoCivilDominio();

    public function profissaoDominio();

    public function bancoDominio();
}
