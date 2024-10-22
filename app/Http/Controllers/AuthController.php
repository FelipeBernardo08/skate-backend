<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Models\Skater;

class AuthController extends Controller
{
    private $user;
    private $skater;

    public function __construct(User $users, Skater $skaters)
    {
        $this->user = $users;
        $this->skater = $skaters;
    }

    public function login(Request $request): object
    {
        try {
            $user = $this->user->getUserByEmailAndPassword($request);
            if (count($user) != 0) {
                if ($user[0]['fk_type_user'] == 2) {
                    $skater = $this->skater->readSkaterByIdUser($user[0]['id']);
                    if ($skater[0]['active']) {
                        $credentials = $request->all(['email', 'password']);
                        $token = auth('api')->attempt($credentials);
                        if ($token) {
                            return response()->json($token, 200);
                        }
                        return response()->json(['error' => 'Erro ao autenticar, acione o administrador!'], 404);
                    }
                    return response()->json(['error' => 'Cadastro não está ativo'], 404);
                } else {
                    //logict to admin
                }
            }
            return response()->json(['error' => 'Cadastro não encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 404);
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

    public function me(): array
    {
        try {
            $me = auth()->user();
            $profile = $this->user->getProfile($me->id);
            return $profile;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
