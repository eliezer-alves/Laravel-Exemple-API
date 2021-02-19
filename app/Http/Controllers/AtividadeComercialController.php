<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\AtividadeComercialRepositoryInterface;

class AtividadeComercialController extends Controller
{
    protected $repository;

    public function __construct(AtividadeComercialRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AtividadeComercial::orderBy('id_atividade_comercial', 'asc')->get();
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

        return $this->repository->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function show($id_atividade_comercial)
    {
        return $this->repository->findOrFail($id_atividade_comercial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_atividade_comercial)
    {
        $request->validate([
            'descricao' => ['string', 'between:1,120']
        ]);

        return $this->repository->update($request, $id_atividade_comercial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_atividade_comercial)
    {
        return $this->repository->delete($id_atividade_comercial);
    }
}
