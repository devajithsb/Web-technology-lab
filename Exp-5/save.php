<?php

include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$department = $_POST['department'];
$designation = $_POST['designation'];
$salary = $_POST['salary'];

$sql = "INSERT INTO employees
        (name, email, phone, department, designation, salary)
        VALUES
        ('$name', '$email', '$phone', '$department', '$designation', '$salary')";

if (mysqli_query($conn, $sql)) {
    echo "<h2>Employee details saved successfully!</h2>";
    echo "<a href='index.php'>Add Another Employee</a><br>";
    echo "<a href='view.php'>View Employees</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);

?>