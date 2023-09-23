<?php

namespace App\Filters;

use App\Models\RolModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use UnexpectedValueException;

class AuthFilter implements FilterInterface{

    private function getMessage($msg){
        return Services::response()
        ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
        ->setContentType('application/json')
        ->setBody(json_encode(['msg'=>$msg]));
    }

    public function before(RequestInterface $request, $arguments = null){

        try {
           
            $key = env('SECRET_KEY');

            $authHeader = $request->getServer('HTTP_AUTHORIZATION');
            // $customTokenHeader = $_SERVER['HTTP_X_TOKEN'] ?? null;

            if(!$authHeader) return $this->getMessage('No Token');

            $arr = explode(' ',$authHeader);

            $jwt = $arr[1];

            $jwt = JWT::decode($jwt,new key($key,'HS256'));

            $userModel = new UserModel();

            $verifyUser = $userModel->find($jwt->data->uuid);

            if(!$verifyUser)  return $this->getMessage('Usuario sin permisos');

            $rolModel = new RolModel();

            $verifyRol = $rolModel->find($verifyUser['id_rol']);

            if(!$verifyRol) return $this->getMessage('Usuario sin rol');
            
            $request->rol = $verifyRol['nombre'];
            $request->id = $verifyUser['id'];

            // return Services::response()
            //     ->setContentType('application/json')
            //     ->setBody(json_encode(['msg'=> $request->rol   ]));

        }catch(UnexpectedValueException $e){
            return $this->getMessage($e->getMessage());

        }catch(ExpiredException $e){
            return $this->getMessage('Token vencido');
   
        }  catch (\Exception $th) {
            return $this->getMessage('Error server');
          
        }catch (\Throwable $e) {
            return $this->getMessage($e->getMessage());
        
        }

    }

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }
}