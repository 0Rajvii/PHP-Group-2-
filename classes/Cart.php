<?php
session_start();



class Cart {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addToCart($productId, $quantity) {
        $cartId = $this->getCartId();
        // Check if product already in cart
        $stmt = $this->db->prepare("SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?");
        $stmt->execute([$cartId, $productId]);
        if ($stmt->rowCount() > 0) {
            // Update quantity if already exists
            $stmt = $this->db->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?");
            $stmt->execute([$quantity, $cartId, $productId]);
        } else {
            // Insert new item
            $stmt = $this->db->prepare("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$cartId, $productId, $quantity]);
        }
    }

    public function updateQuantity($productId, $quantity) {
        $cartId = $this->getCartId();
        $stmt = $this->db->prepare("UPDATE cart_items SET quantity = ? WHERE cart_id = ? AND product_id = ?");
        $stmt->execute([$quantity, $cartId, $productId]);
    }
    public function removeFromCart($productId) {
        $cartId = $this->getCartId();
        $stmt = $this->db->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?");
        $stmt->execute([$cartId, $productId]);
    }
    
    public function getCartContents() {
        $cartId = $this->getCartId();
        $stmt = $this->db->prepare("SELECT * FROM cart_items INNER JOIN products ON cart_items.product_id = products.id WHERE cart_id = ?");
        $stmt->execute([$cartId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getCartId() {
        if (!isset($_SESSION['cart_id'])) {
            $_SESSION['cart_id'] = bin2hex(random_bytes(16));
        }
        return $_SESSION['cart_id'];
    }

    
}
?>
