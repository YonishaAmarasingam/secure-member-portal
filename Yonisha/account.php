<?php
require 'conn.php'; // Ensure this path is correct

session_start();

$oldPassword = $newPassword = '';
$error = '';
$success = '';

$userId = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    if (!empty($oldPassword) && !empty($newPassword)) {
        try {
            $stmt = $pdo->prepare('SELECT password FROM tbl_users WHERE userId = ?');
            $stmt->execute([$userId]);
            $user = $stmt->fetch();

            if ($user) {
                if ($oldPassword === $user['password']) {
                    if (strlen($newPassword) >= 8 && preg_match('/[A-Za-z]/', $newPassword) && preg_match('/\d/', $newPassword)) {
                        $stmt = $pdo->prepare('UPDATE tbl_users SET password = ? WHERE userId = ?');
                        $stmt->execute([$newPassword, $userId]);

                        $success = 'Password updated successfully!';
                    } else {
                        $error = 'New password must be at least 8 characters long and include both letters and numbers';
                    }
                } else {
                    $error = 'Old password is incorrect';
                }
            } else {
                $error = 'User not found';
            }
        } catch (PDOException $e) {
            $error = 'Error updating password: ' . $e->getMessage();
        }
    } else {
        $error = 'Please fill in all fields';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="form.css">
    <style>
        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            margin: 0 auto;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 1.1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error, .success {
            margin-bottom: 20px;
        }
        .error {
            color: #d9534f;
        }
        .success {
            color: #5bc0de;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <h1>Update Password</h1>
            <?php if (!empty($error)) : ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if (!empty($success)) : ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>
            <form action="account.php" method="post">
                <div class="form-group">
                    <label for="oldPassword">Old Password: </label>
                    <input type="password" name="oldPassword" id="oldPassword" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password: </label>
                    <input type="password" name="newPassword" id="newPassword" required>
                </div>
                <button type="submit">Update Password</button>
            </form>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
