<?php
namespace App\Repositories\Eloquent;

use App\Models\Cliente;

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
}

?>
