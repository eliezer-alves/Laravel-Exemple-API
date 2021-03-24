<?php

namespace App\Repositories\Eloquent;

use App\Models\Configuracao;
use App\Repositories\Contracts\ConfiguracaoRepositoryInterface;

class ConfiguracaoRepository extends AbstractRepository implements ConfiguracaoRepositoryInterface
{
	public function __construct(Configuracao $model)
	{
		parent::__construct($model);
	}
}
