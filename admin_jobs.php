<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/dp.php';
// Insert Job
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $dept = $_POST['dept'];
    $deadline = $_POST['deadline'];

    // Duplicate check
    $check = $conn->prepare("SELECT id FROM jobs WHERE title = ? AND company = ? AND dept = ?");
    $check->bind_param("sss", $title, $company, $dept);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('⚠ Job already exists for this company & department!');</script>";
    } else {
        $sql = "INSERT INTO jobs (title, company, dept, deadline) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $company, $dept, $deadline);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Job Added Successfully');</script>";
        } else {
            echo "<script>alert('❌ Error: Could not add job');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Jobs</title>
  <link rel="stylesheet" href="style.css"> <!-- તમારો CSS file -->
</head>
<body>

<div class="container">
  <h2>💼 Manage Jobs</h2>
</div>

<!-- Job Posting Form -->
<form class="job-form" method="POST" action="">
  <label>Job Title:</label>
  <input type="text" name="title" required>

  <label>Company:</label>
  <input type="text" name="company" required>

  <label>Department:</label>
  <select name="dept" required>
    <option value="CSE">Computer Science</option>
    <option value="ECE">Electronics</option>
    <option value="ME">Mechanical</option>
    <option value="CE">Civil</option>
    <option value="EE">Electrical</option>
    <option value="MBA">MBA</option>
  </select>

  <label>Deadline:</label>
  <input type="date" name="deadline" required>

  <button type="submit" class="add-btn">Add Job</button>
</form>

<!-- Job Table -->
<div class="table-container">
  <table class="job-table">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Company</th>
      <th>Department</th>
      <th>Deadline</th>
      <th>Action</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM jobs ORDER BY deadline DESC");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['company']}</td>
                    <td>{$row['dept']}</td>
                    <td>{$row['deadline']}</td>
                    <td>
                        <a class='btn edit-btn' href='edit_job.php?id={$row['id']}'>Edit</a>
                        <a class='btn delete-btn' href='delete_job.php?id={$row['id']}' onclick=\"return confirm('Delete job?');\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='no-data'>No jobs posted.</td></tr>";
    }
    ?>
  </table>
</div>

</body>
</html>
