<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class FailedAction extends Exception
{
    private $statusCode;

    public function __construct($message = '', $statusCode = 400)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
    }

    public function report()
    {
    }

    public function render()
    {
        Log::channel('failedActions')->warning($this->message, ['status' => $this->statusCode]);
        return response(['error' => $this->message], $this->statusCode);
    }
}
