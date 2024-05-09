<?php include "partials/menu.php" ?>

<main>
  <div class="container py-5">
    <h1 class="text-center">Manage Food</h1>

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    if (isset($_SESSION['failed-remove'])) {
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']);
    }

    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if (isset($_SESSION['unauthorize'])) {
      echo $_SESSION['unauthorize'];
      unset($_SESSION['unauthorize']);
    }
    ?>

    <a href="add-food.php" class="btn btn-lg my-3 btn-primary">Add Food</a>

    <table class="table mx-auto text-center">
      <thead>
        <tr>
          <th>S.N.</th>
          <th>Title</th>
          <th>Price</th>
          <th>Image</th>
          <th>Featured</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody class="table-group-divider">
        <?php
        $sql = "SELECT * FROM tbl_food";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        $sn = 1;

        if ($count > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        ?>
            <tr>
              <td><?php echo $sn++ ?></td>
              <td><?php echo $title ?></td>
              <td><?php echo $price ?></td>

              <td>
                <?php if ($image_name != "") { ?>
                  <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" class="rounded" alt="Image" width="100px">
                <?php } else echo "<div class='error'>No image added!</div>"; ?>
              </td>

              <td><?php echo $featured ?></td>
              <td><?php echo $active ?></td>
              <td>
                <a href="<?php echo SITEURL ?>admin/update-food.php?id=<?php echo $id ?>" class="btn btn-success">Update</a>
                <a href="<?php echo SITEURL ?>admin/delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
        <?php
          }
        } else echo "<tr> <td colspan='6'> <div class='error'>No food added!</div> </td> </tr>";
        ?>
      </tbody>
    </table>

  </div>
</main>

<?php include "partials/footer.php" ?>