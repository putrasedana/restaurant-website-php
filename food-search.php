<?php include "./partials-front/menu.php" ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center my-5">
    <div class="container">
        <?php $search = $_POST['search']; ?>
        <h2 class="text-black">Foods on Your Search <a href="#" class="text-black text-decoration-none">"<?php echo $search ?>"</a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu bg-body-tertiary py-5">
    <div class="container">
        <div class="row row-cols-1 align-items-center row-cols-lg-2 gap-0 px-3 mb-5">
            <?php
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>
                    <?php include "./partials-front/food-cards.php" ?>
            <?php
                }
            } else echo "<div class='error'>Food Not Found!</div>";
            ?>
        </div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include "./partials-front/footer.php" ?>