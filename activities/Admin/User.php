<?php

namespace Admin;

use database\DataBase;

class User extends Admin{


    public function index(){
        
        $db = new DataBase();
        $users = $db->select("SELECT * FROM `users` ORDER BY id DESC")->fetchAll();
        require_once(BASE_PATH . "/template/admin/user/index.php");


    }


    public function create(){

        require_once(BASE_PATH . "/template/admin/user/create.php");

    }


    public function store($request){

        $db = new DataBase();
        $db->insert("users", array_keys($request), $request);
        $this->redirect("admin/User");
        

    }


    public function edit($id){

        $db = new DataBase();
        $user = $db->select("SELECT * FROM `users` WHERE id = ?", [$id])->fetch();
        require_once(BASE_PATH . "/template/admin/user/edit.php");

    }

    public function update($request, $id){

        $db = new DataBase();
        $db->update("users", $id, array_keys($request), $request);
        $this->redirect("admin/User");


    }


    public function permission($id){
        
        $db = new DataBase();
        $user = $db->select("SELECT * FROM `users` WHERE id = ?", [$id])->fetch();

        if($user){

            if($user["permission"] == "user"){

                $db->update("users", $id, ["permission"], ["permission" => "admin"]);

            }
            elseif($user["permission"] == "admin"){

                $db->update("users", $id, ["permission"], ["permission" => "user"]);

            }

        }
        
        $this->redirectBack();

    }

    public function delete($id){

        $db = new DataBase();
        $db->delete("users", $id);
        $this->redirectBack();

    }
    
}