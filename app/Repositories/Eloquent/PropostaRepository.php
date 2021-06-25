<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\DbException;
use App\Exceptions\FailedAction;
use App\Models\Proposta;
use App\Repositories\Contracts\PropostaRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class PropostaRepository extends AbstractRepository implements PropostaRepositoryInterface
{
    public function __construct(Proposta $model)
    {
        parent::__construct($model);
    }

    public function findByNumero($numeroProposta, $reportException = true)
    {
        $proposta = $this->where('contrato', $numeroProposta)->orderBy('data_geracao_proposta', 'desc')->first();
        if($proposta)
            return $proposta;
        else if(!$reportException){
            Log::channel('dbExceptions')->error("Erro ao resgatar o registro proposta $numeroProposta: Registro não encontrado em cad_proposta.");
            return NULL;
        }

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
