<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request): object
    {
        $credentials = $request->all(['email', 'password']);
        $token = auth('api')->attempt($credentials);
        if ($token) {
            return response()->json($token, 200);
        } else {
            return response()->json(['error' => 'Registro nao encontrado!'], 404);
        }
    }

    public function logout(): object
    {
        try {
            Auth::guard('api')->logout();
            return response()->json(['message' => 'Logout realizado com sucesso!'], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Falha ao realizar logout, tente novamente.'], 500);
        }
    }

    public function refresh(): object
    {
        try {
            $token = JWTAuth::getToken();
            $refreshedToken = JWTAuth::refresh($token);
            return response()->json($refreshedToken, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function me(): object
    {
        try {
            return response()->json(auth()->user());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
