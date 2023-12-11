<?php
session_start();

if (!isset($_SESSION['user_username'])) {
    // Redirect to login if user is not logged in
    header("Location: loginPage.php");
    exit();
}

// Check if the user is an admin
if ($_SESSION['user_role'] !== 'admin') {
    // Redirect to a non-admin page or display an error message
    header("Location: index.php");
    exit();
}

require_once "config.php";

$stmt = $conn->query("SELECT id, productName, productSpecification, productPrice FROM products_tb");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BeautyBlendr - Admin</title>
  <link rel="stylesheet" href="dashboardStyle.css">
  <link rel="icon" type="image/png" href="src/logo.png">
</head>
<body>
<div class="navbar">
    <img src="src/logo.png" alt="Logo" class="logo">
    <span class="site-name">Admin Dashboard</span>
    <ul class="nav-links">
        <li><a href="terminateSession.php" class="sign-in-link">Sign Out</a></li>
    </ul>
</div>

<div class="container">
    <form method="post" enctype="multipart/form-data" action="adminProcess.php">
        <h1>Add Product</h1>
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required><br><br>

        <label for="productSpecification">Product Specification:</label>
        <textarea id="productSpecification" name="productSpecification" required></textarea><br><br>

        <label for="productPrice">Product Price:</label>
        <input type="number" id="productPrice" name="productPrice" required><br><br>

        <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="lipstick">Lipstick</option>
            <option value="foundation">Foundation</option>
            <!-- Add more options for different categories -->
        </select><br><br>

        <label for="imageProduct">Image:</label>
        <input type="file" id="imageProduct" name="imageProduct"><br><br>
        <input type="submit" value="Add Product">
    </form>
</div>

<div class="container">
    <h1>Products List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Specification</th>
                <th>Product Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['productName']; ?></td>
                    <td><?php echo $product['productSpecification']; ?></td>
                    <td><?php echo $product['productPrice']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="container">
    <form method="post" action="deleteProduct.php">
        <h1>Delete Product</h1>
        <label for="productId">Product ID:</label>
        <input type="text" id="productId" name="productId" required><br><br>
        <input type="submit" value="Delete Product">
    </form>
</div>


</body>
</html>