<?php

namespace Admin;

use database\DataBase;

class Category extends Admin{

    public function index(){
        
        $db = new DataBase();
        $Categories = $db->select("SELECT * FROM `categories` ORDER BY id DESC;");
        require_once(BASE_PATH . "/template/admin/category/index.php");

    }

    public function create(){
        
        require_once(BASE_PATH . "/template/admin/category/create.php");

    }

    public function store($request){

        $db = new DataBase();
        $db->insert("categories", array_keys($request), $request);
        $this->redirect("admin/Category");

    }

    public function edit($id){

        $db = new DataBase();
        $category = $db->select("SELECT * FROM `categories` WHERE id = ?", [$id])->fetch();
        require_once(BASE_PATH . "/template/admin/category/edit.php");

    }

    public function update($request, $id){

        if(empty($request)){  

            $this->redirect("admin/Category");

        }
        else{

            $db = new DataBase();
            $db->update("categories", $id, array_keys($request), $request);
            $this->redirect("admin/Category");

        }

    


    }

    public function delete($id){
        
        $db = new DataBase();
        $db->delete("categories", $id);
        $this->redirect("admin/Category");

    }

}