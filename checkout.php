<?php

require_once 'classes/Database.php';
require_once 'classes/Cart.php';

// Establish database connection
$database = new Database();
$db = $database->connect();

// Initialize cart
$cart = new Cart($db);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// Fetch cart items
$cartItems = $cart->getCartContents();
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Process checkout form submission (stub)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form data to place order, etc.
    echo "<p>Order placed successfully!</p>";
    // Ideally, redirect to a confirmation page or clear the cart here.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
        .cart-item-detail {
            flex-grow: 1;
        }
        .cart-item-detail h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .cart-item-detail p {
            margin: 4px 0;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            width: 100%;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .checkout-button {
            background-color: #4CAF50; /* Green background for the button */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 5px; /* Adds a little space between the total and the button */
            width: 100%; /* Makes the button extend full width of the drawer */
            box-shadow: 0 2px 4px rgba(0,0,0,0.25); /* Subtle shadow for depth */
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
    <link rel="stylesheet" href="style.css"></link>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Checkout</h1>
        <div class="card" id="cartContents">
            <h2>Your Cart Items</h2>
            <?php if (count($cartItems) > 0): ?>
                <ul>
                    <?php foreach ($cartItems as $item): ?>
                        <li class="cart-item">
                            <img src="images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <div class="cart-item-detail">
                                <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p>Price: $<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></p>
                                <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                                <p>Total: $<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="total">Total: $<?php echo number_format($total, 2); ?></p>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <?php if (count($cartItems) > 0): ?>
            <div class="card">
                <h2>Shipping Information</h2>
                <form action="orderconfirm.php" method="post">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" required>
                    </div>
                    <div class="form-group">
                        <label for="zip">ZIP Code:</label>
                        <input type="text" id="zip" name="zip" required>
                    </div>
                    <button type="submit" class="btn">Place Order</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
