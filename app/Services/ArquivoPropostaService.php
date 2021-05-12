<?php

namespace App\Services;

use App\Exceptions\FailedAction;
use App\Repositories\Contracts\ArquivoPropostaRepositoryInterface;
use App\Repositories\Contracts\PropostaRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Service Layer - Class responsible for managing proposal-related files
 *
 * @author Eliezer Alves
 * @since 11/2021
 *
 */
class ArquivoPropostaService
{
    protected $arquivoPropostaRepository;
    protected $ropostaRepository;

    public function __construct(ArquivoPropostaRepositoryInterface $arquivoPropostaRepository, PropostaRepositoryInterface $propostaRepository)
    {
        $this->arquivoPropostaRepository = $arquivoPropostaRepository;
        $this->propostaRepository = $propostaRepository;
    }

    /**
     * Service Layer - Upload proposal files to the bucket on S3
     *
     * @since 12/05/2021
     *
     * @param File $file
     * @return string $link_file - File link on s3
     */
    private function uploadFileS3($file, $idProposta = null)
    {
        try {
            $path = $file->store('arquivos-proposta', 's3');
            Storage::disk('s3')->put("arquivos-proposta", $path, 'public');
            return Storage::disk('s3')->url($path);
        } catch(Exception $e) {
            Log::channel('s3')->error('Falaha fazer upload de arquivio de proposta - idProposta = ' . $idProposta, ['error' => $e->getMessage()]);
        }

        return '';
    }

    /**
     * Service Layer - Save the files related to the proposal
     *
     * @since 11/05/2021
     *
     * @param  Illuminate\Http\Request
     */
    public function createMany($request, $idProposta)
    {
        $attributes = [];
        foreach($request as $file){
            $link = $this->uploadFileS3($file, $idProposta);
            array_push($attributes, ['id_proposta' => $idProposta,'link' => $link]);
        }
        return $this->arquivoPropostaRepository->createMany($attributes);
    }
}
