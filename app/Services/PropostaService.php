<?php

namespace App\Services;

use App\Repositories\Contracts\{
    ClienteRepositoryInterface,
    PropostaRepositoryInterface,
};

use App\Services\Contracts\{
    ApiSicredServiceInterface
};
use App\Services\{
    ClienteService,
    KeysInterfaceService,
    PessoaAssinaturaService
};

/**
 * Service Layer - Class responsible for managing the loan proposals
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class PropostaService
{
    private $propostaRepository;
    private $clienteRepository;
    private $apiSicred;
    private $clienteService;
    private $keysInterfaceService;
    private $pessoAssinaturaService;
    private $cliente;
    private $formaInclusaoCaliban;
    private $statusNaoAssinado;

    public function __construct(ClienteRepositoryInterface $clienteRepository, PropostaRepositoryInterface $propostaRepository, ApiSicredServiceInterface $apiSicred, ClienteService $clienteService, KeysInterfaceService $keysInterfaceService, PessoaAssinaturaService $pessoAssinaturaService)
    {
        $this->clienteRepository = $clienteRepository;
        $this->propostaRepository = $propostaRepository;
        $this->apiSicred = $apiSicred;
        $this->clienteService = $clienteService;
        $this->keysInterfaceService = $keysInterfaceService;
        $this->pessoAssinaturaService = $pessoAssinaturaService;

        $this->formaInclusaoCaliban = 7;
        $this->statusNaoAssinado = 1;
    }


    /**
     * Service Layer - Links customer data to a Sicred proposal
     *
     *
     * @param  App\Repositories\Contracts\PropostaRepositoryInterface
     * @param  int $numeroProposta
     * @return App\Services\Contracts\ApiSicredServiceInterface
     */
    private function vincularClienteSicred($proposta, $numeroProposta)
    {
        $attributes = [
            'cnpj' => $proposta->cliente->cnpj,
            'razaoSocial' => $proposta->cliente->razao_social,
            'fundacao' => $proposta->cliente->data_fundacao,
            'inscricaoEstadual' => $proposta->cliente->inscricao_estadual,
            'capitalSocial' => $proposta->cliente->capital_social,
            'anoFaturamento' => $proposta->cliente->ano_faturamento,
            'valorFaturamentoAnual' => $proposta->cliente->faturamento_anual,
            'porte' => $proposta->cliente->porte,
            'email' => $proposta->cliente->email,
            'cepResidencial' => $proposta->cliente->cep,
            'enderecoResidencial' => $proposta->cliente->logradouro,
            'numeroResidencial' => $proposta->cliente->numero,
            'complementoResidencial' => $proposta->cliente->complemento,
            'bairroResidencial' => $proposta->cliente->bairro,
            'cidadeResidencial' => $proposta->cliente->cidade,
            'ufResidencial' => $proposta->cliente->uf
        ];

        return $this->apiSicred->vincularClienteProposta($attributes, $numeroProposta);
    }


    /**
     * Service Layer - Links bank details to a proposal at Sicred
     *
     *
     * @param  App\Repositories\Contracts\PropostaRepositoryInterface
     * @param  int $numeroProposta
     * @return App\Services\Contracts\ApiSicredServiceInterface
     */
    private function vincularLiberacoesSicred($proposta, $numeroProposta)
    {
        $attributes = [
            'nomeBeneficiario' => $proposta->cliente->nome_fantasia,
            'cnpj' => $proposta->cliente->cnpj,
            'formaLiberacao' => $proposta->forma_liberacao,
            'valorLiberacao' => (float)$proposta->valor_solicitado,
            'bancoLiberacao' => $proposta->banco_liberacao,
            'agenciaLiberacao' => $proposta->agencia_liberacao,
            'contaLiberacao' => $proposta->conta_liberacao,
            'tipoConta' => $proposta->tipo_conta,
            'direcionamento' => "N",
        ];

        return $this->apiSicred->vincularLibercoesProposta($attributes, $numeroProposta);
    }


    /**
     * Service Layer - Get data from a proposal at Sicred
     *
     *
     * @param  int  $numeroProposta
     * @return array  $dataProposta
     */
    public function getDadosPropostaSicred($numeroProposta)
    {
        return (array)$this->apiSicred->dadosProposta($numeroProposta);
    }


    /**
     * Service Layer - Get bank details from a proposal at Sicred
     *
     *
     * @param  int  $numeroProposta
     * @return array  $dataProposta
     */
    public function getDadosLiberacoesPropostaSicred($numeroProposta)
    {
        return (array)$this->apiSicred->exibeLiberacoesProposta($numeroProposta);
    }


    /**
     * Normalizes parameters for registering a proposal at Agil
     *
     *
     * @param array $formAttributes
     * @return array $dataProposta
     */
    private function normalizaParametrosFormularioNovaProposta($formAttributes)
    {
        $attributes = $this->keysInterfaceService->hydrator($formAttributes, $this->keysInterfaceService->atributosFormularioNovaProposta());
        $attributes['id_cliente'] = $this->cliente['id_cliente'];
        $attributes['renda'] = $this->cliente['rendimento_mensal'] ?? 0;
        $attributes['data_solicitacao_proposta'] = date('Y-m-d H:i:s');
        $attributes['id_status_administrativo'] = $this->statusNaoAssinado;
        $attributes['id_forma_inclusao'] = $this->formaInclusaoCaliban;

        return $attributes;
    }


    /**
     * Service Layer - Creates a new Agile Proposal from the data in a request
     *
     *
     * @param  array  $attributes
     * @return json  $dataProposta
     */
    public function novaProposta($attributes)
    {

        /*
        |--------------------------------------------------------------------------
        | Class attributes
        |--------------------------------------------------------------------------
        |
        | Normalizing the requisition data and instantiating the class attributes
        | that will be used in the process of creating a new Agile proposal.
        */
        $attributesFormProposta = $attributes['proposta'];
        $attributesFormCliente = $attributes['cliente'];
        $attributesFormSocios = $attributes['socios'];

        /*
        |--------------------------------------------------------------------------
        | Client
        |--------------------------------------------------------------------------
        |
        | With the form data, the Client class is instantiated based on the CNPJ,
        | then the attributes are updated based on the form data, then the record
        | is saved in the database. That way, if there is already a record it is
        | updated, otherwise a new record is created.
        */
        $this->cliente = $this->clienteRepository->findByCnpj($attributesFormCliente['cnpj']) ??  $this->clienteRepository->fill([]);
        $this->cliente->fill($attributesFormCliente);
        $this->cliente->save();


        /*
        |--------------------------------------------------------------------------
        | Proposal at Ágil
        |--------------------------------------------------------------------------
        |
        | Normalizing the necessary attributes to create a new proposal and
        | creating a new proposal in Ágil's database.
        */
        $attributesProposta = $this->normalizaParametrosFormularioNovaProposta($attributesFormProposta);
        $proposta = $this->propostaRepository->create($attributesProposta);


        /*
        |--------------------------------------------------------------------------
        | Legal Representative / Partners
        |--------------------------------------------------------------------------
        |
        | Saving the Legal Representative and the company's partners.
        */
        $socios = $this->pessoAssinaturaService->createMany($attributesFormSocios, $proposta->id_proposta);


        /*
        |--------------------------------------------------------------------------
        | Proposal at Sicred
        |--------------------------------------------------------------------------
        |
        | Creating a proposal at Sicredi from Agil's proposal
        */
        $numeroProposta = $this->vincularPropostaSicred($proposta->id_proposta);
        $propostaSicred = $this->getDadosPropostaSicred($numeroProposta);


        /*
        |--------------------------------------------------------------------------
        | Agile Proposal / Sicred Proposal
        |--------------------------------------------------------------------------
        |
        | Updating Agil's proposal based on data from Sicred's proposal.
        */
        $alinharPropostaAgilComSicred = $this->alinharPropostaAgilComSicred($proposta->id_proposta, $numeroProposta);

        $proposta->refresh();
        $proposta->cliente;
        $proposta->socios;

        return $proposta;
    }


    /**
     * Service Layer - Create a proposal on sicred from an Agil proposal
     *
     *
     * @param  int  $idProposta
     * @return int $numeroProposta
     */
    public function vincularPropostaSicred($idProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $numeroProposta = $this->apiSicred->novaProposta($proposta->id_simulacao);

        if (!$this->vincularClienteSicred($proposta, $numeroProposta))
            return 0;
        if (!$this->vincularLiberacoesSicred($proposta, $numeroProposta))
            return 0;

        return $numeroProposta;
    }


    /**
     * Service Layer - Updates the Agile Proposal (internal proposal) with the Proposal data at Sicred
     *
     *
     * @param  int  $idProposta
     * @param  int  $numeroProposta
     *
     * @return bool
     */
    public function alinharPropostaAgilComSicred($idProposta, $numeroProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $propostaSicred = $this->getDadosPropostaSicred($numeroProposta);

        $attributes = $this->keysInterfaceService->hydrator($propostaSicred, $this->keysInterfaceService->alinharPropostaAgilComSicred());
        $proposta->update($attributes);

        return true;
    }
}
