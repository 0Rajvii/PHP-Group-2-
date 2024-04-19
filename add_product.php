
<?php
session_start(); // Place this at the very top of every PHP file
?>
<?php
require_once 'classes/Database.php';
require_once 'classes/Product.php';
require_once 'classes/ImageUploader.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $category = $_POST['category'] ?? '';
    $imageUploader = new ImageUploader();
    $image = '';

    if (isset($_FILES['image'])) {
        $uploadResult = $imageUploader->uploadImage($_FILES['image']);
        if ($uploadResult !== false) {
            $image = $uploadResult;
        } else {
            echo "Failed to upload image. Continuing without it...";
        }
    }

    $product = new Product();
    $product->addProduct($name, $description, $price, $image, $category);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
/* General styles */

.add-product-card {
    margin: 0;
}
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

/* Add Product container and card styles */
.add-product-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 120px);
}

.add-product-card {
    background-color: #fff;
    border-radius: 8px;
    
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 400px; /* Change max-width to adjust the size */
    width: 100%;
}

.add-product-header {
    text-align: center;
    margin-bottom: 25px;
}

.add-product-header h2 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 8px;
}

.add-product-header p {
    color: #666;
    font-size: 14px;
}

.add-product-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 16px;
}

label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

input[type="text"],
input[type="number"],
textarea {
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
    min-height: 80px;
}

.btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

.message {
    color: green;
    font-weight: 600;
    text-align: center;
    margin-top: 16px;
}
        
        </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="add-product-container">
        <div class="add-product-card">
            <div class="add-product-header">
                <h2>Add New Product</h2>
                <p>Fill in the details to create a new product.</p>
            </div>
            <form action="add_product.php" method="post" enctype="multipart/form-data" class="add-product-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" required step="0.01">
                </div>
                <div class="form-group">
                <label for="category">Category</label>
    <select id="category" name="category" required>
    <option value="">Select a category</option>
        <option value="Aviator Sunglasses">Aviator Sunglasses</option>
        <option value="Wayfarer Sunglasses">Wayfarer Sunglasses</option>
        <option value="Round Sunglasses">Round Sunglasses</option>
        <option value="Cat Eye Sunglasses">Cat Eye Sunglasses</option>
        <option value="Square Sunglasses">Square Sunglasses</option>
        <option value="Oversized Sunglasses">Oversized Sunglasses</option>
        <option value="Sport Sunglasses">Sport Sunglasses</option>
        <option value="Polarized Sunglasses">Polarized Sunglasses</option>
        <option value="Mirrored Sunglasses">Mirrored Sunglasses</option>
        <option value="Retro Sunglasses">Retro Sunglasses</option>
    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image">
                </div>
                <button type="submit" class="btn">Add Product</button>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>