<?php

namespace App\Http\Controllers;

use App\Services\DominiosService;
use Illuminate\Http\Request;

/**
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class DominiosController extends Controller
{

    public function __construct(DominiosService $service)
    {
        parent::__construct($service);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->service->dominios();
    }
}
