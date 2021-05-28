<?php

namespace App\Repositories\Eloquent;

use App\Models\ModeloSicred;
use App\Repositories\Contracts\ModeloSicredRepositoryInterface;

class ModeloSicredRepository extends AbstractRepository implements ModeloSicredRepositoryInterface
{
    public function __construct(ModeloSicred $model)
    {
        parent::__construct($model);
    }

    public function findModelo($modelo)
    {
        return $this->firstWhere('modelo', $modelo);
    }
}
