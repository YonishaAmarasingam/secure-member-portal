<?php
// Include the connection file
require 'conn.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Member Portal</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Simple styles for the protected home page */
        .menu a {
            display: block;
            margin-bottom: 10px;
            color: #007bff;
            text-decoration: none;
            font-size: 1.2em;
        }

        .menu a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <br><br><br><br>

    <main>
    <div class="container">
        <h1>Welcome to Your Dashboard</h1>
        <div class="menu">
            <a href="profile.php">Update Profile</a>
            <a href="account.php">Change Password</a>
            <a href="holiday.php">View Public Holidays</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</main>

    <?php include 'footer.php'; ?>
</body>
</html>
