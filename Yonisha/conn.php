<?php
$servername = "localhost";
$username = "root"; // default XAMPP user
$password = ""; // default XAMPP password
$dbname = "secure_member_portal";

$dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Set to throw exceptions (even without try-catch, PDO will throw exceptions)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch results as associative arrays
];

// Create a new PDO instance
$pdo = new PDO($dsn, $username, $password, $options);

// Basic connection check (PDO will throw an exception if the connection fails)
if ($pdo) {
    echo "Connected successfully!";
} else {
    echo "Connection failed!";
}
?>
