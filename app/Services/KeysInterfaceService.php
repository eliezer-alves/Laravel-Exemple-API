<?php

namespace App\Services;

class KeysInterfaceService
{
    /**
     * Key relationship of the Agil proposal with the Sicred Proposal
     * to align the Agil Proposal with the Sicred Proposal data
     *
     * @author Eliezer Alves
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
            [
                'inputKey' => 'data_geracao_proposta',
                'sourceKey' => 'dataEmissao'
            ],
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
     * Generic method to hydrate an array with a source array through a key relationship
     *
     * @author Eliezer Alves
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
            $resultArray[$interface['inputKey']] = $sourceArray[$interface['sourceKey']];
        }

        return $resultArray;
    }
}
