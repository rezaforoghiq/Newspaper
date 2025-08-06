<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password</title>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .email-wrapper {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    .header {
      text-align: center;
      margin-bottom: 30px;
    }
    .header h1 {
      color: #0d6efd;
      font-size: 32px;
      margin: 0;
    }
    .content p {
      font-size: 16px;
      color: #212529;
      line-height: 1.6;
    }
    .reset-button {
      display: inline-block;
      background-color: #0d6efd;
      color: white;
      padding: 12px 24px;
      margin: 20px 0;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .footer {
      font-size: 14px;
      color: #6c757d;
      text-align: center;
      margin-top: 30px;
    }
    @media (max-width: 600px) {
      .email-wrapper {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="header">
      <h1>Newspaper</h1>
    </div>
    <div class="content">
      <p>Hello <?= $name ?>,</p>
      <p>You recently requested to reset your password for your Newspaper account.</p>
      <p>Click the button below to reset it:</p>
      <p style="text-align: center;">
        <a href="<?= url("reset-password/". $verifyToken) ?>" class="reset-button">Reset Password</a>
      </p>
      <p>If you didn’t request a password reset, you can ignore this email.</p>
      <p>This link will expire in 60 minutes for your security.</p>
    </div>
    <div class="footer">
      &copy; <?= date('Y') ?> Newspaper. All rights reserved.
    </div>
  </div>
</body>
</html>
