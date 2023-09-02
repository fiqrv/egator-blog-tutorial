<?php
require 'config/database.php';

if (isset($_POST['submit'])){
    $author_id      = $_SESSION['user-id'];
    $title          = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body           = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id       = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
    $is_featured    = filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
    $thumbnail       = $_FILES['thumbnail'];

    //Set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // Validate input values
    if(!$title){
        $_SESSION['add-post'] = "Please enter a title";
    } elseif(!$category_id){
        $_SESSION['add-post'] = "Please select a category";
    } elseif(!$body){
        $_SESSION['add-post'] = "Please enter a post body";
    } elseif(!$thumbnail['name']){
        $_SESSION['add-post'] = "Please add a thumbnail";
    } else {
        //  Rename avatar file
        $time = time(); // Time as unique identifier
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        // Validate file format
        $allowed_files = ['png','jpg', 'jpeg'];
        $extension = explode('.' , $thumbnail_name);
        $extension = end($extension);
        if(in_array($extension, $allowed_files)){
            // Validate file size
            if($thumbnail['size'] < 2_000_000){
                // Upload image
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "Thumbnail is too large";
            }
        } else {
            $_SESSION['add-post'] = "Please add a valid image file";
        }
    }

    // Return if validation fails
    if(isset($_SESSION['add-post'])){
        // Return form data back to add post page
        $_SESSION['add-post-data'] = $_POST;
        header('location: '. ROOT_URL .'admin/add-post.php');
        die();
    } else {
        // Set other post is_featured to 0 if is_featured is 1
        if($is_featured == 1){
            $update_post_query = "UPDATE posts SET is_featured = 0 WHERE is_featured = 1";
            $update_post_result = mysqli_query($connection, $update_post_query);
        }

        // Insert operation into posts table
        $insert_post_query = "INSERT INTO posts (
                                title,
                                body,
                                thumbnail,
                                category_id,
                                author_id,
                                is_featured
                                ) VALUES (
                                '$title',
                                '$body',
                                '$thumbnail_name',
                                '$category_id',
                                '$author_id',
                                '$is_featured'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if(!mysqli_errno($connection)){
            // Redirect to manage posts page
            $_SESSION['add-post-success'] = "New post titled $title successfully added";
            header('location: '. ROOT_URL .'admin/index.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-post-data'] = $_POST;
            $_SESSION['add-post'] = "Something went wrong";
            header('location: '. ROOT_URL .'admin/add-post.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add-post.php');
    die();
}