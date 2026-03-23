<?php

// Ensure only admin can access
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Total jobs
$totalJobs = $conn->query("SELECT COUNT(*) AS total FROM jobs")->fetch_assoc()['total'];

// Total applications
$totalApplications = $conn->query("SELECT COUNT(*) AS total FROM applications")->fetch_assoc()['total'];

// Applications by status
$statusData = $conn->query("SELECT status, COUNT(*) AS count FROM applications GROUP BY status");

// Applications by department
$deptData = $conn->query("
    SELECT s.dept, COUNT(*) AS count 
    FROM applications a
    JOIN students s ON a.student_id = s.id
    GROUP BY s.dept
");

?>
<main class="reports-page">
    <h2>📊 Placement Reports</h2>

    <div class="report-cards">
      <div class="card">Total Jobs: <strong><?php echo $totalJobs; ?></strong></div>
      <div class="card">Total Applications: <strong><?php echo $totalApplications; ?></strong></div>
    </div>

    <section>
      <h3>Applications by Status</h3>
      <table>
        <tr><th>Status</th><th>Count</th></tr>
        <?php while ($row = $statusData->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['count']; ?></td>
          </tr>
        <?php } ?>
      </table>
    </section>

    <section>
      <h3>Applications by Department</h3>
      <table>
        <tr><th>Department</th><th>Count</th></tr>
        <?php while ($row = $deptData->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['dept']; ?></td>
            <td><?php echo $row['count']; ?></td>
          </tr>
        <?php } ?>
      </table>
    </section>
  </main>



