<?php

namespace App\Services;

use App\Repositories\Contracts\AtividadeComercialRepositoryInterface;

/**
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class AtividadeComercialService
{
    protected $repository;

    public function __construct(AtividadeComercialRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function all()
    {
        return $this->repository->all();
    }


    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function create($request)
    {
        return $this->repository->create($request);
    }


    /**
     * Service Layer - Find a model of the resource.
     *
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function findOrFail($idAtividadeComercial)
    {
        return $this->repository->findOrFail($idAtividadeComercial);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $data
     * @param  int  $idAtividadeComercial
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function update($data, $idAtividadeComercial)
    {
        return $this->repository->update($data, $idAtividadeComercial);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idAtividadeComercial
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function delete($idAtividadeComercial)
    {
        return $this->repository->delete($idAtividadeComercial);
    }
}
