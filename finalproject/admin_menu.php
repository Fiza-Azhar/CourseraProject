<?php
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit(); // Add exit here
}
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
    <link rel="stylesheet" href="css/cssf.css" />
    <link rel="stylesheet" href="css/style.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <nav class="sidebar">
        <a href="admin_home.php" class="logo">Cour<span>sera</span></a>
        <div class="menu-content">
            <ul class="menu-items">
                <!-- This is just a simple menu page-->
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
                <ul class="menu">
                    <li class="item">
                        <i class="fas fa-envelope"></i>
                        <a><button id="addContent" style="color:white; font-weight: 900px">Add Course Content</button></a>
                    </li>
                </ul>
                <dialog id="contentDialog" class="dialog" style="
    height: 80%;
    width: 80%;
    margin: auto;
    background-color:beige;
    display:block
">
                    <span class="close" onclick="closeDialog()">&times;</span>
                    <div class="box-container">
                        <?php
                        $select_products = mysqli_query($conn, "SELECT * FROM `courses` where teachername='$admin_name' AND status='1'") or die('query failed');
                        if (mysqli_num_rows($select_products) > 0) {
                            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                        ?>
                                <div class="box">
                                    <?php
                                    // Assuming $fetch_products is an array with image information
                                    $imagePath = 'uploaded_img/' . $fetch_products['image'];
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" alt="">
                                    <div class="box"><?php echo $fetch_products['coursename']; ?></div>
                                    <div class="box"><?php echo $fetch_products['teachername']; ?></div>
                                    <div class="box"><?php echo $fetch_products['capacity']; ?>/-</div>
                                    <input class="box" type="number" name="assignment" readonly="true" value="<?php echo $fetch_products['assignment']; ?>">
                                    <input class="box" type="number" name="quizes" readonly="true" value="<?php echo $fetch_products['quizes']; ?>">
                                    <div class="box"><?php echo $fetch_products['type']; ?></div>
                                    <a href="addcontentpopup.php" class="btn" style="color:black">Add Content </style></a>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<p class="empty">no products added yet!</p>';
                        }
                        ?>
                    </div>
                </dialog>
        </div>
    </nav>



    <nav class="navbar">
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>
    <script>
        document.getElementById('addContent').addEventListener('click', function() {
            document.getElementById('contentDialog').showModal();
        });

        function closeDialog() {
            document.getElementById('contentDialog').close();
        }
    </script>

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