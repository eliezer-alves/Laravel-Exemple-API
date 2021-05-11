<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\FailedAction;
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
        $proposta = $this->where('contrato', $numeroProposta)->first();
        if($proposta)
            return $proposta;

        throw new FailedAction('Proposta não encontrada.', 404);
    }

    public function find($idProposta)
    {
        $proposta = $this->find($idProposta);
        if($proposta)
            return $proposta;

        throw new FailedAction('Proposta não encontrada.', 404);
    }
}
