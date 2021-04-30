<?php

namespace App\Http\Controllers;

use Route;

use App\Services\AssinaturaContratoService;

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
    public function __construct(AssinaturaContratoService $service)
    {
        parent::__construct($service);
    }

    /**
     * Show page to sign the first part of the contract.
     *
     * @since 28/04/2021
     *
     * @param  int  $idProposta
     * @return \Illuminate\View\View
     */
    public function showAceite1($idProposta)
    {
        $data = $this->service->dadosProposta($idProposta);
        $data['successMessages'][] = 'Parbéns, você está muito próximo do seu dinheiro!';

        $data['linkAssinatura'] = 'assinatura.contrato-pj-1';

        return view('assinatura-contrato.pj.c_1', $data);
    }

    /**
     * The first part of the contract is effective
     *
     * @since 30/04/2021
     *
     * @param  int  $idProposta
     * @return \Illuminate\View\View
     */
    public function aceite1($idProposta)
    {
        return redirect(route('assinatura.contrato-pj-2.show', $idProposta));
    }

    /**
     * Show page to sign the second part of the contract.
     *
     * @since 28/04/2021
     *
     * @param  string $hash
     * @return \Illuminate\View\View
     */
    public function showAceite2($idProposta)
    {
        $data = $this->service->dadosProposta($idProposta);
        $data['successMessages'][] = 'Agora só falta mais um aceite!';
        $data['linkAssinatura'] = 'assinatura.contrato-pj-2';
        return view('assinatura-contrato.pj.c_2', $data);
    }

    /**
     * Signature of the second part of the contract.
     *
     * @since 30/04/2021
     *
     * @param  int  $idProposta
     * @return \Illuminate\View\View
     */
    public function aceite2($idProposta)
    {
        return redirect(route('pdf.contrato-pj.show', $idProposta));
    }
}
