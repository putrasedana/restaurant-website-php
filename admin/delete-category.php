<?php
include "../config/constants.php";

if (isset($_GET['id']) and isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  if ($image_name != "") {
    $path = "../images/category/" . $image_name;
    $remove = unlink($path);
    if ($remove == false) {
      $_SESSION['remove'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to remove the category image!</div>";
      die();
    }
  }

  $sql = "DELETE FROM tbl_category WHERE id = $id";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['delete'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Category deleted successfully.</div>";
    header("location:" . SITEURL . "admin/manage-category.php");
  } else {
    $_SESSION['delete'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to delete category!</div>";
    header("location:" . SITEURL . "admin/manage-category.php");
  }
} else {
  $_SESSION['unauthorize'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Unauthorized access!</div>";
  header("location:" . SITEURL . "admin/manage-category.php");
}
