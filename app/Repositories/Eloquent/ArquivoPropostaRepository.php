<?php

namespace App\Repositories\Eloquent;

use App\Models\ArquivoProposta;
use App\Repositories\Contracts\ArquivoPropostaRepositoryInterface;

class ArquivoPropostaRepository extends AbstractRepository implements ArquivoPropostaRepositoryInterface
{
    public function __construct(ArquivoProposta $model)
    {
        parent::__construct($model);
    }
}
