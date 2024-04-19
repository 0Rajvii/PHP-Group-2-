<?php
require_once 'Database.php';
class User {
    private $db;
    private $conn;

    public function __construct($db) {
        $this->db = $db;
        $this->conn = $this->db->connect();
    }

    public function register($username, $email, $password) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($sql);

        // Binding parameters to prevent SQL injection
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hash);

        return $stmt->execute();
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];  // Set user session or similar handling
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
