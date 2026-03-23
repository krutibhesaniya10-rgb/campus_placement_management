<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/dp.php'; // database connection

// ✅ Require admin login
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// ✅ Handle delete request
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']); // safety

    $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('🗑 Announcement Deleted Successfully!');
                window.location.href = 'admin_announcements.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('❌ Error Deleting Announcement!');
                window.location.href = 'admin_announcements.php';
              </script>";
        exit;
    }
}

// ✅ Fetch all announcements
$sql = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Announcements</title>
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
    <a href="admin_dashboard.php?page=announcements" class="active">📢 Announcements</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- ✅ Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
    <span class="toggle-icon">☰</span>
</button>

<!-- ✅ Main Content -->
<div class="content" id="mainContent">
    <div class="announcement-container">
        <!-- Header -->
        <div class="announcement-header">
            <h1>📢 Manage Announcements</h1>
        </div>

        <!-- Add New -->
        <div style="padding:20px; text-align:center;">
            <a href="admin_add_announcement.php" class="btn-post">➕ Add New Announcement</a>
        </div>

        <!-- Announcement Feed -->
        <div class="announcement-feed">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="announcement-card">
                        <h3><?= htmlspecialchars($row['title']) ?></h3>
                        <p><?= htmlspecialchars($row['message']) ?></p>
                        <div class="date">
                            📅 <?= $row['created_at'] ?>
                        </div>
                        <br>
                        <a href="admin_announcements.php?delete_id=<?= $row['id'] ?>" 
                        onclick="return confirm('⚠ Are you sure you want to delete this announcement?');"
                        style="color:#dc2626; font-weight:bold; text-decoration:none;">
                            🗑 Delete
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="announcement-card">
                    <p>No announcements found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// ✅ Sidebar toggle logic (same as other admin pages)
function toggleSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const content = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('sidebarToggle');

    sidebar.classList.toggle('collapsed');
    content.classList.toggle('expanded');
    toggleBtn.classList.toggle('shifted');

    // store sidebar state
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
