<?php

namespace App\Http\Controllers;

use Route;

use App\Services\AssinaturaContratoService;
use GrahamCampbell\ResultType\Success;

/**
 * Class responsible for managing the
 * signing of Ágil contracts
 *
 * @author Eliezer Alves
 * @since 28/04/2021
 *
 */
class AssinaturaContratoController extends Controller
{
    private $defaultWarningAlert;

    public function __construct(AssinaturaContratoService $service)
    {
        parent::__construct($service);
        $this->defaultWarningAlert = 'Houve um problema ao registrar a sua assinatura! Tente novamente!';
    }

    /**
     * Show page to sign the first part of the contract.
     *
     * @since 28/04/2021
     *
     * @param  int  $idProposta
     * @param  int  $idPessoaAssinatura
     * @param  array  $warningAlerts
     * @param  array  $successAlerts
     * @return \Illuminate\View\View
     */
    public function showAceite1($idProposta, $idPessoaAssinatura, $warningAlerts = null, $successAlerts = null)
    {
        $data = $this->service->dadosProposta($idProposta);
        $data['successAlerts'] = $warningAlerts ? null : array_merge($data['successAlerts'] ?? [], ($successAlerts ?? ['Parabéns, você está muito próximo do seu dinheiro!']));
        $data['warningAlerts'] = array_merge($data['warningAlerts'] ?? [], $warningAlerts ?? []);

        $data['id_pessoa_assinatura'] = $idPessoaAssinatura;
        $data['linkAssinatura'] = 'assinatura.contrato-pj-1';

        return view('assinatura-contrato.pj.c_1', $data);
    }

    /**
     * The first part of the contract is effective
     *
     * @since 30/04/2021
     *
     * @param  int  $idProposta
     * @param  int  $idPessoaAssinatura
     * @return \Illuminate\View\View
     */
    public function aceite1($idProposta, $idPessoaAssinatura)
    {
        if($this->service->aceite1($idPessoaAssinatura, request()->ip())){
            return redirect(route('assinatura.contrato-pj-2.show', [$idProposta, $idPessoaAssinatura]));
        }

        return $this->showAceite1($idProposta, $idPessoaAssinatura, [$this->defaultWarningAlert]);
    }

    /**
     * Show page to sign the second part of the contract.
     *
     * @since 28/04/2021
     *
     * @param  int  $idProposta
     * @param  int  $idPessoaAssinatura
     * @param  array  $warningAlerts
     * @param  array  $successAlerts
     * @return \Illuminate\View\View
     */
    public function showAceite2($idProposta, $idPessoaAssinatura, $warningAlerts = null, $successAlerts = null)
    {
        $data = $this->service->dadosProposta($idProposta);
        $data['successAlerts'] = $warningAlerts ? null : array_merge($data['successAlerts'] ?? [], ($successAlerts ?? ['Agora só falta 1 aceite!']));
        $data['warningAlerts'] = array_merge($data['warningAlerts'] ?? [], $warningAlerts ?? []);
        $data['id_pessoa_assinatura'] = $idPessoaAssinatura;
        $data['linkAssinatura'] = 'assinatura.contrato-pj-2';

        return view('assinatura-contrato.pj.c_2', $data);
    }

    /**
     * Signature of the second part of the contract.
     *
     * @since 30/04/2021
     *
     * @param  int  $idProposta
     * @param  int  $idPessoaAssinatura
     * @return \Illuminate\View\View
     */
    public function aceite2($idProposta, $idPessoaAssinatura)
    {
        if($this->service->aceite2($idPessoaAssinatura, request()->ip())){
            // return redirect(route('pdf.contrato-pj.show', $idProposta));
            $data['successAlerts'][] = 'Parabéns, contrato assinado!';
            $data['pdfContrato'] = 'http://192.168.0.29/agil_externo/46616/public/printer/proposta/237055/dac31ad4c2fa82cd3b05a07ed16fe930';
            return view('assinatura-contrato.pj.c_2', $data);
        }

        return $this->showAceite2($idProposta, $idPessoaAssinatura, [$this->defaultWarningAlert]);
    }
}
