<?php

namespace App\Services;

use App\Repositories\Contracts\AtividadeComercialRepositoryInterface;

/**
 * Service Layer - Class responsible for managing business activities of PJ clients
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class AtividadeComercialService
{
    protected $atividadeComercialRepository;

    public function __construct(AtividadeComercialRepositoryInterface $atividadeComercialRepository)
    {
        $this->atividadeComercialRepository = $atividadeComercialRepository;
    }


    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function all()
    {
        return $this->atividadeComercialRepository->all();
    }


    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function create($request)
    {
        return $this->atividadeComercialRepository->create($request);
    }


    /**
     * Service Layer - Find a model of the resource.
     *
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function findOrFail($idAtividadeComercial)
    {
        return $this->atividadeComercialRepository->findOrFail($idAtividadeComercial);
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
        return $this->atividadeComercialRepository->update($data, $idAtividadeComercial);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idAtividadeComercial
     * @return App\Repositories\Contracts\AtividadeComercialRepositoryInterface
     */
    public function delete($idAtividadeComercial)
    {
        return $this->atividadeComercialRepository->delete($idAtividadeComercial);
    }
}
