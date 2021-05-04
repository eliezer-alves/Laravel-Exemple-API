<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\AbstractRepositoryInterface;

interface PessoaAssinaturaRepositoryInterface extends AbstractRepositoryInterface
{
    public function findRepresentanteByCnpj(int $cnpj);

    public function assinaturasPendentes(int $idProposta);
}
