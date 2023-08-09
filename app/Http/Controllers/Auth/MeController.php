<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * Handle the incoming request.
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $user = AuthService::user();

        return (new UserResource($user))->response()->setStatusCode(200);
    }
}
