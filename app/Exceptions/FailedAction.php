<?php

namespace App\Exceptions;

use Exception;

class FailedAction extends Exception
{
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    public function report()
    {
    }

    public function render()
    {
        return response(['error' => $this->message], 400);
    }
}
