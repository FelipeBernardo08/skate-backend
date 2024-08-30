<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request): string
    {
        $credentials = $request->all(['email', 'password']);
        $token = auth('api')->attempt($credentials);
        if ($token) {
            return response()->json($token, 200);
        } else {
            return response()->json(['error' => 'Registro nao encontrado!'], 404);
        }
    }

    public function logout() {}

    public function refresh() {}

    public function me(): object
    {
        return response()->json(auth()->user());
    }
}
