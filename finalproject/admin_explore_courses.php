<?php

include 'connection.php'; //this is used to connect with xampp sql (backend)
session_start();  //superglobal in PHP to store and retrieve values
$admin_id = $_SESSION['admin_id'];   //getting the value that we store in a session variable

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


    $select_course_name = mysqli_query($conn, "SELECT coursename, teachername FROM `courses` WHERE teachername = '$tname' AND coursename = '$cname'") or die('query failed');

    if (mysqli_num_rows($select_course_name) > 0) {
        $message[] = 'course name already added';
    } else {
        $add_course_query = mysqli_query($conn, "INSERT INTO `courses`(coursename, teachername, capacity, assignment, quizes, type,image) VALUES('$cname', '$tname', '$capacity', '$assignment', '$quizes', '$type','$image')") or die('query failed');
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
            <section class="show-products">
                <div class="box-container">
                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `courses` where status ='1'") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <div class="box">
                                <?php
                                // Assuming $fetch_products is an array with image information
                                $imagePath = 'uploaded_img/' . $fetch_products['image'];
                                ?>
                                <img src="<?php echo $imagePath; ?>" alt="">
                                <div class="cname"><?php echo $fetch_products['coursename']; ?></div>
                                <div class="cname"><?php echo $fetch_products['teachername']; ?></div>
                                <div class="cname">$<?php echo $fetch_products['capacity']; ?>/-</div>
                                <input type="number" name="assignment" readonly="true" value="<?php echo $fetch_products['assignment']; ?>">
                                <input type="number" name="quizes" readonly="true" value="<?php echo $fetch_products['quizes']; ?>">
                                <div class="cname"><?php echo $fetch_products['type']; ?></div>
                                <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
                                <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="option-btn" onclick="return confirm('delete this product?');">delete</a>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>
                </div>

            </section>
        </section>
    </main>

    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

    <!-- ... (unchanged) ... -->
</body>

</html>