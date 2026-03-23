<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/dp.php'; // adjust if your DB file is elsewhere

// require admin login
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// CSRF token for admin actions
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
}

// Handle accept/reject POST action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['action'], $_POST['token'])) {
  // verify admin session and CSRF token
  if (!isset($_SESSION['admin_id']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) {
    http_response_code(400);
    die('Invalid request');
  }

  $id = (int) $_POST['id'];
  $action = $_POST['action'];
  $allowed = ['Accepted', 'Rejected', 'Pending'];
  if (!in_array($action, $allowed, true)) {
    $_SESSION['flash'] = 'Invalid action specified.';
    header('Location: admin_applications.php');
    exit;
  }

  $update = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
  if ($update) {
    $update->bind_param('si', $action, $id);
    if ($update->execute()) {
      $_SESSION['flash'] = "Application #$id updated to $action.";
    } else {
      $_SESSION['flash'] = 'Failed to update application status.';
    }
    $update->close();
  } else {
    $_SESSION['flash'] = 'Prepare failed: ' . $conn->error;
  }

  header('Location: admin_dashboard.php');
  exit();
}


// fetch applications (applications contains job_title and company)
$sql = "SELECT a.id, s.name AS student_name, s.email, s.dept, 
         a.job_title, a.company_name, a.resume, a.status
    FROM applications a
    JOIN students s ON a.student_id = s.id
    ORDER BY a.id DESC";

$result = $conn->query($sql);
if (!$result) {
  die("Query Error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Applications</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="admin-container">
  <header class="admin-header">
    <h1>📂 Job Applications Management</h1>
  </header>
  

  <main class="admin-main">
    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="flash"><?php echo htmlspecialchars($_SESSION['flash']); ?></div>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

  <div class="table-container">
    <table class="applications-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Student Name</th>
          <th>Email</th>
          <th>Department</th>
          <th>Job Title</th>
          <th>Company</th>
          <th>Resume</th>
          <th>Action</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): 
              // safe values
              $id           = (int) $row['id'];
              $student_name = htmlspecialchars($row['student_name']);
              $email        = htmlspecialchars($row['email']);
              $dept         = htmlspecialchars($row['dept']);
              $job_title    = htmlspecialchars($row['job_title']);
              $company      = htmlspecialchars($row['company_name']);
              $resumeFile   = $row['resume']; // raw filename from DB
              $status       = htmlspecialchars($row['status']);

              // full path check for uploaded resume
              $resumePath = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $resumeFile;
        ?>
        <tr>
          <td><?php echo $id; ?></td>
          <td><?php echo $student_name; ?></td>
          <td><?php echo $email; ?></td>
          <td><?php echo $dept; ?></td>
          <td><?php echo $job_title; ?></td>
          <td><?php echo $company; ?></td>
          <td>
            <?php if (!empty($resumeFile) && file_exists($resumePath)): ?>
              <a class="resume-link" href="<?php echo 'uploads/' . rawurlencode($resumeFile); ?>" target="_blank">View Resume</a>
            <?php else: ?>
              <span class="no-resume">No Resume Uploaded</span>
            <?php endif; ?>
          </td>
          <td>
            <div class="action-buttons">
              <form method="POST" style="display:inline-block;">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="action" value="Accepted" />
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>" />
                <button class="btn accept" type="submit" title="Accept Application #<?php echo $id; ?>" onclick="return confirm('Accept this application?');">✓ Accept</button>
              </form>
              <form method="POST" style="display:inline-block;">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="action" value="Rejected" />
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>" />
                <button class="btn reject" type="submit" title="Reject Application #<?php echo $id; ?>" onclick="return confirm('Reject this application?');">✗ Reject</button>
              </form>
            </div>
          </td>
          <td><span class="status <?php echo $status; ?>"><?php echo $status; ?></span></td>

        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="9" class="no-data">No applications found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
    </div>
  </main>
</div>

</body>
</html>
