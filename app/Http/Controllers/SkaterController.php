<?php

namespace App\Http\Controllers;

use App\Models\skater;
use App\Models\User;
use App\Models\TokenConfirmAccount;
use App\Http\Controllers\AuthController;
use Exception;
use Illuminate\Http\Request;
use App\Mail\ConfirmAccount;
use Illuminate\Support\Facades\Mail;

class SkaterController extends Controller
{
    private $skater;
    private $user;
    private $auth;
    private $tokenConfirm;

    public function __construct(
        skater $skate,
        User $users,
        AuthController $authController,
        TokenConfirmAccount $tokenConfirmAccount
    ) {
        $this->skater = $skate;
        $this->user = $users;
        $this->auth = $authController;
        $this->tokenConfirm = $tokenConfirmAccount;
    }

    public function createSkater(Request $request): object
    {
        try {
            $responseUser = $this->user->createUserSkater($request);
            if (count($responseUser) != 0) {
                $responseSkater = $this->skater->createSkater($responseUser);
                $tokenConfirm = $this->tokenConfirm->createConfirmation($request);
                if (count($responseSkater) != 0) {
                    $data = [
                        //url dev
                        'url' => 'http://localhost:8000/api/activate-account',
                        //url prod
                        // 'url' => 'https://ghostflip.com.br:8082/api/activate-account',
                        'id' => $responseSkater['id'],
                        'email' => $tokenConfirm['email'],
                        'token' => $tokenConfirm['token']
                    ];
                    Mail::to($request->email)->send(new ConfirmAccount($data, 'Confirmar Cadastro'));
                    return response()->json(['msg' => 'Sucesso! Um e-mail foi enviado para o mesmo e-mail de cadastro, necessário confirmar cadastro para utilizar a plataforma'], 200);
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

    public function confirmAccountSkater(int $id, string $email, string $token): object
    {
        try {
            $responseToken = $this->tokenConfirm->getTokenByEmail($email, $token);
            if (count($responseToken) != 0) {
                $reponseActivateSkater = $this->skater->activateSkater($id);
                if ($reponseActivateSkater) {
                    return response()->json(['msg' => 'Conta ativada com sucesso!'], 200);
                }
                return $this->error('Erro ao ativar conta, tente novamente mais tarde!');
            }
            return $this->error('Confirmacao de conta não encontrada');
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
