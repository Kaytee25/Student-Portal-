<?php

$conn = new mysqli("localhost", "root", "", "student portal");

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

$sql = "SELECT * FROM students LIMIT 1";

$result = $conn->query($sql);

$student = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

    <title>Dashboard</title>

</head>

<body>

    <h1>Student Dashboard</h1>

    <?php if ($student): ?>

        <p><b>Name:</b> <?php echo $student['full_name']; ?></p>

        <p><b>Student Number:</b> <?php echo $student['student_number']; ?></p>

        <p><b>Program:</b> <?php echo $student['program']; ?></p>

        <p><b>Academic Year:</b> <?php echo $student['academic_year']; ?></p>

    <?php else: ?>

        <p>No student data found in database.</p>

    <?php endif; ?>

</body>

</html>