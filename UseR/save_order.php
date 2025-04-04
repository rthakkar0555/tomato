<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Get data from POST request
$data = json_decode(file_get_contents('php://input'), true);

// Log received data for debugging
file_put_contents('php://stderr', print_r($data, true)); // Log to server error log

if ($data) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, email, street, city, state, zip_code, country, phone, order_details, total_price, total_items) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param(
            "sssssssssssd", // Use "d" for totalPrice and "i" for totalItems
            $data['firstName'], 
            $data['lastName'], 
            $data['email'], 
            $data['street'], 
            $data['city'], 
            $data['state'], 
            $data['zipCode'], 
            $data['country'], 
            $data['phone'], 
            $data['orderDetails'], 
            $data['totalPrice'],  // Total price is a double
            $data['totalItems']   // Total items should be an integer
        );

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(["message" => "Order saved successfully!"]);
        } else {
            echo json_encode(["error" => "Failed to save order: " . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(["error" => "Failed to prepare statement: " . $conn->error]);
    }
    
    // Close the connection
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid data"]);
}
?>
