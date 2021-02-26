<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    protected $service;

    public function __construct(ClienteService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return $this->service->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreClienteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        return $this->service->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idCliente
     * @return \Illuminate\Http\Response
     */
    public function show($idCliente)
    {
        return $this->service->findOrFail($idCliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateClienteRequest $request
     * @param  int  $idCliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, $idCliente)
    {
        return $this->service->update($request, $idCliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCliente)
    {
        return $this->service->delete($idCliente);
    }
}
