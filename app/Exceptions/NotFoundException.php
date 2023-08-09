<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Recurso não encontrado!';

    public function render()
    {
        return response()->json([
            'message' => $this->message,
        ], 404);
    }
}
