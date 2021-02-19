<?php
namespace App\Repositories\Contracts;

interface AbstractRepositoryInterface
{
	public function all();

	public function findOrFail(int $id);

	public function create(array $data);

	public function update(array $data, int $id);

	public function delete(int $id);
}

