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

if (! function_exists('_base64url_encode')) {
    /**
     * Helper Layer - Responsible method to encode a url param hash
     * @author Eliezer Alves
     * @since 23/06/2021
     *
     * @param int $data
     * @return string
     */
    function _base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
      }
}

if (! function_exists('_base64url_decode')) {
    /**
     * Helper Layer - Responsible method to decode a url param hash
     * @author Eliezer Alves
     * @since 23/06/2021
     *
     * @param int $data
     * @return string
     */
    function _base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
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

if (! function_exists('zipPath')) {
    /**
     * Helper Layer - Method to compress an application file or folder (in app/public)
     *
     * @param  string $dir Path of the folder or file to be zipped
     * @param  bool $clear Remove the zipped folder
     * @return void
     */
    function zipPath($path, $clear = false)
    {
        $dir = basename($path);

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            exec('cd ' . $path . '&& cd .. && tar.exe -a -c -f ' . $dir . '.zip ' . $dir);
            if($clear)
                exec('cd ' . $path . ' && cd .. && rmdir /Q /S ' . $dir);
        } else {
            exec('cd ' . $path . ' && cd .. && zip ' . $dir . '.zip -r ' . $dir);
            if($clear)
                exec('cd ' . $path . ' && cd .. && rm -r ' . $dir);
        }

        return url(str_replace(public_path(''), '', $path). '.zip');
     }
}

if (! function_exists('public_files_path')) {
    /**
     * Helper Layer - Get the path to the public files folder.
     *
     * @param  string $path
     * @return string
     */
    function public_files_path($path): string
    {
        return public_path("files/$path");
    }
}

if (! function_exists('rrmdir')) {
    /**
     * Helper Layer - Recursively delete a directory that is not empty
     *
     * @param  string $dir
     * @return void
     */
    function rrmdir($dir): void
    {
        if (is_dir($dir)) {
          $objects = scandir($dir);
          foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
              if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
            }
          }
          reset($objects);
          rmdir($dir);
        }
     }
}

?>
