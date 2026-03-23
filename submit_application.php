<?php
require_once __DIR__ . '/dp.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['student_id'])) {
        die("Please login first to apply.");
    }

    $student_id   = $_SESSION['student_id'];
    $job_title    = isset($_POST['job_title']) ? trim($_POST['job_title']) : '';
    $company_name = isset($_POST['company_name']) ? trim($_POST['company_name']) : '';

    // Basic validation
    if ($job_title === '' || $company_name === '') {
        die('Job title and company are required.');
    }

    // File Upload - basic validation: only allow PDF and limit size (2MB)
    $resume = null;
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $allowedMime = ['application/pdf'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['resume']['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, $allowedMime)) {
            die('Invalid file type. Only PDF resumes are allowed.');
        }

        if ($_FILES['resume']['size'] > 2 * 1024 * 1024) {
            die('File too large. Max 2MB allowed.');
        }

        $target_dir = __DIR__ . "/uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // create folder if not exist
        }
        $resume_filename = time() . "_" . preg_replace('/[^A-Za-z0-9._-]/', '_', basename($_FILES["resume"]["name"]));
        $target_file = $target_dir . $resume_filename;
        if (!move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
            die('Failed to move uploaded file.');
        }
        // Store relative path in DB
        $resume = 'uploads/' . $resume_filename;
    }

    // Prevent duplicate application (student cannot apply twice for same job title & company)
    $check = $conn->prepare("SELECT id FROM applications WHERE student_id = ? AND job_title = ? AND company_name = ?");
    $check->bind_param("iss", $student_id, $job_title, $company_name);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('⚠ You already applied for this job.'); window.location='placement_status.php';</script>";
        exit;
    }

    // Insert into applications
    $sql = $conn->prepare("INSERT INTO applications (student_id, job_title, company_name, resume, status) VALUES (?, ?, ?, ?, 'Pending')");
    $sql->bind_param("isss", $student_id, $job_title, $company_name, $resume);

    if ($sql->execute()) {
        echo "<script>alert('✅ Application submitted successfully!'); window.location='placement_status.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

