<?php

namespace App\Services;

use App\Repositories\Contracts\ModeloSicredRepositoryInterface;

/**
 * Service Layer - Class responsible for managing Sicred's proposal models
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class ModeloSicredService
{
    protected $modeloSicredRepository;

    public function __construct(ModeloSicredRepositoryInterface $modeloSicredRepository)
    {
        $this->modeloSicredRepository = $modeloSicredRepository;
    }


    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function all()
    {
        return $this->modeloSicredRepository->all()->toArray();
    }


    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function create($attributes)
    {
        return $this->modeloSicredRepository->create($attributes);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idModeloSicred
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function update($attributes, $idModeloSicred)
    {
        return $this->modeloSicredRepository->update($attributes, $idModeloSicred);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idModeloSicred
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function delete($idModeloSicred)
    {
        return $this->modeloSicredRepository->delete($idModeloSicred);
    }
}
