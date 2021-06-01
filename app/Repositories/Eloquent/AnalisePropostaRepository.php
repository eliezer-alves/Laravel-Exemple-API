<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\DbException;
use App\Models\AnaliseProposta;
use App\Repositories\Contracts\AnalisePropostaRepositoryInterface;
use Exception;

class AnalisePropostaRepository extends AbstractRepository implements AnalisePropostaRepositoryInterface
{
	public function __construct(AnaliseProposta $model)
	{
		parent::__construct($model);
	}

    public function registrarAnaliseProposta($attributes, $idProposta)
    {
        try {
            $analise = $this->firstWhere('id_proposta', $idProposta) ?? $this->model->fill([]);
            $analise->fill($attributes);
            $analise->save();
            return $analise;
        } catch(Exception $e) {
            throw new DbException("Erro ao registrar análise da proposta em {$this->model->getTable()}.", $e, $this->model);
        }
    }
}
