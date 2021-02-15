<?php

namespace App\Http\Controllers;

use App\Models\RamoAtividade;
use Illuminate\Http\Request;

class RamoAtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RamoAtividade::all();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RamoAtividade  $ramoAtividade
     * @return \Illuminate\Http\Response
     */
    public function show(RamoAtividade $ramoAtividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RamoAtividade  $ramoAtividade
     * @return \Illuminate\Http\Response
     */
    public function edit(RamoAtividade $ramoAtividade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RamoAtividade  $ramoAtividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RamoAtividade $ramoAtividade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RamoAtividade  $ramoAtividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(RamoAtividade $ramoAtividade)
    {
        //
    }
}
