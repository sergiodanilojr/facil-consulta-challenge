<?php

namespace App\Exceptions;

use Exception;

class BadRequestException extends Exception
{
    protected $message = "Erro na solicitação. Tente novamente.";

    public function render()
    {
        return response()->json([
            'message' => $this->message,
        ], 400);
    }
}
