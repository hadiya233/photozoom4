-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 12:48 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `message_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `message_date` datetime NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(10) NOT NULL,
  `msg_from` varchar(255) NOT NULL,
  `msg_to` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `msg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `msg_from`, `msg_to`, `msg`, `msg_date`) VALUES
(47, 'max', 'mahdi', 'hi how are u', '2018-06-11 12:22:11'),
(48, 'max', 'mahdi', 'can we..', '2018-06-11 12:23:42'),
(49, 'ali', 'max', 'hello', '2018-06-11 12:28:29'),
(50, 'ali', 'max', 'hi how are u', '2018-06-11 12:28:48'),
(51, 'ali', 'max', '...', '2018-06-11 12:29:22'),
(52, 'max', 'ali', 'Ø§Ù‡Ù„ÙŠÙŠÙ†', '2018-06-11 12:30:21'),
(53, 'max', 'mahdi', '', '2018-06-11 12:31:08'),
(54, 'ali', 'max', '...', '2018-06-11 12:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(10) NOT NULL,
  `post_by` varchar(255) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_desc` text NOT NULL,
  `post_img` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_time` time NOT NULL,
  `post_category` varchar(50) NOT NULL,
  `post_like` int(12) NOT NULL DEFAULT '0',
  `post_dislike` int(12) NOT NULL DEFAULT '0',
  `avatar_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_by`, `post_title`, `post_desc`, `post_img`, `post_date`, `post_time`, `post_category`, `post_like`, `post_dislike`, `avatar_user`) VALUES
(57, 'mahdi', 'city', 'nice city', 'post_2018-06-11_69748_instagram_9.jpg', '2018-06-11', '12:09:41', 'general', 0, 0, 'avatar__19827_img4.jpg'),
(58, 'max', 'sun sit', 'behind the ..', 'post_2018-06-11_41339_gal1.jpg', '2018-06-11', '12:23:18', 'wild', 0, 0, 'avatar__73841_avatar-dhg.png'),
(59, 'ali', 'bird', 'beautiful', 'post_2018-06-11_52057_avatar__98847_g9.jpg', '2018-06-11', '12:26:47', 'wild', 0, 0, 'avatar__56937_avatar-male-3.jpg'),
(61, 'ali', 'bridge', '', 'post_2018-06-11_74170_instagram_8.jpg', '2018-06-11', '12:27:53', 'general', 0, 0, 'avatar__56937_avatar-male-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_full_name` varchar(50) NOT NULL,
  `user_gender` varchar(8) NOT NULL,
  `user_country` varchar(20) NOT NULL,
  `user_city` varchar(30) NOT NULL,
  `date_reg` datetime NOT NULL,
  `user_group` int(1) NOT NULL DEFAULT '0',
  `user_avatar` varchar(255) NOT NULL,
  `user_background` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `studied` varchar(255) NOT NULL,
  `user_status` varchar(10) NOT NULL DEFAULT 'offline',
  `last_seen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_pass`, `user_full_name`, `user_gender`, `user_country`, `user_city`, `date_reg`, `user_group`, `user_avatar`, `user_background`, `specialty`, `studied`, `user_status`, `last_seen`) VALUES
(28, 'mahdi', 'mahdi@gmail.com', '09685743223', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'mahdi yahia', 'male', 'sudan', 'khartoum', '2018-06-11 12:06:00', 0, 'avatar__19827_img4.jpg', 'backgroung__9784_g6.jpg', 'artis', 'sudan', 'offline', '2018-06-11 12:18:39'),
(29, 'max', 'max@gmail.com', '5644367764', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'max  max', 'male', 'sudan', 'mombia', '2018-06-11 12:20:05', 0, 'avatar__73841_avatar-dhg.png', 'backgroung__30020_instagram_10.jpg', 'potographer', 'sudan', 'online', '2018-06-11 12:23:46'),
(30, 'ali', 'ali@gmail.com', '0954325435', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'ali ahmed', 'male', 'sudan', 'khartoum', '2018-06-11 12:24:50', 0, 'avatar__56937_avatar-male-3.jpg', 'backgroung__54706_photo-beach.jpg', 'it', 'nelieen', 'offline', '2018-06-11 12:32:25'),
(31, 'sara', 'sara@gmail.com', '0112457754', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'sara .ali', 'female', 'KSA', 'ruad', '2018-06-11 12:33:28', 0, 'avatar__64575_avatar-female-1.jpg', 'backgroung__13870_111.jpg', 'designer', 'KSA', 'offline', '2018-06-11 12:36:15'),
(32, 'max2', 'max2@gmail.com', '0215458585', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'max ali ali', 'male', 'egypt', 'ciro', '2018-06-11 12:38:33', 1, 'avatar__47195_avatar-male-2.jpg', 'backgroung__80414_instagram_6.jpg', 'designer', 'ciro', 'offline', '2018-06-11 12:44:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
