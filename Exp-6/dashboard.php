<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include "db.php";

// Get user information from database
$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Get enrollment statistics (if courses are enrolled)
$enrollment_stmt = $conn->prepare("SELECT COUNT(*) as total_courses FROM enrollments WHERE user_id = ? AND status = 'active'");
$enrollment_stmt->bind_param("i", $user_id);
$enrollment_stmt->execute();
$enrollment_result = $enrollment_stmt->get_result();
$enrollment_data = $enrollment_result->fetch_assoc();
$total_courses = $enrollment_data["total_courses"];
$enrollment_stmt->close();

// Get courses enrolled by user
$courses_stmt = $conn->prepare("
    SELECT c.id, c.course_name, c.course_code, c.credits, c.instructor, e.enrollment_date, e.status
    FROM enrollments e
    JOIN courses c ON e.course_id = c.id
    WHERE e.user_id = ?
    ORDER BY e.enrollment_date DESC
");
$courses_stmt->bind_param("i", $user_id);
$courses_stmt->execute();
$courses_result = $courses_stmt->get_result();
$courses_stmt->close();

// Get all available courses for enrollment
$all_courses_stmt = $conn->prepare("
    SELECT c.* FROM courses c
    WHERE c.id NOT IN (
        SELECT course_id FROM enrollments WHERE user_id = ? AND status = 'active'
    )
");
$all_courses_stmt->bind_param("i", $user_id);
$all_courses_stmt->execute();
$all_courses_result = $all_courses_stmt->get_result();
$all_courses_stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Computer Science Department</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .dashboard-header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .user-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .info-card h3 {
            font-size: 0.9em;
            font-weight: 600;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .info-card p {
            font-size: 1.5em;
            font-weight: bold;
            margin: 0;
        }

        .dashboard-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .dashboard-section h2 {
            color: #3498db;
            font-size: 1.6em;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .course-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3498db;
            transition: transform 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .course-card h3 {
            color: #2c3e50;
            margin-top: 0;
        }

        .course-code {
            background: #3498db;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85em;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }

        .course-info {
            color: #666;
            font-size: 0.95em;
            margin: 10px 0;
        }

        .course-info strong {
            color: #2c3e50;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85em;
            display: inline-block;
        }

        .empty-message {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            color: #7f8c8d;
        }

        .empty-message p {
            font-size: 1.1em;
            margin: 10px 0;
        }

        .enroll-btn {
            background: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: all 0.3s ease;
        }

        .enroll-btn:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3);
        }

        .stat-box h4 {
            margin: 0 0 10px 0;
            font-size: 0.9em;
            opacity: 0.9;
        }

        .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            margin: 0;
        }

        .breadcrumb {
            color: #7f8c8d;
            margin-bottom: 20px;
            font-size: 0.95em;
        }

        .breadcrumb a {
            color: #3498db;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 10px;
            }

            .dashboard-header,
            .dashboard-section {
                padding: 20px;
            }

            .courses-grid {
                grid-template-columns: 1fr;
            }

            .quick-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="nav-container">
        <h2 class="department-name">CSE Department</h2>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="logout.php" class="logout-btn">Logout (<?php echo htmlspecialchars($_SESSION["username"]); ?>)</a></li>
        </ul>
    </div>
</nav>

<div class="dashboard-container">
    <div class="breadcrumb">
        <a href="index.php">Home</a> / <strong>Dashboard</strong>
    </div>

    <div class="dashboard-header">
        <h1>Welcome back, <?php echo htmlspecialchars($user["name"]); ?>! 👋</h1>
        <p style="color: #7f8c8d; margin: 10px 0 0 0;">Manage your courses and view your academic information</p>
        
        <div class="user-info">
            <div class="info-card">
                <h3>📧 Email</h3>
                <p style="font-size: 0.9em; word-break: break-all;"><?php echo htmlspecialchars($user["email"]); ?></p>
            </div>
            <div class="info-card">
                <h3>👤 Username</h3>
                <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
            </div>
            <div class="info-card">
                <h3>📅 Member Since</h3>
                <p><?php echo date("M d, Y", strtotime($user["registration_date"])); ?></p>
            </div>
            <div class="info-card">
                <h3>📚 Enrolled Courses</h3>
                <p><?php echo $total_courses; ?></p>
            </div>
        </div>
    </div>

    <div class="quick-stats">
        <div class="stat-box">
            <h4>Total Credits</h4>
            <p class="stat-number">
                <?php
                    $credits_stmt = $conn->prepare("
                        SELECT SUM(c.credits) as total_credits
                        FROM enrollments e
                        JOIN courses c ON e.course_id = c.id
                        WHERE e.user_id = ? AND e.status = 'active'
                    ");
                    $credits_stmt->bind_param("i", $user_id);
                    $credits_stmt->execute();
                    $credits_result = $credits_stmt->get_result();
                    $credits_data = $credits_result->fetch_assoc();
                    echo $credits_data["total_credits"] ? $credits_data["total_credits"] : 0;
                    $credits_stmt->close();
                ?>
            </p>
        </div>
        <div class="stat-box">
            <h4>Courses Enrolled</h4>
            <p class="stat-number"><?php echo $total_courses; ?></p>
        </div>
        <div class="stat-box">
            <h4>Account Status</h4>
            <p class="stat-number" style="font-size: 1.5em;">✅ Active</p>
        </div>
    </div>

    <?php if ($total_courses > 0): ?>
    <div class="dashboard-section">
        <h2>📚 My Courses</h2>
        <div class="courses-grid">
            <?php while ($course = $courses_result->fetch_assoc()): ?>
            <div class="course-card">
                <h3><?php echo htmlspecialchars($course["course_name"]); ?></h3>
                <div class="course-code"><?php echo htmlspecialchars($course["course_code"]); ?></div>
                <div class="course-info">
                    <strong>Credits:</strong> <?php echo $course["credits"]; ?>
                </div>
                <div class="course-info">
                    <strong>Instructor:</strong> <?php echo htmlspecialchars($course["instructor"]); ?>
                </div>
                <div class="course-info">
                    <strong>Enrolled:</strong> <?php echo date("M d, Y", strtotime($course["enrollment_date"])); ?>
                </div>
                <div style="margin-top: 15px;">
                    <span class="status-active"><?php echo ucfirst($course["status"]); ?></span>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php else: ?>
    <div class="dashboard-section">
        <h2>📚 My Courses</h2>
        <div class="empty-message">
            <p>You haven't enrolled in any courses yet.</p>
            <p>Browse available courses below to get started!</p>
        </div>
    </div>
    <?php endif; ?>

    <div class="dashboard-section">
        <h2>🎓 Available Courses</h2>
        <?php if ($all_courses_result->num_rows > 0): ?>
            <div class="courses-grid">
                <?php while ($course = $all_courses_result->fetch_assoc()): ?>
                <div class="course-card">
                    <h3><?php echo htmlspecialchars($course["course_name"]); ?></h3>
                    <div class="course-code"><?php echo htmlspecialchars($course["course_code"]); ?></div>
                    <div class="course-info">
                        <strong>Credits:</strong> <?php echo $course["credits"]; ?>
                    </div>
                    <div class="course-info">
                        <strong>Description:</strong> <?php echo htmlspecialchars($course["description"]); ?>
                    </div>
                    <div class="course-info">
                        <strong>Instructor:</strong> <?php echo htmlspecialchars($course["instructor"]); ?>
                    </div>
                    <div style="margin-top: 15px;">
                        <form method="POST" action="enroll_course.php" style="display: inline;">
                            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                            <button type="submit" class="enroll-btn">+ Enroll Now</button>
                        </form>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="empty-message">
                <p>No additional courses available.</p>
                <p>You are already enrolled in all available courses.</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<footer class="footer">
    <p>&copy; 2024 Computer Science Department. All rights reserved.</p>
</footer>

<script src="script.js"></script>

</body>
</html>
