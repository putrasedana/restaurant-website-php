<?php include "partials/menu.php" ?>
<?php include "partials/super-check.php" ?>

<main class="min-vh-100">
  <div class="container py-5">
    <h1 class="text-center">Manage Admin</h1>

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    if (isset($_SESSION['user-not-found'])) {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }

    if (isset($_SESSION['pwd-not-match'])) {
      echo $_SESSION['pwd-not-match'];
      unset($_SESSION['pwd-not-match']);
    }

    if (isset($_SESSION['change-pwd'])) {
      echo $_SESSION['change-pwd'];
      unset($_SESSION['change-pwd']);
    }

    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }

    ?>

    <a href="add-admin.php" class="btn btn-primary my-3">Add Admin</a>

    <div class="table-responsive">
      <table class="table mx-auto text-center" style="min-width: 600px;">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
          $sql = "SELECT * FROM tbl_admin";
          $res = mysqli_query($conn, $sql);
          $sn = 1;

          if ($res == true) {
            $count = mysqli_num_rows($res);

            if ($count > 0) {
              while ($rows = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $full_name = $rows['full_name'];
                $username = $rows['username'];
          ?>
                <tr>
                  <td><?php echo $sn++ ?>.</td>
                  <td><?php echo $full_name ?></td>
                  <td><?php echo $username ?></td>
                  <td>
                    <a href="<?php echo SITEURL ?>admin/update-password.php?id=<?php echo $id ?>" class="btn btn-primary my-1">Change Password</a>
                    <a href="<?php echo SITEURL ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn btn-success my-1">Update</a>
                    <a href="<?php echo SITEURL ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn btn-danger my-1">Delete</a>
                  </td>
                </tr>
              <?php
              }
            } else {
              ?>
              <tr>
                <td colspan="4" class="text-center">No data available</td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>
</main>

<?php include "partials/footer.php" ?>