<?php
include 'header.php';
require_once __DIR__ . '/dp.php';

$dept = isset($_GET['dept']) ? $_GET['dept'] : '';

$sql = "SELECT * FROM jobs WHERE dept = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $dept);
$stmt->execute();
$result = $stmt->get_result();
?>

<link rel="stylesheet" href="style.css">

<main class="jobs-page">
  <section class="jobs-intro">
    <h2><?php echo htmlspecialchars($dept); ?> Jobs</h2>
    <p>Explore available opportunities in <?php echo htmlspecialchars($dept); ?> department.</p>
  </section>

  <section class="jobs-list">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="job-card">
          <h3><?php echo htmlspecialchars($row['title']); ?></h3>
          <p><strong>Job ID:</strong> <?php echo $row['id']; ?></p>
          <p><strong>Company:</strong> <?php echo htmlspecialchars($row['company']); ?></p>
          <p><strong>Deadline:</strong> <?php echo $row['deadline']; ?></p>
          <a href="apply_job.php?job_id=<?php echo $row['id']; ?>" class="btn">Apply Now</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No jobs available for this department right now.</p>
    <?php endif; ?>
  </section>
</main>

<?php include 'footer.php'; ?>
