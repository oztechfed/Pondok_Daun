CREATE DATABASE `pondok_daun`;

USE `pondok_daun`;

CREATE TABLE `bookingtable`
(
	`bookingID` INT(10) NOT NULL AUTO_INCREMENT,
	`no_of_ppl` INT(10) NOT NULL,
	`bookingTimeandDate` DATETIME,
	`name` varchar(10) NOT NULL,
	PRIMARY KEY (`bookingID`)
);

CREATE TABLE `catering`
(
	`cateringID` INT(10) NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`description` varchar(150) NOT NULL,
	`TimeandDate` DATETIME,
	PRIMARY KEY (`cateringID`)
);

CREATE TABLE `description`
(
	`topdescription` varchar(150) NOT NULL,
	`bottomdescription` varchar(150) NOT NULL,
	`address` varchar(50) NOT NULL,
	`openingHours` INT(10) NOT NULL
);

CREATE TABLE `menu_categories`
(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`category_name` varchar(100) DEFAULT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `drink_items`
(
	`id` INT(11) DEFAULT NULL,
	`drink_id` INT(11) NOT NULL AUTO_INCREMENT,
	`drink_name` varchar(100) DEFAULT NULL,
	`drink_price` decimal(5,2) DEFAULT NULL,
	PRIMARY KEY (`drink_id`),
	FOREIGN KEY (`id`) REFERENCES `menu_categories` (`id`)
); 

CREATE TABLE `menu_items`
(
	`id` INT(11) DEFAULT NULL,
	`item_id` INT(11) NOT NULL AUTO_INCREMENT,
	`item_name` varchar(100) DEFAULT NULL,
	`item_price` decimal(5,2) DEFAULT NULL,
	PRIMARY KEY (`item_id`),
	FOREIGN KEY (`id`) REFERENCES `menu_categories` (`id`)
);

CREATE TABLE `shoppingcart`
(
	`cartID` INT(10) NOT NULL AUTO_INCREMENT,
	`catID` INT(10) NOT NULL,
	`itemID` INT(10) NOT NULL,
	`qnty` INT(100) NOT NULL,
	`orderType` varchar(100),
	CONSTRAINT `orderID` PRIMARY KEY (`cartID`, `itemID`, `qnty`)
);

CREATE TABLE `guest`
(
	`guestID` INT(10) NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`address` varchar(150) NOT NULL,
	PRIMARY KEY (`guestID`)
);

CREATE TABLE `member`
(
	`memberID` INT(10) NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`address` varchar(150) NOT NULL,
	`email` varchar(150) NOT NULL,
	`password` varchar(300) NOT NULL,
	`contact` varchar(50) NOT NULL,
	PRIMARY KEY (`memberID`)
);

CREATE TABLE `order`
(
	`orderID` INT(10) NOT NULL AUTO_INCREMENT,
	`customerID` INT(10) NOT NULL,
	`orderDetails` varchar(50) NOT NULL,
	`orderType` varchar(50) NOT NULL,
	`orderTotal` DOUBLE(6,2),
	`cartID` INT(10) NOT NULL,
	PRIMARY KEY (`orderID`),
	FOREIGN KEY (`cartID`) REFERENCES `shoppingcart` (`cartID`),
	FOREIGN KEY (`customerID`) REFERENCES `member` (`memberID`)
);

CREATE TABLE `resturant`
(
	`resturantID` INT(10) NOT NULL,
	`menuID` INT(10) NOT NULL,
	`bookingID` INT(10) NOT NULL,
	`orderID` INT(10) NOT NULL,
	`cateringID` INT NOT NULL,
	PRIMARY KEY (`resturantID`),
	FOREIGN KEY (`bookingID`) REFERENCES `bookingtable` (`bookingID`),
	FOREIGN KEY (`cateringID`) REFERENCES `catering` (`cateringID`),
	FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`),
	FOREIGN KEY (`menuID`) REFERENCES `menu_categories` (`id`)
);

INSERT INTO menu_categories VALUES
(1, 'Entree'),
(2, 'Sides & Snacks'),
(3, 'Traditional Soup'),
(4, 'Indonesian Curry'),
(5, 'Traditional Grilled Satay'),
(6, 'Traditional Fried'),
(7, 'Coconut Rice'),
(8, 'Fried Rice'),
(9, 'Fried Egg Noodle'),
(10, 'Fried Vermicelli Noodle'),
(11, 'Char Kway Teow'),
(12, 'Char Hor Fun'),
(13, 'Vegetables'),
(14, 'Deserts'),
(15, 'Home Made Drinks'),
(16, 'Tea'),
(17, 'Coffee'),
(18, 'Juice & Smoothies');

INSERT INTO menu_items VALUES
(1, 1, 'Fried Vegetarian Wonton', 5.50),
(1, 2, 'Jakarta Beef Soup', 11.80 ),
(1, 3, 'Hainanese Chicken Rice', 11.80),
(1, 4, 'Indonesian Laska with Chicken', 10.80 ),
(1, 5, 'Indonesian Laska with Seafood', 12.80 ),
(2, 6, 'Fried Chicken Spring Roll (3)', 5.50 ),
(2, 7, 'Fried Wonton (5)', 5.50),
(2, 8, 'Fried Vegetarian Spring Rolls (3)', 5.50),
(2, 9, 'Steamed Wonton', 5.50 ),
(2, 10, 'Chicken Satay', 6.00),
(2, 11, 'Potato Croquette (2)', 5.50),
(2, 12, 'Five Spice Roll (Loh Bak)', 5.50),
(2, 13, 'Fried Fish Dumpling with Tofu', 7.50),
(2, 14, 'Indonesian Dim Sum', 7.50),
(2, 15, 'Traditional Fried Fish Cake', 7.50),
(2, 16, 'Spicy Fried Tofu', 5.50),
(2, 17, 'Noodle Salad', 6.50),
(2, 18, 'Fried Cassava', 5.50),
(2, 19, 'Fried Tempeh and Tofu', 5.50),
(3, 20, 'Oxtail Soup *', 10.80),
(3, 21, 'Beef Ribs Soup *', 10.80),
(3, 22, 'Traditional Chicken Soup *', 9.80),
(3, 23, 'Wonton Noodle Soup', 9.80),
(3, 24, 'Beef Balls Noodle Soup', 9.80),
(3, 25, 'Chicken Dry Noodle Soup', 9.80),
(4, 26, 'Chicken Curry *', 9.80),
(4, 27, 'Lamb Curry *', 12.80),
(4, 28, 'Beef Rendang *', 11.80),
(4, 29, 'Slow-cooked Chicken in Coconut Milk *', 9.80),
(5, 30, 'Grilled Beef Ribs *', 11.80),
(5, 31, 'Grilled Chicken', 10.80),
(5, 32, 'Grilled Prawns *', 12.80),
(5, 33, 'Grilled Squid', 12.80),
(5, 34, 'Chicken Satay (6) served with rice cake', 10.80),
(6, 35, 'Deep Fried Egg in Balado Sauce', 9.80),
(6, 36, 'Fried Chicken', 9.80),
(6, 37, 'Fried Chicken in Balado Sauce', 10.80),
(6, 38, 'Smashed Chicken in Penyet Sauce', 10.80),
(6, 39, 'Crispy Duck', 12.80),
(6, 40, 'Fried Prawn in Balado Sauce', 12.80),
(6, 41, 'Fried Whole Catfish', 10.80),
(6, 42, 'Fried Tilapia in Balado Sauce', 14.80),
(7, 43, 'Fried Chicken', 10.80),
(7, 44, 'Slow-cooked Sweet Beef', 10.80),
(7, 45, 'Fried Tilapia Fish', 15.90),
(7, 46, 'Salted Fish', 9.80),
(8, 47, 'Chicken', 10.80),
(8, 48, 'Seafood', 12.80),
(8, 49, 'Beef', 11.80),
(8, 50, 'Lamb', 11.80),
(8, 51, 'Spicy Prawn Paste', 10.80),
(8, 52, 'Anchovy', 10.80),
(8, 53, 'Sator Bean "Petai"', 11.80),
(8, 54, 'Vegetarian', 9.80),
(9, 55, 'Chicken', 10.80),
(9, 56, 'Seafood', 12.80),
(9, 57, 'Beef', 11.80),
(9, 58, 'Lamb', 11.80),
(9, 59, 'Spicy Prawn Paste', 10.80),
(9, 60, 'Vegetarian', 9.80),
(10, 61, 'Chicken', 10.80),
(10, 62, 'Seafood', 12.80),
(10, 63, 'Beef', 11.80),
(10, 64, 'Lamb', 11.80),
(10, 65, 'Spicy Prawn Paste', 10.80),
(10, 66, 'Vegetarian', 9.80),
(11, 67, 'Chicken', 10.80),
(11, 68, 'Seafood', 12.80),
(11, 69, 'Beef', 11.80),
(11, 70, 'Lamb', 11.80),
(11, 71, 'Spicy Prawn Paste', 10.80),
(11, 72, 'Vegetarian', 9.80),
(12, 73, 'Chicken', 11.80),
(12, 74, 'Beef', 12.80),
(12, 75, 'Seafood', 13.80),
(13, 76, 'Steamed Mix vegetables served with rice cake and peanut sauce', 9.80),
(13, 77, 'Stir Fried Water Spinach with spicy prawn paste / garlic *', 9.80),
(13, 78, 'Stir Fried Chinesse Brocolli *', 9.80),
(13, 79, 'Stir Fried Mix Vegetables *', 9.80),
(13, 80, 'Stir Fried Mix Vegetables with Chicken *', 10.80),
(13, 81, 'Stir Fried Mix Vegetables with Seafood *', 11.80),
(14, 82, 'Combination Ice', 5.00),
(14, 83, 'Drunken Ice', 5.00),
(14, 84, 'Jackfruit Ice', 5.00),
(14, 85, 'Durian Ice', 5.50),
(14, 86, 'Red Bean Ice', 5.00),
(14, 87, 'Sweet Corn with Cheese and Milk', 3.50),
(14, 88, 'Sweet Corn with Cheese and Chocolate', 3.50),
(14, 89, 'Ice Cream (3 scoops)', 3.00);

INSERT INTO drink_items VALUES
(15, 90, 'Young Coconut Ice', 3.80),
(15, 91, 'Hot Ginger drink', 2.50),
(15, 93, 'Milk,Egg,Honey and Ginger"STMJ"',3.80),
(15, 94, 'Happy soda', 3.80),
(15, 95, 'Tamarind drink', 2.50 ),
(15, 96, 'Milo (Hot/Cold)', 3.80),
(15, 97, 'Milo Dinosaur', 4.50),
(15, 98, 'Milo Godzilla', 5.00),
(16, 99, 'Jasmine (Hot)', 2.00),
(16, 100, 'Green (Hot)', 2.00),
(16, 101, 'Sweet Iced Tea', 2.50),
(16, 102, 'Hot Teh Tarik', 2.50),
(16, 103, 'Iced Teh Tarik', 2.80),
(17, 104, 'Traditional Black Coffee', 2.00),
(17, 105, 'Traditional White Coffee', 2.50),
(17, 106, 'Iced Black Coffee', 2.50),
(17, 107, 'Iced White Coffee', 2.80),
(18, 108, 'Avocado Smoothie', 4.50),
(18, 109, 'Soursop Smoothie', 4.50),
(18, 112, 'Strawberry Smoothie', 4.50),
(18, 113, 'Durian Smoothie', 4.50),
(18, 114, 'Mung Bean Smoothie', 3.80),
(18, 115, 'Passion Fruit Juice', 3.80),
(18, 116, 'Fresh Orange Juice', 3.80);