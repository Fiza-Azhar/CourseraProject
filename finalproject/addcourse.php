<?php

include 'connection.php'; //this is used to connect with xampp sql (backend)

session_start(); //superglobal in PHP to store and retrieve values

$logFile = 'logfile.txt';  //this is log file 

function logMessage($message)   //this is a funtion to store data in a log file
{
    global $logFile;
    $fileHandle = fopen($logFile, 'a') or die("Can't open file");       //open a log file
    fwrite($fileHandle, $message . '  ' . date('Y-m-d H:i:s') . "\n");
    fclose($fileHandle);
}

$admin_id = $_SESSION['admin_id'];              //get admin id that e stored in a session variable

if (!isset($admin_id)) {    //checking if admin is login or not if not it ill redirect it to loginpage 
    header('location:login.php');
    exit(); // Add exit here
}

if (isset($_POST['add_course'])) {
    $name = mysqli_real_escape_string($conn, $_POST['cname']);
    $tname = $_POST['tname']; // Use the correct variable name that is in your html 
    // Use the correct variable name
    $capacity = $_POST['capacity'];
    $assignment = $_POST['assignment'];
    $quizes = $_POST['quizes'];
    $type = $_POST['type'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;
    $currentDateTime = date("Y-m-d H:i:s");

    $select_course_name = mysqli_query($conn, "SELECT coursename, teachername FROM `courses` WHERE teachername = '$tname' AND coursename = '$name'") or die('query failed');
    //checking if course is already added or not with the same teacher name
    if (mysqli_num_rows($select_course_name) > 0) {
        $message[] = 'course name already added';
        $messagetext = "$name with $tname  has already registered"; // If no user is found, add an error message to the $message array.
        logMessage($messagetext);
    } else {
        $add_course_query = mysqli_query($conn, "INSERT INTO `courses`(coursename, teachername, capacity, assignment, quizes, type,image,updated_at) VALUES('$name', '$tname', '$capacity', '$assignment', '$quizes', '$type','$image','$currentDateTime')") or die('query failed');
        $message[] = 'successfully added';
        $messagetext = "Successfully registered"; // If no user is found, add an error message to the $message array.
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
    <title>add course</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cssstyle.css">
    <link rel="stylesheet" href="css/cssf.css">
</head>

<body>
    <?php include 'admin_menu.php'; ?>
    <main class="main">
        <section class="dashboard">
            <section class="sone">
            </section>
            <div class="text">
                <h1 class="title">Add Courses</h1>
            </div>
            <section class="add-products">
                <div class="right_item">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h2>Add course</h2>
                        <!--basic html form -->
                        <input type="text" name="cname" class="box" placeholder="Enter course name" required>
                        <input type="text" name="tname" class="box" placeholder="Enter teacher name" required>
                        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
                        <input type="number" min="0" name="capacity" class="box" placeholder="Enter capacity" required>
                        <input type="number" min="0" name="assignment" class="box" placeholder="Enter Assignment" required>
                        <input type="number" min="0" name="quizes" class="box" placeholder="Enter Quizes" required>
                        <input type="text" name="type" class="box" placeholder="Enter Course type" required>
                        <input type="submit" value="Add course" name="add_course" class="btn">
                    </form>
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