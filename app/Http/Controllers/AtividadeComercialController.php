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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $atividade_comercial = new AtividadeComercial($request->all());
        $atividade_comercial->save();

        return $atividade_comercial;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function show(AtividadeComercial $atividadeComercial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function edit(AtividadeComercial $atividadeComercial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtividadeComercial $atividadeComercial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AtividadeComercial  $atividadeComercial
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtividadeComercial $atividadeComercial)
    {
        //
    }
}
