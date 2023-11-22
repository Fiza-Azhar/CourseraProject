<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"></script>
    <title>Your Website</title>
</head>

<body>

    <ul class="menu">
        <li class="item">
            <i class="fas fa-envelope"></i>
            <a href="addcontentpopup.php" id="openModalBtn">Add Course Content</a>
        </li>
    </ul>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="submit_form.php" method="post">
                <h2>Add Content Form</h2>
                <label for="name">Name:</label>
                <input type="text" name="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <script>
        document.getElementById('openModalBtn').addEventListener('click', openModal);

        function openModal() {
            document.getElementById('myModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>

</body>

</html>