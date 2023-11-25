<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit(); // Add exit here
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>check assigment</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cssstyle.css">
</head>

<body>
    <?php include 'usermenu.php'; ?>
    <!-- show assigment  -->
    <main class="main">
        <section class="dashboard">
            <section class="show-products">
                <div class="box-container">
                    <?php
                    $course_name = $_GET['coursename'];
                    $select_products = mysqli_query($conn, "SELECT * FROM `assignment` where coursename='$course_name' ") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <div class="box">
                                <img src="<?php echo $imagePath; ?>" alt="">
                                <div class="cname"><?php echo $fetch_products['coursename']; ?></div>
                                <div class="cname"><?php echo $fetch_products['assigmentname']; ?></div>
                                <div class="cname"><?php echo $fetch_products['datetime']; ?></div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>
                </div>

            </section>
            <?php include 'footer.php'; ?>
        </section>
    </main>
    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

    <!-- ... (unchanged) ... -->
</body>

</html>