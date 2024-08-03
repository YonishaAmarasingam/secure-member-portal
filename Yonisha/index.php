<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Member Portal</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <?php include 'header.php'; ?>
    <br><br><br><br>

    <main>
        <div class="container">
            <h1>Welcome to the Secure Member Portal</h1>
            <p>This is the index page of the Secure Member Portal. Use the navigation menu to access different sections of the site.</p>
            <?php if (!isset($_SESSION['userId'])): ?>
                <p><a href="welcome.php">Welcome</a> to access protected areas.</p>
            <?php else: ?>
                <p>Welcome back, user! <a href="protected-home.php">Go to your dashboard</a>.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
