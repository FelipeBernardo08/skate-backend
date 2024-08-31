<?php

namespace App\Http\Controllers;

use App\Models\skater;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class SkaterController extends Controller
{
    private $skater;
    private $user;

    public function __construct(skater $skate, User $users)
    {
        $this->skater = $skate;
        $this->user = $users;
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

    public function error($error): object
    {
        return response()->json(['Error' => $error], 404);
    }

    public function accessUnauthorized()
    {
        return response()->json(['Error' => 'Não autorizado!'], 401);
    }
}
