<?php include "partials/menu.php"; ?>

<main class="min-vh-100">
  <div class="container py-5">
    <h1 class="text-center mb-5">User's Feedback</h1>

    <?php
    $sql = "SELECT * FROM tbl_feedback ORDER BY id DESC";
    $res = mysqli_query($conn, $sql);
    include "partials/feedback-grid.php";
    ?>

    <?php
    if (isset($_POST['delete'])) {
      $delete_id = $_POST['delete_id'];
      $delete_sql = "DELETE FROM tbl_feedback WHERE id = $delete_id";
      $delete_res = mysqli_query($conn, $delete_sql);

      if ($delete_res) {
        echo "<script>window.location.href = 'manage-feedback.php';</script>";
        exit();
      } else {
        echo "<script>alert('Failed to delete feedback!');</script>";
        exit();
      }
    }
    ?>

  </div>
</main>

<?php include "partials/footer.php"; ?>