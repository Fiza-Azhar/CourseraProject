<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enrolled</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/csssstyle.css">
    <link rel="stylesheet" href="css/style.css">


</head>

<body>

    <?php include 'usermenu.php'; ?>
    <main class="main">
        <section class="dashboard">
            <section class="sone"></section>
            <div class="box-container">
                <?php
                $enroll_query = mysqli_query($conn, "SELECT * FROM `enrollment` WHERE user_id = '$user_id'  AND payment_status='completed'") or die('query failed');
                if (mysqli_num_rows($enroll_query) > 0) {
                    while ($fetch_orders = mysqli_fetch_assoc($enroll_query)) {
                ?>
                        <div class="box">
                            <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                            <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                            <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                            <p> CourseName : <span><?php echo $fetch_orders['coursename']; ?></span> </p>
                            <p> Teacher Name : <span><?php echo $fetch_orders['teachername']; ?></span> </p>
                            <p> Payment status : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                                        echo 'red';
                                                                    } else {
                                                                        echo 'green';
                                                                    } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
                            <a href='sgetassigment.php ? coursename=<?php echo $fetch_orders['coursename'];  ?>'><button>Check Assigment</button></a>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">no enrolment yet!</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>