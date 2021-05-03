<?php

namespace App\Services;

use App\Repositories\Contracts\{
    ClienteRepositoryInterface,
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

/**
 * Service Layer - Class responsible for managing the loan proposals
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class PropostaService
{
    private $clienteRepository;
    private $pessoaAssinaturaRepository;
    private $propostaRepository;
    private $propostaParcelaRepository;

    private $apiSicred;
    private $keysInterfaceService;
    private $cliente;
    private $formaInclusaoCaliban;
    private $statusNaoAssinado;

    public function __construct(ClienteRepositoryInterface $clienteRepository, PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository, PropostaRepositoryInterface $propostaRepository, PropostaParcelaRepositoryInterface $propostaParcelaRepository, ApiSicredServiceInterface $apiSicred, KeysInterfaceService $keysInterfaceService)
    {
        $this->clienteRepository = $clienteRepository;
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
        $this->propostaRepository = $propostaRepository;
        $this->propostaParcelaRepository = $propostaParcelaRepository;

        $this->apiSicred = $apiSicred;
        $this->keysInterfaceService = $keysInterfaceService;

        $this->formaInclusaoCaliban = 2;
        $this->statusNaoAssinado = 0;
    }

    /**
     * Service Layer - Get data from a proposal at Agil
     *
     * @since 03/05/2021
     *
     * @param  int  $numeroProposta
     * @return array  $dataProposta
     */
    public function getDadosProposta($numeroProposta)
    {
        $proposta = $this->propostaRepository->findByNumero($numeroProposta);
        $proposta->parcelas;
        $proposta->clienteAssinatura;
        $proposta->representante;
        $proposta->socios;
        return $proposta->toArray();
    }


    /**
     * Service Layer - Get data from a proposal at Sicred
     *
     * @since 23/04/2021
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
     * @since 23/04/2021
     *
     * @param  int  $numeroProposta
     * @return array  $dataProposta
     */
    public function getDadosLiberacoesPropostaSicred($numeroProposta)
    {
        return (array)$this->apiSicred->exibeLiberacoesProposta($numeroProposta);
    }


    /**
     * Service Layer - Links customer data to a Sicred proposal
     *
     * @since 23/04/2021
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

        return;

        return $this->apiSicred->vincularClienteProposta($attributes, $numeroProposta);
    }


    /**
     * Service Layer - Links bank details to a proposal at Sicred
     *
     * @since 23/04/2021
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
     * Service Layer - Method responsible for saving the parcels of the Sicred
     * proposal on the basis of Agile
     *
     * @since 23/04/2021
     *
     * @param  App\Repositories\Contracts\PropostaRepositoryInterface
     * @param  array $parcelasPropostaSicred
     * @param  int $idProposta
     * @return App\Services\Contracts\ApiSicredServiceInterface
     */
    private function salvarParcelsPropostaSicred($parcelasPropostaSicred, $idProposta)
    {
        /*
        |--------------------------------------------------------------------------
        | Attributes
        |--------------------------------------------------------------------------
        |
        | Normalizing the array of attributes to save the plots. In this case it
        | will be an array with several plots, which will be saved independently
        | in the Repository.
        */

        $attributesParcelas = [];
        foreach ($parcelasPropostaSicred as $parcelaSicred) {
            $attributesParcela = $this->keysInterfaceService->hydrator((array)$parcelaSicred, $this->keysInterfaceService->alinharParcelaPropostaAgilComSicred());
            $attributesParcela['id_proposta'] = $idProposta;
            array_push($attributesParcelas, $attributesParcela);
        }

        /*
        |--------------------------------------------------------------------------
        | Saving
        |--------------------------------------------------------------------------
        |
        | Saving the parcels through the ProposalParcelaRepository that will
        | return to the list of saved records.
        */

        return $this->propostaParcelaRepository->createMany($attributesParcelas) ?? [];
    }


    /**
     * Normalizes parameters for registering a proposal at Agil
     *
     * @since 23/04/2021
     *
     * @param array $formAttributes
     * @return array $dataProposta
     */
    private function normalizaParametrosFormularioNovaProposta($formAttributes)
    {
        $attributes = $this->keysInterfaceService->hydrator($formAttributes, $this->keysInterfaceService->atributosFormularioNovaProposta());
        $attributes['id_cliente'] = $this->cliente['id_cliente'];
        $attributes['cnpj_beneficiario'] = $this->cliente['cnpj'] ?? null;
        $attributes['nome_beneficiario'] = $this->cliente['nome_fantasia'] ?? null;
        $attributes['renda'] = $this->cliente['rendimento_mensal'] ?? 0;
        $attributes['data_solicitacao_proposta'] = date('Y-m-d H:i:s');
        $attributes['id_status_administrativo'] = $this->statusNaoAssinado;
        $attributes['id_forma_inclusao'] = $this->formaInclusaoCaliban;
        return $attributes;
    }

    /**
     * Normalizes parameters for registering a proposal at Agil
     *
     * @since 23/04/2021
     *
     * @param array $formAttributesSocios
     * @param int $idProposta
     * @return array $dataProposta
     */
    private function parametrosFormularioPessoaAssinatura($formAttributesSocios, $idProposta)
    {
        $clienteAssinatura = $this->cliente->toArray();
        $clienteAssinatura['tipo_pessoa_assinatura'] = 0;
        $attributes = $formAttributesSocios;
        $attributes[] = $clienteAssinatura;

        foreach ($attributes as $key => $attribute) {
            $attributes[$key]['id_proposta'] = $idProposta;
        }

        return $attributes;
    }

    /**
     * Service Layer - Create a proposal on sicred from an Agil proposal
     *
     * @since 23/04/2021
     *
     * @param int $idProposta
     * @return int $numeroProposta
     */
    public function vincularPropostaSicred($idProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $numeroProposta = $this->apiSicred->novaProposta($proposta->id_simulacao);

        $this->vincularClienteSicred($proposta, $numeroProposta);
        $this->vincularLiberacoesSicred($proposta, $numeroProposta);
        return $numeroProposta;
    }


    /**
     * Service Layer - Updates the Agile Proposal (internal proposal) with the Proposal data at Sicred
     *
     * @since 23/04/2021
     *
     * @param  int  $idProposta
     * @param  int  $numeroProposta
     * @return bool
     */
    public function alinharPropostaAgilComSicred($idProposta, $numeroProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $propostaSicred = $this->getDadosPropostaSicred($numeroProposta);

        $attributes = $this->keysInterfaceService->hydrator($propostaSicred, $this->keysInterfaceService->alinharPropostaAgilComSicred());
        $proposta->update($attributes);

        $this->salvarParcelsPropostaSicred($propostaSicred['parcelas'] ?? [], $proposta->id_proposta);

        return true;
    }

    /**
     * Service Layer - Creates a new Agile Proposal from the data in a request
     *
     * @since 23/04/2021
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
        $attributesPessoaAssinatura = $this->parametrosFormularioPessoaAssinatura($attributesFormSocios, $proposta->id_proposta);
        $this->pessoaAssinaturaRepository->createMany($attributesPessoaAssinatura);


        /*
        |--------------------------------------------------------------------------
        | Proposal at Sicred
        |--------------------------------------------------------------------------
        |
        | Creating a proposal at Sicredi from Agil's proposal
        */
        $numeroProposta = $this->vincularPropostaSicred($proposta->id_proposta);
        $this->getDadosPropostaSicred($numeroProposta);


        /*
        |--------------------------------------------------------------------------
        | Agile Proposal / Sicred Proposal
        |--------------------------------------------------------------------------
        |
        | Updating Agil's proposal based on data from Sicred's proposal.
        */
        $this->alinharPropostaAgilComSicred($proposta->id_proposta, $numeroProposta);

        $proposta->refresh();
        $proposta->parcelas;
        $proposta->clienteAssinatura;
        $proposta->representante;
        $proposta->socios;

        return $proposta;
    }
}
