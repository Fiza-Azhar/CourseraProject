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
                        <h1><span>Welcome to Coursera<span></h1>
                        <p>Explore a world of knowledge and enhance your skills with Coursera. Our platform offers a diverse range of courses taught by experts from top universities and organizations. Whether you're looking to advance your career or pursue a personal interest, Coursera provides the tools and resources you need to succeed.</p>
                        <a href="user_query.php"> <button class="joinus">Join Us</button></a>
                    </div>
                </div>
            </section>



            <?php include 'footer.php'; ?>

        </section>
    </main>


</body>

</html>