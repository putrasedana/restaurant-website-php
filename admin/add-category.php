<?php include "./partials/menu.php" ?>

<?php
if (isset($_POST['submit'])) {
  header("location:" . SITEURL . "admin/manage-category.php");
}
?>

<main class="bg-secondary-emphasis d-flex justify-content-center align-items-center" style="height: calc(100vh - 112px)">
  <div class="container row ">
    <div class="pb-4 col-12 col-sm-10 col-lg-8 col-xl-6 mx-auto rounded-3 shadow-lg px-0">
      <h2 class="text-center mb-4 py-3 bg-primary text-white rounded-top">Add Category</h2>


      <?php
      if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
      }
      ?>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="container">

          <div class="row justify-content-center mb-3">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label class="mb-2" for="title">Title:</label>
                <input type="text" class="form-control border border-black" id="title" name="title" placeholder="Category title">
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-2">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label class="mb-2" for="image">Select Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-3">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label class="mb-2">Featured:</label>
                <div style="width: 72%;">
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
          </div>

          <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-10">
              <div class="form-group px-2">
                <label class="mb-2">Active:</label>
                <div style="width: 72%;">
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

          <div class="row justify-content-center">
            <div class="col-12">
              <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add Category" name="submit">
                <a href="<?php SITEURL ?> manage-category.php" class="btn btn-danger ">Cancel</a>
              </div>
            </div>
          </div>

        </div>
      </form>

    </div>
  </div>
</main>

<?php
if (isset($_POST['submit'])) {
  $title = $_POST['title'];

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
      $image_name = "food_category_" . rand(000, 999) . "." . $ext;
      $source_path = $_FILES['image']['tmp_name'];
      $destination_path = "../images/category/" . $image_name;
      $upload = move_uploaded_file($source_path, $destination_path);

      if ($upload == false) {
        $_SESSION['upload'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to upload image!</div>";
        header("location:" . SITEURL . "admin/add-category.php");
        die();
      }
    }
  } else $image_name = "";

  $sql = "INSERT INTO tbl_category SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active'";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['add'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Catagory added succuessfully</div>";
    header("location:" . SITEURL . "admin/manage-category.php");
  } else {
    $_SESSION['add'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to add category!</div>";
    header("location:" . SITEURL . "admin/add-category.php");
  }
}
?>

<?php include "./partials/footer.php" ?>