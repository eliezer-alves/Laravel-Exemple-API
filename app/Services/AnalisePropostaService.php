<?php

namespace App\Services;

use App\Repositories\Contracts\{
    ClienteRepositoryInterface,
    DocumentoPropostaRepositoryInterface,
    PessoaAssinaturaRepositoryInterface,
    PropostaRepositoryInterface,
    PropostaParcelaRepositoryInterface,
};

use App\Services\Contracts\{
    ApiSicredServiceInterface
};
use App\Services\{
    KeysInterfaceService,
};
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Service Layer - Class responsible for managing the loan proposals
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class AbalisePropostaService
{
    private $clienteRepository;
    private $documentoPropostaRepository;
    private $pessoaAssinaturaRepository;
    private $propostaRepository;
    private $propostaParcelaRepository;

    private $apiSicred;
    private $keysInterfaceService;
    private $cliente;
    private $formaInclusaoCaliban;
    private $statusNaoAssinado;

    public function __construct(ClienteRepositoryInterface $clienteRepository, DocumentoPropostaRepositoryInterface $documentoPropostaRepository, PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository, PropostaRepositoryInterface $propostaRepository, PropostaParcelaRepositoryInterface $propostaParcelaRepository, ApiSicredServiceInterface $apiSicred, KeysInterfaceService $keysInterfaceService)
    {
        $this->clienteRepository = $clienteRepository;
        $this->documentoPropostaRepository = $documentoPropostaRepository;
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
        $this->propostaRepository = $propostaRepository;
        $this->propostaParcelaRepository = $propostaParcelaRepository;

        $this->apiSicred = $apiSicred;
        $this->keysInterfaceService = $keysInterfaceService;

        $this->formaInclusaoCaliban = 2;
        $this->statusNaoAssinado = 0;
    }
}
