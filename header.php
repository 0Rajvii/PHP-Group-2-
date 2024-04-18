
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunglass Store</title>
    <style>
    header {
        background-color: #333;
        padding: 20px 0;
    }

    .header-container {
        font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo a {
        color: white;
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
    }

    nav ul {
        list-style: none;
        display: flex;
        padding: 0;
    }

    nav ul li {
        margin-left: 20px;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    nav ul li a:hover,
    nav ul li a:focus {
        background-color: #555;
    }

    .cart-button-container {
        display: flex;
        align-items: center;
    }

    .cart-button {
        background-color: cornsilk;
        border: none;
        color: #333;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .cart-button:hover {
        background-color: #f0e68c;
    }

    .cart-button i {
        margin-right: 5px;
    }

   

    @media (max-width: 768px) {
        .header-container {
            flex-wrap: wrap;
            justify-content: center;
        }

        .logo {
            flex-basis: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        nav ul {
            flex-wrap: wrap;
            justify-content: center;
        }

        nav ul li {
            margin: 10px;
        }

        .cart-button-container {
            margin-top: 10px;
        }
    }
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="js/script.js"></script>
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <a href="index.php">Sunglass Store</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="add_product.php">Add Product</a></li>
                <li><a href="show_products.php">Products</a></li>
                <li><a href="checkout.php">checkout</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="cart-button-container">
            <button onclick="toggleCartDrawer()" class="cart-button">
                <i class="fas fa-shopping-cart"></i> Show Cart
            </button>
        </div>
    </div>
</header>

    <div id="cartDrawer" style="display: none;">
        <button onclick="closeCartDrawer()" class="close-cart-drawer">&times;</button>
        <div id="cartContents">
            <!-- Cart items will be loaded dynamically here -->
        </div>
    </div>
</body>
</html>
