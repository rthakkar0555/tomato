<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Get the product ID from the request
    $product_id = $_POST['id'];

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
