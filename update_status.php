<?php
require_once __DIR__ . '/dp.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'];

    $stmt = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Application status updated successfully!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
