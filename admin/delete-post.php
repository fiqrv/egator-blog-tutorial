<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch posts
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);

    // Make sure post row equal to one
    if(mysqli_num_rows($result) == 1){
        var_dump($post);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if($thumbnail_path){
            unlink($thumbnail_path);
        }
    }

    // Delete post from database
    $delete_post_query = "DELETE FROM posts WHERE id=$id";
    $delete_post_result = mysqli_query($connection, $delete_post_query);

    if(mysqli_errno($connection)){
        $_SESSION['delete-post'] = "Could not delete post titled {$post['title']}";
    } else {
        $_SESSION['delete-post-success'] = "Post titled {$post['title']} deleted succesfully";
    }
}

header('location: '. ROOT_URL .'admin/index.php');
die();