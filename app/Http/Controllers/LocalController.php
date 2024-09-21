<?php

namespace App\Http\Controllers;

use App\Models\local;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class LocalController extends Controller
{
    private $local;
    private $auth;

    public function __construct(local $locals, AuthController $authController)
    {
        $this->local = $locals;
        $this->auth = $authController;
    }

    public function readLocals(): object
    {
        $responseLocal = $this->local->readLocals();
        if (count($responseLocal) != 0) {
            return response()->json($responseLocal, 200);
        }
        return $this->error('Nenhum registro encontrado!');
    }

    public function readLocalId(int $id): object
    {
        $responseLocal = $this->local->readLocalId($id);
        if (count($responseLocal) != 0) {
            return response()->json($responseLocal, 200);
        }
        return $this->error('Nenhum registro encontrado!');
    }

    public function readLocalBySkaterId(): object
    {
        $me = $this->auth->me();
        $responseLocal = $this->local->readLocalBySkaterId($me[0]['skater'][0]['id']);
        if (count($responseLocal) != 0) {
            return response()->json($responseLocal, 200);
        }
        return $this->error('Registros não encontrados!');
    }

    public function createLocal(Request $request): object
    {
        $me = $this->auth->me();
        $responseLocal = $this->local->createLocal($request, $me[0]['skater'][0]['id']);
        if (count($responseLocal) != 0) {
            return response()->json($responseLocal, 200);
        }
        return $this->error('Registro não pode ser criado!');
    }

    public function updateLocal(Request $request, int $id): object
    {
        $me = $this->auth->me();
        $responseLocal = $this->local->updateLocal($request, $id, $me[0]['skater'][0]['id']);
        if ($responseLocal) {
            return response()->json(['msg' => 'Registro atualizado com sucesso!'], 200);
        }
        return $this->error('Registro não pode ser atualizado!');
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
