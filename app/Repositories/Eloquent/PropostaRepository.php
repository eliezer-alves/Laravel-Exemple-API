<?php

namespace App\Repositories\Eloquent;

use App\Models\Proposta;
use App\Repositories\Contracts\PropostaRepositoryInterface;

class PropostaRepository extends AbstractRepository implements PropostaRepositoryInterface
{
    public function __construct(Proposta $model)
    {
        parent::__construct($model);
    }

    public function findByNumero($numeroProposta)
    {
        return $this->firstWhere('contrato', $numeroProposta);
    }
}
