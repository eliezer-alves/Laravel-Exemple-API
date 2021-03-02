<?php

namespace App\Repositories\Contracts;

interface ModeloSicredRepositoryInterface extends AbstractRepositoryInterface
{
    public function findModelo(string $modelo);
}
