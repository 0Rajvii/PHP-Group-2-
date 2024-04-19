<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';

$db = new Database();
$user = new User($db);
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if (empty($username) || empty($password)) {
        $error = 'Both username and password are required.';
    } else {
        $loginSuccess = $user->login($username, $password);
        if ($loginSuccess) {
            header('Location: index.php');
            exit();
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

/* Login container and card styles */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 120px);
}

.login-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 40px;
    max-width: 400px;
    width: 100%;
}

.login-header {
    text-align: center;
    margin-bottom: 30px;
}

.login-header h2 {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

.login-header p {
    color: #666;
    font-size: 16px;
}

.login-form {
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

.login-footer {
    text-align: center;
    margin-top: 20px;
    color: #666;
    font-size: 14px;
}

.login-footer a {
    color: #007bff;
    text-decoration: none;
}

.login-footer a:hover {
    text-decoration: underline;
}

.error {
    color: #ff0000;
    margin-bottom: 15px;
}
        </style>
    <?php include 'header.php'; ?>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Welcome Back</h2>
                <p>Please enter your credentials to access your account.</p>
            </div>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form action="login.php" method="post" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <div class="login-footer">
                <p>Don't have an account? <a href="register.php">Sign up</a></p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
