<?php
// Include the database connection configuration file
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username already exists in the database
    $stmt = $conn->prepare("SELECT * FROM user_tb WHERE userName = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        // Username already exists, handle the error (you might want to redirect to signup page with an error message)
        header("Location: signup.php?error=existing_username");
        exit();
    } else {
        // Username is unique, proceed with inserting the new user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO user_tb (userName, userPassword) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        try {
            $stmt->execute();
            // User successfully added, redirect to the success page
            header("Location: signup_success.php");
            exit();
        } catch (PDOException $e) {
            // Handle database errors gracefully
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // If someone tries to access this script directly without POST data, redirect them to the signup page
    header("Location: signup.php");
    exit();
}
?>
