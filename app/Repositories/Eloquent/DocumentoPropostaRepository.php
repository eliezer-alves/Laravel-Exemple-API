<?php

namespace App\Repositories\Eloquent;

use App\Models\DocumentoProposta;
use App\Repositories\Contracts\DocumentoPropostaRepositoryInterface;

class DocumentoPropostaRepository extends AbstractRepository implements DocumentoPropostaRepositoryInterface
{
    public function __construct(DocumentoProposta $model)
    {
        parent::__construct($model);
    }
}
