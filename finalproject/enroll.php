<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$capacitynum = $_SESSION['capacity'];
$typenum = $_SESSION['type'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit(); // Add exit here
}

if (isset($_POST['add_course'])) {

    $tname = $_POST['tname']; // Use the correct variable name that is in your html 
    $cname = $_POST['cname'];
    $name = $_POST['name']; // Use the correct variable name
    $capacity = $_POST['email'];
    $pnum = $_POST['pnum'];



    $select_course_name = mysqli_query($conn, "SELECT coursename, teachername FROM `enroll` WHERE teachername = '$tname' AND coursename = '$cname'") or die('query failed');

    if (mysqli_num_rows($select_course_name) > 0) {
        $message[] = 'course name already added';
    } else {
        if ($capacitynum > 0) {
            $capacitynum = $capacitynum - 1;
            $add_course_query = mysqli_query($conn, "UPDATE `coursename` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');
            $message[] = 'successfully added';
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `courses` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `courses` WHERE id = '$delete_id'") or die('query failed');
    header('location:addcourses.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cssstyle.css">
</head>

<body>
    <?php include 'usermenu.php'; ?>
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
                        <h3>add courses</h3>
                        <input type="text" name="name" class="box" placeholder="Enter Your name" required>
                        <input type="number" min="0" name="pnum" class="box" placeholder="Enter Phone number" required>
                        <input type="email" name="email" placeholder="admin@gmail.com" required class="box">
                        <input type="text" name="cname" class="box" placeholder="Enter course name" required>
                        <input type="text" name="tname" class="box" placeholder="Enter teacher name" required>
                        <input type="submit" value="Enroll" name="add_course" class="btn">
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