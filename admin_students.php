<?php require_once __DIR__ . '/dp.php';?>
<?php
// Include your database connection
include 'dp.php';  // make sure dp.php defines $conn = new mysqli(...)

// Handle deletion
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM students WHERE id = $id");
    header("Location: admin_dashboard.php?page=students");
    exit();
}
?>

<h2>👨‍🎓 Student Management</h2>

<div class="table-container">
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Password</th>
      <th>Department</th>
      <th>Created At</th>
      <th>Action</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM students");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['dept']}</td>
                    <td>{$row['created_at']}</td>
                    <td><a class='delete-btn' href='admin_dashboard.php?page=students&id={$row['id']}'>Delete</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='no-data'>No students found.</td></tr>";
    }
    ?>
  </table>
</div>
