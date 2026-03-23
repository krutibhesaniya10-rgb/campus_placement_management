
<?php
session_start();

// If already logged in → go to dashboards
if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] === 'student') {
        header("Location: index.php");
        exit();
    } elseif ($_SESSION['user_type'] === 'admin') {
        header("Location: admin_dashboard.php");
        exit();
    }
} else {
    // If not logged in → go to login page
    header("Location: login.php");
    exit();
}

?>

<?php
session_start();

// Prevent caching so browser doesn’t serve old content
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0");       // Proxies

// If user is not logged in, redirect to login page
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}
?>
