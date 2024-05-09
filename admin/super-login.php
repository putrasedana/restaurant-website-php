<?php include "../config/constants.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Restaurant Website System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh;">
      <?php
      if (isset($_SESSION['no-login-message'])) {
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
      }

      if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
      }
      ?>
      <div class="rounded-3 shadow-lg pb-3 col-md-9 col-lg-7 col-xl-5">
        <h2 class="text-center mb-4 py-4 bg-primary text-white rounded-top">Login Super Admin</h2>

        <form action="" method="POST" class="px-4">

          <div class="row justify-content-center">
            <div class="form-group mb-3 col-12 col-md-10">
              <label class="mb-2" for="username">Username:</label>
              <input type="text" class="form-control border border-black" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <div class="form-group mb-4 col-12 col-md-10">
              <label class="mb-2" for="password">Password:</label>
              <input type="password" class="form-control border border-black" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="mb-4 col-12 col-md-10 d-flex justify-content-evenly gap-2">
              <input type="submit" value="Login" class="btn btn-primary w-50" name="submit">
              <a href="<?php SITEURL ?>index.php" class="btn btn-danger w-50">Cancel</a>
            </div>
          </div>
        </form>

        <p class="text-center">Created by - <a href="#" class="text-decoration-none">Ayam Goreng</a></p>
      </div>
    </div>
  </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
  $res = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($res);

  if ($count == 1) {
    $_SESSION['login'] = "<div class='alert text-center fs-5 alert-success mt-4'>Login successful.</div>";
    $_SESSION['super-user'] = $username;
    header("location:" . SITEURL . "admin/manage-admin.php");
  } else {
    $_SESSION['login'] = "<div class='alert text-center fs-5 alert-danger col-12'>Username or password did not match!</div>";
    header("location:" . SITEURL . "admin/super-login.php");
  }
}
?>