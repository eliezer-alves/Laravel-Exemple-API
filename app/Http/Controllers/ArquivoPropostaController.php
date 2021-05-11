<?php

namespace App\Http\Controllers;

use App\Services\ArquivoPropostaService;
use Illuminate\Http\Request;

/**
 * Class responsible for managing proposal-related files
 *
 * @author Eliezer Alves
 * @since 11/2021
 *
 */
class ArquivoPropostaController extends Controller
{

    public function __construct(ArquivoPropostaService $service)
    {
        $this->service = $service;
    }

    /**
     * Upload the company's social contract files
     *
     * @since 11/05/2021
     *
     * @param  Illuminate\Http\Request
     */
    public function createMany(Request $request)
    {
        return $this->service->createMany($request->all(), $request->id_proposta);
    }
}
