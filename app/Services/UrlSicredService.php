<?php

namespace App\Services;

use App\Repositories\Contracts\UrlSicredRepositoryInterface;

/**
 * Service Layer - Class responsible for managing Sicred's urls
 *
 * @author Eliezer Alves
 * @since 13/05/2021
 */
class UrlSicredService
{
    private $urlSicredRepository;

    public function __construct(UrlSicredRepositoryInterface $urlSicredRepository)
    {
        $this->urlSicredRepository = $urlSicredRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @since 14/05/2021
     *
     * @return \App\Models\UrlSicred
     */
    public function all()
    {
        return $this->urlSicredRepository->all();
    }

    /**
     * Service Layer - Create the model in the database.
     *
     * @since 14/05/2021
     *
     * @param  array  $attributes
     * @return \App\Models\UrlSicred
     */
    public function create($attributes)
    {
        return $this->urlSicredRepository->create($attributes);
    }

    /**
     * Service Layer - Update the model in the database.
     *
     * @since 14/05/2021
     *
     * @param  array  $attributes
     * @param  int  $idUrlSicred
     * @return \App\Models\UrlSicred
     */
    public function update($attributes, $idUrlSicred)
    {
        return $this->urlSicredRepository->update($attributes, $idUrlSicred);
    }

    /**
     * Service Layer - Delete the model in the database.
     *
     * @since 14/05/2021
     *
     * @param  int  $idUrlSicred
     * @return \App\Models\UrlSicred
     */
    public function delete($idCliente)
    {
        return $this->urlSicredRepository->delete($idCliente);
    }
}
