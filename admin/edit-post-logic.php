<?php
require 'config/database.php';

if (isset($_POST['submit'])){
    // Get form data
    $id                         = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name    = filter_var($_POST['previous_thumbnail_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title                      = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body                       = filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id                = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
    $is_featured                = filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
    $thumbnail                  = $_FILES['thumbnail'];

    // Set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // Validate input values
    if(!$title){
        $_SESSION['edit-post'] = "Please enter a title";
    } elseif(!$category_id){
        $_SESSION['edit-post'] = "Please select a category";
    } elseif(!$body){
        $_SESSION['edit-post'] = "Please enter a post body";
    } else {
        // Delete existing thumbnail if new one is uploaded
        if($thumbnail['name']){
            $previous_thumbnail_name = '../images/' . $previous_thumbnail_name;
            if($previous_thumbnail_name){
                unlink($previous_thumbnail_name);
            }

            // Rename thumbnail file
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
                    $_SESSION['edit-post'] = "Thumbnail is too large";
                }
            } else {
                $_SESSION['edit-post'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if(isset($_SESSION['edit-post'])){
        header('location: '. ROOT_URL .'admin/edit-post.php');
        die();
    } else {
        // Set other post is_featured to 0 if is_featured is 1
        if($is_featured == 1){
            $update_post_query = "UPDATE posts SET is_featured = 0 WHERE is_featured = 1";
            $update_post_result = mysqli_query($connection, $update_post_query);
        }

        // Set which thumbnail to use
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        // Update operation into posts table
        $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id='$category_id', is_featured='$is_featured' WHERE id=$id";
        $result = mysqli_query($connection, $query);

        if(!mysqli_errno($connection)){
            // Redirect to manage posts page
            $_SESSION['edit-post-success'] = "Post titled $title successfully updated";
            header('location: '. ROOT_URL .'admin/index.php');
            die();
        } else {
            // Return to manage posts page
            $_SESSION['add-post'] = "Something went wrong";
            header('location: '. ROOT_URL .'admin/add-post.php');
            die();
        }
    }
} else {
    header('location: '. ROOT_URL .'admin/index.php');
    die();
}
