<?php
require_once 'classes/Database.php';
require_once 'classes/Cart.php';

$database = new Database();
$db = $database->connect();

$userLoggedIn = isset($_SESSION['user_id']); // Adjust this according to how you handle logins

$cart = new Cart($db);
// Assuming $cart->getCartContents() correctly fetches cart data from the session
$cartItems = $cart->getCartContents();

header('Content-Type: application/json');
echo json_encode($cartItems);
?>
