<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

use App\Repositories\Contracts\ClienteRepositoryInterface;

class ClienteController extends Controller
{
    protected $repository;

    public function __construct(ClienteRepositoryInterface $repository){
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreClienteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $request = _normalizeRequest($request->all());

        return $this->repository->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idCliente
     * @return \Illuminate\Http\Response
     */
    public function show($idCliente)
    {
        return $this->repository->findOrFail($idCliente);
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
        $request = _normalizeRequest($request->all());
        return $this->repository->update($request, $idCliente);

        $usuario = $this->show($idCliente);
        $usuario->update($request);

        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCliente)
    {
        return $this->repository->delete($idCliente);
    }
}
