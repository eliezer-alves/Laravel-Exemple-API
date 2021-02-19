<?php
namespace App\Repositories\Contracts;

interface ClienteRepositoryInterface
{
	public function all();

	public function findOrFail(int $id);

	public function delete(int $id);
}

?>

