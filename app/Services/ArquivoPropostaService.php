<?php

namespace App\Services;

use App\Exceptions\FailedAction;
use App\Repositories\Contracts\ArquivoPropostaRepositoryInterface;
use App\Repositories\Contracts\PropostaRepositoryInterface;
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
     * Service Layer - Upload the company's social contract files
     *
     * @since 11/05/2021
     *
     * @param  Illuminate\Http\Request
     */
    public function createMany($request, $idProposta)
    {
        $attributes = [];
        foreach($request as $file){
            try {
                $path = $file->store('arquivos-proposta', 's3');
                Storage::disk('s3')->put("arquivos-proposta", $path, 'public');
                $link = Storage::disk('s3')->url($path);
                array_push($attributes, ['id_proposta' => $idProposta,'link' => $link]);
            } catch(FailedAction $e) {
                dd($e);
            }
        }

        return $this->arquivoPropostaRepository->createMany($attributes);
    }
}
