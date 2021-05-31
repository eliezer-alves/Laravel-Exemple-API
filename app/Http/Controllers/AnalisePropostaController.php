<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlterarDadosPropostaAnaliseRequest;
use App\Services\PropostaService;
use Illuminate\Http\Request;

/**
 * Class responsible for managing
 * the proposal analysis process
 *
 * @author Eliezer Alves
 * @since 24/05/2021
 *
 */
class AnalisePropostaController extends Controller
{
    public function __construct(PropostaService $service)
    {
        parent::__construct($service);
    }

    /**
     * Updates all information related
     * to a proposal under review
     *
     * @author Eliezer Alves
     *
     * @param  App\Http\Requests\AlterarDadosPropostaAnaliseRequest;
     * @return \Illuminate\Http\Response
     */
    public function dadosPropostaAnalise($idProposta)
    {
        return $this->service->getDadosPropostaAnalise($idProposta);
    }


    /**
     * Updates all information related
     * to a proposal under review
     *
     * @author Eliezer Alves
     *
     * @param  App\Http\Requests\AlterarDadosPropostaAnaliseRequest;
     * @return \Illuminate\Http\Response
     */
    public function alterarDadosProposta(AlterarDadosPropostaAnaliseRequest $request)
    {
        return $this->service->alterarDadosProposta($request->all());
    }

}
