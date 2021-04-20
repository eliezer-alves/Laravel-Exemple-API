<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Http;

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

    public function __construct($response)
    {
        $this->response = $response;
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
        $errors = [];
        if ($responseBody) {
            foreach ($responseBody as $error) {
                if ($error->field) {
                    $error->field = strtolower($error->field);
                    $errors[$error->field][] = $error->message;
                } else if ($error->message) {
                    $errors[] = $error->message;
                }
            }
        }

        return $errors;
    }

    public function report()
    {
    }

    public function render()
    {
        $responseBody = json_decode($this->response->body()) ?? [];
        $data = [
            'message' => 'Sicred - Os dados fornecidos são inválidos.',
            'errors' => $this->errorsResponse($responseBody)
        ];

        return response($data, $this->response->status());
    }
}
