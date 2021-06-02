<?php

namespace App\Repositories\Contracts;

interface AnalisePessoaPropostaRepositoryInterface  extends AbstractRepositoryInterface
{
    public function findByAnaliseAndPessoa(int $idAnalisePropostas, int $idPessoaAssinatura);

    /**
     * Repository Layer - Method responsible for record the analysis of the person referring to the proposal
     *
     * @param  array  $attributes
     * @return App\Repositories\AnalisePessoaPropostaRepository
     */
    public function registrarAnalisePessoaProposta(array $attributes);
}
