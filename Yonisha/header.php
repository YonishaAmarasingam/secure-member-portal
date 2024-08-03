    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="logo.png" alt="Secure Member Portal Logo"></a>
            </div>
            <nav>
                <ul>
                    <?php if (isset($_SESSION['userId'])): ?>
                        <li><a href="protected-home.php">Home</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="account.php">Account</a></li>
                        <li><a href="holiday.php">Holidays</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <!-- <li><a href="welcome.php">Welcome</a></li>
                        <li><a href="login.php">Login</a></li> -->
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
