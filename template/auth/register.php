<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
<?php require_once(BASE_PATH . "/template/auth/layout/header-tag.php"); ?>

<body>

    <div class="limiter">
        <div class="container-login100">

            
                
            <div class="wrap-login100">


                <div style="margin-top: 200px;" class="ml-5 login100-pic js-tilt" data-tilt>
                     <!-- <img src="<?= asset("public/auth/assets/images/img-01.png") ?>" alt="IMG"> -->
                     <h1 class="text-dark display-4">Newspaper</h1>
                </div>

                

                <form method="post" action="<?= url("register/store") ?>" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Register
                    </span>

                    <?php

                    $msg = flash("register_error");
                    $msgRedirect = flash("register_error_redirect");

                     if(!empty($msg)){ ?>
                        <div class="mb-2 alert alert-danger"> <small class="form-text text-danger"></small><?= $msg ?></div>
                    <?php }elseif(!empty($msgRedirect)){ ?>
                        <div class="mb-2 alert alert-danger"> <small class="form-text text-danger"></small><?= $msgRedirect ?></div> 
                    <?php } ?>


                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="first_name" placeholder="Firstname">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>


                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="last_name" placeholder="Lastname">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
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
                            Register
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
                        <a class="txt2" href="<?= url("login") ?>">
                            Login your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php if(!empty($msgRedirect)){ ?>
    <script>


        setTimeout(function() {
            window.location.href = "<?= url("login") ?>";
        }, 3000);


    </script>
<?php } ?>
<?php require_once(BASE_PATH . "/template/auth/layout/footer-script.php"); ?>
