-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2018 at 05:21 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pondok_daun`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingtable`
--

CREATE TABLE `bookingtable` (
  `bookingID` int(10) NOT NULL,
  `no_of_ppl` int(10) NOT NULL,
  `bookingTimeandDate` datetime DEFAULT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookingtable`
--

INSERT INTO `bookingtable` (`bookingID`, `no_of_ppl`, `bookingTimeandDate`, `name`) VALUES
(1, 3, '2018-09-06 02:00:00', 'Mr. Anmol'),
(2, 2, '2018-09-06 02:00:00', 'Mr. Jagga');

-- --------------------------------------------------------

--
-- Table structure for table `catering`
--

CREATE TABLE `catering` (
  `cateringID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `TimeandDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catering`
--

INSERT INTO `catering` (`cateringID`, `name`, `description`, `TimeandDate`) VALUES
(1, 'Mr. Anmol', 'jbvmvhjklkklh', '2018-09-01 01:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE `description` (
  `topdescription` varchar(150) NOT NULL,
  `bottomdescription` varchar(150) NOT NULL,
  `address` varchar(50) NOT NULL,
  `openingHours` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drink_items`
--

CREATE TABLE `drink_items` (
  `id` int(11) DEFAULT NULL,
  `drink_id` int(11) NOT NULL,
  `drink_name` varchar(100) DEFAULT NULL,
  `drink_price` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drink_items`
--

INSERT INTO `drink_items` (`id`, `drink_id`, `drink_name`, `drink_price`) VALUES
(10, 80, 'Young Coconut Ice', 4.50),
(10, 81, 'Hot Ginger drink', 3.50),
(10, 82, 'Happy soda', 4.50),
(10, 83, 'Tamarind drink', 4.50 ),
(10, 84, 'Milo Dinosaur(w/Milo powder on top)', 5.50),
(10, 85, 'Milo Godzilla(w/Milo powder on top)', 6.50),
(10, 86, 'Milo (Hot/Cold)', 4.50),
(11, 87, 'Jasmine (Hot)', 3.00),
(11, 88, 'Green (Hot)', 3.00),
(11, 89, 'Sweet Iced Tea', 3.50),
(11, 90, 'Lemon Iced Tea', 3.50),
(11, 91, 'Hot Teh Tarik', 4.00),
(11, 92, 'Iced Teh Tarik', 4.00),
(12, 93, 'Traditional White Coffee', 3.50),
(12, 94, 'Iced White Coffee', 3.50),
(13, 95, 'Avocado Smoothie', 6.00),
(13, 96, 'Soursop Smoothie', 5.00),
(13, 97, 'Durian Smoothie', 6.00),
(13, 98, 'Passion Fruit Juice', 4.00),
(13, 99, 'Fresh Orange Juice', 4.00),
(14, 100, 'Mineral Water', 2.50),
(14, 101, 'Can Soft Drink', 2.50),
(14, 102, 'Lipton Ice Tea', 3.50),
(14, 103, 'Sparkling Water', 3.00),
(14, 104, 'Lemon Lime Water', 3.50),
(14, 105, 'Bottled Juice', 3.50),
(14, 106, 'Aloe Vera', 3.50),
(14, 107, 'Ginger Beer', 3.50),
(14, 108, 'Teh Kotak', 2.00),
(14, 109, 'Sarsaparilla', 3.50);


-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guestID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(300) NOT NULL,
  `contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `name`, `address`, `email`, `password`, `contact`) VALUES
(1, 'Anmol', '62 Bray St, Plympton Park', 'anmol@mail.com', '$2y$07$CvFrtPvHZ5pMA5e4rxUzY.7CfwB/hDEJHOjbljQdF4pL4kO6K8bKG', '0449180197'),
(2, 'admin', 'Pondok Daun', 'admin@mail.com', '$2y$07$erWOlh6CzXiG8P4Z0ZmeV.PRVLJQlRCH31kF5H5.ygOxbC0AWoDzW', '9876543210');

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `category_name`) VALUES
(1, 'Sides & Snacks'),
(2, 'Traditional Soup'),
(3, 'Indonesian Curry'),
(4, 'Traditional Fried'),
(5, 'Coconut Rice'),
(6, 'Fried Rice'),
(7, 'Fried Rice & Noodle'),
(8, 'Vegetable'),
(9, 'Deserts'),
(10, 'Beverages-HomeMade Drinks'),
(11, 'Tea'),
(12, 'Coffee'),
(13, 'Juice & Smoothies'),
(14, 'Bottled Drink');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_price` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `item_id`, `item_name`, `item_price`) VALUES
(1, 1, 'Fried Chicken Spring Rolls (3)', 5.50),
(1, 2, 'Fried Wonton (5)', 5.50 ),
(1, 3, 'Fried Vegetarian Spring Rolls (3)', 5.50),
(1, 4, 'Steamed Wonton (5)', 5.50 ),
(1, 5, 'Chicken Satay (3)', 6.00 ),
(1, 6, 'Potato Croquette (2)', 5.50),
(1, 7, 'Five Spice Roll (Loh Bak)', 5.50),
(1, 8, 'Crackers', 2.00 ),
(1, 9, 'Chilli Sauce', 1.00 ),
(1, 10, 'Peanut Sauce', 1.00),
(1, 11, 'Fried Fish Dumpling with Tofu', 8.00),
(1, 12, 'Indonesian Dim Sum', 8.00),
(1, 13, 'Traditional Fried Fish Cake', 8.00),
(1, 14, 'Spicy Fried Tofu', 5.50),
(1, 15, 'Fried Cassava', 5.50),
(1, 16, 'Fried Tempeh with Tofu', 6.00),
(2, 17, 'Oxtail Soup With Rice', 13.80),
(2, 18, 'Beef Ribs Soup With Rice', 12.80),
(2, 19, 'Traditional Chicken Soup With Rice', 11.80),
(2, 20, 'Wonton Noodle Soup', 11.80),
(2, 21, 'Beef Balls Noodle Soup', 11.80),
(2, 22, 'Chicken Dry Noodle', 11.80),
(3, 23, 'Chicken Curry With Rice', 11.80),
(3, 24, 'Lamb Curry With Rice', 13.80),
(3, 25, 'Beef Rendang With Rice', 13.80),
(3, 26, 'Slow-cooked Chicken in Coconut Milk With Rice', 11.80),
(4, 27, 'Grilled Beef Ribs With Rice and Soup', 13.80),
(4, 28, 'Grilled Chicken With Rice and Soup', 11.80),
(4, 29, 'Chicken Satay (6) served with rice cake', 11.80),
(5, 30, 'Fried Chicken with Balacan Sauce', 10.80),
(5, 31, 'Fried Chicken in Balado Sauce', 11.80),
(5, 32, 'Smashed Chicken in Penyet Sauce', 11.80),
(5, 33, 'Crispy Duck', 13.80),
(5, 34, 'Fried Whole Catfish with Balado Sauce', 11.80),
(5, 35, 'Fried Tilapia in Balado Sauce', 15.80),
(6, 36, 'Fried Chicken', 12.80),
(6, 37, 'Slow-cooked Sweet Beef', 13.80),
(6, 38, 'Fried Whole Tilapia Fish', 16.80),
(6, 39, 'Salted Fish', 10.80),
(6, 40, 'Hainanese Chicken Rice', 11.80),
(7, 41, 'chicken', 11.80),
(7, 42, 'Seafood', 13.80),
(7, 43, 'Beef', 13.80),
(7, 44, 'Lamb', 13.80),
(7, 45, 'Belacan(Terasi)', 11.80),
(7, 46, 'Anchovy', 11.80),
(7, 47, 'Sator Bean "Petai"', 12.80),
(7, 48, 'Vegetarian', 10.80),
(7, 49, 'Chicken', 11.80),
(7, 50, 'Seafood', 13.80),
(7, 51, 'Beef', 13.80),
(7, 52, 'Lamb', 13.80),
(7, 53, 'Belacan(Terasi)', 11.80),
(7, 54, 'Vegetarian', 10.80),
(7, 55, 'Chicken', 11.80),
(7, 56, 'Seafood', 13.80),
(7, 57, 'Beef', 13.80),
(7, 58, 'Lamb', 13.80),
(7, 59, 'Belacan(Terasi)', 11.80),
(7, 60, 'Vegetarian', 10.80),
(7, 61, 'Chicken', 11.80),
(7, 62, 'Seafood', 13.80),
(7, 63, 'Beef', 13.80),
(7, 64, 'Lamb', 13.80),
(7, 65, 'Belacan(Terasi)', 11.80),
(7, 66, 'Vegetarian', 10.80),
(7, 67, 'Chicken', 12.80),
(7, 68, 'Beef', 14.80),
(7, 69, 'Seafood', 14.80),
(8, 70, 'Steamed Mix vegetables served in peanut sauce with rice cake', 10.80),
(8, 71, 'Stir Fried Water Spinach with garlic/balacan with rice', 10.80),
(8, 72, 'Stir Fried Chinesse Brocolli with rice', 10.80),
(8, 73, 'Stir Fried Mix Vegetables with Vegetarian with rice', 10.80),
(8, 74, 'Stir Fried Mix Vegetables with Chicken with rice', 11.80),
(8, 75, 'Stir Fried Mix Vegetables with Seafood with rice', 12.80),
(9, 76, 'Combination Ice', 6.00),
(9, 77, 'Drunken Ice', 6.00),
(9, 78, 'Jackfruit Ice', 6.00),
(9, 79, 'Durian Ice', 7.00);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderID` int(10) NOT NULL,
  `customerID` int(10) NOT NULL,
  `orderDetails` varchar(5000) NOT NULL,
  `orderType` varchar(50) NOT NULL,
  `orderTotal` double(6,2) DEFAULT NULL,
  `cartID` int(10) NOT NULL,
  `orderDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resturant`
--

CREATE TABLE `resturant` (
  `resturantID` int(10) NOT NULL,
  `menuID` int(10) NOT NULL,
  `bookingID` int(10) NOT NULL,
  `orderID` int(10) NOT NULL,
  `cateringID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `cartID` int(10) NOT NULL,
  `catID` int(10) NOT NULL,
  `itemID` int(10) NOT NULL,
  `qnty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookingtable`
--
ALTER TABLE `bookingtable`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `catering`
--
ALTER TABLE `catering`
  ADD PRIMARY KEY (`cateringID`);

--
-- Indexes for table `drink_items`
--
ALTER TABLE `drink_items`
  ADD PRIMARY KEY (`drink_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guestID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `cartID` (`cartID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `resturant`
--
ALTER TABLE `resturant`
  ADD PRIMARY KEY (`resturantID`),
  ADD KEY `bookingID` (`bookingID`),
  ADD KEY `cateringID` (`cateringID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `menuID` (`menuID`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`cartID`,`itemID`,`qnty`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookingtable`
--
ALTER TABLE `bookingtable`
  MODIFY `bookingID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `catering`
--
ALTER TABLE `catering`
  MODIFY `cateringID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drink_items`
--
ALTER TABLE `drink_items`
  MODIFY `drink_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guestID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `cartID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drink_items`
--
ALTER TABLE `drink_items`
  ADD CONSTRAINT `drink_items_ibfk_1` FOREIGN KEY (`id`) REFERENCES `menu_categories` (`id`);

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`id`) REFERENCES `menu_categories` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `shoppingcart` (`cartID`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `member` (`memberID`);

--
-- Constraints for table `resturant`
--
ALTER TABLE `resturant`
  ADD CONSTRAINT `resturant_ibfk_1` FOREIGN KEY (`bookingID`) REFERENCES `bookingtable` (`bookingID`),
  ADD CONSTRAINT `resturant_ibfk_2` FOREIGN KEY (`cateringID`) REFERENCES `catering` (`cateringID`),
  ADD CONSTRAINT `resturant_ibfk_3` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`),
  ADD CONSTRAINT `resturant_ibfk_4` FOREIGN KEY (`menuID`) REFERENCES `menu_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
