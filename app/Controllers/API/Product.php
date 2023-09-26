<?php

namespace App\Controllers\API;

use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;


class Product extends ResourceController
{

    public function __construct() {
        $this->model = $this->setModel(new ProductModel());
      
    }

    public function index()
    {   
        try {

            $limit = (  $this->request->getGet('limit') !== null && is_numeric($this->request->getGet('limit')) ) ?  $this->request->getGet('limit') :  0;
            $desde = (  $this->request->getGet('desde') !== null && is_numeric($this->request->getGet('desde')) ) ?  $this->request->getGet('desde') :  0;

            return $this->respond($this->model->findAll($limit,$desde));

        } catch (\Throwable $th) {

            return $this->failServerError('Error en el servidor');

        }
       
    }

    public function get($id=null)
    {   
        try {
           
            if(!$id) return $this->failValidationErrors( 'Id requerido' );

            $product = $this->model->find($id);

            if(!$product) return $this->failValidationErrors( "El producto con id $id no existe" );

            return $this->respond($product);
            
        } catch (\Throwable $th) {

            return $this->failServerError('Error en el servidor');

        }
       
    }

    public function create(){
        try{

            $product = $this->request->getJSON();
            $product->id_usuario = intval($this->request->id);

            if($this->model->insert($product)){
                $product->id = $this->model->insertID();
                return $this->respondCreated($product);
            }else{
                
                return $this->failValidationErrors( $this->model->validation->getErrors() );
            }
           


        } catch (\Throwable $th) {

           return $this->failServerError($th->getMessage());
        }
    }

    public function edit($id=null){
   
        try {
          
            if(!$id){
                return $this->failValidationErrors( 'Id requerido' );
            }

            $product = $this->model->find($id);

            if(!$product){
                return $this->failValidationErrors( "No se encontró un producto con id $id " );
            }

            $productUpdated = $this->request->getJSON();

            if($this->model->update($id,$productUpdated)){
                return $this->respondUpdated($productUpdated);
            }else{
                return $this->failValidationErrors( $this->model->validation->getErrors() );
            }
          

           
        } catch (\Throwable $th) {
            return $this->failServerError('Error en el servidor');
        }


    }

    public function delete($id=null){
   
        try {
          
            if(!$id){
                return $this->failValidationErrors( 'Id requerido' );
            }

            $product = $this->model->find($id);

            if(!$product){
                return $this->failValidationErrors( "No se encontró un producto con id $id " );
            }

            

            if($this->model->delete($id)){
                return $this->respondDeleted(["msg"=>"Producto con id $id borrado","ok"=>true]);
            }else{
                return $this->failValidationErrors( $this->model->validation->getErrors() );
            }
          

           
        } catch (\Throwable $th) {
            return $this->failServerError('Error en el servidor');
        }


    }

    public function search(){

        try {

            $q = $this->request->getGet('q');

            $products = $this->model
                ->like('nombre',$q)
                ->orLike('descripcion',$q)
                ->findAll();
    
            return $this->respond($products);

        } catch (\Throwable $th) {

            return $this->failServerError('Error server');
            
        }

      



    }

}
