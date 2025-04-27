DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `users`;

-- Create a user table
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create a table of posts
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Adding test data
INSERT INTO `users` (`name`, `email`, `password`) VALUES 
('Imran Sultanov', 'sultanov@duck.com', '$2y$10$sRtGE4ZT3QZ4lP8QEJ8TaeD4OfqMQ2DdfA2FDKOh16bhf7E/JTncu'), -- password: password123
('John Wick', 'john@example.com', '$2y$10$U8.O5U5JBKs3kmBt9TG3UeKCGIb9Vv8JDVEYfhCQ33WLs5rjMrMxy'), -- password: 12345678
('Tony Stark', 'tony@example.com', '$2y$10$V3JmvHNq3ePXZXwQeJ/7TueqfctkUX42QZlXy/D0hzNZ3CTjCtESy'); -- password: qwerty

INSERT INTO `posts` (`user_id`, `title`, `content`) VALUES
(1, 'First post', 'Contents of the first post demonstrating the capabilities of the framework.'),
(1, 'Second post', 'Continuing to learn web development with our lightweight framework.'),
(2, 'Introduction to MVC', 'MVC (Model-View-Controller) is a design pattern that divides an application into three main components...'),
(3, 'Working with databases', 'In this article, we will look at how to effectively work with databases via PDO in PHP applications.');