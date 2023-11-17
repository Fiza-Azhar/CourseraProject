<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

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
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'usermenu.php'; ?>

    <div class="heading">
        <h3>our Courses</h3>
        <p> <a href="home.php">home</a> / courses </p>
    </div>

    <section class="products">

        <h1 class="title">latest courses</h1>

        <div class="box-container">

            <?php
            $select_courses = mysqli_query($conn, "SELECT * FROM `courses`") or die('query failed');
            if (mysqli_num_rows($select_courses) > 0) {
                while ($fetch_course = mysqli_fetch_assoc($select_courses)) {
            ?>
                    <form action="" method="post" class="box">
                        <div class="cname"><?php echo $fetch_course['coursename']; ?></div>
                        <div class="tname">$<?php echo $fetch_course['capacity']; ?>/-</div>
                        <input type="number" name="assignment" value="<?php echo $fetch_course['assignment']; ?>">
                        <input type="number" name="quizes" value="<?php echo $fetch_course['quizes']; ?>">
                        <div class="cname"><?php echo $fetch_course['type']; ?></div>
                        <input type="submit" value="Enroll" name="update_capacity" class="btn">
                        <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                        <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>

        </div>

    </section>









    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>