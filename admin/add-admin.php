<?php include "partials/menu.php" ?>
<?php include "partials/super-check.php" ?>

<main class="bg-secondary-emphasis d-flex justify-content-center align-items-center" style="height: calc(100vh - 112px)">
  <div class="container row ">
    <div class="pb-4 col-12 col-sm-10 col-lg-8 col-xl-6 mx-auto rounded-3 shadow-lg px-0">
      <h2 class="text-center mb-4 py-3 bg-primary text-white rounded-top">Add Admin</h2>

      <?php
      if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }
      ?>

      <form action="" method="POST">
        <div class="row row-cols-1 justify-content-center mb-3 px-4">
          <div class="col col-sm-10 mb-3">
            <label for="full_name">Full Name:</label>
            <input type="text" class="form-control mt-2 border border-black" id="full_name" name="full_name" placeholder="Enter your name">
          </div>


          <div class="col col-sm-10 mb-3">
            <label for="username">Username:</label>
            <input type="text" class="form-control mt-2 border border-black" id="username" name="username" placeholder="Enter username">
          </div>

          <div class="col col-sm-10 mb-4">
            <label for="password">Password:</label>
            <input type="password" class="form-control mt-2 border border-black" id="password" name="password" placeholder="Enter password">
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-12 text-center">
            <input type="submit" value="Add Admin" name="submit" class="btn btn-primary">
            <a href="<?php SITEURL ?> manage-admin.php" class="btn btn-danger ">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

<?php include "partials/footer.php" ?>

<?php
if (isset($_POST['submit'])) {
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "INSERT INTO tbl_admin SET full_name = '$full_name', username = '$username', password = '$password'";
  $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  if ($res == true) {
    $_SESSION['add'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Admin added succuessfully</div>";
    header("location:" . SITEURL . "admin/manage-admin.php");
  } else {
    $_SESSION['add'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to add admin!</div>";
    header("location:" . SITEURL . "admin/add-admin.php");
  }
}
?>