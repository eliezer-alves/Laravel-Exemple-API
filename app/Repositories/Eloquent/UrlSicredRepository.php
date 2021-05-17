<?php

namespace App\Repositories\Eloquent;

use App\Models\UrlSicred;
use App\Repositories\Contracts\UrlSicredRepositoryInterface;

class UrlSicredRepository extends AbstractRepository implements UrlSicredRepositoryInterface
{
    public function __construct(UrlSicred $model)
    {
        parent::__construct($model);
    }

    public function servico($servico)
    {
        return $this->firstWhere('servico', $servico);
    }
}
