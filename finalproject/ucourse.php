<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];
$_SESSION['capacity'] = $capacitynum;
$_SESSION['type'] = $typenum;

if (!isset($user_id)) {
    header('location:login.php');
}

/*if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart!';
    }
}*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/cssstyle.css">

</head>

<body>

    <?php include 'usermenu.php'; ?>


    <main class="main">
        <section class="dashboard">
            <section class="show-products">
                <div class="box-container">
                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `courses`") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <div class="box">
                                <?php
                                // Assuming $fetch_products is an array with image information
                                $imagePath = 'uploaded_img/' . $fetch_products['image'];
                                ?>
                                <img src="<?php echo $imagePath; ?>" alt="">
                                <div class="cname"><?php echo $fetch_products['coursename']; ?></div>
                                <div class="cname"><?php echo $fetch_products['teachername']; ?></div>
                                <div class="cname">$<?php echo $fetch_products['capacity']; ?>/-</div>
                                <div class="cname"><?php echo $fetch_products['type']; ?></div>
                                <h5>Assigment & Quizez</h5>
                                <input type="number" name="assignment" readonly="true" value="<?php echo $fetch_products['assignment']; ?>">
                                <input type="number" name="quizes" readonly="true" value="<?php echo $fetch_products['quizes']; ?>">
                                <a href="enroll.php" class="option-btn">Enroll</a>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>
                </div>

            </section>
        </section>
    </main>









    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>