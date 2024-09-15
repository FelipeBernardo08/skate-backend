<?php

namespace App\Http\Controllers;

use App\Models\comentsLocal;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;


class ComentsLocalController extends Controller
{
    private $comentsLocal;
    private $auth;

    public function __construct(comentsLocal $coments, AuthController $authController)
    {
        $this->comentsLocal = $coments;
        $this->auth = $authController;
    }

    public function createCommentLocal(Request $request): object
    {
        $me = $this->auth->me();
        $resultCommentLocal = $this->comentsLocal->createComment($request, $me[0]['skater'][0]['id']);
        if (count($resultCommentLocal) != 0) {
            return response()->json($resultCommentLocal, 200);
        }
        return $this->error('Erro ao criar registro!');
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
