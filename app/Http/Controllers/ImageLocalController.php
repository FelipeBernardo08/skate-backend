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
        $me = $this->auth->me();
        $responseImg = $this->image->createImageLocal($request, $id, $me[0]['skater'][0]['id']);
        if (count($responseImg) != 0) {
            return response()->json(['msg' => 'Dados criados com sucesso!'], 200);
        } else {
            return $this->error('Erro');
        }
    }

    public function deleteImage(int $id): object
    {
        $me = $this->auth->me();
        $responseImg = $this->image->deleteImage($id, $me[0]['skater'][0]['id']);
        if ($responseImg) {
            return response()->json(['msg' => 'Registro excluído com sucesso!'], 200);
        }
        return $this->error('erro ao excluir registro');
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
