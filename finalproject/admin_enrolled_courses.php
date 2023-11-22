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
   $currentDateTime = date("Y-m-d H:i:s");
   mysqli_query($conn, "UPDATE `enrollment` SET payment_status = '$update_payment',updated_at='$currentDateTime' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}
if (isset($_POST['delete_values'])) {
   $update_id = $_POST['order_id'];
   $status = 0;
   $currentDateTime = date("Y-m-d H:i:s");


   $update_data = mysqli_query($conn, "UPDATE `enrollment` SET status='$status',updated_at='$currentDateTime' WHERE id='$update_id'");

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
   <title>Enrollment checking</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/cssstyle.css">
   <link rel="stylesheet" href="css/cssf.css">
   <link rel="stylesheet" href="css/style2.css">


</head>

<body>

   <?php include 'admin_menu.php'; ?>
   <main class="main">
      <section class="show-products">
         <section class="sone">
         </section>
         <div class="box-container">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `enrollment` where teachername='$admin_name' AND status='1'") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
               while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                  <div class="box">
                     <p> User id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                     <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                     <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                     <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                     <p> CourseName : <span><?php echo $fetch_orders['coursename']; ?></span> </p>
                     <p> Teacher Name : <span><?php echo $fetch_orders['teachername']; ?></span> </p>
                     <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                        <select name="update_payment">
                           <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                           <option value="pending">pending</option>
                           <option value="completed">completed</option>
                        </select>
                        <input type="submit" value="Update" name="update_order" class="option-btn">
                        <input type="submit" value="Delete" name="delete_values" class="delete-btn">
                     </form>
                  </div>
            <?php
               }
            } else {
               echo '<p class="empty">All enrollment have been successfully commited</p>';
            }
            ?>
         </div>
      </section>
      </section>
      </section>
   </main>
   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>

<script>
   let userBox = document.querySelector('.header .header-2 .user-box');

   document.querySelector('#user-btn').onclick = () => {
      userBox.classList.toggle('active');
      navbar.classList.remove('active');
   }
</script>
<script>
   const sidebar = document.querySelector(".sidebar");
   const sidebarClose = document.querySelector("#sidebar-close");
   const menu = document.querySelector(".menu-content");
   const menuItems = document.querySelectorAll(".submenu-item");
   const subMenuTitles = document.querySelectorAll(".submenu .menu-title");

   sidebarClose.addEventListener("click", () => sidebar.classList.toggle("close"));

   menuItems.forEach((item, index) => {
      item.addEventListener("click", () => {
         menu.classList.add("submenu-active");
         item.classList.add("show-submenu");
         menuItems.forEach((item2, index2) => {
            if (index !== index2) {
               item2.classList.remove("show-submenu");
            }
         });
      });
   });

   subMenuTitles.forEach((title) => {
      title.addEventListener("click", () => {
         menu.classList.remove("submenu-active");
      });
   });
</script>