<?php

namespace App\Services;

use App\Repositories\Contracts\UrlSicredRepositoryInterface;

class UrlSicredService
{
    private $urlSicredRepository;

    public function __construct(UrlSicredRepositoryInterface $urlSicredRepository)
    {
        $this->urlSicredRepository = $urlSicredRepository;
    }
}
