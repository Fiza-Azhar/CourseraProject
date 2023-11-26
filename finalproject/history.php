<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
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
    <title>history</title>

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
            <img src="Images/b4.jpg" height="450px" width="100%">
            <section class="show-products">
                <div class="box-container">
                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `enrollment` where user_id='$user_id' AND payment_status='completed'") or die(logMessage("$user_id: Error  " . mysqli_error($conn)));
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_orders = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <div class="box">
                                <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                                <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                                <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                                <p> CourseName : <span><?php echo $fetch_orders['coursename']; ?></span> </p>
                                <p> Teacher Name : <span><?php echo $fetch_orders['teachername']; ?></span> </p>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no enrollment added yet!</p>';
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