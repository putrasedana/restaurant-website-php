<?php include "./partials-front/menu.php" ?>

<?php
if (isset($_POST['submit'])) {
    header("location:" . SITEURL);
}
?>

<?php
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header("location:" . SITEURL);
    }
} else {
    header("location:" . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="bg-body-tertiary py-5">
    <div class="container">
        <form action="" method="post" class="bg-dark col-6 mx-auto rounded p-5">
            <h2 class="text-center text-white mb-5 fw-semibold">Fill this form to confirm your order.</h2>
            <div class="card mx-auto text-bg-dark">
                <label class="mb-3 fs-4 text-warning fw-semibold">Selected Food</label>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-4">
                        <?php if ($image_name == "") {
                            echo "<div class='error'>Image not available!</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" alt="<?php echo $image_name ?>" class="img-fluid rounded">
                        <?php } ?>
                    </div>

                    <div class="col-md-8">
                        <h3><?php echo $title ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ?>">
                        <p class="fs-5">$<?php echo $price ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ?>">

                        <div class="mb-2">Quantity</div>
                        <input type="number" name="qty" class="form-control" value="1" required>
                    </div>
                </div>
            </div>

            <div class="mx-auto bg-dark rounded-bottom text-white">
                <label class="mb-2 mt-4 fs-4 text-warning fw-semibold">Delivery Details</label>
                <div class="mb-3">
                    <label for="full-name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full-name" name="full-name" placeholder="E.g. John Smith" required>
                </div>
                <div class="mb-3">
                    <label for="phone-number" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone-number" name="contact" placeholder="E.g. 9843xxxxxx" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E.g. example@email.com" required>
                </div>
                <div class="mb-4">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="E.g. Street, City, Country" required></textarea>
                </div>
                <input type="submit" name="submit" class="btn btn-warning w-100" value="Confirm Order">
            </div>

        </form>

        <?php
        if (isset($_POST['submit'])) {
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("y-m-d h:i:sa");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            $sql2 = "INSERT INTO tbl_order SET food = '$food', price = $price, qty = $qty, total = $total, order_date = '$order_date', status = '$status', customer_name = '$customer_name', customer_contact = '$customer_contact', customer_email = '$customer_email', customer_address = '$customer_address'";
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['order'] = "<div class='alert fs-5 mx-auto col-10 alert-success text-center'>Food ordered successfully</div>";
                header("location:" . SITEURL);
            } else {
                $_SESSION['order'] = "<div class='alert fs-5 mx-auto col-10 alert-danger text-center'>Failed to order food!</div>";
                header("location:" . SITEURL);
            }
        } else {
            // Display error message if any required field is empty
            $_SESSION['order'] = "<div class='error text-center'>All fields are required</div>";
            exit; // Stop further execution after redirection
        }
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include "./partials-front/footer.php" ?>