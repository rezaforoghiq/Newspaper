<?php

namespace Admin;

use Auth\Auth;

//Admin class for helper and rotin function for using in the admin classes

class Admin
{


    protected $currentDomain;
    protected $basePath;

    function __construct() //در اجرای متغیر های واجب همزمان با شروع استفاده از این کلاس در همه صفحلت بخش ادمین که از این کلاس ارث بری کردند
    {
        $auth = new Auth;
        $auth->checkAdmin();
        $this->currentDomain = CURRENT_DOMAIN;
        $this->basePath = BASE_PATH;

    }



    protected function redirect($url) //هدایت کاربر به آدرس دلخواه در پروژه
    {

        header("Location: " . trim($this->currentDomain, "/ ") . "/" . trim($url, "/ "));
        exit;

    }



    protected function redirectBack()//برگرداندن کاربر به آدرس قبلی
    {

        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;

    }



    protected function saveImage($image, $imagePath, $imageName = null) //ذخیره عکس
    {

        if ($imageName) {

            $extension = explode("/", $image["type"])[1];
            $imageName = $imageName . "." . $extension;

        } else {

            $extension = explode("/", $image["type"])[1];
            $imageName = date("Y_m_d_H_i_s") . "." . $extension;

        }

        $imageTemp = $image["tmp_name"];
        $imagePath = "public/" . $imagePath . "/";

        if (is_uploaded_file($imageTemp)) {

            if (move_uploaded_file($imageTemp, $imagePath . $imageName)) {

                return $imagePath . $imageName;

            } else {

                return false;

            }

        } else {
            return false;
        }

        // $imageUpload = move_uploaded_file($image);

    }


    protected function removeImage($url)  //پاک کردن عکس از دایرکتوری
    {

        $path = trim($url, "/ ");
        if (file_exists($path)) {

            unlink($path);
        }


    }

}