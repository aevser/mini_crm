<?php

namespace App\Services\V1\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function authenticate(array $data): array
    {
        if (!Auth::attempt($data)) {
            return [
                'success' => false,
            ];
        }
        $user = Auth::user();

        return [
            'user' => $user->name,
            'bearer' => $user->createToken('api_token')->plainTextToken,
        ];
    }

    public function terminateSuccess(User $user): bool
    {
        return $user->tokens()->delete();
    }
}
