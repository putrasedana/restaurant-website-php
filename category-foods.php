<?php include "./partials-front/menu.php" ?>

<?php
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header('location:' . SITEURL);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center my-5">
    <div class="container">

        <h2>Foods on <a href="#" class="text-black text-decoration-none">"<?php echo $category_title ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu bg-body-tertiary py-5">
    <div class="container">
        <h2 class="text-center mb-5">Food Menu</h2>

        <div class="row row-cols-1 align-items-center row-cols-lg-2 gap-0 px-3 mb-5">
            <?php
            $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count = mysqli_num_rows($res2);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>
                    <div class="col mb-4">
                        <div class="card text-bg-dark">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <?php if ($image_name == "") {
                                        echo "<div class='rounded-start'>Image not available!</div>";
                                    } else {
                                    ?>
                                        <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" alt="<?php echo $image_name ?>" class="img-fluid rounded-start">
                                    <?php } ?>
                                </div>

                                <div class="col-md-8 py-3">
                                    <div class="card-body d-flex flex-column align-items-center text-center p-0">
                                        <h4 class="card-title"><?php echo $title ?></h4>
                                        <p class="card-text">$<?php echo $price ?></p>
                                        <p class="card-text"><?php echo $description ?></p>
                                        <a href="<?php echo SITEURL ?>order.php?food_id=<?php echo $id ?>" class="btn btn-warning">Order Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else echo "<div class='error'>Food Not Found!</div>";
            ?>

        </div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include "./partials-front/footer.php" ?>