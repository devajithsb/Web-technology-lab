<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Computer Science Department</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">
    <div class="nav-container">
        <h2 class="department-name">CSE Department</h2>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php" class="active">About Us</a></li>
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

<div class="about">
    <h1>About Computer Science Department</h1>
    
    <div class="about-content">
        <h2>Our Mission</h2>
        <p>
            The Computer Science and Engineering Department is committed to providing 
            high-quality education and fostering innovation in computer science. Our mission 
            is to develop competent professionals who can address the complex technological 
            challenges of modern society.
        </p>

        <h2>Our Vision</h2>
        <p>
            To be a leading department recognized for excellence in teaching, research, and 
            professional development in the field of Computer Science and Engineering. We aim 
            to create an environment where students can develop critical thinking skills and 
            practical expertise.
        </p>

        <h2>Academic Programs</h2>
        <div class="program-list">
            <div class="program-item">
                <h3>Web Development</h3>
                <p>Learn to build modern, responsive web applications using HTML, CSS, 
                JavaScript, and popular frameworks.</p>
            </div>
            <div class="program-item">
                <h3>Mobile Development</h3>
                <p>Develop native and cross-platform mobile applications for Android and iOS 
                using modern development tools.</p>
            </div>
            <div class="program-item">
                <h3>Data Science</h3>
                <p>Explore data analysis, machine learning, and artificial intelligence with 
                practical hands-on projects.</p>
            </div>
            <div class="program-item">
                <h3>Cloud Computing</h3>
                <p>Understand cloud infrastructure, deployment, and scalability with AWS, 
                Azure, and Google Cloud.</p>
            </div>
        </div>

        <h2>Department Information</h2>
        <table class="info-table">
            <tr>
                <th>Particulars</th>
                <th>Details</th>
            </tr>
            <tr>
                <td>Department Head</td>
                <td>Dr. Rajesh Kumar</td>
            </tr>
            <tr>
                <td>Established</td>
                <td>2010</td>
            </tr>
            <tr>
                <td>Faculty Members</td>
                <td>25+</td>
            </tr>
            <tr>
                <td>Total Students</td>
                <td>500+</td>
            </tr>
            <tr>
                <td>Laboratory Facilities</td>
                <td>5 Modern Labs</td>
            </tr>
        </table>

        <h2>Facilities & Resources</h2>
        <ul class="facilities-list">
            <li>State-of-the-art computer labs with latest hardware</li>
            <li>High-speed internet connectivity</li>
            <li>Digital library with access to journals and e-books</li>
            <li>Industry-standard software and development tools</li>
            <li>Regular workshops and seminars by industry experts</li>
            <li>Internship and placement opportunities</li>
            <li>Active coding and programming clubs</li>
        </ul>

        <h2>Contact Us</h2>
        <div class="contact-info">
            <p><strong>Address:</strong> Computer Science Building, Campus Avenue, University Campus</p>
            <p><strong>Phone:</strong> +91-XXXX-XXXXXX</p>
            <p><strong>Email:</strong> cse@university.edu</p>
            <p><strong>Office Hours:</strong> Monday to Friday, 9:00 AM to 5:00 PM</p>
        </div>
    </div>
</div>

<footer class="footer">
    <p>&copy; 2024 Computer Science Department. All rights reserved.</p>
</footer>

<script src="script.js"></script>

</body>
</html>