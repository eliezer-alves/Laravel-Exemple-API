<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\{
    ClienteService,
    GacWebService
};

class TesteController extends Controller
{
    protected $clienteService;
    protected $webService;

    public function __construct(ClienteService $clienteService, GacWebService $webService)
    {
        $this->clienteService = $clienteService;
        $this->webService = $webService;
        $this->webService->hydrator_bolt();
    }


    public function teste(Request $request)
    {
        return $this->clienteService->getClienteBoltByCnpj('10101010100');
    }
}
