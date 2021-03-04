<?php

namespace App\Services;

use App\Repositories\Contracts\ClientSicredRepositoryInterface;

class ClientSicredService
{

    protected $clientSicredRepository;

    public function __construct(ClientSicredRepositoryInterface $clientSicredRepository)
    {
        $this->clientSicredRepository = $clientSicredRepository;
    }

    public function all()
    {
        return $this->clientSicredRepository->all()->toArray();
    }
}
