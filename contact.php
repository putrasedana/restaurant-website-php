<?php include "./partials-front/menu.php" ?>

<section id="contact" class="py-5 bg-body-tertiary">
  <div class="container">
    <div class="row px-2">
      <div class="col-12 col-sm-9 col-lg-7 col-xl-6 bg-dark text-white rounded py-5 mx-auto">
        <h2 class="text-center mb-4 text-warning">Contact Us</h2>
        <form action="" method="post" class="col-12 col-sm-10 mx-auto">
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
          <button type="submit" class="btn btn-warning w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include "./partials-front/footer.php" ?>