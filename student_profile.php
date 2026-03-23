<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/dp.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$message = "";
$msg_type = "";

// ✅ Fetch existing student details
$stmt = $conn->prepare("SELECT name, email, dept, enrollment, course, semester, password FROM students WHERE id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// ✅ Handle Profile Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $dept       = $_POST['dept'];
    $enrollment = $_POST['enrollment'];
    $course     = $_POST['course'];
    $semester   = $_POST['semester'];

    $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, dept = ?, enrollment = ?, course = ?, semester = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $name, $email, $dept, $enrollment, $course, $semester, $student_id);

    if ($stmt->execute()) {
        $message = "Profile updated successfully!";
        $msg_type = "success";
        $student['name']       = $name;
        $student['email']      = $email;
        $student['dept']       = $dept;
        $student['enrollment'] = $enrollment;
        $student['course']     = $course;
        $student['semester']   = $semester;
    } else {
        $message = "Error updating profile.";
        $msg_type = "error";
    }
}

// ✅ Handle Password Change (Plain Text)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($current_password !== $student['password']) {
        $message = "Current password is incorrect.";
        $msg_type = "error";
    } elseif ($new_password !== $confirm_password) {
        $message = "New passwords do not match.";
        $msg_type = "error";
    } else {
        $stmt = $conn->prepare("UPDATE students SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_password, $student_id);

        if ($stmt->execute()) {
            $message = "Password updated successfully! Please log in again.";
            $msg_type = "success";
            session_destroy();
            header("Refresh:2; url=login.php");
            exit();
        } else {
            $message = "Error updating password.";
            $msg_type = "error";
        }
    }
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="profile-page">
    <div class="container">
        <h2>My Profile</h2>

        <?php if ($message): ?>
            <div class="msg <?php echo $msg_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- ✅ Profile Update Form -->
        <form method="post">
            <h3>Update Profile</h3>

            <label>Enrollment No:</label>
            <input type="text" name="enrollment" value="<?php echo htmlspecialchars($student['enrollment']); ?>" required>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
            
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
            
            <label>Department:</label>
            <input type="text" name="dept" value="<?php echo htmlspecialchars($student['dept']); ?>" required>

            <label>Course:</label>
            <input type="text" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required>

            <label>Semester:</label>
            <input type="text" name="semester" value="<?php echo htmlspecialchars($student['semester']); ?>" required>
            
            <button type="submit" name="update_profile">Update Profile</button>
        </form>

        <hr>

        <!-- ✅ Change Password Form -->
        <form method="post">
            <h3>Change Password</h3>
            <label>Current Password:</label>
            <input type="password" name="current_password" required>
            
            <label>New Password:</label>
            <input type="password" name="new_password" required>
            
            <label>Confirm New Password:</label>
            <input type="password" name="confirm_password" required>
            
            <button type="submit" name="change_password">Change Password</button>
        </form>
    </div>
</main>
</body>
</html>
<?php include 'footer.php'; ?>
