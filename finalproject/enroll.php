<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];
$logFile = 'logfile.txt';

function logMessage($message)
{
    global $logFile;
    $fileHandle = fopen($logFile, 'a') or die("Can't open file");
    fwrite($fileHandle, $message . '  ' . date('Y-m-d H:i:s') . "\n");
    fclose($fileHandle);
}

if (!isset($user_id)) {
    header('location:login.php');
    exit(); // Add exit here
}

if (isset($_POST['enroll_course'])) {
    $update_id = $_POST['id'];
    $tname = $_POST['tname']; // Use the correct variable name that is in your html 
    $cname = $_POST['cname'];
    $name = $_POST['name']; // Use the correct variable name
    $email = $_POST['email'];
    $pnum = $_POST['pnum'];
    $type = $_POST['type'];
    $assignment = $_POST['assign'];
    $quizes = $_POST['quz'];
    $image = $_POST['image'];
    $payment = 'completed';
    if ($type = 'paid') {
        $payment = 'pending';
    } else {
        $payment = 'completed';
    }
    $currentDateTime = date("Y-m-d H:i:s");
    $capacity = $_POST['capacity'];
    $intcapacity = intval($capacity);
    $select_query = mysqli_query($conn, "SELECT * FROM `courses`") or die('query failed');


    if ($intcapacity > 0) {
        $intcap = $intcapacity - 1;
        $intcap = strval($intcap);
        $update_data = mysqli_query($conn, "UPDATE `courses` SET coursename='$cname', teachername='$tname', capacity='$intcap', assignment='$assignment', quizes='$quizes', type='$type', image='$image', updated_at='$currentDateTime' WHERE id='$update_id'");

        if (!$update_data) {
            echo "Error updating record: " . mysqli_error($conn);
        }
        $select_message = mysqli_query($conn, "SELECT * FROM `courses`") or die('query failed');
        $enroll_data = mysqli_query($conn, "INSERT INTO `enrollment` (user_id,name,number, email,coursename,teachername,type ,payment_status) VALUES('$user_id','$name','$pnum' ,'$email','$cname','$tname','$type','$payment')") or die('query failed');
        $message[] = 'successfully added';
        $messagetext = "Successfully added"; // If no user is found, add an error message to the $message array.
        logMessage($messagetext);
    } else {
        $message[] = 'There is no space in this course';
        $messagetext = "There is no space in this course"; // If no user is found, add an error message to the $message array.
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
    <title>enroll</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cssstyle.css">
    <link rel="stylesheet" href="css/css3.css">

</head>

<body>
    <?php include 'usermenu.php'; ?>
    <main class="main">
        <section class="dashboard">
            <section class="sone">
            </section>
            <div class="text">
                <h1 class="title">Enroll Courses</h1>
            </div>
            <section class="add-products">
                <div class="right_item">
                    <?php
                    $cid = $_GET['id'];
                    $result = mysqli_query($conn, "SELECT * FROM `courses` where id='$cid' AND status='1'") or die('query failed');
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <h3>Fill out this form to enroll in this courses</h3>
                                <input type="hidden" name="id" class="box" value="<?php echo $row['id']; ?>">
                                <input type="text" name="tname" readonly="true" class="box" value="<?php echo $row['teachername'] ?> ">
                                <input type="text" name="cname" readonly="true" class="box" value="<?php echo $row['coursename'] ?> ">
                                <input type="text" name="type" readonly="true" class="box" value="<?php echo $row['type'] ?> ">
                                <input type="hidden" name="capacity" readonly="true" class="box" value="<?php echo $row['capacity'] ?> ">
                                <input type="hidden" name="assign" readonly="true" class="box" value="<?php echo $row['assignment'] ?> ">
                                <input type="hidden" name="quz" readonly="true" class="box" value=" <?php echo $row['quizes'] ?> ">
                                <input type="hidden" name="image" readonly="true" class="box" value="<?php echo $row['image'] ?> ">
                                <input type=" text" name="name" class="box" placeholder="Enter Your name" required>
                                <input type="number" min="0" name="pnum" class="box" placeholder="Enter Phone number" required>
                                <input type="email" name="email" placeholder="admin@gmail.com" required class="box">
                                <input type="submit" value="Enroll" name="enroll_course" class="btn">
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </section>

        </section>
    </main>
    <!-- product CRUD section starts  -->



    <!-- product CRUD section ends -->

    <!-- show courses  -->


    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

    <!-- ... (unchanged) ... -->
</body>

</html>