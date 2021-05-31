<?php

namespace App\Repositories\Contracts;

interface AnalisePessoaPropostaRepositoryInterface  extends AbstractRepositoryInterface
{
    public function findAnaliseAndPessoa(int $idAnalisePropostas, int $idPessoaAssinatura);
}
