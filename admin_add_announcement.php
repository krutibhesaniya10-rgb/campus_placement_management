<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/dp.php';

// ✅ Require admin login
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO announcements (title, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $message);

    if ($stmt->execute()) {
        echo "<script>
                alert('✅ Announcement Added Successfully!');
                window.location.href = 'admin_announcements.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('❌ Error Adding Announcement!');
                window.location.href = 'admin_announcements.php';
              </script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Announcement</title>
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

<!-- ✅ Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
    <span class="toggle-icon">☰</span>
</button>

<!-- ✅ Main Content -->
<div class="content" id="mainContent">
    <div class="announcement-add-wrapper">
        <h2>➕ Add New Announcement</h2>
        <form method="POST" class="announcement-add-form">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit" class="announcement-add-btn">Add Announcement</button>
        </form>
    </div>
</div>

<script>
// ✅ Sidebar toggle logic (same as dashboard)
function toggleSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const content = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('sidebarToggle');

    sidebar.classList.toggle('collapsed');
    content.classList.toggle('expanded');
    toggleBtn.classList.toggle('shifted');

    // store state in localStorage
    const isCollapsed = sidebar.classList.contains('collapsed');
    localStorage.setItem('adminSidebarCollapsed', isCollapsed);
}

// ✅ Restore sidebar state on load
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
