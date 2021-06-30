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
    public function dadosPropostaAnalise(Request $request)
    {
        $request->validate([
            'id_proposta' => ['required', 'numeric', 'exists:cad_proposta,id_proposta'],
            'id_usuario' => ['required', 'numeric', 'exists:cad_usuario,id_usuario'],
        ]);
        return $this->service->getDadosPropostaAnalise($request->id_proposta, $request->id_usuario);
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
     * Manual proposal review process logs
     *
     * @author Eliezer Alves
     *
     * @param  int $idProposta
     * @return \Illuminate\Http\Response
     */
    public function logsAnaliseProposta($idProposta)
    {
        return $this->service->logsAnaliseProposta($idProposta);
    }
}
