<?php
include 'partials/header.php';

// Fetch all posts from database
$posts_query = "  SELECT 
            posts.id,
            posts.title,
            posts.body,
            posts.date_time,
            posts.thumbnail,
            categories.title AS category_title,
            categories.id AS category_id,
            users.avatar,
            users.firstname,
            users.lastname
            FROM posts
            INNER JOIN categories ON posts.category_id = categories.id
            INNER JOIN users ON posts.author_id = users.id
            ORDER BY date_time DESC";
$posts = mysqli_query($connection, $posts_query);

// Fetch categories from database
$categories_query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $categories_query);
?>

<section class="search__bar">
    <form action="<?= ROOT_URL ?>search.php" class="container search__bar-container" method="GET">
        <div>
            <i class="uil uil-search"></i>
            <input type="search" name="search" placeholder="Search">
        </div>
        <button class="btn" name="submit" type="submit">Go</button>
    </form>
</section>
<!-- END OF SEARCH -->

<section class="posts <?= $posts ? '' : 'section__extra-margin'?>">
    <div class="container posts__container">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
        <article class="post">
            <div class="post__thumbnail">
                <img src="images/<?=$post['thumbnail']?>">
            </div>
            <div class="post__info">
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?=$post['category_id']?>" class="category__button"><?=$post['category_title']?></a>
                <h3 class="post__title">
                    <a href="<?= ROOT_URL ?>post.php?id=<?=$post['id']?>"><?=$post['title']?></a>
                </h3>
                <p class="post__body">
                    <?= substr($post['body'], 0, 300)?>...
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="images/<?=$post['avatar']?>">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?=$post['firstname']?> <?=$post['lastname']?></h5>
                        <small>
                            <?= date("M d, Y - h:i a", strtotime($post['date_time']))?>
                            <?php
                                date_default_timezone_set('Asia/Kuala_Lumpur'); // Set the timezone to Kuala Lumpur
                                $featuredDateTime = strtotime($post['date_time']);
                                $currentDateTime = time();
                                $timeDiffInSeconds = $currentDateTime - $featuredDateTime;
                                $hoursAgo = floor($timeDiffInSeconds / 3600);
                                
                                if ($hoursAgo <= 24) {
                                    echo " ($hoursAgo hour ago)";
                                }
                            ?>
                        </small>
                    </div>
                </div>
            </div>
        </article>
        <?php endwhile ?>
    </div>
</section>
<!-- END OF POSTS -->

<section class="category__buttons">
    <div class="container category__buttons-container">
    <?php if(mysqli_num_rows($categories) > 0) :?>
        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
        <a href="<?= ROOT_URL ?>category-posts.php?id=<?=$category['id']?>" class="category__button"><?=$category['title']?></a>
        <?php endwhile; ?>
    <?php else :?>
    <div class="alert__message error">
        <p><?= "No categories found"?></p>
    </div>
    <?php endif?>
    </div>
</section>
<!-- END OF CATEGORY BUTTONS-->

<?php
include 'partials/footer.php'
?>