<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaGacConsultaRequest;
use App\Services\PessoaAssinaturaGacConsultaService;

/**
 * Service Layer - Class responsible for consult entity in the consultation bodies
 *
 * @author Eliezer Alves
 * @since 15/06/2021
 *
 */
class AnalisePropostaConsultaController extends Controller
{
    public function __construct(PessoaAssinaturaGacConsultaService $service)
    {
        parent::__construct($service);
    }


    public function confirmeOnline(PessoaGacConsultaRequest $request)
    {
        return $this->service->confirmeOnline($request->all());
    }

    public function debito(PessoaGacConsultaRequest $request)
    {
        return $this->service->debito($request->all());
    }

    public function infomaisEndereco(PessoaGacConsultaRequest $request)
    {
        return $this->service->infomaisEndereco($request->all());
    }

    public function infomaisSituacao(PessoaGacConsultaRequest $request)
    {
        return $this->service->infomaisSituacao($request->all());
    }

    public function infomaisTelefone(PessoaGacConsultaRequest $request)
    {
        return $this->service->infomaisTelefone($request->all());
    }

    public function scpcDebito(PessoaGacConsultaRequest $request)
    {
        return $this->service->scpcDebito($request->all());
    }

    public function scpcScore(PessoaGacConsultaRequest $request)
    {
        return $this->service->scpcScore($request->all());
    }

    public function scr(PessoaGacConsultaRequest $request)
    {
        return $this->service->scr($request->all());
    }

    public function spcBrasil(PessoaGacConsultaRequest $request)
    {
        return $this->service->spcBrasil($request->all());
    }
}
