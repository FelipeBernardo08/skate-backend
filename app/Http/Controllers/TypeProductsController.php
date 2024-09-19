<?php

namespace App\Http\Controllers;

use App\Models\typeProducts;
use Illuminate\Http\Request;

class TypeProductsController extends Controller
{
    private $type;

    public function __construct(typeProducts $types)
    {
        $this->type = $types;
    }

    public function getTypes(): object
    {
        $response = $this->type->getTypes();
        if (count($response) != 0) {
            return response()->json($response, 200);
        }
        return response()->json(['error' => 'Registros nao encontrados!'], 404);
    }
}
