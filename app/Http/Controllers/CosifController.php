<?php

namespace App\Http\Controllers;

use App\Services\CosifService;
use Illuminate\Http\Request;

class CosifController extends Controller
{
    public function __construct(CosifService $service)
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
     * @param  int $idCosif
     * @return \Illuminate\Http\Response
     */
    public function show($idCosif)
    {
        return $this->service->findOrFail($idCosif);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $idCosif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCosif)
    {
        $request->validate([
            'descricao' => ['string', 'between:1,120']
        ]);

        return $this->service->update($request->all(), $idCosif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $idCosif
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCosif)
    {
        return $this->service->delete($idCosif);
    }
}
