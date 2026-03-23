<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/dp.php';

// ✅ Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ✅ Sidebar -->
<div class="sidebar" id="adminSidebar">
  <h2>Admin Menu</h2>
  <a href="admin_dashboard.php?page=reports">📊 Reports</a>
  <a href="admin_dashboard.php?page=jobs">💼 Manage Jobs</a>
  <a href="admin_dashboard.php?page=students">👨‍🎓 Students</a>
  <a href="admin_dashboard.php?page=applications">📂 Applications</a>
  <a href="admin_dashboard.php?page=announcements">📢 Announcements</a>
  <a href="logout.php">🚪 Logout</a>
</div>

<!-- ✅ Toggle Button for Sidebar -->
<button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
  <span class="toggle-icon">☰</span>
</button>

<!-- ✅ Main Content -->
<div class="content" id="mainContent">
  <?php
  // Default page = reports
  $page = isset($_GET['page']) ? $_GET['page'] : "reports";

  if ($page == "reports") {
      include "admin_reports.php";
  } elseif ($page == "jobs") {
      include "admin_jobs.php";
  } elseif ($page == "students") {
      include "admin_students.php";
  } elseif ($page == "applications") {
      include "admin_applications.php";
  } elseif ($page == "announcements") {
      include "admin_announcements.php";
  } else {
      include "admin_reports.php"; // fallback
  }
  ?>
  
</div>

<script>
// Toggle sidebar visibility
function toggleSidebar() {
  const sidebar = document.getElementById('adminSidebar');
  const content = document.getElementById('mainContent');
  const toggleBtn = document.getElementById('sidebarToggle');
  
  sidebar.classList.toggle('collapsed');
  content.classList.toggle('expanded');
  toggleBtn.classList.toggle('shifted');
  
  // Store the state in localStorage
  const isCollapsed = sidebar.classList.contains('collapsed');
  localStorage.setItem('adminSidebarCollapsed', isCollapsed);
}

// Restore sidebar state on page load
document.addEventListener('DOMContentLoaded', function() {
  const isCollapsed = localStorage.getItem('adminSidebarCollapsed') === 'true';
  if (isCollapsed) {
    document.getElementById('adminSidebar').classList.add('collapsed');
    document.getElementById('mainContent').classList.add('expanded');
    document.getElementById('sidebarToggle').classList.add('shifted');
  }
});
</script>

</body>
</html>
