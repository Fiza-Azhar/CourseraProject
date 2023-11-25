<?php
session_start();

include 'connection.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faqs</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/cssstyle.css">
    <style>
        .accordion {
            padding: 5%;
            width: 1050px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding-top: 10%;
        }

        .accordion h2 {
            font-size: 30px;
            font-weight: 800;
            text-align: center;
        }

        .accordion-item {
            border-bottom: 1px solid #ddd;
        }

        .accordion-header {
            padding: 15px;
            cursor: pointer;
            user-select: none;
            background-color: #f8f8f8;
            transition: background-color 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: black;
            font-weight: bold;
        }

        .accordion-header:hover {
            background-color: #e0e0e0;
        }

        .accordion-content {
            padding: 15px;
            display: none;
        }

        .accordion-item.active .accordion-content {
            display: block;
        }

        .accordion-header .arrow {
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 5px 5px 0 5px;
            border-color: #555 transparent transparent transparent;
            transition: transform 0.3s ease;
        }

        .accordion-item.active .accordion-header .arrow {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>

    <?php include 'usermenu.php'; ?>
    <section class="main">


        <div class="accordion">
            <h2> Accordian</h2>
            <div class="accordion-item">
                <div class="accordion-header">
                    What is Coursera?
                    <div class="arrow"></div>
                </div>
                <div class="accordion-content">
                    <p>Coursera is an online learning platform that offers a wide range of courses, specializations, and degrees across various subjects.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    How does Coursera work?
                    <div class="arrow"></div>
                </div>
                <div class="accordion-content">
                    <p> Coursera works by connecting learners with instructors from top universities and organizations. Users can browse through a catalog of courses, enroll in them, and access course materials, including video lectures, quizzes, and assignments.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    What types of courses are available on Coursera?
                    <div class="arrow"></div>
                </div>
                <div class="accordion-content">
                    <p>Coursera offers a diverse range of courses, including but not limited to computer science, business, arts and humanities, health, and social sciences. </p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    How is learning assessed on Coursera?
                    <div class="arrow"></div>
                </div>
                <div class="accordion-content">
                    <p> Learning on Coursera is assessed through a combination of quizzes, assignments, peer-reviewed assessments, and exams, depending on the course. The assessment methods are designed to evaluate understanding and application of the course material.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    Can I earn a degree on Coursera?
                    <div class="arrow"></div>
                </div>
                <div class="accordion-content">
                    <p> Yes, Coursera offers online degrees and master's programs in collaboration with top universities. These programs often provide a flexible and more affordable alternative to traditional on-campus degrees.</p>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </section>

    <!-- custom js file link  -->
    <script src="js/faq.js">

    </script>

</body>

</html>