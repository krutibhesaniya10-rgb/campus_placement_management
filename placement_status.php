<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/dp.php';

// ✅ Ensure only logged-in students can access
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// ✅ Fetch applications for the logged-in student only (use new table fields)
$sql = "SELECT id, job_title, company_name, status, applied_at 
        FROM applications 
        WHERE student_id = ? 
        ORDER BY applied_at DESC";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Placement Status</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'; ?>

<main class="status-page">
  <h2>My Applications</h2>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>Application ID</th>
      <th>Job Title</th>
      <th>Company</th>
      <th>Status</th>
      <th>Applied On</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['job_title']; ?></td>
              <td><?php echo $row['company_name']; ?></td>
              <td><?php echo $row['status']; ?></td>
              <td><?php echo $row['applied_at']; ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
          <td colspan="5">No applications found.</td>
        </tr>
    <?php endif; ?>
  </table>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
