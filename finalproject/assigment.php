<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit(); // Add exit here
}

if (isset($_POST['add_assigment'])) {


    $cname = $_POST['cname']; // // Use the correct variable name that is in your html 
    $aname = $_POST['aname'];
    $file = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_folder = 'uploaded_files/' . $file;
    $meetingDateTime = $_POST['meetingDateTime'];


    $add_course_query = mysqli_query($conn, "INSERT INTO `assignment` (coursename, assigmentname, file, datetime) VALUES('$cname', '$aname', '$file_folder', '$meetingDateTime')") or die('query failed');
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
    <?php include 'admin_menu.php'; ?>
    <!-- product CRUD section starts  -->



    <!-- product CRUD section ends -->

    <!-- show courses  -->
    <main class="main">
        <section class="dashboard">
            <section class="add-products">
                <div class="right_item">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>add courses</h3>
                        <input type="text" name="aname" class="box" placeholder="Enter Assigment Name" required>
                        <input type="text" name="cname" class="box" placeholder="Enter Course Name" required>
                        <input type="file" id="file" name="file" accept=".pdf, .doc, .docx">
                        <input type="datetime-local" id="meetingDateTime" name="meetingDateTime" required>
                        <input type="submit" value="add course" name="add_assigment" class="btn">
                    </form>
                </div>
            </section>
        </section>
    </main>

    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

    <!-- ... (unchanged) ... -->
</body>

</html>