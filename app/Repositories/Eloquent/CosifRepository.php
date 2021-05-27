<?php

namespace App\Repositories\Eloquent;

use App\Models\Cosif;
use App\Repositories\Contracts\CosifRepositoryInterface;

class CosifRepository extends AbstractRepository implements CosifRepositoryInterface
{
    public function __construct(Cosif $model)
    {
        parent::__construct($model);
    }
}
