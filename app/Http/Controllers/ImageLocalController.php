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

    public function createImageLocal(Request $request): object
    {
        $me = $this->auth->me();
        $responseImg = $this->image->createImageLocal($request);
        if ($responseImg) {
            return response()->json(['msg' => 'Dados criados com sucesso!'], 200);
        } else {
            return $this->error('Dados não foram criados!');
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
