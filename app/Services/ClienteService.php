<?php

namespace App\Services;

use App\Services\GacWebService;
use App\Repositories\Contracts\{
    ClienteRepositoryInterface,
    PessoaAssinaturaRepositoryInterface,
    UserRepositoryInterface
};

use Illuminate\Support\Facades\Hash;


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
        $dadosLojista = (array)(
            !empty($this->clienteRepository->findByCnpj($cnpj))
            ? $this->clienteRepository->findByCnpj($cnpj)->toArray()
            : ($this->gacWebService->request(['acao' => 'GETLOJISTABYCNPJ', 'cnpj' => $cnpj])[0] ?? NULL)
        );
        $dadosRepresentante = (array)(
            !empty($this->pessoaAssinaturaRepository->findRepresentanteByCnpj($cnpj))
            ? $this->pessoaAssinaturaRepository->findRepresentanteByCnpj($cnpj)->toArray()
            : ($this->gacWebService->request(['acao' => 'GETLOSOCIOBYCNPJ', 'cnpj' => $cnpj])[0] ?? NULL)
        );

        $lojista = $this->clienteRepository->fill($dadosLojista);
        $representante = $this->pessoaAssinaturaRepository->fill($dadosRepresentante);

        // $representante = $this->clienteRepository->fill($cliente);


        return [
            'lojista' => $lojista,
            'representante' => $representante
        ];
    }
}
