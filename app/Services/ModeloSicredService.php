<?php

namespace App\Services;

use App\Repositories\Contracts\ModeloSicredRepositoryInterface;

class ModeloSicredService
{
    protected $modeloSicredRepository;

    public function __construct(ModeloSicredRepositoryInterface $modeloSicredRepository)
    {
        $this->modeloSicredRepository = $modeloSicredRepository;
    }

    public function all()
    {
        return $this->modeloSicredRepository->all()->toArray();
    }
}
