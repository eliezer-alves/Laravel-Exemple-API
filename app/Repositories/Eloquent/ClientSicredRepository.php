<?php

namespace App\Repositories\Eloquent;

use App\Models\ClientSicred;
use App\Repositories\Contracts\ClientSicredRepositoryInterface;

class ClientSicredRepository extends AbstractRepository implements ClientSicredRepositoryInterface
{
	public function __construct(ClientSicred $model)
	{
		parent::__construct($model);
	}

	public function findEnvironment($everioment)
	{
		return $this->firstWhere('environment', $everioment);
	}
}
