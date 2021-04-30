<?php

namespace App\Services;

use App\Models\Proposta;
use App\Repositories\Eloquent\PropostaRepository;

/**
 * Service Layer - Class responsible for managing
 * the signing of Ágil contracts
 *
 * @author Eliezer Alves
 * @since 28/04/2021
 *
 */
class AssinaturaContratoService
{
    protected $propostaRepository;

    public function __construct(PropostaRepository $propostaRepository)
    {
        $this->propostaRepository = $propostaRepository;
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
            $proposta['warningMessages'][] = 'Proposta não Encontratda!';
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
        $proposta['successMessages'][] = 'Parbéns, você está muito próximo do seu dinheiro!';

        return $proposta;
    }
}
