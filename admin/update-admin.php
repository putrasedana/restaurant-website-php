<?php include "partials/menu.php" ?>
<?php include "partials/super-check.php" ?>

<main class="bg-secondary-emphasis d-flex justify-content-center align-items-center" style="height: calc(100vh - 112px)">
  <div class="container row ">
    <div class="pb-4 col-12 col-sm-10 col-lg-8 col-xl-6 mx-auto rounded-3 shadow-lg px-0">
      <h2 class="text-center mb-4 py-3 bg-primary text-white rounded-top">Update Admin</h2>

      <?php
      $id = $_GET['id'];
      $sql = "SELECT * FROM tbl_admin WHERE id = $id";
      $res = mysqli_query($conn, $sql);

      if ($res == true) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
          $row = mysqli_fetch_assoc($res);
          $full_name = $row['full_name'];
          $username = $row['username'];
        } else header('location:' . SITEURL . "admin/manage-admin.php");
      }
      ?>

      <form action="" method="post">
        <div class="container">
          <div class="row justify-content-center mb-3">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label for="full_name" class="mb-1">Full Name:</label>
                <input type="text" class="form-control border border-black" id="full_name" name="full_name" value="<?php echo $full_name ?>">
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label for="username" class="mb-1">Username:</label>
                <input type="text" class="form-control border border-black" id="username" name="username" value="<?php echo $username ?>">
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-sm-5 text-center">
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <input type="submit" value="Update Admin" name="submit" class="btn btn-success">
              <a href="<?php SITEURL ?> manage-admin.php" class="btn btn-danger ">Cancel</a>
            </div>
          </div>

        </div>
    </div>
    </form>


  </div>
  </div>
</main>

<?php
if (isset($_POST['submit'])) {
  $id = $_POST['id'];
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];

  $sql = "UPDATE tbl_admin SET full_name = '$full_name', username = '$username' WHERE id = $id";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['update'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Admin updated succuessfully</div>";
    header("location:" . SITEURL . "admin/manage-admin.php");
  } else {
    $_SESSION['update'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to update admin!</div>";
    header("location:" . SITEURL . "admin/manage-admin.php");
  }
}
?>

<?php include "partials/footer.php" ?>