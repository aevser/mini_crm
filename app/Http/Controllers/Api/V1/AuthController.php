<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1 as Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Requests\LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => 'Неверные данные'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
                'user' => $request->user()->name,
                'token' => $request->user()->createToken('api_token')->plainTextToken
            ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Вышли из системы'], Response::HTTP_OK);
    }
}
