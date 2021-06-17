<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaPropostaGacConsultaRequest;
use App\Services\PessoaPropostaGacConsultaService;

/**
 * Service Layer - Class responsible for consult entity in the consultation bodies
 *
 * @author Eliezer Alves
 * @since 15/06/2021
 *
 */
class PessoaPropostaGacConsultaController extends Controller
{
    public function __construct(PessoaPropostaGacConsultaService $service)
    {
        parent::__construct($service);
    }


    public function confirmeOnline(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->confirmeOnline($request->all());
    }

    public function debito(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->debito($request->all());
    }

    public function infomaisEndereco(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->infomaisEndereco($request->all());
    }

    public function infomaisSituacao(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->infomaisSituacao($request->all());
    }

    public function infomaisTelefone(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->infomaisTelefone($request->all());
    }

    public function scpcDebito(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->scpcDebito($request->all());
    }

    public function scpcDebitoCnpj(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->scpcDebitoCnpj($request->all());
    }

    public function scpcScore(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->scpcScore($request->all());
    }

    public function scr(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->scr($request->all());
    }

    public function spcBrasil(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->spcBrasil($request->all());
    }

    public function spcBrasilPlus(PessoaPropostaGacConsultaRequest $request)
    {
        return $this->service->spcBrasilPlus($request->all());
    }
}
