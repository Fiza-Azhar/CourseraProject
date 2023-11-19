<?php

include 'connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_POST['update_order'])) {

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `enrollment` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
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
               $select_orders = mysqli_query($conn, "SELECT * FROM `enrollment` where teachername='$admin_name'") or die('query failed');
               if (mysqli_num_rows($select_orders) > 0) {
                  while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
               ?>
                     <div class="box">

                        <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                        <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                        <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                        <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                        <p> CourseName : <span><?php echo $fetch_orders['coursename']; ?></span> </p>
                        <p> Teacher Name : <span><?php echo $fetch_orders['teachername']; ?></span> </p>
                        <form action="" method="post">
                           <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                           <select name="update_payment">
                              <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                              <option value="pending">pending</option>
                              <option value="completed">completed</option>
                           </select>
                           <input type="submit" value="update" name="update_order" class="option-btn">
                           <a href="admin_enrolled_courses.php" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
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