<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class DbException extends Exception
{
    private $statusCode;
    private $exception;
    private $model;

    public function __construct($message = '', Exception $exception, Model $model, $statusCode = 500)
    {
        $this->message = $message;
        $this->exception = $exception;
        $this->model = $model;
        $this->statusCode = $statusCode;
    }

    public function report()
    {
    }

    public function render()
    {
        $content = [
            'status' => $this->statusCode,
            'table' => $this->model->getTable(),
            'error' => $this->exception->getMessage()
        ];

        Log::channel('dbExceptions')->warning($this->message, $content);

        if(request()->header('content-type') == "application/json")
            return response(['error' => $this->message], $this->statusCode);

        abort($this->statusCode, $this->message);
    }
}
