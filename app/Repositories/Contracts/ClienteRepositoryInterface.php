<?php

namespace App\Repositories\Contracts;

interface ClienteRepositoryInterface extends AbstractRepositoryInterface
{

    public function findByCnpj(int $cnpj);

    public function findByCpf(int $cpf);

    public function createWithUser(array $data);
}
