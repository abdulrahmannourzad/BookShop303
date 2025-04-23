-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2025 at 04:36 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

DROP TABLE IF EXISTS `tbl_books`;
CREATE TABLE IF NOT EXISTS `tbl_books` (
  `bid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'شناسه کتاب',
  `bname` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام کتاب',
  `author` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام نویسنده',
  `price` int(11) NOT NULL COMMENT 'قیمت کتاب',
  `sid` int(11) NOT NULL COMMENT 'شناسه موضوع',
  `des` text COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'توصیف کتاب',
  `cover` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام تصویر جلد کتاب',
  `status` tinyint(4) NOT NULL COMMENT 'وضعیت موجودی کتاب',
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci COMMENT='جدول کتاب ها';

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`bid`, `bname`, `author`, `price`, `sid`, `des`, `cover`, `status`) VALUES
(7, 'مرجع کامل طراحی سایت (HTML, CSS, JavaScript)', 'پائول مک فدریس', 130000, 1, 'پائول مک فدریس در کتاب مرجع کامل طراحی سایت (HTML, CSS, JavaScript ) به مخاطبان می‌آموزد که چطور با استفاده از CSS و HTML سایت شخصی خود را بسازند و به وسیله‌ی جاوااسکریپت آن را برنامه‌نویسی نمایند. مهم‌ترین ویژگی این کتاب که آن را از سایر کتاب‌ها در این زمینه متمایز می‌کند آن است که برای مطالعه‌ی آن نیاز به هیچ پیش‌زمینه‌ای نیست و صفر تا صد مباحث به صورت کاربردی و حرفه‌ای در اختیار مخاطبان قرار گرفته است.', '1743245559_مرجع کامل طراحی سایت.jpg', 0),
(8, 'شبکه ساده و کاربردی', 'زهرا بیات قلی لاله', 120000, 1, 'چند وقت پیش یکی از دوستان به من مراجعه کردن و می خواستن که کار کردن با شبکه را به صورت کاملا عملی به او آموزش دهم. این دوست عزیز کتاب های متنوعی در مورد شبکه مطالعه کرده بود، و در بین انبوهی از اطلاعات قرار گرفته بود. وقتی به من مراجعه کرد اطلاعات زیادی در مورد مفاهیم شبکه داشت. اما نمی توانست حتی یک شبکه ساده را، راه اندازی کند. او از من خواست با زبان خیلی ساده مفاهیم عملی شبکه را به او آموزش دهم. همین جرقه ای شد تا کتابی ساده و روان در مورد آموزش عملی شبکه برای دوستانی که همچین مشکلی دارند بنویسم. این کتاب، کار کردن با شبکه را بدون درگیر شدن با اصطلاحات تئوری و خسته کننده و به صورت کاملا ساده به شما آموزش می دهد.', '1743245883_تصویر شبکه.jpg', 0),
(11, 'وردپرس', 'نازی', 140000, 1, 'آموزش وردپرس درس آخر', '1744703497_images.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

DROP TABLE IF EXISTS `tbl_items`;
CREATE TABLE IF NOT EXISTS `tbl_items` (
  `items_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'شناسه آیتم',
  `oid` int(11) NOT NULL COMMENT 'شناسه سفارش',
  `bid` int(11) NOT NULL COMMENT 'شناسه کتاب',
  `price` int(11) NOT NULL COMMENT 'قیمت کتاب',
  `tedad` int(11) NOT NULL COMMENT 'تعداد',
  PRIMARY KEY (`items_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `oid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'شناسه سفارش',
  `odate` char(8) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'تاریخ سفارش',
  `uid` int(11) NOT NULL COMMENT 'شناسه کاربر مشتری',
  `address` varchar(400) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'آدرس پستی',
  `status_order_id` int(11) NOT NULL COMMENT 'شناسه وضعیت سفارش',
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`oid`, `odate`, `uid`, `address`, `status_order_id`) VALUES
(1, '14040124', 1, 'گنبد کاووس', 1),
(2, '14040124', 1, 'گنبد کاووس', 1),
(3, '14040125', 2, 'آق قلا', 1),
(4, '14040125', 2, 'آق قلا', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders_status`
--

DROP TABLE IF EXISTS `tbl_orders_status`;
CREATE TABLE IF NOT EXISTS `tbl_orders_status` (
  `status_order_id` tinyint(4) NOT NULL COMMENT 'شناسه وضعیت سفارش',
  `status_order_name` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام وضعیت سفارش',
  PRIMARY KEY (`status_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `tbl_orders_status`
--

INSERT INTO `tbl_orders_status` (`status_order_id`, `status_order_name`) VALUES
(1, 'منتظر پرداخت'),
(2, 'پرداخت شده'),
(3, 'در حال پردازش'),
(4, 'ارسال شده'),
(5, 'تحویل شده'),
(6, 'مرجوع شده');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subs`
--

DROP TABLE IF EXISTS `tbl_subs`;
CREATE TABLE IF NOT EXISTS `tbl_subs` (
  `sid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'شناسه موضوع',
  `sname` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'عنوان موضوع',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `tbl_subs`
--

INSERT INTO `tbl_subs` (`sid`, `sname`) VALUES
(1, 'کامپیوتر'),
(2, 'عمومی');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'شناسه کاربر',
  `uname` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام کاربر',
  `role` varchar(100) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نقش کاربر',
  `mobile` char(11) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'موبایل',
  `password` varchar(50) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'رمز عبور',
  `avatar` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'آواتار',
  `address` varchar(300) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'آدرس',
  `status` tinyint(4) NOT NULL COMMENT 'وضعیت 0 یا 1',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`uid`, `uname`, `role`, `mobile`, `password`, `avatar`, `address`, `status`) VALUES
(1, 'عبدالرحمان نورزاد', 'مدیر', '09115179917', 'Taha8963', 'رايانش ابري براي شرکت ها.jpg', 'گنبد کاووس گدم آباد', 1),
(2, 'خلیل ابراهیم بهروزیان', 'مشتری', '09333740020', 'Taha8963', 'image2.png', 'گنبد', 1),
(3, 'هنرستان الغدیر', 'مدیر', '09119121234', 'alghadir1404', 'image3.png', 'گنبد هنرستان الغدیر', 1),
(4, 'کاردانش الغدیر', 'مشتری', '09119121235', 'alghadir1404', 'image4.png', 'گنبد کاردانش الغدیر', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_status`
--

DROP TABLE IF EXISTS `tbl_users_status`;
CREATE TABLE IF NOT EXISTS `tbl_users_status` (
  `user_status_id` tinyint(4) NOT NULL COMMENT 'وضعیت کاربر 0 یا 1',
  `user_status_name` varchar(20) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام وضعیت کاربر',
  PRIMARY KEY (`user_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `tbl_users_status`
--

INSERT INTO `tbl_users_status` (`user_status_id`, `user_status_name`) VALUES
(0, 'غیرفعال'),
(1, 'فعال');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
