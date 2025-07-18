<?php

namespace Admin;

use database\DataBase;

class Menu extends Admin{


    public function index(){

        $db = new DataBase();

        $menus = $db->select("SELECT m1.*, m2.name AS menu_name FROM menus m1 LEFT JOIN menus m2 ON m1.parent_id = m2.id ORDER BY id DESC")->fetchAll();

        require_once(BASE_PATH . "/template/admin/menu/index.php");

    }

    public function create(){

        $db = new DataBase();
        
        $menus = $db->select("SELECT * FROM menus WHERE parent_id IS NULL ORDER BY id DESC")->fetchAll();

        require_once(BASE_PATH . "/template/admin/menu/create.php");


    }


    public function store($request){

        $db = new DataBase();
        $db->insert("menus", array_keys(array_filter($request)), array_filter($request));
        $this->redirect("admin/Menu");


    }


    public function edit($id){

        $db = new DataBase();
        $menu = $db->select("SELECT * FROM `menus` WHERE id = ?", [$id])->fetch();
        $parentMenus = $db->select("SELECT * FROM menus WHERE parent_id IS NULL ORDER BY id DESC")->fetchAll();
        require_once(BASE_PATH . "/template/admin/menu/edit.php");

    }

    public function update($request, $id){

        $db = new DataBase();

            $db->update("menus", $id, array_keys($request), $request);

        
        // dd("hi");
        $this->redirect("admin/Menu");
        


    }


    public function show($id){

        $db = new DataBase();

        $menu = $db->select("SELECT m1.*, m2.name AS menu_name FROM menus m1 LEFT JOIN menus m2 ON m1.parent_id = m2.id WHERE m1.id = ?", [$id])->fetch();
        require_once(BASE_PATH . "/template/admin/menu/show.php");
        

    }


    
    public function delete($id){

        $db = new DataBase();
        $db->delete("menus", $id);
        $this->redirectBack();

    }


}