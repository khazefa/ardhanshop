-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 18, 2018 at 09:15 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ardhanshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_acc`
--

CREATE TABLE `bank_acc` (
  `bank_acc_id` int(3) NOT NULL,
  `bank_acc_no` varchar(100) NOT NULL,
  `bank_acc_name` varchar(100) NOT NULL,
  `bank_acc_bank` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_acc`
--

INSERT INTO `bank_acc` (`bank_acc_id`, `bank_acc_no`, `bank_acc_name`, `bank_acc_bank`) VALUES
(1, '1561306617', 'Merchant A', 'BCA'),
(2, '1560009861578', 'Merchant A', 'Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_uniqid` varchar(6) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(30) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_city` varchar(50) NOT NULL,
  `customer_postcode` varchar(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_uniqid`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `customer_city`, `customer_postcode`) VALUES
(1, 'JH67TG', 'John Doe', 'johndoe@gmail.com', '081298987656', 'Jl. Taman Margasatwa No. 12, Warung Buncit', 'Jakarta Selatan', '12540');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_uniqid` varchar(7) NOT NULL,
  `order_date` date NOT NULL,
  `order_qty` int(5) NOT NULL,
  `order_subtotal` int(11) NOT NULL,
  `customer_uniqid` varchar(6) NOT NULL,
  `order_status` varchar(10) NOT NULL COMMENT 'invoiced | paid | sent | complete | cancel',
  `destination` varchar(100) NOT NULL,
  `shipping_id` int(5) NOT NULL,
  `order_notes` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_uniqid`, `order_date`, `order_qty`, `order_subtotal`, `customer_uniqid`, `order_status`, `destination`, `shipping_id`, `order_notes`) VALUES
(1, 'IV78JHG', '2018-04-20', 2, 207000, 'JH67TG', 'invoiced', 'Jl Gohok No 11, Cikini', 2, 'Test order 1');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `order_uniqid` varchar(7) NOT NULL,
  `product_uniqid` varchar(25) NOT NULL,
  `qty` int(3) NOT NULL,
  `discount` int(2) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`order_uniqid`, `product_uniqid`, `qty`, `discount`, `subtotal`) VALUES
('IV78JHG', 'YQBDR8TJME', 1, 10, 72000),
('IV78JHG', 'NMZ58M9LCC', 1, 10, 135000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(5) NOT NULL,
  `order_uniqid` varchar(7) NOT NULL,
  `customer_uniqid` varchar(6) NOT NULL,
  `bank_acc_id` int(3) NOT NULL,
  `payment_account` varchar(50) NOT NULL,
  `payment_name` varchar(100) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_bank` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `payment_attach` varchar(100) NOT NULL,
  `payment_status` varchar(10) NOT NULL COMMENT 'pending | verified'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_uniqid`, `customer_uniqid`, `bank_acc_id`, `payment_account`, `payment_name`, `payment_date`, `payment_bank`, `created_date`, `payment_attach`, `payment_status`) VALUES
(1, 'IV78JHG', 'JH67TG', 1, '2373018881', 'John Doe', '2018-04-20', 'BCA', '2018-04-21', '', 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_uniqid` varchar(25) NOT NULL,
  `category_id` int(3) NOT NULL,
  `brand_id` int(3) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` double NOT NULL,
  `product_stock` int(5) NOT NULL,
  `product_weight` decimal(5,2) NOT NULL,
  `product_disc` int(3) NOT NULL,
  `product_pict` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_uniqid`, `category_id`, `brand_id`, `product_name`, `product_desc`, `product_price`, `product_stock`, `product_weight`, `product_disc`, `product_pict`) VALUES
(1, 'YQBDR8TJME', 1, 1, 'Kaos Distro 1', 'Bahan catton 24s\r\nKelebihanya :\r\n- bahan mudah menyerap keringat.\r\n- Bahan tebal & sisi jahitan samping + bawah sangat rapih. sehingga tidak bikin badan anda gatal\r\n- Bahan Agak kasar dibanding 30s tapi tidak bikin anda gerah\r\n- Bahan catton 24s Akan lebih lembut & adem sesudah di cuci, walau 1/6Tahun pakai\r\n- Jahitan Kerah yang begitu Rapih & Tidak mudah Melar walau di cuci sudah berulang kalinya\r\n- Size yang kami gunakan asli size produk indonesia (Lokal)http://google.com/', 80000, 100, '1.00', 10, '877550kaos_distro_1.jpg'),
(3, 'NMZ58M9LCC', 2, 2, 'Celana Distro 1', 'Bahan catton 24sKelebihanya :- bahan mudah menyerap keringat.- Bahan tebal &amp;amp; sisi jahitan samping + bawah sangat rapih. sehingga tidak bikin badan anda gatal- Bahan Agak kasar dibanding 30s tapi tidak bikin anda gerah- Bahan catton 24s Akan lebih lembut &amp;amp; adem sesudah di cuci, walau 1/6Tahun pakai- Jahitan Kerah yang begitu Rapih &amp;amp; Tidak mudah Melar walau di cuci sudah berulang kalinya- Size yang kami gunakan asli size produk indonesia (Lokal)', 150000, 100, '1.00', 10, '843761celana_distro_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_brand`
--

CREATE TABLE `products_brand` (
  `brand_id` int(3) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_brand`
--

INSERT INTO `products_brand` (`brand_id`, `brand_name`) VALUES
(1, 'Pull & Bear'),
(2, 'Salt n Pepper'),
(3, 'Blackid');

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

CREATE TABLE `products_category` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`category_id`, `category_name`) VALUES
(1, 'Baju'),
(2, 'Celana'),
(3, 'Jaket');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(5) NOT NULL,
  `shipping_courier` varchar(50) NOT NULL,
  `shipping_dest` varchar(100) NOT NULL,
  `shipping_cost` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `shipping_courier`, `shipping_dest`, `shipping_cost`) VALUES
(1, 'JNE Reguler', 'Jakarta', 9000),
(2, 'JNE Reguler', 'Jakarta Pusat', 9000),
(3, 'JNE Reguler', 'Jakarta Timur', 9000),
(4, 'JNE Reguler', 'Jakarta Barat', 9000),
(5, 'JNE Reguler', 'Jakarta Selatan', 9000),
(6, 'JNE Reguler', 'Jakarta Utara', 9000),
(7, 'JNE Yes', 'Jakarta', 18000),
(8, 'JNE Yes', 'Jakarta Pusat', 18000),
(9, 'JNE Yes', 'Jakarta Timur', 18000),
(10, 'JNE Yes', 'Jakarta Selatan', 18000),
(11, 'JNE Yes', 'Jakarta Utara', 18000),
(12, 'JNE Yes', 'Jakarta Barat', 18000);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_orders`
--

CREATE TABLE `tmp_orders` (
  `cart_id` int(11) NOT NULL,
  `product_uniqid` varchar(25) NOT NULL,
  `cart_uniqid` varchar(100) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `cart_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_keyname` varchar(50) NOT NULL,
  `user_keypass` varchar(64) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `level_id` int(5) NOT NULL,
  `user_status` int(2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_keyname`, `user_keypass`, `user_fullname`, `user_email`, `level_id`, `user_status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@domain.com', 1, 1),
(2, 'johndoe', 'johndoe', 'John Doe', 'johndoe@gmail.com', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_level`
--

CREATE TABLE `users_level` (
  `level_id` int(2) NOT NULL,
  `level_name` varchar(15) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_level`
--

INSERT INTO `users_level` (`level_id`, `level_name`) VALUES
(1, 'caretaker'),
(2, 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_acc`
--
ALTER TABLE `bank_acc`
  ADD PRIMARY KEY (`bank_acc_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `member_uniqid` (`customer_uniqid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_uniqid` (`order_uniqid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_uniqid` (`product_uniqid`);

--
-- Indexes for table `products_brand`
--
ALTER TABLE `products_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `products_category`
--
ALTER TABLE `products_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `tmp_orders`
--
ALTER TABLE `tmp_orders`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_level`
--
ALTER TABLE `users_level`
  ADD PRIMARY KEY (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_acc`
--
ALTER TABLE `bank_acc`
  MODIFY `bank_acc_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products_brand`
--
ALTER TABLE `products_brand`
  MODIFY `brand_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tmp_orders`
--
ALTER TABLE `tmp_orders`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_level`
--
ALTER TABLE `users_level`
  MODIFY `level_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
