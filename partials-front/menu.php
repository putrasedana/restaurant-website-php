<?php include "./config/constants.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Website</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <style>
    .navbar-nav .nav-link.active {
      color: #ffc107 !important;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <!-- Brand / Logo -->
      <a class="navbar-brand fw-semibold" href="<?php echo SITEURL ?>">Nice Restaurant.</a>

      <!-- Toggler Button for Mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <?php
      $current_page = basename($_SERVER['PHP_SELF']);
      ?>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto text-center">
          <li class="nav-item">
            <a class="nav-link mx-2 text-white <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="<?php echo SITEURL ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 text-white <?php echo ($current_page == 'categories.php') ? 'active' : ''; ?>" href="<?php echo SITEURL ?>categories.php">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 text-white <?php echo ($current_page == 'foods.php') ? 'active' : ''; ?>" href="<?php echo SITEURL ?>foods.php">Food</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 text-white <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="<?php echo SITEURL ?>contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 btn btn-primary text-white" href="<?php echo SITEURL ?>admin/login.php">Login Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>