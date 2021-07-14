<?php

namespace App\Repositories\Contracts;

interface EmpresaRepositoryInterface extends AbstractRepositoryInterface
{

    public function findByCnpj(int $cnpj);
}
