<?php
  include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BeautyBlendr - Log in</title>
  <link rel="stylesheet" href="signupStyle.css">
  <link rel="icon" type="image/png" href="/src/logo.png">
</head>

<body>
<div class="container">
    <img src="/src/logo.png" alt="Your Logo" class="logo">
    <div class="welcome-text">
        <h2>Login</h2>
    </div>
    <form class="signup-form" action="loginProcess.php" method="POST">
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
        <p>Don't have an account? <a href="signupPage.php" class="sign-up-link">Sign Up</a></p>
    </form>
</div>
</body>
</html>
