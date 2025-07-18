<?php

namespace Admin;

use database\DataBase;

class Banner extends Admin{

    public function index(){

        $db = new DataBase();

        $banners = $db->select("SELECT * FROM `banners`");
        require_once(BASE_PATH . "/template/admin/banner/index.php");

    }

    public function create(){

        require_once(BASE_PATH . "/template/admin/banner/create.php");

    }


    public function store($request){

        date_default_timezone_set("Iran");
        $db = new DataBase();
        $request["image"] = $this->saveImage($request["image"], "banner-image");

        $db->insert("banners", array_keys($request), $request);
        $this->redirect("admin/Banner");


    }


    public function edit($id){

        $db = new DataBase();
        $banner = $db->select("SELECT * FROM `banners` WHERE id = ?", [$id])->fetch();
        require_once(BASE_PATH . "/template/admin/banner/edit.php");
        
    }

    public function update($request, $id){
        
        date_default_timezone_set("Iran");
        $db = new DataBase();
        $banner = $db->select("SELECT * FROM `banners` WHERE id = ?", [$id])->fetch();
        if($request["image"]["tmp_name"] !== "" && $request["image"]["tmp_name"] !== null){

            $this->removeImage($banner["image"]);

            $request["image"] = $this->saveImage($request["image"], "banner-image");

        }else{

            unset($request["image"]);

        }

        $db->update("banners", $id, array_keys($request), $request);
        
        $this->redirect("admin/Banner");

    }


    public function delete($id){

        $db = new DataBase();
        $banner = $db->select("SELECT * FROM `banners` WHERE id = ?", [$id])->fetch();
        $this->removeImage($banner["image"]);

        $db->delete("banners", $id);
        $this->redirectBack();

    }


}