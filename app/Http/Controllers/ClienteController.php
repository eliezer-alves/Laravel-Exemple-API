<?php

namespace App\Http\Controllers;

use App\Http\Requests\S;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return $this->clienteService->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreClienteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(S $request)
    {
        return $this->clienteService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idCliente
     * @return \Illuminate\Http\Response
     */
    public function show($idCliente)
    {
        return $this->clienteService->findOrFail($idCliente);
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
        return $this->clienteService->update($request, $idCliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCliente)
    {
        return $this->clienteService->delete($idCliente);
    }
}
