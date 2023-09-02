<?php
require 'config/constants.php';

// Refill from if registration fails
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password       = $_SESSION['signin-data']['password'] ?? null;

// Delete signup data session
unset($_SESSION['signin-data']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fiqrv - Sign in</title>
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Iconscout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign In</h2>
            <?php if(isset($_SESSION['signup-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['signin'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);?>
                    </p>
                </div>
            <?php endif?>
            <form action="<?= ROOT_URL?>signin-logic.php" method="POST">
                <input value="<?=$username_email?>" name="username_email" type="text" placeholder="Username of Email">
                <input value="<?=$password?>" name="password" type="password" placeholder="Password">
                <button name="submit" class="btn" type="submit">Sign In</button>
                <small>Don't have an account? <a href="signup.php">Sign up</a></small>
            </form>
        </div>
    </section>
</body>
</html>