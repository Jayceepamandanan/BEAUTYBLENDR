<?php
session_start();

// Include your database connection file (config.php)
require_once "config.php";

// Check if the user is not logged in (session variable not set)
if (!isset($_SESSION['user_username'])) {
    // Redirect to the login page
    header("Location: loginPage.php");
    exit();
}

// Default SQL query to retrieve all products
$sql = "SELECT productName, productSpecification, productPrice, imageProduct FROM products_tb";

// Check if a specific category is selected (retrieve from form or URL parameter)
if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    // Modify the SQL query to filter by the selected category
    $sql .= " WHERE category = :selectedCategory"; // Replace 'category' with your actual column name
}

// Prepare and execute the SQL query
$stmt = $conn->prepare($sql);

if (isset($selectedCategory)) {
    $stmt->bindParam(':selectedCategory', $selectedCategory);
}

$stmt->execute();

// Fetch the products
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BeautyBlendr - Products</title>
    <link rel="stylesheet" href="productStyle.css">
    <link rel="icon" type="image/png" href="src/logo.png">
    <style>
        .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
}

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background-color: #f7f7f7;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .product-card h2 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        .product-card p {
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <img src="src/logo.png" alt="Logo" class="logo">
    <span class="site-name">BeautyBlendr</span>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="productPage.php">Products</a></li>
        <li><a href="terminateSession.php" class="sign-in-link">Sign Out</a></li>
    </ul>
</div>

<div class="category-filter">
    <form method="GET" action="productPage.php">
      <label for="category">Select a Category:</label>
      <select id="category" name="category">
        <option value="lipstick">Lipstick</option>
        <option value="foundation">Foundation</option>
        <!-- Add more options for each category -->
      </select>
      <input type="submit" value="Filter">
    </form>
  </div>

<!-- Product Container -->
<div class="product-container">
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($product['imageProduct']); ?>" alt="<?php echo $product['productName']; ?>">
                <h2><?php echo $product['productName']; ?></h2>
                <p><?php echo $product['productSpecification']; ?></p>
                <p>Price: $<?php echo $product['productPrice']; ?></p>
                <!-- Add more details or buttons as needed -->
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Additional content -->

</body>
</html>
