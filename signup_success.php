<!DOCTYPE html>
<html>
<head>
  <title>BeautyBlendr - Sign Up Success</title>
  <link rel="stylesheet" href="signupStyle.css">
  <link rel="icon" type="image/png" href="/src/logo.png">
    <meta http-equiv="refresh" content="5;url=loginPage.php">
</head>
<body>
    <div class="container">
        <h2>Signup Successful!</h2>
        <p>You will be redirected to the login page shortly...</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'loginPage.php';
        }, 5000);
    </script>
</body>
</html>
