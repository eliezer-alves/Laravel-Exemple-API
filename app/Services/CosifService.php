<?php

namespace App\Services;

use App\Repositories\Contracts\CosifRepositoryInterface;

class CosifService
{
    protected $cosifRepository;

    public function __construct(CosifRepositoryInterface $cosifRepository)
    {
        $this->cosifRepository = $cosifRepository;
    }

    /**
     * Service Layer - Get a listing of the resource.
     *
     * @return App\Repositories\Contracts\CosifRepositoryInterface
     */
    public function all()
    {
        return $this->cosifRepository->all();
    }
}
