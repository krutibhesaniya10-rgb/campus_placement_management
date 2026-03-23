<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">
  <div class="logo">
      <img src="image/logoo1.PNG" width="60" height="60" alt="Logo">
  </div>
  <div class="title">
      Campus Placement Management System
  </div>

  <nav class="nav">
      <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="departments.php">Department</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="apply_job.php">Apply Job</a></li>
          <li><a href="placement_status.php">Placement Status</a></li>
          <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get username from session (student or admin)
if(isset($_SESSION['student_name'])){
    $username = $_SESSION['student_name'];
} elseif(isset($_SESSION['admin_name'])){
    $username = $_SESSION['admin_name'];
} else {
    $username = "User"; // fallback if no session
}

// Get first letter and capitalize
$firstLetter = strtoupper(substr($username, 0, 1));
?>

<!-- Profile Circle with Dropdown -->
<div class="profile-container">
  <div class="profile-circle" onclick="toggleDropdown()">
    <?php echo $firstLetter; ?>
  </div>
  <div class="dropdown-menu" id="profileDropdown">
    <a href="student_profile.php">✏ Edit Profile</a>
    <a href="logout.php" class="logout-link">🚪 Logout</a>
  </div>
</div>


<script>
  function toggleDropdown() {
    const dropdown = document.getElementById("profileDropdown");
    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
  }

  // Close dropdown if clicked outside
  document.addEventListener("click", function(event) {
    const profile = document.querySelector(".profile-container");
    if (!profile.contains(event.target)) {
      document.getElementById("profileDropdown").style.display = "none";
    }
  });
</script>

</header>
