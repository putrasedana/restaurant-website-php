<?php include "./partials-front/menu.php" ?>

<section id="about" class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <img src="<?php echo SITEURL ?>images/restaurant-img.jpg" alt="Nice Restaurant" style="width: 100%; object-fit: cover; height: 400px;" class="img-fluid rounded shadow">
      </div>
      <div class="col-lg-6 text-center text-lg-start mt-4 mt-lg-0 ps-4">
        <h2 class="fw-bold">About Us</h2>
        <p class="lead">Nice Restaurant menghadirkan pengalaman kuliner yang tak terlupakan dengan sajian berkualitas tinggi, bahan segar, dan suasana yang nyaman. Setiap hidangan dibuat dengan penuh perhatian oleh koki berpengalaman, menghadirkan cita rasa autentik yang memanjakan lidah.
        </p>
        <p>Sejak berdiri, kami berkomitmen untuk memberikan pelayanan terbaik dan cita rasa yang autentik. Kunjungi kami dan rasakan kelezatan setiap hidangan.</p>
      </div>
    </div>
  </div>
</section>

<section id="contact" class="py-5 bg-body-tertiary">
  <?php
  if (isset($_POST['submit'])) {
    header("location:" . SITEURL . "contact.php");
  }
  ?>

  <?php
  if (isset($_SESSION['feedback'])) {
    echo $_SESSION['feedback'];
    unset($_SESSION['feedback']);
  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
        <h2 class="fw-bold">Get in Touch</h2>
        <p class="lead">Kami siap mendengar dari Anda! Hubungi kami untuk reservasi atau pertanyaan lebih lanjut.</p>
        <p><i class="fas fa-map-marker-alt me-2"></i>ℹ️ 123 Food Street, Jakarta, Indonesia</p>
        <p><i class="fas fa-phone me-2"></i>☎️ +62 812 3456 7890</p>
        <p><i class="fas fa-envelope me-2"></i>📩 contact@nicerestaurant.com</p>
      </div>

      <div class="col-lg-6">
        <h2 class="text-center mb-4 fw-bold">Send Us Feedback</h2>
        <form action="" method="post">
          <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-4">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-warning w-100">Submit</button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php
if (isset($_POST['submit'])) {
  // Retrieve input values from form
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  // SQL query to insert feedback into database
  $sql = "INSERT INTO tbl_feedback (name, email, message) VALUES ('$name', '$email', '$message')";

  // Execute query
  $res = mysqli_query($conn, $sql);

  if ($res) {
    $_SESSION['feedback'] = "<div class='alert fs-5 mx-auto col-10 alert-success text-center'>Feedback submitted successfully!</div>";
  } else {
    $_SESSION['feedback'] = "<div class='alert fs-5 mx-auto col-10 alert-danger text-center'>Failed to submit feedback. Please try again.</div>";
  }
}
?>

<?php include "./partials-front/footer.php" ?>