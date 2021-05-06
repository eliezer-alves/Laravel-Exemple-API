<?php

namespace App\Http\Controllers;

use App\Services\PropostaAssinaturaService;
use App\Http\Requests\EmailAssinaturaRequest;
use Illuminate\Support\Facades\Crypt;

/**
 * Class responsible for managing the
 * signing of Ágil contracts
 *
 * @author Eliezer Alves
 * @since 28/04/2021
 *
 */
class PropostaAssinaturaController extends Controller
{
    private $defaultWarningAlert;

    public function __construct(PropostaAssinaturaService $service)
    {
        parent::__construct($service);
        $this->defaultWarningAlert = 'Houve um problema ao registrar a sua assinatura! Tente novamente!';
    }

    /**
     * Returns proposal signature link
     *
     * @since 05/05/2021
     *
     * @param App\Http\Requests\EmailAssinaturaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function enviaLinkAssinatura(EmailAssinaturaRequest $request)
    {
        $this->service->enviaLinkAssinatura($request->all());
    }

    /**
     * Returns proposal signature link
     *
     * @since 05/05/2021
     *
     * @param int $idProposta
     * @param int $idPessoaAssinatura
     * @return \Illuminate\Http\Response
     */
    public function linkAssinatura($idProposta, $idPessoaAssinatura)
    {
        return $this->service->linkAssinatura($idProposta, $idPessoaAssinatura);
    }

    /**
     * Returns proposal signature link
     *
     * @since 05/05/2021
     *
     * @param int $idProposta
     * @return \Illuminate\Http\Response
     */
    public function linkContratoAssinado($idProposta)
    {
        return $this->service->linkContratoAssinado($idProposta);
    }

    /**
     * Show page to sign the first part of the contract.
     *
     * @since 28/04/2021
     *
     * @param int $hash
     * @param array $warningAlerts
     * @param array $successAlerts
     * @return \Illuminate\View\View
     */
    public function showAceite1($hash, $warningAlerts = [])
    {
        $arrayParams = explode('-', Crypt::decryptString($hash));
        $idProposta = $arrayParams[0];
        $idPessoaAssinatura = $arrayParams[1];

        $data = $this->service->dadosProposta($idProposta, $idPessoaAssinatura);
        $data['successAlerts'] = empty($warningAlerts) ? ['Parabéns, você está muito próximo do seu dinheiro!'] : [];
        $data['warningAlerts'] = $warningAlerts;

        $data['id_pessoa_assinatura'] = $idPessoaAssinatura;
        $data['linkAssinatura'] = 'assinatura.contrato-pj-1';
        $data['hash'] = $hash;

        return view('assinatura-contrato.pj.c_1', $data);
    }

    /**
     * Make the first signature of the contract
     *
     * @since 30/04/2021
     *
     * @param string $hash
     * @return \Illuminate\View\View
     */
    public function aceite1($hash)
    {
        $arrayParams = explode('-', Crypt::decryptString($hash));
        $idProposta = $arrayParams[0];
        $idPessoaAssinatura = $arrayParams[1];
        if($this->service->aceite1($idProposta, $idPessoaAssinatura, request()->ip())){
            return redirect(route('assinatura.contrato-pj-2.show', Crypt::encryptString($idProposta.'-'.$idPessoaAssinatura)));
        }

        return $this->showAceite1($idProposta, $idPessoaAssinatura, [$this->defaultWarningAlert]);
    }

    /**
     * Show page to sign the second part of the contract.
     *
     * @since 28/04/2021
     *
     * @param string $hash
     * @param array $warningAlerts
     * @param array $successAlerts
     * @return \Illuminate\View\View
     */
    public function showAceite2($hash, $warningAlerts = [])
    {
        $arrayParams = explode('-', Crypt::decryptString($hash));
        $idProposta = $arrayParams[0];
        $idPessoaAssinatura = $arrayParams[1];

        $data = $this->service->dadosProposta($idProposta, $idPessoaAssinatura);
        $data['successAlerts'] = empty($warningAlerts) ? ['Parabéns, você está muito próximo do seu dinheiro!'] : [];
        $data['warningAlerts'] = $warningAlerts;

        $data['id_pessoa_assinatura'] = $idPessoaAssinatura;
        $data['linkAssinatura'] = 'assinatura.contrato-pj-2';
        $data['hash'] = $hash;

        return view('assinatura-contrato.pj.c_2', $data);
    }

    /**
     * Make the second signature of the contract
     *
     * @since 30/04/2021
     *
     * @param string $hash
     * @param int $idPessoaAssinatura
     * @return \Illuminate\View\View
     */
    public function aceite2($hash)
    {
        $arrayParams = explode('-', Crypt::decryptString($hash));
        $idProposta = $arrayParams[0];
        $idPessoaAssinatura = $arrayParams[1];

        if(!$this->service->aceite2($idProposta, $idPessoaAssinatura, request()->ip()))
            return $this->showAceite2($idProposta, $idPessoaAssinatura, [$this->defaultWarningAlert]);

        $assinaturasPendentes = $this->service->assinaturasPendentes($idProposta);

        if(empty($assinaturasPendentes))
        {
            $this->service->registraAssinaturaPropostaPj($idProposta);
        }

        return redirect(route('assinatura.contrato-pj.show', Crypt::encryptString($idProposta)));
    }


    /**
     * Displays the signed contract
     *
     * @since 04/05/2021
     *
     * @param string $hash
     * @return \Illuminate\View\View
     */
    public function showContrato($hash)
    {
        $idProposta = Crypt::decryptString($hash);
        $data = $this->service->dadosContrato($idProposta);
        return view('assinatura-contrato.contrato', $data);
    }
}
