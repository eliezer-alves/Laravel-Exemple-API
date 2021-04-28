<?php

namespace App\Services;

use App\Repositories\Eloquent\PropostaRepository;

class PdfService
{
    protected $propostaRepository;

    public function __construct(PropostaRepository $propostaRepository)
    {
        $this->propostaRepository = $propostaRepository;
    }

    /**
     * Service Layer - Displays pdf of PJ client contracts
     *
     * @param int $idProposta
     * @return array $proposta;
     */
    public function contratoPj($idProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
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
}
