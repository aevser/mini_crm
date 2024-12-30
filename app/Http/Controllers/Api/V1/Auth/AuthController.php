<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Services\V1\Auth\AuthService;
use App\Http\Requests\V1\Auth as Requests;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected AuthService $authService
    ){}

    public function login(Requests\AuthRequest $request): JsonResponse
    {
        $validated = $this->authService->authenticate($request->validated());

        if (!$validated) {
            return $this->unauthorizedResponse(trans('auth/messages.unauthorized'));
        }

        return $this->successResponse($validated);

    }

    public function logout(): JsonResponse
    {
        $this->authService->terminateSuccess(auth()->user());
        return $this->successResponse(trans('auth/messages.logout'));
    }
}
