<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1 as Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Requests\LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['messages' => 'Неверные данные'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'user' => $request->user()->name,
            'token' => $request->user()->createToken('api_toke')->plainTextToken
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['messages' => 'Вышли из системы'], Response::HTTP_OK);
    }
}
