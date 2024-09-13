<?php

namespace App\Http\Controllers;

use App\Models\likesLocal;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;


class LikesLocalController extends Controller
{
    private $likesLocal;
    private $auth;

    public function __construct(likesLocal $likes, AuthController $authController)
    {
        $this->likesLocal = $likes;
        $this->auth = $authController;
    }

    public function createLike(Request $request): object
    {
        $me = $this->auth->me();
        if ($me) {
            $responseLike = $this->likesLocal->createLike($request, $me[0]['skater'][0]['id']);
            if (count($responseLike) != 0) {
                return response()->json($responseLike, 200);
            }
            return $this->error('Registro não pode ser inserido. Tente novamente mais tarde!');
        } else {
            return $this->accessUnauthorized();
        }
    }

    public function removeLike(int $id): object
    {
        $me = $this->auth->me();
        $responseLike = $this->likesLocal->removeLike($id, $me[0]['skater'][0]['id']);
        if ($responseLike) {
            return response()->json(['msg' => 'Registro removido com sucesso!']);
        }
        return $this->error('Erro ao remover registro!');
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
