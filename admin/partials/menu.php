<?php
include "../config/constants.php";
include "login-check.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Website - Home Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark" data-bs-theme="dark">
    <div class="container col-md-6 mx-auto">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
          <a class="nav-link" href="index.php">Home</a>
          <a class="nav-link" href="manage-admin.php">Admin</a>
          <a class="nav-link" href="manage-category.php">Category</a>
          <a class="nav-link" href="manage-food.php">Food</a>
          <a class="nav-link" href="manage-order.php">Order</a>
          <a class="nav-link" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </nav>