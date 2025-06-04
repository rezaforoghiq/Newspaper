<?php


namespace Admin;

class Admin {

    function __construct() {

        $this->currentDomain = CURRENT_DOMAIN;

        $this->basePath = BASE_PATH;

    }


    protected function redirect($url){

        // header('Location: '. trim($this->currentDomain, "/ ") . "/" . trim($url, "/ "));
        exit;

    }


    protected function redirectBack(){
        header("Location: ". $_SERVER["HTTP_REFERER"]);
        exit;
    }


}