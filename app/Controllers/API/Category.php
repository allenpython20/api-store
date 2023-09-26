<?php

namespace App\Controllers\API;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;


class Category extends ResourceController{



    public function __construct(){

        $this->model = $this->setModel(new CategoryModel());
        
    }

    public function index(){
        try {
           
            $categories = $this->model->findAll();

            return $this->respond($categories);

        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }
    }

    public function get($id=null){
        try {
           
            if(!$id) return $this->failValidationErrors( 'Id requerido' );

            $category = $this->model->find($id);

            if(!$category) return $this->failValidationErrors( "La categoría  con id $id no existe" );

            return $this->respond($category);
            
        } catch (\Throwable $th) {

            return $this->failServerError($th->getMessage());

        }
    }

    public function create(){

        try {
            
            $category = $this->request->getJSON();
            $category->id_usuario = $this->request->id;

            if($this->model->insert($category)){
                $category->id = $this->model->insertId();
                return $this->respondCreated($category);
            }else{
                return $this->failValidationErrors($this->model->validation->getErrors());
            }

        } catch (\Throwable $th) {
           return $this->failServerError($th->getMessage());
        }

    }


    public function edit($id=null){

        try {

            if(!$id) return $this->failValidationErrors('Id necesario');

            $category = $this->model->find($id);

            if(!$category) return $this->failValidationErrors("No existe una categoría con id $id ");

            $categoryUpdate = $this->request->getJSON();

            if($this->model->update($id,$categoryUpdate)){
                $category = $this->model->find($id);
                return $this->respondUpdated($category);
            }else{
                return $this->failValidationErrors($this->model->validation->getErrors());
            }

        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }

    }

    public function delete($id=null){
        try {

            if(!$id) return $this->failValidationErrors('Id necesario');

            $category = $this->model->find($id);

            if(!$category) return $this->failValidationErrors("No existe una categoría con id $id ");

            //validar que no existan productos con esa categoría

            $productModel = new ProductModel();

            if( $productModel->where('id_categoria', $id)->countAllResults() > 0)  
                return $this->respond(["msg" => "No puede eliminar una categoría con productos asignados"]);


            if($this->model->delete($id)){
              
                return $this->respondDeleted(["msg" => "La categoría con id $id fue eliminada"]);
                
            }else{
                return $this->failValidationErrors($this->model->validation->getErrors());
            }

        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }
    }

    public function searchProducts($id=null){

        try {

            if(!$id) return $this->failValidationErrors('Id necesario');

            $category = $this->model->find($id);

            if(!$category) return $this->failValidationErrors("No existe una categoría con id $id ");

            $productModel = new ProductModel();

            //comprobar query params

            $products = $productModel->where('id_categoria',$id)->findAll();

            return $this->respond($products);
        
        } catch (\Throwable $th) {
            return $this->failServerError($th->getMessage());
        }

    }



}