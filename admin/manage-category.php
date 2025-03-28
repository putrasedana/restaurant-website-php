<?php include "partials/menu.php" ?>

<main class="min-vh-100">
  <div class="container py-5">
    <h1 class="text-center">Manage Category</h1>

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if (isset($_SESSION['unauthorize'])) {
      echo $_SESSION['unauthorize'];
      unset($_SESSION['unauthorize']);
    }

    if (isset($_SESSION['no-category-found'])) {
      echo $_SESSION['no-category-found'];
      unset($_SESSION['no-category-found']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

    if (isset($_SESSION['failed-remove'])) {
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']);
    }
    ?>

    <a href="add-category.php" class="btn btn-primary my-3">Add Category</a>

    <div class="table-responsive">
      <table class="table mx-auto text-center" style="min-width: 600px;">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">

          <?php
          $sql = "SELECT * FROM tbl_category";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          $sn = 1;

          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
              $id = $row['id'];
              $title = $row['title'];
              $image_name = $row['image_name'];
              $featured = $row['featured'];
              $active = $row['active'];
          ?>
              <tr>
                <td><?php echo $sn++ ?>.</td>
                <td><?php echo $title ?></td>

                <td>
                  <?php if ($image_name != "") { ?>
                    <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>" alt="Image" class="rounded-1" width="100px">
                  <?php } else echo "<div class='text-red'>No image added!</div>"; ?>
                </td>

                <td><?php echo $featured ?></td>
                <td><?php echo $active ?></td>
                <td>
                  <a href="<?php echo SITEURL ?>admin/update-category.php?id=<?php echo $id ?>" class="btn btn-success">Update</a>
                  <a href="<?php echo SITEURL ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn btn-danger">Delete</a>
                </td>
              </tr>
          <?php
            }
          } else echo "<tr> <td colspan='6'> <div class='error'>No category added!</div> </td> </tr>";
          ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include "partials/footer.php" ?>