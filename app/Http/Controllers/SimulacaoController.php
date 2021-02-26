<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SimulacaoService;

class SimulacaoController extends Controller
{
    protected $simulacaoService;

    public function __construct(SimulacaoService $simulacaoService)
    {
        $this->simulacaoService = $simulacaoService;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->simulacaoService->simular($request);
    }
}
