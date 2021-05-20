<?php

namespace App\Repositories\Eloquent;

use App\Models\PorteEmpresa;
use App\Repositories\Contracts\PorteEmpresaRepositoryInterface;

class PorteEmpresaRepository extends AbstractRepository implements PorteEmpresaRepositoryInterface
{
    public function __construct(PorteEmpresa $model)
    {
        parent::__construct($model);
    }
}
