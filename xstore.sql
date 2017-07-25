-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 04 2017 г., 00:23
-- Версия сервера: 5.5.53
-- Версия PHP: 5.4.45-0+deb7u5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `xstore`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(30) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_email`, `admin_pass`, `admin_name`) VALUES
(1, 'a@a', 'a', 'Adam'),
(2, 'b', 'b', 'bob');

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` varchar(255) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'ASUS'),
(3, 'Acer'),
(4, 'Samsung'),
(5, 'Packard Bell'),
(6, 'Lenovo');

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(255) NOT NULL,
  `p_id` int(255) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `session_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `qty`, `user_email`, `session_id`) VALUES
(0, 2, '85.115.248.225', 4, '', '588354qd45qoasv1a8f3ev8ef6'),
(36, 4, '::1', 6, 'test@test.ru', '');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(255) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(6, 'Мобильные телефоны'),
(8, 'Камеры'),
(9, 'Ноутбуки'),
(10, 'Планшеты'),
(12, 'Телевизоры');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `customer_contact` (`customer_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES
(0, '88.87.84.166', '0', '0', '0', 'Russia', '0', '0', '0', ''),
(1, '127.0.0.1', 'tests', 'test@test.ru', '12', 'Russia', 'Volgograddddd', '1234567899', 'Russia, Volgograd oblast, Volgograd city', ''),
(2, '::1', 'Ronald', 'ronald@mail.ru', '0000', 'France', 'Belfast', '+3 897 678 35', 'Green Avenue 15', 'canon.jpg'),
(5, '::1', 'admin', 'admin', 'admin', 'German', 'Berlin', '+6 456 789 34', 'Nurburgring, 11', 'blog-header.jpg'),
(6, '127.0.0.1', 'Kyle', 'k', 'k', '', 'New-York', '+360 745 87 63', '5th Avenue, b. 7', '');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `customer_contact` (`customer_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `customer_name`, `customer_email`, `customer_address`, `customer_contact`, `product_id`, `product_qty`, `product_title`, `status`) VALUES
(28, 1, 'tests', 'test@test.ru', 'Russia, Volgograd oblast, Volgograd city', '12345678', 3, 1, 'Lenovo AMD A6', 'Checking');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_cat` int(200) DEFAULT NULL,
  `product_brand` int(200) DEFAULT NULL,
  `product_title` varchar(200) DEFAULT NULL,
  `product_desc` text,
  `product_price` int(200) DEFAULT NULL,
  `product_image` text,
  `product_keywords` text,
  PRIMARY KEY (`product_id`),
  FULLTEXT KEY `product_title` (`product_title`,`product_desc`,`product_keywords`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_desc`, `product_price`, `product_image`, `product_keywords`) VALUES
(2, 12, 5, 'Packard Bell Easy Note TS11HR', '<p>Packard Bell Easy Note TS11HR travelmate i5 320Gb WiFi</p>', 490, '', 'PackardBell TS11HR laptop'),
(3, 9, 6, 'Lenovo AMD A6', '<p>Lenovo AMD A6 RAM 4gb HDD 1TB</p>', 450, '', 'Lenovo IdeaPad laptop laptops'),
(4, 12, 3, 'Asus GT 40 Gamer i7', '<p>Asus GT 40 Gamer i7 16Gb NVidia GTX940Ti</p>', 1500, '', 'ASUS Gamer i7 16Gb 1Tb'),
(5, 12, 3, 'Acer A5', '<p>Smartphone Acer A5</p>', 150, '', 'Acer A5 smartphone'),
(6, 12, 4, 'Samsung Galaxy S7 ', '<p>Samsung Galaxy S7 64Gb Wi-Fi</p>', 500, '', 'Samsung S7 64Gb'),
(7, 6, 6, 'Lenovo Mi 5 ', '<p>Lenovo Mi 5 16Gb 8Mp</p>', 250, '', 'Lenovo Mi 5 mobile'),
(8, 12, 2, 'Asus Zenphone 4', '<p>Asus Zenphone 4 16Mp 32Gb Wi-Fi Bluetooth</p>', 399, '', 'Asus Zenphone 4 mobile'),
(10, 12, 3, 'ACER Icon Tab 2', '<p>Icon Tab 2 - the new pad of Acer Inc.&nbsp;</p>', 250, '', 'Acer tab 2'),
(11, 9, 2, 'ASUS X105 i3', 'ASUS X105 Intel Core i3 FHD SSD 126 Гб ОЗУ 4Гб', 450, '', 'ASUS X105 i3 SSD 128 Гб HDD 500Гб FHD'),
(12, 9, 3, 'Acer E 15 E5-575G', 'Acer E 15 FHD 4Gb RAM HDD 500Gb i3 Wi-Fi DDR 4', 600, '', 'Acer E 15 FHD 4Gb HDD 500Gb DDR 4 Wi-Fi'),
(13, 9, 5, 'PackardBell TravelMate B7', 'PackardBell 1366x768 Wi-Fi RAM 6Gb HDD 1Tb GeForce 940M DDR3 ', 410, '', 'ноутбук PackardBell 366x768 Wi-Fi RAM 6Gb HDD 1Tb GeForce 940M DDR3 ');

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL,
  `txt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `txt`) VALUES
(1, 'lol'),
(2, 'lolzzzz'),
(3, 'lolzzzz'),
(4, 'lol');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
