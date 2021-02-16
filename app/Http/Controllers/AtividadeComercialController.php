<?php

namespace App\Http\Controllers;

use App\Models\AtividadeComercial;
use Illuminate\Http\Request;

class AtividadeComercialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AtividadeComercial::all();
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
            'atividade' => ['required', 'string', 'between:1,120']
        ]);

        $atividadeComercial = new AtividadeComercial($request->all());
        $atividadeComercial->save();

        return $atividadeComercial;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function show($id_atividade_comercial)
    {
        return AtividadeComercial::findOrFail($id_atividade_comercial);
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
            'atividade' => ['required', 'string', 'between:1,120']
        ]);

        $atividadeComercial = $this->show($id_atividade_comercial);
        $atividadeComercial->update($request->all());

        return $atividadeComercial;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_atividade_comercial)
    {
        $atividadeComercial = $this->show($id_atividade_comercial);
        $atividadeComercial->delete();

        return;
    }
}
