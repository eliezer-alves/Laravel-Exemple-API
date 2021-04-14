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
     * @param  array  $attributes
     * @return json  $dataProposta
     */
    public function novaProposta($attributes)
    {
        $this->attributesFormProposta = $attributes['proposta'];
        $this->attributesFormCliente = $attributes['cliente'];
        $this->attributesFormSocios = $attributes['socios'];
        $this->numeroProposta = $this->apiSicred->novaProposta($this->attributesFormProposta['idSimulacao']);

        $this->cliente = $this->clienteService->findByCnpj($this->attributesFormCliente['cnpj']);
        $this->cliente = $this->clienteService->create($this->attributesFormCliente);
        // dd($this->cliente);

        $attributesPropostaAgil = $this->normalizaParametrosPropostaAgil();
        $propostaAgil = $this->propostaRepository->fill($attributesPropostaAgil);
        $propostaAgil->save();

        $pessoaAssinatura = $this->pessoAssinaturaService->createMany($this->attributesFormSocios, $propostaAgil->id_proposta);
        dd($pessoaAssinatura, $propostaAgil);

        // $this->vincularClienteSicred();
        // $this->vincularLiberacoesSicred();

        // $dadosPropostaSicred = $this->getDadosPropostaSicred($this->numeroProposta);
        // $dadosLiberacoesSicred = $this->getDadosLiberacoesPropostaSicred($this->numeroProposta);

        return 0;
    }

    /**
     * Service Layer - Links customer data to a Sicred proposal
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
