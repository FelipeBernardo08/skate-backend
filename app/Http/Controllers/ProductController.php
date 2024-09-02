<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class ProductController extends Controller
{
    private $product;
    private $auth;

    public function __construct(product $products, AuthController $authController)
    {
        $this->product = $products;
        $this->auth = $authController;
    }

    public function readProducts(): object
    {
        $resultProducts = $this->product->readProducts();
        if (count($resultProducts) != 0) {
            return response()->json($resultProducts, 200);
        }
        return $this->error('Registros não foram encontrados!');
    }

    public function readProductId(int $id): object
    {
        $resultProducts = $this->product->readProductId($id);
        if (count($resultProducts) != 0) {
            return response()->json($resultProducts, 200);
        }
        return $this->error('Registro não pode ser encontrado!');
    }

    public function readOwnProducts(): object
    {
        $me = $this->auth->me();
        $resultProducts = $this->product->readOwnProducts($me[0]['skater'][0]['id']);
        if (count($resultProducts) != 0) {
            return response()->json($resultProducts, 200);
        }
        return $this->error('Registros não foram encontrados!');
    }

    public function createProduct(Request $request): object
    {
        $me = $this->auth->me();
        $resultProducts = $this->product->createProduct($request, $me[0]['skater'][0]['id']);
        if (count($resultProducts) != 0) {
            return response()->json($resultProducts, 200);
        }
        return $this->error('Registro não pode ser criado!');
    }

    public function updateProduct(Request $request, int $id): object
    {
        $me = $this->auth->me();
        $resultProducts = $this->product->updateProduct($request, $id, $me[0]['skater'][0]['id']);
        if ($resultProducts) {
            return response()->json(['msg' => 'Registro atualizado com sucesso!'], 200);
        }
        return $this->error('Registros não foram atualizados!');
    }

    public function desactiveProduct(int $id): object
    {
        $me = $this->auth->me();
        $resultProducts = $this->product->desactiveProduct($id, $me[0]['skater'][0]['id']);
        if ($resultProducts) {
            return response()->json(['msg' => 'Registro desativado com sucesso!'], 200);
        }
        return $this->error('Registros não pode ser desativado!');
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
