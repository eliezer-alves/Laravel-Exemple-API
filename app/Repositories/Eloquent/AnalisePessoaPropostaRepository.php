<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\DbException;
use Exception;
use App\Models\AnalisePessoaProposta;
use App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface;

class AnalisePessoaPropostaRepository extends AbstractRepository implements AnalisePessoaPropostaRepositoryInterface
{
	public function __construct(AnalisePessoaProposta $model)
	{
		parent::__construct($model);
	}

    public function findByAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura)
    {
        return $this->where('id_analise_proposta', $idAnaliseProposta)->where('id_pessoa_assinatura', $idPessoaAssinatura)->first();
    }

    public function registrarAnalisePessoaProposta($attributes)
    {
        try {
            $analisePessoa = $this->findByAnaliseAndPessoa($attributes['id_analise_proposta'], $attributes['id_pessoa_assinatura']) ?? $this->model->fill([]);
            // dd($attributes['id_analise_proposta'], $attributes['id_pessoa_assinatura'],$analisePessoa);
            $analisePessoa->fill($attributes);
            $analisePessoa->save();
            return $analisePessoa;
        } catch(Exception $e) {
            throw new DbException("Erro ao registrar análise da pessoa ligada à proposta em {$this->model->getTable()}.", $e, $this->model);
        }
    }
}
