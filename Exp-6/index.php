<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Science Department - Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">
    <div class="nav-container">
        <h2 class="department-name">CSE Department</h2>
        <ul class="nav-links">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <?php
            if (isset($_SESSION["username"])) {
                echo '<li><a href="dashboard.php">Dashboard</a></li>';
                echo '<li><a href="logout.php" class="logout-btn">Logout (' . htmlspecialchars($_SESSION["username"]) . ')</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php">Registration</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>

<div class="home">
    <div class="hero-section">
        <h1>Welcome to Computer Science Department</h1>
        
        <?php
        if (isset($_SESSION["username"])) {
            echo '<p class="greeting">Hello, ' . htmlspecialchars($_SESSION["username"]) . '! Welcome back.</p>';
        }
        ?>

        <p class="intro-text">
            Welcome to the Department of Computer Science and Engineering.
        </p>

        <p class="description-text">
            We provide quality education in programming, web development,
            artificial intelligence, and computer science. Our mission is to
            develop competent professionals who can contribute to the technological
            advancement of society.
        </p>

        <button onclick="welcome()" class="welcome-btn">Learn More</button>
    </div>

    <div class="features-section">
        <div class="feature-box">
            <h3>Expert Faculty</h3>
            <p>Learn from experienced professionals with industry expertise.</p>
        </div>
        <div class="feature-box">
            <h3>Modern Curriculum</h3>
            <p>Updated with latest technologies and industry standards.</p>
        </div>
        <div class="feature-box">
            <h3>Practical Training</h3>
            <p>Hands-on experience with real-world projects.</p>
        </div>
    </div>
</div>

<footer class="footer">
    <p>&copy; 2024 Computer Science Department. All rights reserved.</p>
</footer>

<script src="script.js"></script>

</body>
</html>