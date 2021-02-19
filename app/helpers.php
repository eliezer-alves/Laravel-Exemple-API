<?php

if (! function_exists('_normalizeRequest')) {
    function _normalizeRequest($request) {
    	$exceptions = ['email', 'email_confirmation', 'senha', 'senha_confirmation'];

        foreach ($request as $key => $value) {
        	if(gettype($value)=="string" && !in_array($key, $exceptions)){
        		$request[$key] = strtoupper(preg_replace('/[^A-Za-z0-9 \ ]/', '', Str::ascii($value)));
        	}
        }
        return $request;
    }
}

?>