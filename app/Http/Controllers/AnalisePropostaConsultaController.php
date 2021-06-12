<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalisePropostaConsultaRequest;
use App\Services\AnalisePropostaConsultaService;
use Illuminate\Http\Request;

/**
 * Class responsible for managing the credit agencies queries
 *
 * @author Eliezer Alves
 * @since 12/06/2021
 *
 */
class AnalisePropostaConsultaController extends Controller
{
    public function __construct(AnalisePropostaConsultaService $service)
    {
        parent::__construct($service);
    }


    public function confirmeOnline(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->confirmeOnline($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }

    public function debito(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->debito($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }

    public function infomaisEndereco(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->infomaisEndereco($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }

    public function infomaisSituacao(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->infomaisSituacao($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }

    public function infomaisTelefone(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->infomaisTelefone($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }

    public function scpcDebito(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->scpcDebito($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }

    public function scpcScore(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->scpcScore($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }

    public function scr(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->scr($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }

    public function spcBrasil(AnalisePropostaConsultaRequest $request)
    {
        return $this->service->spcBrasil($request->id_analise_proposta, $request->id_pessoa_assinatura);
    }
}
