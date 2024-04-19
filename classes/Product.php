<?php
require_once 'Database.php';

 // Assume Database.php contains the Database class we created earlier

class Product {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }
// In the Product class

public function getDistinctCategories() {
    $db = new Database();
    $connection = $db->getConnection();

    $query = "SELECT DISTINCT category FROM products";
    $statement = $connection->prepare($query);
    $statement->execute();

    $categories = $statement->fetchAll(PDO::FETCH_COLUMN);
    
    return $categories;
}

    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->db->prepare($query);
        
        // Initialize an empty array to hold products
        $products = [];
        
        if ($stmt->execute()) {
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $products;
    }
    


    
// Inside your Product class
public function getProducts($limit, $offset) {
    $query = "SELECT * FROM products LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getProductById($id) {
    $query = "SELECT * FROM products WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return null;
    }
}

    public function addProduct($name, $description, $price, $image, $category) {
        try {
            $sql = "INSERT INTO products (name, description, price, image, category) VALUES (:name, :description, :price, :image, :category)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":image", $image);
            $stmt->bindParam(":category", $category);

            $stmt->execute();
            echo "Product added successfully!";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
?>
