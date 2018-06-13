-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2018 at 01:50 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_acc`
--

INSERT INTO `bank_acc` (`bank_acc_id`, `bank_acc_no`, `bank_acc_name`, `bank_acc_bank`) VALUES
(1, '1561306617', 'Merchant A', 'BCA'),
(2, '1560009861578', 'Merchant A', 'Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_title` varchar(100) NOT NULL,
  `banner_desc` text NOT NULL,
  `banner_pict` varchar(100) NOT NULL,
  `banner_position` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_title`, `banner_desc`, `banner_pict`, `banner_position`) VALUES
(1, 'Banner 1', '<p>Banner 1<br></p>', '912813banner_1.jpg', 'top'),
(2, 'Banner 2', '<p>Banner 2<br></p>', '800920banner_2.jpg', 'top'),
(3, 'Banner 3', '<p>Banner 3<br></p>', '108344banner_3.jpg', 'top');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_uniqid`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `customer_city`, `customer_postcode`) VALUES
(1, 'JH67TG', 'John Doe', 'johndoe@gmail.com', '081298987656', 'Jl. Taman Margasatwa No. 12, Warung Buncit', 'Jakarta Selatan', '12540'),
(3, 'EOEZRC', 'Joko Sukoco', 'joko@gmail.com', '081290908989', 'Jl Mangga No. 12 Rawamangun', 'Jakart Timur', '13220'),
(4, 'WST7L1', 'Joni', 'joni@gmail.com', '081389892626', 'Jl Dukuh No 4', 'Jakarta Selatan', '12940');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_uniqid`, `category_id`, `brand_id`, `product_name`, `product_desc`, `product_price`, `product_stock`, `product_weight`, `product_disc`, `product_pict`) VALUES
(1, 'YQBDR8TJME', 1, 2, 'Swallow 350-17 S208', '<p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\">Desain alur simetris dan searah yang unik yang diciptakan untuk memberikan Motor Anda performa terbaik dengan tampilan yang menarik</p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Fitur:</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Telapak searah yang menyerupai anak panah</li></ol><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Keunggulan :</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Kuat mencengkram dan stabil saat belok</li></ol>', 275000, 100, '4.00', 0, '642741ASPIRA MAXIO.jpg'),
(3, 'NMZ58M9LCC', 2, 3, 'IRC 120/80-10 MB520 Tubeless', '<p style=\"color: rgb(102, 102, 102); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\">Desain alur simetris dan searah yang unik yang diciptakan untuk memberikan Motor Anda performa terbaik dengan tampilan yang menarik</p><p style=\"color: rgb(102, 102, 102); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\"><span style=\"font-weight: 700;\">Fitur:</span><br></p><ol style=\"color: rgb(102, 102, 102); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\"><li>Telapak searah yang menyerupai anak panah</li></ol><p style=\"color: rgb(102, 102, 102); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\"><span style=\"font-weight: 700;\">Keunggulan :</span><br></p><ol style=\"color: rgb(102, 102, 102); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\"><li>Kuat mencengkram dan stabil saat belok</li></ol>', 240000, 100, '4.00', 25, '607233MB520-228x228.png'),
(4, 'LP3CZAA6GK', 3, 1, 'Zeneos 120/70-10 Milano ZN87', '<p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\">Desain alur simetris dan searah yang unik yang diciptakan untuk memberikan Motor Anda performa terbaik dengan tampilan yang menarik</p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Fitur:</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Telapak searah yang menyerupai anak panah</li></ol><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Keunggulan :</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Kuat mencengkram dan stabil saat belok</li></ol>', 240000, 100, '4.00', 25, '564535MILANO ZN87-228x228.png'),
(5, 'YT02SXKV0W', 3, 1, 'Zeneos 110/70-11 Milano ZN87', '<p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\">Desain alur simetris dan searah yang unik yang diciptakan untuk memberikan Motor Anda performa terbaik dengan tampilan yang menarik</p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Fitur:</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Telapak searah yang menyerupai anak panah</li></ol><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Keunggulan :</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Kuat mencengkram dan stabil saat belok</li></ol>', 250000, 100, '4.00', 25, '469674MILANO ZN87-228x228.png'),
(6, 'EJ1PTQV60C', 3, 1, 'Zeneos 120/70-13 Milano ZN87', '<p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\">Desain alur simetris dan searah yang unik yang diciptakan untuk memberikan Motor Anda performa terbaik dengan tampilan yang menarik</p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Fitur:</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Telapak searah yang menyerupai anak panah</li></ol><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Keunggulan :</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Kuat mencengkram dan stabil saat belok</li></ol>', 325000, 100, '4.00', 25, '408175MILANO ZN87-228x228.png'),
(7, '4L0ROJFG55', 2, 2, 'Swallow 110/90-13 S124F', '<p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\">Desain alur simetris dan searah yang unik yang diciptakan untuk memberikan Motor Anda performa terbaik dengan tampilan yang menarik</p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Fitur:</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Telapak searah yang menyerupai anak panah</li></ol><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><span style=\"font-weight: 700;\">Keunggulan :</span><br></p><ol open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 12px;\"=\"\" style=\"color: rgb(102, 102, 102);\"><li>Kuat mencengkram dan stabil saat belok</li></ol>', 287000, 100, '4.00', 0, '796159SB-124F-250x300-228x228.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_brand`
--

CREATE TABLE `products_brand` (
  `brand_id` int(3) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_brand`
--

INSERT INTO `products_brand` (`brand_id`, `brand_name`) VALUES
(1, 'Zeneos'),
(2, 'Swallow'),
(3, 'IRC'),
(4, 'Pirelli');

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

CREATE TABLE `products_category` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`category_id`, `category_name`) VALUES
(1, 'Moped'),
(2, 'Matic'),
(3, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(5) NOT NULL,
  `shipping_courier` varchar(50) NOT NULL,
  `shipping_dest` varchar(100) NOT NULL,
  `shipping_cost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `site_pages`
--

CREATE TABLE `site_pages` (
  `pg_id` int(11) NOT NULL,
  `pg_title` varchar(100) NOT NULL,
  `pg_slug` varchar(250) NOT NULL,
  `pg_content` text NOT NULL,
  `pg_publish` enum('Y','N') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_pages`
--

INSERT INTO `site_pages` (`pg_id`, `pg_title`, `pg_slug`, `pg_content`, `pg_publish`) VALUES
(1, 'tentang kami', 'tentang-kami', '<span style=\"font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 16px; text-indent: 20px;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Praesent vitae arcu tempor neque lacinia pretium. Etiam neque. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Etiam commodo dui eget wisi. Pellentesque ipsum. Mauris tincidunt sem sed arcu. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Fusce aliquam vestibulum ipsum. Nulla quis diam. Duis risus.</span>', 'Y'),
(2, 'Cara Pembayaran', 'cara-pembayaran', '<p style=\"margin-bottom: 8px; text-indent: 20px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, &quot;Geneva CE&quot;, lucida, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(252, 249, 232);\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Praesent vitae arcu tempor neque lacinia pretium. Etiam neque. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Etiam commodo dui eget wisi. Pellentesque ipsum. Mauris tincidunt sem sed arcu. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Fusce aliquam vestibulum ipsum. Nulla quis diam. Duis risus.</p><p style=\"margin-bottom: 8px; text-indent: 20px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, &quot;Geneva CE&quot;, lucida, sans-serif; font-size: 13px; text-align: justify; background-color: rgb(252, 249, 232);\">Aenean placerat. Integer vulputate sem a nibh rutrum consequat. Phasellus et lorem id felis nonummy placerat. Mauris dictum facilisis augue. Integer tempor. Etiam quis quam. Duis condimentum augue id magna semper rutrum. Quisque tincidunt scelerisque libero. Nunc dapibus tortor vel mi dapibus sollicitudin. Fusce nibh. Curabitur bibendum justo non orci. Vestibulum erat nulla, ullamcorper nec, rutrum non, nonummy ac, erat.</p>', 'Y');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_keyname`, `user_keypass`, `user_fullname`, `user_email`, `level_id`, `user_status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@domain.com', 1, 1),
(2, 'johndoe', '6579e96f76baa00787a28653876c6127', 'John Doe', 'johndoe@gmail.com', 2, 1),
(25, 'joko@gmail.com', '9ba0009aa81e794e628a04b51eaf7d7f', 'Joko Sukoco', 'joko@gmail.com', 2, 1),
(26, 'joni@gmail.com', '1281d0ac7a74eb91550ff52a02862cda', 'Joni', 'joni@gmail.com', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_level`
--

CREATE TABLE `users_level` (
  `level_id` int(2) NOT NULL,
  `level_name` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

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
-- Indexes for table `site_pages`
--
ALTER TABLE `site_pages`
  ADD PRIMARY KEY (`pg_id`);

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
  MODIFY `bank_acc_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products_brand`
--
ALTER TABLE `products_brand`
  MODIFY `brand_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `site_pages`
--
ALTER TABLE `site_pages`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tmp_orders`
--
ALTER TABLE `tmp_orders`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users_level`
--
ALTER TABLE `users_level`
  MODIFY `level_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
