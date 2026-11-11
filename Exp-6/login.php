<?php
session_start();

include "db.php";

// Redirect if already logged in
if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if (empty($username) || empty($password)) {
        $message = "Please fill in all fields.";
        $message_type = "error";
    } else {
        // Using prepared statement for better security
        $stmt = $conn->prepare("SELECT id, name FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            
            $message = "Login successful! Welcome " . htmlspecialchars($username);
            $message_type = "success";
            
            // Redirect to dashboard after 2 seconds
            echo '<meta http-equiv="refresh" content="2; url=dashboard.php" />';
        } else {
            $message = "Invalid username or password.";
            $message_type = "error";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Computer Science Department</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">
    <div class="nav-container">
        <h2 class="department-name">CSE Department</h2>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="login.php" class="active">Login</a></li>
            <li><a href="register.php">Registration</a></li>
        </ul>
    </div>
</nav>

<div class="form-box">

    <h2>Student Login</h2>

    <?php 
    if (!empty($message)) {
        echo '<p class="message ' . $message_type . '">' . $message . '</p>';
    }
    ?>

    <form method="POST" onsubmit="return validateLoginForm()">

        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" class="submit-btn">Login</button>

    </form>

    <p class="form-footer">Don't have an account? <a href="register.php">Register here</a></p>

</div>

<footer class="footer">
    <p>&copy; 2024 Computer Science Department. All rights reserved.</p>
</footer>

<script src="script.js"></script>

</body>
</html>