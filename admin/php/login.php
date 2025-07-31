<?php
session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "Wizard@mn";
$dbname = "prisa";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM userlog WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();
    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        // Verify password
        if (password_verify($input_password, $hashed_password)) {
            // Password is correct, start a session
            $_SESSION['username'] = $input_username;
            echo "Login successful! Welcome, " . htmlspecialchars($input_username) . ".";
        } else {
            echo "Invalid password.";
        }
    } else {
      echo "No user found with that username.";
    }
    $stmt->close();
}
$conn->close();
?>