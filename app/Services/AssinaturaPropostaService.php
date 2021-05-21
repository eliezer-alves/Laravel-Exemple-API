<?php

namespace App\Services;

use App\Exceptions\MailException;
use App\Models\Proposta;
use App\Repositories\Contracts\PropostaRepositoryInterface;
use App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface;
use App\Mail\LinkPropostaAssinaturaMail;
use Exception;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Crypt;

/**
 * Service Layer - Class responsible for managing
 * the signing of Ágil contracts
 *
 * @author Eliezer Alves
 * @since 28/04/2021
 *
 */
class AssinaturaPropostaService
{
    protected $propostaRepository;
    protected $pessoaAssinaturaRepository;

    public function __construct(PropostaRepositoryInterface $propostaRepository, PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository)
    {
        $this->propostaRepository = $propostaRepository;
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
    }

    /**
     * Service Layer - Returns proposal signature link
     *
     * @since 05/05/2021
     *
     * @param int $idProposta
     * @param int $idPessoaAssinatura
     * @return string route
     */
    public function linkAssinatura($idProposta, $idPessoaAssinatura)
    {
        return ['link' => route('assinatura.contrato-pj-1.show', Crypt::encryptString($idProposta . '-' . $idPessoaAssinatura))];
    }

    /**
     * Service Layer - Returns proposal signature link
     *
     * @since 05/05/2021
     *
     * @param int $idProposta
     * @return \Illuminate\Http\Response
     */
    public function linkContratoAssinado($idProposta)
    {
        return route('assinatura.contrato-pj.show', Crypt::encryptString($idProposta));
    }

    /**
     * Service Layer - Sends the contract signature link
     * to a partner / representative
     *
     * @since 05/05/2021
     *
     * @param int idProposta
     * @param int idPessoaAssinatura
     * @return \Illuminate\Http\Response
     */
    public function enviaLinkAssinatura($idProposta, $idPessoaAssinatura, $emailDestinatario)
    {
        $link = $this->linkAssinatura($idProposta, $idPessoaAssinatura);
        try {
            Mail::to($emailDestinatario)->send(new LinkPropostaAssinaturaMail($link));
        } catch (Exception $e) {
            throw new MailException('Problema ao enviar e-mail para ' . $emailDestinatario . '', $e);
        }
    }

    /**
     * Service Layer - Sends the contract signature link
     * to all partners / representatives
     *
     * @since 11/05/2021
     *
     * @param int $idProposta
     * @return \Illuminate\Http\Response
     */
    public function enviaTodosLinkAssinatura($idProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $this->enviaLinkAssinatura($idProposta, $proposta->clienteAssinatura->id_pessoa_assinatura, $proposta->clienteAssinatura->email);
        $this->enviaLinkAssinatura($idProposta, $proposta->representante->id_pessoa_assinatura, $proposta->representante->email);
        foreach ($proposta->socios as $socio) {
            $this->enviaLinkAssinatura($idProposta, $socio->id_pessoa_assinatura, $socio->email);
        }
    }

    /**
     * Service Layer - The first part of the contract is effective
     *
     * @since 03/05/2021
     *
     * @param int $idProposta
     * @param int $idPessoaAssinatura
     * @param int $ipCliente
     */
    public function aceite1($idProposta, $idPessoaAssinatura, $ipCliente)
    {
        $assinatura = $this->pessoaAssinaturaRepository->where('id_proposta', $idProposta)
            ->findOrFail($idPessoaAssinatura);
        $assinatura->data_aceite_1 = date('Y-m-d H:i:s');
        $assinatura->ip_cliente = $ipCliente;

        return $assinatura->save();
    }

    /**
     * Service Layer - Signature of the second part of the contract.
     *
     * @since 03/05/2021
     *
     * @param int $idProposta
     * @param int $idPessoaAssinatura
     * @param int $ipCliente
     */
    public function aceite2($idProposta, $idPessoaAssinatura, $ipCliente)
    {
        $assinatura = $this->pessoaAssinaturaRepository->where('id_proposta', $idProposta)
            ->findOrFail($idPessoaAssinatura);
        $assinatura->data_aceite_2 = date('Y-m-d H:i:s');
        $assinatura->ip_cliente = $ipCliente;
        $assinatura->hash_assinatura = _hashAssinatura($idProposta, $idPessoaAssinatura, $ipCliente);
        return $assinatura->save();
    }

    /**
     * Service Layer - Full proposal signature.
     *
     * @since 04/05/2021
     *
     * @param int $idProposta
     */
    public function registraAssinaturaPropostaPj($idProposta)
    {
        $proposta = $this->propostaRepository->find($idProposta);
        $proposta->representante;

        $string = $proposta->representante->celular . $proposta->representante->token . $proposta->data_solicitacao_proposta . $proposta->representante->ip_cliente;
        $proposta->data_aceite_1 = date('Y-m-d H:i:s');
        $proposta->data_aceite_2 = date('Y-m-d H:i:s');
        $proposta->hash_assinatura_ccb = _hashAssinatura($idProposta, $proposta->representante->id_pessoa_assinatura, $proposta->representante->ip_cliente);
        return $proposta->save();
    }


    /**
     * Service Layer - Displays pdf of PJ client contracts
     *
     * @since 28/04/2021
     *
     * @param int $idProposta
     * @param int $idPessoaAssinatura
     * @return array $proposta;
     */
    public function dadosProposta($idProposta, $idPessoaAssinatura)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $this->pessoaAssinaturaRepository->where('id_proposta', $idProposta)
            ->findOrFail($idPessoaAssinatura);

        $proposta->parcelas;
        $proposta->clienteAssinatura;
        $proposta->representante;
        $proposta->socios;
        $proposta = $proposta->toArray();

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $proposta['mes_geracao_proposta'] = strftime('%B', strtotime($proposta['data_geracao_proposta']));

        return $proposta;
    }

    /**
     * Service Layer - List pending signatures of PJ contract
     *
     * @since 03/05/2021
     *
     * @param int $idProposta
     * @return array $proposta;
     */
    public function assinaturasPendentes($idProposta)
    {
        return $this->pessoaAssinaturaRepository->assinaturasPendentes($idProposta);
    }

    /**
     * Service Layer - Get necessary data to display the contract after signing
     *
     * @since 04/05/2021
     *
     * @param int $idProposta
     * @return array $data;
     */
    public function dadosViewContratoAssinado($idProposta)
    {
        $data = [];
        if (!$this->propostaRepository->find($idProposta)) {
            return [
                'warningAlerts' => [
                    'Proposta não encontrada'
                ],
                'pdfContrato' => false
            ];
        }

        $assinaturasPendentes = $this->assinaturasPendentes($idProposta);

        foreach ($assinaturasPendentes as $assinatura) {
            $data['warningAlerts'][] = "Assinatura Pendente: {$assinatura['nome']} {$assinatura['id_pessoa_assinatura']}";
        }
        $data['pdfContrato'] = route('pdf.contrato-pj.show', Crypt::encryptString($idProposta));

        return $data;
    }
}
