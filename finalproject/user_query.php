<?php

include 'connection.php'; //this is used to connect with xampp sql (backend)
session_start(); //superglobal in PHP to store and retrieve values

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {    //checking if admin is login or not if not it ill redirect it to loginpage 
    header('location:login.php');
}
$logFile = 'logfile.txt';  //this is log file 

function logMessage($message)   //this is a funtion to store data in a log file
{
    global $logFile;
    $fileHandle = fopen($logFile, 'a') or die("Can't open file");       //open a log file
    fwrite($fileHandle, $message . '  ' . date('Y-m-d H:i:s') . "\n");
    fclose($fileHandle);
}
//backend for submit button
if (isset($_POST['send'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $tcname = mysqli_real_escape_string($conn, $_POST['tname']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);


    $add_course_query = mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message,teachername) VALUES('$user_id', '$name', '$email', '$number', '$msg','$tcname')") or die(logMessage("$user_id: Error while sending message to $tcname: " . mysqli_error($conn)));

    if (!$add_course_query) {
        // If the assignment query fails, log an error message
        $message[] = 'message not sent';
        $assignmentErrorMessage = "$admin_id: Error while sending message to $tcname: " . mysqli_error($conn);
        logMessage($assignmentErrorMessage);
    } else {
        $message[] = 'message sent successfully!';
        $assignmentErrorMessage = "$user_id: Message sent to  $tcname: ";
        logMessage($assignmentErrorMessage);
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
        <section class="dashboard">
            <img src="Images/b6.jpg" height="430px" width="100%">
            <div class="text">
                <h1 class="title">Contact Us</h1>
            </div>
            <div class="box-container">
                <section id="section8">
                    <!--Contact Us form-->
                    <div class="sec-form" style="margin-bottom :0%">
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
            </div>
            <?php include 'footer.php'; ?>
        </section>
    </main>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>