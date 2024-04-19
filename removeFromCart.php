<?php
require_once 'classes/Database.php'; // Adjust the path as necessary
require_once 'classes/Cart.php';

// Assuming you're using PDO for database connection
$database = new Database();
$db = $database->connect();

$cart = new Cart($db);

// Retrieve product ID from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'] ?? null;

if ($productId) {
    $cart->removeFromCart($productId);
    echo json_encode(['status' => 'success', 'message' => 'Item removed from cart']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product ID']);
}
?>
