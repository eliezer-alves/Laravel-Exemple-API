<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlterarDadosPropostaAnaliseRequest;
use App\Services\AnalisePropostaService;
use App\Services\PropostaService;
use Illuminate\Http\Request;

/**
 * Class responsible for managing the proposal analysis process
 *
 * @author Eliezer Alves
 * @since 24/05/2021
 *
 */
class AnalisePropostaController extends Controller
{
    private $propostaService;

    public function __construct(AnalisePropostaService $service, PropostaService $propostaService)
    {
        parent::__construct($service);
        $this->propostaService = $propostaService;
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
        return $this->propostaService->getDadosPropostaAnalise($idProposta);
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
        return $this->propostaService->alterarDadosProposta($request->all());
    }

    /**
     * Method responsible for completing the analysis of the proposal
     *
     * @author Eliezer Alves
     *
     * @param int $idProposta
     * @return \Illuminate\Http\Response
     */
    public function concluirAnaliseProposta(Request $request, $idProposta)
    {
        return $this->service->concluirAnaliseProposta($request->all(), $idProposta);
    }

}
