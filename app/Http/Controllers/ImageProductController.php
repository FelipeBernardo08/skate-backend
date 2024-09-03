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

    public function createImageProduct(Request $request, int $id)
    {
        $data = $request->input('data');
        if (count($data) != 0) {
            foreach ($data as $img) {
                $this->imageProduct->createImageProduct($img, $id);
            }
            return response()->json(['msg' => 'Imagens adicionadas com sucesso!'], 200);
        } else {
            return response()->json(['error' => 'Erro ao criar registro!'], 404);
        }
    }
}
