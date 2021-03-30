<?php

namespace App\Http\Controllers;

use App\Http\Requests\NovaPropostaPJRequest;
use App\Services\PropostaService;

use Illuminate\Http\Request;

class PropostaController extends Controller
{
    public function __construct(PropostaService $service)
    {
        parent::__construct($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\NovaPropostaPJRequest;
     * @return \Illuminate\Http\Response
     */
    public function novaProposta(NovaPropostaPJRequest $request)
    {
        return $request->all();
        return $this->service->novaProposta($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $numeroProposta
     * @return \Illuminate\Http\Response
     */
    public function exibeProposta($numeroProposta)
    {
        return $this->service->exibeProposta($numeroProposta);
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
