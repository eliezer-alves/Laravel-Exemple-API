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
    PessoaAssinaturaService
};

class PropostaService
{
    private $propostaRepository;
    private $apiSicred;
    private $clienteService;
    private $pessoAssinaturaService;

    private $attributesFormProposta;
    private $attributesFormCliente;
    private $attributesFormSocios;
    private $numeroProposta;
    private $cliente;

    public function __construct(PropostaRepositoryInterface $propostaRepository, ApiSicredServiceInterface $apiSicred, ClienteService $clienteService, PessoaAssinaturaService $pessoAssinaturaService)
    {
        $this->propostaRepository = $propostaRepository;
        $this->apiSicred = $apiSicred;
        $this->clienteService = $clienteService;
        $this->pessoAssinaturaService = $pessoAssinaturaService;
    }

    /**
     * Service Layer - Creates a new Agile Proposal from the data in a request
     *
     * @author Eliezer Alves
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

        $this->attributesFormProposta = $attributes['proposta'];
        $this->attributesFormCliente = $attributes['cliente'];
        $this->attributesFormSocios = $attributes['socios'];


        /*
        |--------------------------------------------------------------------------
        | Proposal at Sicred
        |--------------------------------------------------------------------------
        |
        | Generating a proposal in Sicred with the idSimulacao informed in the form.
        */


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
        $this->cliente = $this->clienteService->findByCnpj($this->attributesFormCliente['cnpj']);
        $this->cliente->fill($this->attributesFormCliente);
        $this->cliente->save();


        /*
        |--------------------------------------------------------------------------
        | Proposal at Ágil
        |--------------------------------------------------------------------------
        |
        | Normalizing the necessary attributes to create a new proposal and
        | creating a new proposal in Ágil's database.
        */
        $attributesProposta = $this->normalizaParametrosFormularioNovaProposta();
        $proposta = $this->propostaRepository->fill($attributesProposta);
        $proposta->save();


        /*
        |--------------------------------------------------------------------------
        | Legal Representative / Partners
        |--------------------------------------------------------------------------
        |
        | Saving the Legal Representative and the company's partners.
        */
        $socios = $this->pessoAssinaturaService->createMany($this->attributesFormSocios, $proposta->id_proposta);
        $proposta->cliente;
        $proposta->socios;


        /*
        |--------------------------------------------------------------------------
        | Proposal at Sicred
        |--------------------------------------------------------------------------
        |
        | Creating a proposal at Sicredi from Agil's proposal and updating Agil's
        | proposal based on data from Sicred's proposal.
        */
        $vincularPropostaSicred = $this->vincularPropostaSicred($proposta->id_proposta);
        $propostaSicred = $this->getDadosPropostaSicred($this->numeroProposta);

        return $propostaSicred;
    }


    /**
     * Service Layer - Create a proposal on sicred from an Agil proposal
     *
     * @author Eliezer Alves
     *
     * @param  int  $idProposta
     * @return int $numeroProposta
     */
    public function vincularPropostaSicred($idProposta)
    {
        $proposta = $this->propostaRepository->findOrFail($idProposta);
        // return $proposta->valor_solicitado;
        $this->numeroProposta = $this->apiSicred->novaProposta($proposta->id_simulacao);

        if (!$this->vincularClienteSicred($proposta))
            return false;
        if (!$this->vincularLiberacoesSicred($proposta))
            return false;

        return true;
    }


    /**
     * Service Layer - Links customer data to a Sicred proposal
     *
     * @author Eliezer Alves
     *
     * @param  App\Repositories\Contracts\PropostaRepositoryInterface
     * @return App\Services\Contracts\ApiSicredServiceInterface
     */
    private function vincularClienteSicred($proposta)
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

        return $this->apiSicred->vincularClienteProposta($attributes, $this->numeroProposta);
    }

    /**
     * Service Layer - Links bank details to a proposal at Sicred
     *
     * @author Eliezer Alves
     *
     * @param  App\Repositories\Contracts\PropostaRepositoryInterface
     * @return App\Services\Contracts\ApiSicredServiceInterface
     */
    private function vincularLiberacoesSicred($proposta)
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

        return $this->apiSicred->vincularLibercoesProposta($attributes, $this->numeroProposta);
    }


    /**
     * Service Layer - Get data from a proposal at Sicred
     *
     * @author Eliezer Alves
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
     * @author Eliezer Alves
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
     * @author Eliezer Alves
     *
     * @return array $dataProposta
     */
    private function normalizaParametrosFormularioNovaProposta()
    {
        return [
            'id_cliente' => $this->cliente['id_cliente'],
            'id_simulacao' => $this->attributesFormProposta['idSimulacao'],
            'renda' => $this->cliente['rendimento_mensal'] ?? 0,
            'data_solicitacao_proposta' => date('Y-m-d H:i:s'),
            'forma_liberacao' => $this->attributesFormProposta['forma_liberacao'],
            'valor_liberacao' => $this->attributesFormProposta['valor_solicitado'],
            'banco_liberacao' => $this->attributesFormProposta['banco_liberacao'],
            'agencia_liberacao' => $this->attributesFormProposta['agencia_liberacao'],
            'digito_agencia_liberacao' => $this->attributesFormProposta['digito_agencia_liberacao'],
            'conta_liberacao' => $this->attributesFormProposta['conta_liberacao'],
            'digito_conta_liberacao' => $this->attributesFormProposta['digito_conta_liberacao'],
            'tipo_conta' => $this->attributesFormProposta['tipo_conta'],
            'valor_solicitado' => $this->attributesFormProposta['valor_solicitado'],
            'quantidade_parcela' => $this->attributesFormProposta['quantidade_parcela'],
            'id_status_administrativo' => 1,
            'id_forma_inclusao' => 7,
        ];
    }
}
