<?php

namespace App\Services;


use App\Repositories\Contracts\EmpresaRepositoryInterface;

/**
 * Service Layer - Class responsible for managing Agile Customers
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class EmpresaService
{
    private $empresaRepository;

    public function __construct(EmpresaRepositoryInterface $empresaRepository)
    {
        $this->empresaRepository = $empresaRepository;
    }

    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\EmpresaRepositoryInterface
     */
    public function all()
    {
        $empresas = $this->empresaRepository->all();
        $empresas->map(function ($empresa) {
            $empresa->atividadeComercial;
            $empresa->cosif;
            $empresa->porte;
            $empresa->tipo;
        });

        return $empresas;
    }

    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\EmpresaRepositoryInterface
     */
    public function create($request)
    {
        return $this->empresaRepository->create($request);
    }


    /**
     * Service Layer - Find a model of the resource.
     *
     * @return App\Repositories\Contracts\EmpresaRepositoryInterface
     */
    public function findOrFail($idEmpresa)
    {
        $empresa = $this->empresaRepository->findOrFail($idEmpresa);
        $empresa->atividadeComercial;
        $empresa->cosif;
        $empresa->porte;
        $empresa->tipo;

        return $empresa;
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idEmpresa
     * @return App\Repositories\Contracts\EmpresaRepositoryInterface
     */
    public function update($attributes, $idEmpresa)
    {
        return $this->empresaRepository->update($attributes, $idEmpresa);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idEmpresa
     * @return App\Repositories\Contracts\EmpresaRepositoryInterface
     */
    public function delete($idEmpresa)
    {
        return $this->empresaRepository->delete($idEmpresa);
    }
}
