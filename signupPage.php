<?php
  include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BeautyBlendr - Sign Up</title>
  <link rel="stylesheet" href="signupStyle.css">
  <link rel="icon" type="image/png" href="/src/logo.png">
</head>

<body>
<div class="container">
    <img src="/src/logo.png" alt="Your Logo" class="logo">
    <div class="welcome-text">
        <h2>Join BeautyBlendr!</h2>
        <p>Create your account</p>
    </div>
    <form class="signup-form" action="signupProcess.php" method="POST">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">CONTINUE</button>
        <hr class="custom-line">
        <p>Already have an account? <a href="loginPage.php" class="sign-up-link">LOGIN HERE</a></p>
    </form>
</div>
</body>
</html>
