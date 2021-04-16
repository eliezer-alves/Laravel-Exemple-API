<?php

namespace App\Services;

use App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface;

class PessoaAssinaturaService
{
    protected $pessoaAssinaturaRepository;

    public function __construct(PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository)
    {
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
    }


    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface
     */
    public function all()
    {
        return $this->pessoaAssinaturaRepository->all()->toArray();
    }


    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface
     */
    public function create($attributes)
    {
        return $this->pessoaAssinaturaRepository->create($attributes);
    }

    /**
     * Service Layer - Create Many the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idProposta
     * @return App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface
     */
    public function createMany($attributes, $idProposta)
    {
        $arrayPessoaAssinatura = [];
        foreach ($attributes as $socio) {
            $socio['id_proposta'] = $idProposta;
            array_push($arrayPessoaAssinatura, $this->create($socio));
        }
        return $arrayPessoaAssinatura;
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idPessoaAssinatura
     * @return App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface
     */
    public function update($attributes, $idPessoaAssinatura)
    {
        return $this->pessoaAssinaturaRepository->update($attributes, $idPessoaAssinatura);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idModeloSicred
     * @return App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface
     */
    public function delete($idModeloSicred)
    {
        return $this->pessoaAssinaturaRepository->delete($idModeloSicred);
    }
}