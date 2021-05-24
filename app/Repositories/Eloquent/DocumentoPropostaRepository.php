<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\DbException;
use App\Models\DocumentoProposta;
use App\Repositories\Contracts\DocumentoPropostaRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class DocumentoPropostaRepository extends AbstractRepository implements DocumentoPropostaRepositoryInterface
{
    public function __construct(DocumentoProposta $model)
    {
        parent::__construct($model);
    }
}
