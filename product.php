<?php
require_once 'classes/Database.php';
require_once 'classes/Product.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productInstance = new Product();
    $product = $productInstance->getProductById($productId);
}
if (empty($product)) {
    echo "Product not found";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    </head>
<body>
    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
    <p><?php echo htmlspecialchars($product['description']); ?></p>
    <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="" height="200">
</body>
</html>
