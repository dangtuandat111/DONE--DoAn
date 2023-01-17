-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 05:26 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `do-an-tot-nghiep`
--
CREATE DATABASE IF NOT EXISTS `do-an-tot-nghiep` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `do-an-tot-nghiep`;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 DEFAULT '',
  `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: disabled\n1: enabled',
  `thumbnail` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2022-10-09 17:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='product brand';

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`, `slug`, `status`, `thumbnail`, `created_at`, `updated_at`) VALUES
(1, 'Adidas', 'German manufacturer of athletic shoes and apparel and sporting goods', 'adidas-1812084415', 1, 'logo-adidas.png', '2022-10-10 00:00:00', '2023-01-09 19:39:33'),
(2, 'Adolfo', 'Aetrex is the global leader in foot scanning technology and orthotics', 'adolfo-1812084550', 1, '', '2022-10-10 00:00:00', '2023-01-09 19:39:34'),
(3, 'Aldo', 'The ALDO Group branded as ALDO, is a Canadian multinational corporation retailer that owns and operates a worldwide chain of shoe and accessories stores', 'aldo', 1, '', '2022-10-10 00:00:00', '2023-01-09 19:39:35'),
(4, 'Calvin Klein', 'Calvin Klein is a global lifestyle brand that exemplifies bold, progressive ideals and a seductive, and often minimal, aesthetic', 'calvin-klein', 1, '', '2022-10-10 00:00:00', '2023-01-09 19:39:35'),
(5, 'Floafers', 'Floafers are just what their name implies — lightweight foam loafers that float via decorative ventilation ports that drain water away', 'floafers', 1, '', '2022-10-10 00:00:00', '2022-10-09 17:00:00'),
(12, 'Carhartt', 'Founded by Hamilton Carhartt in 1889-proudly owned and operated by the same bloodline ever since', 'carhartt-1612101926', 1, 'logo-carhartt-1612101926.png', '2022-12-16 10:19:26', '2022-12-16 03:19:26'),
(13, 'Hunter', 'Hunter Boot Limited is a British footwear manufacturer that is known for its rubber Wellington boots', 'hunter-1712050333', 1, 'hunter-1712050333.png', '2022-12-17 05:02:11', '2022-12-16 22:02:11'),
(14, 'Pacific Mountain', 'The company was founded to fill a gap that needed to be filled: develop comfortable and durable shoes for all outdoor activities', 'pacific-mountain-1712051025', 1, 'Pacific-Mountain-1712051025.png', '2022-12-17 05:10:25', '2022-12-16 22:10:25'),
(15, 'Puma', 'Puma SE, branded as Puma, is a German multinational corporation that designs and manufactures athletic and casual footwear, apparel and accessories', 'puma', 1, '', '2022-10-10 00:00:00', '2022-10-09 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE `cart_item` (
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: disabled\n1: enabled',
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2022-10-09 17:00:00',
  `id` bigint(20) NOT NULL,
  `id_product_variant` bigint(20) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1,
  `note` varchar(2000) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`status`, `created_at`, `updated_at`, `id`, `id_product_variant`, `id_customer`, `count`, `note`) VALUES
(0, '2022-12-26 03:39:57', '2022-10-09 17:00:00', 1, 7, 4, 2, NULL),
(0, '2022-12-26 04:26:44', '2022-10-09 17:00:00', 2, 1, 4, 2, NULL),
(0, '2022-12-26 05:50:57', '2022-10-09 17:00:00', 3, 2, 4, 3, NULL),
(0, '2022-12-26 05:52:55', '2022-10-09 17:00:00', 4, 2, 4, 3, NULL),
(0, '2022-12-26 05:54:22', '2022-10-09 17:00:00', 5, 2, 4, 3, NULL),
(0, '2022-12-26 05:56:45', '2022-10-09 17:00:00', 6, 2, 4, 2, NULL),
(0, '2022-12-26 05:56:50', '2022-10-09 17:00:00', 7, 7, 4, 2, NULL),
(0, '2022-12-26 05:57:02', '2022-10-09 17:00:00', 8, 3, 4, 5, NULL),
(0, '2022-12-27 01:36:50', '2022-10-09 17:00:00', 9, 7, 4, 2, NULL),
(0, '2022-12-27 01:36:58', '2022-10-09 17:00:00', 10, 3, 4, 5, NULL),
(0, '2022-12-27 20:06:46', '2022-10-09 17:00:00', 11, 1, 4, 2, NULL),
(0, '2022-12-27 20:07:25', '2022-10-09 17:00:00', 12, 7, 4, 2, NULL),
(0, '2022-12-27 20:07:32', '2022-10-09 17:00:00', 13, 5, 4, 10, NULL),
(0, '2022-12-27 20:07:39', '2022-10-09 17:00:00', 14, 3, 4, 5, NULL),
(0, '2022-12-27 20:13:29', '2022-10-09 17:00:00', 15, 2, 4, 1, NULL),
(0, '2022-12-27 20:13:35', '2022-10-09 17:00:00', 16, 6, 4, 1, NULL),
(0, '2022-12-28 13:42:03', '2022-10-09 17:00:00', 17, 7, 4, 2, NULL),
(0, '2022-12-28 13:42:08', '2022-10-09 17:00:00', 18, 5, 4, 2, NULL),
(0, '2022-12-28 13:42:14', '2022-10-09 17:00:00', 19, 3, 4, 5, NULL),
(0, '2023-01-01 16:19:28', '2022-10-09 17:00:00', 20, 7, 4, 2, NULL),
(0, '2023-01-03 01:16:07', '2022-10-09 17:00:00', 21, 10, 4, 3, NULL),
(0, '2023-01-09 15:26:07', '2022-10-09 17:00:00', 22, 6, 4, 1, NULL),
(0, '2023-01-09 23:19:04', '2022-10-09 17:00:00', 23, 11, 4, 6, 'IH3|7SC-1|-1'),
(0, '2023-01-10 01:20:28', '2022-10-09 17:00:00', 24, 13, 4, 2, 'IH3|7SCTrắng|5'),
(0, '2023-01-10 02:53:57', '2022-10-09 17:00:00', 25, 8, 4, 1, NULL),
(0, '2023-01-13 18:14:24', '2022-10-09 17:00:00', 26, 11, 4, 6, 'IH3|7SC-1|-1'),
(0, '2023-01-13 22:27:09', '2022-10-09 17:00:00', 27, 13, 4, 2, 'IH3|7SCTrắng|5'),
(0, '2023-01-14 00:31:46', '2022-10-09 17:00:00', 28, 27, 4, 1, 'IH-1|-1SC-1|-1'),
(0, '2023-01-14 00:39:12', '2022-10-09 17:00:00', 29, 25, 4, 1, 'IH-1|-1SC-1|-1'),
(0, '2023-01-14 00:39:24', '2022-10-09 17:00:00', 30, 16, 4, 1, 'IH-1|-1SC-1|-1'),
(0, '2023-01-14 01:22:15', '2022-10-09 17:00:00', 31, 22, 4, 1, 'IH-1|-1SC-1|-1'),
(1, '2023-01-14 02:54:07', '2022-10-09 17:00:00', 32, 11, 4, 6, 'IH3|7SC-1|-1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Disabled\n1: Enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='product category';

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Boots', 'Boots is a strong outer covering for the foot that extends above the ankle, often to the knee', 'boots-1712073158', '2022-12-17 07:31:58', '2023-01-10 01:30:23', 1),
(2, 'Athletic', 'Athletic is a shoe designed to be worn for sports, exercising, or recreational activity, as racquetball, jogging, or aerobic dancing', 'athletic-1712073522', '2022-12-17 07:35:22', '2022-12-17 07:35:22', 1),
(3, 'Loafers', 'Loafers are shoes that do not utilize a lacing or fastening system and are instead simply slipped on the foot.', 'loafers-1712073813', '2022-12-17 07:38:13', '2022-12-17 08:41:22', 1),
(4, 'Oxfords', 'Oxford shoes are an elegant dress shoe that features a closed lacing system concealed within the upper part of the shoe.', 'oxfords-1712074013', '2022-12-17 07:40:13', '2022-12-17 08:41:21', 1),
(5, 'Sandals', 'Sandals are an open type of footwear, consisting of a sole held to the wearer\'s foot by straps going over the instep and around the ankle.', 'sandals-1712074125', '2022-12-17 07:41:25', '2022-12-17 07:41:25', 1),
(6, 'Slip-Ons', 'Slip-Ons are a shoe with no way of fastening it to the foot, that can be quickly put on and taken off.', 'slip-ons-1712075416', '2022-12-17 07:54:16', '2022-12-17 07:54:16', 1),
(7, 'Slippers', 'Slippers are light footwear that are easy to put on and off and are intended to be worn indoors, particularly at home', 'slippers-1712075444', '2022-12-17 07:54:44', '2022-12-17 07:54:44', 1),
(8, 'Sneakers', 'Sneakers are sports shoes with a pliable rubber sole.', 'sneakers-1712075550', '2022-12-17 07:55:50', '2022-12-17 07:55:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 DEFAULT '',
  `gender` tinyint(4) DEFAULT -1 COMMENT '0: Man\n1: Women\n-1: NAL',
  `address` varchar(250) CHARACTER SET utf8 DEFAULT '',
  `avatar` varchar(250) CHARACTER SET utf8 DEFAULT 'admin_default.png',
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2022-10-09 17:00:00',
  `status` tinyint(4) DEFAULT 1 COMMENT '0: disabled\n1: enabled',
  `remember_token` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `otp` varchar(6) CHARACTER SET utf8 NOT NULL DEFAULT '111111'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='customer account';

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone_number`, `email`, `password`, `description`, `gender`, `address`, `avatar`, `created_at`, `updated_at`, `status`, `remember_token`, `otp`) VALUES
(1, 'Dang Tuan Dat - Customer', '0986884237', 'mrboss862000+01@gmail.com', '$2y$10$jeDTYtAAtntBO91CchhdC.xAQnTvdabeIKIjTTOX4jH5z9zS6BXD2', 'Here is a new user', 0, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', 'admin_default.png', '2022-10-10 00:00:00', '2022-12-19 08:26:39', 1, '', '111111'),
(2, 'Tran Tien Dung', '0986884231', 'mrboss862000+02@gmail.com', '$2y$10$ghIfcanGIMyK.xspQtafyuWYlIFFbPjHUTFcNYMUYW.bhVQXLqxJm', 'Here is a new user', 0, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', 'admin_default.png', '2022-10-10 00:00:00', '2022-10-09 17:00:00', 1, '', '111111'),
(4, 'Vo Van Hungss', '0986884237', 'dtd8600@gmail.com', '$2y$10$Bvo3gKjOZ3xVb6ZSKL6c/OT9YlsUlanZMSnZ4LYHK6KX75nS5aoyK', '<p><i>Xin chào, năm nay tôi 22 tuổi vẫn còn độc thân. Tôi đang chuẩn bị cho đồ án tốt nghiệp trường Đại học Giao thông vận tải. Tôi là một người tự tin và mạnh dạn trong giao tiếp.</i></p><p>Mục tiêu dài hạn của tôi là tìm hiểu nhiều lĩnh vực khác nhau trong<strong> Công nghệ thông tin</strong> &nbsp;và làm việc để quyết định lĩnh vực chuyên môn mà tôi muốn theo học.&nbsp;Tôi muốn trở thành chuyên gia trong một lĩnh vực này trong dài hạn, nhưng tôi biết bước đầu tiên là xây dựng một nền tảng vững chắc và học những kiến ​​thức cơ bản trong vai trò cấp thấp.&nbsp;</p><blockquote><p>Thank you for reading this.</p></blockquote><ol><li>Dang Tuan Dat</li><li>Dumpskin</li></ol>', 0, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', 'avatar_default-1001120950.png', '2022-12-26 02:56:54', '2022-12-25 19:56:54', 1, 'CusEkrdfCeej5jGGekueDHocHBb0ZsjsYU6fPzTJghQbrWsnhBrx8LHxRrDF', '64096c');

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

DROP TABLE IF EXISTS `option`;
CREATE TABLE `option` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `value` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `id_option_group` bigint(20) NOT NULL,
  `bonus` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`id`, `name`, `value`, `id_option_group`, `bonus`) VALUES
(20, 'Insole height option', '2', 3, 7),
(21, 'Insole height option', '3', 3, 7),
(22, 'Insole height option', '4', 3, 10),
(23, 'Insole height option', '4.5', 3, 15),
(24, 'Insole height option', '5', 3, 15),
(25, 'Shoelace color', 'Trắng', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `option_group`
--

DROP TABLE IF EXISTS `option_group`;
CREATE TABLE `option_group` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2022-10-09 17:00:00',
  `note` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: disabled\n1: enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='product option group ( size, shoe accessories )';

--
-- Dumping data for table `option_group`
--

INSERT INTO `option_group` (`id`, `name`, `created_at`, `updated_at`, `note`, `status`) VALUES
(3, 'Chiều cao lót giày', '2022-10-20 15:32:08', '2022-12-19 17:40:19', 'cm', 1),
(4, 'Màu dây giày', '2022-12-20 00:30:14', '2022-12-28 01:44:45', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` bigint(20) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `total` double NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Chưa thanh toán\n1: Đã thanh toán\n2: Thành công\nKhông quản lý giai đoạn vận chuyển',
  `address` varchar(250) CHARACTER SET utf8 NOT NULL,
  `phone_number` varchar(11) CHARACTER SET utf8 NOT NULL,
  `note` varchar(2000) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `id_customer`, `total`, `created_at`, `updated_at`, `status`, `address`, `phone_number`, `note`) VALUES
(14, 4, 296.6546, '2022-12-27 01:33:25', '2022-12-27 01:33:25', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', ''),
(21, 4, 524.182, '2022-12-27 01:43:14', '2022-12-27 01:43:14', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', ''),
(22, 4, 2626.85, '2022-11-27 20:13:17', '2022-11-27 20:13:17', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', ''),
(23, 4, 128.98, '2022-11-27 20:14:22', '2022-11-27 20:14:22', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', ''),
(24, 4, 1466.95, '2022-12-28 13:46:14', '2022-12-28 13:46:14', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', ''),
(25, 4, 641.273, '2023-01-09 23:56:29', '2023-01-09 23:56:29', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', ''),
(26, 4, 419.94, '2023-01-10 01:20:39', '2023-01-10 01:20:39', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', ''),
(27, 4, 140, '2023-01-10 02:54:19', '2023-01-10 02:54:19', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', ''),
(28, 4, 78.4, '2023-01-13 19:16:06', '2023-01-13 19:16:06', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', 'IH3|SC0'),
(29, 4, 163.98, '2023-01-13 22:35:24', '2023-01-13 22:35:24', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', 'IH3|SCTrắng'),
(30, 4, 88.99, '2023-01-14 00:37:19', '2023-01-14 00:37:19', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', 'IH0|SC-1'),
(31, 4, 241.99, '2023-01-14 00:39:30', '2023-01-14 00:39:30', 1, 'Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', '0986884237', 'IH0|SC-1');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id` bigint(20) NOT NULL,
  `id_product_variant` bigint(20) NOT NULL,
  `id_order` bigint(20) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_product_variant`, `id_order`, `count`, `price`) VALUES
(18, 2, 14, 2, 55.1908),
(19, 7, 14, 3, 62.091),
(28, 7, 21, 2, 62.091),
(29, 3, 21, 2, 200),
(30, 1, 22, 2, 59.99),
(31, 7, 22, 3, 68.99),
(32, 5, 22, 10, 129.99),
(33, 3, 22, 5, 200),
(34, 2, 23, 1, 59.99),
(35, 6, 23, 1, 68.99),
(36, 7, 24, 3, 68.99),
(37, 5, 24, 2, 129.99),
(38, 3, 24, 5, 200),
(39, 7, 25, 2, 62.091),
(40, 10, 25, 3, 105),
(41, 6, 25, 1, 62.091),
(42, 11, 25, 1, 140),
(43, 13, 26, 10, 41.994),
(44, 8, 27, 1, 140),
(45, 11, 28, 1, 78.4),
(46, 13, 29, 2, 81.99),
(47, 27, 30, 1, 88.99),
(48, 25, 31, 1, 98.99),
(49, 16, 31, 1, 143);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 DEFAULT '',
  `price` double NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2022-10-09 17:00:00',
  `start_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00' COMMENT 'time start discount',
  `end_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: disabled\n1: enabled\n3: sold out',
  `id_brand` bigint(20) NOT NULL,
  `id_category` bigint(20) NOT NULL,
  `feature` text NOT NULL DEFAULT '' COMMENT 'Many feature split by ''/''',
  `thumbnail` varchar(250) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `description`, `price`, `discount`, `created_at`, `updated_at`, `start_at`, `end_at`, `status`, `id_brand`, `id_category`, `feature`, `thumbnail`) VALUES
(1, 'Puma Ever FS Sneaker', 'puma-ever-fs-sneaker', 'The rhythmic sound of new copies is paired with the high-speed clicking of your coworker’s keyboard; a reminder that the workday is nearing its end. You’re glad you decided to wear your Edsul oxfords from Crown Vintage so when you leave the office, you’ll be ready for happy hour. The sweet relief of the weekend is just a few hours away.&nbsp;<p></p>\n\n<p><br>\n<strong>What they are: </strong>Oxfords that are constructed with a casual touch. Featuring intricate stitching along the sides to elevate any ensemble.&nbsp;</p>\n\n<p><br>\n<strong>Why you’ll love them: </strong>Tied together and tailored, this pair feature a classic silhouette that can easily upgrade any look. The sneaker-inspired sole makes this pair easy to dress up or down.</p>\n\n<p><br>\n<strong>How we’d wear them:</strong> From jeans and a button-down, to khakis and a pullover, these shoes will become a staple thanks to their versatile style.&nbsp;</p></p>', 59.99, 0, '2022-10-10 00:00:00', '2022-10-09 17:00:00', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 15, 8, '<p><strong>TÍNH NĂNG</strong></p><ul><li>Phần trên bằng vải</li><li>Slip-on với hai miếng đệm đàn hồi</li><li>Mũi tròn</li> <li>Vải lót</li><li>Đệm chân</li><li>Đế cao su</li><li>Nhập khẩu</li></ul>', 'blah-2412115453.png'),
(3, 'Adolfo Luis Sneaker', 'adolfo-luis-sneaker-2412023145', '<h5><strong>ADOLFO LUIS SNEAKER</strong></h5><p>The Luis sneaker by Adolfo is a classic kick that can go well with slacks and or your favorite chinos. This leather sneaker is detailed with contrast stitching accents that exhibit a crafty look. Besides cozy leather lining and insole, this lace-up comes with a slip-resistant, semi-flexible rubber sole for steady footing.</p>', 200, 0, '2022-12-24 13:16:37', '2022-12-24 07:31:45', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 1, 8, '<p><strong>TÍNH NĂNG</strong></p><ul><li>Phần trên bằng vải</li><li>Slip-on với hai miếng đệm đàn hồi</li><li>Mũi tròn</li> <li>Vải lót</li><li>Đệm chân</li><li>Đế cao su</li><li>Nhập khẩu</li></ul>', 'adolfo-luis-sneaker-4-2412011637.png'),
(4, 'Calvin Klein Nabil Loafer', 'calvin-klein-nabil-loafer-2512014950', '<h5><strong>CALVIN KLEIN NABIL LOAFER</strong></h5><p>Complement your polished looks with the sophisticated Nabil loafer by Calvin Klein. Made using leather, this slip-on is designed with a metal plaque that adds the perfect finish. With rubber sole, you are sure to experience confident footing.</p>', 129.99, 10, '2022-12-25 01:49:50', '2022-12-24 18:49:50', '2022-12-20 00:00:00', '2022-12-31 00:00:00', 1, 1, 3, '<p><strong>TÍNH NĂNG</strong></p><ul><li>Phần trên bằng vải</li><li>Slip-on với hai miếng đệm đàn hồi</li><li>Mũi tròn</li> <li>Vải lót</li><li>Đệm chân</li><li>Đế cao su</li><li>Nhập khẩu</li></ul>', 'calvin-klein-nabil-loafer-1-2512014950.png'),
(5, 'Calvin Klein Ryor Slip-On Sneaker', 'calvin-klein-ryor-slip-on-sneaker-2712031015', '<h5><strong>CALVIN KLEIN RYOR SLIP-ON SNEAKER</strong></h5><p>Một ngày đầy những việc lặt vặt cần đến đôi giày sneaker xỏ ngón Ryor siêu thoải mái của Calvin Klein. Giày này có các dải đàn hồi ở hai bên để tạo cảm giác vừa vặn linh hoạt và các chi tiết logo ở mặt sau và lòng giày để tạo cảm giác cổ điển.</p>', 68.99, 10, '2022-12-25 02:05:25', '2023-12-27 08:10:15', '2022-12-20 00:00:00', '2022-12-31 00:00:00', 0, 4, 6, '<p><strong>TÍNH NĂNG</strong></p><ul><li>Phần trên bằng vải</li><li>Slip-on với hai miếng đệm đàn hồi</li><li>Mũi tròn</li> <li>Vải lót</li><li>Đệm chân</li><li>Đế cao su</li><li>Nhập khẩu</li></ul>', 'calvin-klein-ryor-slip-on-sneaker-1-2512020525.png'),
(6, 'Rockport Weather Or Not Chukka Boot', 'rockport-weather-or-not-chukka-boot-0201045756', '<p>Giữ phong cách và đồng thời được bảo vệ với bốt chukka Rockport Weather Or Not. Công nghệ chống thấm nước Hydro-Shield đảm bảo trải nghiệm luôn khô ráo trong khi cổ áo và lưỡi giày có đệm của chiếc ủng đi mưa này cho phép bạn tận hưởng sự thoải mái êm ái.</p>', 140, 49, '2023-01-02 04:57:56', '2023-01-01 21:57:56', '2023-01-01 00:00:00', '2023-01-31 00:00:00', 1, 12, 1, '<p><strong>TÍNH NĂNG</strong></p><ul><li>Da chống thấm nước trên</li><li>Lớp vải ren bên trong</li><li>Ngón chân tròn</li><li>Sử dụng lót tổng hợp</li><li>nhập khẩu</li></ul>', 'rockport-weather-or-not-chukka-boot-1-0201045756.png'),
(7, 'Birkenstock Arizona Slide Sandal', 'birkenstock-arizona-slide-sandal-1001010534', '<p>Birkenstock đã thiết lập tiêu chuẩn cho giày dép thoải mái! Trượt trên đôi giày trượt Aldo của bạn và cảm thấy được hỗ trợ suốt cả ngày, nhờ vào phần đế có đường viền được hình thành về mặt giải phẫu để mang lại sự thoải mái tối đa.</p>', 109.99, 5, '2023-01-10 01:05:34', '2023-01-09 18:05:34', '2023-01-08 00:00:00', '2023-01-14 00:00:00', 1, 3, 5, '<ul><li>XIN LƯU Ý: Độ vừa vặn của giày có chiều rộng trung bình nhưng được Birkenstock liệt kê là Vừa vặn hẹp hoặc Vừa vặn thông thường trên hộp vật phẩm.</li><li>Mặt trên giả da Birko-Flor™</li><li>Slip-on với dây đai có thể điều chỉnh</li><li>Mũi hở tròn</li><li>lót tổng hợp</li><li>Chân đế có đường viền</li><li>đế giữa bằng nút chai</li><li>đế EVA</li><li>Sản xuất tại Đức</li></ul>', 'birkenstock-arizona-slide-sandal-1-1001010534.png'),
(8, 'Vans Ward Lo Sneaker', 'vans-ward-lo-sneaker-1001011923', '<p>Thể hiện phong cách cổ điển của bạn với giày thể thao nam Ward Lo của Vans. Cấu trúc màu sắc đậm sẽ nổi bật với quần jean và áo phông họa tiết.&nbsp;</p>', 69.99, 0, '2023-01-10 01:19:23', '2023-01-09 18:19:23', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 12, 8, '<ul><li>Canvas hoặc da lộn trên</li><li>đóng cửa ren</li><li>Ngón chân tròn</li><li>Vải lót</li><li>Đệm chân</li><li>đế giữa lưu hóa</li><li>Đế cao su bánh quế đặc trưng</li><li>nhập khẩu</li></ul>', 'vans-ward-lo-sneaker-1-1001011923.png'),
(9, 'Crown Vintage Lingdale Boot', 'crown-vintage-lingdale-boot-1301105239', '<h5><strong>VƯƠNG MIỆN CỔ ĐIỂN LINGDALE BOOT</strong></h5><p>Thời gian tuyệt vời nhất trong năm cũng có thể là bận rộn nhất. Giày bốt Lingdale từ Crown Vintage có hình bóng lấy cảm hứng từ chiến đấu cổ điển, dễ dàng đưa bạn từ mua sắm trong kỳ nghỉ đến bữa tiệc Lễ tình nhân.</p><p>&nbsp;</p><p><br><strong>Chúng là gì:</strong> Một đôi bốt nâng cấp bất kỳ bộ trang phục thời tiết lạnh nào nhờ đường khâu chi tiết và thiết kế phù hợp.&nbsp;</p><p><br><strong>Tại sao bạn sẽ thích chúng:</strong> Cổ điển và tinh tế, những đôi giày này có thể dễ dàng phối đồ tùy theo sở thích phong cách cá nhân của bạn.&nbsp;</p><p><br><strong>Chúng ta sẽ mặc chúng như thế nào:</strong> Để có sự kết hợp tối ưu, hãy chọn một món đồ không bao giờ lỗi mốt như quần lửng màu xanh hải quân. Hoàn thiện vẻ ngoài bằng một chiếc cúc chi tiết có thêm một chút cá tính. &nbsp;</p><p>&nbsp;</p>', 240, 40, '2023-01-13 22:52:39', '2023-01-13 15:52:39', '2023-01-11 00:00:00', '2023-01-21 00:00:00', 1, 2, 1, '<p><strong>TÍNH NĂNG, ĐẶC ĐIỂM</strong></p><ul><li>Mũ da</li><li>Khóa kéo bên trong</li><li>đóng cửa ren</li><li>Ngón chân tròn</li><li>Độn lưỡi</li><li>Dệt &amp; tổng hợp trên</li><li>Đệm chân</li><li>Đế cao su có lực kéo</li><li>nhập khẩu</li></ul>', 'cole-haan-grand-atlantic-chukka-boot-1-1301105239.png'),
(10, 'V5 Training Shoe', 'v5-training-shoe-1301113600', '<p><strong>GIÀY TẬP NEW BALANCE 608 V5 - NAM</strong></p><p>Nhận được sự hỗ trợ mà bạn cần khi mang giày tập 608 V5 nam từ Pacific.&nbsp;</p><p>Đôi giày buộc dây bằng da này có đế giữa ABZORB và đế linh hoạt giúp bạn di chuyển tự do hơn.</p>', 75.9, 0, '2023-01-13 23:19:08', '2023-01-13 16:36:00', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 14, 2, '<p><strong>TÍNH NĂNG</strong></p><ul><li>Da chống thấm nước trên</li><li>Lớp vải ren bên trong</li><li>Ngón chân tròn</li><li>Sử dụng lót tổng hợp</li><li>nhập khẩu</li></ul>', 'v5-training-shoe-1-1301111908.png'),
(11, 'Adidas Kaptir 2.0 Sneaker', 'adidas-kaptir-20-sneaker-1301113729', '<p><strong>GIÀY THỂ THAO ADIDAS KAPTIR 2.0 - NAM</strong></p><p>Lên đường thật phong cách với đôi giày thể thao Kaptir 2.0 này của Adidas.</p><p>&nbsp;Giày thể thao này có đế giữa bằng <strong>Cloudfoam điêu khắc</strong> mang lại cảm giác êm ái dưới chân, trong khi logo in đậm mang đến phong cách mang tính biểu tượng.</p>', 69.99, 0, '2023-01-13 23:37:29', '2023-01-13 16:37:29', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 1, 2, '<p><strong>TÍNH NĂNG, ĐẶC ĐIỂM</strong></p><ul><li>Vải dệt kim &amp; mũ tổng hợp</li><li>đóng cửa ren</li><li>Ngón chân tròn</li><li>Lưới lót</li><li>Đế giữa Cloudfoam</li><li>đế tổng hợp</li><li>nhập khẩu</li></ul>', 'adidas-kaptir-2.0-sneaker-1-1301113729.png'),
(12, 'Floafers Country Club Penny Loafer', 'floafers-country-club-penny-loafer-1301114202', '<h5><strong>LOAFER CHỦ TỊCH LOAFER</strong></h5><p>Thay đổi phong cách giản dị của bạn với đôi giày lười Chair dễ mặc từ Floafers. Đôi giày lười này có kết cấu EVA chống thấm nước và khả năng thông gió 360 độ nhanh khô!</p>', 59.99, 20, '2023-01-13 23:42:02', '2023-01-13 16:42:02', '2023-01-14 00:00:00', '2023-01-27 00:00:00', 1, 5, 3, '<p><strong>TÍNH NĂNG, ĐẶC ĐIỂM</strong></p><ul><li>EVA trên</li><li>giày lười</li><li>Ngón chân tròn</li><li>Gặp chút chi tiết</li><li>thông gió 360 độ</li><li>không gạch đầu dòng</li><li>đệm chân EVA</li><li>Đế lái cao su chống trầy xước</li><li>nhập khẩu</li></ul>', 'floafers-country-club-penny-loafer-1-1301114202.png'),
(13, 'Birkenstock Zermatt Clog Slipper', 'birkenstock-zermatt-clog-slipper-1301114550', '<h5><strong>DÉP XỎ NGÓN BIRKENSTOCK ZERMATT - NAM</strong></h5><p>Giữ cho nó ấm cúng khi nhiệt độ giảm với đôi dép đi trong nhà Zermatt từ Birkenstock. Mặt trên bằng len và lớp lót lông thú giả đảm bảo những bước đi thoải mái từ đi văng đến cửa hàng tạp hóa.</p>', 99.99, 0, '2023-01-13 23:45:50', '2023-01-13 16:45:50', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 13, 7, '<p><strong>TÍNH NĂNG, ĐẶC ĐIỂM</strong></p><ul><li>len trên</li><li>giày lười</li><li>Ngón chân tròn</li><li>lót lông cừu</li><li>Chân đế có đường viền</li><li>Đế kết cấu tổng hợp</li><li>Sản xuất tại Đức</li></ul>', 'birkenstock-zermatt-clog-slipper---mens-1-1301114550.png'),
(14, 'Vince Camuto Lamson Cap Toe Oxford', 'vince-camuto-lamson-cap-toe-oxford-1401123116', '<h5><strong>VINCE CAMUTO LAMSON CAP TOE OXFORD</strong></h5><p>Một cổ điển thực sự sẽ không bao giờ lỗi mốt. Chiếc giày oxford bằng da cap toe này là một thiết kế của Vince Camuto đã sẵn sàng cho phòng họp hoặc một buổi tối đặc biệt. Đường khâu đơn giản ở phần trên được ốp, đánh bóng nhẹ xác định phần ngón chân và một chút đường in bên trong.</p>', 89.99, 0, '2023-01-14 00:31:16', '2023-01-13 17:31:16', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 2, 4, '<p><strong>TÍNH NĂNG, ĐẶC ĐIỂM</strong></p><ul><li>Mũ da</li><li>đóng cửa ren</li><li>Mũi giày tròn</li><li>lót vải in</li><li>Đệm chân nhẹ</li><li>Cao su &amp; đế tổng hợp</li><li>nhập khẩu</li></ul>', 'vince-camuto-lamson-cap-toe-oxford-1-1401123116.png'),
(15, 'Cole Haan GrandPro Rally Canvas Sneaker', 'cole-haan-grandpro-rally-canvas-sneaker-1401013819', '<h5><strong>GIÀY THỂ THAO VẢI CANVAS COLE HAAN GRANDPRO RALLY</strong></h5><p>Giày thể thao GrandPro Rally Canvas của Cole Haan làm sống lại tình yêu của bạn với kiểu dáng thể thao cổ điển. Giày thể thao buộc dây có công nghệ thoải mái Grand.ØS để tạo sự thoải mái và linh hoạt nhẹ, đồng thời được hỗ trợ bằng đế cốc EVA bền bỉ cùng với đế có kết cấu.</p>', 239.99, 0, '2023-01-14 01:38:19', '2023-01-13 18:38:19', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 12, 8, '<p><strong>TÍNH NĂNG, ĐẶC ĐIỂM</strong></p><ul><li>Vải &amp; da phía trên</li><li>đóng cửa ren</li><li>Ngón chân tròn</li><li>Vải lót</li><li>Đệm lót chân Grand Foam &amp; EVA</li><li>đế giữa EVA</li><li>đế EVA</li><li>nhập khẩu</li></ul>', 'cole-haan-grandpro-rally-canvas-sneaker--1-1401013819.png'),
(16, 'Off-White Low Vulcanized Sneaker', 'off-white-low-vulcanized-sneaker-1401025830', '<p>Mo ta cua san pham</p>', 399.99, 0, '2023-01-14 02:58:30', '2023-01-13 19:58:30', '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, 1, 8, '<ul><li>Tinh nang</li><li>1</li><li>2</li><li>&nbsp;</li></ul>', 'cole-haan-grandpro-rally-canvas-sneaker--1-1401025830.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

DROP TABLE IF EXISTS `product_variant`;
CREATE TABLE `product_variant` (
  `id` bigint(20) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(250) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 DEFAULT '',
  `discount` int(11) NOT NULL DEFAULT 0,
  `start_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `end_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: disabled\n1: enabled',
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2022-10-09 17:00:00',
  `id_product` bigint(20) NOT NULL,
  `thumbnail` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT 'product_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`id`, `count`, `slug`, `description`, `discount`, `start_at`, `end_at`, `status`, `created_at`, `updated_at`, `id_product`, `thumbnail`) VALUES
(1, 99, 'puma-ever-fs-sneaker-2412115452', '<h5><strong>PUMA EVER FS SNEAKER</strong></h5><p>Giày thể thao Puma Ever FS có thiết kế gọn gàng, tối giản, là sự bổ sung tuyệt vời cho vòng quay giày dép của bạn. Phần trên bằng da lộn với các dải định hình được bổ sung bằng một viên nang nâng cao, trong khi cổ áo có đệm và lớp lót vớ SoftFoam + cung cấp hỗ trợ đệm.</p>', 0, '2022-12-23 00:00:00', '2022-12-25 00:00:00', 1, '2022-12-24 11:54:53', '2022-10-09 17:00:00', 1, 'blah-2412115453.png'),
(2, 99, 'puma-ever-fs-sneaker-2412010225', '<h5><strong>PUMA EVER FS SNEAKER</strong></h5><p>Giày thể thao Puma Ever FS có thiết kế gọn gàng, tối giản, là sự bổ sung tuyệt vời cho vòng quay giày dép của bạn. Phần trên bằng da lộn với các dải định hình được bổ sung bằng một viên nang nâng cao, trong khi cổ áo có đệm và lớp lót vớ SoftFoam + cung cấp hỗ trợ đệm.</p>', 0, '2022-12-23 00:00:00', '2022-12-25 00:00:00', 1, '2022-12-24 13:02:25', '2022-10-09 17:00:00', 1, 'blah-2412010225.png'),
(3, 95, 'adolfo-luis-sneaker', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2022-10-10 00:00:00', '2022-10-09 17:00:00', 3, 'adolfo-luis-sneaker-4-2412011637.png'),
(4, 100, 'calvin-klein-nabil-loafer', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2022-10-10 00:00:00', '2022-10-09 17:00:00', 4, 'calvin-klein-nabil-loafer-1-2512014950.png'),
(5, 98, 'calvin-klein-nabil-loafer-2512015350', NULL, 0, '2022-12-21 00:00:00', '2022-12-31 00:00:00', 1, '2022-12-25 01:53:50', '2022-12-24 18:53:50', 4, 'calvin-klein-nabil-loafer-1-2512014950.png'),
(6, 48, 'calvin-klein-ryor-slip-on-sneaker', NULL, 0, '2022-10-10 00:00:00', '2023-10-29 00:00:00', 1, '2022-10-10 00:00:00', '2022-10-09 17:00:00', 5, 'calvin-klein-ryor-slip-on-sneaker-1-2512020525.png'),
(7, 46, 'calvin-klein-ryor-slip-on-sneaker-2512020705', NULL, 10, '2022-12-20 00:00:00', '2023-12-31 00:00:00', 1, '2022-12-25 02:07:06', '2022-12-24 19:07:06', 5, 'calvin-klein-ryor-slip-on-sneaker-1-2512020706.png'),
(8, 49, 'rockport-weather-or-not-chukka-boot', '<p>Đây là mô tả sản phẩm mới</p>', 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2022-10-10 00:00:00', '2022-10-09 17:00:00', 6, 'rockport-weather-or-not-chukka-boot-1-0201045756.png'),
(9, 100, 'rockport-weather-or-not-chukka-boot-0201050005', '<p>Đây là mô tả sản phẩm mới</p>', 20, '2023-01-02 00:00:00', '2023-01-20 00:00:00', 1, '2023-01-02 05:00:05', '2023-01-01 22:00:05', 6, 'rockport-weather-or-not-chukka-boot-1-0201050005.png'),
(10, 99, 'rockport-weather-or-not-chukka-boot-0201050257', '<p>Đây là mô tả sản phẩm mới</p>', 25, '2023-01-01 00:00:00', '2023-01-02 00:00:00', 1, '2023-01-02 05:02:57', '2023-01-01 22:02:57', 6, 'rockport-weather-or-not-chukka-boot-y-1-0201050257.png'),
(11, 0, 'rockport-weather-or-not-chukka-boot-0201050348', '<p>Đây là mô tả sản phẩm mới</p>', 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-02 05:03:48', '2023-01-01 22:03:48', 6, 'rockport-weather-or-not-chukka-boot-y-1-0201050348.png'),
(12, 150, 'birkenstock-arizona-slide-sandal', NULL, 10, '2023-01-01 00:00:00', '2023-01-14 00:00:00', 1, '2022-10-10 00:00:00', '2022-10-09 17:00:00', 7, 'birkenstock-arizona-slide-sandal-1-1001010534.png'),
(13, 18, 'vans-ward-lo-sneaker', NULL, 40, '2023-01-10 00:00:00', '2023-01-10 00:00:00', 1, '2022-10-10 00:00:00', '2022-10-09 17:00:00', 8, 'vans-ward-lo-sneaker-1-1001011923.png'),
(14, 200, 'crown-vintage-lingdale-boot', '<h5><strong>TÍNH NĂNG, ĐẶC ĐIỂM</strong></h5><ul><li>Mũ da</li><li>Khóa kéo bên trong</li><li>đóng cửa ren</li><li>Ngón chân tròn</li><li>Độn lưỡi</li><li>Dệt &amp; tổng hợp trên</li><li>Đệm chân</li><li>Đế cao su có lực kéo</li><li>nhập khẩu</li><li>Đây là tính năng biến thể sản phẩm</li></ul>', 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 22:52:39', '2023-01-13 15:52:39', 9, 'cole-haan-grand-atlantic-chukka-boot-1-1301105239.png'),
(15, 200, 'crown-vintage-lingdale-boot-1301105616', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 22:56:16', '2023-01-13 15:56:16', 9, 'product_default.png'),
(16, 99, 'crown-vintage-lingdale-boot-1301110254', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 23:02:54', '2023-01-13 16:02:54', 9, 'product_default.png'),
(17, 10, 'crown-vintage-lingdale-boot-1301111302', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 23:13:02', '2023-01-13 16:13:02', 9, 'cole-haan-grand-atlantic-chukka-boot-1-1301111302.png'),
(18, 100, 'v5-training-shoe', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 23:19:08', '2023-01-13 16:19:08', 10, 'v5-training-shoe-1-1301111908.png'),
(19, 150, 'v5-training-shoe-1301112026', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 23:20:26', '2023-01-13 16:20:26', 10, 'v5-training-shoe-1-1301112026.png'),
(20, 50, 'v5-training-shoe-1301112049', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 23:20:49', '2023-01-13 16:20:49', 10, 'product_default.png'),
(21, 50, 'v5-training-shoe-1301112326', NULL, 10, '2023-01-19 00:00:00', '2023-01-28 00:00:00', 1, '2023-01-13 23:23:26', '2023-01-13 16:23:26', 10, 'product_default.png'),
(22, 100, 'adidas-kaptir-20-sneaker', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 23:37:29', '2023-01-13 16:37:29', 11, 'adidas-kaptir-2.0-sneaker-1-1301113729.png'),
(23, 98, 'floafers-country-club-penny-loafer', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-13 23:42:02', '2023-01-13 16:42:02', 12, 'floafers-country-club-penny-loafer-1-1301114202.png'),
(24, 30, 'birkenstock-zermatt-clog-slipper', NULL, 10, '2023-01-11 00:00:00', '2023-01-31 00:00:00', 1, '2023-01-13 23:45:50', '2023-01-13 16:45:50', 13, 'birkenstock-zermatt-clog-slipper---mens-1-1301114550.png'),
(25, 49, 'birkenstock-zermatt-clog-slipper-1401122404', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-14 00:24:04', '2023-01-13 17:24:04', 13, 'birkenstock-zermatt-clog-slipper---mens-1-1401122404.png'),
(26, 199, 'vince-camuto-lamson-cap-toe-oxford', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-14 00:31:16', '2023-01-13 17:31:16', 14, 'vince-camuto-lamson-cap-toe-oxford-1-1401123116.png'),
(27, 9, 'vince-camuto-lamson-cap-toe-oxford-1401123139', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-14 00:31:39', '2023-01-13 17:31:39', 14, 'product_default.png'),
(28, 50, 'vince-camuto-lamson-cap-toe-oxford-1401123623', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-14 00:36:23', '2023-01-13 17:36:23', 14, 'vince-camuto-lamson-cap-toe-oxford-1-1401123623.png'),
(29, 150, 'cole-haan-grandpro-rally-canvas-sneaker', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-14 01:38:19', '2023-01-13 18:38:19', 15, 'cole-haan-grandpro-rally-canvas-sneaker--1-1401013819.png'),
(30, 150, 'cole-haan-grandpro-rally-canvas-sneaker-1401015736', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-14 01:57:36', '2023-01-13 18:57:36', 15, 'product_default.png'),
(31, 150, 'off-white-low-vulcanized-sneaker', NULL, 0, '2022-10-10 00:00:00', '2022-10-10 00:00:00', 1, '2023-01-14 02:58:30', '2023-01-13 19:58:30', 16, 'cole-haan-grandpro-rally-canvas-sneaker--1-1401025830.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_image`
--

DROP TABLE IF EXISTS `product_variant_image`;
CREATE TABLE `product_variant_image` (
  `id` bigint(20) NOT NULL,
  `id_product_variant` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT 'product_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='save image for product variant';

--
-- Dumping data for table `product_variant_image`
--

INSERT INTO `product_variant_image` (`id`, `id_product_variant`, `name`) VALUES
(32, 6, 'calvin-klein-ryor-slip-on-sneaker-4-2712053524.png'),
(36, 6, 'calvin-klein-ryor-slip-on-sneaker-2-2712054232.png'),
(37, 6, 'calvin-klein-ryor-slip-on-sneaker-3-2712054232.png'),
(38, 6, 'calvin-klein-ryor-slip-on-sneaker-5-2712054232.png'),
(39, 7, 'calvin-klein-ryor-slip-on-sneaker-1-2712054324.png'),
(40, 7, 'calvin-klein-ryor-slip-on-sneaker-2-2712054324.png'),
(41, 7, 'calvin-klein-ryor-slip-on-sneaker-3-2712054324.png'),
(42, 7, 'calvin-klein-ryor-slip-on-sneaker-4-2712054324.png'),
(43, 7, 'calvin-klein-ryor-slip-on-sneaker-5-2712054324.png'),
(44, 4, 'calvin-klein-nabil-loafer-1-2712054353.png'),
(45, 4, 'calvin-klein-nabil-loafer-2-2712054353.png'),
(46, 4, 'calvin-klein-nabil-loafer-3-2712054353.png'),
(47, 4, 'calvin-klein-nabil-loafer-4-2712054353.png'),
(48, 4, 'calvin-klein-nabil-loafer-5-2712054353.png'),
(49, 5, 'calvin-klein-nabil-loafer-1-2712054425.png'),
(50, 5, 'calvin-klein-nabil-loafer-2-2712054425.png'),
(51, 5, 'calvin-klein-nabil-loafer-3-2712054425.png'),
(52, 5, 'calvin-klein-nabil-loafer-4-2712054425.png'),
(53, 5, 'calvin-klein-nabil-loafer-5-2712054425.png'),
(54, 3, 'adolfo-luis-sneaker-1-2712054442.png'),
(55, 3, 'adolfo-luis-sneaker-2-2712054442.png'),
(56, 3, 'adolfo-luis-sneaker-3-2712054442.png'),
(57, 3, 'adolfo-luis-sneaker-4-2712054442.png'),
(58, 1, 'blah-2412115453-2712054620.png'),
(59, 2, 'blah-2412115453-2712054635.png'),
(60, 8, 'rockport-weather-or-not-chukka-boot-2-0201045756.png'),
(61, 8, 'rockport-weather-or-not-chukka-boot-3-0201045756.png'),
(62, 8, 'rockport-weather-or-not-chukka-boot-4-0201045756.png'),
(63, 8, 'rockport-weather-or-not-chukka-boot-5-0201045756.png'),
(64, 9, 'rockport-weather-or-not-chukka-boot-2-0201050005.png'),
(65, 9, 'rockport-weather-or-not-chukka-boot-3-0201050005.png'),
(66, 9, 'rockport-weather-or-not-chukka-boot-4-0201050005.png'),
(67, 9, 'rockport-weather-or-not-chukka-boot-5-0201050005.png'),
(68, 10, 'rockport-weather-or-not-chukka-boot-y-2-0201050257.png'),
(69, 10, 'rockport-weather-or-not-chukka-boot-y-3-0201050257.png'),
(70, 10, 'rockport-weather-or-not-chukka-boot-y-4-0201050257.png'),
(71, 10, 'rockport-weather-or-not-chukka-boot-y-5-0201050257.png'),
(72, 11, 'rockport-weather-or-not-chukka-boot-y-1-0201050348.png'),
(73, 11, 'rockport-weather-or-not-chukka-boot-y-2-0201050348.png'),
(74, 11, 'rockport-weather-or-not-chukka-boot-y-3-0201050348.png'),
(75, 11, 'rockport-weather-or-not-chukka-boot-y-4-0201050348.png'),
(76, 11, 'rockport-weather-or-not-chukka-boot-y-5-0201050348.png'),
(77, 12, 'birkenstock-arizona-slide-sandal-2-1001010534.png'),
(78, 12, 'birkenstock-arizona-slide-sandal-3-1001010534.png'),
(79, 12, 'birkenstock-arizona-slide-sandal-4-1001010534.png'),
(80, 12, 'birkenstock-arizona-slide-sandal-5-1001010534.png'),
(81, 12, 'birkenstock-arizona-slide-sandal-6-1001010534.png'),
(82, 13, 'vans-ward-lo-sneaker-2-1001011923.png'),
(83, 13, 'vans-ward-lo-sneaker-3-1001011923.png'),
(84, 13, 'vans-ward-lo-sneaker-4-1001011923.png'),
(85, 14, 'cole-haan-grand-atlantic-chukka-boot-2-1301105239.png'),
(86, 14, 'cole-haan-grand-atlantic-chukka-boot-3-1301105239.png'),
(87, 14, 'cole-haan-grand-atlantic-chukka-boot-4-1301105239.png'),
(88, 14, 'cole-haan-grand-atlantic-chukka-boot-5-1301105239.png'),
(89, 14, 'cole-haan-grand-atlantic-chukka-boot-6-1301105239.png'),
(90, 17, 'cole-haan-grand-atlantic-chukka-boot-2-1301111302.png'),
(91, 17, 'cole-haan-grand-atlantic-chukka-boot-3-1301111302.png'),
(92, 17, 'cole-haan-grand-atlantic-chukka-boot-4-1301111302.png'),
(93, 17, 'cole-haan-grand-atlantic-chukka-boot-5-1301111302.png'),
(94, 17, 'cole-haan-grand-atlantic-chukka-boot-6-1301111302.png'),
(95, 18, 'v5-training-shoe-2-1301111908.png'),
(96, 18, 'v5-training-shoe-3-1301111908.png'),
(97, 18, 'v5-training-shoe-4-1301111908.png'),
(98, 18, 'v5-training-shoe-5-1301111908.png'),
(99, 19, 'v5-training-shoe-2-1301112026.png'),
(100, 19, 'v5-training-shoe-3-1301112026.png'),
(101, 19, 'v5-training-shoe-4-1301112026.png'),
(102, 19, 'v5-training-shoe-5-1301112026.png'),
(103, 22, 'adidas-kaptir-2.0-sneaker-2-1301113729.png'),
(104, 22, 'adidas-kaptir-2.0-sneaker-3-1301113729.png'),
(105, 22, 'adidas-kaptir-2.0-sneaker-4-1301113729.png'),
(106, 22, 'adidas-kaptir-2.0-sneaker-5-1301113729.png'),
(107, 23, 'floafers-country-club-penny-loafer-2-1301114202.png'),
(108, 23, 'floafers-country-club-penny-loafer-3-1301114202.png'),
(109, 23, 'floafers-country-club-penny-loafer-4-1301114202.png'),
(110, 24, 'birkenstock-zermatt-clog-slipper---mens-1-1301114550.png'),
(111, 25, 'birkenstock-zermatt-clog-slipper---mens-1-1401122404.png'),
(112, 26, 'vince-camuto-lamson-cap-toe-oxford-2-1401123116.png'),
(113, 26, 'vince-camuto-lamson-cap-toe-oxford-3-1401123116.png'),
(114, 26, 'vince-camuto-lamson-cap-toe-oxford-4-1401123116.png'),
(115, 26, 'vince-camuto-lamson-cap-toe-oxford-5-1401123116.png'),
(116, 26, 'vince-camuto-lamson-cap-toe-oxford-6-1401123116.png'),
(117, 28, 'vince-camuto-lamson-cap-toe-oxford-1-1401123623.png'),
(118, 28, 'vince-camuto-lamson-cap-toe-oxford-2-1401123623.png'),
(119, 28, 'vince-camuto-lamson-cap-toe-oxford-3-1401123623.png'),
(120, 28, 'vince-camuto-lamson-cap-toe-oxford-4-1401123623.png'),
(121, 28, 'vince-camuto-lamson-cap-toe-oxford-5-1401123623.png'),
(122, 28, 'vince-camuto-lamson-cap-toe-oxford-6-1401123623.png'),
(123, 29, 'cole-haan-grandpro-rally-canvas-sneaker--1-1401013819.png'),
(124, 29, 'cole-haan-grandpro-rally-canvas-sneaker--2-1401013819.png'),
(125, 29, 'cole-haan-grandpro-rally-canvas-sneaker--3-1401013819.png'),
(126, 29, 'cole-haan-grandpro-rally-canvas-sneaker--4-1401013819.png'),
(127, 31, 'cole-haan-grandpro-rally-canvas-sneaker--1-1401025830.png'),
(128, 31, 'cole-haan-grandpro-rally-canvas-sneaker--2-1401025830.png'),
(129, 31, 'cole-haan-grandpro-rally-canvas-sneaker--3-1401025830.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_option`
--

DROP TABLE IF EXISTS `product_variant_option`;
CREATE TABLE `product_variant_option` (
  `id` bigint(20) NOT NULL,
  `id_option` bigint(20) NOT NULL,
  `id_product_variant` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: disabled\n1: enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variant_option`
--

INSERT INTO `product_variant_option` (`id`, `id_option`, `id_product_variant`, `status`) VALUES
(15, 21, 7, 1),
(16, 25, 7, 1),
(17, 24, 4, 1),
(18, 25, 4, 1),
(19, 20, 5, 1),
(20, 25, 5, 1),
(21, 22, 3, 1),
(22, 25, 3, 1),
(23, 20, 1, 1),
(24, 25, 1, 1),
(25, 24, 2, 1),
(26, 25, 2, 1),
(27, 20, 6, 1),
(28, 25, 6, 1),
(30, 20, 10, 1),
(31, 21, 11, 1),
(32, 20, 8, 1),
(33, 25, 8, 1),
(38, 22, 12, 1),
(39, 25, 12, 1),
(40, 21, 13, 1),
(41, 25, 13, 1),
(42, 20, 16, 1),
(43, 25, 16, 1),
(44, 22, 17, 1),
(45, 25, 17, 1),
(46, 22, 21, 1),
(49, 20, 29, 1),
(50, 25, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_property`
--

DROP TABLE IF EXISTS `product_variant_property`;
CREATE TABLE `product_variant_property` (
  `id` bigint(20) NOT NULL,
  `id_property` bigint(20) NOT NULL,
  `id_product_variant` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variant_property`
--

INSERT INTO `product_variant_property` (`id`, `id_property`, `id_product_variant`) VALUES
(36, 10, 7),
(37, 11, 7),
(38, 16, 7),
(39, 6, 4),
(40, 11, 4),
(41, 14, 4),
(42, 10, 5),
(43, 11, 5),
(44, 18, 5),
(45, 6, 3),
(46, 11, 3),
(47, 14, 3),
(48, 5, 1),
(49, 11, 1),
(50, 12, 1),
(51, 5, 2),
(52, 11, 2),
(53, 15, 2),
(54, 10, 6),
(55, 11, 6),
(56, 19, 6),
(60, 22, 9),
(61, 11, 9),
(62, 18, 9),
(63, 23, 10),
(64, 11, 10),
(65, 19, 10),
(66, 23, 11),
(67, 8, 11),
(68, 18, 11),
(69, 22, 8),
(70, 11, 8),
(71, 12, 8),
(78, 22, 12),
(79, 11, 12),
(80, 14, 12),
(81, 6, 13),
(82, 11, 13),
(83, 18, 13),
(84, 22, 14),
(85, 11, 14),
(86, 20, 14),
(87, 22, 15),
(88, 11, 15),
(89, 21, 15),
(93, 22, 16),
(94, 11, 16),
(95, 19, 16),
(96, 22, 17),
(97, 11, 17),
(98, 18, 17),
(99, 6, 18),
(100, 11, 18),
(101, 16, 18),
(102, 6, 19),
(103, 11, 19),
(104, 19, 19),
(105, 6, 20),
(106, 11, 20),
(107, 18, 20),
(108, 6, 21),
(109, 8, 21),
(110, 21, 21),
(111, 6, 22),
(112, 11, 22),
(113, 19, 22),
(114, 2, 23),
(115, 11, 23),
(116, 19, 23),
(117, 1, 24),
(118, 11, 24),
(119, 20, 24),
(120, 1, 25),
(121, 11, 25),
(122, 18, 25),
(123, 22, 26),
(124, 11, 26),
(125, 15, 26),
(126, 22, 27),
(127, 11, 27),
(128, 19, 27),
(129, 22, 28),
(130, 11, 28),
(131, 15, 28),
(138, 2, 29),
(139, 11, 29),
(140, 16, 29),
(141, 2, 30),
(142, 11, 30),
(143, 20, 30),
(144, 2, 31),
(145, 8, 31),
(146, 17, 31);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE `property` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `value` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `id_property_group` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `name`, `value`, `id_property_group`) VALUES
(1, 'Đỏ', '#E94959', 1),
(2, 'Xanh da trời', '#52A7E0', 1),
(3, 'Xanh lá cây', '#A5D9A5', 1),
(4, 'Hồng', '#FFE6ED', 1),
(5, 'Trắng ', '#FFFFFF', 1),
(6, 'Đen', '#000000', 1),
(8, 'Extra width', 'Lớn', 2),
(10, 'Ghi', '#968c94', 1),
(11, 'Medium Width', 'Trung bình', 2),
(12, '4', '4', 5),
(13, '4.5', '4.5', 5),
(14, '5', '5', 5),
(15, '5.5', '5.5', 5),
(16, '6', '6', 5),
(17, '6.5', '6.5', 5),
(18, '7', '7', 5),
(19, '7.5', '7.5', 5),
(20, '8', '8', 5),
(21, '8.5', '8.5', 5),
(22, 'Nâu', '#93694e', 1),
(23, 'Vàng', '\n#c08a4d', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_group`
--

DROP TABLE IF EXISTS `property_group`;
CREATE TABLE `property_group` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2022-10-09 17:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='product property group ( color,  width, height, custome part)';

--
-- Dumping data for table `property_group`
--

INSERT INTO `property_group` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Màu sắc', '2022-10-20 09:16:47', '2022-10-20 02:16:47'),
(2, 'Độ rộng', '2022-10-10 00:00:00', '2022-10-09 17:00:00'),
(5, 'Kích cỡ', '2022-10-21 09:16:47', '2022-10-21 02:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Customer\n1: Account',
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`ip_address`, `id`, `user_id`, `type`, `user_agent`, `payload`, `last_activity`, `customer_id`) VALUES
('127.0.0.1', 'bLTcL6VELj00xsm25qW4WYlawJMxwKTJgLhvaurX', 1, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicm15T0c3R2NseHpmSWxLcE1tNEFBd3pheEpORWROajJEUzJDQmpnTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdGF0aXN0aWMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU1OiJsb2dpbl9jdXN0b21lcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1673665263, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `avatar` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT 'admin_default.png',
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Disabled\n1: Enabled\n',
  `role` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: employee\n1: admin',
  `created_at` datetime NOT NULL DEFAULT '2022-10-10 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2022-10-09 17:00:00',
  `remember_token` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `phone_number` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='admin account';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `avatar`, `email`, `password`, `status`, `role`, `created_at`, `updated_at`, `remember_token`, `phone_number`) VALUES
(1, 'Dang Tuan Dat', 'dtd-ava.png', 'mrboss862000@gmail.com', '$2y$10$UtTSnZUhQTmm3NCtv8n8dOduHxAyjXhxiBieDDgeVOPk/xqTUKYca', 1, 1, '2022-12-16 10:40:43', '2022-12-19 00:51:15', '0w98zMrIifVBKbtBxYkvpw4xzzN52dFbhxYu3f0OjGb4p8w0cNCPQNCz6V82', '0986884237'),
(4, 'Do Duy Hung', 'avatar-1001124642.png', 'hkim661990@gmail.com', '$2y$10$UtTSnZUhQTmm3NCtv8n8dOduHxAyjXhxiBieDDgeVOPk/xqTUKYca', 1, 0, '2022-12-19 00:53:53', '2022-12-18 23:52:05', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

DROP TABLE IF EXISTS `user_history`;
CREATE TABLE `user_history` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_history`
--

INSERT INTO `user_history` (`id`, `user_id`, `login_time`) VALUES
(1, 1, '2022-10-20 11:13:48'),
(2, 1, '2022-12-18 11:14:07'),
(3, 1, '2022-12-18 16:07:53'),
(4, 1, '2022-12-18 16:11:11'),
(5, 1, '2022-12-18 16:15:47'),
(6, 1, '2022-12-18 16:16:30'),
(7, 1, '2022-12-18 16:17:24'),
(8, 1, '2022-12-18 16:17:43'),
(9, 1, '2022-12-18 16:18:50'),
(10, 1, '2022-12-18 16:19:59'),
(11, 1, '2022-12-18 16:20:16'),
(12, 1, '2022-12-18 16:22:24'),
(13, 1, '2022-12-18 16:57:47'),
(14, 1, '2022-12-18 16:58:40'),
(15, 1, '2022-12-18 16:59:34'),
(16, 1, '2022-12-18 17:00:25'),
(17, 1, '2022-12-19 00:08:33'),
(18, 1, '2022-12-19 01:09:25'),
(19, 1, '2022-12-19 06:47:41'),
(20, 1, '2022-12-19 23:19:49'),
(21, 1, '2022-12-20 06:50:47'),
(22, 1, '2022-12-20 08:48:16'),
(23, 1, '2022-12-22 15:15:34'),
(24, 1, '2022-12-22 15:50:51'),
(25, 1, '2022-12-23 03:15:59'),
(26, 1, '2022-12-24 01:09:32'),
(27, 1, '2022-12-25 00:57:08'),
(28, 1, '2022-12-25 01:41:28'),
(29, 1, '2022-12-26 06:10:53'),
(30, 1, '2022-12-26 07:08:54'),
(31, 1, '2022-12-26 17:48:54'),
(32, 1, '2022-12-27 02:37:06'),
(33, 1, '2022-12-27 14:52:04'),
(34, 1, '2022-12-28 08:34:22'),
(35, 1, '2022-12-28 08:34:45'),
(36, 1, '2022-12-28 08:35:02'),
(37, 1, '2023-01-02 04:50:08'),
(38, 1, '2023-01-10 00:20:45'),
(39, 4, '2023-01-10 00:21:32'),
(40, 1, '2023-01-10 02:36:43'),
(41, 1, '2023-01-13 22:36:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_slug_uindex` (`slug`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_fk_product_variant` (`id_product_variant`),
  ADD KEY `cart_item_fk_customer` (`id_customer`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_fk_option_group` (`id_option_group`);

--
-- Indexes for table `option_group`
--
ALTER TABLE `option_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_fk_customer` (`id_customer`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_fk_order` (`id_order`),
  ADD KEY `order_detail_fk_product_variant` (`id_product_variant`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_slug_uindex` (`slug`),
  ADD KEY `product_fk_brand` (`id_brand`),
  ADD KEY `product_fk_category` (`id_category`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_fk_product` (`id_product`);

--
-- Indexes for table `product_variant_image`
--
ALTER TABLE `product_variant_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_image_fk_product_variant` (`id_product_variant`);

--
-- Indexes for table `product_variant_option`
--
ALTER TABLE `product_variant_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_option_fk_option` (`id_option`),
  ADD KEY `product_variant_option_fk_product_variant` (`id_product_variant`);

--
-- Indexes for table `product_variant_property`
--
ALTER TABLE `product_variant_property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variant_property_fk_property` (`id_property`),
  ADD KEY `product_variant_property_fk_product_variant` (`id_product_variant`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_fk_property_group` (`id_property_group`);

--
-- Indexes for table `property_group`
--
ALTER TABLE `property_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_uindex` (`email`);

--
-- Indexes for table `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_history_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `option_group`
--
ALTER TABLE `option_group`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_variant_image`
--
ALTER TABLE `product_variant_image`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `product_variant_option`
--
ALTER TABLE `product_variant_option`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_variant_property`
--
ALTER TABLE `product_variant_property`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `property_group`
--
ALTER TABLE `property_group`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_fk_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `cart_item_fk_product_variant` FOREIGN KEY (`id_product_variant`) REFERENCES `product_variant` (`id`);

--
-- Constraints for table `option`
--
ALTER TABLE `option`
  ADD CONSTRAINT `option_fk_option_group` FOREIGN KEY (`id_option_group`) REFERENCES `option_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_fk_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_fk_order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_detail_fk_product_variant` FOREIGN KEY (`id_product_variant`) REFERENCES `product_variant` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_fk_brand` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_fk_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_fk_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_variant_image`
--
ALTER TABLE `product_variant_image`
  ADD CONSTRAINT `product_variant_image_fk_product_variant` FOREIGN KEY (`id_product_variant`) REFERENCES `product_variant` (`id`);

--
-- Constraints for table `product_variant_option`
--
ALTER TABLE `product_variant_option`
  ADD CONSTRAINT `product_variant_option_fk_option` FOREIGN KEY (`id_option`) REFERENCES `option` (`id`),
  ADD CONSTRAINT `product_variant_option_fk_product_variant` FOREIGN KEY (`id_product_variant`) REFERENCES `product_variant` (`id`);

--
-- Constraints for table `product_variant_property`
--
ALTER TABLE `product_variant_property`
  ADD CONSTRAINT `product_variant_property_fk_product_variant` FOREIGN KEY (`id_product_variant`) REFERENCES `product_variant` (`id`),
  ADD CONSTRAINT `product_variant_property_fk_property` FOREIGN KEY (`id_property`) REFERENCES `property` (`id`);

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_fk_property_group` FOREIGN KEY (`id_property_group`) REFERENCES `property_group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_history`
--
ALTER TABLE `user_history`
  ADD CONSTRAINT `user_history_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
