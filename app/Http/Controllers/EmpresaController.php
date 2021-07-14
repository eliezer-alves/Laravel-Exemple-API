<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Services\EmpresaService;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct(EmpresaService $service)
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
     * @param  \Illuminate\Http\StoreEmpresaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpresaRequest $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show($idEmpresa)
    {
        return $this->service->findOrFail($idEmpresa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateEmpresaRequest $request
     * @param  int  $idEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpresaRequest $request, $idEmpresa)
    {
        return $this->service->update($request->all(), $idEmpresa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($idEmpresa)
    {
        return $this->service->delete($idEmpresa);
    }

    /**
     * Customer search by cnpj for service.
     *
     * @param  string  $cnpj
     * @return \Illuminate\Http\Response
     */
    public function findByCnpj($cnpj)
    {
        return $this->service->findByCnpjForAtendence($cnpj);
    }
}
