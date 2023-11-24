<?php

include 'connection.php'; //this is used to connect with xampp sql (backend)
session_start(); //superglobal in PHP to store and retrieve values

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {    //checking if admin is login or not if not it ill redirect it to loginpage 
    header('location:login.php');
}
//backend for submit button
if (isset($_POST['send'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $tcname = mysqli_real_escape_string($conn, $_POST['tname']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

    if (mysqli_num_rows($select_message) > 0) {
        $message[] = 'message sent already!';
    } else {
        mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message,teachername) VALUES('$user_id', '$name', '$email', '$number', '$msg','$tcname')") or die('query failed');
        $message[] = 'message sent successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user contact</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cssstyle.css">
    <link rel="stylesheet" href="css/cssf.css">



</head>

<body>
    <?php include 'usermenu.php'; ?>
    <main class="main">
        <section class="sone">
        </section>
        <section id="section8">
            <!--Contact Us form-->
            <div class="sec-form">
                <h2>Send any query</h2>
                <form id="simple-form" action="" method="post">
                    <input type="text" name="name" required placeholder="Enter your name" class="box">
                    <input type="email" name="email" required placeholder="Enter your email" class="box">
                    <input type="number" name="number" required placeholder="Enter your number" class="box">
                    <input type="text" name="tname" required placeholder="Enter your teacher name" class="box">
                    <textarea name="message" class="box" placeholder="Enter your message" id="" cols="25" rows="10"></textarea>
                    <a><input type="submit" value="Send Message" name="send" class="btn"></a>
                </form>
            </div>
        </section>
    </main>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>