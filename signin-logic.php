<?php
require 'config/database.php';

if (isset($_POST['submit'])){
    // Get form data
    $username_email = filter_var($_POST['username_email'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password       = filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate input values
    if(!$username_email){
        $_SESSION['signin'] = "Username or Email required";
    } elseif(!$password){
        $_SESSION['signin'] = "Password required";
    } else {
        // Fetch user from users table
        $fetch_user_query = "SELECT * FROM users WHERE 
                                username='$username_email' OR
                                email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if(mysqli_num_rows($fetch_user_result) == 1){
            //  Convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            // Validate input password with db password
            if(password_verify($password, $db_password)){
                // Set session value for access control
                $_SESSION['user-id'] = $user_record['id'];
                if($user_record['is_admin'] == 1){
                    $_SESSION['user_is_admin'] = true;  
                }

                // Log user in
                header('location: '. ROOT_URL .'admin/');
            } else {
                $_SESSION['signin'] = "Invalid password";
            }
        } else {
            $_SESSION['signin'] = "Invalid credential";
        }
    }

    if(isset($_SESSION['signin'])){
        // Return form data back to Sign Up page
        $_SESSION['signin-data'] = $_POST;
        header('location: '. ROOT_URL .'signin.php');
        die();
    }

}   else {
    // If button wasn't clicked, return
    header('location: '. ROOT_URL .'signin.php');
    die();
}