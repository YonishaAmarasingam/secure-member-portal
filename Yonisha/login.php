<?php
// Include the connection file
require 'conn.php'; // Ensure this path is correct

// Start the session
session_start();

// Initialize variables
$email = $password = '';
$remember_me = false;
$error = '';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    // Validation
    if (!empty($email) && !empty($password)) {
        try {
            // Prepare and execute the query
            $stmt = $pdo->prepare('SELECT userId, password FROM tbl_users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user) {
                // Check the password
                if ($password === $user['password']) {
                    $_SESSION['userId'] = $user['userId'];

                    // Set cookies if "Remember Me" is checked
                    if ($remember_me) {
                        setcookie('email', $email, time() + (86400 * 30), "/"); // 30 days
                        setcookie('password', $password, time() + (86400 * 30), "/"); // 30 days
                    }

                    // Redirect to protected home page
                    header('Location: protected-home.php');
                    exit();
                } else {
                    $error = 'Invalid login';
                }
            } else {
                $error = 'No user found';
            }
        } catch (PDOException $e) {
            $error = 'Database query failed: ' . $e->getMessage();
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
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Form styles */
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

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 10px;
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

        /* Error message styles */
        .error {
            color: #d9534f;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<main>
    <div class="container">
        <h1>Login</h1>
        <?php if (!empty($error)) : ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="remember_me">
                    <input type="checkbox" name="remember_me" id="remember_me" <?php echo $remember_me ? 'checked' : ''; ?>> Remember Me
                </label>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
