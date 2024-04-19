<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';

$db = new Database();
$user = new User($db);
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $message = 'All fields are required!';
    } else {
        $success = $user->register($username, $email, $password);
        if ($success) {
            $message = 'Registered successfully! You can now login.';
            // Optionally redirect or set session variables here
        } else {
            $message = 'Registration failed! Username or email might be already in use.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <style>

        /* General styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

/* Register container and card styles */
.register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 120px);
}

.register-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 40px;
    max-width: 400px;
    width: 100%;
}

.register-header {
    text-align: center;
    margin-bottom: 30px;
}

.register-header h2 {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

.register-header p {
    color: #666;
    font-size: 16px;
}

.register-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    padding: 12px 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
}

.btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

.register-footer {
    text-align: center;
    margin-top: 20px;
    color: #666;
    font-size: 14px;
}

.register-footer a {
    color: #007bff;
    text-decoration: none;
}

.register-footer a:hover {
    text-decoration: underline;
}

.message {
    color: #ff0000;
    margin-bottom: 15px;
}
    </style>
    <?php include 'header.php'; ?>

    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2>Create an Account</h2>
                <p>Please fill in the following information to register.</p>
            </div>
            <?php if ($message): ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            <form action="register.php" method="post" class="register-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            <div class="register-footer">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
