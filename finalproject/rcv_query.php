<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$username = $_SESSION['user_name'];

if (!isset($admin_id)) {
    header('location:login.php');
};



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'usermenu.php'; ?>

    <section class="messages">

        <h1 class="title"> messages </h1>

        <div class="box-container">
            <?php
            $select_message = mysqli_query($conn, "SELECT name, email, number, message, teachername FROM `message` WHERE teachername='username'") or die('query failed');
            if (mysqli_num_rows($select_message) > 0) {
                while ($fetch_message = mysqli_fetch_assoc($select_message)) {

            ?>
                    <div class="box">
                        <p> user id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
                        <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
                        <p> number : <span><?php echo $fetch_message['number']; ?></span> </p>
                        <p> email : <span><?php echo $fetch_message['email']; ?></span> </p>
                        <p> message : <span><?php echo $fetch_message['message']; ?></span> </p>
                        <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
                    </div>
            <?php
                };
            } else {
                echo '<p class="empty">you have no messages!</p>';
            }
            ?>
        </div>

    </section>









    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>