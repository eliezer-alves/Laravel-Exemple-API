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
    AnalisePropostaService,
    KeysInterfaceService
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
class PropostaService
{
    private $clienteRepository;
    private $documentoPropostaRepository;
    private $pessoaAssinaturaRepository;
    private $propostaRepository;
    private $propostaParcelaRepository;

    private $apiSicred;
    private $analisePropostaService;
    private $keysInterfaceService;
    private $cliente;
    private $formaInclusaoCaliban;
    private $statusNaoAssinado;
    private $statusAguardandoAnaliseManual;
    private $statusEmAnaliseManual;

    public function __construct(ClienteRepositoryInterface $clienteRepository, DocumentoPropostaRepositoryInterface $documentoPropostaRepository, PessoaAssinaturaRepositoryInterface $pessoaAssinaturaRepository, PropostaRepositoryInterface $propostaRepository, PropostaParcelaRepositoryInterface $propostaParcelaRepository, ApiSicredServiceInterface $apiSicred, AnalisePropostaService $analisePropostaService, KeysInterfaceService $keysInterfaceService)
    {
        $this->clienteRepository = $clienteRepository;
        $this->documentoPropostaRepository = $documentoPropostaRepository;
        $this->pessoaAssinaturaRepository = $pessoaAssinaturaRepository;
        $this->propostaRepository = $propostaRepository;
        $this->propostaParcelaRepository = $propostaParcelaRepository;

        $this->apiSicred = $apiSicred;
        $this->analisePropostaService = $analisePropostaService;
        $this->keysInterfaceService = $keysInterfaceService;

        $this->formaInclusaoCaliban = 2;
        $this->statusNaoAssinado = 0;
        $this->statusAguardandoAnaliseManual = 1;
        $this->statusEmAnaliseManual = 2;
    }

    /**
     * Service Layer - Get data from a proposal at Agil
     *
     * @since 03/05/2021
     *
     * @param  int  $idProposta
     * @return array  $dataProposta
     */
    public function getDadosProposta($idProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        $proposta->parcelas;
        $proposta->clienteAssinatura->atividadeComercial;
        $proposta->clienteAssinatura->tipoEmpresa;
        $proposta->clienteAssinatura->porte;
        $proposta->clienteAssinatura->cosif;
        $proposta->clienteAssinatura->tipoLogradouro;
        $proposta->representante->tipoLogradouro;
        $proposta->socios->map(function ($socio) {
            return $socio->tipoLogradouro;
        });
        $proposta->documentos;
        $proposta->statusAnalise;

        return $proposta->toArray();
    }

    /**
     * Service Layer - Get data from a proposal at Agil
     * by number of the proposal
     *
     * @since 19/05/2021
     *
     * @param  int  $numeroProposta
     * @return array  $dataProposta
     */
    public function getDadosPropostaPorNumero($numeroProposta)
    {
        $proposta = $this->propostaRepository->findByNumero($numeroProposta);
        $proposta->parcelas;
        $proposta->clienteAssinatura->atividadeComercial;
        $proposta->clienteAssinatura->tipoEmpresa;
        $proposta->clienteAssinatura->porte;
        $proposta->clienteAssinatura->cosif;
        $proposta->clienteAssinatura->tipoLogradouro;
        $proposta->representante->tipoLogradouro;
        $proposta->socios->map(function ($socio) {
            return $socio->tipoLogradouro;
        });
        $proposta->documentos;
        $proposta->statusAnalise;

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
        $attributes = $this->keysInterfaceService->hydrator($proposta->cliente, $this->keysInterfaceService->clienteAgilSicred());
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
        $attributes = $this->keysInterfaceService->hydrator($proposta, $this->keysInterfaceService->liberacoesAgilSicred());
        $attributes['nomeBeneficiario'] = $proposta->cliente->nome_fantasia;
        $attributes['direcionamento'] = "N";

        return $this->apiSicred->vincularLiberacoesProposta($attributes, $numeroProposta);
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
     * Service Layer - Method responsible for excluding as portions
     * of the proposed proposal on the basis of Agile
     *
     * @since 29/05/2021
     *
     * @param  App\Repositories\Contracts\PropostaRepositoryInterface
     * @param  int $idProposta
     * @return array $parcelas
     */
    private function excluirParcelsPropostaSicred($idProposta)
    {
        $parcelas = $this->propostaParcelaRepository->where('id_proposta', $idProposta)->get();
        $parcelas->map(function ($parcela) {
            $parcela->delete();
        });
        return $parcelas;
    }


    /**
     * Service Layer - Updates or deletes documents related to a proposal
     *
     * @since 24/05/2021
     *
     * @param  array $documentos
     * @return array $documentsUpdated
     */
    private function atualizarSituacaoDocumentosProposta($documentos)
    {
        /*
        |--------------------------------------------------------------------------
        | Excluding
        |--------------------------------------------------------------------------
        |
        | Excluding documents specified in the request pyload
        | by the attribute "excluir"
        */

        foreach ($documentos as $key => $documento) {
            if (($documento['excluir'] ?? false)) {

                /*
                | ATTENTION: for this specific situation there is an exception deal because
                | the service cannot stop at that moment even if for some reason it was not
                | possible to excel a document, and for this case an exception log is recorded
                */

                try {
                    $this->documentoPropostaRepository->delete($documento['id_documento_proposta']);
                } catch (Exception $e) {
                    Log::channel('dbExceptions')->error(
                        "Erro ao excluir o documento proposta {$documento['id_documento_proposta']}: {$e->getMessage()}",
                        []
                    );
                }

                unset($documentos[$key]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Updating
        |--------------------------------------------------------------------------
        |
        | Documents that have not been deleted will be updated according to the
        | attributes specified in the requisition payload.
        */

        return $this->documentoPropostaRepository->updateMany($documentos, false);
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
        $attributes['id_status_analise_proposta'] = $this->statusAguardandoAnaliseManual;
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
    private function parametrosFormularioPessoaAssinatura($formAttributesSocios, $attributesFormCliente, $idProposta)
    {
        $attributesFormCliente['tipo_pessoa_assinatura'] = 0;
        $attributes = $formAttributesSocios;
        $attributes[] = $attributesFormCliente;

        foreach ($attributes as $key => $attribute) {
            $attributes[$key] = _normalizeRequest($attribute, ['email', 'data_nascimento']);
            $attributes[$key]['id_proposta'] = $idProposta;
            $attributes[$key]['token'] = md5(date('Y-m-d H:i:s') . $idProposta . bcrypt($idProposta));
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
        $attributes['data_geracao_proposta'] = date('Y-m-d H:i:s');
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
        $this->cliente->fill(_normalizeRequest($attributesFormCliente, ['email']));
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

        $proposta = $this->propostaRepository->create(_normalizeRequest($attributesProposta, ['valor_solicitado']));


        /*
        |--------------------------------------------------------------------------
        | Legal Representative / Partners
        |--------------------------------------------------------------------------
        |
        | Saving the Legal Representative and the company's partners.
        */
        $attributesPessoaAssinatura = $this->parametrosFormularioPessoaAssinatura($attributesFormSocios, $attributesFormCliente, $proposta->id_proposta);
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
        $proposta->clienteAssinatura->atividadeComercial;
        $proposta->clienteAssinatura->tipoEmpresa;
        $proposta->clienteAssinatura->porte;
        $proposta->clienteAssinatura->cosif;
        $proposta->clienteAssinatura->tipoLogradouro;
        $proposta->representante;
        $proposta->socios;
        $proposta->statusAnalise;

        return $proposta;
    }

    /**
     * Service Layer - Change the proposal data and everything related to it.
     * (Gambiarra, but working here is Foda - in the bad sense.)
     *
     * :(
     *
     * @since 24/05/2021
     *
     * @param  array  $attributes
     * @return json  $dataProposta
     */
    public function alterarDadosProposta($attributes)
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
        $attributesFormDocumentos = $attributes['documentos'] ?? [];


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
        $this->cliente->fill(_normalizeRequest($attributesFormCliente, ['email']));
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
        $proposta = $this->propostaRepository->update(_normalizeRequest($attributesProposta, ['valor_solicitado']), $attributesFormProposta['id_proposta']);

        /*
        |--------------------------------------------------------------------------
        | Analise Proposta
        |--------------------------------------------------------------------------
        |
        | Changing proposal review status
        */
        $this->propostaRepository->alterarStatusAnalise($attributesFormProposta['id_status_analise_proposta'], $proposta->id_proposta);
        $analiseProposta = $this->analisePropostaService->registrarAnaliseProposta(['id_status_analise_proposta' => $attributesFormProposta['id_status_analise_proposta']], $proposta->id_proposta);

        /*
        |--------------------------------------------------------------------------
        | Legal Representative / Partners
        |--------------------------------------------------------------------------
        |
        | Updating the Legal Representative and the company's partners.
        */
        $attributesPessoaAssinatura = $this->parametrosFormularioPessoaAssinatura($attributesFormSocios, $attributesFormCliente, $attributesFormProposta['id_proposta']);
        $this->pessoaAssinaturaRepository->updateMany($attributesPessoaAssinatura);


        /*
        |--------------------------------------------------------------------------
        | Proposal Documents
        |--------------------------------------------------------------------------
        |
        | Updating or deleting proposal documents.
        */
        $this->atualizarSituacaoDocumentosProposta($attributesFormDocumentos);

        if($attributesFormProposta['id_simulacao'] ?? false){
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
            | Exclude proposal installments
            |--------------------------------------------------------------------------
            |
            | Exclude installments from the proposal as new installments for the new
            | simulation will be saved.
            */
            $this->excluirParcelsPropostaSicred($proposta->id_proposta);


            /*
            |--------------------------------------------------------------------------
            | Agile Proposal / Sicred Proposal
            |--------------------------------------------------------------------------
            |
            | Updating Agil's proposal based on data from Sicred's proposal.
            */
            $this->alinharPropostaAgilComSicred($proposta->id_proposta, $numeroProposta);

        }

        $proposta->refresh();
        $proposta->parcelas;
        $proposta->clienteAssinatura->porte;
        $proposta->representante;
        $proposta->socios;
        $proposta->documentos;
        $proposta->statusAnalise;

        return $proposta;
    }
}
