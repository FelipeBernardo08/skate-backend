<?php

namespace App\Http\Controllers;

use App\Models\imageLocal;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;


class ImageLocalController extends Controller
{
    private $image;
    private $auth;

    public function __construct(AuthController $authController, imageLocal $img)
    {
        $this->image = $img;
        $this->auth = $authController;
    }

    public function createImageLocal(Request $request, int $id): object
    {
        $responseImg = $this->image->createImageLocal($request, $id);
        if (count($responseImg) != 0) {
            return response()->json(['msg' => 'Dados criados com sucesso!'], 200);
        } else {
            return $this->error('Erro');
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
