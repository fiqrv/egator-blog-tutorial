<?php
include 'partials/header.php';

// Get back form data if registration fails
$firstname          = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname           = $_SESSION['add-user-data']['lastname'] ?? null;
$username           = $_SESSION['add-user-data']['username'] ?? null;
$email              = $_SESSION['add-user-data']['email'] ?? null;
$createpassword     = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword    = $_SESSION['add-user-data']['confirmpassword'] ?? null;

// Delete signup data session
unset($_SESSION['add-user-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        <?php if(isset($_SESSION['add-user'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']);?>
                </p>
            </div>
        <?php endif?>
        <form action="<?= ROOT_URL?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input value="<?=$firstname?>"name="firstname" type="text" placeholder="First Name">
            <input value="<?=$lastname?>" name="lastname" type="text" placeholder="Last Name">
            <input value="<?=$username?>" name="username" type="text" placeholder="Username">
            <input value="<?=$email?>" name="email" type="email" placeholder="Email">
            <input value="<?=$createpassword?>" name="createpassword" type="password" placeholder="Create Password">
            <input value="<?=$confirmpassword?>"name="confirmpassword" type="password" placeholder="Confirm Password">
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button class="btn" name="submit" type="submit">Add User</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>

