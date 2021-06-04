<?php

namespace App\Services;


/**
 * Class to normalize array keys
 *
 * @author Eliezer Alves
 * @since 19/04/2021
 *
 */

class KeysInterfaceService
{
    /**
     * Standardization of fields from the form to the proposal table columns
     *
     * @since 19/04/2021
     *
     * @return array
     */
    public function atributosFormularioNovaProposta()
    {
        return [
            [
                'inputKey' => 'id_simulacao',
                'sourceKey' => 'id_simulacao'
            ],
            [
                'inputKey' => 'forma_liberacao',
                'sourceKey' => 'forma_liberacao'
            ],
            [
                'inputKey' => 'valor_solicitado',
                'sourceKey' => 'valor_solicitado'
            ],
            [
                'inputKey' => 'banco_liberacao',
                'sourceKey' => 'banco_liberacao'
            ],
            [
                'inputKey' => 'agencia_liberacao',
                'sourceKey' => 'agencia_liberacao'
            ],
            [
                'inputKey' => 'digito_agencia_liberacao',
                'sourceKey' => 'digito_agencia_liberacao'
            ],
            [
                'inputKey' => 'conta_liberacao',
                'sourceKey' => 'conta_liberacao'
            ],
            [
                'inputKey' => 'digito_conta_liberacao',
                'sourceKey' => 'digito_conta_liberacao'
            ],
            [
                'inputKey' => 'tipo_conta',
                'sourceKey' => 'tipo_conta'
            ],
            [
                'inputKey' => 'valor_solicitado',
                'sourceKey' => 'valor_solicitado'
            ],
            [
                'inputKey' => 'atd_protocolo',
                'sourceKey' => 'atd_protocolo'
            ],
            [
                'inputKey' => 'atd_celular',
                'sourceKey' => 'atd_celular'
            ],
            [
                'inputKey' => 'id_usuario',
                'sourceKey' => 'id_usuario'
            ],
            [
                'inputKey' => 'id_status_analise_proposta',
                'sourceKey' => 'id_status_analise_proposta'
            ],
            [
                'inputKey' => 'motivo_pendente',
                'sourceKey' => 'motivo_pendente'
            ],
        ];
    }

    /**
     * List of keys and values ​​between the form and the request
     * to Sicred in the process of linking the client
     *
     * @since 17/05/2021
     *
     * @return array
     */
    public function clienteAgilSicred()
    {
        return [
            [
                'inputKey' => 'cnpj',
                'sourceKey' => 'cnpj'
            ],
            [
                'inputKey' => 'razaoSocial',
                'sourceKey' => 'razao_social'
            ],
            [
                'inputKey' => 'dataFundacao',
                'sourceKey' => 'data_fundacao'
            ],
            [
                'inputKey' => 'inscricaoEstadual',
                'sourceKey' => 'inscricao_estadual'
            ],
            [
                'inputKey' => 'capitalSocial',
                'sourceKey' => 'capital_social'
            ],
            [
                'inputKey' => 'anoFaturamento',
                'sourceKey' => 'ano_faturamento'
            ],
            [
                'inputKey' => 'valorFaturamentoAnual',
                'sourceKey' => 'faturamento_anual'
            ],
            [
                'inputKey' => 'cosif',
                'sourceKey' => 'id_cosif'
            ],
            [
                'inputKey' => 'email',
                'sourceKey' => 'email'
            ],
            [
                'inputKey' => 'cepResidencial',
                'sourceKey' => 'cep'
            ],
            [
                'inputKey' => 'enderecoResidencial',
                'sourceKey' => 'logradouro'
            ],
            [
                'inputKey' => 'numeroResidencial',
                'sourceKey' => 'numero'
            ],
            [
                'inputKey' => 'complementoResidencial',
                'sourceKey' => 'complemento'
            ],
            [
                'inputKey' => 'bairroResidencial',
                'sourceKey' => 'bairro'
            ],
            [
                'inputKey' => 'cidadeResidencial',
                'sourceKey' => 'cidade'
            ],
            [
                'inputKey' => 'ufResidencial',
                'sourceKey' => 'uf'
            ],
        ];
    }

    /**
     * List of keys and values ​​between the form and the request
     * to Sicred in the process of linking the client
     *
     * @since 17/05/2021
     *
     * @return array
     */
    public function liberacoesAgilSicred()
    {
        return [
            [
                'inputKey' => 'cnpj',
                'sourceKey' => 'cnpj_beneficiario'
            ],
            [
                'inputKey' => 'formaLiberacao',
                'sourceKey' => 'forma_liberacao'
            ],
            [
                'inputKey' => 'valorLiberacao',
                'sourceKey' => 'valor_solicitado'
            ],
            [
                'inputKey' => 'bancoLiberacao',
                'sourceKey' => 'banco_liberacao'
            ],
            [
                'inputKey' => 'agenciaLiberacao',
                'sourceKey' => 'agencia_liberacao'
            ],
            [
                'inputKey' => 'contaLiberacao',
                'sourceKey' => 'conta_liberacao'
            ],
            [
                'inputKey' => 'tipoConta',
                'sourceKey' => 'tipo_conta'
            ],
        ];
    }

    /**
     * Key relationship of the Agil proposal with the Sicred Proposal
     * to align the Agil Proposal with the Sicred Proposal data
     *
     * @since 19/04/2021
     *
     * @return array
     */
    public function alinharPropostaAgilComSicred()
    {
        return [
            [
                'inputKey' => 'contrato',
                'sourceKey' => 'proposta'
            ],
            // [
            //     'inputKey' => 'data_geracao_proposta',
            //     'sourceKey' => 'dataEmissao'
            // ],
            [
                'inputKey' => 'quantidade_parcela',
                'sourceKey' => 'prazo'
            ],
            [
                'inputKey' => 'tac',
                'sourceKey' => 'valorTC'
            ],
            [
                'inputKey' => 'valor_iof',
                'sourceKey' => 'valorIof'
            ],
            [
                'inputKey' => 'valor_seguro',
                'sourceKey' => 'valorSeguro'
            ],
            [
                'inputKey' => 'valor_liquido_credito',
                'sourceKey' => 'valorFinanciado'
            ],
            [
                'inputKey' => 'valor_financiado_total',
                'sourceKey' => 'valorFinanciadoTotal'
            ],
            [
                'inputKey' => 'valor_total_a_pagar',
                'sourceKey' => 'valorTotalAPagar'
            ],
            [
                'inputKey' => 'valor_liberacao',
                'sourceKey' => 'valorLiberado'
            ],
            [
                'inputKey' => 'taxa_juros_mes',
                'sourceKey' => 'taxaMes'
            ],
            [
                'inputKey' => 'taxa_juros_ano',
                'sourceKey' => 'taxaAno'
            ],
            [
                'inputKey' => 'valor_parcela',
                'sourceKey' => 'valorParcela'
            ],
            [
                'inputKey' => 'cet_mes',
                'sourceKey' => 'cetMes'
            ],
            [
                'inputKey' => 'cet_ano',
                'sourceKey' => 'cetAno'
            ],
        ];
    }

    /**
     * Key list of Sicred's installment registration keys
     * with Ágil's installment table keys
     *
     * @since 22/04/2021
     *
     * @return array
     */
    public function alinharParcelaPropostaAgilComSicred()
    {
        return [
            [
                'inputKey' => 'numero_parcela',
                'sourceKey' => 'codigoParcela'
            ],
            [
                'inputKey' => 'vencimento',
                'sourceKey' => 'dataVencimento'
            ],
            [
                'inputKey' => 'valor',
                'sourceKey' => 'valorPmt'
            ],
        ];
    }

    /**
     * List of keys of the registration process an analysis of the proposal
     *
     * @since 01/06/2021
     *
     * @return array
     */
    public function registrarAnaliseProposta()
    {
        return [
            [
                'inputKey' => 'id_proposta',
                'sourceKey' => 'id_proposta'
            ],
            [
                'inputKey' => 'id_status_analise_proposta',
                'sourceKey' => 'id_status_analise_proposta'
            ],
            [
                'inputKey' => 'valor_aprovado',
                'sourceKey' => 'valor_aprovado'
            ],
        ];
    }

    /**
     * List of keys to save analysis of the person related to the proposal
     *
     * @since 01/06/2021
     *
     * @return array
     */
    public function registrarAnalisePessoaProposta()
    {
        return [
            [
                'inputKey' => 'id_pessoa_assinatura',
                'sourceKey' => 'id_pessoa_assinatura'
            ],
            [
                'inputKey' => 'id_proposta',
                'sourceKey' => 'id_proposta'
            ],
            [
                'inputKey' => 'id_analise_proposta',
                'sourceKey' => 'id_analise_proposta'
            ],
            [
                'inputKey' => 'id_info_mais',
                'sourceKey' => 'id_info_mais'
            ],
            [
                'inputKey' => 'id_scpc',
                'sourceKey' => 'id_scpc'
            ],
            [
                'inputKey' => 'id_spc_brasil',
                'sourceKey' => 'id_spc_brasil'
            ],
            [
                'inputKey' => 'id_confirme_online',
                'sourceKey' => 'id_confirme_online'
            ],
            [
                'inputKey' => 'id_score',
                'sourceKey' => 'id_score'
            ],
            [
                'inputKey' => 'restricao',
                'sourceKey' => 'restricao'
            ],
            [
                'inputKey' => 'score',
                'sourceKey' => 'score'
            ],
            [
                'inputKey' => 'classificacao_score',
                'sourceKey' => 'classificacao_score'
            ],
        ];
    }

    /**
     * Generic method to hydrate an array with a source array through a key relationship
     *
     * @since 19/04/2021
     *
     * @param array $sourceArray - Array containing the data that will be used to hydrate the return arry
     * @param array $keysInterface - Interface array of the data of the source array (containing the data) and the array that will be returned (array generated in the hydration process)
     * @param bool $reverse - Parameter that inverts the order between $ sourceArray and $ keysInterface, thus reversing the method's behavior.
     *
     * @return array
     */
    public function hydrator($sourceArray, $keysInterface, $reverse = false)
    {
        $resultArray = [];
        foreach ($keysInterface as $interface) {
            if(!$reverse){
                $resultArray[$interface['inputKey']] = $sourceArray[$interface['sourceKey']] ?? null;
            }else{
                $resultArray[$interface['sourceKey']] = $sourceArray[$interface['inputKey']] ?? null;
            }
        }

        return $resultArray;
    }
}
