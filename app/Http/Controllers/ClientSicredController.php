<?php

namespace App\Http\Controllers;

use App\Services\ClientSicredService;

use App\Http\Requests\ClientSicredRequest;

class ClientSicredController extends Controller
{
    protected $serviceLayer;
    protected $route;

    public function __construct(ClientSicredService $service)
    {
        $this->service = $service;
        $this->route = 'admin.client-sicred';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados['clients'] = $this->service->all();
        return view('admin.client_sicred', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientSicredRequest $request)
    {
        $this->service->create($request);
        return redirect()->route($this->route);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ClientSicredRequest  $request
     * @param  int  $idModeloSicred
     * @return redirect()
     */
    public function update(ClientSicredRequest $request, $idModeloSicred)
    {
        $this->service->update($request, $idModeloSicred);
        return redirect()->route($this->route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idModeloSicred
     * @return redirect()
     */
    public function destroy($idModeloSicred)
    {
        $this->service->delete($idModeloSicred);
        return redirect()->route($this->route);
    }
}
