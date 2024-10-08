<?php

namespace App\Http\Controllers;

use App\Models\imageProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;


class ImageProfileController extends Controller
{
    private $imageProfile;
    private $auth;

    public function __construct(AuthController $authController, imageProfile $image)
    {
        $this->imageProfile = $image;
        $this->auth = $authController;
    }

    public function createImageProfile(Request $request): object
    {
        $me = $this->auth->me();
        $responseImg = $this->imageProfile->createImageProfile($request, $me[0]['skater'][0]['id']);
        if (count($responseImg) != 0) {
            return response()->json($responseImg, 200);
        }
        return $this->error('Registro não pode ser criado!');
    }

    public function deleteImgTicket(int $id): object
    {
        $me = $this->auth->me();
        $responseImg = $this->imageProfile->deleteImgTicket($id, $me[0]['skater'][0]['id']);
        if ($responseImg) {
            return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
        }
        return $this->error('Registro nao pode ser deleatdo');
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
