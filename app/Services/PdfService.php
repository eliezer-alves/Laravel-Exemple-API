<?php

namespace App\Services;

use App\Repositories\Eloquent\PropostaRepository;

use Pdf;

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
     * @return \Illuminate\View\View
     */
    public function contratoPj($idProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $proposta->parcelas;
        $proposta->clienteAssinatura;
        $proposta->representante;
        $proposta->socios;

        return $proposta->toArray();
    }
}
