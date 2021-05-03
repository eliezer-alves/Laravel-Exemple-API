<?php

namespace App\Repositories\Contracts;

interface PropostaRepositoryInterface extends AbstractRepositoryInterface
{
    public function findByNumero(int $numeroProposta);
}
