<?php

namespace App\Services;

use App\Services\GacWebService;
use App\Entities\ClienteAtendimentoEntity;
use App\Repositories\Contracts\{
    ClienteRepositoryInterface,
    UserRepositoryInterface
};

use Illuminate\Support\Facades\Hash;


class ClienteService
{
    protected $clienteRepository;
    protected $userRepository;
    protected $gacWebService;
    protected $clienteAtendimentoEntity;

    public function __construct(ClienteRepositoryInterface $clienteRepository, UserRepositoryInterface $userRepository, GacWebService $gacWebService, ClienteAtendimentoEntity $clienteAtendimentoEntity)
    {
        $this->clienteRepository = $clienteRepository;
        $this->userRepository = $userRepository;
        $this->gacWebService = $gacWebService;
        $this->gacWebService->hydrator_bolt();
        $this->clienteAtendimentoEntity = $clienteAtendimentoEntity;
    }

    public function all()
    {
        return $this->clienteRepository->all();
    }

    public function create($request)
    {
        $request = _normalizeRequest($request->all());
        $request['senha'] = Hash::make($request['senha']);

        $cliente = $this->clienteRepository->create($request);

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
        return $this->clienteRepository->findOrFail($idCliente);
    }

    public function update($request, $idCliente)
    {
        $request = _normalizeRequest($request->all());

        return $this->clienteRepository->update($request, $idCliente);
    }

    public function delete($idCliente)
    {
        return $this->clienteRepository->delete($idCliente);
    }

    public function findByCnpj($cnpj)
    {
       $cliente_postgres = $this->clienteRepository->findByCnpj($cnpj);

        $cliente = $cliente_postgres ?: $this->gacWebService->request(['acao' => 'GETLOJISTABYCNPJ', 'cnpj' => $cnpj]);

        // return new $this->clienteAtendimentoEntity;



        $cliente_bolt = $this->gacWebService->request(['acao' => 'GETLOJISTABYCNPJ', 'cnpj' => $cnpj]);
        // return ['oixx'];
        // $cliente = $this->clienteRepository->create($cliente_bolt);
        return $cliente_bolt;
        // $cliente = $this->clienteRepository->make($cliente_bolt);
        // return $cliente;
    }

    private function makeClienteBolt($dadosBolt)
    {

    }
}
