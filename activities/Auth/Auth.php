<?php

namespace Auth;

use database\DataBase;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use RecursiveDirectoryIterator;



class Auth
{

    protected function redirect($url, $delay = 0)
    {
        if ($delay > 0) {
            $send = "<meta http-equiv='refresh' content='{" . $delay . "};url={" . trim(CURRENT_DOMAIN, "/ ") . "/" . trim($url, "/ ") . "}'>";
            return $send;
        } else {
            header("Location: " . trim(CURRENT_DOMAIN, "/ ") . "/" . trim($url, "/ "));
            exit;
        }
    }


    protected function redirectBack()
    {

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;

    }

    private function hash($password)
    {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        return $passwordHash;

    }

    private function random()
    {

        return bin2hex(openssl_random_pseudo_bytes(32));

    }


    public function activationMessage($name, $verifyToken, $route)
    {
        ob_start();
        require_once(BASE_PATH . "/template/auth/".$route.".php");
        return ob_get_clean();

    }

   





    public function sendMailer($emailAddres, $receverName = null, $subject, $body)
    {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->setLanguage("fa", BASE_PATH . "/lib/PHPMailer/PHPMailer/language/");
        //To load the French version

        try {
            //Server settings
            $mail->SMTPDebug = 0;         //SMTP::DEBUG_SERVER                  //Enable verbose debug output
            $mail->CharSet = "UTF-8";                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = MAIL_HOST;           //Set the SMTP server to send through
            $mail->SMTPAuth = SMTP_AUTH;                                   //Enable SMTP authentication
            $mail->Username = MAIL_USERNAME;                     //SMTP username
            $mail->Password = MAIL_PASSWORD;                               //SMTP password
            $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
            $mail->Port = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(SENDER_MAIL, SENDER_NAME);
            $mail->addAddress($emailAddres, $receverName);   //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

    }


    //start authinication
    public function register()
    {

        require_once(BASE_PATH . "/template/auth/register.php");

    }


    public function registerStore($request)
    {


        if (empty($request["email"]) || empty($request["username"]) || empty($request["password"]) || empty($request["first_name"]) || empty($request["last_name"])) {
            flash("register_error", "All field are required");
            $this->redirectBack();

        } elseif (strlen($request["password"]) < 8) {

            flash("register_error", "Your password can`t less than 8 character");
            $this->redirectBack();


        } elseif (!filter_var($request["email"], FILTER_VALIDATE_EMAIL)) {
            flash("register_error", "Your email is invalidate");
            $this->redirectBack();

        } else {

            $db = new DataBase();
            $user = $db->select("SELECT * FROM users WHERE email = ? OR username = ?", [$request["email"], $request["username"]])->fetch();

            if ($user != null) {
                flash("register_error_redirect", "User is repetitive");
                $this->redirectBack();
            } else {

                $randomToken = $this->random();
                $activationMessage = $this->activationMessage($request["first_name"], $randomToken, "body-mail");
                $result = $this->sendMailer($request["email"], $request["first_name"], "لینک فعالسازی ایمیل", $activationMessage);
                if ($result) {

                    $request["password"] = $this->hash($request["password"]);
                    $request["verify_token"] = $randomToken;
                    $db->insert("users", array_keys($request), $request);
                    flash("register_success", "Registeration is successfuly");
                    $this->redirect("login");
                } else {

                    flash("register_error", "Error sending the email");
                    $this->redirectBack();

                }

            }

        }

    }



    public function activation($verify_token){
        
        $db = new DataBase();
        $user = $db->select("SELECT * FROM users WHERE verify_token = ? AND is_active = 0", [$verify_token])->fetch();

        if($user == null){
            
            $this->redirectBack();

        }else{

            $db->update("users", $user["id"], ["is_active"], ["is_active" => "1"]);
            $this->redirect("login");

        }

    }


    public function login(){

        require_once(BASE_PATH . "/template/auth/login.php");

    }


    public function checkLogin($request){

        $db = new DataBase();

        if(empty($request["emailorusername"]) || empty($request["password"])){

            flash("login_error", "All field are required");
            $this->redirectBack();

        }else{
            
            $db = new DataBase();
            $user = $db->select("SELECT * FROM users WHERE email = ? OR username = ?", [$request["emailorusername"], $request["emailorusername"]])->fetch();
            

            if($user == null){

                flash("login_error_notfound", "User not found, Please register");
                $this->redirectBack();


            }else{

                if($user["is_active"] == 0){

                    flash("login_error", "Your account is not active");
                    $this->redirectBack();
    
                }elseif(password_verify($request["password"], $user["password"])){

                    $_SESSION["user"] = $user["id"];
                    $this->redirect("Home");

                }else{

                    flash("login_error", "Password is invalied");
                    $this->redirectBack();

                }

            }
        }

    }


    public function checkAdmin(){

        if(isset($_SESSION["user"])){

            $db = new DataBase();
            $user = $db->select("SELECT * FROM users WHERE id = ?;", [$_SESSION["user"]])->fetch();

            if($user != null){

                if($user["permission"] != "admin"){

                    $this->redirect("Home");

                }

            }else{

                $this->redirect("Home");

            }

        }else{

            $this->redirect("Home");

        }

    }



    public function logout(){

        if(isset($_SESSION["user"])){

            unset($_SESSION["user"]);
            session_destroy();

        }

        $this->redirect("Home");

    }


    
    public function forgot(){

        require_once(BASE_PATH . "/template/auth/forgot.php");

    }


    public function forgotRequest($request){

        if(empty($request["email"])){

            flash("forgot_error", "Email field is required");
            $this->redirectBack();

        }else if(!filter_var($request["email"], FILTER_VALIDATE_EMAIL)){

            flash("forgot_error", "Email is invalidate");
            $this->redirectBack();

        }else{

            $db = new DataBase();
            $user = $db->select("SELECT * FROM users WHERE email = ?", [$request["email"]])->fetch();

            if($user == null){

                flash("forgot_error", "User not found");
                $this->redirectBack();

            }else{

                $forgotToken = $this->random();
                $forgotMessage = $this->activationMessage($user["first_name"], $forgotToken, "body-mail-forgot");
                $result = $this->sendMailer($user["email"], $user["first_name"], "لینک بازیابی رمز عبور", $forgotMessage);

                if($result){

                    date_default_timezone_set("Asia/Tehran");
                    $db->update("users", $user["id"], ["forgot_token", "forgot_token_expire"], ["forgot_token" => $forgotToken, "forgot_token_expire" => date("Y-m-d H:i:s", strtotime("+15 minutes"))]);
                    $this->redirect("forgot-message");

                }
                

            }
        }

    }


    public function resetPassword($forgot_token){

        $db = new DataBase();
        $user = $db->select("SELECT * FROM users WHERE forgot_token = ?", [$forgot_token])->fetch();

        date_default_timezone_set("Asia/Tehran");
        if($user == null){

            flash("forgot_error", "User not found");
            $this->redirectBack();

        }else if($user["forgot_token_expire"] < date("Y-m-d H:i:s")){

            flash("forgot_error", "Token is expired");
            $this->redirectBack();

        }else{

            require_once(BASE_PATH . "/template/auth/reset-password-form.php");

        }

    }


    public function resetPasswordRequest($request, $id){

        if(empty($request["password"]) || empty($request["password_confirm"])){

            flash("reset_error" ,"All filde is required");
            $this->redirectBack();
        }else{

            if($request["password"] == $request["password_confirm"]){


                $password = $this->hash($request["password"]);
                $db = new DataBase();
                $db->update("users", $id, ["password"], ["password" => $password]);
                $this->redirect("reset-message");
                
                

            }else{

                flash("reset_error", "Your password does not match");
                $this->redirectBack();

            }

        }

    }

}