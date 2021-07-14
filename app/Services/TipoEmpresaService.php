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

    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\TipoEmpresaRepositoryInterface
     */
    public function create($request)
    {
        return $this->tipoEmpresaRepository->create($request);
    }


    /**
     * Service Layer - Find a model of the resource.
     *
     * @return App\Repositories\Contracts\TipoEmpresaRepositoryInterface
     */
    public function findOrFail($idPorteEmpresa)
    {
        return $this->tipoEmpresaRepository->findOrFail($idPorteEmpresa);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idPorteEmpresa
     * @return App\Repositories\Contracts\TipoEmpresaRepositoryInterface
     */
    public function update($attributes, $idPorteEmpresa)
    {
        return $this->tipoEmpresaRepository->update($attributes, $idPorteEmpresa);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idPorteEmpresa
     * @return App\Repositories\Contracts\TipoEmpresaRepositoryInterface
     */
    public function delete($idPorteEmpresa)
    {
        return $this->tipoEmpresaRepository->delete($idPorteEmpresa);
    }
}
