<?php

namespace App\Repositories\Eloquent;

use App\Models\AnaliseProposta;
use App\Repositories\Contracts\AnalisePropostaRepositoryInterface;

class AnalisePropostaRepository extends AbstractRepository implements AnalisePropostaRepositoryInterface
{
	public function __construct(AnaliseProposta $model)
	{
		parent::__construct($model);
	}
}
