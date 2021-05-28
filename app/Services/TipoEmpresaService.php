<?php

namespace App\Services;

use App\Repositories\Contracts\TipoEmpresaRepositoryInterface;

class TipoEmpresaService
{
    protected $tipoEmpresaRepository;

    public function __construct(TipoEmpresaRepositoryInterface $tipoEmpresaRepository)
    {
        $this->tipoEmpresaRepository = $tipoEmpresaRepository;
    }

    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\TipoEmpresaRepositoryInterface
     */
    public function all()
    {
        return $this->tipoEmpresaRepository->all();
    }
}
