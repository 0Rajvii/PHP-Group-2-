<?php
session_start(); // Place this at the very top of every PHP file

require_once 'classes/Database.php';
require_once 'classes/Product.php';

$product = new Product();
$products = $product->getAllProducts(); // Assuming this method is implemented in Product class

// Get distinct categories
$categories = $product->getDistinctCategories(); // Implement this method in Product class to fetch distinct categories
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css"></link>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Products</title>
    <style>
.add-to-cart-btn {
    width:70%;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: bold;
    flex-grow: 1;
    margin-left: 10px;
}


.cart-item {
    display: flex;
    margin-bottom: 20px;
}


.cart-item-info {
    display: flex;
    flex-direction: column;
}


         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .product-card {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            position: relative; /* Added */
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-card img {
            width: 100%;
    
            height: 200px;
            object-fit: contain;
        }
        .product-info {
            padding: 15px;
        }
        .product-info h3, .product-info p {
            margin: 5px 0;
        }
        .product-price-label {
            font-weight: bold;
            color: #ffffff;
                        position: absolute; /* Added */
            top: 10px; /* Adjust as needed */
            right: 10px; /* Adjust as needed */
            background-color: rgb(0 0 0 / 80%);
                        padding: 5px 10px; /* Padding for label */
            border-radius: 5px; /* Rounded corners */
        }
        .add-to-cart {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            margin-top: 10px;
            text-decoration: none; /* Remove underline from links */
            display: block; /* Make the link fill the container */
            border-radius: 0 0 10px 10px; /* Match the card's border radius */
        }
        .add-to-cart:hover {
            background-color: #0056b3;
        }

        @media (max-width: 960px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
        }


        .filter-category {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filter-category label {
            font-size: 16px;
            font-weight: bold;
            margin-right: 10px;
            color: #333;
        }

        .filter-category select {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 20px;
            width: 200px;
            transition: border-color 0.3s, background-color 0.3s;
        }

        .filter-category select:focus {
            outline: none;
            border-color: #007bff;
            background-color: #fff;
        }

    </style>
        <script src="js/script.js"></script>
        <script>


 /* JavaScript for category-wise filtering */
 document.addEventListener('DOMContentLoaded', function() {
        const categoryFilter = document.getElementById('category-filter');

        categoryFilter.addEventListener('change', function() {
            const selectedCategory = categoryFilter.value;

            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');

                if (selectedCategory === '' || selectedCategory === cardCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
        
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<?php include 'header.php'; ?>

<body>

    <h2 style="text-align: center;">Product List</h2>

<!-- Category filter dropdown -->
<div class="filter-category">
        <label for="category-filter">Filter by Category:</label>
        <select id="category-filter">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card" data-category="<?php echo htmlspecialchars($product['category']); ?>">
                <!-- Product card content -->
                <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <span class="product-price-label">$<?php echo htmlspecialchars($product['price']); ?></span>
                    <input type="number" id="quantity_<?php echo $product['id']; ?>" value="1" min="1" style="width: 60px;">
                    <button class="add-to-cart-btn" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
   
    <?php include 'footer.php'; ?>
</body>
</html>
 