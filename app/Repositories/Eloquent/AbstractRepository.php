<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AbstractRepositoryInterface;

abstract class AbstractRepository implements AbstractRepositoryInterface
{
	protected $model;

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function all()
	{
		return $this->model->all();
	}

	public function findOrFail($id)
	{
		return $this->model->findOrFail($id);
	}

	public function create($data)
	{
		$entity = $this->model->create($data);
		return $entity;
	}

	public function update($data, $id)
	{
		$entity = $this->findOrFail($id);
		$entity->update($data);

		return $entity;
	}

	public function delete($id)
	{
		$entity = $this->findOrFail($id);
		return $entity->delete($id);
	}
}
