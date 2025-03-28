<div class="col mb-4">
  <div class="card text-bg-dark mx-auto">
    <div class="row g-0 align-items-center">
      <!-- Image Column -->
      <div class="col-md-4 d-flex justify-content-center align-items-center">
        <?php if (empty($image_name)) { ?>
          <div class="text-white text-center">Image not available!</div>
        <?php } else { ?>
          <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>"
            alt="<?php echo $image_name ?>"
            class="img-fluid rounded-start"
            style="object-fit: cover; width: 210px; height: 200px;">
        <?php } ?>
      </div>

      <!-- Content Column -->
      <div class="col-md-8">
        <div class="card-body">
          <div class="d-flex justify-content-start">
            <h5 class="card-title pe-3"><?php echo $title ?></h5>
            <p class="card-text text-warning fw-bold">$<?php echo $price ?></p>
          </div>
          <p class="card-text small"><?php echo $description ?></p>
          <a href="<?php echo SITEURL ?>order.php?food_id=<?php echo $id ?>" class="btn btn-warning btn-sm fw-semibold">Order Now</a>
        </div>
      </div>
    </div>
  </div>
</div>