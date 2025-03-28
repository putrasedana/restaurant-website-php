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