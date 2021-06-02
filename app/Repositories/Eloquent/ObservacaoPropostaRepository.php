<?php

namespace App\Repositories\Eloquent;

use App\Models\ObservacaoProposta;
use App\Repositories\Contracts\ObservacaoPropostaRepositoryInterface;

class ObservacaoPropostaRepository extends AbstractRepository implements ObservacaoPropostaRepositoryInterface
{
    public function __construct(ObservacaoProposta $model)
    {
        parent::__construct($model);
    }
}
