<?php
// config.php

$servername = "localhost";
$username = ('root'); // Retrieve the username from an environment variable
$password = (''); // Retrieve the password from an environment variable
$dbname = "blendr_db"; // Add the database name here

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    // You might want to handle this error more gracefully in a production environment
}
?>
