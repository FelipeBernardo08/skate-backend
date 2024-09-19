<?php

namespace App\Http\Controllers;

use App\Models\subtypeProducts;
use Illuminate\Http\Request;

class SubtypeProductsController extends Controller
{
    private $subType;

    public function __construct(subtypeProducts $sub)
    {
        $this->subType = $sub;
    }

    public function getSubtype(string $type): object
    {
        $result = $this->subType->getSubtype($type);
        if (count($result) != 0) {
            return response()->json($result, 200);
        }
        return response()->json(['error', 'Erro ao recuperar resgistros!'], 404);
    }
}
