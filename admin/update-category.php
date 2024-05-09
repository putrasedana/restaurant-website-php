<?php include "./partials/menu.php" ?>

<?php
if (isset($_POST['submit'])) {
  header("location:" . SITEURL . "admin/manage-category.php");
}
?>

<main class="bg-secondary-emphasis d-flex justify-content-center align-items-center">
  <div class="container row py-5">
    <div class="pb-4 col-12 col-sm-10 col-lg-8 col-xl-6 mx-auto rounded-3 shadow-lg px-0">
      <h2 class="text-center mb-4 py-3 bg-primary text-white rounded-top">Update Category</h1>

        <?php
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $sql = "SELECT * FROM tbl_category WHERE id = $id";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);

          if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
          } else {
            $_SESSION['no-category-found'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Category not found!</div>";
            header("location:" . SITEURL . "admin/manage-category.php");
          }
        } else {
          header("location:" . SITEURL . "admin/manage-category.php");
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
          <div class="container">

            <div class="row justify-content-center mb-3">
              <div class="col-12 col-md-10">
                <div class="form-group">
                  <label for="title" class="mb-2">Title:</label>
                  <input type="text" class="form-control border border-black" id=" title" name="title" value="<?php echo $title ?>">
                </div>
              </div>
            </div>

            <div class="row justify-content-center mb-3">
              <div class="col-12 col-md-10">
                <div class="form-group">
                  <label for="current_image">Current Image:</label>
                  <?php if ($current_image != "") : ?>
                    <img src="<?php echo SITEURL ?>images/category/<?php echo $current_image ?>" class="rounded" alt="Image" width="100">
                  <?php else : ?>
                    <div class="error">Image not added!</div>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <div class="row justify-content-center mb-3">
              <div class="col-12 col-md-10">
                <div class="form-group">
                  <label for="image" class="mb-2">New Image:</label>
                  <input type="file" class="form-control-file" id="image" name="image">
                </div>
              </div>
            </div>

            <div class="row justify-content-center mb-3">
              <div class="col-12 col-md-10">
                <div class="form-group d-flex align-items-center justify-content-start">
                  <label class="w-25">Featured:</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="featured" id="featuredYes" value="Yes" <?php if ($featured == "Yes") echo "checked" ?>>
                    <label class="form-check-label" for="featuredYes">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="featured" id="featuredNo" value="No" <?php if ($featured == "No") echo "checked" ?>>
                    <label class="form-check-label" for="featuredNo">No</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-center mb-4">
              <div class="col-12 col-md-10">
                <div class="form-group d-flex align-items-center justify-content-start">
                  <label class="w-25">Active:</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" id="activeYes" value="Yes" <?php if ($active == "Yes") echo "checked" ?>>
                    <label class="form-check-label" for="activeYes">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="active" id="activeNo" value="No" <?php if ($active == "No") echo "checked" ?>>
                    <label class="form-check-label" for="activeNo">No</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-12 col-md-10">
                <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="text-center">
                  <input type="submit" class="btn btn-success" value="Update Category" name="submit">
                  <a href="<?php SITEURL ?> manage-category.php" class="btn btn-danger ">Cancel</a>
                </div>
              </div>
            </div>

          </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $title = $_POST['title'];
          $current_image = $_POST['current_image'];
          $featured = $_POST['featured'];
          $active = $_POST['active'];

          if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];

            if ($image_name != "") {
              $ext = end(explode(".", $image_name));
              $image_name = "food_category_" . rand(000, 999) . "." . $ext;
              $source_path = $_FILES['image']['tmp_name'];
              $destination_path = "../images/category/" . $image_name;
              $upload = move_uploaded_file($source_path, $destination_path);

              if ($upload == false) {
                $_SESSION['upload'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to upload image!</div>";
                header("location:" . SITEURL . "admin/manage-category.php");
                die();
              }

              if ($current_image != "") {
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);

                if ($remove == false) {
                  $_SESSION['failed-remove'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to remove current image!</div>";
                  header("location:" . SITEURL . "admin/manage-category.php");
                  die();
                }
              }
            } else $image_name = $current_image;
          } else $image_name = $current_image;

          $sql2 = "UPDATE tbl_category SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active' WHERE id = $id";
          $res2 = mysqli_query($conn, $sql2);

          if ($res2 == true) {
            $_SESSION['update'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Category updated succuessfully</div>";
            header("location:" . SITEURL . "admin/manage-category.php");
          } else {
            $_SESSION['update'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to update category!</div>";
            header("location:" . SITEURL . "admin/manage-category.php");
          }
        }
        ?>

    </div>
  </div>
</main>



<?php include "./partials/footer.php" ?>