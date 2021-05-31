<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Exception - Class responsible for managing excess requests for GAC Consultas
 *
 * @author Eliezer Alves
 * @since 31/04/2021
 *
 */
class FailedRequestGacConsultas extends Exception
{
    private $response;
    private $content;

    public function __construct($response, $message = 'Houveram problemas ao consumir GAC Consultas.', $content = [])
    {
        $this->response = $response;
        $this->message = $message;
        $this->content = $content;
    }

    public function report()
    {
    }

    public function render()
    {
        $responseBody = json_decode($this->response->body()) ?? [];
        $data = [
            'message' => $this->message,
            'errors' => '',
            'responseBody' => $responseBody
        ];

        Log::channel('gacConsultas')->warning($this->message, array_merge($data, $this->content));

        return response($data, $this->response->status());
    }
}
