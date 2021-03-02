<?php

namespace App\Repositories\Eloquent;

use App\Models\TipoLogradouro;
use App\Repositories\Contracts\TipoLogradouroRepositoryInterface;

class TipoLogradouroRepository extends AbstractRepository implements TipoLogradouroRepositoryInterface
{
    public function __construct(TipoLogradouro $model)
    {
        parent::__construct($model);
    }
}
