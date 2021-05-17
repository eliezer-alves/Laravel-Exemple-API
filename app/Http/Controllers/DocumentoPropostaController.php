<?php

namespace App\Http\Controllers;

use App\Exceptions\DbException;
use App\Services\DocumentoPropostaService;
use Illuminate\Http\Request;

/**
 * Class responsible for managing proposal-related files
 *
 * @author Eliezer Alves
 * @since 11/2021
 *
 */
class DocumentoPropostaController extends Controller
{
    public function __construct(DocumentoPropostaService $service)
    {
        $this->service = $service;
    }

    /**
     * Save the files related to the proposal
     *
     * @since 11/05/2021
     *
     * @param  Illuminate\Http\Request
     */
    public function createMany(Request $request)
    {
        return $this->service->createMany($request->all(), $request->id_proposta);
    }

    /**
     * Save files related to the proposal by the proposal number
     *
     * @since 17/05/2021
     *
     * @param  Illuminate\Http\Request
     */
    public function createManyByNumero(Request $request)
    {
        return $this->service->createManyByNumero($request->all(), $request->numero_proposta);
    }
}
