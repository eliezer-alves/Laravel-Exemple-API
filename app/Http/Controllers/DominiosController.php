<?php

namespace App\Http\Controllers;

use App\Services\DominiosService;
use Illuminate\Http\Request;

class DominiosController extends Controller
{
    protected $dominiosService;

    public function __construct(DominiosService $dominiosService)
    {
        $this->dominiosService = $dominiosService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->dominiosService->dominios();
    }
}
