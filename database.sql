-- phpMyAdmin SQL Dump
-- Database: `kuetja_db`

CREATE DATABASE IF NOT EXISTS `kuetja_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kuetja_db`;

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users` (Password is admin123 hashed using password_hash)
INSERT INTO `users` (`username`, `password`) VALUES
('admin', '$2y$10$w8f36GxkX7sB81Vv3n6Z/.OqW098N1D66s3t8Ym3r2XW9.Y8O1G/e');

-- Table structure for table `news`
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `members`
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `dept_batch` varchar(100) NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default_user.png',
  `committee_type` varchar(50) DEFAULT 'executive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add a default member to test
INSERT INTO `members` (`name`, `position`, `dept_batch`, `media`, `committee_type`) VALUES
('তানভীর আহমেদ', 'সভাপতি', 'সিএসই, ২০', 'ক্যাম্পাস রিপোর্ট ২৪ ডট কম', 'executive');
