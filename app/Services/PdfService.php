<?php

namespace App\Services;

use App\Repositories\Contracts\PropostaRepositoryInterface;
use App\Services\CCB\CcbService;
use App\Services\CCB\CcbPjService;
use Illuminate\Support\Facades\Log;

class PdfService
{
    private $propostaRepository;
    private $ccb;
    private $numeroMaximoTentativas;



    public function __construct(PropostaRepositoryInterface $propostaRepository, CcbService $ccb)
    {
        $this->propostaRepository = $propostaRepository;
        $this->ccb = $ccb;
        $this->numeroMaximoTentativas = 2;
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

        foreach ($request['propostas'] as $numeroProposta)
        {
            $gerouArquivo = false;
            $numeroTentativas = 0;
            $proposta = $this->propostaRepository->findByNumero($numeroProposta, false);

            if(!$proposta){
                file_put_contents(public_files_path($path) . '/propostas-nao-geradas.txt', "$numeroProposta - PROPOSTA NAO ENCONTRADA NA BASE DE DADOS\r\n", FILE_APPEND);
                Log::channel('failedActions')->error("Rotina de gerar zip dos PDF's das CCB's - Proposta não encontrada: $numeroProposta", ['status' => 404]);
                continue;
            }

            $tipoCcb = new CcbPjService($proposta);

            do {
                $gerouArquivo = $this->ccb->pdf($tipoCcb, $path);
                $numeroTentativas ++;
            } while (!$gerouArquivo && $this->numeroMaximoTentativas <= $numeroTentativas);

            if(!$gerouArquivo) file_put_contents(public_files_path($path) . '/propostas-nao-geradas.txt', "$numeroProposta\r\n", FILE_APPEND);
        }

        return zipPath(public_files_path($path), true);
    }
}
