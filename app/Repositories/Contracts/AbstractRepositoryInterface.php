<?php

namespace App\Repositories\Contracts;

interface AbstractRepositoryInterface
{
    public function fill(array $data);

    public function all();

    public function find(int $id);

    public function findOrFail(int $id);

    public function where(string $column, $value);

    public function firstWhere(string $column, $value);

    public function whereIn(string $column, array $arrayValues);

    public function create(array $attributes);

    /**
     * Method to create multiple entities
     *
     *@param  array $entities entity array
     */
    public function createMany(array $entities);

    /**
     * Method to update multiple entities
     *
     * @param  array $entities entity array
     * @return bool $throwExceptionInParticularEntity - Boolean value that specifies whether to throw an exception when it occurs in the operation of a particular entity. If disabled, if an exception occurs in the operation of any entity, the exception will be ignored and the program will limit itself to recording a log and will continue to run.
     */
    public function updateMany(array $entities, bool $throwExceptionInParticularEntity = true);

    public function update(array $attributes, int $id);

    public function delete(int $id);
}
