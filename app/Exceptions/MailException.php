<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class MailException extends Exception
{
    private $exception;
    private $statusCode;

    public function __construct($message = '', Exception $exception, $statusCode = 500)
    {
        $this->message = $message;
        $this->exception = $exception;
        $this->statusCode = $statusCode;
    }

    public function report()
    {
    }

    public function render()
    {
        $content = [
            'status' => $this->statusCode,
            'error' => $this->exception->getMessage()
        ];

        Log::channel('mailExceptions')->warning($this->message, $content);
        
        return response(['error' => $this->message], $this->statusCode);
    }
}
