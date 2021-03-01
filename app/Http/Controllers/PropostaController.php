<?php

namespace App\Http\Controllers;

use App\Http\Requests\NovaPropostaRequest;
use App\Services\PropostaService;

use Illuminate\Http\Request;

class PropostaController extends Controller
{
    protected $propostaService;

    public function __construct(PropostaService $propostaService)
    {
        $this->propostaService = $propostaService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function novaProposta(NovaPropostaRequest $request)
    {
        return $this->propostaService->novaProposta($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $numeroProposta
     * @return \Illuminate\Http\Response
     */
    public function exibeProposta($numeroProposta)
    {
        return $this->propostaService->exibeProposta($numeroProposta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
