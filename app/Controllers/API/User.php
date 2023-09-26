<?php

namespace App\Controllers\API;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;


class User extends ResourceController{

    public function __construct() {
        $this->model = $this->setModel(new UserModel());
        helper('auth_password');
    }

    public function index(){

        try {
            $users = $this->model->findAll();
            return $this->respond($users);
        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }

    }

    public function create(){

        try {
          
            $user = $this->request->getJSON();

            //validar la contraseña antes de insertar
            $this->verifyPasswordUser($user);

            if($this->model->insert($user)){
                $id = $this->model->insertID();
                $user = $this->model->find($id);
                return $this->respondCreated($user);
            }else{
                return $this->failValidationErrors($this->model->validation->getErrors());
            }


        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }

    }

    public function edit($id=null){

        try {
          
            if(!$id) return $this->failValidationErrors('Id requerido');

            $user= $this->model->find($id);

            if(!$user) return $this->failValidationErrors( "El usuario con id $id no existe" );

            $userUpdate = $this->request->getJSON();
            $userUpdate->id = $id;

            //validar la contraseña antes de insertar
            $this->verifyPasswordUser($userUpdate);

            if($this->model->update($id,$userUpdate)){
                $user = $this->model->find($id);
                unset($user['password']);
                return $this->respondUpdated($user);
            }else{
                return $this->failValidationErrors($this->model->validation->getErrors());
            }


        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }


    }

    private function verifyPasswordUser($user){

        $isValid = $this->model->validate((array)$user);

        if (!$isValid) {
            return $this->failValidationErrors($this->model->validation->getErrors());
        }

        $password = hashPassword($user->password);
        $user->password = $password;
     
    }


}