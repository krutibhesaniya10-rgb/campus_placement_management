
<?php
// about.php - About Us Page for Campus Placement Management System
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Campus Placement Management System</title>
  <link rel="stylesheet" href="style.css">
  
</head>
<body>

  <?php include('header.php'); ?>

  <!-- About -->
  <!-- Hero Section -->
<section class="about-hero">
  <h1>About Us</h1>
  <p>Empowering Students • Connecting Careers • Building Futures</p>
</section>

<!-- Info Section -->
<section class="about-info">
  <div class="info-card">
    <i class="fas fa-users"></i>
    <h2>Who We Are</h2>
    <p>Our Campus Placement Management System (CPMS) bridges the gap between students, recruiters, and placement cells with a one-stop platform.</p>
  </div>

  <div class="info-card">
    <i class="fas fa-bullseye"></i>
    <h2>Our Mission</h2>
    <p>To provide a reliable and user-friendly system that connects students with opportunities and supports recruiters with data-driven insights.</p>
  </div>

  <div class="info-card">
    <i class="fas fa-lightbulb"></i>
    <h2>Our Vision</h2>
    <p>To make campus recruitment efficient, transparent, and accessible for every student and recruiter.</p>
  </div>
</section>

<!-- Meet Our Team -->
<section class="team">
  <h2>Meet Our Team</h2>
  <div class="team-container">
    <div class="team-card">
      <img src="image/team1.JPEG" alt="Student A">
      <h3>Aarohi Mehta</h3>
      <p>Frontend Developer – Designed interactive UI.</p>
    </div>
    <div class="team-card">
      <img src="image/team3.JPG" alt="Student B">
      <h3>Rohan Patel</h3>
      <p>Backend Developer – Built APIs and workflows.</p>
    </div>
    <div class="team-card">
      <img src="image/team2.JPG" alt="Student C">
      <h3>Isha Desai</h3>
      <p>Database Manager – Optimized MySQL database.</p>
    </div>
    <div class="team-card">
      <img src="image/team4.JPG" alt="Student D">
      <h3>Vikram Sharma</h3>
      <p>Project Lead – Managed team & modules.</p>
    </div>
  </div>
</section>

<!-- Contact -->
<section class="contact">
  <h2>Contact Us</h2>
  <p><i class="fas fa-envelope"></i> concordplacement@college.edu</p>
  <p><i class="fas fa-phone"></i> +91 99999 99999</p>
  <p><i class="fas fa-map-marker-alt"></i> Placement Cell, Concord University</p>
</section>



</body>
</html>
<?php include 'footer.php'; ?>
