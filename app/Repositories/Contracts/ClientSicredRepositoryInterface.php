<?php

namespace App\Repositories\Contracts;

interface ClientSicredRepositoryInterface extends AbstractRepositoryInterface
{
	public function findEnvironment(string $environment);
}
