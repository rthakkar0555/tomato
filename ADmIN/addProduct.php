<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = ""; // Default for XAMPP
$dbname = "project"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST['prNm'];
    $product_desc = $_POST['prDesc'];
    $product_category = $_POST['cat'];
    $product_price = $_POST['prPr'];

    // Handle file upload
    $target_dir = "C:/xampp/htdocs/UseR/uploads/"; // Updated path
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if image file is a real image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (5MB max)
    if ($_FILES["product_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
        $uploadOk = 0;
    }

    // Try uploading the file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            // Insert form data into the database
            $sql = "INSERT INTO products (product_name, product_desc, product_category, product_price, product_image)
                    VALUES ('$product_name', '$product_desc', '$product_category', '$product_price', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "New product added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Close the database connection
    $conn->close();
}
?>
