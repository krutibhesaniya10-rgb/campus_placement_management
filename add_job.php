<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/dp.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $dept = $_POST['dept'];
    $deadline = $_POST['deadline'];

    $sql = "INSERT INTO jobs (title, company, dept, deadline) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $company, $dept, $deadline);

    if ($stmt->execute()) {
        echo "<script>alert('Job Added Successfully');</script>";
    } else {
        echo "<script>alert('Error: Could not add job');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Job</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="form-container">
        <h2>Add New Job</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Job Title" required>
            <input type="text" name="company" placeholder="Company Name" required>
            <input type="text" name="dept" placeholder="Eligible Department" required>
            <input type="date" name="deadline" required>
            <button type="submit">Add Job</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

