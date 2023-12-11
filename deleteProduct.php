<?php
session_start();

if (!isset($_SESSION['user_username'])) {
    // Redirect to login if user is not logged in
    header("Location: loginPage.php");
    exit();
}

if ($_SESSION['user_role'] !== 'admin') {
    // Redirect to a non-admin page or display an error message
    header("Location: index.php");
    exit();
}

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['productId'])) {
        $productId = $_POST['productId'];

        // Prepare and execute a query to delete the product based on the ID
        $stmt = $conn->prepare("DELETE FROM products_tb WHERE id = :productId");
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
             // Product added successfully message
             $successMessage = "Product deleted successfully!";
            // Redirect or perform further actions after deletion
            echo '<meta http-equiv="refresh" content="2;url=adminDashboard.php">';
            echo "<p>{$successMessage}</p>";

        } else {
            echo "Failed to delete product.";
        }
    }
}
?>
