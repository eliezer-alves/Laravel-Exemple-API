<?php

namespace App\Services;

use App\Services\Contracts\ApiSicredServiceInterface;
use App\Services\{
    ClienteService
};

class PropostaService
{
    private $apiSicred;
    private $clienteService;

    public function __construct(ApiSicredServiceInterface $apiSicred, ClienteService $clienteService)
    {
        $this->apiSicred = $apiSicred;
        $this->clienteService = $clienteService;
    }

    /**
     * Service Layer - Creates a new Agile Proposal from the data in a request
     *
     * @param  array  $attributes
     * @return json  $dataProposta
     */
    public function novaProposta($attributes)
    {
        $attributesProposta = $attributes['proposta'];
        $attributesCliente = $attributes['cliente'];
        $attributesSocios = $attributes['socios'];

        $numeroProposta = $this->apiSicred->novaProposta($attributesProposta['idSimulacao']);
        // $vinculaCliente = $this->apiSicred->vincularClienteProposta($attributesCliente, $numeroProposta);
        $vinculaLiberacoes =  $this->apiSicred->vincularLibercoesProposta($attributesProposta, $attributesCliente, $numeroProposta);
        $dadosPropostaSicred = (array)$this->apiSicred->exibeProposta($numeroProposta);
        $dadosLiberacoesSicred = (array)$this->apiSicred->exibeLiberacoesProposta($numeroProposta);
        // dd($attributesCliente, $dadosPropostaSicred, $dadosLiberacoesSicred);

        $cliente = $this->clienteService->create($attributesCliente);
        // dd($cliente);
        $data = $this->normalizaParametrosSalvarProposta($attributesProposta, $dadosPropostaSicred, $dadosLiberacoesSicred, $cliente);
        dd($data);

        dd($numeroProposta, $vinculaLiberacoes, $dadosPropostaSicred);

        return  $this->apiSicred->vincularClienteProposta($attributesCliente, $attributesCliente, $numeroProposta);
    }


    /**
     * Service Layer - Fetch data from a proposal at Sicred
     *
     * @param  int  $numeroProposta
     * @return json  $dataProposta
     */
    public function exibeProposta($numeroProposta)
    {
        return $this->apiSicred->exibeProposta($numeroProposta);
    }

    /**
     * Service Layer - Fetch data from a proposal at Sicred
     *
     * @param  array $attributes
     * @return array $dataProposta
     */
    private function normalizaParametrosSalvarProposta($attributesProposta, $attributesPropostaSicred, $attributesLiberacoes, $cliente)
    {
        return [
            'id_cliente' => $cliente['id_cliente'],
            'renda' => 100,

            'forma_liberacao' => $attributesProposta['forma_liberacao'],
            'valor_liberacao' => $attributesLiberacoes['valorLiberacao'],
            'banco_liberacao' => $attributesProposta['banco_liberacao'],
            'agencia_liberacao' => $attributesProposta['agencia_liberacao'],
            'digito_agencia_liberacao' => $attributesProposta['digito_agencia_liberacao'],
            'conta_liberacao' => $attributesProposta['conta_liberacao'],
            'digito_conta_liberacao' => $attributesProposta['digito_conta_liberacao'],
            'tipo_conta' => $attributesProposta['tipo_conta'],

            'contrato' => $attributesPropostaSicred['proposta'],
            'plano' => $attributesPropostaSicred['plano'],
            'data_solicitacao_proposta' => $attributesPropostaSicred['dataEmissao'],
            'id_status_administrativo' => 1,
            'valor_iof' => $attributesPropostaSicred['valorIof'],
            'tac' => $attributesPropostaSicred['valorTC'],
            'valor_solicitado' => $attributesPropostaSicred['valorFinanciado'],
            'valor_financiado_total' => $attributesPropostaSicred['valorFinanciadoTotal'],
            'valor_liquido_credito' => $attributesPropostaSicred['valorLiberado'],
            'valor_parcela' => $attributesPropostaSicred['valorParcela'],
            'quantidade_parcela' => (int)$attributesPropostaSicred['prazo'],
            'cet_mes' => $attributesPropostaSicred['cetMes'],
            'cet_ano' => $attributesPropostaSicred['cetAno'],
            'valor_seguro' => $attributesPropostaSicred['valorSeguro'],
            'data_geracao_proposta' => $attributesPropostaSicred['dataEmissao'],
            'taxa_juros_mes' => $attributesPropostaSicred['taxaMes'],
            'taxa_juros_ano' => $attributesPropostaSicred['taxaAno'],
            'id_forma_inclusao' => 7,
            'valor_total_a_pagar' => $attributesPropostaSicred['valorTotalAPagar']
        ];
    }
}
