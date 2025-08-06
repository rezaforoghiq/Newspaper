<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot-password</title>
<?php require_once(BASE_PATH . "/template/auth/layout/header-tag.php"); ?>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">


                <div style="margin-top: 100px;" class="ml-5 login100-pic js-tilt" data-tilt>
                     <!-- <img src="<?= asset("public/auth/assets/images/img-01.png") ?>" alt="IMG"> -->
                     <h1 class="text-dark display-4">Newspaper</h1>
                </div>

                <form method="post" action="<?= url("forgot-request") ?>" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Forgot Password
                    </span>

                    
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="email" placeholder="Please enter your email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            SEND
                        </button>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="<?= url("login") ?>">
                            Login your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once(BASE_PATH . "/template/auth/layout/footer-script.php"); ?>