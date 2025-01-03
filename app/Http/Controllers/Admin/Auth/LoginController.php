<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Services\Admin\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ){}

    public function getLoginView(): View
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if ($this->authService->authenticate($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.auth.login')->with('error', trans('auth/messages.unauthorized'));
    }

    public function logout()
    {
        $this->authService->terminateSession();
        return redirect()->route('admin.auth.login');
    }
}
