-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2018 at 07:04 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_id`) VALUES
(1, 'tshirts', 1),
(17, 'trousers', 2),
(18, 'coat', 6);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` int(11) UNSIGNED DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `address`, `city`, `country`, `postcode`, `email`, `password_hash`, `phone`, `role`, `date`) VALUES
(6, 'Heider', 'Jeffer', 'Bozen', 'Bozen', 'Italy', 3900, 'hheider.jeffer@gmail.com', '$2y$14$7bywBKgD1PpsLiPxs/43zO/SjmxB9Qk6yJMb1/Dnm8v0ZYjkQcu3m', '3512348170', 'Customer', '2018-05-26'),
(7, 'Heider', 'Jeffer', 'Bozen', 'Bozen', 'Italy', 3900, 'hheider@gmail.com', '$2y$14$Bw847ReDOYWsLXIiLTzHceoKZBl5yIvqLbTW7Jkr3LYsCLUQ1hIUa', '3512348170', 'Customer', '2018-05-26'),
(8, 'Ahlam', 'Jeffer', 'USA', 'USA', 'USA', 3900, 'AhlamJeffer@gmail.com', '$2y$14$5kupQlLhjCLzVJBGPrWBYe6e/UlJgGB5Hby46oXDKaWIE.n1YhHP6', '6382990921', 'Customer', '2018-05-26'),
(9, 'Obama', 'Barak', '787', 'BB', 'Boz', 778, 'obama@white.com', '$2y$14$z7eHFePOWQbAhCRSO5sbouU2SOCcTUuflDF11u6NARKtibTep7.86', '0909', 'Customer', '2018-05-27'),
(10, 'Amir', 'Noor', 'Bozen', 'Bozen', 'Italy', 778, 'amir@unibz.it', '$2y$14$QFMZZM1Jx9Q6xuq31fnlreR.lDIbP4cxwQ23IsbVX2IgvC/FJPsDa', '3512348170', 'Customer', '2018-05-27'),
(11, 'Kölen', 'Würth Phoenix', '2322', 'Kölen', 'Germany', 50667, 'kolen@kolen.com', '$2y$14$8j/0DmhryttNxPjT843kMup/U3NkLqg9yFxM/NjxKT2kvBzEngcHi', '3645635465', 'Customer', '2018-05-27'),
(12, 'حيدر جعفر', 'حيدر', '3535', 'fddrdr', 'ffff', 66656, 'ggg@gmail.com', '$2y$14$HS6Wu3r5JX0FlrR0DNy.wuUzlWKD4rsf0O5hyyH85KDbfSHa/KpXG', '576565', 'Customer', '2018-05-28'),
(13, 'Morad', 'Fahmmy', '686868', 'Bozen', 'Italy', 898989, 'morad.fahmy@gmail.com', '$2y$14$VOzOW2JDwOCB2lreaSqtfekgnAldUjJyM2m4mY3GXSeEWf4osII62', '80080', 'Customer', '2018-05-28'),
(14, 'Ali', 'Jeffer', 'Baghdad', 'Baghdad', 'Iraq', 790000, 'ali.jeffer@gmail.com', '$2y$14$w9VOA0VSKDs3qfT/LcD15eQIRS9nLJSSdoW1WGSgjFtb.5yt1XfF6', '3645635465', 'Customer', '2018-05-28'),
(15, 'Mariam', 'Abas', 'Baghdad', 'Baghdad', 'Iraq', 66656, 'mariamabas@gmail.com', '$2y$14$6Qj3bs88wASveundZs5wKeaOmYzrR34H8D1QRCyDtAb/gRdriphY2', '3645635465', 'Customer', '2018-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `qauntity` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `pic_path` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `name`, `qauntity`, `color`, `price`, `pic_path`, `description`) VALUES
(1, 1, 'Pure Aqua Blue Linen Shirt', 7, 'blue', 56, 'images/tshirt/b1.jpg', 'Add a touch of luxury to your wardrobe with our linen shirt.  Crafted from pure linen, wear the beige shirt with black slim-fit jeans and brown boots for a dressed up off-duty look.'),
(2, 1, 'Pure Beige Linen Shirt', 9, 'blue', 40, 'images/tshirt/b2.jpg', 'Add a touch of luxury to your wardrobe with our linen shirt.  Crafted from pure linen, wear the beige shirt with black slim-fit jeans and brown boots for a dressed up off-duty look.'),
(3, 1, 'Pure Ocean Green Linen Shirt', 2, 'blue', 70, 'images/tshirt/b3.jpg', 'Add a touch of luxury to your wardrobe with our linen shirt.  Crafted from pure linen, wear the green shirt with black slim-fit jeans and brown boots for a dressed up off-duty look.'),
(4, 1, 'Pure White Linen Shirt', 12, 'blue', 40, 'images/tshirt/b4.jpg', 'Add a touch of luxury to your wardrobe with our linen shirt.  Crafted from pure linen, wear the beige shirt with black slim-fit jeans and brown boots for a dressed up off-duty look.'),
(5, 1, 'Giza Rusty Dobby Cotton Shirt', 12, 'blue', 90, 'images/tshirt/b5.jpg', 'Woven from pure giza cotton, the rusty dobby shirt is a versatile wardrobe must-have.Pair this design with black tailored chinos and black loafers for a sophisticated evening look. '),
(6, 1, 'Giza Yellow Dobby Cotton Shirt', 7, 'blue', 40, 'images/tshirt/b6.jpg', 'Woven from pure giza cotton, the rusty dobby shirt is a versatile wardrobe must-have.Pair this design with black tailored chinos and black loafers for a sophisticated evening look. '),
(8, 1, 'Giza M Black Cotton Shirt', 12, 'blue', 70, 'images/tshirt/b8.jpg', 'Woven from pure giza cotton, the rusty dobby shirt is a versatile wardrobe must-have.Pair this design with black tailored chinos and black loafers for a sophisticated evening look. '),
(9, 1, 'Roman Light Purple Linen Shirt', 12, 'blue', 90, 'images/tshirt/b9.jpg', 'Add a touch of luxury to your wardrobe with our linen shirt.  Crafted from pure linen, wear the beige shirt with black slim-fit jeans and brown boots for a dressed up off-duty look.'),
(10, 1, 'Giza Kyle Blue Cotton Shirt', 12, 'blue', 40, 'images/tshirt/b10.jpg', 'Woven from pure giza cotton, the rusty dobby shirt is a versatile wardrobe must-have.Pair this design with black tailored chinos and black loafers for a sophisticated evening look. '),
(109, 17, 'Black Chinos', 5, 'blue', 60, 'images/trouser/trouser/b1.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(110, 17, 'Black Chinos', 8, 'blue', 140, 'images/trouser/trouser/b2.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(111, 17, 'European Khaki Chinos', 27, 'blue', 190, 'images/trouser/trouser/b3.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days. \r\n\r\nA trusty pair of khaki trousers are an enduring style classic, and a must for the most stylish of men.\r\n\r\nCotton chinos made from Premium 100% Cotton Fabric.\r\n\r\nCustom '),
(112, 17, 'Dark Olive Chinos', 10, 'blue', 60, 'images/trouser/trouser/b4.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(113, 17, 'Casual', 0, 'blue', 60, 'images/trouser/trouser/b5.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(114, 18, 'Stretch Summer Weight Black Chino Suit', 10, 'blue', 660, 'images/coat/coat/b1.jpg', 'Polish up your workweek attire with the timeless Stretch Summer Weight Black Chino suit.'),
(115, 18, 'Marc Stretch Cotton Navy Suit', 5, 'blue', 730, 'images/coat/coat/b2.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(116, 18, 'Edward Stretch Cotton Khaki Suit', 6, 'blue', 790, 'images/coat/coat/b3.jpg', 'Versatile and extremely stylish, our Edward Stretch Cotton Khaki suit is an ideal staple for those who prefer comfort.'),
(117, 18, 'Marc Stretch Cotton Navy Suit', 9, 'blue', 800, 'images/coat/coat/b4.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(118, 18, 'Marc Stretch Cotton Navy Suit', 11, 'black', 500, 'images/coat/coat/b5.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(139, 1, 'Lt Wt Autumn Beige Tweed Shirt ', 11, 'Black', 55, 'images/tshirt/b11.jpg', 'Add contemporary style to your collection of shirts with the Beige tweed shirt which has been woven from light weight tweed. Pair it with black chinos and a black wool overcoat for a sophisticated evening look. '),
(140, 1, 'Lt Wt Southrail Gray Tweed Shirt', 11, 'Black', 40, 'images/tshirt/b12.jpg', 'Crisp All Natural Fabric Linen, Natural Fabrics are always better than Man-Made Polyester fabrics, they are more comfortable and adapt to the body shape very well. '),
(141, 1, 'Roman Light Pink Linen Shirt', 11, 'Black', 40, 'images/tshirt/b13.jpg', 'Crisp All Natural Fabric Linen, Natural Fabrics are always better than Man-Made Polyester fabrics, they are more comfortable and adapt to the body shape very well. '),
(142, 1, 'Roman Summer Pink Linen Shirt', 11, 'Black', 40, 'images/tshirt/b14.jpg', 'Crisp All Natural Fabric Linen, Natural Fabrics are always better than Man-Made Polyester fabrics, they are more comfortable and adapt to the body shape very well. '),
(143, 1, 'Roman Checkino Linen Shirt', 9, 'Black', 40, 'images/tshirt/b15.jpg', 'Crisp All Natural Fabric Linen, Natural Fabrics are always better than Man-Made Polyester fabrics, they are more comfortable and adapt to the body shape very well. '),
(149, 17, 'Tides-Womenwar', 86, 'Black', 60, 'images/trouser/trouser/b6.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(150, 17, 'Tides-Womenwar', 91, 'Black', 60, 'images/trouser/trouser/b7.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(151, 17, 'Tides-Womenwar', 91, 'Black', 60, 'images/trouser/trouser/b8.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(152, 17, 'Forest Brown Chinos', 3, 'Black', 60, 'images/trouser/trouser/b9.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(153, 17, 'Heavy Gray Chinos', 11, 'Black', 60, 'images/trouser/trouser/b10.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(154, 17, 'Heavy Navy Chinos', 1, 'Black', 60, 'images/trouser/trouser/b11.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(155, 17, 'Heavy Navy Chinos', 4, 'Black', 150, 'images/trouser/trouser/b12.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(156, 17, 'Twillino British', 60, 'Black', 60, 'images/trouser/trouser/b13.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(157, 17, 'Summer Weight', 50, 'Black', 60, 'images/trouser/trouser/b14.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(158, 17, 'Tides-Womenwar', 91, 'Black', 60, 'images/trouser/trouser/b15.jpg', 'Our versatile chinos are ideal for channeling relaxed style on off-duty days.   A trusty pair of olive trousers are an enduring style classic, and a must for the most stylish of men.'),
(239, 18, 'Marc Stretch Cotton Navy Suit', 0, 'Black', 480, 'images/coat/coat/b6.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(240, 18, 'Marc Stretch Cotton Navy Suit', 1, 'Black', 160, 'images/coat/coat/b7.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(241, 18, 'Marc Stretch Cotton Navy Suit', 1, 'Black', 400, 'images/coat/coat/b8.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(242, 18, 'Marc Stretch Cotton Navy Suit', 1, 'Black', 160, 'images/coat/coat/b9.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(243, 18, 'Edward Stretch Cotton Blue Suit', 1, 'Black', 160, 'images/coat/coat/b10.jpg', 'Versatile and extremely stylish, our Edward Stretch Cotton Khaki suit is an ideal staple for those who prefer comfort.'),
(244, 18, 'Marc Stretch Cotton Gray Suit', 5, 'Black', 160, 'images/coat/coat/b11.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(245, 18, 'Marc Stretch Cotton Navy Suit', 5, 'Black', 160, 'images/coat/coat/b12.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(246, 18, 'Marc Stretch Cotton Navy Suit', 5, 'Black', 160, 'images/coat/coat/b13.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.'),
(247, 18, 'Tuxedo Jacket', 5, 'Black', 160, 'images/coat/coat/b14.jpg', 'Custom Made Nehru Style Jackets, exclusively hand tailored by our most excellent craftsmen.  Choose from Wool, Linen, Terry Rayon and Corduroys, we can make this jacket for you using any fabric listed below on this product page.'),
(248, 18, 'Marc Stretch Cotton Navy Suit', 5, 'Black', 260, 'images/coat/coat/b15.jpg', 'Classic and versatile, this Marc Stretch Cotton Navy suit is an eye-catching way to incorporate pattern into your wardrobe.');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `id` int(11) NOT NULL,
  `main_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `main_category`) VALUES
(1, 'UK Shirt'),
(2, 'UK Trouser'),
(3, 'XXL XL M S xS '),
(6, 'UK Suits');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) UNSIGNED DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `bill` double DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `customer_address`, `quantity`, `color`, `size`, `price`, `bill`, `date`) VALUES
(36, 'Yoga', 'hheider.jeffer@gmail.com', 1, 'Blue', 'small', 20.9, 20.9, '2018-05-26'),
(37, 'Leather-jacket Skinny', 'hheider.jeffer@gmail.com', 1, 'Blue', 'small', 12, 12, '2018-05-26'),
(38, 'Leather-Jacket skinny', 'hheider@gmail.com', 1, 'Blue', 'small', 12, 12, '2018-05-26'),
(39, 'Rocker', 'hheider.jeffer@gmail.com', 1, 'Blue', 'small', 29, 29, '2018-05-26'),
(40, 'Yoga', 'AhlamJeffer@gmail.com', 1, 'Blue', 'small', 12, 12, '2018-05-26'),
(41, 'blouson sleeved knitwear', 'AhlamJeffer@gmail.com', 1, 'Blue', 'small', 30, 30, '2018-05-26'),
(42, 'blouson sleeved knitwear', 'AhlamJeffer@gmail.com', 1, 'Blue', 'small', 50, 50, '2018-05-26'),
(43, 'Casual-Trouser', 'AhlamJeffer@gmail.com', 1, 'Blue', 'Xtra large', 19, 19, '2018-05-27'),
(44, 'Leather-Jacket Red', 'obama@white.com', 1, 'Blue', 'small', 12, 12, '2018-05-27'),
(45, 'Gumslip', 'obama@white.com', 6, 'Blue', 'small', 30, 180, '2018-05-27'),
(46, 'Gumslip', 'obama@white.com', 6, 'Blue', 'small', 30, 180, '2018-05-27'),
(47, 'Gumslip', 'obama@white.com', 6, 'Blue', 'small', 30, 180, '2018-05-27'),
(48, 'Gumslip', 'obama@white.com', 6, 'Blue', 'small', 30, 180, '2018-05-27'),
(49, 'Gumslip', 'obama@white.com', 6, 'Blue', 'small', 30, 180, '2018-05-27'),
(50, 'Gumslip', 'obama@white.com', 6, 'Blue', 'small', 30, 180, '2018-05-27'),
(51, 'Cropped', 'obama@white.com', 11, 'Blue', 'small', 30, 330, '2018-05-27'),
(52, 'Yoga', 'amir@unibz.it', 1, 'Blue', 'small', 12, 12, '2018-05-27'),
(53, 'Leather-Jacket skinny', 'amir@unibz.it', 1, 'Blue', 'small', 12, 12, '2018-05-27'),
(54, 'Leather-Jacket Red', 'hheider.jeffer@gmail.com', 1, 'Blue', 'small', 12, 12, '2018-05-27'),
(55, 'Yoga', 'hheider.jeffer@gmail.com', 1, 'Blue', 'small', 12, 12, '2018-05-27'),
(56, 'Yoga', 'kolen@kolen.com', 1, 'Blue', 'small', 20.9, 20.9, '2018-05-27'),
(57, 'Rocker', 'amir@unibz.it', 1, 'Blue', 'small', 30, 30, '2018-05-27'),
(58, 'Yoga', 'amir@unibz.it', 1, 'Blue', 'small', 20.9, 20.9, '2018-05-27'),
(59, 'Rocker', 'amir@unibz.it', 1, 'Blue', 'medium', 30, 30, '2018-05-27'),
(60, 'Marc Stretch Cotton Navy Suit', 'ggg@gmail.com', 2, 'Blue', 'small', 730, 1460, '2018-05-28'),
(61, 'Pure Ocean Green Linen Shirt', 'ggg@gmail.com', 1, 'Blue', 'small', 70, 70, '2018-05-28'),
(62, 'Pure Ocean Green Linen Shirt', 'ggg@gmail.com', 1, 'Blue', 'small', 70, 70, '2018-05-28'),
(63, 'Marc Stretch Cotton Navy Suit', 'ggg@gmail.com', 1, 'Blue', 'small', 730, 730, '2018-05-28'),
(64, 'Marc Stretch Cotton Navy Suit', 'morad.fahmy@gmail.com', 1, 'Blue', 'small', 730, 730, '2018-05-28'),
(65, 'Pure Ocean Green Linen Shirt', 'hheider.jeffer@gmail.com', 1, 'Blue', 'small', 70, 70, '2018-05-28'),
(66, 'Pure Aqua Blue Linen Shirt', 'ali.jeffer@gmail.com', 1, 'Black', 'medium', 56, 56, '2018-05-28'),
(67, 'Pure Beige Linen Shirt', 'ali.jeffer@gmail.com', 1, 'Blue', 'small', 40, 40, '2018-05-28'),
(68, 'European Khaki Chinos', 'mariamabas@gmail.com', 1, 'Blue', 'small', 190, 190, '2018-05-28'),
(69, 'Pure Ocean Green Linen Shirt', 'mariamabas@gmail.com', 1, 'Blue', 'small', 70, 70, '2018-05-28'),
(70, 'Pure Ocean Green Linen Shirt', 'mariamabas@gmail.com', 1, 'Blue', 'small', 70, 70, '2018-05-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `main_categories` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
