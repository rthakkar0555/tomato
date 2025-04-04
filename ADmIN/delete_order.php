<?php
// Check if the request method is POST
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
        die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
    }

    // Get the input from the request body (expecting JSON input)
    $input = json_decode(file_get_contents('php://input'), true);

    // Check if 'orderId' is set in the request body
    if (isset($input['orderId'])) {
        $orderId = $input['orderId']; // Extract the order ID

        // Prepare and bind the SQL DELETE statement
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $orderId); // Bind the order ID as an integer

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Order deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete order.']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If 'orderId' is not provided in the request
        echo json_encode(['success' => false, 'message' => 'Order ID not provided.']);
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
