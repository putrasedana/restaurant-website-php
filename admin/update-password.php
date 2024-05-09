<?php include "partials/menu.php" ?>
<?php include "partials/super-check.php" ?>

<main class="bg-secondary-emphasis d-flex justify-content-center align-items-center" style="height: calc(100vh - 112px)">
  <div class="container row">
    <div class="pb-4 col-12 col-sm-10 col-lg-8 col-xl-6 mx-auto rounded-3 shadow-lg px-0">
      <h2 class="text-center mb-4 py-3 bg-primary text-white rounded-top">Change Password</h2>

      <?php $id = $_GET['id']; ?>

      <form action="" method="post">
        <div class="container">
          <div class="row justify-content-center mb-3">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label for="current_password" class="mb-2">Old Password:</label>
                <input type="password" class="form-control border border-black" id="current_password" name="current_password" placeholder="Old Password">
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-3">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label for="new_password" class="mb-2">New Password:</label>
                <input type="password" class="form-control border border-black" id="new_password" name="new_password" placeholder="New Password">
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label for="confirm_password" class="mb-2">Confirm Password:</label>
                <input type="password" class="form-control border border-black" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-3">
            <div class="col-12">
              <div class="form-group text-center">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" value="Change Password" name="submit" class="btn btn-primary">
                <a href="<?php SITEURL ?> manage-admin.php" class="btn btn-danger">Cancel</a>
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
  $current_password = md5($_POST['current_password']);
  $new_password = md5($_POST['new_password']);
  $confirm_password = md5($_POST['confirm_password']);

  $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {

      if ($new_password == $confirm_password) {
        $sql2 = "UPDATE tbl_admin SET password = '$new_password' WHERE id = $id";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
          $_SESSION['change-pwd'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Password changed successfully.</div>";
          header("location:" . SITEURL . "admin/manage-admin.php");
        } else {
          $_SESSION['change-pwd'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to change password!</div>";
          header("location:" . SITEURL . "admin/manage-admin.php");
        }
      } else {
        $_SESSION['pwd-not-match'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Password did not match!</div>";
        header("location:" . SITEURL . "admin/manage-admin.php");
      }
    } else {
      $_SESSION['user-not-found'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>User not found.</div>";
      header("location:" . SITEURL . "admin/manage-admin.php");
    }
  }
}
?>

<?php include "partials/footer.php" ?>