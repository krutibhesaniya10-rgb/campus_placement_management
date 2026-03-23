<?php
require_once __DIR__ . '/dp.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Define the variables BEFORE any logic
$successMsg = '';
$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $dept = trim($_POST['dept'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $enrollment = trim($_POST['enrollment'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $semester = trim($_POST['semester'] ?? '');

    // Basic validation
    if ($name === '' || $email === '' || $password === '') {
        $errorMsg = 'Name, email and password are required.';
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM students WHERE email = ? LIMIT 1");
        $check->bind_param('s', $email);
        $check->execute();
        $res = $check->get_result();
        if ($res && $res->num_rows > 0) {
            $errorMsg = 'An account with this email already exists.';
        } else {
            // Hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO students (name, email, password, dept, enrollment, course, semester) VALUES (?, ?, ?, ?, ?, ?, ?)");

            if ($stmt) {
                $stmt->bind_param("sssssss", $name, $email, $hash, $dept, $enrollment, $course, $semester);
                if ($stmt->execute()) {
                    $successMsg = "Registration successful! You can now log in.";
                } else {
                    $errorMsg = "Database Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $errorMsg = "Prepare failed: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="registered-body">

    <div class="registered-container">
        <h2 class="registered-title">Student Registration</h2>

        <!-- ✅ Only show if defined and not empty -->
        <?php if (!empty($successMsg)): ?>
            <div class="registered-success"><?= htmlspecialchars($successMsg) ?></div>
        <?php endif; ?>

        <?php if (!empty($errorMsg)): ?>
            <div class="registered-error"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>

        <form method="POST" class="registered-form">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="dept" placeholder="Department" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="number" name="enrollment" placeholder="Enrollment Number" required>
            <input type="text" name="course" placeholder="Course" required>
            <input type="number" name="semester" placeholder="Semester" required>

            <button type="submit" class="registered-button">Register</button>
        </form>

        <p class="registered-login-link">
            Already registered? <a href="login.php">Login here</a>
        </p>
    </div>

</body>
</html>
