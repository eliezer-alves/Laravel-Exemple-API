<?php

namespace App\Http\Controllers;

use App\Services\TipoEmpresaService;
use Illuminate\Http\Request;

class TipoEmpresaController extends Controller
{
    public function __construct(TipoEmpresaService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->service->all();
    }
}
