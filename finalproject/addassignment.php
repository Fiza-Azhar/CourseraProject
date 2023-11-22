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
    <title>admin panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cssstyle.css">
</head>

<body>
    <?php include 'admin_menu.php'; ?>
    <!-- product CRUD section starts  -->



    <!-- product CRUD section ends -->

    <!-- show courses  -->
    <main class="main">
        <section class="dashboard">
            <section class="show-products">
                <div class="box-container">
                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `courses` where id='$admin_id' AND status='1'") or die('query failed');
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
                                <input type="number" name="assignment" readonly="true" value="<?php echo $fetch_products['assignment']; ?>">
                                <input type="number" name="quizes" readonly="true" value="<?php echo $fetch_products['quizes']; ?>">
                                <div class="cname"><?php echo $fetch_products['type']; ?></div>
                                <a href="assigment.php" class="option-btn">Add Assignment</a>
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

    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

    <!-- ... (unchanged) ... -->
</body>

</html>