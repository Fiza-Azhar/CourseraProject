<?php

include 'connection.php'; // Including an external file 'config.php' that likely contains database connection details.

session_start(); // Starting a session to persist data across different pages for the same user.

$logFile = 'logfile.txt';

function logMessage($message)
{
   global $logFile;
   $fileHandle = fopen($logFile, 'a') or die("Can't open file");
   fwrite($fileHandle, $message . '  ' . date('Y-m-d H:i:s') . "\n");
   fclose($fileHandle);
}


if (isset($_POST['submit'])) { // Checking if the form with the name 'submit' is submitted.

   $email = mysqli_real_escape_string($conn, $_POST['email']); // Escaping and storing the submitted email in the $email variable.
   $pass = mysqli_real_escape_string($conn, md5($_POST['password'])); // Escaping and hashing the submitted password using MD5, then storing it in the $pass variable.

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed'); // Querying the database to select users with the provided email and password. If the query fails, it outputs 'query failed'.

   if (mysqli_num_rows($select_users) > 0) { // Checking if there's more than 0 rows (i.e., if a user with the provided email and password exists).

      $row = mysqli_fetch_assoc($select_users); // Fetching the user data as an associative array.

      if ($row['user_type'] == 'admin') { // Checking if the user type is 'admin'.

         $_SESSION['admin_name'] = $row['name']; // Storing admin name in the session variable.
         $_SESSION['admin_email'] = $row['email']; // Storing admin email in the session variable.
         $_SESSION['admin_id'] = $row['id']; // Storing admin ID in the session variable.
         $messagetext = "{$row['name']} has successfully logged in"; // If no user is found, add an error message to the $message array.
         logMessage($messagetext);
         header('location:admin_home.php'); // Redirecting to 'admin_page.php'.

      } elseif ($row['user_type'] == 'user') { // Checking if the user type is 'user'.

         $_SESSION['user_name'] = $row['name']; // Storing user name in the session variable.
         $_SESSION['user_email'] = $row['email']; // Storing user email in the session variable.
         $_SESSION['user_id'] = $row['id']; // Storing user ID in the session variable.
         $messagetext = "{$row['name']} has successfully logged in"; // If no user is found, add an error message to the $message array.
         logMessage($messagetext);
         header('location:user_home.php'); // Redirecting to 'home.php'.

      }
   } else {
      $message[] = 'incorrect email or password!'; // If no user is found, adding an error message to the $message array.
      $messagetext = "incorrect email or password! or some else error are showing up"; // If no user is found, add an error message to the $message array.
      logMessage($messagetext);
   }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      .loader {
         position: fixed;
         top: 0;
         left: 0;
         width: 100vw;
         height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         background: white;
         transition: opacity 0.75s, visibility 0.75s;
      }

      .loader--hidden {
         opacity: 0;
         visibility: hidden;
      }

      .loader::after {
         content: "";
         width: 75px;
         height: 75px;
         border: 15px solid #dddddd;
         border-top-color: blue;
         border-radius: 50%;
         animation: loading 0.75s ease infinite;
      }

      @keyframes loading {
         from {
            transform: rotate(0turn);
         }

         to {
            transform: rotate(1turn);
         }
      }
   </style>
</head>

<body>

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


   <div class=" form-container">
      <div class="loader"></div>
      <div class="right_item">
         <form action="" method="post">
            <h3>Hello! Friends</h3>
            <label for="Username">Email:</label>
            <input type="email" name="email" placeholder="admin@gmail.com" required class="box">
            <label for="Password">Password:</label>
            <input type="password" name="password" placeholder="**********" required class=" box">
            <input type="submit" name="submit" value="Login Now" class="btn">
            <p>Don't have an account? <a href="register.php">Register Now</a></p>
         </form>
      </div>
   </div>
   <script src="js/loader.js">

   </script>
</body>

</html>