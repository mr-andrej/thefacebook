-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2021 at 07:00 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theFacebookDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `friend_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`) VALUES
(1, 4, 1),
(3, 1, 4),
(4, 1, 3),
(5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `friend_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `firstname` varchar(35) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `user_id`, `firstname`, `created_at`) VALUES
(5, 'Remember, remember!     The fifth of November,     The Gunpowder treason and plot;     I know of no reason     Why the Gunpowder treason     Should ever be forgot!', 1, 'Andrej', '2021-02-04 12:51:58'),
(12, '<img src=\"https://cutt.ly/4kjZ0cN\" style=\"height: auto; width: 58vh\">', 1, 'Andrej', '2021-02-04 14:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `relationship_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `profile_image_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'https://www.improvutopia.com/wp-content/uploads/2016/02/empty.png.jpeg',
  `location` varchar(30) NOT NULL,
  `is_friend` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `status`, `relationship_status`, `profile_image_url`, `location`, `is_friend`) VALUES
(1, 'mrandrej.ilievski@gmail.com', 'Andrej', 'Ilievski', '$2y$10$aYYdkOwdVXKl5rmTQlg12.2Xe/EEqrg5R7sxINkNZNlhOauSPXDKC', 'Full stack development like a boss', ' Single', 'https://cutt.ly/HkjZyZG', 'Harvard', 0),
(2, 'mark.zuckerberg@harvard.edu', 'Mark', 'Zuckerberg', '$2y$10$aYYdkOwdVXKl5rmTQlg12.2Xe/EEqrg5R7sxINkNZNlhOauSPXDKC', NULL, NULL, 'https://www.improvutopia.com/wp-content/uploads/2016/02/empty.png.jpeg', 'Harvard', 0),
(3, 'eduardo.saverin@harvard.edu', 'Eduardo', 'Saverin', '$2y$10$aYYdkOwdVXKl5rmTQlg12.2Xe/EEqrg5R7sxINkNZNlhOauSPXDKC', NULL, NULL, 'https://www.improvutopia.com/wp-content/uploads/2016/02/empty.png.jpeg', 'Harvard', 0),
(4, 'david.smith@harvard.edu', 'David', 'Smith', '$2y$10$aYYdkOwdVXKl5rmTQlg12.2Xe/EEqrg5R7sxINkNZNlhOauSPXDKC', NULL, NULL, 'https://www.improvutopia.com/wp-content/uploads/2016/02/empty.png.jpeg', 'Harvard', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
