<?php

namespace App\Services;

use App\Models\Cliente;
use App\Services\GacWebService;
use App\Repositories\Contracts\{
    AtividadeComercialRepositoryInterface,
    ClienteRepositoryInterface,
    PessoaAssinaturaRepositoryInterface,
    TipoEmpresaRepositoryInterface,
    UserRepositoryInterface
};
use App\Repositories\Eloquent\TipoEmpresaRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Service Layer - Class responsible for managing Agile Customers
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
    protected $tipoEmpresaRepository;
    protected $atividadeComercialRepository;
    protected $gacWebService;

    public function __construct(ClienteRepositoryInterface $clienteRepository, PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository, UserRepositoryInterface $userRepository, GacWebService $gacWebService, TipoEmpresaRepositoryInterface $tipoEmpresaRepository, AtividadeComercialRepositoryInterface $atividadeComercialRepository)
    {
        $this->clienteRepository = $clienteRepository;
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
        $this->userRepository = $userRepository;
        $this->tipoEmpresaRepository = $tipoEmpresaRepository;
        $this->atividadeComercialRepository = $atividadeComercialRepository;
        $this->gacWebService = $gacWebService;
        $this->gacWebService->hydrator_bolt();
    }

    /**
     * Service Layer - Get a listing of the resource.
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
     * @param  array  $attributes
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function createWithUser($attributes)
    {
        $hidden = ['email', 'email_confirmation', 'senha', 'senha_confirmation'];
        $attributes = _normalizeRequest($attributes, $hidden);
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
     * @param  array  $attributes
     * @param  int  $idCliente
     * @return App\Repositories\Contracts\ClienteRepositoryInterface
     */
    public function update($attributes, $idCliente)
    {
        $hidden = ['email', 'email_confirmation', 'senha', 'senha_confirmation'];
        $attributes = _normalizeRequest($attributes, $hidden);

        return $this->clienteRepository->update($attributes, $idCliente);
    }


    /**
     * Service Layer - Delete the model in the database.
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
     * @param  int  $cnpj
     * @return array [App\Repositories\Contracts\ClienteRepositoryInterface, App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface]
     */
    public function findByCnpjForAtendence($cnpj)
    {
        $dadosLojistaBolt = (array)($this->gacWebService->request(['acao' => 'GETLOJISTABYCNPJ', 'cnpj' => $cnpj])[0] ?? NULL);
        $dadosLojistaAgil = $this->clienteRepository->findByCnpj($cnpj);

        $dadosLojista = (array)(!empty($dadosLojistaAgil) ? $dadosLojistaAgil->toArray() : $dadosLojistaBolt);

        $dadosRepresentante = (array)(!empty($this->pessoaAssinaturaRepository->findRepresentanteByCnpj($cnpj))
            ? $this->pessoaAssinaturaRepository->findRepresentanteByCnpj($cnpj)->toArray()
            : ($this->gacWebService->request(['acao' => 'GETLOSOCIOBYCNPJ', 'cnpj' => $cnpj])[0] ?? NULL));

        $lojista = $this->clienteRepository->fill($dadosLojista);
        $representante = $this->pessoaAssinaturaRepository->fill($dadosRepresentante);


        /*
        |--------------------------------------------------------------------------
        | Dados Bancários
        |--------------------------------------------------------------------------
        */
        $lojista['agencia_liberacao'] = explode('-', ($dadosLojistaBolt['agencia'] ?? ''))[0] ?? '';
        $lojista['digito_agencia_liberacao'] = explode('-', ($dadosLojistaBolt['agencia'] ?? ''))[1] ?? '';
        $lojista['conta_liberacao'] = explode('-', ($dadosLojistaBolt['conta'] ?? ''))[0] ?? '';
        $lojista['digito_conta_liberacao'] = explode('-', ($dadosLojistaBolt['conta'] ?? ''))[1] ?? '';
        $lojista['codigo_banco'] = intval($dadosLojistaBolt['banco'] ?? 1);


        /*
        |--------------------------------------------------------------------------
        | Tipo de Empresa
        |--------------------------------------------------------------------------
        */
        if($lojista->id_tipo_empresa == null){
            $tipoEmpresa = $this->tipoEmpresaRepository->where('descricao', _normalizeRequest([($dadosLojistaBolt['tipo_empresa'] ?? '')]))->first();
            $lojista['id_tipo_empresa'] = $tipoEmpresa != null ? $tipoEmpresa->getKey() : 1;
        }

        /*
        |--------------------------------------------------------------------------
        | Ramo Atividade
        |--------------------------------------------------------------------------
        */
        if($lojista->id_atividade_comercial == null){
            $atividadeComercial = $this->atividadeComercialRepository->where('descricao', _normalizeRequest([($dadosLojistaBolt['atividade_comercial'] ?? '')]))->first();
            $lojista['id_atividade_comercial'] = $atividadeComercial != null ? $atividadeComercial->getKey() : 1;
        }

        return [
            'lojista' => $lojista,
            'representante' => $representante
        ];
    }
}
