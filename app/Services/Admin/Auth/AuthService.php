<?php

namespace App\Services\Admin\Auth;

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

    public function authenticate(array $data): bool
    {
        if (!Auth::attempt($data)) {
            return false;
        }

        return true;
    }

    public function terminateSession(): void
    {
        Auth::logout();
    }
}
