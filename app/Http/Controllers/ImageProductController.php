<?php

namespace App\Http\Controllers;

use App\Models\imageProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class ImageProductController extends Controller
{
    private $imageProduct;
    private $auth;

    public function __construct(imageProduct $image, AuthController $authController)
    {
        $this->imageProduct = $image;
        $this->auth = $authController;
    }

    public function createImageProduct(Request $request, int $id): object
    {
        $me = $this->auth->me();
        $responseImg = $this->imageProduct->createImageProduct($request, $id, $me[0]['skater'][0]['id']);
        if (count($responseImg) != 0) {
            return response()->json(['msg' => 'Dados criados com sucesso!'], 200);
        } else {
            return $this->error('Erro');
        }
    }

    public function deleteImage(int $id): object
    {
        $me = $this->auth->me();
        $responseImg = $this->imageProduct->deleteImgProduct($id, $me[0]['skater'][0]['id']);
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
