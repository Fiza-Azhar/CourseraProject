<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Admin Dashboard </title>
    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="css/style.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <nav class="sidebar">
        <a href="admin_home.php" class="logo">Cour<span>sera</span></a>
        <div class="menu-content">
            <ul class="menu-items">
                <li class="item">
                    <i class="fas fa-home"></i>
                    <a href="admin_home.php">Home</a>
                </li>

                <li class="item">
                    <i class="fas fa-plus"></i>
                    <a href="addcourse.php">Add Courses</a>
                </li>
                <li class="item">
                    <i class="fas fa-home"></i>
                    <a href="updatedel.php">Update and Delete Courses</a>
                </li>
                <li class="item">
                    <i class="fas fa-search"></i>
                    <a href="admin_enrolled_courses.php">Adjust Courses</a>
                </li>
                <li class="item">
                    <i class="fas fa-users"></i>
                    <a href="addassignment.php">Add Assigment</a>
                </li>
                <li class="item">
                    <i class="fas fa-envelope"></i>
                    <a href="rcv_query.php">Check Query</a>
                </li>
                <li class="item">
                    <i class="fas fa-envelope"></i>
                    <a href="addcontentpopup.php">Add Course Content</a>
                </li>
        </div>
    </nav>



    <nav class="navbar">
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
        <div id="user-btn" class="fas fa-user"></div>
    </nav>

    <div class="account-box">
        <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
        <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
        <a href="logout.php" class="delete-btn">logout</a>
        <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
    </div>


    <script src="js/admin_jquery.js"></script>
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
</body>

</html>