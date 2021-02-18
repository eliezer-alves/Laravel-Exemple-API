<?php

namespace App\Services;

use App\Repositories\ClienteRepository;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;


class ClienteService{

	protected $clienteRepository;

	public function __construct(ClienteRepository $clienteRepository){
		$this->clienteRepository = $clienteRepository;
	}

	public function save($cliente)
	{
		return $this->clienteRepository->save($cliente);
	}

	
}