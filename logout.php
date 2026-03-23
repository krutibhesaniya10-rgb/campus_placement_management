<?php
session_start();

// Destroy all session data
$_SESSION = [];
session_unset();
session_destroy();

// Delete session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
<script>
    // Replace history so user can’t go back
    window.history.pushState(null, "", "login.php");
    window.onpopstate = function () {
        window.location.replace("login.php");
    };

    // Always redirect to login
    window.location.replace("login.php");
</script>
</head>
<body></body>
</html>
