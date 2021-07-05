<?php

namespace App\Services\CCB;

use App\Models\Proposta;
use App\Services\Contracts\CcbServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use PDF;

class CcbPjService implements CcbServiceInterface
{
    private $proposta;

    public function __construct(Proposta $proposta)
    {
        $this->proposta = $proposta;
        $this->proposta->parcelas;
        $this->proposta->calcularValorTotalJuros();
        $this->proposta->clienteAssinatura->tipoLogradouro;
        $this->proposta->clienteAssinatura->tipoEmpresa;
        $this->proposta->representante->tipoLogradouro;
        $this->proposta->assinaturas;
        $this->proposta->socios->map(function ($socio) {
            $socio->tipoLogradouro;
        });
        $this->proposta = $this->proposta->toArray();
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $this->proposta['mes_geracao_proposta'] = strftime('%B', strtotime($this->proposta['data_geracao_proposta']));
    }

    public function pdf($path = NULL): bool
    {
        try {
            PDF::reset();
            PDF::SetTitle($this->proposta['contrato']);
            PDF::AddPage();
            PDF::writeHTML(view('pdf.ccb-pj', $this->proposta), true, false, true, false, '');

            $file = "CCB".$this->proposta['contrato'].'.pdf';
            if($path != NULL){
                $file = public_files_path($path) .'/'. $file;
                PDF::Output($file, 'F');
                return file_exists($file);
            }else{
                PDF::Output($file);
                exit;
            }
        } catch (Exception $e) {
            Log::channel('failedActions')->error("Erro ao gerar pdf da CCB " . $this->proposta['contrato'] . " : " . $e->getMessage(), ['status' => 500]);
        }

        return false;
    }
}
