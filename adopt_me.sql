-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 05:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
(35, 'dog for adoption', '<p>2 years old kali is looking for a home</p>', 'thamel', 1234567890, 1, 5, '2022-05-26 17:15:43', 1, 'uploads/d1.jpg'),
(36, 'cat ', '<p>6 months cat looking for home</p>', 'bhaktapur', 1235, 8, 2, '2022-05-26 19:32:29', 1, 'uploads/d2.jpg'),
(37, 'two rats', '<p>two black and white available for adoption</p>', 'lokanthali', 2222, 8, 6, '2022-05-26 19:37:09', 1, 'uploads/d3.jpg'),
(38, 'Misa', '<p>Brown colored puppy available for adoption. She is an active 3 months old puppy.&nbsp;</p>', 'Sitapaila', 2147483647, 9, 1, '2022-05-26 11:31:04', 1, 'uploads/dog.jpg'),
(39, 'dog food', '<p>food for dogs</p>', 'Sitapaila', 123, 11, 1, '2022-05-26 22:53:02', 0, 'uploads/dogfood.jpg'),
(41, 'Moco', '<p>He is a cute and very active puppy. He is not what we say normal. He is too fun to keep around. But he can be a real headache sometimes. We need a real responsible owner for him who can handle him when letting him be just him.</p>', 'Pokhara', 2147483647, 13, 1, '2022-06-04 11:11:42', 1, 'uploads/moco.jpg'),
(42, 'Dog cage ', '<p>It is a big size dog cage. We are donating this and want fosters around to take this if they need this. We want to help fosters who work very hard to take care of rescues.</p>', 'Butwal', 2147483647, 13, 14, '2022-06-04 11:14:25', 1, 'uploads/dogcage.jpg'),
(43, 'Pew', '<p>Female cat up for adoption.</p><p>She needs new home urgently. Her owners are going out of the country. She is a friendly cat.</p>', 'Phutung, Kathmandu', 2147483647, 13, 2, '2022-06-04 11:18:05', 1, 'uploads/Pew.jpg'),
(44, 'Rico', '<p>Rico the Rat ;) Up for adoption!</p>', 'Satungal, Kathmandu', 2147483643, 13, 6, '2022-06-04 11:23:15', 1, 'uploads/rat.jpg'),
(45, 'Pipo and Riroru', '<p>Both the rabbits are for adoption. Interested can kindly contact me.</p>', 'Bhaktapur', 2147483647, 13, 7, '2022-06-04 11:24:32', 1, 'uploads/rabs.jpg'),
(46, 'Hinoku', '<p>Parrot for adoption. She is well trained. Please contact me if you are willing to take proper care of Hinoku.</p>', 'Tangal', 2147483647, 13, 16, '2022-06-04 11:29:19', 1, 'uploads/hinoku.jpg'),
(47, 'Ivermectin', '<p>We want to contribute in your rescue work. Whoever is in need, please contact in the given number to get these meds. Thank you for working for needy animals. &lt;3</p>', 'Kathmandu', 2147483647, 13, 11, '2022-06-04 11:34:01', 1, 'uploads/iver.jpg'),
(48, 'Adult dog food', '<p>People fostering rescue animals, you can kindly contact us if you need any help for dog foods. We will be very glad to help you. :)</p>', 'Kathmandu', 2147483647, 13, 10, '2022-06-04 11:37:15', 1, 'uploads/dogfooddonation.jpg'),
(49, 'Pimpy', '<p>Pimpy(Monkey) is available for adoption. She is always taken care by humans. So, she is friendly with humans.</p>', 'Kalanki', 2147483647, 13, 9, '2022-06-04 11:41:03', 1, 'uploads/pimpy.jpg');

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
(1, 'Dog', NULL),
(2, 'Cat', NULL),
(6, 'Rat', NULL),
(7, 'Rabbit', NULL),
(9, 'Other Pets', NULL),
(10, 'Donation(Pet food)', NULL),
(11, 'Donation(Pet medicines)', NULL),
(13, 'Donation(Pet grooming items)', NULL),
(14, 'Donation(Pet cages)', NULL),
(15, 'Donation(Other pet items)', NULL),
(16, 'Birds', NULL);

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
(9, '', 'seemana@gmail.com', '$2y$10$wJwZE4act95pxceGix2r6OOceySX/9mn69Io5tSeG3.sHSr1dzkX.', 1, 0, 1),
(10, '', 'bibek@gmail.com', '$2y$10$Br2VDbGwqat4j6K8MAfWu.fvs3M7i74JwAR0/V.jUmJLJ4gDrZCLu', 1, 0, 1),
(11, '', 'heka@g.com', '$2y$10$lmAXY2zBLit15Nd2DpMfuOIpWQjyBUiBephAq1Mni5U0rTBSVceky', 1, 0, 1),
(12, '', 'rb98@gmail.com', '$2y$10$kdoAGjFffa6Cfm5JspAvmOqkIk2CCJNEsiamEyzdIyLlu3ry1iRDO', 1, 0, 1),
(13, '', 'a@b', '$2y$10$gf4BzTr40N3VwKslL2e22eW3enkfxdqZCoI46diU0yeks8hXEEcxG', 1, 0, 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `pets_category`
--
ALTER TABLE `pets_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `session_token`
--
ALTER TABLE `session_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User Id', AUTO_INCREMENT=14;

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
