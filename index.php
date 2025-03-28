<?php include "./partials-front/menu.php" ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search row m-0">
    <div class="container my-5 mx-auto col-12 col-sm-8 col-xl-5">
        <form class="input-group" action="<?php echo SITEURL ?>food-search.php" method="POST">
            <input type="search" class="form-control border border-dark border-2" name="search" placeholder="Search for Food.." aria-describedby="button-addon2" required>
            <input type="submit" class="btn btn-dark" name="submit" value="Search" id="button-addon2">
        </form>
    </div>
</section>

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center mb-5">Explore Foods</h2>

        <div class="row row-cols-1 row-cols-md-2 gap-0 px-3 row-cols-lg-3 row-cols-xl-4  mb-5">
            <?php
            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 4";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
            ?>

                    <?php include "./partials-front/category-cards.php" ?>

            <?php
                }
            } else echo "<div class='text-danger'>Category Not Added!</div>";
            ?>
        </div>
    </div>
</section>


<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu bg-body-tertiary pb-5">
    <div class="container">
        <h2 class="text-center my-5 pt-5">Food Menu</h2>

        <div class="row row-cols-1 align-items-center row-cols-lg-2 gap-0 px-3 mb-5">
            <?php
            $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res);

            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
            ?>
                    <?php include "./partials-front/food-cards.php" ?>
            <?php
                }
            } else echo "<div class='text-danger'>Food Not Added!</div>";
            ?>
        </div>
    </div>
</section>

<?php include "./partials-front/footer.php" ?>