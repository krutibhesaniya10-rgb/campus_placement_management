<?php
require_once __DIR__ . '/dp.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
          if (isset($_POST['send_message']))
          {
            echo "<script>alert('✅ Your message has been sent successfully!');</script>";

        } else {
           echo "<script>alert('❌ Failed to send message. Please try again.');</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('⚠️ All fields are required!');</script>";
    }
  }
}
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" href="style.css">

<main class="contact-page">
  <section class="contact-hero">
    <div class="contact-hero-content">
      <h1>Contact Us</h1>
      <p>Have questions about campus placements? Reach out to us!</p>
    </div>
  </section>

  <section class="contact-container">
    <!-- Contact Form -->
    <div class="contact-form">
      <h3>📬 Send Us a Message</h3>
      <form id="contactForm" method="POST" action="">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name">

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email">

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" placeholder="Type your message..."></textarea>

        <button type="submit" name="send_message">📨 Send Message</button>
      </form>
    </div>

    <!-- Contact Info -->
    <div class="contact-info">
      <h3>📍 Our Office</h3>
      <p><strong>Address:</strong> Training & Placement Cell,<br> Concord Campus, California</p>
      <p><strong>Email:</strong> placement@concorduni.edu</p>
      <p><strong>Phone:</strong> +1 212 456 7890</p>
    </div>
  </section>
</main>

<script src="script.js"></script>
<?php include 'footer.php'; ?>

