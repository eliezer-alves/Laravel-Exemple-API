<?php

namespace App\Services;

use App\Services\GacWebService;
use App\Repositories\Contracts\{
    ClienteRepositoryInterface,
    PessoaAssinaturaRepositoryInterface,
    UserRepositoryInterface
};

use Illuminate\Support\Facades\Hash;

/**
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class ClienteService
{
    protected $clienteRepository;
    protected $pessoaAssinaturaRepository;
    protected $userRepository;
    protected $gacWebService;

    public function __construct(ClienteRepositoryInterface $clienteRepository, PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository, UserRepositoryInterface $userRepository, GacWebService $gacWebService)
    {
        $this->clienteRepository = $clienteRepository;
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
        $this->userRepository = $userRepository;
        $this->gacWebService = $gacWebService;
        $this->gacWebService->hydrator_bolt();
    }

    /**
     * Service Layer - Get a listing of the resource.
     *
     * @author Eliezer Alves
     *
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function all()
    {
        return $this->clienteRepository->all();
    }


    /**
     * Service Layer - Create the model in the database.
     *
     * @author Eliezer Alves
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function create($attributes)
    {
        return $this->clienteRepository->create($attributes);
    }


    /**
     * Service Layer - Create a new customer in the database and a user for this customer.
     *
     * @author Eliezer Alves
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function createWithUser($attributes)
    {
        $attributes = _normalizeRequest($attributes);
        $attributes['senha'] = Hash::make($attributes['senha']);

        $cliente = $this->clienteRepository->createWithUser($attributes);

        if (!$cliente->id_cliente)
            return $cliente;

        $user = $this->userRepository->create((array) [
            'name' => $attributes['nome_fantasia'],
            'email' => $attributes['email'],
            'username' => $attributes['cnpj'],
            'password' => $attributes['senha']
        ]);

        $cliente->user = $user;

        return $cliente;
    }


    /**
     * Service Layer - Find the model in the database.
     *
     * @author Eliezer Alves
     *
     * @param  int  $idCliente
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function findOrFail($idCliente)
    {
        return $this->clienteRepository->findOrFail($idCliente);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @author Eliezer Alves
     *
     * @param  array  $attributes
     * @param  int  $idCliente
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function update($attributes, $idCliente)
    {
        $attributes = _normalizeRequest($attributes);

        return $this->clienteRepository->update($attributes, $idCliente);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @author Eliezer Alves
     *
     * @param  int  $idCliente
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function delete($idCliente)
    {
        return $this->clienteRepository->delete($idCliente);
    }

    /**
     * Service Layer - Find PJ client for CNPJ in the database.
     *
     * @author Eliezer Alves
     *
     * @param  int  $cnpj
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function findByCnpj($cnpj)
    {
        return $this->clienteRepository->findByCnpj($cnpj);
    }

    /**
     * Service Layer - Find PJ client for CNPJ in Ágil's database, in case there is no search in Bolt's database.
     *
     * @author Eliezer Alves
     *
     * @param  int  $cnpj
     * @return array [App\Repositories\Contracts\ClienteRepositoryInterface, App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface]
     */
    public function findByCnpjForAtendence($cnpj)
    {
        $dadosLojista = (array)(!empty($this->clienteRepository->findByCnpj($cnpj))
            ? $this->clienteRepository->findByCnpj($cnpj)->toArray()
            : ($this->gacWebService->request(['acao' => 'GETLOJISTABYCNPJ', 'cnpj' => $cnpj])[0] ?? NULL));

        $dadosRepresentante = (array)(!empty($this->pessoaAssinaturaRepository->findRepresentanteByCnpj($cnpj))
            ? $this->pessoaAssinaturaRepository->findRepresentanteByCnpj($cnpj)->toArray()
            : ($this->gacWebService->request(['acao' => 'GETLOSOCIOBYCNPJ', 'cnpj' => $cnpj])[0] ?? NULL));

        $lojista = $this->clienteRepository->fill($dadosLojista);
        $representante = $this->pessoaAssinaturaRepository->fill($dadosRepresentante);

        return [
            'lojista' => $lojista,
            'representante' => $representante
        ];
    }
}
