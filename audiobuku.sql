-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 03:14 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audiobuku`
--

-- --------------------------------------------------------

--
-- Table structure for table `audiobook`
--

CREATE TABLE IF NOT EXISTS `audiobook` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `author` varchar(70) DEFAULT NULL,
  `narrator` varchar(70) DEFAULT NULL,
  `isbn` varchar(45) DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `about` varchar(500) DEFAULT NULL,
  `audio_file_url` varchar(500) DEFAULT NULL,
  `audio_preview_file_url` varchar(500) DEFAULT NULL,
  `duration_seconds` bigint(20) DEFAULT NULL,
  `cover_picture_url` varchar(500) DEFAULT NULL,
  `banner_picture_url` varchar(500) DEFAULT NULL,
  `copyright_year` varchar(10) DEFAULT NULL,
  `visibility` int(11) NOT NULL DEFAULT '0',
  `released_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `publisher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audiobookchapter`
--

CREATE TABLE IF NOT EXISTS `audiobookchapter` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `about` varchar(500) DEFAULT NULL,
  `cover_picture_url` varchar(500) DEFAULT NULL,
  `audio_file_url` varchar(500) DEFAULT NULL,
  `duration_seconds` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `audiobook_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audiobook_bundle`
--

CREATE TABLE IF NOT EXISTS `audiobook_bundle` (
  `audiobook_id` int(11) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audiobook_collection`
--

CREATE TABLE IF NOT EXISTS `audiobook_collection` (
  `audiobook_id` int(11) DEFAULT NULL,
  `collection_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bundle`
--

CREATE TABLE IF NOT EXISTS `bundle` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `picture_url` varchar(500) DEFAULT NULL,
  `visibility` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `picture_url` varchar(500) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `picture_url` varchar(500) DEFAULT NULL,
  `visibility` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `audiobook_id` int(11) DEFAULT NULL,
  `audiobookChapter_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `rating` double DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `audiobook_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `birth_date_at` datetime DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `relationship_status` varchar(45) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `role` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `birth_date_at`, `phone_number`, `gender`, `about`, `website`, `relationship_status`, `location`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kevins@gmail.com', '$2y$10$hr67gpIjvLcXvg3QyKJuSeD9wjPhKvraVCPkLkddY6KW7pj2qf2Ga', 'Kevin Aprilio', '1990-09-09 00:00:00', '0989999099', 'L', 'Lorem Ipsum', 'http://www.dodolgarut.com', 'single', 'Garut', '0', '2016-06-06 13:07:29', '2016-06-06 13:10:49', NULL),
(2, 'kevinz@gmail.com', '$2y$10$IwLC4o0cqtgVG5dexjrSMe7ZpngBQy7rKFOpo2fOIRQfr0yMxWI.K', 'Kevin Aprilio', '1990-09-09 00:00:00', '0989999099', 'L', 'Lorem Ipsum', 'http://www.dodolgarut.com', 'single', 'Garut', '0', '2016-06-06 13:07:39', '2016-06-06 13:10:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `audiobook_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audiobook`
--
ALTER TABLE `audiobook`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `id_category_idx` (`category_id`),
  ADD KEY `audiobook.id_publisher_idx` (`publisher_id`);

--
-- Indexes for table `audiobookchapter`
--
ALTER TABLE `audiobookchapter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `id_audiobook_idx` (`audiobook_id`);

--
-- Indexes for table `audiobook_bundle`
--
ALTER TABLE `audiobook_bundle`
  ADD KEY `id_audiobook_idx` (`audiobook_id`),
  ADD KEY `id_bundle_idx` (`bundle_id`);

--
-- Indexes for table `audiobook_collection`
--
ALTER TABLE `audiobook_collection`
  ADD KEY `id_audiobook_idx` (`audiobook_id`),
  ADD KEY `id_collection_idx` (`collection_id`);

--
-- Indexes for table `bundle`
--
ALTER TABLE `bundle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `id_parent_idx` (`parent_id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `id_audiobook_idx` (`audiobook_id`),
  ADD KEY `purchase.id_user_idx` (`user_id`),
  ADD KEY `purchase.id_audiobookChapter_idx` (`audiobookChapter_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review.id_audiobook_idx` (`audiobook_id`),
  ADD KEY `review.id_user_idx` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `id_audiobook_idx` (`audiobook_id`),
  ADD KEY `id_user_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audiobook`
--
ALTER TABLE `audiobook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `audiobookchapter`
--
ALTER TABLE `audiobookchapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bundle`
--
ALTER TABLE `bundle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `audiobook`
--
ALTER TABLE `audiobook`
  ADD CONSTRAINT `audiobook.id_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `audiobookchapter`
--
ALTER TABLE `audiobookchapter`
  ADD CONSTRAINT `chapter.id_audiobook` FOREIGN KEY (`audiobook_id`) REFERENCES `audiobook` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `audiobook_bundle`
--
ALTER TABLE `audiobook_bundle`
  ADD CONSTRAINT `bundle.id_audiobook` FOREIGN KEY (`audiobook_id`) REFERENCES `audiobook` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bundle.id_bundle` FOREIGN KEY (`bundle_id`) REFERENCES `bundle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `audiobook_collection`
--
ALTER TABLE `audiobook_collection`
  ADD CONSTRAINT `collection.id_audiobook` FOREIGN KEY (`audiobook_id`) REFERENCES `audiobook` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `collection.id_collection` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category.id_parent` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase.id_audiobook` FOREIGN KEY (`audiobook_id`) REFERENCES `audiobook` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchase.id_audiobookChapter` FOREIGN KEY (`audiobookChapter_id`) REFERENCES `audiobookchapter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review.id_audiobook` FOREIGN KEY (`audiobook_id`) REFERENCES `audiobook` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist.id_audiobook` FOREIGN KEY (`audiobook_id`) REFERENCES `audiobook` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
