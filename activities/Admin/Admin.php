<?php

namespace Admin;


class Admin
{


    protected $currentDomain;
    protected $basePath;

    function __construct()
    {

        $this->currentDomain = CURRENT_DOMAIN;
        $this->basePath = BASE_PATH;

    }



    protected function redirect($url)
    {

        header("Location: " . trim($this->currentDomain, "/ ") . "/" . trim($url, "/ "));
        exit;

    }



    protected function redirectBack()
    {

        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;

    }



    protected function saveImage($image, $imagePath, $imageName = null)
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


    protected function removeImage($url)
    {

        $path = trim($url, "/ ");
        if (file_exists($path)) {

            unlink($path);
        }


    }

}