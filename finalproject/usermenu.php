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
    <title>User menu</title>
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
                <div class="menu-title">User Menu</div>
                <li class="item">
                    <i class="fas fa-home"></i>
                    <a href="user_home.php">Home</a>
                </li>
                <li class="item">
                    <i class="fas fa-plus"></i>
                    <a href="#">About Us</a>
                </li>
                <li class="item">
                    <i class="fas fa-search"></i>
                    <a href="ucourse.php">Explore Courses</a>
                </li>
                <li class="item">
                    <i class="fas fa-users"></i>
                    <a href="user_query.php">Contact</a>
                </li>
                <li class="item">
                    <i class="fas fa-envelope"></i>
                    <a href="enrolled_students.php">Enroll</a>
                </li>
                <li class="item">
                    <div class="submenu-item">
                        <i class="fas fa-chevron-right"></i>
                        <span>Second submenu</span>
                    </div>

                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fas fa-chevron-left"></i>
                            About Ourself
                        </div>
                        <li class="item">
                            <i class="fas fa-map-marker"></i>
                            <a href="#">Reach Us</a>
                        </li>
                        <li class="item">
                            <i class="fas fa-envelope"></i>
                            <a href="#">Contact Us</a>
                        </li>
                        <li class="item">
                            <i class="fas fa-info"></i>
                            <a href="#">About Us</a>
                        </li>
                        <li class="item">
                            <i class="fas fa-question"></i>
                            <a href="#">FAQ's</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>



    <nav class="navbar">
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
        <div id="user-btn" class="fas fa-user"></div>
        <a href="pending_enrollment.php"> <i class="fa-solid fa-square-check fa-lg" id="scart" style="color: #ffffff;"></i></a>
    </nav>




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