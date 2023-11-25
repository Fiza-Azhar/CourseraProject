<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/cssstyle.css">
   <style>
      .authors .box-container {
         max-width: 1200px;
         margin: 0 auto;
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
         align-items: center;
         gap: 1.5rem;
         justify-content: center;
      }

      .authors .box-container .box {
         position: relative;
         text-align: center;
         border: var(--border);
         box-shadow: var(--box-shadow);
         overflow: hidden;
         border-radius: .5rem;
      }

      .authors .box-container .box img {
         width: 100%;
         height: 20rem;
         object-fit: cover;
      }

      .authors .box-container .box .share {
         position: absolute;
         top: 0;
         left: -10rem;
      }

      .authors .box-container .box:hover .share {
         left: 1rem;
      }

      .authors .box-container .box .share a {
         height: 4.5rem;
         width: 4.5rem;
         line-height: 4.5rem;
         font-size: 2rem;
         background-color: var(--white);
         border: var(--border);
         display: block;
         margin-top: 1rem;
         color: var(--black);
      }

      .authors .box-container .box .share a:hover {
         background-color: blue;
         color: white;
      }

      .authors .box-container .box h3 {
         font-size: 2.5rem;
         color: var(--black);
         padding: 1.5rem;
         background-color: var(--white);
      }

      .sectionthree {
         display: flex;
         column-gap: 15%;
         padding-top: 5%;
         padding-bottom: 5%;
      }

      .title {
         text-align: center;
         color: black
      }
   </style>
</head>

<body>

   <?php include 'usermenu.php'; ?>
   <section class="main">
      <img src="Images/b1.jpg" height="450px" width="100%">
      <section class="sectionthree">
         <div class="left-space">
            <div class="fade-container">
               <h1><span>Welcome to Coursera<span></h1>
               <p>Explore a world of knowledge and enhance your skills with Coursera. Our platform offers a diverse range of courses taught by experts from top universities and organizations. Whether you're looking to advance your career or pursue a personal interest, Coursera provides the tools and resources you need to succeed.</p>
               <a href="user_query.php"> <button class="joinus">Join Us</button></a>
            </div>
         </div>
         <div class="right"><img src="Images/b2.jpg  " height="100%" width="150%"></div>
      </section>


      <section class="authors">
         <h2 class="title">Great Teachers</h2>
         <div class="box-container">

            <div class="box">
               <img src="Images/avetar1.jpg" alt="">
               <div class="share">
                  <a href="#" class="fab fa-facebook-f"></a>
                  <a href="#" class="fab fa-twitter"></a>
                  <a href="#" class="fab fa-instagram"></a>
                  <a href="#" class="fab fa-linkedin"></a>
               </div>
               <h3>Faria Iqbal</h3>
            </div>

            <div class="box">
               <img src="Images/avetar4.jpg" alt="">
               <div class="share">
                  <a href="#" class="fab fa-facebook-f"></a>
                  <a href="#" class="fab fa-twitter"></a>
                  <a href="#" class="fab fa-instagram"></a>
                  <a href="#" class="fab fa-linkedin"></a>
               </div>
               <h3>john</h3>
            </div>

            <div class="box">
               <img src="Images/avetar1.jpg" alt="">
               <div class="share">
                  <a href="#" class="fab fa-facebook-f"></a>
                  <a href="#" class="fab fa-twitter"></a>
                  <a href="#" class="fab fa-instagram"></a>
                  <a href="#" class="fab fa-linkedin"></a>
               </div>
               <h3>Fareen Asif</h3>
            </div>

            <div class="box">
               <img src="Images/avetar2.jpg" alt="">
               <div class="share">
                  <a href="#" class="fab fa-facebook-f"></a>
                  <a href="#" class="fab fa-twitter"></a>
                  <a href="#" class="fab fa-instagram"></a>
                  <a href="#" class="fab fa-linkedin"></a>
               </div>
               <h3>Iqbal raza</h3>
            </div>
            <div class="box">
               <img src="Images/avetar3.jpg" alt="">
               <div class="share">
                  <a href="#" class="fab fa-facebook-f"></a>
                  <a href="#" class="fab fa-twitter"></a>
                  <a href="#" class="fab fa-instagram"></a>
                  <a href="#" class="fab fa-linkedin"></a>
               </div>
               <h3>Ameena Asif</h3>
            </div>
            <div class="box">
               <img src="Images/avetar4.jpg" alt="">
               <div class="share">
                  <a href="#" class="fab fa-facebook-f"></a>
                  <a href="#" class="fab fa-twitter"></a>
                  <a href="#" class="fab fa-instagram"></a>
                  <a href="#" class="fab fa-linkedin"></a>
               </div>
               <h3>Jalal Iqbal</h3>
            </div>

         </div>
         <?php include 'footer.php'; ?>
      </section>
   </section>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>