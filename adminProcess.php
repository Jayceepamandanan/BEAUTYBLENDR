<?php
    // Insert data into database if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "config.php";

        $productName = $_POST['productName'];
        $productSpecification = $_POST['productSpecification'];
        $productPrice = $_POST['productPrice'];
        $category = $_POST['category']; // Retrieve the selected category

        $targetDir = "uploads/"; // Directory where uploaded files will be stored
        $targetFile = $targetDir . basename($_FILES["imageProduct"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is an actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["imageProduct"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["imageProduct"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // File uploaded successfully, proceed to insert data into database
            $imageContent = file_get_contents($_FILES["imageProduct"]["tmp_name"]);

            $sql = "INSERT INTO products_tb (productName, productSpecification, productPrice, imageProduct, category) 
            VALUES (:productName, :productSpecification, :productPrice, :imageProduct, :category)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':productSpecification', $productSpecification);
            $stmt->bindParam(':productPrice', $productPrice);
            $stmt->bindParam(':imageProduct', $imageContent, PDO::PARAM_LOB); // Bind as a BLOB
            $stmt->bindParam(':category', $category); // Bind the category parameter
            
            // Execute the SQL query
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Product added successfully message
                $successMessage = "Product added successfully!";
            
                // Redirect to admin dashboard after a delay
                echo '<meta http-equiv="refresh" content="2;url=adminDashboard.php">';
            
                // Display success message
                echo "<p>{$successMessage}</p>";
                // You can add more HTML or a link to the dashboard here if needed
            } else {
                // Error message if the product wasn't added successfully
                echo "Error adding product.";
            }
        
        }
    }
    ?>