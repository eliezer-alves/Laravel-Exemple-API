<?php

namespace App\Services;

use App\Repositories\Contracts\ArquivoPropostaRepositoryInterface;
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

    public function __construct(ArquivoPropostaRepositoryInterface $arquivoPropostaRepository)
    {
        $this->arquivoPropostaRepository = $arquivoPropostaRepository;
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
        $array_links = [];
        foreach($request as $file){
            $path = $file->store('arquivos-proposta', 's3');
            Storage::disk('s3')->put("arquivos-proposta", $path, 'public');
            $link_file = Storage::disk('s3')->url($path);
            array_push($array_links, $link_file);
        }

        return $array_links;
    }
}
