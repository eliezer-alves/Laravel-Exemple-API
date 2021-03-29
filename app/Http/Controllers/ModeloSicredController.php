<?php

namespace App\Http\Controllers;

use App\Services\ModeloSicredService;

use App\Http\Requests\ModeloSicredRequest;
use Illuminate\Http\Request;

class ModeloSicredController extends Controller
{
    protected $modeloSicredService;

    public function __construct(ModeloSicredService $modeloSicredService)
    {
        $this->modeloSicredService = $modeloSicredService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados['modelos'] = $this->modeloSicredService->all();
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
        $this->modeloSicredService->create($request);
        return redirect()->route('admin.modelo-sicred');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->modeloSicredService->update($request, $idModeloSicred);
        return redirect()->route('admin.modelo-sicred');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idModeloSicred
     * @return redirect()
     */
    public function destroy($idModeloSicred)
    {
        $this->modeloSicredService->delete($idModeloSicred);
        return redirect()->route('admin.modelo-sicred');
    }
}
