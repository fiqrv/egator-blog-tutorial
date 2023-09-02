<?php
include 'partials/header.php';

// Fetch post from database if set
if(isset($_GET['id'])) {
    $post_query = " SELECT 
                    posts.id,
                    posts.title,
                    posts.body,
                    posts.date_time,
                    posts.thumbnail,
                    users.avatar,
                    users.firstname,
                    users.lastname
                    FROM posts
                    INNER JOIN users ON posts.author_id = users.id
                    WHERE posts.id = " . $_GET['id'];
    $post_result = mysqli_query($connection, $post_query);
    $post = mysqli_fetch_assoc($post_result);
} else {
    header('location: '. ROOT_URL .'index.php');
    die();
}
?>

<section class="singlepost">
    <div class="container singlepost__container">
        <h2><?=$post['title']?></h2>
        <div class="post__author">
            <div class="post__author-avatar">
                <img src="images/<?=$post['avatar']?>">
            </div>
            <div class="post__author-info">
                <h5>By : <?=$post['firstname']?> <?=$post['lastname']?></h5>
                <small>
                    <?= date("M d, Y - h:i a", strtotime($post['date_time']))?>
                    <?php
                        date_default_timezone_set('Asia/Kuala_Lumpur');
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
        <div class="singlepost__thumbnail">
            <img src="images/<?=$post['thumbnail']?>">
        </div>
        <p><?=$post['body']?></p>
    </div>
</section>
<!-- End of Single Post -->

<?php
include 'partials/footer.php'
?>

