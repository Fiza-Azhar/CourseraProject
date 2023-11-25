<?php
include 'connection.php'; //this is used to connect with xampp sql (backend)
session_start(); //superglobal in PHP to store and retrieve values
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {    //checking if admin is login or not if not it will redirect it to loginpage 
    header('location:login.php');
}
?>
<!--Html start-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="css/style2.css" /> <!--css file added-->
    <link rel="stylesheet" href="css/cssf.css" />

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <?php include 'admin_menu.php'; ?> <!-- Admin menu is in this file -->
    <main class="main">
        <!-- this is admin dashboard-->
        <section class="dashboard">
            <section class="sone"> <!-- This is for startup background image -->
            </section>
            <div class="text">
                <h1 class="title">Admin dashboard</h1>
            </div>
            <div class="box-container">
                <div class="box">
                    <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed'); //fetch data from users table in xamp sql
                    $number_of_users = mysqli_num_rows($select_users);
                    ?>
                    <h3><?php echo $number_of_users; ?></h3>
                    <p>Student who are logged in</p>
                </div>
                <div class="box">
                    <?php
                    $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                    $number_of_admins = mysqli_num_rows($select_admins);
                    ?>
                    <h3><?php echo $number_of_admins; ?></h3>
                    <p>Teachers who are logged in</p>
                </div>

                <div class="box">
                    <?php
                    $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed'); //fetch data from users table in xamp sql
                    $number_of_account = mysqli_num_rows($select_account);
                    ?>
                    <h3><?php echo $number_of_account; ?></h3>
                    <p>Total accounts</p>
                </div>
                <div class="box">
                    <?php
                    $select_account = mysqli_query($conn, "SELECT * FROM `courses`") or die('query failed');
                    $number_of_account = mysqli_num_rows($select_account);
                    ?>
                    <h3><?php echo $number_of_account; ?></h3>
                    <p>Total Course</p>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </section>
    </main>
    <!-- custom admin js file link  -->
    <script src=""></script>
</body>

</html>