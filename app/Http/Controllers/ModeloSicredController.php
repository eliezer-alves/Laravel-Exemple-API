<?php

namespace App\Http\Controllers;

use App\Services\ModeloSicredService;

use App\Http\Requests\ModeloSicredRequest;
use Illuminate\Http\Request;

/**
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class ModeloSicredController extends Controller
{
    private $route;

    public function __construct(ModeloSicredService $service)
    {
        parent::__construct($service);
        $this->route = 'admin.modelo-sicred';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados['modelos'] = $this->service->all();
        return view('admin.modelo_sicred', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloSicredRequest $request)
    {
        $this->service->create($request->all());
        return redirect()->route($this->route);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ModeloSicredRequest  $request
     * @param  int  $idModeloSicred
     * @return redirect()
     */
    public function update(ModeloSicredRequest $request, $idModeloSicred)
    {
        $this->service->update($request->all(), $idModeloSicred);
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
