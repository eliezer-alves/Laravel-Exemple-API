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
		$entity = $this->findOrFail($id);
		$entity->senha = $data['senha'];
		$entity->update($data);

		return $entity;
	}
}