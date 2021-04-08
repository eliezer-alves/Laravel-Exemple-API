<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    public function __construct(ClienteService $service)
    {
        parent::__construct($service);
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
        return $this->service->createWithUser($request->all());
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
        return $this->service->update($request->all(), $idCliente);
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

    /**
     * Find PJ client for CNPJ for attendance.
     *
     * @param  string  $cnpj
     * @return \Illuminate\Http\Response
     */
    public function findByCnpjForAttendance($cnpj)
    {
        return $this->service->findByCnpjForAttendance($cnpj);
    }
}
