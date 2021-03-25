<?php

namespace App\Repositories\Eloquent;

use App\Models\Cliente;
use App\Repositories\Contracts\ClienteRepositoryInterface;

class ClienteRepository extends AbstractRepository implements ClienteRepositoryInterface
{

	public function __construct(Cliente $model)
	{
		parent::__construct($model);
	}

	public function findByCnpj($cnpj)
	{
		return $this->firstWhere('cnpj', $cnpj);
	}

	public function findByCpf($cpf)
	{
		return $this->firstWhere('cpf', $cpf);
	}

	public function create($data)
	{
		$cliente = $this->model->create($data);
		$cliente->senha = $data['senha'];
		$cliente->id_forma_inclusao = 7;
		$cliente->save();

		return $cliente;
	}

	public function update($data, $id)
	{
		$cliente = $this->findOrFail($id);
		$cliente->update($data);

		return $cliente;
	}
}
