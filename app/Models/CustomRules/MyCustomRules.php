<?php

namespace App\Models\CustomRules;

use App\Models\CategoryModel;
use App\Models\RolModel;
use App\Models\UserModel;

class MyCustomRules {

    function is_valid_category(int $id){

        $categoryModel = new CategoryModel();

        return $categoryModel->find($id) ? true : false;
        

    }

    function is_valid_user(int $id){

        $userModel = new UserModel();

        return $userModel->find($id) ? true : false;

    }

    function is_valid_rol(int $id){

        $rolModel = new RolModel();

        return $rolModel->find($id) ? true : false;

    }

}


?>

