<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $service = AuthService::withCredentials(
            email: $request->validated('email'),
            password: $request->validated('password'),
        )->login();

        return response()->json($service->toArray());
    }
}
