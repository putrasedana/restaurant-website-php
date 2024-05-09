<?php
include "../config/constants.php";

if (isset($_GET['id']) and isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  if ($image_name != "") {
    $path = "../images/food/" . $image_name;
    $remove = unlink($path);
    if ($remove == false) {
      $_SESSION['remove'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to remove the category image!</div>";
      die();
    }
  }

  $sql = "DELETE FROM tbl_food WHERE id = $id";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['delete'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Food deleted successfully.</div>";
    header("location:" . SITEURL . "admin/manage-food.php");
  } else {
    $_SESSION['delete'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to delete food!</div>";
    header("location:" . SITEURL . "admin/manage-food.php");
  }
} else {
  $_SESSION['unauthorize'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Unauthorized access!</div>";
  header("location:" . SITEURL . "admin/manage-food.php");
}
