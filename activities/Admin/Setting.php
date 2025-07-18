<?php

namespace Admin;

use database\DataBase;

class Setting extends Admin{

    public function index(){

        $db = new DataBase();

        $setting = $db->select("SELECT * FROM setting WHERE id = ?", [1])->fetch();
        require_once(BASE_PATH . "/template/admin/setting/index.php");

    }


    public function edit()
    {

        $db = new DataBase();
        $setting = $db->select("SELECT * FROM setting WHERE id = ?", [1])->fetch();
        require_once(BASE_PATH . "/template/admin/setting/edit.php");


    }


    public function update($request)
    {

        $db = new DataBase();


            if ($request["icon"]["tmp_name"] !== "" && $request["icon"]["tmp_name"] !== null) {

                
                $setting = $db->select("SELECT * FROM `setting` WHERE id = ?", [1])->fetch();
                $this->removeImage($setting["icon"]);

                $request["icon"] = $this->saveImage($request["icon"], "setting-image", "icon");

            } else {

                unset($request["icon"]);

            }

            if ($request["logo"]["tmp_name"] !== "" && $request["logo"]["tmp_name"] !== null) {

                $setting = $db->select("SELECT * FROM `setting` WHERE id = ?", [1])->fetch();
                $this->removeImage($setting["logo"]);
                

                $request["logo"] = $this->saveImage($request["logo"], "setting-image", "logo");


            } else {

                unset($request["logo"]);

            }

            $db->update("setting", 1, array_keys($request), $request);

            $this->redirect("admin/Setting");

        }

        

    }