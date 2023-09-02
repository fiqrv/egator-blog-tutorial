<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch users
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // Make sure user equal to one
    if(mysqli_num_rows($result) == 1){
        var_dump($user);
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        if($avatar_path){
            unlink($avatar_path);
        }
    }

    // Fetch all thumnail of the user and delete them
    $thumbnail_query = "SELECT thumnail FROM posts WHERE author_id=$id";
    $thumbnail_result = mysqli_query($connection, $thumbnail_query);

    if(mysqli_num_rows($thumbnail_result) > 0){
        while($thumbnail = mysqli_fetch_assoc($thumbnail_result)){
            $thumbnail_path = '../images/' . $thumbnail['thumnail'];
            // Delete thumnail from images
            if($thumbnail_path){
                unlink($thumbnail_path);
            }
        }
    }


    // Delete user from database
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);

    if(mysqli_errno($connection)){
        $_SESSION['delete-user'] = "Could not delete user {$user['firstname']} {$user['lastname']}";
    } else {
        $_SESSION['delete-user-success'] = "User {$user['firstname']} {$user['lastname']} deleted succesfully";
    }

}

header('location: '. ROOT_URL .'admin/manage-users.php');
die();
