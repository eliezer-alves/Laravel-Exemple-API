<?php

namespace App\Repositories\Eloquent;

use App\Models\AnalisePessoaProposta;
use App\Repositories\Contracts\AnalisePessoaPropostaRepositoryInterface;

class AnalisePessoaPropostaRepository extends AbstractRepository implements AnalisePessoaPropostaRepositoryInterface
{
	public function __construct(AnalisePessoaProposta $model)
	{
		parent::__construct($model);
	}

    public function findAnaliseAndPessoa($idAnaliseProposta, $idPessoaAssinatura)
    {
        return $this->where('id_analise_proposta', $idAnaliseProposta)->where('id_pessoa_assinatura', $idPessoaAssinatura)->first();
    }
}
