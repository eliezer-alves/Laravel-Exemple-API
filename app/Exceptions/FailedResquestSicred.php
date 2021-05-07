<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Exception - Class responsible for managing excess requests for sicred
 *
 * @author Eliezer Alves
 * @since 20/04/2021
 *
 */
class FailedResquestSicred extends Exception
{
    private $response;

    public function __construct($response, $message = 'Houveram problemas na integração com a Sicred.')
    {
        $this->response = $response;
        $this->message = $message;
    }

    /**
     * Exception Class - Method responsible for normalizing
     * error messages returned by Sicred
     *
     * @param array $responseBody
     * @return array $errors
     */
    private function errorsResponse($responseBody)
    {
        $errors = null;
        if (isset($responseBody)) {
            foreach ($responseBody as $error) {
                if (is_string($error)) {
                    $errors[] = $error ?? '';
                } else if (isset($error->field)) {
                    $error->field = strtolower($error->field);
                    $errors[$error->field][] = $error->message ?? '';
                } else if (isset($error->message)) {
                    $errors[] = $error->message ?? '';
                }
            }
        }

        return $errors ?? ['Nenhuma menssagem de erro especificada.'];
    }

    public function report()
    {
    }

    public function render()
    {
        $responseBody = json_decode($this->response->body()) ?? [];
        $data = [
            'message' => $this->message,
            'errors' => $this->errorsResponse($responseBody)
        ];

        Log::channel('sicred')->warning($this->message, $data);

        return response($data, $this->response->status());
    }
}
