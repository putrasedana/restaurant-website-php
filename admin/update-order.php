<?php include "partials/menu.php" ?>

<?php
if (isset($_POST['submit'])) {
  header("location:" . SITEURL . "admin/manage-order.php");
}
?>

<main class="bg-secondary-emphasis d-flex justify-content-center align-items-center py-5">
  <div class="container row">
    <div class="pb-4 col-12 col-lg-10 col-xl-8 mx-auto rounded-3 shadow-lg px-0">
      <h2 class="text-center mb-4 py-3 bg-primary text-white rounded-top">Update Order</h2>

      <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_order WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count == 1) {
          $row = mysqli_fetch_assoc($res);
          $food = $row['food'];
          $price = $row['price'];
          $qty = $row['qty'];
          $status = $row['status'];
          $customer_name = $row['customer_name'];
          $customer_contact = $row['customer_contact'];
          $customer_email = $row['customer_email'];
          $customer_address = $row['customer_address'];
        } else header('location:' . SITEURL . "admin/manage-admin.php");
      } else header('location:' . SITEURL . "admin/manage-admin.php");
      ?>

      <form action="" method="post">
        <div class="container">

          <div class="row justify-content-center">
            <div class="col-md-6 px-4">
              <div class="form-group mb-3">
                <label class="mb-1" for="food">Food Name:</label>
                <input type="text" class="form-control border border-black" id="food" value="<?php echo $food ?>" readonly>
              </div>
              <div class="form-group mb-3">
                <label class="mb-1" for="price">Price:</label>
                <input type="text" class="form-control border border-black" id="price" value="$<?php echo $price ?>" readonly>
              </div>
              <div class="form-group mb-3">
                <label class="mb-1" for="qty">Qty:</label>
                <input type="number" class="form-control border border-black" id="qty" name="qty" value="<?php echo $qty ?>">
              </div>
              <div class="form-group mb-3">
                <label class="mb-1" for="status">Status:</label>
                <select class="form-control border border-black" id="status" name="status">
                  <option <?php if ($status == "Ordered") echo "selected" ?> value="Ordered">Ordered</option>
                  <option <?php if ($status == "On Delivery") echo "selected" ?> value="On Delivery">On Delivery</option>
                  <option <?php if ($status == "Delivered") echo "selected" ?> value="Delivered">Delivered</option>
                  <option <?php if ($status == "Cancelled") echo "selected" ?> value="Cancelled">Cancelled</option>
                </select>
              </div>
            </div>

            <div class="col-md-6 px-4">
              <div class="form-group mb-3">
                <label class="mb-1" for="customer_name">Customer Name:</label>
                <input type="text" class="form-control border border-black" id="customer_name" name="customer_name" value="<?php echo $customer_name ?>">
              </div>
              <div class="form-group mb-3">
                <label class="mb-1" for="customer_contact">Customer Contact:</label>
                <input type="text" class="form-control border border-black" id="customer_contact" name="customer_contact" value="<?php echo $customer_contact ?>">
              </div>
              <div class="form-group mb-3">
                <label class="mb-1" for="customer_email">Customer Email:</label>
                <input type="text" class="form-control border border-black" id="customer_email" name="customer_email" value="<?php echo $customer_email ?>">
              </div>
              <div class="form-group mb-4">
                <label class="mb-1" for="customer_address">Customer Address:</label>
                <textarea class="form-control border border-black" id="customer_address" name="customer_address" rows="3"><?php echo $customer_address ?></textarea>
              </div>
            </div>
          </div>

          <div class="row text-center">
            <div class="col-12">
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <input type="hidden" name="price" value="<?php echo $price ?>">
              <input type="submit" value="Update Order" name="submit" class="btn btn-success">
              <a href="<?php SITEURL ?> manage-order.php" class="btn btn-danger ">Cancel</a>
            </div>
          </div>
        </div>
      </form>


      <?php
      if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $qty * $price;
        $status = $_POST['status'];
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];

        $sql2 = "UPDATE tbl_order SET qty = $qty, total = $total, status = '$status', customer_name = '$customer_name', customer_contact = '$customer_contact', customer_email = '$customer_email', customer_address = '$customer_address' WHERE id = $id";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
          $_SESSION['update'] = "<div class='alert text-center fs-5 alert-success'>Order updated succuessfully</div>";
          header("location:" . SITEURL . "admin/manage-order.php");
        } else {
          $_SESSION['update'] = "<div class='alert text-center fs-5 alert-danger'>Failed to update order!</div>";
          header("location:" . SITEURL . "admin/manage-order.php");
        }
      }
      ?>

    </div>
  </div>
</main>

<?php include "partials/footer.php" ?>