<!DOCTYPE html>
<html lang="en">

<head>
    <title>reset password</title>
    <?php require_once(BASE_PATH ."/template/auth/layout/header-tag.php"); ?>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div style="margin-top: 120px;" class="ml-5 login100-pic js-tilt" data-tilt>
                    <!-- <img src="assets/images/img-01.png" alt=" IMG"> -->
                    <h1 class="text-dark display-4">Newspaper</h1>
                </div>

                <form method="post" action="<?= url("reset-password/change/". $user["id"]) ?>" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Reset Password
                    </span>
            
                    <?php
                    $message = flash("reset_message");
                    if(!empty($message)){ ?>
                    <div class="mb-2 alert alert-danger"> <small class="form-text text-danger"><?= $message ?></small> </div>
                    <?php } ?>



                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password_confirm" placeholder="Confirm Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Send
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="#">
                            Login your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php require_once(BASE_PATH ."/template/auth/layout/footer-script.php"); ?>