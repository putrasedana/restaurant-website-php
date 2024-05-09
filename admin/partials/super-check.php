<?php
if (!isset($_SESSION['super-user'])) {
  $_SESSION['no-login-message'] = "<div class='alert text-center fs-5 alert-danger col-12'>Please login to access super admin panel.</div>";
  header("location:" . SITEURL . "admin/super-login.php");
}
