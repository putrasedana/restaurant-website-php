<?php
if (!isset($_SESSION['user'])) {
  $_SESSION['no-login-message'] = "<div class='alert text-center fs-5 alert-danger col-12'>Please login to access admin panel.</div>";
  header("location:" . SITEURL . "admin/login.php");
}
