<?php include "partials/menu.php" ?>

<?php
if (isset($_POST['submit'])) {
  header("location:" . SITEURL . "admin/manage-food.php");
}
?>

<main class="bg-secondary-emphasis d-flex justify-content-center align-items-center py-5">
  <div class="container row">
    <div class="pb-4 col-12 col-lg-10 col-xl-8 mx-auto rounded-3 shadow-lg px-0">
      <h2 class="text-center mb-4 py-3 bg-primary text-white rounded-top">Add Food</h2>

      <?php
      if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
      }
      ?>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="title" class="mb-2" style="width: 25%;">Title:</label>
                <input type="text" class="form-control border border-black" id="title" name="title" placeholder="Food title">
              </div>

              <div class="form-group mb-3">
                <label for="description" class="mb-2" style="width: 25%;">Description:</label>
                <textarea name="description" class="form-control border border-black" id="description" placeholder="Description of the food" cols="30" rows="5"></textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="price" class="mb-2" style="width: 25%;">Price:</label>
                <input type="number" class="form-control border border-black" id="price" name="price">
              </div>

              <div class="form-group mb-3  d-flex align-items-center">
                <label for="image" style="width: 30%;" class="mb-2">Select Image:</label>
                <input type="file" class="form-control-fil" id="image" name="image">
              </div>

              <div class="form-group d-flex align-items-center mb-3">
                <label style="width: 30%;">Category:</label>
                <select name="category">
                  <?php
                  $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                  $res = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($res);

                  if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                      $catagory_id = $row['id'];
                      $catagory_title = $row['title'];
                      echo "<option value='$catagory_id'>$catagory_title</option>";
                    }
                  } else echo "<option value='0'>No Category Found</option>";
                  ?>
                </select>
              </div>

              <div class="row justify-content-center mb-3">
                <div class="form-group d-flex align-items-center">
                  <label style="width: 30%;">Featured:</label>
                  <div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="featured" id="featuredYes" value="Yes">
                      <label class="form-check-label" for="featuredYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="featured" id="featuredNo" value="No">
                      <label class="form-check-label" for="featuredNo">No</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row justify-content-center mb-3">
                <div class="form-group d-flex align-items-center">
                  <label style="width: 30%;">Active:</label>
                  <div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="active" id="activeYes" value="Yes">
                      <label class="form-check-label" for="activeYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="active" id="activeNo" value="No">
                      <label class="form-check-label" for="activeNo">No</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-11">
              <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add Category" name="submit">
                <a href="<?php SITEURL ?> manage-food.php" class="btn btn-danger">Cancel</a>
              </div>
            </div>
          </div>

        </div>
      </form>

    </div>
  </div>
</main>

<?php include "partials/footer.php" ?>

<?php
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category  = $_POST['category'];

  if (isset($_POST['featured'])) {
    $featured = $_POST['featured'];
  } else $featured = "No";

  if (isset($_POST['active'])) {
    $active = $_POST['active'];
  } else $active = "No";

  if (isset($_FILES['image']['name'])) {
    $image_name = $_FILES['image']['name'];

    if ($image_name != "") {
      $ext = end(explode(".", $image_name));
      $image_name = "Food-name-" . rand(000, 999) . "." . $ext;
      $source_path = $_FILES['image']['tmp_name'];
      $destination_path = "../images/food/" . $image_name;
      $upload = move_uploaded_file($source_path, $destination_path);

      if ($upload == false) {
        $_SESSION['upload'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to upload image!</div>";
        header("location:" . SITEURL . "admin/add-food.php");
        die();
      }
    }
  } else $image_name = "";

  $sql2 = "INSERT INTO tbl_food SET title = '$title', description = '$description', price = $price, image_name = '$image_name', category_id = $category, featured = '$featured', active = '$active'";
  $res2 = mysqli_query($conn, $sql2);

  if ($res2 == true) {
    $_SESSION['add'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Food added succuessfully</div>";
    header("location:" . SITEURL . "admin/manage-food.php");
  } else {
    $_SESSION['add'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to add food!</div>";
    header("location:" . SITEURL . "admin/add-food.php");
  }
}
?>