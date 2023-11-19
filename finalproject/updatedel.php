<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];

if (!isset($admin_id)) {
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
    } else {
        $message[] = 'Error updating data: ' . mysqli_error($conn);
    }
}

if (isset($_POST['delete_values'])) {
    $update_id = $_POST['id'];
    $status = 0;


    $update_data = mysqli_query($conn, "UPDATE `courses` SET status='$status' WHERE id='$update_id'");

    if ($update_data) {
        $message[] = 'Data has been updated!';
    } else {
        $message[] = 'Error updating data: ' . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/cssstyle.css">
    <link rel="stylesheet" href="css/style2.css">

</head>

<body>

    <?php include 'admin_menu.php'; ?>
    <main class="main">
        <section class="dashboard">
            <section class="orders">

                <h1 class="title">placed orders</h1>
                <p> user id : <span><?php echo $admin_name ?></span> </p>
                <div class="box-container">
                    <?php
                    $select_orders = mysqli_query($conn, "SELECT * FROM `courses` where status='1' AND teachername='$admin_id'") or die('query failed');
                    if (mysqli_num_rows($select_orders) > 0) {
                        while ($row = mysqli_fetch_assoc($select_orders)) {
                    ?>
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

                                    <input type="submit" value="update" name="update_values" class="btn">
                                    <input type="submit" value="Delete" name="delete_values" class="btn">
                                </form>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no orders placed yet!</p>';
                    }
                    ?>
                </div>

            </section>
        </section>
    </main>
    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>