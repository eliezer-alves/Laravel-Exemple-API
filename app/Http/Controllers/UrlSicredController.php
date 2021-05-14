<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlSicredRequest;
use App\Services\UrlSicredService;
use Illuminate\Http\Request;

/**
 * Class responsible for managing Sicred's urls
 *
 * @author Eliezer Alves
 * @since 13/05/2021
 */
class UrlSicredController extends Controller
{
    private $route;

    public function __construct(UrlSicredService $service)
    {
        parent::__construct($service);
        $this->route = 'admin.url-sicred';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['urls'] = $this->service->all();
        return view('admin.url_sicred', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlSicredRequest $request)
    {
        $this->service->create($request->all());
        return redirect()->route($this->route);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idUrlSicred)
    {
        $this->service->update($request->all(), $idUrlSicred);
        return redirect()->route($this->route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idUrlSicred
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUrlSicred)
    {
        $this->service->delete($idUrlSicred);
        return redirect()->route($this->route);
    }
}
