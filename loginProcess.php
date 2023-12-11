<?php
session_start();
require_once "config.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM user_tb WHERE userName = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['userPassword'])) {
        // Password verification successful, create session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_username'] = $user['userName'];
        $_SESSION['user_role'] = $user['userRole']; // Store the user's role in the session

        if ($_SESSION['user_role'] === 'admin') {
            // Redirect to the admin dashboard if the user is an admin
            header("Location: adminDashboard.php");
            exit();
        } else {
            // Redirect to the regular user page if the user is not an admin
            header("Location: index.php");
            exit();
        }
    } else {
        // Invalid username or password, redirect back to the login page with an error message
        header("Location: loginPage.php?error=invalid_credentials");
        exit();
    }
} else {
    // If someone tries to access this script directly without POST data, redirect them to the login page
    header("Location: loginPage.php");
    exit();
}

?>