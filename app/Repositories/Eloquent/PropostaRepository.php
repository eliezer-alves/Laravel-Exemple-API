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
        $proposta = $this->where('contrato', $numeroProposta)->orderBy('data_geracao_proposta', 'desc')->first();
        if($proposta)
            return $proposta;

        throw new FailedAction('Proposta não encontrada.', 404);
    }
}
