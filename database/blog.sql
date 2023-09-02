-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 06:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(4, 'LAMP', 'desc'),
(6, 'MERN', 'desc'),
(7, 'Uncategorized', 'This is the description');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `is_featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `thumbnail`, `date_time`, `category_id`, `author_id`, `is_featured`) VALUES
(7, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus perferendis modi molestiae ab nam assumenda, nihil accusantium quod dignissimos architecto ipsum recusandae odit similique veritatis possimus perspiciatis! Maxime ipsum nulla ducimus voluptas nostrum ratione quis doloremque hic expedita consequuntur, eum tempora sed eos ipsam reprehenderit laudantium, tempore fuga. Nobis fuga in nesciunt adipisci quas repellendus. Facere ex laborum omnis suscipit eligendi enim quo, alias amet error, minima vel veniam quam nulla iure eveniet, mollitia quibusdam non. Laudantium sint fugiat dolore ea cupiditate! Porro ipsa temporibus, fuga facere dolor accusamus iste debitis. Commodi libero natus quod quae quasi rem, itaque necessitatibus.', '1693604567blog13.jpg', '2023-09-01 18:12:06', 4, 3, 0),
(9, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus perferendis modi molestiae ab nam assumenda, nihil accusantium quod dignissimos architecto ipsum recusandae odit similique veritatis possimus perspiciatis! Maxime ipsum nulla ducimus voluptas nostrum ratione quis doloremque hic expedita consequuntur, eum tempora sed eos ipsam reprehenderit laudantium, tempore fuga. Nobis fuga in nesciunt adipisci quas repellendus. Facere ex laborum omnis suscipit eligendi enim quo, alias amet error, minima vel veniam quam nulla iure eveniet, mollitia quibusdam non. Laudantium sint fugiat dolore ea cupiditate! Porro ipsa temporibus, fuga facere dolor accusamus iste debitis. Commodi libero natus quod quae quasi rem, itaque necessitatibus.', '1693592060blog4.jpg', '2023-09-01 18:14:20', 6, 3, 0),
(11, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus perferendis modi molestiae ab nam assumenda, nihil accusantium quod dignissimos architecto ipsum recusandae odit similique veritatis possimus perspiciatis! Maxime ipsum nulla ducimus voluptas nostrum ratione quis doloremque hic expedita consequuntur, eum tempora sed eos ipsam reprehenderit laudantium, tempore fuga. Nobis fuga in nesciunt adipisci quas repellendus. Facere ex laborum omnis suscipit eligendi enim quo, alias amet error, minima vel veniam quam nulla iure eveniet, mollitia quibusdam non. Laudantium sint fugiat dolore ea cupiditate! Porro ipsa temporibus, fuga facere dolor accusamus iste debitis. Commodi libero natus quod quae quasi rem, itaque necessitatibus.', '1693592144blog13.jpg', '2023-09-01 18:15:44', 6, 3, 1),
(13, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus perferendis modi molestiae ab nam assumenda, nihil accusantium quod dignissimos architecto ipsum recusandae odit similique veritatis possimus perspiciatis! Maxime ipsum nulla ducimus voluptas nostrum ratione quis doloremque hic expedita consequuntur, eum tempora sed eos ipsam reprehenderit laudantium, tempore fuga. Nobis fuga in nesciunt adipisci quas repellendus. Facere ex laborum omnis suscipit eligendi enim quo, alias amet error, minima vel veniam quam nulla iure eveniet, mollitia quibusdam non. Laudantium sint fugiat dolore ea cupiditate! Porro ipsa temporibus, fuga facere dolor accusamus iste debitis. Commodi libero natus quod quae quasi rem, itaque necessitatibus.', '1693595092blog9.jpg', '2023-09-01 19:04:52', 6, 3, 0),
(15, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus perferendis modi molestiae ab nam assumenda, nihil accusantium quod dignissimos architecto ipsum recusandae odit similique veritatis possimus perspiciatis! Maxime ipsum nulla ducimus voluptas nostrum ratione quis doloremque hic expedita consequuntur, eum tempora sed eos ipsam reprehenderit laudantium, tempore fuga. Nobis fuga in nesciunt adipisci quas repellendus. Facere ex laborum omnis suscipit eligendi enim quo, alias amet error, minima vel veniam quam nulla iure eveniet, mollitia quibusdam non. Laudantium sint fugiat dolore ea cupiditate! Porro ipsa temporibus, fuga facere dolor accusamus iste debitis. Commodi libero natus quod quae quasi rem, itaque necessitatibus.', '1693596024blog10.jpg', '2023-09-01 19:20:24', 4, 9, 0),
(16, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus perferendis modi molestiae ab nam assumenda, nihil accusantium quod dignissimos architecto ipsum recusandae odit similique veritatis possimus perspiciatis! Maxime ipsum nulla ducimus voluptas nostrum ratione quis doloremque hic expedita consequuntur, eum tempora sed eos ipsam reprehenderit laudantium, tempore fuga. Nobis fuga in nesciunt adipisci quas repellendus. Facere ex laborum omnis suscipit eligendi enim quo, alias amet error, minima vel veniam quam nulla iure eveniet, mollitia quibusdam non. Laudantium sint fugiat dolore ea cupiditate! Porro ipsa temporibus, fuga facere dolor accusamus iste debitis. Commodi libero natus quod quae quasi rem, itaque necessitatibus.', '1693598889blog15.jpg', '2023-09-01 20:08:09', 4, 3, 0),
(17, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus perferendis modi molestiae ab nam assumenda, nihil accusantium quod dignissimos architecto ipsum recusandae odit similique veritatis possimus perspiciatis! Maxime ipsum nulla ducimus voluptas nostrum ratione quis doloremque hic expedita consequuntur, eum tempora sed eos ipsam reprehenderit laudantium, tempore fuga. Nobis fuga in nesciunt adipisci quas repellendus. Facere ex laborum omnis suscipit eligendi enim quo, alias amet error, minima vel veniam quam nulla iure eveniet, mollitia quibusdam non. Laudantium sint fugiat dolore ea cupiditate! Porro ipsa temporibus, fuga facere dolor accusamus iste debitis. Commodi libero natus quod quae quasi rem, itaque necessitatibus.', '1693598923blog13.jpg', '2023-09-01 20:08:43', 4, 9, 0),
(18, 'Bellatrix', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. At neque dolore impedit voluptas? Cupiditate voluptatum distinctio ad, facere consequatur ratione error libero a odit numquam nulla. Cum sunt quibusdam dicta nihil dolorem. Porro harum mollitia sunt nulla cumque deserunt ea accusantium accusamus sequi magnam. Asperiores odit distinctio tenetur omnis ipsa ratione eius quaerat temporibus, dicta quisquam nemo molestias illum quae voluptates labore repellendus iure ex commodi magnam neque, et nesciunt nisi. Nostrum nesciunt cupiditate ipsum molestias cum repellendus, expedita voluptatibus, suscipit labore magni ex eaque ad adipisci error eum. Magni itaque sequi ut consequuntur quibusdam vel odio voluptas ipsam explicabo laboriosam sapiente minus natus nostrum, consequatur quaerat soluta repellendus pariatur. Reiciendis voluptate facilis, sequi exercitationem quis incidunt laborum enim dicta eum magni mollitia, delectus quidem iusto esse dolores expedita temporibus quaerat error aperiam, itaque beatae! Non temporibus tempore, mollitia, debitis ex veritatis nihil vero blanditiis ad placeat eaque quidem optio?', '1693620592blog19.jpg', '2023-09-02 02:09:52', 6, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`) VALUES
(3, 'Alex', 'Xander', 'alex', 'alex@xander.com', '$2y$10$qYih1yFtXwmZcU02hbzSVeK0/RB4/.7x9oRphMSLTKCwf7Zc.cWlW', '1693412749avatar2.jpg', 1),
(9, 'John', 'Doe', 'john', 'john@doe.com', '$2y$10$cpEcqkMBiduZhcToOmrjNeDp/inxunupRGCW2XFSV9uLCnAUZHIvC', '1693595997avatar8.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blog_category` (`category_id`),
  ADD KEY `FK_blog_author` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_blog_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
