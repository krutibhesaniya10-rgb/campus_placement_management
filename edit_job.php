<?php
require_once __DIR__ . '/dp.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();
    $job = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $company = $_POST['company'];
    $dept = $_POST['dept'];
    $deadline = $_POST['deadline'];

    $update = $conn->prepare("UPDATE jobs SET title=?, company=?, dept=?, deadline=? WHERE id=?");
    $update->bind_param("ssssi", $title, $company, $dept, $deadline, $id);

    if ($update->execute()) {
        echo "<script>alert('Job updated successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<link rel="stylesheet" href="style.css">

<main class="edit-job-page">
  <h2>Edit Job</h2>
  <form method="POST" action="edit_job.php">
    <input type="hidden" name="id" value="<?php echo $job['id']; ?>">

    <div class="form-group">
      <label>Job Title</label>
      <input type="text" name="title" value="<?php echo $job['title']; ?>" required>
    </div>

    <div class="form-group">
      <label>Company</label>
      <input type="text" name="company" value="<?php echo $job['company']; ?>" required>
    </div>

    <div class="form-group">
      <label>Department</label>
      <select name="dept" required>
        <option value="CSE" <?php if($job['dept']=="CSE") echo "selected"; ?>>CSE</option>
        <option value="ECE" <?php if($job['dept']=="ECE") echo "selected"; ?>>ECE</option>
        <option value="ME" <?php if($job['dept']=="ME") echo "selected"; ?>>ME</option>
        <option value="CE" <?php if($job['dept']=="CE") echo "selected"; ?>>CE</option>
        <option value="EE" <?php if($job['dept']=="EE") echo "selected"; ?>>EE</option>
        <option value="MBA" <?php if($job['dept']=="MBA") echo "selected"; ?>>MBA</option>
      </select>
    </div>

    <div class="form-group">
      <label>Deadline</label>
      <input type="date" name="deadline" value="<?php echo $job['deadline']; ?>" required>
    </div>

    <button type="submit" class="btn">Update Job</button>
  </form>
</main>


