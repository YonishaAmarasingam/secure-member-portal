<?php
// Include the connection file
require 'conn.php';
session_start();

$email = $fullName = $city = '';
$error = '';
$success = '';

// get the UserId from the session
$userId = $_SESSION['userId'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $city = $_POST['city'];

    //validation
    if(!empty($email) && !empty($fullName) && !empty($city)){
        try{
            $stmt = $pdo->prepare('UPDATE tbl_users SET email = ?, fullName = ?, city = ? WHERE userId = ?');
            $stmt->execute([$email, $fullName, $city, $userId]);

            $success = 'Profile updated successfully!';
        } catch(PDOExceptio $e){
            $error = 'Error in updating profile: ' . $e->getMessage();
        }
    }else{
        $error = 'Please fill in all fields';
    }
}

// Fetch the current user profile information
try {
    $stmt = $pdo->prepare('SELECT email, fullName, city FROM tbl_users WHERE userId = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if ($user) {
        $email = $user['email'];
        $fullName = $user['fullName'];
        $city = $user['city'];
    } else {
        $error = 'User not found';
    }
} catch (PDOException $e) {
    $error = 'Error fetching profile: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="form.css">

</head>
<body>
<?php include 'header.php'; ?>
<br><br><br><br>

<main>
    <div class="container">
        <h1>Update Profile</h1>
        <?php if (!empty($error)) : ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (!empty($success)) : ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form action="profile.php" method="post">
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="fullName">Full Name: </label>
                <input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($fullName); ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City: </label>
                <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>" required>
            </div>
            <button type="submit" class="btn">Update</button>
        </form>

    </div>
</main>


<?php include 'footer.php'; ?>
    
</body>
</html>