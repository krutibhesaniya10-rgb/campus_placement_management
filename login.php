<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/dp.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginInput = $_POST['email']; // can be email or name
    $password = $_POST['password'];
    $role = $_POST['role']; // student or admin

    if ($role === "student") {
        // Fetch user by email or name
        $sql = "SELECT * FROM students WHERE email = ? OR name = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $loginInput, $loginInput);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $stored = $user['password'];

            // If stored password is hashed (recommended), use password_verify
            if (password_verify($password, $stored)) {
                // Good: authenticated
                $_SESSION['student_id'] = $user['id'];
                $_SESSION['student_name'] = $user['name'];
                header("Location: home.php");
                exit;
            }

            // Migration fallback: if passwords are stored in plaintext, compare and re-hash
            if ($stored === $password) {
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE students SET password = ? WHERE id = ?");
                if ($update) {
                    $update->bind_param('si', $newHash, $user['id']);
                    $update->execute();
                }
                $_SESSION['student_id'] = $user['id'];
                $_SESSION['student_name'] = $user['name'];
                header("Location: home.php");
                exit;
            }
        }

        echo "<script>alert('Invalid email/username or password');</script>";
    } else {
        // Admin login - assume admin passwords are hashed as well
        $sql = "SELECT * FROM admin WHERE username = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $loginInput);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $stored = $user['password'];
            if (password_verify($password, $stored) || $stored === $password) {
                // Optional: re-hash plaintext admin password similarly
                if ($stored === $password) {
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $update = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
                    if ($update) {
                        $update->bind_param('si', $newHash, $user['id']);
                        $update->execute();
                    }
                }
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_name'] = $user['username'];
                header("Location: admin_dashboard.php");
                exit;
            }
        }

        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - CPMS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login_page">


    <div class="login_formcontainer">
        <h2>Login</h2>
        <form method="POST">
            <label for="role">Login as:</label>
            <select name="role" required>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>

            <input type="text" name="email" placeholder="Email / Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <div class="login_extralinks">
            <p>Not registered yet? <a href="student_register.php">Register as Student</a></p>
        </div>
    </div>

</body>
</html>
