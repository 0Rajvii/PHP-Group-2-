<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Cart.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$database = new Database();
$db = $database->connect();



$cart = new Cart($db);

$userLoggedIn = isset($_SESSION['user_id']); // Adjust this according to how you handle logins


$productId = $input['product_id'] ?? null;
$quantity = $input['quantity'] ?? 1;

if ($productId && $quantity > 0) {
    $cart->addToCart($productId, $quantity);
    echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product ID or quantity']);
}



?>
