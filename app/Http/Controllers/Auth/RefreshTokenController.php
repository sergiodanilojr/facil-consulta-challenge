<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class RefreshTokenController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return AuthService::refresh();
    }
}
