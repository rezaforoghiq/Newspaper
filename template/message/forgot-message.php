<!DOCTYPE html>
<html lang="en">
<head>
    <title>forgot-message</title>
    <?php require_once(BASE_PATH . "/template/auth/layout/header-tag.php"); ?>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .auth-container {
            min-height: 100vh;
        }
        .left-section {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 1px solid #dee2e6;
        }
        .right-section {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
        }

        .font{
            font-size: 1.5rem;
        }

        .bottom-top-left{
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>

<body>

    <div class="container-fluid auth-container d-flex">
        <!-- Left: Logo -->
        <div class="col-md-6 left-section">
            <a href="<?= url("login") ?>" class="btn btn-primary btn-md bottom-top-left">Login</a>
            <div class="text-center">
                <h1 class="display-3 fw-bold text-primary">Newspaper</h1>
            </div>
        </div>

        <!-- Right: Message -->
        <div class="col-md-6 right-section">
            <a href="https://mail.google.com/" class="btn btn-primary btn-md btn-danger bottom-top-left">Gmail</a>
            <div class="text-center">
                <h2 class="text-success fw-bold display-3 mb-4">You succeeded.</h2>
                <p class="text-muted mb-4 font">
                    We have sent a link to your email to reset your password.
    </br>
                    please check your email.
                </p>
            </div>
        </div>
    </div>

    <?php require_once(BASE_PATH . "/template/auth/layout/footer-script.php"); ?>
