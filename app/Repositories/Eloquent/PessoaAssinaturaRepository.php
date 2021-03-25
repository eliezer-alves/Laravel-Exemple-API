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

    public function findRepresentanteByCnpj($cnpj){
        return $this->firstWhere('cnpj', $cnpj);
    }
}