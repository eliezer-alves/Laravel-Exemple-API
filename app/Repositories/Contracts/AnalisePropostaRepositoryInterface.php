<?php

namespace App\Repositories\Contracts;

interface AnalisePropostaRepositoryInterface  extends AbstractRepositoryInterface
{
    /**
     * Repository Layer - Method responsible for completing the analysis of the proposal.
     *
     * @param  array  $attributes
     * @param  int  $idProposta
     * @return App\Repositories\AnalisePropostaRepository
     */
    public function registrarAnaliseProposta(array $attributes, int $idProposta);
}
