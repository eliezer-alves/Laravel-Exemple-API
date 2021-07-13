<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PorteEmpresaService;


class PorteEmpresaController extends Controller
{
    public function __construct(PorteEmpresaService $service)
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
     * @param  int $idPorteEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show($idPorteEmpresa)
    {
        return $this->service->findOrFail($idPorteEmpresa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $idPorteEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idPorteEmpresa)
    {
        $request->validate([
            'descricao' => ['string', 'between:1,120']
        ]);

        return $this->service->update($request->all(), $idPorteEmpresa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $idPorteEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPorteEmpresa)
    {
        return $this->service->delete($idPorteEmpresa);
    }
}
