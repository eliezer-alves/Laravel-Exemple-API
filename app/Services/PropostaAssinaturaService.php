<?php

namespace App\Services;

use App\Models\Proposta;
use App\Repositories\Contracts\PropostaRepositoryInterface;
use App\Repositories\Contracts\PessoaAssinaturaRepositoryInterface;

/**
 * Service Layer - Class responsible for managing
 * the signing of Ágil contracts
 *
 * @author Eliezer Alves
 * @since 28/04/2021
 *
 */
class PropostaAssinaturaService
{
    protected $propostaRepository;
    protected $pessoaAssinaturaRepository;

    public function __construct(PropostaRepositoryInterface $propostaRepository, PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository)
    {
        $this->propostaRepository = $propostaRepository;
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
    }

    /**
     * Service Layer - The first part of the contract is effective
     *
     * @since 03/05/2021
     *
     * @param int $idPessoaAssinatura
     * @param int $ipCliente
     */
    public function aceite1($idPessoaAssinatura, $ipCliente)
    {
        $assinatura = $this->pessoaAssinaturaRepository->findOrFail($idPessoaAssinatura);
        $assinatura->data_aceite_1 = date('Y-m-d H:i:s');
        $assinatura->ip_cliente = $ipCliente;
        return $assinatura->save();
    }

    /**
     * Service Layer - Signature of the second part of the contract.
     *
     * @since 03/05/2021
     *
     * @param int $idPessoaAssinatura
     * @param int $ipCliente
     */
    public function aceite2($idPessoaAssinatura, $ipCliente)
    {
        $assinatura = $this->pessoaAssinaturaRepository->findOrFail($idPessoaAssinatura);
        $assinatura->data_aceite_2 = date('Y-m-d H:i:s');
        $assinatura->ip_cliente = $ipCliente;
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
        $proposta->hash_assinatura_ccb = md5($string);
        return $proposta->save();
    }


    /**
     * Service Layer - Displays pdf of PJ client contracts
     *
     * @since 28/04/2021
     *
     * @param int $idProposta
     * @return array $proposta;
     */
    public function dadosProposta($idProposta)
    {
        $proposta = $this->propostaRepository->find($idProposta);
        if(!$proposta){
            $proposta['warningAlerts'][] = 'Proposta não Encontratda!';
            return $proposta;
        }

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
    public function dadosContrato($idProposta)
    {
        $data = [];
        $assinaturasPendentes = $this->assinaturasPendentes($idProposta);
        foreach($assinaturasPendentes as $assinatura)
        {
            $data['warningAlerts'][] = "Assinatura Pendente: {$assinatura['nome']} {$assinatura['id_pessoa_assinatura']}";
        }
        $data['pdfContrato'] = route('pdf.contrato-pj.show', $idProposta);

        return $data;
    }
}
