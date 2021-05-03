<?php

namespace App\Repositories\Eloquent;

use App\Models\PessoaAssinatura;
use App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface;

class PessoaAssinaturaRepository extends AbstractRepository implements PessoaAssinaturaRepositoryInterface
{
    public function __construct(PessoaAssinatura $model)
    {
        parent::__construct($model);
    }

    public function findRepresentanteByCnpj($cnpj)
    {
        return $this->firstWhere('cnpj', $cnpj);
    }

    public function assinaturasPendentes($idProposta)
    {
        return $this->where('id_proposta', $idProposta)
            ->whereIn('tipo_pessoa_assinatura', [1,2])
            ->where('data_aceite_1', null)->get()->toArray() ?? [];
    }
}
