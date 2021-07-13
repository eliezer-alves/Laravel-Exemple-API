<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;


class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\UserRepositoryInterface
     */
    public function all()
    {
        return $this->userRepository->all();
    }

    /**
     * Service Layer - Create the model in the database.
     *
     * @param  array  $attributes
     * @return App\Repositories\Contracts\UserRepositoryInterface
     */
    public function create($request)
    {
        return $this->userRepository->create($request);
    }


    /**
     * Service Layer - Find a model of the resource.
     *
     * @return App\Repositories\Contracts\UserRepositoryInterface
     */
    public function findOrFail($idUser)
    {
        return $this->userRepository->findOrFail($idUser);
    }


    /**
     * Service Layer - Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $idUser
     * @return App\Repositories\Contracts\UserRepositoryInterface
     */
    public function update($attributes, $idUser)
    {
        return $this->userRepository->update($attributes, $idUser);
    }


    /**
     * Service Layer - Delete the model in the database.
     *
     * @param  int  $idUser
     * @return App\Repositories\Contracts\UserRepositoryInterface
     */
    public function delete($idUser)
    {
        return $this->userRepository->delete($idUser);
    }
}
