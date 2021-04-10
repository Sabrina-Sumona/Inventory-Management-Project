-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2021 at 08:10 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers_info`
--

DROP TABLE IF EXISTS `customers_info`;
CREATE TABLE IF NOT EXISTS `customers_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'new',
  `email` varchar(100) DEFAULT NULL,
  `current_orders` varchar(200) DEFAULT NULL,
  `shipping_address` varchar(300) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers_info`
--

INSERT INTO `customers_info` (`id`, `name`, `type`, `email`, `current_orders`, `shipping_address`, `avatar`) VALUES
(1, 'Nova', 'regular', 'nova@gmail.com', '5 items', 'Tangail', 'Customers/nova.png'),
(2, 'Tumpa', 'new', 'tumpa@gmail.com', '3 items', 'Narayanganj', 'Customers/tumpa.png'),
(3, 'Kona', 'new', 'kona@gmail.com', '10 items', 'Barisal', 'Customers/kona.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `bought` int(11) NOT NULL DEFAULT '0',
  `sold` int(11) NOT NULL DEFAULT '0',
  `image` varchar(300) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `bought`, `sold`, `image`, `created_at`, `updated_at`) VALUES
(12, 'AloeVera Gel', 56, 14, 'Uploads/aloe-removebg-preview.png', '2021-03-30 13:30:22', '2021-04-10 17:32:22'),
(14, 'Shampoo', 100, 37, 'Uploads/shampoo-removebg-preview.png', '2021-03-27 23:13:25', '2021-03-27 23:13:25'),
(19, 'Honey', 40, 4, 'Uploads/honey-removebg-preview.png', '2021-03-30 13:33:28', '2021-04-09 15:33:28'),
(20, 'Moisturizer', 100, 34, 'Uploads/cream-removebg-preview.png', '2021-03-30 13:34:01', '2021-03-30 13:34:01'),
(22, 'Hand Wash', 500, 122, 'Uploads/hand-removebg-preview.png', '2021-03-30 13:34:45', '2021-03-30 13:34:45'),
(23, 'Milk Powder', 40, 5, 'Uploads/milk-removebg-preview.png', '2021-03-30 13:35:07', '2021-03-30 13:35:07'),
(24, 'Soap Bar', 700, 204, 'Uploads/soap-removebg-preview.png', '2021-03-30 13:38:01', '2021-03-30 13:38:01'),
(28, 'Tooth Paste', 130, 35, 'Uploads/toothpaste-removebg-preview.png', '2021-03-30 15:16:45', '2021-03-30 15:16:45'),
(30, 'Sunscreen', 56, 11, 'Uploads/sun-removebg-preview.png', '2021-03-31 01:32:14', '2021-03-31 01:32:14'),
(31, 'Green Tea', 130, 45, 'Uploads/green-removebg-preview.png', '2021-03-31 01:43:42', '2021-04-08 11:43:42'),
(32, 'Glucose', 234, 43, 'Uploads/glucose-removebg-preview.png', '2021-03-31 01:45:21', '2021-03-31 01:45:21'),
(33, 'Body Lotion', 58, 0, 'Uploads/body-removebg-preview.png', '2021-04-04 23:08:38', '2021-04-04 23:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
CREATE TABLE IF NOT EXISTS `users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(100) DEFAULT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `name`, `u_name`, `email`, `password`, `is_active`, `is_admin`, `avatar`, `last_login_time`, `created_at`) VALUES
(12, 'Sabrina', 'sabrina', 'sabrina@gmail.com', '15bd83e66431ee8037e022ab97315515', 1, 1, 'Users/sabrina.jpg', '2021-04-10 19:05:04', '2021-04-02 21:31:26'),
(13, 'Naorin', 'naorin', 'naorin@gmail.com', '98708d61c5bce184f2a9314da996d581', 1, 0, 'Users/naorin.jpg', '2021-04-04 19:02:56', '2021-04-02 21:49:28'),
(14, 'Sumona', 'sumona', 'sumona@gmail.com', 'd157b8e849c75333fa9c996f86e0f304', 1, 0, 'Users/sum0na.jpg', '2021-04-10 18:57:32', '2021-04-02 21:51:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
