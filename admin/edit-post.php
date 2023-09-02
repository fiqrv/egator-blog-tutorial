<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: '. ROOT_URL .'admin/index.php');
    die();
}

// Fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
        <form action="<?= ROOT_URL?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" value="<?=$post['id']?>" name="id">
            <input type="hidden" value="<?= $post['thumbnail']?>" name="previous_thumbnail_name">
            <input name="title" value="<?=$post['title']?>" type="text" placeholder="Title">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?=$category['id']?>"><?=$category['title']?></option>
                <?php endwhile; ?>
            </select>
            <textarea name="body" rows="10" placeholder="Description"><?=$post['body']?></textarea>
            <?php if(isset($_SESSION['user_is_admin'])) : ?>
            <div class="form__control inline">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" checked>
                <label for="is_featured">Featured</label>
            </div>
            <?php endif?>
            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button class="btn" name="submit" type="submit">Update Post</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>


