<?php

namespace App\Repositories\Eloquent;

use App\Models\PropostaParcela;
use App\Repositories\Contracts\PropostaParcelaRepositoryInterface;

class PropostaParcelaRepository extends AbstractRepository implements PropostaParcelaRepositoryInterface
{
    public function __construct(PropostaParcela $model)
    {
        parent::__construct($model);
    }
}
