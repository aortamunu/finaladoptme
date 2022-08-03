-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 06:08 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adopt_me`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption_request`
--

CREATE TABLE `adoption_request` (
  `id` bigint(255) NOT NULL,
  `pet` int(11) NOT NULL,
  `requester` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adoption_request`
--

INSERT INTO `adoption_request` (`id`, `pet`, `requester`, `message`, `status`) VALUES
(1, 32, 7, 'hey', 1),
(2, 30, 1, 'i want it', 2),
(3, 28, 1, 'will yu pease', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `helper_id` int(10) UNSIGNED NOT NULL,
  `category` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `active` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `title`, `description`, `location`, `contact`, `helper_id`, `category`, `created_at`, `active`, `image`) VALUES
(2, 'First Help', 'Ge', 'ktm', 98, 1, 1, '2021-09-04 12:38:21', 1, NULL),
(3, 'First Help', 'momo', 'mo', 98, 1, 2, '2021-09-04 12:38:21', 1, NULL),
(4, 'Timestan', 'tim3e', 'bkt', 89, 1, 1, '2021-09-04 12:38:45', 1, NULL),
(6, 'Jacket', '', 'Kathmandu', 2147483647, 1, 2, '2021-09-06 08:57:49', 1, NULL),
(8, 'Jacket', '  hero mero jacket tmi lagaune ho?', 'Kathmandu', 214748364, 1, 9, '2021-09-21 20:31:13', 1, NULL),
(9, 'Jacket', ' hero is', 'Kathmandu', 2147483647, 1, 2, '2021-09-21 20:32:42', 1, NULL),
(10, 'Jacket', '  hero is 1', 'Kathmandu', 2147483647, 1, 2, '2021-09-21 20:33:36', 1, NULL),
(11, 'Jacket', '   hero is 1 2', 'Kathmandu', 2147483647, 1, 2, '2021-09-21 20:34:05', 1, NULL),
(12, 'Moma', 'food    hero is 1 2 ', 'Kathmandu', 2147483647, 1, 1, '2021-09-22 07:34:53', 1, NULL),
(13, 'Moma 123', '<p>I am momo</p>', 'Kathmandu', 214748312, 1, 2, '2021-09-22 07:42:15', 1, NULL),
(19, 'hey', '<p><strong>born in America&nbsp;</strong></p><p>Visit my website at <a href=\"https://nischalstha9.github.io\">nischalstha9.github.io</a> I am awesome</p>', 'asd', 12, 1, 1, '2021-09-24 15:45:43', 1, NULL),
(20, 'Niraj Karki available', '<p><strong>5 Niraj karki available at Nist COllege</strong></p><p>Niraj karki is delicious chocolate. ??</p>', 'Swoyambhu', 2147483647, 1, 5, '2021-09-24 16:20:40', 1, NULL),
(22, 'kakshya 9 ko kitab', '<p>Mero Naam Nischal Shrestha ho</p><p>Mah kakshya 10 ma padhxu</p>', 'ktm', 200900879, 1, 8, '2021-09-24 16:25:14', 1, NULL),
(23, 'PYTHON DJANGO INTERN', '<p>Free Django courses are available.</p>', 'public_html', 2147483647, 1, 6, '2021-09-26 14:02:56', 1, NULL),
(24, '5 tracks are available', '<p>5 used tracks are available. If anyone want it please contact me.?</p>', 'Banasthali, Kathmandu', 2147483647, 1, 2, '2021-10-02 07:52:24', 1, NULL),
(25, 'My awesome New help edited again', '<p>This is description of my awesome new help?</p>', 'banasthali, Kathamandu', 2147483647, 1, 5, '2021-10-03 19:49:57', 1, NULL),
(26, 'Inaactive', '<p>ina</p>', 'don', 89, 1, 1, '2021-10-04 17:00:52', 1, NULL),
(27, 'This is new inactive help', '<p>books is available</p>', 'ktm', 8989, 1, 1, '2021-10-04 17:12:11', 0, NULL),
(28, 'This is my demo user\'s first help', '<p>demo demo demo</p>', 'demo ', 89, 7, 1, '2021-10-04 17:38:19', 1, NULL),
(29, 'Nischal is awesome', '<p>done description</p><p>Nischal really is awesome!</p>', 'kathmandu ', 2147483647, 1, 8, '2021-12-11 12:56:36', 1, NULL),
(30, 'German dog 2', '<p>dog is avaue</p>', 'ktm', 2147483647, 1, 1, '2022-05-24 11:20:07', 1, NULL),
(32, 'image', '<p>image</p>', '123', 123, 1, 1, '2022-05-24 13:30:06', 1, 'DSC_0128.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `pets_category`
--

CREATE TABLE `pets_category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pets_category`
--

INSERT INTO `pets_category` (`id`, `name`, `description`) VALUES
(1, 'Food', NULL),
(2, 'Clothing', NULL),
(5, 'Consumable', NULL),
(6, 'Electronics', NULL),
(7, 'Books', NULL),
(8, 'Notebooks', NULL),
(9, 'Education Materials', NULL),
(10, 'Technical Devices', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session_token`
--

CREATE TABLE `session_token` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'User Id',
  `username` varchar(50) NOT NULL COMMENT 'username',
  `email` varchar(200) NOT NULL COMMENT 'email',
  `password` varchar(1000) NOT NULL COMMENT 'password',
  `active` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `email_verified` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `active`, `email_verified`, `role`) VALUES
(1, '', 'nischal@g.com', '$2y$10$bTkknAdwwaVEyfyNfESHgOdJNgxMbzueJddct1hvw2krXFIWUxztW', 1, 0, 0),
(7, '', 'demo@user.com', '$2y$10$XZtBk8xSK5QohcdjYSiHjeo6AW/PFdQ4spTK5dA2qBofgo0wEqGje', 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_request`
--
ALTER TABLE `adoption_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets_category`
--
ALTER TABLE `pets_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_token`
--
ALTER TABLE `session_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_token_ibfk_1` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption_request`
--
ALTER TABLE `adoption_request`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pets_category`
--
ALTER TABLE `pets_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `session_token`
--
ALTER TABLE `session_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User Id', AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `session_token`
--
ALTER TABLE `session_token`
  ADD CONSTRAINT `session_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
