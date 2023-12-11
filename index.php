<?php
session_start();

// Check if the user is not logged in (session variable not set)
if (!isset($_SESSION['user_username'])) {
    // Redirect to the login page
    header("Location: loginPage.php");
    exit();
}
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BeautyBlendr - Home</title>
  <link rel="stylesheet" href="indexStyle.css">
  <link rel="icon" type="image/png" href="src/logo.png">
</head>
<body>

<div class="navbar">
        <img src="src/logo.png" alt="Logo" class="logo">
        <span class="site-name">BeautyBlendr</span>

    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="productPage.php">Products</a></li>
        <li><a href="terminateSession.php" class="sign-in-link">Sign Out</a></li>
    </ul>
</div>

<div class="main-content">
    <section class="welcome-section">
        <h1>Welcome to BeautyBlendr!</h1>
        <p>Your ultimate destination for top-quality makeup and lipstick collections. Discover a wide array of beauty products handpicked just for you. Whether you're looking for vibrant lipsticks or premium makeup essentials, we've got you covered. Join our community and elevate your beauty routine!</p>
    </section>

    <!-- Rest of your content goes here -->
</div>

<!-- Add more content here -->

</body>
</html>
