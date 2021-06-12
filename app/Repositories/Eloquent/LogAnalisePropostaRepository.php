<?php

namespace App\Repositories\Eloquent;

use App\Models\LogAnaliseProposta;
use App\Repositories\Contracts\LogAnalisePropostaRepositoryInterface;

class LogAnalisePropostaRepository extends AbstractRepository implements LogAnalisePropostaRepositoryInterface
{
    public function __construct(LogAnaliseProposta $model)
    {
        parent::__construct($model);
    }
}
