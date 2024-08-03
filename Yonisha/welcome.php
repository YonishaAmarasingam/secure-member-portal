<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Secure Member Portal</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <?php include 'header.php'; ?>
    <br><br><br><br>

    <main>
        <div class="container">
            <h1>Welcome to the Secure Member Portal</h1>
            <p>You need to be logged in to access the member area. Please log in to continue.</p>
            <p><a href="login.php" class="btn">Login</a></p>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
