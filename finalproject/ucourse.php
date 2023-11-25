<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

$logFile = 'logfile.txt';

function logMessage($message)
{
    global $logFile;
    $fileHandle = fopen($logFile, 'a') or die("Can't open file");
    fwrite($fileHandle, $message . '  ' . date('Y-m-d H:i:s') . "\n");
    fclose($fileHandle);
}

if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);

    // Perform your database query based on the search term
    $sql = "SELECT * FROM courses WHERE coursename LIKE '%$searchTerm%' AND status='1' ORDER BY CASE WHEN coursename = '$searchTerm' THEN 0 ELSE 1 END";
    $result = $conn->query($sql);

    // Display search results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Result: " . $row['coursename'] . "<br>";
            // Add more output as needed
        }
    } else {
        echo "No results found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>courses</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/cssstyle.css">
    <link rel="stylesheet" href="css/cssf.css">


</head>

<body>

    <?php include 'usermenu.php'; ?>

    <main class="main">
        <section class="dashboard">
            <section>
                <img src="Images/background2.jpg" height="450px" width="100%">
            </section>
            <!--show courses-->
            <section class="show-products">
                <h2 style="font-size:35px; font-weight: 800; text-align:center">Enroll in any course </h2>
                <form action="" method="GET">
                    <input type="text" name="search" id="search" placeholder="Enter your search term" style="padding:1%; border-radius:10px;margin:1%">
                    <button type="submit">Search</button>
                </form>


                <div class="box-container">
                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `courses` WHERE status='1'") or die(logMessage("$user_id: Error  " . mysqli_error($conn)));
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <div class="box">
                                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                <div class="cname"><?php echo $fetch_products['coursename']; ?></div>
                                <div class="cname"><?php echo $fetch_products['teachername']; ?></div>
                                <div class="cname">Capacity: <?php echo $fetch_products['capacity']; ?>/-</div>
                                <div class="cname"><?php echo $fetch_products['type']; ?></div>
                                <input type="number" name="assignment" readonly="true" value="<?php echo $fetch_products['assignment']; ?>">
                                <input type="number" name="quizes" readonly="true" value="<?php echo $fetch_products['quizes']; ?>">
                                <div class="option-btn"><a href='enroll.php?id=<?php echo $fetch_products['id']; ?> ' class="option-btn">Enroll</a></div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>
                </div>
            </section>
            <?php include 'footer.php'; ?>
        </section>
    </main>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>