<?php
include 'partials/header.php';

// Get back form data if adding fails
$title          = $_SESSION['add-category-data']['title'] ?? null;
$description    = $_SESSION['add-category-data']['description'] ?? null;

// Delete signup data session
unset($_SESSION['add-category-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php if(isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']);?>
                </p>
            </div>
        <?php endif?>
        <form action="<?= ROOT_URL?>admin/add-category-logic.php" method="POST">
            <input value="<?=$title?>" name="title" type="text" placeholder="Title">
            <textarea name="description" id="" rows="4" placeholder="Description"><?=$description?></textarea>
            <button class="btn" name="submit" type="submit">Add Category</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>