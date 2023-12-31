<?php

include 'connection.php';


$logFile = 'logfile.txt';

function logMessage($message)
{
    global $logFile;
    $fileHandle = fopen($logFile, 'a') or die("Can't open file");
    fwrite($fileHandle, $message . '  ' . date('Y-m-d H:i:s') . "\n");
    fclose($fileHandle);
}


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'user already exist!';
        $messagetext = "Sorry this user have already registered"; // If no user is found, add an error message to the $message array.
        logMessage($messagetext);
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
            $messagetext = "Password not matched"; // If no user is found, add an error message to the $message array.
            logMessage($messagetext);
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'registered successfully!';
            $messagetext = "Sccessfully registered"; // If no user is found, add an error message to the $message array.
            logMessage($messagetext);
            header('location:login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

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
    <div class="form-container">
        <div class="loader"></div>
        <div class="right_item">
            <form action="" method="post">
                <h3>Register Now</h3>
                <label for="Username">Admin:</label>
                <input type="text" name="name" placeholder="Admin" required class="box">
                <label for="Username">Email:</label>
                <input type="email" name="email" placeholder="admin@gmail.com" required class="box">
                <label for="Username">Password:</label>
                <input type="password" name="password" placeholder="*******************" required class="box">
                <label for="Username">Conform Password:</label>
                <input type="password" name="cpassword" placeholder="******************" required class="box">
                <label for="Username">Role:</label>
                <select name="user_type" class="box">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
                <input type="submit" name="submit" value="Register now" class="btn">
                <p>Already have an account? <a href="login.php">Login Now</a></p>
            </form>
        </div>
    </div>
    <script src="js/loader.js"></script>
</body>

</html>