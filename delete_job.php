<?php
require_once __DIR__ . '/dp.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = $conn->prepare("DELETE FROM jobs WHERE id=?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        echo "<script>alert('Job deleted successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
