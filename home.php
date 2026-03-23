<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <?php include __DIR__ . '/header.php'; ?>

    <!-- Hero Section -->
<section class="hero">
  <div class="hero-overlay">
    <div class="hero-content">
      <span class="quote-mark">“</span>
      <p id="slogan"></p>
      <span class="quote-mark">”</span>
    </div>
  </div>
</section>



    <!-- Features Section -->
<!-- Features Section -->
   <div class="container">
    <div class="placement-row">
      <div class="placement-card">
        <img src="image/1.PNG" alt="Placement Drive" />
        <h3>Placement Drive and Invitation</h3>
        <p>
          Enable quick communication with companies that visit your campus,
          organize placement events & trainings. Training and Placement portal
          for registration process.
        </p>
      </div>

      <div class="placement-card">
        <img src="image/2.PNG" alt="Placement Notices" />
        <h3>Placement Notices and Circulars</h3>
        <p>
          Notice regarding placement drives, registration process, eligibility
          criteria. Students can check all this through e-Notice board.
        </p>
      </div>

      <div class="placement-card">
        <img src="image/3.PNG" alt="Placement Registration" />
        <h3>Placement Registration</h3>
        <p>
          Online portal where students can register for placement drive also can
          upload resume and other documents.
        </p>
      </div>

      <div class="placement-card">
        <img src="image/4.PNG" alt="Student Academic Data" />
        <h3>Student Academic Data</h3>
        <p>
          Student performance analysis, track number of students got placed in a
          particular academic year.
        </p>
      </div>

      <div class="placement-card">
        <img src="image/5.PNG" alt="Industrial Training" />
        <h3>Industrial Training</h3>
        <p>Record, evaluate and track the industrial training provided to the students.</p>
      </div>

      <div class="placement-card">
        <img src="image/6.PNG" alt="Industry Training Project" />
        <h3>Industry Training Project Report</h3>
        <p>Students can submit project reports online...</p>
      </div>

      <div class="placement-card">
        <img src="image/7.PNG" alt="Resume Upload" />
        <h3>Resume and Other Documents</h3>
        <p>A centralized portal for students to upload resumes, certificates...</p>
      </div>

      <div class="placement-card">
        <img src="image/8.PNG" alt="Company Profiles" />
        <h3>Company Profiles & Eligibility Criteria</h3>
        <p>Get detailed information about upcoming companies...</p>
      </div>

      <div class="placement-card">
        <img src="image/9.PNG" alt="Dashboard Analytics" />
        <h3>Dashboard & Analytics</h3>
        <p>Real-time dashboards provide insights with graphs and charts...</p>
      </div>
    </div>
  </div>

<br><br><br>

    <!-- Companies Section -->
<section class="companies-wrapper">
    <div class="companies">
      <h2>OUR RECRUITERS</h2>

      <div class="Clogo">
        <!-- Use forward slashes in paths -->
        <img src="image/google.PNG" alt="Google">
        <img src="image/amazon.PNG" alt="Amazon">
        <img src="image/microsoft.PNG" alt="Microsoft">
        <img src="image/oracle.PNG" alt="Oracle">
        <img src="image/TCL.PNG" alt="TCL">
        <img src="image/wipro.PNG" alt="Wipro">
        <img src="image/infosyc.PNG" alt="Infosys">
        <img src="image/HCL.PNG" alt="HCL">
        <img src="image/tech.PNG" alt="Tech Mahindra">
      </div>
    </div>
  </section>


    <br> <br>

    <!-- Stats Section -->
  <section class="support-stats-container">
    <div class="support-stat">
      <h2 class="support-counter" data-target="750">0</h2>
      <p>Student Placement</p>
    </div>
    <div class="support-stat">
      <h2 class="support-counter" data-target="70">0</h2>
      <p>Companies</p>
    </div>
    <div class="support-stat">
      <h2 class="support-counter" data-target="3000">0</h2>
      <p>Student Join us</p>
    </div>
  </section>


<!-- Notifaction -->

<br><br><br>
<div class=notification_p>Notifications</div>
<?php
require_once __DIR__ . '/dp.php';  // DB connection

// Fetch announcements for notifications
$sql = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);

// Store announcements in array
$announcements = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $announcements[] = $row;
  }
}
?>
<div class="notification-wrapper">
  <div class="notification-container">
    <?php 
    // Output announcements twice for seamless scroll effect
    for ($i=0; $i<2; $i++) {
      foreach ($announcements as $announcement) {
        echo '<div class="notification">';
        // You can choose an emoji here, or store emoji in DB
        echo '📢 ';  
        echo htmlspecialchars($announcement['title']) . ':<br> ';
        echo htmlspecialchars($announcement['message']);
        echo '</div>';
      }
    }
    ?>
  </div>
</div>


</body>
<script src="script.js"></script>
</html>
  <?php include 'footer.php'; ?>

