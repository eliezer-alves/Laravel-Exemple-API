<?php

namespace App\Repositories\Eloquent;

use App\Models\AtividadeComercial;
use App\Repositories\Contracts\AtividadeComercialRepositoryInterface;

class AtividadeComercialRepository extends AbstractRepository implements AtividadeComercialRepositoryInterface
{
	public function __construct(AtividadeComercial $model)
	{
		parent::__construct($model);
	}

	public function all()
	{
		return AtividadeComercial::orderBy('id_atividade_comercial', 'asc')->get();
	}
}
