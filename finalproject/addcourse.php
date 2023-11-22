<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit(); // Add exit here
}

if (isset($_POST['add_course'])) {

    $tname = $_POST['tname']; // Use the correct variable name that is in your html 
    $cname = $_POST['cname']; // Use the correct variable name
    $capacity = $_POST['capacity'];
    $assignment = $_POST['assignment'];
    $quizes = $_POST['quizes'];
    $type = $_POST['type'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;
    $currentDateTime = date("Y-m-d H:i:s");

    $select_course_name = mysqli_query($conn, "SELECT coursename, teachername FROM `courses` WHERE teachername = '$tname' AND coursename = '$cname'") or die('query failed');

    if (mysqli_num_rows($select_course_name) > 0) {
        $message[] = 'course name already added';
    } else {
        $add_course_query = mysqli_query($conn, "INSERT INTO `courses`(coursename, teachername, capacity, assignment, quizes, type,image,updated_at) VALUES('$cname', '$tname', '$capacity', '$assignment', '$quizes', '$type','$image','$currentDateTime')") or die('query failed');
        $message[] = 'successfully added';
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
                        <input type="text" name="cname" class="box" placeholder="Enter course name" required>
                        <input type="text" name="tname" class="box" placeholder="Enter teacher name" required>
                        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" placeholder="Add an image" class="box" required>
                        <input type="number" min="0" name="capacity" class="box" placeholder="Enter capacity" required>
                        <input type="number" min="0" name="assignment" class="box" placeholder="Enter Assignment" required>
                        <input type="number" min="0" name="quizes" class="box" placeholder="Enter Quizes" required>
                        <input type="text" name="type" class="box" placeholder="Enter Course type" required>
                        <input type="submit" value="Add course" name="add_course" class="btn">
                    </form>
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