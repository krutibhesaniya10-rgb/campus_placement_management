<?php
// Database connection (dp.php)
// Use safe defaults for XAMPP; change credentials as appropriate in production
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host = "localhost";
$user = "root"; // default for XAMPP
$pass = "";     // default is empty
$dbname = "CPMS";

try {
    $conn = new mysqli($host, $user, $pass, $dbname);
    // Ensure UTF-8 charset
    $conn->set_charset('utf8mb4');
} catch (Exception $e) {
    // Fail early with a clear message for local dev. In production, log instead.
    die('Database connection error: ' . $e->getMessage());
}

// Update application status queries
$updateAccepted = "UPDATE applications SET status = 'Accepted' WHERE id = ?";
$updateRejected = "UPDATE applications SET status = 'Rejected' WHERE id = ?";
$updatePending = "UPDATE applications SET status = 'Pending' WHERE id = ?";
?>
