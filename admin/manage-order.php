<?php include "partials/menu.php" ?>

<main>
  <div class="container py-5">
    <h1 class="text-center mb-4">Manage Order</h1>

    <?php
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    ?>

    <table class="table mx-auto text-center mt-5">
      <thead>
        <tr>
          <th>S.N.</th>
          <th>Food</th>
          <th>Price</th>
          <th>Qty.</th>
          <th>Total</th>
          <th>Order Date</th>
          <th>Status</th>
          <th>Customer Name</th>
          <th>Contact</th>
          <th>Email</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody class="table-group-divider">
        <?php
        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        $sn = 1;

        if ($count > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $food = $row['food'];
            $price = $row['price'];
            $qty = $row['qty'];
            $total = $row['total'];
            $order_date = $row['order_date'];
            $status = $row['status'];
            $customer_name = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_email = $row['customer_email'];
            $customer_address = $row['customer_address'];
        ?>
            <tr>
              <td><?php echo $sn++ ?>.</td>
              <td><?php echo $food ?></td>
              <td><?php echo $price ?></td>
              <td><?php echo $qty ?></td>
              <td><?php echo $total ?></td>
              <td><?php echo $order_date ?></td>
              <td>
                <?php
                switch ($status) {
                  case "Ordered":
                    echo "<div style='color: black;'>$status</div>";
                    break;
                  case "On Delivery":
                    echo "<div style='color: orange;'>$status</div>";
                    break;
                  case "Delivered":
                    echo "<div style='color: green;'>$status</div>";
                    break;
                  case "Cancelled":
                    echo "<div style='color: red;'>$status</div>";
                    break;
                  default:
                    echo "<div style='color: gray;'>Unknown status</div>";
                }
                ?>
              </td>
              <td><?php echo $customer_name ?></td>
              <td><?php echo $customer_contact ?></td>
              <td><?php echo $customer_email ?></td>
              <td><?php echo $customer_address ?></td>
              <td>
                <a href="<?php echo SITEURL ?>admin/update-order.php?id=<?php echo $id ?>" class="btn btn-success">Update</a>
              </td>
            </tr>
        <?php
          }
        } else echo "<tr> <td colspan='12'> <div class='error'>Orders not available!</div> </td> </tr>";
        ?>
      </tbody>
    </table>

  </div>
</main>

<?php include "partials/footer.php" ?>