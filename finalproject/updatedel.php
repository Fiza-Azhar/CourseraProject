<?php

include 'connection.php'; //this is used to connect with xampp sql (backend)
session_start(); //superglobal in PHP to store and retrieve values

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];

$logFile = 'logfile.txt';  //this is log file 

function logMessage($message)   //this is a funtion to store data in a log file
{
    global $logFile;
    $fileHandle = fopen($logFile, 'a') or die("Can't open file");       //open a log file
    fwrite($fileHandle, $message . '  ' . date('Y-m-d H:i:s') . "\n");
    fclose($fileHandle);
}
if (!isset($admin_id)) { //checking if admin is login or not if not it ill redirect it to loginpage 
    header('location:login.php');
}

// Initialize an array to store messages

if (isset($_POST['update_values'])) {
    $update_id = $_POST['id'];
    $tname = $_POST['tname'];
    $cname = $_POST['cname'];
    $type = $_POST['type'];
    $assignment = $_POST['assign'];
    $capacity = $_POST['capacity'];
    $quizes = $_POST['quz'];
    $image = $_POST['image'];
    $currentDateTime = date("Y-m-d H:i:s");

    $update_data = mysqli_query($conn, "UPDATE `courses` SET coursename='$cname', teachername='$tname', capacity='$capacity', assignment='$assignment', quizes='$quizes', type='$type', image='$image', updated_at='$currentDateTime' WHERE id='$update_id'");

    if ($update_data) {
        $message[] = 'Data has been updated!';
        $messagetext = "Data has been updated"; // If no user is found, add an error message to the $message array.
        logMessage($messagetext);
    } else {
        $message[] = 'Error updating data: ' . mysqli_error($conn);
    }
}

if (isset($_POST['delete_values'])) {
    $update_id = $_POST['id'];
    $status = 0;
    $currentDateTime = date("Y-m-d H:i:s");


    $update_data = mysqli_query($conn, "UPDATE `courses` SET status='$status',updated_at='$currentDateTime' WHERE id='$update_id'");

    if ($update_data) {
        $message[] = 'Data has been updated!';
        $messagetext = "Data has been deleted"; // If no user is found, add an error message to the $message array.
        logMessage($messagetext);
    } else {
        $message[] = 'Error updating data: ' . mysqli_error($conn);
        $messagetext = "There is some erro while deleting this record"; // If no user is found, add an error message to the $message array.
        logMessage($messagetext);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update course</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/cssstyle.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/cssf.css">


</head>

<body>

    <?php include 'admin_menu.php'; ?>
    <main class="main">
        <section class="show-products">
            <section class="sone">
            </section>
            <div class="text">
                <h1 class="title">Update & Delete Courses</h1>
            </div>
            <div class="box-container">
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `courses` WHERE teachername='$admin_name' AND  status='1'") or die('query failed');
                if (mysqli_num_rows($select_orders) > 0) {
                    while ($row = mysqli_fetch_assoc($select_orders)) {
                ?>
                        <!--Update and delete courses-->
                        <div class="box">
                            <form method="post" action="">
                                <input type="hidden" name="id" class="box" value="<?php echo $row['id']; ?>">
                                <input type="text" name="tname" class="box" value="<?php echo $row['teachername']; ?> ">
                                <input type="text" name="cname" class="box" value="<?php echo $row['coursename'] ?> ">
                                <input type="text" name="type" class="box" value="<?php echo $row['type'] ?> ">
                                <input name="capacity" class="box" value="<?php echo $row['capacity'] ?> ">
                                <input name="assign" class="box" value="<?php echo $row['assignment'] ?> ">
                                <input name="quz" class="box" value=" <?php echo $row['quizes'] ?> ">
                                <input type="hidden" name="image" class="box" value="<?php echo $row['image'] ?> ">

                                <input type="submit" value="update" name="update_values" class="btn" style="
    color: white;
    text-decoration: none;
    padding: 2%;
    margin: 3%;
    padding-bottom: 2%;
    padding-left: 42%;
    padding-right: 42%;
    background-color: var(--primary-color);
    cursor:pointer;
">
                                <input type="submit" value="Delete" name="delete_values" class="btn" style="
    color: white;
    text-decoration: none;
    padding: 2%;
    margin: 3%;
    padding-bottom: 2%;
    padding-left: 42%;
    padding-right: 42%;
    background-color: var(--primary-color);
    cursor:pointer;

">
                            </form>
                        </div>
                <?php
                    }
                } else {
                    echo '<h5 class="empty">Sorry!! no course added yet!</h5>';
                }
                ?>
            </div>
        </section>
    </main>
    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>