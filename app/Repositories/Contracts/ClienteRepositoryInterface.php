<?php

namespace App\Repositories\Contracts;

interface ClienteRepositoryInterface extends AbstractRepositoryInterface
{

    public function findByCnpj(int $cnpj);

    public function findByCpf(int $cnpj);

    public function createWithUser(array $data);
}
