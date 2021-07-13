<?php

namespace App\Http\Controllers;

use App\Services\TipoEmpresaService;
use Illuminate\Http\Request;

class TipoEmpresaController extends Controller
{
    public function __construct(TipoEmpresaService $service)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => ['required', 'string', 'between:1,120']
        ]);

        $request = _normalizeRequest($request->all());

        return $this->service->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $idTipoEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show($idTipoEmpresa)
    {
        return $this->service->findOrFail($idTipoEmpresa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $idTipoEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idTipoEmpresa)
    {
        $request->validate([
            'descricao' => ['string', 'between:1,120']
        ]);

        return $this->service->update($request->all(), $idTipoEmpresa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $idTipoEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($idTipoEmpresa)
    {
        return $this->service->delete($idTipoEmpresa);
    }
}
