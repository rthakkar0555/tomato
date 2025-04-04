<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve orders from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

$orders = [];

if ($result->num_rows > 0) {
    // Fetch each row as an associative array
    while($row = $result->fetch_assoc()) {
        $orders[] = [
            'id' => $row['id'],
            'items' => $row['order_details'], // Assuming the 'order_details' column stores JSON data
            'address' => [
                'firstName' => $row['first_name'],
                'lastName' => $row['last_name'],
                'email' => $row['email'],
                'street' => $row['street'],
                'city' => $row['city'],
                'state' => $row['state'],
                'zipCode' => $row['zip_code'],
                'country' => $row['country'],
                'phone' => $row['phone']
            ],
            'totalItems'=>  $row['total_items'],
            'totalPrice' => $row['total_price'],
            'orderDate' => $row['order_date']
        ];
    }
} else {
    echo json_encode(['message' => 'No orders found']);
    exit;
}

echo json_encode($orders);

$conn->close();
?>
