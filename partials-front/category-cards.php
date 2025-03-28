<a class="text-decoration-none col mb-3" href="<?php echo SITEURL ?>category-foods.php?category_id=<?php echo $id ?>">
  <div class="card">
    <?php if ($image_name == "") {
      echo "<div class='text-danger'>Image not available!</div>";
    } else {
    ?>
      <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>" alt="<?php echo $image_name ?>" class="card-img-top">
    <?php } ?>

    <div class="card-body bg-dark text-white rounded-bottom">
      <h3 class="card-text text-center"><?php echo $title ?></h3>
    </div>
  </div>
</a>