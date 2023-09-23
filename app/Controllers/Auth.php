<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class Auth extends BaseController
{       
    use ResponseTrait;

    private $userModel;

    public function __construct() {
        helper('auth_password');
        $this->userModel = new UserModel();
    }

    public function login(){

        try {

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->userModel->where('username',$username)->first();

            if(!$user) return $this->respond(["msg"=>'Datos Incorrectos']);

            if( !verifyPassword($password,$user['password'])) return $this->respond(["msg"=>'Datos Incorrectos']);

            $token = $this->generateJWT($user);

            return $this->respond([ "token" => $token ]);

        } catch (\Throwable $th) {
            return $this->failServerError('Error servidor');
        }

    }

    private function generateJWT($user){
        
        $key = env('SECRET_KEY');
        $timePayload = time();

        $payload = [
            'aud' => base_url(),
            'iat' => $timePayload,
            'exp' => $timePayload + 3600,
            'data' => [
                'uuid' => $user['id']
            ]
        ];

        $jwt = JWT::encode($payload,$key,'HS256');

        return $jwt;

    }
}
