<?php

namespace App\Http\Controllers;

use App\Services\CosifService;
use Illuminate\Http\Request;

class CosifController extends Controller
{
    public function __construct(CosifService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->service->all();
    }
}
