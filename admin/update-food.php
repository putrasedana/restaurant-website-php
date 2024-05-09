<?php include "./partials/menu.php" ?>

<?php
if (isset($_POST['submit'])) {
  header("location:" . SITEURL . "admin/manage-food.php");
}
?>

<main class="bg-secondary-emphasis d-flex justify-content-center align-items-center py-5">
  <div class="container row">
    <div class="pb-4 col-12 col-lg-10 col-xl-8 mx-auto rounded-3 shadow-lg px-0">
      <h2 class="text-center mb-4 py-3 bg-primary text-white rounded-top">Update Food</h2>

      <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_food WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $current_category = $row['category_id'];
        $featured = $row['featured'];
        $active = $row['active'];
      } else {
        header("location:" . SITEURL . "admin/manage-food.php");
      }

      ?>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control border border-black" id="title" name="title" value="<?php echo $title ?>">
              </div>

              <div class="form-group mb-3">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control border border-black" id="description" cols="30" rows="5"><?php echo $description ?></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="price">Price:</label>
                <input type="number" class="form-control border border-black" id="price" name="price" value="<?php echo $price ?>">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group d-flex align-items-center mb-3">
                <label for="current_image" style="width: 25%;">Current Image:</label>
                <?php if ($current_image != "") : ?>
                  <img src="<?php echo SITEURL ?>images/food/<?php echo $current_image ?>" alt="Image" class="rounded" style="width: 100px;">
                <?php else : ?>
                  <div class="text-danger">Image not added!</div>
                <?php endif; ?>
              </div>

              <div class="form-group d-flex align-items-center mb-3">
                <label for="image" style="width: 27%;">New Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
              </div>

              <div class="form-group d-flex align-items-center justify-content-start mb-3">
                <label style="width: 25%;">Category:</label>
                <select name="category">
                  <?php
                  $sql2 = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                  $res2 = mysqli_query($conn, $sql2);
                  $count = mysqli_num_rows($res2);

                  if ($count > 0) {

                    while ($row = mysqli_fetch_assoc($res2)) {
                      $category_id = $row['id'];
                      $category_title = $row['title'];
                  ?>
                      <option <?php if ($current_category == $category_id) echo "selected" ?> value='<?php echo $category_id ?>'><?php echo $category_title ?></option>
                  <?php
                    }
                  } else echo "<option value='0'>No Category Found</option>";
                  ?>
                </select>
              </div>

              <div class="form-group d-flex align-items-center justify-content-start mb-3">
                <label style="width: 25%;">Featured:</label>
                <div class="form-check form-check-inline">
                  <input <?php if ($featured == "Yes") echo "checked" ?> class="form-check-input" type="radio" name="featured" id="featuredYes" value="Yes">
                  <label class="form-check-label" for="featuredYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input <?php if ($featured == "No") echo "checked" ?> class="form-check-input" type="radio" name="featured" id="featuredNo" value="No">
                  <label class="form-check-label" for="featuredNo">No</label>
                </div>
              </div>

              <div class="form-group d-flex align-items-center justify-content-start mb-5">
                <label style="width: 25%;">Active:</label>
                <div class="form-check form-check-inline">
                  <input <?php if ($active == "Yes") echo "checked" ?> class="form-check-input" type="radio" name="active" id="activeYes" value="Yes">
                  <label class="form-check-label" for="activeYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input <?php if ($active == "No") echo "checked" ?> class="form-check-input" type="radio" name="active" id="activeNo" value="No">
                  <label class="form-check-label" for="activeNo">No</label>
                </div>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-12">
                <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="text-center">
                  <input type="submit" value="Update Food" name="submit" class="btn btn-success">
                  <a href="<?php SITEURL ?> manage-food.php" class="btn btn-danger ">Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>

      <?php
      if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if (isset($_FILES['image']['name'])) {
          $image_name = $_FILES['image']['name'];

          if ($image_name != "") {
            $ext = end(explode(".", $image_name));
            $image_name = "food_name_" . rand(000, 999) . "." . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
              $_SESSION['upload'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to upload image!</div>";
              header("location:" . SITEURL . "admin/add-food.php");
              die();
            }

            if ($current_image != "") {
              $remove_path = "../images/food/" . $current_image;
              $remove = unlink($remove_path);

              if ($remove == false) {
                $_SESSION['failed-remove'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to remove current image!</div>";
                header("location:" . SITEURL . "admin/manage-food.php");
                die();
              }
            }
          } else $image_name = $current_image;
        } else $image_name = $current_image;

        $sql3 = "UPDATE tbl_food SET title = '$title', description = '$description', price = $price, image_name = '$image_name', category_id = $category, featured = '$featured', active = '$active' WHERE id = $id";
        $res3 = mysqli_query($conn, $sql3);

        if ($res3 == true) {
          $_SESSION['update'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Food updated succuessfully</div>";
          header("location:" . SITEURL . "admin/manage-food.php");
        } else {
          $_SESSION['update'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to update food!</div>";
          header("location:" . SITEURL . "admin/manage-food.php");
        }
      }
      ?>

    </div>
  </div>
</main>

<?php include "./partials/footer.php" ?>