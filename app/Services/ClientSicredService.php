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
     * Get a listing of the resource.
     *
     * @return ClientSicredRepository  $modeloSicred
     */
    public function all()
    {
        return $this->clientSicredRepository->all()->toArray();
    }

    /**
     * Create the model in the database.
     *
     * @param  array  $attributes
     * @return ClientSicredRepository  $modeloSicred
     */
    public function create($request)
    {
        return $this->clientSicredRepository->create($request->all());
    }

    /**
     * Create the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idClientSicred
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function update($request, $idClientSicred)
    {
        return $this->clientSicredRepository->update($request->all(), $idClientSicred);
    }

    /**
     * Delete the model in the database.
     *
     * @param  int  $idClientSicred
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function delete($idClientSicred)
    {
        return $this->clientSicredRepository->delete($idClientSicred);
    }
}
