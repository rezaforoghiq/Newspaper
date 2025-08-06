<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
<?php require_once(BASE_PATH . "/template/auth/layout/header-tag.php"); ?>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">


                <div style="margin-top: 100px;" class="ml-5 login100-pic js-tilt" data-tilt>
                     <!-- <img src="<?= asset("public/auth/assets/images/img-01.png") ?>" alt="IMG"> -->
                     <h1 class="text-dark display-4">Newspaper</h1>
                </div>

                <form method="post" action="<?= url("check-login") ?>" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Member Login
                    </span>
                    <?php

                    $msg = flash("login_error");
                    $msgReg = flash("login_error_notfound");

                     if(!empty($msg)){ ?>
                        <div class="mb-2 alert alert-danger"> <small class="form-text text-danger"></small><?= $msg ?></div>
                    <?php }elseif(!empty($msgReg)){ ?>
                        <div class="mb-2 alert alert-danger"> <small class="form-text text-danger"></small><?= $msgReg ?></div> 
                    <?php } ?>


                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="emailorusername" placeholder="Email Or Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="<?= url("forgot") ?>">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="<?= url("register") ?>">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if(!empty($msgReg)){ ?>
    <script>


        setTimeout(function() {
            window.location.href = "<?= url("register") ?>";
        }, 3000;


    </script>
    <?php } ?>

    <?php require_once(BASE_PATH . "/template/auth/layout/footer-script.php"); ?>