<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObservacaoProposta;
use App\Services\ObservacaoPropostaService;
use Illuminate\Http\Request;

/**
 * Class responsible for managing the observations of a proposal
 *
 * @author Eliezer Alves
 * @since 02/06/2021
 *
 */
class ObservacaoProposta extends Controller
{

    public function __construct(ObservacaoPropostaService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $idProposta
     * @return \Illuminate\Http\Response
     */
    public function index($idProposta)
    {
        return $this->service->all($idProposta);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreObservacaoProposta $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreObservacaoProposta $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idObservacaoProposta
     * @return \Illuminate\Http\Response
     */
    public function show($idObservacaoProposta)
    {
        return $this->service->findOrFail($idObservacaoProposta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreObservacaoProposta  $request
     * @param  int  $idObservacaoProposta
     * @return \Illuminate\Http\Response
     */
    public function update(StoreObservacaoProposta $request, $idObservacaoProposta)
    {
        return $this->sevice->update($request->all(), $idObservacaoProposta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idObservacaoProposta
     * @return \Illuminate\Http\Response
     */
    public function destroy($idObservacaoProposta)
    {
        return $this->sevice->delete($idObservacaoProposta);
    }
}
