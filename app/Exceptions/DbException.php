<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class DbException extends Exception
{
    private $statusCode;
    private $exception;

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
        Log::channel('dbExceptions')->warning($this->message, ['status' => $this->statusCode, 'error' => $this->exception->getMessage()]);
        return response(['error' => $this->message], $this->statusCode);
    }
}
