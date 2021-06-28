<?php

namespace App\Http\Controllers;

use App\Services\AssinaturaPropostaService;
use App\Http\Requests\EmailAssinaturaRequest;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
 * Class responsible for managing the
 * signing of Ágil contracts
 *
 * @author Eliezer Alves
 * @since 28/04/2021
 *
 */
class AssinaturaPropostaController extends Controller
{
    private $defaultWarningAlert;

    public function __construct(AssinaturaPropostaService $service)
    {
        parent::__construct($service);
        $this->defaultWarningAlert = 'Houve um problema ao registrar a sua assinatura! Tente novamente!';
    }

    /**
     * Redeem parameters from the hash passed in the signature url
     *
     * @param string $hash
     * @return object params: idProposta | idPessoaAssinatura | tokenPessoaAssinatura ?? NULL
     */
    private function hashDecodeBase64($hash): object
    {
        try {
            $arrayParams = explode('-', _base64url_decode($hash));
        } catch (Exception $e) {
            abort(404);
        }

        return (object)[
            'idProposta' => $arrayParams[0],
            'idPessoaAssinatura' => $arrayParams[1],
            'tokenPessoaAssinatura' => $arrayParams[2] ?? NULL,
        ];
    }

    /**
     * Redeem parameters from the hash passed in the signature url
     *
     * @param string $hash
     * @return object params: idProposta | idPessoaAssinatura | tokenPessoaAssinatura ?? NULL
     */
    private function hashDecodeCrypt($hash): object
    {
        try {
            $arrayParams = explode('-', Crypt::decryptString($hash));
        } catch (DecryptException $e) {
            abort(404);
        }

        return (object)[
            'idProposta' => $arrayParams[0],
            'idPessoaAssinatura' => $arrayParams[1],
            'tokenPessoaAssinatura' => $arrayParams[2] ?? NULL,
        ];
    }


    /**
     * Sends the contract signature link to a partner / representative
     *
     * @param App\Http\Requests\EmailAssinaturaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function enviaLinkAssinatura(EmailAssinaturaRequest $request)
    {
        $this->service->enviaLinkAssinatura($request['idProposta'], $request['idPessoaAssinatura'], $request['emailDestinatario']);
    }

    /**
     * Sends the contract signature link to all partners / representatives
     *
     * @param int $idProposta
     * @return \Illuminate\Http\Response
     */
    public function enviaTodosLinkAssinatura(Request $request)
    {
        $request->validate([
            'id_proposta' => ['required', 'regex:/^[0-9]+$/u']
        ]);
        $this->service->enviaTodosLinkAssinatura($request->id_proposta);
    }

    /**
     * Returns proposal signature link
     *
     * @param int $idProposta
     * @param int $idPessoaAssinatura
     * @return \Illuminate\Http\Response
     */
    public function linkAssinatura($idProposta, $idPessoaAssinatura)
    {
        return ['link' => $this->service->linkAssinatura($idProposta, $idPessoaAssinatura)];
    }

    /**
     * Returns proposal signature link
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
     * @param int $hash
     * @param array $warningAlerts
     * @param array $successAlerts
     * @return \Illuminate\View\View
     */
    public function showAceite1($hash, $warningAlerts = [])
    {
        $params = $this->hashDecodeBase64($hash);
        $data = $this->service->dadosProposta($params->idProposta, $params->idPessoaAssinatura, $params->tokenPessoaAssinatura);
        $data['warningAlerts'] = $data['warningAlerts'] ?? $warningAlerts;
        $data['successAlerts'] = empty($data['warningAlerts']) ? ['Parabéns, você está muito próximo do seu dinheiro!'] : [];

        $data['id_pessoa_assinatura'] = $params->idPessoaAssinatura;
        $data['linkAssinatura'] = 'assinatura.contrato-pj-1';
        $data['hash'] = $hash;

        return view('assinatura-contrato.pj.c_1', $data);
    }

    /**
     * Make the first signature of the contract
     *
     * @param string $hash
     * @return \Illuminate\View\View
     */
    public function aceite1($hash)
    {
        $params = $this->hashDecodeBase64($hash);
        if($this->service->aceite1($params->idProposta, $params->idPessoaAssinatura, request()->ip())){
            return redirect(route('assinatura.contrato-pj-2.show', Crypt::encryptString("$params->idProposta-$params->idPessoaAssinatura")));
        }

        return redirect($this->service->linkAssinatura($params->idProposta, $params->idPessoaAssinatura));
    }

    /**
     * Show page to sign the second part of the contract.
     *
     * @param string $hash
     * @param array $warningAlerts
     * @param array $successAlerts
     * @return \Illuminate\View\View
     */
    public function showAceite2($hash, $warningAlerts = [])
    {
        $params = $this->hashDecodeCrypt($hash);
        $data = $this->service->dadosProposta($params->idProposta, $params->idPessoaAssinatura, $params->tokenPessoaAssinatura);
        $data['warningAlerts'] = $data['warningAlerts'] ?? $warningAlerts;
        $data['successAlerts'] = empty($data['warningAlerts']) ? ['Parabéns, você está muito próximo do seu dinheiro!'] : [];

        $data['id_pessoa_assinatura'] = $params->idPessoaAssinatura;
        $data['linkAssinatura'] = 'assinatura.contrato-pj-2';
        $data['hash'] = $hash;

        return view('assinatura-contrato.pj.c_2', $data);
    }

    /**
     * Make the second signature of the contract
     *
     * @param string $hash
     * @param int $idPessoaAssinatura
     * @return \Illuminate\View\View
     */
    public function aceite2($hash)
    {
        $params = $this->hashDecodeCrypt($hash);
        if(!$this->service->aceite2($params->idProposta, $params->idPessoaAssinatura, request()->ip()))
            return redirect(route('assinatura.contrato-pj-2.show', Crypt::encryptString("$params->idProposta-$params->idPessoaAssinatura")));

        $assinaturasPendentes = $this->service->assinaturasPendentes($params->idProposta);

        if(empty($assinaturasPendentes))
        {
            $this->service->registraAssinaturaPropostaPj($params->idProposta);
        }

        return redirect(route('assinatura.contrato-pj.show', Crypt::encryptString($params->idProposta)));
    }


    /**
     * Displays the signed contract
     *
     * @param string $hash
     * @return \Illuminate\View\View
     */
    public function showContrato($hash)
    {
        try {
            $idProposta = Crypt::decryptString($hash);
        } catch (DecryptException $e) {
            abort(404);
        }

        $data = $this->service->dadosViewContratoAssinado($idProposta);
        return view('assinatura-contrato.contrato', $data);
    }
}
