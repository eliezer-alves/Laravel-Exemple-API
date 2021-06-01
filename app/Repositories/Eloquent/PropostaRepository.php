<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\DbException;
use App\Exceptions\FailedAction;
use App\Models\Proposta;
use App\Repositories\Contracts\PropostaRepositoryInterface;
use Exception;

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

    public function alterarStatusAnalise($idStatusAnaliseProposta, $idProposta)
    {
        try {
            $proposta = $this->find($idProposta);
            $proposta['id_status_analise_proposta'] = $idStatusAnaliseProposta;
            return $proposta->save();
        } catch(Exception $e) {
            throw new DbException("Erro ao alterar status análise da proposta em {$this->model->getTable()}.", $e, $this->model);
        }
    }
}
