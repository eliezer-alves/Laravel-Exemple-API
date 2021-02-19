<?php
namespace App\Repositories\Eloquent;

abstract class AbstractRepository
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

	public function delete($id)
	{
		$entity = $this->findOrFail($id);
		return $entity->delete($id);
	}
}

?>
