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
}
