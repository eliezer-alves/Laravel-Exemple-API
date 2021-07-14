<?php

namespace App\Repositories\Eloquent;

use App\Models\Empresa;
use App\Repositories\Contracts\EmpresaRepositoryInterface;

class EmpresaRepository extends AbstractRepository implements EmpresaRepositoryInterface
{

    public function __construct(Empresa $model)
    {
        parent::__construct($model);
    }

    public function findByCnpj($cnpj)
    {
        return $this->firstWhere('cnpj', $cnpj);
    }
}
