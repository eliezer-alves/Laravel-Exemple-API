<?php

namespace App\Services;

use App\Repositories\Contracts\ObservacaoPropostaRepositoryInterface;

/**
 * Service Layer - Class responsible for managing the observations of a proposal
 *
 * @author Eliezer Alves
 * @since 02/06/2021
 *
 */
class ObservacaoPropostaService
{
    private $observacaoPropostaRepository;

    public function __construct(ObservacaoPropostaRepositoryInterface $observacaoPropostaRepository)
    {
        $this->observacaoPropostaRepository = $observacaoPropostaRepository;
    }


    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\ObservacaoPropostaRepositoryInterface
     */
    public function all()
    {
        return $this->observacaoPropostaRepository->all();
    }


    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\ObservacaoPropostaRepositoryInterface
     */
    public function create($request)
    {
        return $this->observacaoPropostaRepository->create($request);
    }


    /**
     * Service Layer - Find a model of the resource.
     *
     * @return App\Repositories\Contracts\ObservacaoPropostaRepositoryInterface
     */
    public function findOrFail($idAtividadeComercial)
    {
        return $this->observacaoPropostaRepository->findOrFail($idAtividadeComercial);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $data
     * @param  int  $idAtividadeComercial
     * @return App\Repositories\Contracts\ObservacaoPropostaRepositoryInterface
     */
    public function update($data, $idAtividadeComercial)
    {
        return $this->observacaoPropostaRepository->update($data, $idAtividadeComercial);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idAtividadeComercial
     * @return App\Repositories\Contracts\ObservacaoPropostaRepositoryInterface
     */
    public function delete($idAtividadeComercial)
    {
        return $this->observacaoPropostaRepository->delete($idAtividadeComercial);
    }
}
