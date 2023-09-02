<?php
// Fetch categories from database
$categories_query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $categories_query);
?>
<footer>
        <div class="footer__socials">
            <a href="https://youtube.com" target="_blank"><i class="uil uil-youtube"></i></a>
            <a href="https://facebook.com" target="_blank"><i class="uil uil-facebook-f"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="uil uil-instagram-alt"></i></a>
            <a href="https://linkedin.com" target="_blank"><i class="uil uil-linkedin"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="uil uil-twitter"></i></a>
        </div>
        <div class="container footer__container">
            <article>
                <h4>Categories</h4>
                <?php if(mysqli_num_rows($categories) > 0) :?>
                <ul>
                    <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <li><a href="<?= ROOT_URL ?>category-posts.php?id=<?=$category['id']?>"><?=$category['title']?></a></li>
                    <?php endwhile; ?>
                </ul>
                <?php else :?>
                <div class="alert__message error">
                    <p><?= "No categories found"?></p>
                </div>
                <?php endif?>
            </article>
            <article>
                <h4>Support</h4>
                <ul>
                    <li><a href="">Online Support</a></li>
                    <li><a href="">Call Numbers</a></li>
                    <li><a href="">Emails</a></li>
                    <li><a href="">Social Support</a></li>
                    <li><a href="">Location</a></li>
                </ul>
            </article>
            <article>
                <h4>Blog</h4>
                <ul>
                    <li><a href="">Safety</a></li>
                    <li><a href="">Repair</a></li>
                    <li><a href="">Recent</a></li>
                    <li><a href="">Popular</a></li>
                    <li><a href="">Categories</a></li>
                </ul>
            </article>
            <article>
                <h4>Permalinks</h4>
                <ul>
                    <li><a href="<?= ROOT_URL?>index.php">Home</a></li>
                    <li><a href="<?= ROOT_URL?>blog.php">Blog</a></li>
                    <li><a href="<?= ROOT_URL?>about.php">About</a></li>
                    <li><a href="<?= ROOT_URL?>services.php">Services</a></li>
                    <li><a href="<?= ROOT_URL?>contact.php">Contact</a></li>
                </ul>
            </article>
        </div>
        <div class="footer__copyright">
            <small>Copyright &copy; 2023 FIQRV</small>
        </div>
    </footer>

    <script src="<?php echo ROOT_URL?>js./main.js"></script>
</body>
</html>