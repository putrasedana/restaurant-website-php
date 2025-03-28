<?php include "partials/menu.php" ?>

<main class="bg-light min-vh-100">
  <div class="container text-center pt-5">
    <?php
    if (isset($_SESSION['login'])) {
      echo  $_SESSION['login'];
      unset($_SESSION['login']);
    }
    ?>

    <h1 class="text-center pb-5">
      Dashboard
    </h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
      <!-- Categories -->
      <div class="col">
        <a href="<?php echo SITEURL ?>admin/manage-category.php" class="text-decoration-none fw-semibold text-dark">
          <div class="card shadow-sm border-0 rounded text-center p-3">
            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            ?>
            <div class="card-body">
              <h2 class="fw-semibold"> <?php echo $count; ?></h2>
              <p class="text-decoration-none fw-semibold text-dark">Categories</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Foods -->
      <div class="col">
        <a href="<?php echo SITEURL ?>admin/manage-food.php" class="text-decoration-none fw-semibold text-dark">
          <div class="card shadow-sm border-0 rounded text-center p-3">
            <?php
            $sql2 = "SELECT * FROM tbl_food";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            ?>
            <div class="card-body">
              <h2 class="fw-semibold"> <?php echo $count2; ?></h2>
              <p class="text-decoration-none fw-semibold text-dark">Foods</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Orders -->
      <div class="col">
        <a href="<?php echo SITEURL ?>admin/manage-order.php" class="text-decoration-none fw-semibold text-dark">
          <div class="card shadow-sm border-0 rounded text-center p-3">
            <?php
            $sql3 = "SELECT * FROM tbl_order";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
            ?>
            <div class="card-body">
              <h2 class="fw-semibold"><?php echo $count3; ?></h2>
              <p class="text-decoration-none fw-semibold text-dark">Total Orders</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Revenue -->
      <div class="col">
        <div class="card shadow-sm border-0 rounded text-center p-4 bg-success text-white">
          <?php
          $sql4 = "SELECT SUM(total) AS total FROM tbl_order WHERE status = 'Delivered'";
          $res4 = mysqli_query($conn, $sql4);
          $row = mysqli_fetch_assoc($res4);
          $total_revenue = $row['total'] ? $row['total'] : '0';
          ?>
          <div class="card-body">
            <h2 class="fw-semibold">$<?php echo $total_revenue; ?></h2>
            <div class="fw-semibold">Revenue Generated</div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="container my-5 bg-white px-4 pt-4 mb-5 shadow-sm">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="mb-4">Latest User's Feedbacks</h3>
      <a href="<?php echo SITEURL ?>admin/manage-feedback.php" class="underline text-dark mb-4">See all feedbacks ></a>
    </div>

    <?php
    $sql = "SELECT * FROM tbl_feedback ORDER BY id DESC LIMIT 4";
    $res = mysqli_query($conn, $sql);
    include "partials/feedback-grid.php"
    ?>

    <?php
    if (isset($_POST['delete'])) {
      $delete_id = $_POST['delete_id'];
      $delete_sql = "DELETE FROM tbl_feedback WHERE id = $delete_id";
      $delete_res = mysqli_query($conn, $delete_sql);

      if ($delete_res) {
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
      } else {
        echo "<script>alert('Failed to delete feedback!');</script>";
        exit();
      }
    }
    ?>

  </div>
</main>


<?php include "partials/footer.php" ?>