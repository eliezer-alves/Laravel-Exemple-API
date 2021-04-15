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
        $this->numeroProposta = $this->apiSicred->novaProposta($this->attributesFormProposta['idSimulacao']);


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
        $attributesPropostaAgil = $this->normalizaParametrosPropostaAgil();
        $propostaAgil = $this->propostaRepository->fill($attributesPropostaAgil);
        $propostaAgil->save();


        /*
        |--------------------------------------------------------------------------
        | Legal Representative / Partners
        |--------------------------------------------------------------------------
        |
        | Saving the Legal Representative and the company's partners
        */
        $socios = $this->pessoAssinaturaService->createMany($this->attributesFormSocios, $propostaAgil->id_proposta);

        return $propostaAgil;
    }

    /**
     * Service Layer - Links customer data to a Sicred proposal
     *
     * @author Eliezer Alves
     *
     * @return App\Services\Contracts\ApiSicredServiceInterface
     */
    private function vincularClienteSicred()
    {
        $attributes = [
            'cnpj' => $this->attributesFormCliente['cnpj'],
            'razaoSocial' => $this->attributesFormCliente['razao_social'],
            'fundacao' => $this->attributesFormCliente['data_fundacao'],
            'inscricaoEstadual' => $this->attributesFormCliente['inscricao_estadual'],
            'capitalSocial' => $this->attributesFormCliente['capital_social'],
            // 'numeroFuncionarios'=> $this->attributesFormCliente['numeroFuncionarios'],
            'anoFaturamento' => $this->attributesFormCliente['ano_faturamento'],
            'valorFaturamentoAnual' => $this->attributesFormCliente['faturamento_anual'],
            'porte' => $this->attributesFormCliente['porte'],
            'email' => $this->attributesFormCliente['email'],
            'cepResidencial' => $this->attributesFormCliente['cep'],
            'enderecoResidencial' => $this->attributesFormCliente['logradouro'],
            'numeroResidencial' => $this->attributesFormCliente['numero'],
            'complementoResidencial' => $this->attributesFormCliente['complemento'],
            'bairroResidencial' => $this->attributesFormCliente['bairro'],
            'cidadeResidencial' => $this->attributesFormCliente['cidade'],
            'ufResidencial' => $this->attributesFormCliente['uf']
            // 'codigoExterno'=> $this->attributesFormCliente['codigoExterno']
        ];
        return $this->apiSicred->vincularClienteProposta($attributes, $this->numeroProposta);
    }

    /**
     * Service Layer - Links bank details to a proposal at Sicred
     *
     * @author Eliezer Alves
     *
     * @return App\Services\Contracts\ApiSicredServiceInterface
     */
    private function vincularLiberacoesSicred()
    {
        $attributes = [
            'nomeBeneficiario' => $this->attributesFormCliente['nome_fantasia'],
            'cnpj' => $this->attributesFormCliente['cnpj'],
            'formaLiberacao' => $this->attributesFormProposta['forma_liberacao'],
            'valorLiberacao' => $this->attributesFormProposta['valor_solicitado'],
            'bancoLiberacao' => $this->attributesFormProposta['banco_liberacao'],
            'agenciaLiberacao' => $this->attributesFormProposta['agencia_liberacao'],
            'contaLiberacao' => $this->attributesFormProposta['conta_liberacao'],
            'tipoConta' => $this->attributesFormProposta['tipo_conta'],
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
        return (array)$this->apiSicred->exibeProposta($numeroProposta);
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
    private function normalizaParametrosPropostaAgil()
    {
        return [
            'contrato' => $this->numeroProposta,
            'id_cliente' => $this->cliente['id_cliente'] ?? 1,
            'renda' => $this->cliente['rendimento_mensal'] ?? 0,
            'id_simulacao' => $this->attributesFormProposta['idSimulacao'],
            'data_solicitacao_proposta' => date('Y-m-d H:i:s'),
            'forma_liberacao' => $this->attributesFormProposta['forma_liberacao'],
            'valor_liberacao' => $this->attributesFormProposta['valor_solicitado'],
            'banco_liberacao' => $this->attributesFormProposta['banco_liberacao'],
            'agencia_liberacao' => $this->attributesFormProposta['agencia_liberacao'],
            'digito_agencia_liberacao' => $this->attributesFormProposta['digito_agencia_liberacao'],
            'conta_liberacao' => $this->attributesFormProposta['conta_liberacao'],
            'digito_conta_liberacao' => $this->attributesFormProposta['digito_conta_liberacao'],
            'tipo_conta' => $this->attributesFormProposta['tipo_conta'],
            'id_status_administrativo' => 1,
            'valor_solicitado' => $this->attributesFormProposta['valor_solicitado'],
            'quantidade_parcela' => $this->attributesFormProposta['quantidade_parcela'],
            'id_forma_inclusao' => 7,
        ];
    }
}
