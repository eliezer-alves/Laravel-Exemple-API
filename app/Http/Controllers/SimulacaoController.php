<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\SimulacaoRequest;
use App\Services\SimulacaoService;

class SimulacaoController extends Controller
{
    protected $simulacaoService;

    public function __construct(SimulacaoService $simulacaoService)
    {
        $this->simulacaoService = $simulacaoService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SimulacaoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function novaSimulacao(SimulacaoRequest $request)
    {
        return $this->simulacaoService->novaSimulacao($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idSimulacao
     * @return \Illuminate\Http\Response
     */
    public function show($idSimulacao)
    {
        return $this->simulacaoService->show($idSimulacao);
    }
}
