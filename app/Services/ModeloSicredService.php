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

    /**
     * Get a listing of the resource.
     *
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function all()
    {
        return $this->modeloSicredRepository->all()->toArray();
    }

    /**
     * Create the model in the database.
     *
     * @param  array  $attributes
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function create($request)
    {
        return $this->modeloSicredRepository->create($request->all());
    }

    /**
     * Create the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idModeloSicred
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function update($request, $idModeloSicred)
    {
        return $this->modeloSicredRepository->update($request->all(), $idModeloSicred);
    }

    /**
     * Delete the model in the database.
     *
     * @param  int  $idModeloSicred
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function delete($idModeloSicred)
    {
        return $this->modeloSicredRepository->delete($idModeloSicred);
    }
}
