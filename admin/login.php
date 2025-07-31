<?php
session_start();

// Hardcoded credentials
$valid_username = "admin";
$valid_password = "password123";

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: login.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['username'])) {
    // User is logged in, show welcome message
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Dashboard</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
            .container { max-width: 400px; margin: auto; background: white; padding: 20px; border-radius: 5px; }
            a.logout { display: inline-block; margin-top: 20px; color: #fff; background: #007BFF; padding: 10px 15px; text-decoration: none; border-radius: 3px; }
            a.logout:hover { background: #0056b3; }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>You have successfully logged in.</p>
            <a class="logout" href="login.php?action=logout">Logout</a>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 400px; margin: auto; background: white; padding: 20px; border-radius: 5px; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 10px; margin: 5px 0 15px 0; border: 1px solid #ccc; border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007BFF; color: white; padding: 10px; border: none; border-radius: 3px; cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required autofocus>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>
