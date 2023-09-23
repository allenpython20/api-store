<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class RoleFilter implements FilterInterface{

    private function getMessage($msg){
        return Services::response()
            ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
            ->setContentType('application/json')
            ->setBody(json_encode(['msgx'=>$msg]));
    }

    public function before(RequestInterface $request, $arguments = null){

        try {
           
            $roles = $arguments ?? [];

            if(!in_array('all',$roles)){
                if(!in_array($request->rol,$roles)){
                    return $this->getMessage("El rol '$request->rol' asignado asignado a su usuario no puede realizar esta acción");
                }
            }
          
            
           

        }catch (\Throwable $e) {
            return $this->getMessage($e->getMessage());
        }

    }

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }
}