<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="css/cssf.css" />

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <?php include 'admin_menu.php'; ?>
    <main class="main">
        <section class="dashboard">
            <section class="sone">
            </section>

            <div class="text">
                <h1 class="title">Home</h1>
            </div>
            <div class="box-container">
                <div class="box">
                    <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                    $number_of_users = mysqli_num_rows($select_users);
                    ?>
                    <h3><?php echo $number_of_users; ?></h3>
                    <p>Normal users</p>
                </div>

                <div class="box">
                    <?php
                    $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                    $number_of_admins = mysqli_num_rows($select_admins);
                    ?>
                    <h3><?php echo $number_of_admins; ?></h3>
                    <p>Admin users</p>
                </div>

                <div class="box">
                    <?php
                    $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                    $number_of_account = mysqli_num_rows($select_account);
                    ?>
                    <h3><?php echo $number_of_account; ?></h3>
                    <p>Total accounts</p>
                </div>



            </div>

        </section>






    </main>
    <!-- custom admin js file link  -->
    <script src="js/admin_jquery.js"></script>
    <script src="js/script.js"></script>

</body>

</html>