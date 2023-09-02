<?php
require 'config/constants.php';

// Get back form data if registration fails
$firstname          = $_SESSION['signup-data']['firstname'] ?? null;
$lastname           = $_SESSION['signup-data']['lastname'] ?? null;
$username           = $_SESSION['signup-data']['username'] ?? null;
$email              = $_SESSION['signup-data']['email'] ?? null;
$createpassword     = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword    = $_SESSION['signup-data']['confirmpassword'] ?? null;

// Delete signup data session
unset($_SESSION['signup-data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fiqrv - Sign Up</title>
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?= ROOT_URL?>css/style.css">
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
            <h2>Sign Up</h2>
            <?php if(isset($_SESSION['signup'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signup'];
                        unset($_SESSION['signup']);?>
                    </p>
                </div>
            <?php endif?>
            <form action="<?= ROOT_URL?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input value="<?=$firstname?>" type="text" name="firstname" placeholder="First Name">
                <input value="<?=$lastname?>" type="text" name="lastname" placeholder="Last Name">
                <input value="<?=$username?>" type="text" name="username" placeholder="Username">
                <input value="<?=$email?>" type="email" name="email" placeholder="Email">
                <input value="<?=$createpassword?>" type="password" name="createpassword" placeholder="Create Password">
                <input value="<?=$confirmpassword?>" type="password" name="confirmpassword" placeholder="Confirm Password">
                <div class="form__control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button class="btn" name="submit" type="submit">Sign Up</button>
                <small>Already have an account? <a href="signin.php">Sign in</a></small>
            </form>
        </div>
    </section>
</body>
</html>