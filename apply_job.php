<?php include 'header.php'; ?>
<link rel="stylesheet" href="style.css">

<main class="apply-job-page">
  <section class="apply-intro">
    <h2>Apply for Job</h2>
    <p>Fill in your details to apply for the selected job.</p>
  </section>

  <section class="apply-form-section">
    <form action="submit_application.php" method="POST" enctype="multipart/form-data" class="apply-form" onsubmit="return validateApplyForm()">
      
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="department">Department</label>
      <select id="department" name="department" required>
        <option value="">-- Select Department --</option>
        <option value="CSE">Computer Science</option>
        <option value="ECE">Electronics</option>
        <option value="ME">Mechanical</option>
        <option value="CE">Civil</option>
        <option value="EE">Electrical</option>
        <option value="MBA">MBA</option>
      </select>

      <!-- Job Title -->
      <label for="job_title">Job Title</label>
      <input type="text" id="job_title" name="job_title" placeholder="Enter Job Title" required>

      <!-- Company Name -->
      <label for="company_name">Company Name</label>
      <input type="text" id="company_name" name="company_name" placeholder="Enter Company Name" required>

      <label for="resume">Upload Resume (PDF)</label>
      <input type="file" id="resume" name="resume" accept=".pdf" required>

      <button type="submit" class="btn-submit">Submit Application</button>
    </form>
  </section>
</main>

<script src="script.js"></script>
<?php include 'footer.php'; ?>
