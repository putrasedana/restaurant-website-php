<?php
include "../config/constants.php";

$id = $_GET['id'];
$sql = "DELETE FROM tbl_admin WHERE id = $id";
$res = mysqli_query($conn, $sql);

if ($res == true) {
  $_SESSION['delete'] = "<div class='alert text-center fs-5 mt-4 alert-success'>Admin deleted succuessfully</div>";
  header("location:" . SITEURL . "admin/manage-admin.php");
} else {
  $_SESSION['delete'] = "<div class='alert text-center fs-5 mt-4 alert-danger'>Failed to delete admin!</div>";
  header("location:" . SITEURL . "admin/manage-admin.php");
}
