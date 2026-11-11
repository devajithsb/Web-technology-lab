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

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    // Validation
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $message = "Please fill in all fields.";
        $message_type = "error";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
        $message_type = "error";
    } elseif (strlen($password) < 4) {
        $message = "Password must be at least 4 characters long.";
        $message_type = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
        $message_type = "error";
    } else {
        // Check if username already exists
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $message = "Username already exists. Please choose another.";
            $message_type = "error";
        } else {
            // Insert new user using prepared statement
            $stmt = $conn->prepare("INSERT INTO users (name, email, username, password, registration_date) VALUES (?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssss", $name, $email, $username, $password);

            if ($stmt->execute()) {
                $message = "Registration successful! You can now <a href='login.php'>login here</a>.";
                $message_type = "success";
            } else {
                $message = "Registration failed. Please try again.";
                $message_type = "error";
            }
            $stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Computer Science Department</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">
    <div class="nav-container">
        <h2 class="department-name">CSE Department</h2>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <?php
            if (isset($_SESSION["username"])) {
                echo '<li><a href="dashboard.php">Dashboard</a></li>';
                echo '<li><a href="logout.php" class="logout-btn">Logout (' . htmlspecialchars($_SESSION["username"]) . ')</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php" class="active">Registration</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>

<div class="form-box">

    <h2>Student Registration</h2>

    <?php 
    if (!empty($message)) {
        echo '<p class="message ' . $message_type . '">' . $message . '</p>';
    }
    ?>

    <form method="POST" onsubmit="return validateRegistrationForm()">

        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" placeholder="Enter your full name" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Choose a username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>

        <button type="submit" class="submit-btn">Register</button>

    </form>

    <p class="form-footer">Already have an account? <a href="login.php">Login here</a></p>

</div>

<footer class="footer">
    <p>&copy; 2024 Computer Science Department. All rights reserved.</p>
</footer>

<script src="script.js"></script>

</body>
</html>