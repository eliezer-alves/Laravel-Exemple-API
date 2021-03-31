<?php

namespace App\Services;

use App\Repositories\Contracts\ClientSicredRepositoryInterface;

class ClientSicredService
{
    protected $clientSicredRepository;

    public function __construct(ClientSicredRepositoryInterface $clientSicredRepository)
    {
        $this->clientSicredRepository = $clientSicredRepository;
    }


    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return ClientSicredRepository  $modeloSicred
     */
    public function all()
    {
        return $this->clientSicredRepository->all()->toArray();
    }


    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return ClientSicredRepository  $modeloSicred
     */
    public function create($data)
    {
        return $this->clientSicredRepository->create($data);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idClientSicred
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function update($data, $idClientSicred)
    {
        return $this->clientSicredRepository->update($data, $idClientSicred);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idClientSicred
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function delete($idClientSicred)
    {
        return $this->clientSicredRepository->delete($idClientSicred);
    }
}
