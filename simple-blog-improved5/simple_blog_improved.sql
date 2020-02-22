-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2020 at 04:51 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_blog_improved`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(400) NOT NULL,
  `description` varchar(150) NOT NULL,
  `date` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `description`, `date`) VALUES
(1, 'My First Post', 'Lots of content and things.', 'nonsense', 1582245489),
(2, 'My second Post', 'Bla bla bla ipsum lorem', 'more nonsense', 1582245553),
(3, 'Another post', '  The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog.', 'It\'s my super post', 1582245604);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_password_hash` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password_hash`) VALUES
(1, 'Robert', 'Robert@gmail.com', '$2y$10$Kh6feDKBaSdBwgUtDnFf..Vlo0beeVHgSSPm/dx/Hnwrna00/TOZ6'),
(2, 'Johnathan', 'John@gmail.com', '$2y$10$f5n8EVI4XccV/Sz3Cj52GOOrxK6z2nm01n.cjDJpkA3u59SR/zo2S'),
(3, 'Erica', 'erica@gmail.com', '$2y$10$GFHbYaFSs6fH1sRRRdGdIOX9R97B7CdN1ch0HF3JQeiPeJ23wvGbe'),
(4, 'Banana', 'banana@gmail.com', '$2y$10$cHqp9MCMi3Gv.whpPtqY7.W54QNffXjpuU4Go13LYN.WDrAMOgj4G'),
(5, 'testing', 'testing@gmail.com', '$2y$10$shyvguLhi9LLnP0lJullwu2iVJPFH0pytBghZB/Pw/jC1YXDnFPnm');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
