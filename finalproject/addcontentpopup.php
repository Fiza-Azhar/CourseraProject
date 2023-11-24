<?php

include 'connection.php'; //this is used to connect with xampp sql (backend)

session_start(); //superglobal in PHP to store and retrieve values

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {  //checking if admin is login or not if not it ill redirect it to loginpage 
    header('location:login.php');
    exit(); // Add exit here
}

if (isset($_POST['add_content'])) {
    $cname = $_POST['cname']; // // Use the correct variable name that is in your html 
    $file = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_folder = 'uploaded_files/' . $file;
    $tmessage = $_POST['textmessages']; // // Use the correct variable name that is in your html 
    $currentDateTime = date("Y-m-d H:i:s");
    $add_course_query = mysqli_query($conn, "INSERT INTO `coursecontent` (coursename,file, message) VALUES($cname','$file_folder', '$tmessage')") or die('query failed');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>content popup</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cssstyle.css">
</head>

<body>
    <?php include 'admin_menu.php'; ?>
    <!-- show courses  -->
    <main class="main">
        <section class="dashboard">
            <section class="sone">
            </section>
            <section class="add-products">
                <div class="right_item">
                    <!-- html basic form  -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>ADD CONTENT</h3>
                        <input type="text" name="cname" class="box" placeholder="Enter Course name" required>
                        <input type="file" id="file" name="file" class="box" accept=".pdf, .doc, .docx">
                        <input type="text" name="textmessages" class="box" placeholder="Enter any Message" required>
                        <input type="submit" value="Add" name="add_content" class="btn">
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