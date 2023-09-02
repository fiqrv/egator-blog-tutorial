<?php
require 'config/database.php';

if (isset($_POST['submit'])){
    // Get form data
    $title          = filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description    = filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$title){
        $_SESSION['add-category'] = "Please enter a title";
    } elseif(!$description){
        $_SESSION['add-category'] = "Please enter a description";
    }
    
    if(isset( $_SESSION['add-category'])){
        $_SESSION['add-category-data'] = $_POST;
        header('location: '. ROOT_URL .'admin/add-category.php');
        die();
    } else {
        // Create operation into categories table
        $insert_category_query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $insert_category_result = mysqli_query($connection, $insert_category_query);
        if(mysqli_errno($connection)){
            // Redirect to Sign Up page
            $_SESSION['add-category'] = "Something went wrong when adding category";
            header('location: '. ROOT_URL .'admin/add-category.php');
            die();
        } else {
            // Return form data back to Sign Up page
            $_SESSION['add-category-success'] = "New category $title successfully added";
            header('location: '. ROOT_URL .'admin/manage-categories.php');
            die();
        }
    }
}
