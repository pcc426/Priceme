DROP DATABASE IF EXISTS `unicorn`;
CREATE DATABASE IF NOT EXISTS `unicorn`;
USE `unicorn`;


DROP TABLE IF EXISTS `comment`;
DROP TABLE IF EXISTS `food`;
DROP TABLE IF EXISTS `food_tag`;
DROP TABLE IF EXISTS `notification`;
DROP TABLE IF EXISTS `order`;
DROP TABLE IF EXISTS `order_detail`;
DROP TABLE IF EXISTS `sys_config`;
DROP TABLE IF EXISTS `unicorn_user`;
DROP TABLE IF EXISTS `user_notification`;


CREATE TABLE IF NOT EXISTS `comment` (
  `COMMENT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(50) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `RATING` int(11) NOT NULL,
  `CONTENT` varchar(1000) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_DATE` datetime NOT NULL,
  PRIMARY KEY (`COMMENT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `food` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_category` varchar(10) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `available` varchar(1) NOT NULL,
  `price` decimal(6,1) NOT NULL,
  `discount` int(3) DEFAULT NULL,
  `discount_effect_date` datetime DEFAULT NULL,
  `discount_expiry_date` datetime DEFAULT NULL,
  `img_path` varchar(100) DEFAULT NULL,
  `remark` varchar(1000) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`food_id`)
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;


/*!40000 ALTER TABLE `food` DISABLE KEYS */;
REPLACE INTO `food` (`food_id`, `food_category`, `food_name`, `available`, `price`, `discount`, `discount_effect_date`, `discount_expiry_date`, `img_path`, `remark`, `create_date`, `update_date`) VALUES
	(151, 'Beef', 'Beef with Celery', 'Y', 38.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/BeefwithCelery_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(152, 'Beef', 'Fried Sliced Beef with Lotus Root', 'Y', 46.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/FriedSlicedBeefwithLotusRoot_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(153, 'Pork', 'Fied Pork Meat', 'Y', 32.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/FriedPorkMeat_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(154, 'Pork', 'Fried Spicy Shredded Pork', 'Y', 32.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/FriedSpicyShreddedPork_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(155, 'Staple Des', 'Steamed Rice', 'Y', 2.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/SteamedRice_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(156, 'Staple Des', 'Farmers Gnocchi', 'Y', 18.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/FarmersGnocchi_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(157, 'Staple Des', 'Fried Noodles', 'Y', 16.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/FriedNoodles_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(158, 'Staple Des', 'Shrimp Dumpling', 'Y', 20.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/ShrimpDumpling_256.jpg', '', '2018-04-11 17:55:21', '2018-04-14 03:33:43'),
	(159, 'Soup', 'Seafood Soup', 'Y', 36.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/SeafoodSoup_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(160, 'DimSum', 'Steamed Shrimp Dumpling', 'Y', 28.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/SteamedShrimpDumpling_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(150, 'Seafood', 'Squid with Vegetable', 'Y', 36.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/SquidwithVegetable_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(149, 'Seafood', 'Crystal Fried Shrimps', 'Y', 52.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/CrystalFriedShrimp_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 18:28:58'),
	(132, 'Drinks', 'Coconut Water', 'Y', 18.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/CoconutWater_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(133, 'Drinks', 'Coca Cola', 'Y', 6.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/CocaCola_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(134, 'Drinks', 'Sprite', 'Y', 6.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/Sprite_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(135, 'Drinks', 'Milk Tea', 'Y', 15.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/MilkTea_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(136, 'Vegetable', 'Stir-fried Vegetables', 'Y', 22.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/Stir_friedVegetables_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 18:23:19'),
	(137, 'Vegetable', 'Garlic Puree Broccoli', 'Y', 25.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/GarlicPureeBroccoli_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 18:24:08'),
	(138, 'Vegetable', 'Stir-fried eggs with tomato', 'Y', 20.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/Stir_fried_eggs_with_tomato_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 18:27:53'),
	(139, 'Vegetable', 'Oyster Sauce with Lettuce', 'Y', 18.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/OysterSaucewithLettuce_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(140, 'Vegetable', 'Meat Fried Eggplant', 'Y', 22.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/MeatFriedEggplant_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 19:04:25'),
	(141, 'Vegetable', 'Fried Mixed Vegetable', 'Y', 18.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/FriedMixedVegetable_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 18:04:24'),
	(142, 'Cold Dish', 'Boiled Soybeans', 'Y', 8.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/BoiledSoybeans_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(143, 'Cold Dish', 'Spicy Chinese Cabbage', 'Y', 10.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/SpicyChineseCabbage_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(144, 'Cold Dish', 'Preserved Eggs Tofu', 'Y', 10.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/PreservedEggsTofu_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(145, 'Cold Dish', 'Spiced Beancurd', 'Y', 15.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/SpicedBeancurd_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(146, 'Cold Dish', 'Spiced Beef', 'Y', 18.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/SpicedBeef_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(147, 'Cold Dish', 'Huang Bullacta', 'Y', 18.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/HuangBullacta_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21'),
	(148, 'Seafood', 'Steamed Spicy SeaFish', 'Y', 56.0, 100, '2018-04-11 17:55:21', '2018-04-11 17:55:21', '../resources/foodImg/SteamedSpicyseaFish_256.jpg', '', '2018-04-11 17:55:21', '2018-04-11 17:55:21');
/*!40000 ALTER TABLE `food` ENABLE KEYS */;



CREATE TABLE IF NOT EXISTS `food_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_id` int(11) NOT NULL,
  `tag_des` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;


REPLACE INTO `food_tag` (`tag_id`, `food_id`, `tag_des`, `create_date`, `update_date`) VALUES
	(161, 157, 'Hot', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(162, 154, 'Hot', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(163, 153, 'Hot', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(164, 152, 'Hot', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(165, 141, 'Hot', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(166, 160, 'Hot', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(167, 159, 'Hot', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(168, 157, 'Spicy', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(169, 150, 'Spicy', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(170, 149, 'Spicy', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(171, 148, 'Spicy', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(172, 146, 'Spicy', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(173, 145, 'Spicy', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(174, 150, 'Shrimp', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(175, 149, 'Shrimp', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(176, 148, 'Shrimp', '2018-04-11 18:17:00', '2018-04-11 18:17:00'),
	(177, 159, 'Shrimp', '2018-04-11 18:17:00', '2018-04-11 18:17:00');
/*!40000 ALTER TABLE `food_tag` ENABLE KEYS */;



CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(4) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `content` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `status` varchar(4) NOT NULL,
  `delivery_timeslot` varchar(4) NOT NULL,
  `order_effect_date` datetime DEFAULT NULL,
  `order_expiry_date` datetime DEFAULT NULL,
  `total_payment_amt` decimal(7,1) DEFAULT NULL,
  `total_discount_amt` decimal(7,1) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_channel` varchar(2) DEFAULT NULL,
  `credit_card_type` varchar(2) DEFAULT NULL,
  `credit_card_no` varchar(16) DEFAULT NULL,
  `credit_card_security_code` varchar(3) DEFAULT NULL,
  `credit_card_holder_name` varchar(50) DEFAULT NULL,
  `credit_card_expiry_date` varchar(4) DEFAULT NULL,
  `cheque_no` varchar(50) DEFAULT NULL,
  `remark` varchar(1000) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `qty` int(100) NOT NULL,
  `payment_amt` decimal(6,1) DEFAULT NULL,
  `discount_amt` decimal(6,1) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`,`food_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `sys_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_category` varchar(50) NOT NULL,
  `config_name` varchar(50) NOT NULL,
  `config_value` varchar(1000) NOT NULL,
  `config_effect_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `config_expiry_date` datetime DEFAULT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;


REPLACE INTO `sys_config` (`config_id`, `config_category`, `config_name`, `config_value`, `config_effect_date`, `config_expiry_date`) VALUES
	(28, 'UNICORN_CONTACT', 'UNICORN_TEL', '+852 5281-2018', '2018-01-21 02:04:33', NULL),
	(29, 'UNICORN_CONTACT', 'UNICORN_FAX', '+852 5281-2019', '2018-01-21 02:04:33', NULL),
	(30, 'UNICORN_CONTACT', 'UNICORN_ADDRESS', 'Monday - Sunday 09:00-23:00', '2018-01-21 02:04:33', NULL),
	(31, 'UNICORN_CONTACT', 'UNICORN_SERVICE_HR', 'Li Dak Sum Yip Yio Chin A Bldg 5606, Hong Kong', '2018-01-21 02:04:33', NULL);
/*!40000 ALTER TABLE `sys_config` ENABLE KEYS */;



CREATE TABLE IF NOT EXISTS `unicorn_user` (
  `user_id` varchar(50) NOT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `privilege` varchar(1) NOT NULL,
  `eng_surname` varchar(50) NOT NULL,
  `eng_middle_name` varchar(50) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  `eng_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `address_1` varchar(100) NOT NULL,
  `address_2` varchar(100) NOT NULL,
  `address_3` varchar(100) NOT NULL,
  `address_4` varchar(100) NOT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `reset` varchar(1) DEFAULT NULL,
  `locked` varchar(1) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `REG_TOKEN` varchar(100) DEFAULT NULL,
  `effect_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` datetime DEFAULT NULL,
  `remark` varchar(1000) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


REPLACE INTO `unicorn_user` (`user_id`, `sex`, `privilege`, `eng_surname`, `eng_middle_name`, `img_path`, `eng_name`, `email`, `tel`, `address_1`, `address_2`, `address_3`, `address_4`, `last_login_date`, `reset`, `locked`, `password`, `REG_TOKEN`, `effect_date`, `expiry_date`, `remark`, `create_date`, `update_date`) VALUES
	('kenli', 'M', 'U', 'LI', 'CHI YEUNG', '../resources/userProfileImg/kenli.png', 'Ken', 'kenli@gmail.com', '26252423', 'FLAT A, 12/F NEW TOWN GARDEN', '88 TAI HO ROAD', 'TSUEN WAN', 'NEW TERRITORIES', '2018-04-18 07:34:14', 'N', 'N', 'a541ace3bec0604b356dd48b10486ed5', '', '2018-02-06 09:33:41', NULL, NULL, '2018-02-06 09:33:41', '2018-04-19 01:35:54'),
	('admin', 'F', 'A', 'CS5281', 'Unicorn', '../resources/userProfileImg/admin.png', 'Admin', 'admin@gmail.com', '52812018', 'Room 5606', 'Li Dak Sum Yip Yio Chin A Bldg', 'Kowloon Tong', 'Hong Kong', '2018-04-18 07:36:30', 'N', 'N', 'a541ace3bec0604b356dd48b10486ed5', '', '2018-02-12 12:41:07', NULL, NULL, '2018-02-12 12:41:07', '2018-04-19 01:38:57');
/*!40000 ALTER TABLE `unicorn_user` ENABLE KEYS */;


CREATE TABLE IF NOT EXISTS `user_notification` (
  `notification_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `status` varchar(4) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


