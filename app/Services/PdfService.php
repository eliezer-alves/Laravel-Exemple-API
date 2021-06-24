<?php

namespace App\Services;

use App\Repositories\Contracts\PropostaRepositoryInterface;
use App\Services\CCB\CcbService;
use App\Services\CCB\CcbPjService;

class PdfService
{
    protected $propostaRepository;
    protected $ccb;

    public function __construct(PropostaRepositoryInterface $propostaRepository, CcbService $ccb)
    {
        $this->propostaRepository = $propostaRepository;
        $this->ccb = $ccb;
    }

    /**
     * Service Layer - Displays pdf of PJ client contracts
     *
     * @param int $idProposta
     * @return array $proposta;
     */
    public function ccbPj($idProposta)
    {
        $tipoCcb = new CcbPjService($this->propostaRepository->findOrFail($idProposta));
        return $this->ccb->pdf($tipoCcb);
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
        $proposta->clienteAssinatura->tipoLogradouro;
        $proposta->clienteAssinatura->tipoEmpresa;
        $proposta->representante->tipoLogradouro;
        $proposta->socios->map(function ($socio) {
            $socio->tipoLogradouro;
        });
        $proposta->assinaturas;
        $proposta = $proposta->toArray();
        // dd($proposta);

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $proposta['mes_geracao_proposta'] = strftime('%B', strtotime($proposta['data_geracao_proposta']));

        return $proposta;
    }
}
