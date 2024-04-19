
<?php


require_once 'classes/Product.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Assuming you have a session started to store cart items
    session_start();
    
    // Get the product ID from the form submission
    $productId = $_POST['product_id'];

    // Initialize the Product class
    $product = new Product();

    // Add the product to the cart
    $product->addToCart($productId);

    // Redirect to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Get all products
$product = new Product();
$products = $product->getAllProducts(); // Assuming this method is implemented in Product class
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css"></link>
    <script>
        
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        alert('Add to Cart clicked'); // Check how many times this logs when clicked once

        const productId = this.dataset.productId;

        const quantityInput = document.getElementById('quantity_' + productId);
        const quantity = quantityInput ? parseInt(quantityInput.value) : 1;

        fetch('addToCart.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            product_id: productId,
            quantity: quantity
          })
        })
        .then(response => response.json())
        .then(data => {
          alert('Added to cart successfully!');
        })
        .catch(error => console.error('Error adding product to cart:', error));
      });
    });
  });
         
        </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .product-card {
            width: calc(25% - 40px);
            margin: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            position: relative; /* Required for positioning the overlay and button */
        }
        .product-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 10px 10px 0 0;
            position: relative;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3); /* Semi-transparent black */
            opacity: 0; /* Initially transparent */
            transition: opacity 0.3s ease; /* Smooth transition */
        }
        .product-card:hover .overlay {
            opacity: 1; /* Show the overlay on hover */
        }
        .product-info {
            padding: 20px;
        }
        .product-info h3 {
            margin: 0;
            color: #333;
        }
        .product-info p {
            margin: 10px 0;
            color: #666;
        }
        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            background-color: #ffaa00;
            padding: 5px 10px;
            border-radius: 5px;
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        }
        .add-to-cart {
            width: 60%;
            display: none; /* Initially hide the button */
            position: absolute; /* Position the button relative to its parent */
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Center the button precisely */
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }
        .product-card:hover .add-to-cart {
            display: block; /* Show the button on hover */
        }
        .add-to-cart:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .product-card {
                width: calc(50% - 40px);
            }
        }

        @media (max-width: 480px) {
            .product-card {
                width: calc(100% - 40px);
            }
        }
    </style>
   
</head>
<body>
   

<div class="product-container">
    <?php
    require_once 'classes/Product.php';
    $product = new Product();
    $products = $product->getAllProducts(); // Assuming this method is implemented in Product class
    ?>

    <?php $count = 0; ?>
    <?php foreach ($products as $product): ?>
        <?php if ($count < 4): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="overlay"></div> <!-- Overlay for darkening effect -->
                    <span class="product-price">$<?php echo htmlspecialchars($product['price']); ?></span> <!-- Price label -->
                </div>
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <div class="product-info">
    <input type="hidden" id="product_id_<?php echo $product['id']; ?>" value="<?php echo $product['id']; ?>">
    <input type="number" id="quantity_<?php echo $product['id']; ?>" value="1" min="1" style="width: 60px;">
    <button class="add-to-cart-btn" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
</div>
                </div>
<!-- Inside your product loop -->

            </div>
            <?php $count++; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>


</body>
</html>
