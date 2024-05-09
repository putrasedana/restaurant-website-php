<?php include "partials/menu.php" ?>

<main class="bg-secondary-emphasis">
  <div class="container text-center py-5">
    <?php
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
    ?>
    <h1 class="mb-4 shadow-lg rounded py-3 mx-auto col-11 col-md-8">Dashboard</h1>

    <div class="row row-cols-1 row-cols-lg-3 px-4 gap-3 justify-content-center">
      <div class="col shadow-lg text-dark rounded py-3">
        <?php
        $sql = "SELECT * FROM tbl_category";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        ?>
        <h2><?php echo $count ?></h2>
        <a href="<?php SITEURL ?>manage-category.php" class="text-decoration-none text-dark fw-semibold">Categories</a>
      </div>
      <div class="col shadow-lg text-dark rounded py-3">
        <?php
        $sql2 = "SELECT * FROM tbl_food";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        ?>
        <h2><?php echo $count2 ?></h2>
        <a href="<?php SITEURL ?>manage-food.php" class="text-decoration-none text-dark fw-semibold">Foods</a>
      </div>
      <div class="col shadow-lg text-dark rounded py-3">
        <?php
        $sql3 = "SELECT * FROM tbl_order";
        $res3 = mysqli_query($conn, $sql3);
        $count3 = mysqli_num_rows($res3);
        ?>
        <h2><?php echo $count3 ?></h2>
        <a href="<?php SITEURL ?>manage-order.php" class="text-decoration-none text-dark fw-semibold">Total Orders</a>
      </div>
      <div class="col shadow-lg text-success rounded py-3">
        <?php
        $sql4 = "SELECT SUM(total) AS total FROM tbl_order WHERE status = 'Delivered'";
        $res4 = mysqli_query($conn, $sql4);
        $row = mysqli_fetch_assoc($res4);
        $total_revenue = $row['total'];
        ?>
        <h2>$<?php echo $total_revenue ?></h2>
        <div class="fw-semibold text-black">Revenue Generated</div>
      </div>
    </div>
  </div>
</main>

<?php include "partials/footer.php" ?>