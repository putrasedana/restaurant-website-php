<?php include "./partials-front/menu.php" ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center my-5">Explore Foods</h2>

        <div class="row row-cols-1 row-cols-md-2 gap-0 px-3 row-cols-lg-3 row-cols-xl-4  mb-5">
            <?php
            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
            ?>
                    <a class="text-decoration-none col mb-3" href="<?php echo SITEURL ?>category-foods.php?category_id=<?php echo $id ?>">
                        <div class="card">
                            <?php if ($image_name == "") {
                                echo "<div class='text-danger'>Image not available!</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>" alt="Image" class="card-img-top">
                            <?php } ?>

                            <div class="card-body bg-dark text-white rounded-bottom">
                                <h3 class="card-text text-center"><?php echo $title ?></h3>
                            </div>
                        </div>
                    </a>
            <?php
                }
            } else echo "<div class='text-danger'>Category Not Found!</div>";
            ?>
        </div>
</section>
<!-- Categories Section Ends Here -->

<?php include "./partials-front/footer.php" ?>