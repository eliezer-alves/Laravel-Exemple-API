<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\ClienteRepositoryInterface;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

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
        // return Cliente::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_cliente)
    {
        return $this->repository->findOrFail($id_cliente);
        // return Cliente::findOrFail($id_cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, $id_cliente)
    {
        $request = _normalizeRequest($request->all());
        return $this->repository->update($request, $id_cliente);

        $usuario = $this->show($id_cliente);
        $usuario->update($request);

        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_cliente)
    {
        return $this->repository->delete($id_cliente);
    }
}
