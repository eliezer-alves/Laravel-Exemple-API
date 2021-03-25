<?php
namespace App\Repositories\Contracts;

interface ClienteRepositoryInterface
{

    public function findByCnpj(int $cnpj);

    public function findByCpf(int $cnpj);

}

