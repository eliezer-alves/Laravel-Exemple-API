<?php

namespace App\Http\Controllers;

use App\Http\Requests\NovaPropostaPJRequest;
use App\Services\PropostaService;

use Illuminate\Http\Request;

/**
 *
 * @author Eliezer Alves
 * @since 19/04/2021
 *
 */
class PropostaController extends Controller
{
    public function __construct(PropostaService $service)
    {
        parent::__construct($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Eliezer Alves
     *
     * @param  App\Http\Requests\NovaPropostaPJRequest;
     * @return \Illuminate\Http\Response
     */
    public function novaProposta(NovaPropostaPJRequest $request)
    {
        return $this->service->novaProposta($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @author Eliezer Alves
     *
     * @param  int  $numeroProposta
     * @return \Illuminate\Http\Response
     */
    public function dadosProposta($numeroProposta)
    {
        return $this->service->getDadosProposta($numeroProposta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Eliezer Alves
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
     * @author Eliezer Alves
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
