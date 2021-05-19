<?php

namespace App\Services;

use App\Repositories\Contracts\ModeloSicredRepositoryInterface;
use App\Repositories\Contracts\UrlSicredRepositoryInterface;

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
    protected $urlSicredRepository;

    public function __construct(ModeloSicredRepositoryInterface $modeloSicredRepository, UrlSicredRepositoryInterface $urlSicredRepository)
    {
        $this->modeloSicredRepository = $modeloSicredRepository;
        $this->urlSicredRepository = $urlSicredRepository;
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
     * Service Layer - Get all data needed to display the view index.
     *
     * @return ModeloSicredRepository  $modeloSicred
     */
    public function dataIndex()
    {
        $modelos = $this->modeloSicredRepository->all();
        foreach($modelos as $modelo){
            $modelo->urls;
        }
        $modelos->toArray();

        $urls = $this->urlSicredRepository->all()->toArray();

        return [
            'modelos' => $modelos->toArray() ?? [],
            'urls' => $urls ?? []
        ];
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
     * Service Layer - Bind urls to the model
     *
     * @since 18/05/2021
     *
     * @param  array  $attributes
     * @param  int  $idUrlSicred
     * @return \App\Models\UrlSicred
     */
    public function bindUrl($attributes, $idModeloSicred)
    {
        $modeloSicred = $this->modeloSicredRepository->find($idModeloSicred);
        $urls = $this->urlSicredRepository->whereIn('id_url_sicred', $attributes['url'])->get();
        $modeloSicred->urls()->detach();
        $modeloSicred->urls()->attach($urls);
        
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
