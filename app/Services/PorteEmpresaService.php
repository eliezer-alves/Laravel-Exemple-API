<?php

namespace App\Services;

use App\Repositories\Contracts\PorteEmpresaRepositoryInterface;

/**
 * Service Layer - Class responsible for managing Company Ports
 *
 * @author Eliezer Alves
 * @since 20/05/2021
 *
 */
class PorteEmpresaService
{
    private $porteEmpresaRepository;

    public function __construct(PorteEmpresaRepositoryInterface $porteEmpresaRepository)
    {
        $this->porteEmpresaRepository = $porteEmpresaRepository;
    }

    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\PorteEmpresaRepositoryInterface
     */
    public function all()
    {
        return $this->porteEmpresaRepository->all();
    }

    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\PorteEmpresaRepositoryInterface
     */
    public function create($request)
    {
        return $this->porteEmpresaRepository->create($request);
    }


    /**
     * Service Layer - Find a model of the resource.
     *
     * @return App\Repositories\Contracts\PorteEmpresaRepositoryInterface
     */
    public function findOrFail($idPorteEmpresa)
    {
        return $this->porteEmpresaRepository->findOrFail($idPorteEmpresa);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idPorteEmpresa
     * @return App\Repositories\Contracts\PorteEmpresaRepositoryInterface
     */
    public function update($attributes, $idPorteEmpresa)
    {
        return $this->porteEmpresaRepository->update($attributes, $idPorteEmpresa);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idPorteEmpresa
     * @return App\Repositories\Contracts\PorteEmpresaRepositoryInterface
     */
    public function delete($idPorteEmpresa)
    {
        return $this->porteEmpresaRepository->delete($idPorteEmpresa);
    }
}
