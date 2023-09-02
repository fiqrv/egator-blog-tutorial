<?php
require 'config/database.php';

// Get Signup form data if signup button was clicked
if (isset($_POST['submit'])){
    // Get form data
    $firstname          = filter_var($_POST['firstname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname           = filter_var($_POST['lastname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username           = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email              = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
    $createpassword     = filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword    = filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin           = filter_var($_POST['userrole'],FILTER_SANITIZE_NUMBER_INT);
    $avatar             = $_FILES['avatar'];

    // Check if variable passed properly
    //var_dump($avatar);
    // echo $firstname, $lastname, $username, $email, $createpassword, $confirmpassword;

    // Validate input values
    if(!$firstname){
        $_SESSION['add-user'] = "Please enter your First Name";
    } elseif(!$lastname){
        $_SESSION['add-user'] = "Please enter your Last Name";
    } elseif(!$username){
        $_SESSION['add-user'] = "Please enter your Username";
    } elseif(!$email){
        $_SESSION['add-user'] = "Please enter a valid email";
    // } elseif(!$is_admin){
    //     $_SESSION['add-user'] = "Please select a user role";
    } elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
        $_SESSION['add-user'] = "Password should be 8+ characters";
    } elseif(!$avatar['name']){
        $_SESSION['add-user'] = "Please add avatar picture";
    } else {
        // Check if passwords dont match
        if($createpassword !== $confirmpassword){
            $_SESSION['add-user'] = "Passwords do not match";
        } else {
            // Hash password
            $hashed_password = password_hash($createpassword,PASSWORD_DEFAULT);

            // Check if password is hashed successfully
            // echo $createpassword .'<br/>';
            // echo $hashed_password;

            // Check if username/email already exist
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION['add-user'] = "Username or Email already exist";
            } else {
                // Rename avatar file
                $time = time(); // Time as unique identifier
                $avatar_name = $time . $avatar ['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

                // Validate file format
                $allowed_files = ['png','jpg', 'jpeg'];
                $extension = explode('.' , $avatar_name);
                $extension = end($extension);
                if(in_array($extension, $allowed_files)){
                    // Validate image is not too large(1 mb+)
                    if($avatar['size'] < 100000) {
                        // Upload image
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-user'] = 'File size is too big. Should be less than 1 MB';
                    }
                } else {
                    $_SESSION['add-user'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }

    // Return if validation fails
    if(isset($_SESSION['add-user'])){
        // Return form data back to add user page
        $_SESSION['add-user-data'] = $_POST;
        header('location: '. ROOT_URL .'admin/add-user.php');
        die();
    } else {
        // Create operation into users table
        $insert_user_query = "INSERT INTO users (
                                firstname,
                                lastname,
                                username,
                                email,
                                password,
                                avatar,
                                is_admin
                                ) VALUES (
                                '$firstname',
                                '$lastname',
                                '$username',
                                '$email',
                                '$hashed_password',
                                '$avatar_name',
                                '$is_admin'
                                )";
        $insert_user_result = mysqli_query($connection, $insert_user_query);
        if(!mysqli_errno($connection)){
            // Redirect to Login page
            $_SESSION['add-user-success'] = "New user $firstname $lastname successfully added";
            header('location:' . ROOT_URL . 'admin/manage-users.php');
            die();
        } else {
            // Return form data back to add user page
            $_SESSION['add-user-data'] = $_POST;
            $_SESSION['add-user'] = "Something went wrong";
            header('location: '. ROOT_URL .'admin/add-user.php');
            die();
        }
    }

}   else {
    // If button wasn't clicked, return
    header('location: '. ROOT_URL .'admin/add-user.php');
    die();
}