<?php

namespace App\Repositories\Eloquent;

use App\Models\TipoEmpresa;
use App\Repositories\Contracts\TipoEmpresaRepositoryInterface;

class TipoEmpresaRepository extends AbstractRepository implements TipoEmpresaRepositoryInterface
{
    public function __construct(TipoEmpresa $model)
    {
        parent::__construct($model);
    }
}
