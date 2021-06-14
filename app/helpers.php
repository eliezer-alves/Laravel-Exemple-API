<?php

if (! function_exists('_normalizeRequest')) {
    /**
     * Helper Layer - Normalizes request data to Agile database standards
     * @author Eliezer Alves
     * @since 01/04/2021
     *
     * @param array $request
     * @return array $request
     */
    function _normalizeRequest($request, $hidden = []) {
        foreach ($request as $key => $value) {
        	if(gettype($value)=="string" && !in_array($key, $hidden)){
        		$request[$key] = strtoupper(preg_replace('/[^A-Za-z0-9\/\/ ]/', '', Str::ascii($value)));
        	}
        }
        return $request;
    }
}

if (! function_exists('_hashAssinatura')) {
    /**
     * Helper Layer - Responsible method to generate a signature hash
     * @author Eliezer Alves
     * @since 05/05/2021
     *
     * @param int $idProposta
     * @param int $idPessoaAssinatura
     * @param int $ipCliente
     * @return string
     */
    function _hashAssinatura($idProposta, $idPessoaAssinatura, $ipCliente) {
        return md5($idProposta . $idPessoaAssinatura . $ipCliente . bcrypt(date('Y-m-d')));
    }
}

if (! function_exists('_classificarScore')) {
    /**
     * Helper Layer - Method responsible for classifying a score value
     *
     * @param  int $score
     * @return string $classificacaoScore
     */
    function _classificarScore($score)
    {
        $classificacaoScore = 'SEM INFORMACAO';

        if ($score == ''  || ($score >= 0 && $score <= 1))
            $classificacaoScore = 'SEM INFORMACAO';
        else if ($score >= 2 && $score <= 322)
            $classificacaoScore = 'ALTISSIMO RISCO';
        else if ($score > 322 && $score <= 365)
            $classificacaoScore = 'ALTO RISCO';
        else if ($score > 365 && $score <= 529)
            $classificacaoScore = 'MEDIO RISCO';
        else if ($score > 529 && $score <= 747)
            $classificacaoScore = 'BAIXO RISCO';
        else if ($score > 747 && $score <= 1000)
            $classificacaoScore = 'BAIXISSIMO RISCO';
        else
            $classificacaoScore = 'SEM INFORMACAO';

        return $classificacaoScore;
    }
}

?>
