<?php

namespace App\Http\Controllers;

use App\Models\skater;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Exception;
use Illuminate\Http\Request;

class SkaterController extends Controller
{
    private $skater;
    private $user;
    private $auth;

    public function __construct(skater $skate, User $users, AuthController $authController)
    {
        $this->skater = $skate;
        $this->user = $users;
        $this->auth = $authController;
    }

    public function createSkater(Request $request): object
    {
        try {
            $responseUser = $this->user->createUserSkater($request);
            if (count($responseUser) != 0) {
                $responseSkater = $this->skater->createSkater($responseUser);
                if (count($responseSkater) != 0) {
                    return response()->json($responseSkater, 200);
                }
                return $this->error('Erro ao criar skater');
            }
            return $this->error('Erro ao criar user');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function updateSkater(Request $request)
    {
        try {
            $me = $this->auth->me();
            $response = $this->skater->updateSkater($request, $me[0]['skater'][0]['id']);
            if ($response) {
                return response()->json(['msg' => 'Dados atualizados com sucesso!'], 200);
            }
            return $this->error('Dados não foram atualizados!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function updatePassword(Request $request): object
    {
        try {
            $me = $this->auth->me();
            $response = $this->user->changePassword($request, $me[0]['id']);
            if ($response) {
                return response()->json(['msg' => 'Senha alterada com sucesso!'], 200);
            }
            return $this->error('Erro ao trocar senha!');
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function error($error): object
    {
        return response()->json(['Error' => $error], 404);
    }

    public function accessUnauthorized()
    {
        return response()->json(['Error' => 'Não autorizado!'], 401);
    }
}
