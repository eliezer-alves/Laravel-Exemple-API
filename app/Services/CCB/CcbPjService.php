<?php

namespace App\Services\CCB;

use App\Models\Proposta;
use App\Services\Contracts\CcbServiceInterface;
use PDF;

class CcbPjService implements CcbServiceInterface
{
    private $proposta;
    public function __construct(Proposta $proposta)
    {
        $this->proposta = $proposta;
    }

    public function pdf()
    {
        $this->proposta->parcelas;
        $this->proposta->clienteAssinatura->tipoLogradouro;
        $this->proposta->clienteAssinatura->tipoEmpresa;
        $this->proposta->representante->tipoLogradouro;
        $this->proposta->assinaturas;
        $this->proposta->socios->map(function ($socio) {
            $socio->tipoLogradouro;
        });
        $proposta = $this->proposta->toArray();

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $proposta['mes_geracao_proposta'] = strftime('%B', strtotime($proposta['data_geracao_proposta']));

        PDF::SetTitle($proposta['contrato']);
        PDF::AddPage();
        PDF::writeHTML(view('pdf.ccb-pj', $proposta), true, false, true, false, '');
        PDF::Output($proposta['contrato'].'_'.date('Y-m-d').'.pdf');
        exit();
    }
}