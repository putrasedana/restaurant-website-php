<?php
if (!isset($_SESSION['super-user'])) {
  header("location:" . SITEURL . "admin/super-login.php");
}
