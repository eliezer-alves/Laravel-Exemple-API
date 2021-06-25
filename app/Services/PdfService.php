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
     * @return CcbService;
     */
    public function contratoPj($idProposta)
    {
        $tipoCcb = new CcbPjService($this->propostaRepository->findOrFail($idProposta));
        return $this->ccb->pdf($tipoCcb);
    }

    /**
     * Service Layer - Displays pdf of PJ client contracts
     *
     * @param array $request
     * @return string;
     */
    public function zipContratosPj($request)
    {
        $path = 'ccbs';
        rrmdir(public_files_path($path));
        mkdir(public_files_path($path));
        foreach ($request['propostas'] as $numeroProposta) {
            $tipoCcb = new CcbPjService($this->propostaRepository->findByNumero($numeroProposta));
            if(!$this->ccb->pdf($tipoCcb, $path)){
                if(!$this->ccb->pdf($tipoCcb, $path)){
                    $this->ccb->pdf($tipoCcb, $path);
                }
            }
        }
        return zipPath(public_files_path($path), true);
    }
}
