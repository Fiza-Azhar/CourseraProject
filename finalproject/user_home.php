<?php

include 'connection.php'; //this is used to connect with xampp sql (backend)
session_start(); //superglobal in PHP to store and retrieve values


$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {    //checking if user is login or not if not it ill redirect it to loginpage 
    header('location:login.php');
}

?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Pannel</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/cssstyle.css" />
    <link rel="stylesheet" href="css/cssf.css" />


    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style></style>
</head>

<body>
    <?php include 'usermenu.php'; ?>
    <main class="main">
        <section class="dashboard">
            <section class="sone"></section>
            <section class="sectionthree">
                <div class="left-space">
                    <div class="fade-container">
                        <h1>Welcome to <span>Coursera<span></h1>
                        <p>Explore a world of knowledge and enhance your skills with Coursera. Our platform offers a diverse range of courses taught by experts from top universities and organizations. Whether you're looking to advance your career or pursue a personal interest, Coursera provides the tools and resources you need to succeed.</p>
                        <a href="user_query.php"> <button class="joinus">Join Us</button></a>
                    </div>
                </div>
            </section>
            <footer class="footer-distributed">

                <section id="section4">
                    <h2>Frequently Asked Questions</h2>
                    <div class="whole">
                        <div class="image">
                            <img src="Images/pic" height="400px" width="450px">
                        </div>
                        <div class="accordion">
                            <div class="accordion-section">
                                <div class="accordion-header">
                                    What is Topic Listing?
                                    <span class="arrow"></span>
                                </div>
                                <div class="accordion-content">
                                    You can search on Google with keywords such as templatemo portfolio, templatemo one-page layouts, photography, digital marketing, etc.
                                </div>
                            </div>
                            <div class="accordion-section">
                                <div class="accordion-header">
                                    What is Topic Listing2?
                                    <span class="arrow"></span>
                                </div>
                                <div class="accordion-content">
                                    You can search on Google with keywords such as templatemo portfolio, templatemo one-page layouts, photography, digital marketing, etc.
                                </div>
                            </div>
                            <div class="accordion-section">
                                <div class="accordion-header">
                                    What is Topic Listing3?
                                    <span class="arrow"></span>
                                </div>
                                <div class="accordion-content">
                                    You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>

                </section>

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

                <div class="footer-left">
                    <h3>Maryam<span>Developer</span></h3>

                    <p class="footer-links">
                        <a href="#">Home</a>
                        |
                        <a href="#">About</a>
                        |
                        <a href="#">Contact</a>
                        |
                        <a href="#">FAQS</a>
                    </p>

                    <p class="footer-company-name">Copyright © 2021 <strong>SagarDeveloper</strong> All rights reserved</p>
                </div>
            </footer>

        </section>
    </main>

</body>

</html>