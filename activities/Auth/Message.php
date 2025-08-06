<?php

namespace Auth;

class Message{


    public function forgotMessage(){

        require_once(BASE_PATH . "/template/message/forgot-message.php");

    }



    public function resetMessage(){

        require_once(BASE_PATH . "/template/message/reset-message.php");

    }






}