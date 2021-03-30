<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AtividadeComercialService;

class AtividadeComercialController extends Controller
{
    public function __construct(AtividadeComercialService $service)
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
        // return AtividadeComercial::orderBy('id_atividade_comercial', 'asc')->get();
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
     * @param  int $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function show($idAtividadeComercial)
    {
        return $this->service->findOrFail($idAtividadeComercial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $idAtividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idAtividadeComercial)
    {
        $request->validate([
            'descricao' => ['string', 'between:1,120']
        ]);

        return $this->service->update($request->all(), $idAtividadeComercial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $idAtividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function destroy($idAtividadeComercial)
    {
        return $this->service->delete($idAtividadeComercial);
    }
}
