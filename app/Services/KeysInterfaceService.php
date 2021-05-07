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
                'inputKey' => 'id_usuario',
                'sourceKey' => 'id_usuario'
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
     * Generic method to hydrate an array with a source array through a key relationship
     *
     * @since 19/04/2021
     *
     * @param array $sourceArray
     * @param array $keysInterface
     *
     * @return array
     */
    public function hydrator($sourceArray, $keysInterface)
    {
        $resultArray = [];
        foreach ($keysInterface as $interface) {
            $resultArray[$interface['inputKey']] = $sourceArray[$interface['sourceKey']] ?? null;
        }

        return $resultArray;
    }
}
