<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$adminName = $_SESSION['admin_name'];


if (!isset($admin_id)) {
    header('location:login.php');
};
$logFile = 'logfile.txt';  //this is log file 

function logMessage($message)   //this is a funtion to store data in a log file
{
    global $logFile;
    $fileHandle = fopen($logFile, 'a') or die("Can't open file");       //open a log file
    fwrite($fileHandle, $message . '  ' . date('Y-m-d H:i:s') . "\n");
    fclose($fileHandle);
}

if (isset($_POST['Send'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $msg = mysqli_real_escape_string($conn, $_POST['reply']);


    $add_course_query = mysqli_query($conn, "INSERT INTO `message2`(user_id,adminname,message) VALUES('$userid','$adminName','$msg')") or die(logMessage("$user_id: Error while sending message to $tcname: " . mysqli_error($conn)));

    if (!$add_course_query) {
        // If the assignment query fails, log an error message
        $message[] = 'reply not sent';
        $assignmentErrorMessage = "$admin_id: Error while sending replying : " . mysqli_error($conn);
        logMessage($assignmentErrorMessage);
    } else {
        $message[] = 'reply sent successfully!';
        $assignmentErrorMessage = "$admin_id: Message sent : ";
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
    <title>messages</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/cssstyle.css">
    <style>
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        #close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>

    <?php include 'admin_menu.php'; ?>
    <main class="main">
        <section class="sone">
        </section>
        <div class="text">
            <h1 class="title">Check Query</h1>
        </div>
        <section class="messages">
            <h2> Messages </h2>
            <div class="box-container">
                <?php
                $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE teachername='$adminName'") or die(logMessage("$user_id: Error  " . mysqli_error($conn)));
                if (mysqli_num_rows($select_message) > 0) {
                    while ($fetch_message = mysqli_fetch_assoc($select_message)) {
                ?>
                        <div class="box">
                            <p class="box"> <span> Id </span> <span><?php echo $fetch_message['user_id']; ?></span> </p>
                            <p><span> Name </span>: <span><?php echo $fetch_message['name']; ?></span> </p>
                            <p> <span>Number</span> : <span><?php echo $fetch_message['number']; ?></span> </p>
                            <p> <span>Email </span>: <span><?php echo $fetch_message['email']; ?></span> </p>
                            <p> <span>Message </span>: <span><?php echo $fetch_message['message']; ?></span> </p>
                            <button onclick="openPopup(<?php echo $fetch_message['user_id']; ?>)">Reply</button>
                            <div id="popup">
                                <div id="close-btn" onclick="closePopup()">X</div>
                                <h2>Reply to Message</h2>
                                <form id="replyForm" action="" method="post">
                                    <input id="userIdInput" name="user_id" value="">
                                    <textarea id="message" name="reply" rows="4" required></textarea>
                                    <br>
                                    <input type="submit" name="Send" value="Send">
                                </form>
                            </div>
                        </div>
                <?php
                    };
                } else {
                    echo '<p class="empty">you have no messages!</p>';
                }
                ?>

            </div>
            <?php include 'footer.php'; ?>
        </section>
    </main>
    <!-- custom admin js file link  -->
    <script>
        function openPopup(userId) {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('userIdInput').value = userId; // Set user_id value
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>


</body>

</html>