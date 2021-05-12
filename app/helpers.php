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
        		$request[$key] = strtoupper(preg_replace('/[^A-Za-z0-9 \ ]/', '', Str::ascii($value)));
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

?>
