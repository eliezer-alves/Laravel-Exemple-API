<?php

namespace App\Services;

use App\Repositories\Contracts\ClienteRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Support\Facades\Hash;


class ClienteService
{

    protected $repository;
    protected $userRepository;

    public function __construct(ClienteRepositoryInterface $repository, UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function create($request)
    {
        $request = _normalizeRequest($request->all());
        $request['senha'] = Hash::make($request['senha']);

        $cliente = $this->repository->create($request);

        if (!$cliente->id_cliente)
            return $cliente;

        $user = $this->userRepository->create((array) [
            'name' => $request['nome_fantasia'],
            'email' => $request['email'],
            'username' => $request['cnpj'],
            'password' => $request['senha']
        ]);

        $cliente->user = $user;

        return $cliente;
    }

    public function findOrFail($idCliente)
    {
        return $this->repository->findOrFail($idCliente);
    }

    public function update(UpdateClienteRequest $request, $idCliente)
    {
        $request = _normalizeRequest($request->all());

        return $this->repository->update($request, $idCliente);
    }

    public function delete($idCliente)
    {
        return $this->repository->delete($idCliente);
    }
}
