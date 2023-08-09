<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AuthException extends Exception
{
    protected $message = 'Acesso negado!';

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
        ], 401);
    }
}
