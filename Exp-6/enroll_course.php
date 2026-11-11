<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["course_id"])) {
    $user_id = $_SESSION["user_id"];
    $course_id = intval($_POST["course_id"]);

    // Check if already enrolled
    $check_stmt = $conn->prepare("SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?");
    $check_stmt->bind_param("ii", $user_id, $course_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_stmt->close();

    if ($check_result->num_rows == 0) {
        // Enroll in course
        $enroll_stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id, status) VALUES (?, ?, 'active')");
        $enroll_stmt->bind_param("ii", $user_id, $course_id);
        if ($enroll_stmt->execute()) {
            $_SESSION["enrollment_message"] = "You have successfully enrolled in the course!";
            $_SESSION["enrollment_type"] = "success";
        } else {
            $_SESSION["enrollment_message"] = "Error enrolling in course. Please try again.";
            $_SESSION["enrollment_type"] = "error";
        }
        $enroll_stmt->close();
    } else {
        $_SESSION["enrollment_message"] = "You are already enrolled in this course.";
        $_SESSION["enrollment_type"] = "error";
    }
}

header("Location: dashboard.php");
exit();
?>
