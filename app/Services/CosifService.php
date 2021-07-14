<?php

namespace App\Services;

use App\Repositories\Contracts\CosifRepositoryInterface;

class CosifService
{
    protected $cosifRepository;

    public function __construct(CosifRepositoryInterface $cosifRepository)
    {
        $this->cosifRepository = $cosifRepository;
    }


    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\CosifRepositoryInterface
     */
    public function all()
    {
        return  $this->cosifRepository->all();
    }

    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\CosifRepositoryInterface
     */
    public function create($request)
    {
        return  $this->cosifRepository->create($request);
    }


    /**
     * Service Layer - Find a model of the resource.
     *
     * @return App\Repositories\Contracts\CosifRepositoryInterface
     */
    public function findOrFail($idPorteEmpresa)
    {
        return  $this->cosifRepository->findOrFail($idPorteEmpresa);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idPorteEmpresa
     * @return App\Repositories\Contracts\CosifRepositoryInterface
     */
    public function update($attributes, $idPorteEmpresa)
    {
        return  $this->cosifRepository->update($attributes, $idPorteEmpresa);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idPorteEmpresa
     * @return App\Repositories\Contracts\CosifRepositoryInterface
     */
    public function delete($idPorteEmpresa)
    {
        return  $this->cosifRepository->delete($idPorteEmpresa);
    }
}
