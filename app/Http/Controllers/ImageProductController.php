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
}
