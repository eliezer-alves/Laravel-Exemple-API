<?php

namespace App\Services;

use App\Repositories\Eloquent\AtividadeComercialRepository;

class AtividadeComercialService
{
	protected $repository;

	public function __construct(AtividadeComercialRepository $repository)
	{
		$this->repository = $repository;
	}

	public function all()
	{
		return $this->repository->all();
	}

	public function create($request)
	{
		return $this->repository->create($request);
	}

	public function findOrFail($idAtividadeComercial)
	{
		return $this->repository->findOrFail($idAtividadeComercial);
	}

	public function update($request, $idAtividadeComercial)
	{
		return $this->repository->update($request, $idAtividadeComercial);
	}

	public function delete($idAtividadeComercial)
	{
		return $this->repository->delete($idAtividadeComercial);
	}
}
