SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS lost_and_found;
CREATE DATABASE IF NOT EXISTS `lost_and_found` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lost_and_found`;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` varchar(50) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
('1', 'Stationery'),
('2', 'Water bottles');

DROP TABLE IF EXISTS `claims`;
CREATE TABLE `claims` (
  `claim_id` varchar(50) NOT NULL,
  `inq_id` varchar(50) DEFAULT NULL,
  `claim_date` datetime DEFAULT NULL,
  `dispatch_status` enum('pending','claimed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE `inquiries` (
  `inq_id` varchar(50) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `item_id` varchar(50) DEFAULT NULL,
  `inq_date` datetime DEFAULT NULL,
  `inq_description` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `inquiries` (`inq_id`, `user_id`, `item_id`, `inq_date`, `inq_description`, `status`) VALUES
('68667d8fef3c6', '1', '685113c6dfae2', '2025-07-03 14:54:39', 'Sample inquirt here', 'approved'),
('686680c5d5c53', '1', '685108002a568', '2025-07-03 15:08:21', 'Inquiry 2', 'pending');

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `item_id` varchar(50) NOT NULL,
  `admin_id` varchar(50) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_description` text DEFAULT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date_located` date DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `status` enum('pending','claimed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `items` (`item_id`, `admin_id`, `item_name`, `item_description`, `category_id`, `location`, `date_located`, `image_url`, `status`) VALUES
('685108002a568', '1', 'Water Bottle', 'Blue waterbottle with name \"Camilla\"', '2', 'Masinga Lab', '2025-06-17', 'uploads/1750140928_bottle.jpg', 'pending'),
('685113c6dfae2', '1', 'Pen', 'Blue Bic with no cap', '1', 'STC ', '2025-06-17', 'uploads/1750143942_pen.png', 'pending');

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` varchar(50) NOT NULL,
  `role_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
('1', 'Admin'),
('2', 'Student'),
('3', 'Super Admin');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `status` enum('active','disabled') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `bio`, `role`, `profile_pic`, `status`) VALUES
('1', 'John Doe', 'johndoe@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sample bio here', '3', 'uploads/profile.jpg', 'active'),
('2', 'Alice Admin', 'alice.admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin account for managing items', '1', 'uploads/admin_profile.jpg', 'active'),
('3', 'Sam Super', 'super.admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Super Admin with full privileges', '3', 'uploads/super_profile.jpg', 'active'),
('4', 'Steve Student', 'steve.student@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Student user account', '2', 'uploads/student_profile.jpg', 'active');

ALTER TABLE `categories` ADD PRIMARY KEY (`category_id`);
ALTER TABLE `claims` ADD PRIMARY KEY (`claim_id`), ADD KEY `inq_id` (`inq_id`);
ALTER TABLE `inquiries` ADD PRIMARY KEY (`inq_id`), ADD KEY `item_id` (`item_id`), ADD KEY `user_id` (`user_id`);
ALTER TABLE `items` ADD PRIMARY KEY (`item_id`), ADD KEY `category_id` (`category_id`), ADD KEY `admin_id` (`admin_id`);
ALTER TABLE `notifications` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `role` (`role`);
ALTER TABLE `roles` ADD PRIMARY KEY (`role_id`);
ALTER TABLE `users` ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `email` (`email`), ADD KEY `role` (`role`);

ALTER TABLE `notifications` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `claims` ADD CONSTRAINT `claims_ibfk_1` FOREIGN KEY (`inq_id`) REFERENCES `inquiries` (`inq_id`) ON DELETE CASCADE;
ALTER TABLE `inquiries` ADD CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE, ADD CONSTRAINT `inquiries_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
ALTER TABLE `items` ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL, ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
ALTER TABLE `notifications` ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE, ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`role`) REFERENCES `roles` (`role_id`) ON DELETE SET NULL;
ALTER TABLE `users` ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`role_id`) ON DELETE SET NULL;

COMMIT;
