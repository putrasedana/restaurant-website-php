<div class="row">
  <?php
  if ($res && mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      $id = $row['id'];
      $name = htmlspecialchars($row['name']);
      $email = htmlspecialchars($row['email']);
      $message = htmlspecialchars($row['message']);
      $short_message = strlen($message) > 100 ? substr($message, 0, 120) . "..." : $message;
  ?>
      <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
        <div class="card" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#feedbackModal<?php echo $id; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $name; ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $email; ?></h6>
            <p class="card-text"><?php echo nl2br($short_message); ?></p>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="feedbackModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="feedbackModalLabel<?php echo $id; ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="feedbackModalLabel<?php echo $id; ?>">Feedback from <?php echo $name; ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p><strong>Email:</strong> <?php echo $email; ?></p>
              <p><?php echo nl2br($message); ?></p>
            </div>
            <div class="modal-footer">
              <form method="post" action="">
                <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
              </form>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
  <?php
    }
  } else {
    echo "<p class='text-center'>No feedback available.</p>";
  }
  ?>
</div>