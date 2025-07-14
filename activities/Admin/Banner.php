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

        $db = new DataBase();
        $request["image"] = $this->saveImage($request["image"], "banner-image");

        $db->insert("banners", array_keys($request), $request);
        $this->redirect("admin/Banner");

    }


}