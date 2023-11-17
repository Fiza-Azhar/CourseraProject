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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./css/style2.css">

</head>

<body>


    <header class="header">

        <div class="flex">

            <a href="home.php" class="logo">Cour<span>sera</span></a>

            <div class="header-btn">
                <a href="register.php" class="head-btn1">Register</a>
                <a href="login.php" class="head-btn2">Login</a>
                <a href="register.php" class="head-btn1">Help</a>
            </div>

            <div class="account-box">
                <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">logout</a>
                <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
            </div>

        </div>

    </header>
    <section class="sectionone">


    </section>
    <section id="sectiontwo">
        <div class="avatar">
            <!-- You can use an <img> tag or set the image as a background -->
            <img src="Images/avetar1.jpg" class="avatar-img">
            <img src="Images/avetar2.jpg" class="avatar-img">
            <img src="Images/avetar3.jpg" class="avatar-img">
            <img src="Images/avetar4.jpg" class="avatar-img">
        </div>
    </section>
    <section class="sectionthree">
        <div class="left-space">

        </div>
        <div class="side-Image">
            <img src="Images/education-online-books.png" class="avatar-img">
        </div>
    </section>
    <footer class="footer-distributed">

        <div class="footer-left">
            <h3>Sagar<span>Developer</span></h3>

            <p class="footer-links">
                <a href="#">Home</a>
                |
                <a href="#">About</a>
                |
                <a href="#">Contact</a>
                |
                <a href="#">Blog</a>
            </p>

            <p class="footer-company-name">Copyright © 2021 <strong>SagarDeveloper</strong> All rights reserved</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Ghaziabad</span>
                    Delhi</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+91 74*9*258</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:sagar00001.co@gmail.com">xyz@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span>
                <strong>Sagar Developer</strong> is a Youtube channel where you can find more creative CSS Animations
                and
                Effects along with
                HTML, JavaScript and Projects using C/C++.
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </footer>


    <script>
        let currentIndex = 0;

        function showSlide(index) {
            const carousel = document.querySelector('.carousel');
            const totalSlides = document.querySelectorAll('.carousel-item').length;

            if (index < 0) {
                currentIndex = totalSlides - 1;
            } else if (index >= totalSlides) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }

            const translateValue = -currentIndex * 100 + '%';
            carousel.style.transform = 'translateX(' + translateValue + ')';
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        // Auto slide if needed
        // setInterval(nextSlide, 3000); // Change slide every 3 seconds
    </script>

</body>

</html>