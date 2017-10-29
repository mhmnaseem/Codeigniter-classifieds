-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2017 at 06:55 PM
-- Server version: 10.0.31-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ki154098_birthdays`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(10) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `province_id` int(10) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `province_id`, `lat`, `lng`) VALUES
(1, 'Colombo-1', 1, '', ''),
(2, 'Kandy', 4, '', ''),
(4, 'Colombo-2', 1, '', ''),
(5, 'Colombo-3', 1, '', ''),
(6, 'Colombo-4', 1, '', ''),
(7, 'Colombo-5', 1, '', ''),
(8, 'Colombo-6', 1, '', ''),
(9, 'Colombo-7', 1, '', ''),
(10, 'Colombo-8', 1, '', ''),
(11, 'Colombo-9', 1, '', ''),
(12, 'Colombo-10', 1, '', ''),
(13, 'Colombo-11', 1, '', ''),
(14, 'Colombo-12', 1, '', ''),
(15, 'Colombo-13', 1, '', ''),
(16, 'Colombo-14', 1, '', ''),
(17, 'Colombo-15', 1, '', ''),
(18, 'Nugegoda', 1, '', ''),
(19, 'Athurugiriya', 1, '', ''),
(20, 'Boralesgamuwa', 1, '', ''),
(21, 'Hanwella', 1, '', ''),
(22, 'Kohuwala', 1, '', ''),
(23, 'Kotte', 1, '', ''),
(24, 'Mount Lavinia', 1, '', ''),
(25, 'Pannipitiya', 1, '', ''),
(26, 'Ratmalana', 1, '', ''),
(27, 'Dehiwala', 1, '', ''),
(28, 'Homagama', 1, '', ''),
(29, 'Avissawella', 1, '', ''),
(30, 'Kaduwela', 1, '', ''),
(31, 'Kolonnawa', 1, '', ''),
(32, 'Malabe', 1, '', ''),
(33, 'Nawala', 1, '', ''),
(34, 'Piliyandala', 1, '', ''),
(35, 'Talawatugoda', 1, '', ''),
(36, 'Maharagama', 1, '', ''),
(37, 'Angoda', 1, '', ''),
(38, 'Battaramulla', 1, '', ''),
(39, 'Kesbewa', 1, '', ''),
(40, 'Kottawa', 1, '', ''),
(41, 'Moratuwa', 1, '', ''),
(42, 'Padukka', 1, '', ''),
(43, 'Rajagiriya', 1, '', ''),
(44, 'Wellampitiya', 1, '', ''),
(45, 'Katugastota', 4, '', ''),
(46, 'Peradeniya', 4, '', ''),
(47, 'Ampitiya', 4, '', ''),
(48, 'Gelioya', 4, '', ''),
(49, 'Nawalapitiya', 4, '', ''),
(50, 'Kundasale', 4, '', ''),
(51, 'Digana', 4, '', ''),
(52, 'Kadugannawa', 4, '', ''),
(53, 'Pilimatalawa', 4, '', ''),
(54, 'Gampola', 4, '', ''),
(55, 'Akurana', 4, '', ''),
(56, 'Galagedara', 4, '', ''),
(57, 'Madawala', 4, '', ''),
(58, 'Wattegama', 4, '', ''),
(59, 'Galle', 5, '', ''),
(60, 'Hikkaduwa', 5, '', ''),
(61, 'Batapola', 5, '', ''),
(62, 'Ambalangoda', 5, '', ''),
(63, 'Baddegama', 5, '', ''),
(64, 'Bentota', 5, '', ''),
(65, 'Elpitiya', 5, '', ''),
(66, 'Ahangama', 5, '', ''),
(67, 'Karapitiya', 5, '', ''),
(68, 'Ampara', 6, '', ''),
(69, 'Sainthamaruthu', 6, '7.3935147', '81.8335037'),
(70, 'Akkarepattu', 6, '', ''),
(71, 'Kalmunai', 6, '', ''),
(72, 'Anuradhapura', 7, '', ''),
(73, 'Eppawala', 7, '', ''),
(74, 'Galnewa', 7, '', ''),
(75, 'Nochchiyagama', 7, '', ''),
(76, 'Kekirawa', 7, '', ''),
(77, 'Medawachchiya', 7, '', ''),
(78, 'Habarana', 7, '', ''),
(79, 'Talawa', 7, '', ''),
(80, 'Tambuttegama', 7, '', ''),
(81, 'Galenbindunuwewa', 7, '', ''),
(82, 'Mihintale', 7, '', ''),
(83, 'Badulla', 8, '', ''),
(84, 'Mahiyanganaya', 8, '', ''),
(85, 'Hali Ela', 8, '', ''),
(86, 'Bandarawela', 8, '', ''),
(87, 'Diyatalawa', 8, '', ''),
(88, 'Haputale', 8, '', ''),
(89, 'Welimada', 8, '', ''),
(90, 'Ella', 8, '', ''),
(91, 'Passara', 8, '', ''),
(92, 'Batticaloa', 9, '', ''),
(93, 'Gampaha', 10, '', ''),
(94, 'Ja-Ela', 10, '', ''),
(95, 'Divulapitiya', 10, '', ''),
(96, 'Katunayake', 10, '7.1675678', '79.8757109'),
(97, 'Minuwangoda', 10, '', ''),
(98, 'Ragama', 10, '', ''),
(99, 'Negombo', 10, '', ''),
(100, 'Wattala', 10, '', ''),
(101, 'Ganemulla', 10, '', ''),
(102, 'Kelaniya', 10, '', ''),
(103, 'Mirigama', 10, '', ''),
(104, 'Veyangoda', 10, '', ''),
(105, 'Kadawatha', 10, '', ''),
(106, 'Delgoda', 10, '', ''),
(107, 'Kandana', 10, '', ''),
(108, 'Kiribathgoda', 10, '', ''),
(109, 'Nittambuwa', 10, '', ''),
(110, 'Tangalla', 11, '', ''),
(111, 'Ambalantota', 11, '', ''),
(112, 'Beliatta', 11, '', ''),
(113, 'Tissamaharama', 11, '', ''),
(114, 'Hambantota', 11, '', ''),
(115, 'Jaffna', 12, '', ''),
(116, 'Nallur', 12, '', ''),
(117, 'Chavakachcheri', 12, '', ''),
(118, 'Kalutara', 13, '', ''),
(119, 'Matugama', 13, '', ''),
(120, 'Beruwala', 13, '', ''),
(121, 'Panadura', 13, '', ''),
(122, 'Bandaragama', 13, '', ''),
(123, 'Ingiriya', 13, '', ''),
(124, 'Horana', 13, '', ''),
(125, 'Alutgama', 13, '', ''),
(126, 'Wadduwa', 13, '', ''),
(127, 'Kegalle', 14, '', ''),
(128, 'Rambukkana', 14, '', ''),
(129, 'Deraniyagala', 14, '', ''),
(130, 'Yatiyantota', 14, '', ''),
(131, 'Mawanella', 14, '', ''),
(132, 'Ruwanwella', 14, '', ''),
(133, 'Galigamuwa', 14, '', ''),
(134, 'Warakapola', 14, '', ''),
(135, 'Dehiowita', 14, '', ''),
(136, 'Kitulgala', 14, '', ''),
(137, 'Kilinochchi', 15, '', ''),
(138, 'Kurunegala', 16, '', ''),
(139, 'Pannala', 16, '', ''),
(140, 'Bingiriya', 16, '', ''),
(141, 'Hettipola', 16, '', ''),
(142, 'Nikaweratiya', 16, '', ''),
(143, 'Kuliyapitiya', 16, '', ''),
(144, 'Wariyapola', 16, '', ''),
(145, 'Galgamuwa', 16, '', ''),
(146, 'Ibbagamuwa', 16, '', ''),
(147, 'Polgahawela', 16, '', ''),
(148, 'Narammala', 16, '', ''),
(149, 'Alawwa', 16, '', ''),
(150, 'Giriulla', 16, '', ''),
(151, 'Mawathagama', 16, '', ''),
(152, 'Mannar', 17, '', ''),
(153, 'Matale', 18, '', ''),
(154, 'Ukuwela', 18, '', ''),
(155, 'Sigiriya', 18, '', ''),
(156, 'Dambulla', 18, '', ''),
(157, 'Palapathwela', 18, '', ''),
(158, 'Yatawatta', 18, '', ''),
(159, 'Galewela', 18, '', ''),
(160, 'Rattota', 18, '', ''),
(161, 'Matara', 19, '', ''),
(162, 'Hakmana', 19, '', ''),
(163, 'Kamburugamuwa', 19, '', ''),
(164, 'Akuressa', 19, '', ''),
(165, 'Dikwella', 19, '', ''),
(166, 'Kamburupitiya', 19, '', ''),
(167, 'Weligama', 19, '', ''),
(168, 'Deniyaya', 19, '', ''),
(169, 'Kekanadurra', 19, '', ''),
(170, 'Moneragala', 20, '', ''),
(171, 'Bibile', 20, '', ''),
(172, 'Wellawaya', 20, '', ''),
(173, 'Kataragama', 20, '', ''),
(174, 'Buttala', 20, '', ''),
(175, 'Mullativu', 21, '', ''),
(176, 'NuwaraEliya', 22, '', ''),
(177, 'Madulla', 22, '', ''),
(178, 'Hatton', 22, '', ''),
(179, 'Ginigathena', 22, '', ''),
(180, 'Polonnaruwa', 23, '', ''),
(181, 'Medirigiriya', 23, '', ''),
(182, 'Hingurakgoda', 23, '', ''),
(183, 'Kaduruwela', 23, '', ''),
(184, 'Puttalam', 24, '', ''),
(185, 'Chilaw', 24, '', ''),
(186, 'Marawila', 24, '', ''),
(187, 'Wennappuwa', 24, '', ''),
(188, 'Nattandiya', 24, '', ''),
(189, 'Dankotuwa', 24, '', ''),
(190, 'Ratnapura', 25, '', ''),
(191, 'Eheliyagoda', 25, '', ''),
(192, 'Embilipitiya', 25, '', ''),
(193, 'Pelmadulla', 25, '', ''),
(194, 'Balangoda', 25, '', ''),
(195, 'Kuruwita', 25, '', ''),
(196, 'Trincomalee', 26, '', ''),
(197, 'Kinniya', 26, '', ''),
(198, 'Vavuniya', 27, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(200) NOT NULL,
  `slug` varchar(1000) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` int(200) DEFAULT NULL,
  `description` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rprice` int(100) NOT NULL DEFAULT '0',
  `pprice` int(100) NOT NULL DEFAULT '0',
  `package` varchar(10) NOT NULL,
  `user_id` int(200) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `post_date` datetime NOT NULL,
  `exp_date` datetime NOT NULL,
  `district` int(100) NOT NULL,
  `city` int(100) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `email_expire` int(1) NOT NULL,
  `views` int(100) NOT NULL,
  `ip` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--



-- --------------------------------------------------------

--
-- Table structure for table `items_edit`
--

CREATE TABLE `items_edit` (
  `id` bigint(200) NOT NULL,
  `item_id` bigint(200) NOT NULL,
  `slug` varchar(1000) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` int(200) DEFAULT NULL,
  `description` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rprice` int(100) NOT NULL DEFAULT '0',
  `pprice` int(100) NOT NULL DEFAULT '0',
  `package` varchar(10) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `district` int(100) NOT NULL,
  `city` int(100) NOT NULL,
  `theme` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items_edit`
--


-- --------------------------------------------------------

--
-- Table structure for table `items_package`
--

CREATE TABLE `items_package` (
  `package_id` bigint(200) NOT NULL,
  `slug` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `package_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `package_for` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(200) NOT NULL,
  `venue` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` int(100) NOT NULL,
  `city` int(100) NOT NULL,
  `post_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_cost` int(100) NOT NULL DEFAULT '0',
  `service_charge` int(100) NOT NULL DEFAULT '0',
  `other_charges` int(100) NOT NULL DEFAULT '0',
  `party_hours` int(10) NOT NULL DEFAULT '0',
  `party_minutes` int(10) NOT NULL DEFAULT '0',
  `children_min` int(100) DEFAULT '0',
  `children_max` int(100) NOT NULL DEFAULT '0',
  `adult_min` int(100) NOT NULL DEFAULT '0',
  `adult_max` int(100) NOT NULL DEFAULT '0',
  `child_age_min` int(100) NOT NULL DEFAULT '0',
  `child_age_max` int(100) NOT NULL DEFAULT '0',
  `childern_per_head` int(100) DEFAULT '0',
  `adult_per_head` int(100) DEFAULT '0',
  `package_price` int(100) NOT NULL DEFAULT '0',
  `type_food_package` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_persons_served` int(100) NOT NULL DEFAULT '0',
  `waiters_provided` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_per_head_charge` int(100) NOT NULL DEFAULT '0',
  `food_package_price` int(100) DEFAULT '0',
  `food_plates` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_cups` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_straws` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_napkins` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_cutlery` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_chafing_dishes` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_expire` int(1) NOT NULL,
  `views` int(100) NOT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items_package`
--


-- --------------------------------------------------------

--
-- Table structure for table `items_package_edit`
--

CREATE TABLE `items_package_edit` (
  `id` bigint(200) NOT NULL,
  `package_id` bigint(200) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `package_for` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `venue` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` int(100) NOT NULL,
  `city` int(100) NOT NULL,
  `delivery_cost` int(100) NOT NULL DEFAULT '0',
  `service_charge` int(100) NOT NULL DEFAULT '0',
  `other_charges` int(100) NOT NULL DEFAULT '0',
  `party_hours` int(10) NOT NULL DEFAULT '0',
  `party_minutes` int(10) NOT NULL DEFAULT '0',
  `children_min` int(100) DEFAULT '0',
  `children_max` int(100) NOT NULL DEFAULT '0',
  `adult_min` int(100) NOT NULL DEFAULT '0',
  `adult_max` int(100) NOT NULL DEFAULT '0',
  `child_age_min` int(100) NOT NULL DEFAULT '0',
  `child_age_max` int(100) NOT NULL DEFAULT '0',
  `childern_per_head` int(100) DEFAULT '0',
  `adult_per_head` int(100) DEFAULT '0',
  `package_price` int(100) NOT NULL DEFAULT '0',
  `type_food_package` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_persons_served` int(100) NOT NULL DEFAULT '0',
  `waiters_provided` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_per_head_charge` int(100) NOT NULL DEFAULT '0',
  `food_package_price` int(100) DEFAULT '0',
  `food_plates` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_cups` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_straws` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_napkins` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_cutlery` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `food_chafing_dishes` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items_package_edit`
--


-- --------------------------------------------------------

--
-- Table structure for table `items_package_gallery`
--

CREATE TABLE `items_package_gallery` (
  `package_gallery_id` bigint(200) NOT NULL,
  `item_package_id` bigint(200) NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items_package_gallery`
--



-- --------------------------------------------------------

--
-- Table structure for table `items_package_linked`
--

CREATE TABLE `items_package_linked` (
  `linked_id` bigint(200) NOT NULL,
  `package_id` bigint(200) NOT NULL,
  `item_id` bigint(200) NOT NULL,
  `max_item_inc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_extra_note` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items_package_linked`
--



-- --------------------------------------------------------

--
-- Table structure for table `item_gallery`
--

CREATE TABLE `item_gallery` (
  `gallery_id` bigint(200) NOT NULL,
  `item_id` bigint(200) NOT NULL,
  `image` varchar(400) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_gallery`
--



-- --------------------------------------------------------

--
-- Table structure for table `maincategory`
--

CREATE TABLE `maincategory` (
  `mcatid` int(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(350) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maincategory`
--

INSERT INTO `maincategory` (`mcatid`, `slug`, `name`, `description`, `image`) VALUES
(16, 'printing', 'Printing', 'Printing', ''),
(17, 'party-favours', 'Party Favours', 'Party Favours', ''),
(18, 'tableware', 'Tableware', 'Tableware', ''),
(19, 'wearables', 'Wearables', 'Wearables', ''),
(20, 'decorations', 'Decorations', 'Decorations', ''),
(27, 'party-food', 'Party Food', 'Party Food', ''),
(28, 'party-snacks', 'Party Snacks', 'Party Snacks', ''),
(26, 'birthday-cakes', 'Birthday Cakes', 'Birthday Cakes', ''),
(24, 'balloons', 'Balloons', 'Balloons', ''),
(25, 'party-furniture', 'Party Furniture', 'Party Furniture', ''),
(29, 'play-areas-entertainment', 'Play Areas & Entertaintment ', 'Play Areas & Entertainment ', ''),
(30, 'games-group-activities', 'Games & Group Activities', 'Games & Group Activities', ''),
(31, 'professional-services', 'Professional Services', 'Professional Services', ''),
(32, 'party-drinks', 'Party Drinks', 'party drinks', '');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(10) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `pro_name`, `lat`, `lng`) VALUES
(1, 'Colombo', '6.9216318', '79.8212827'),
(4, 'Kandy', '7.2946291', '80.5907619'),
(5, 'Galle', '6.0559918', '80.1769775'),
(6, 'Ampara', '7.2962727', '81.6595207'),
(7, 'Anuradhapura', '8.3353156', '80.3329856'),
(8, 'Badulla', '6.9888338', '81.0415076'),
(9, 'Batticaloa', '7.7340837', '81.6434615'),
(10, 'Gampaha', '7.0815065', '79.9772936'),
(11, 'Hambantota', '6.1413215', '81.0816262'),
(12, 'Jaffna', '', ''),
(13, 'Kalutara', '', ''),
(14, 'Kegalle', '', ''),
(15, 'Kilinochchi', '', ''),
(16, 'Kurunegala', '', ''),
(17, 'Mannar', '', ''),
(18, 'Matale', '', ''),
(19, 'Matara', '', ''),
(20, 'Moneragala', '', ''),
(21, 'Mullativu', '', ''),
(22, 'NuwaraEliya', '', ''),
(23, 'Polonnaruwa', '', ''),
(24, 'Puttalam', '', ''),
(25, 'Ratnapura', '', ''),
(26, 'Trincomalee', '', ''),
(27, 'Vavuniya', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(100) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `slider_img` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `link`, `slider_img`) VALUES
(8, 'https://www.birthdays.lk/category/birthday-cakes', 'Slider_2.png'),
(7, 'https://www.birthdays.lk/party-items', 'slider_1.png'),
(6, 'https://www.facebook.com/notes/birthdayslk/the-sellers-shop-on-birthdayslk/2028491384062016/', 'Let_your_childs_imagination_soar_when_they_celebrate_with_one_of_our_themed_parties!_(1).png');

-- --------------------------------------------------------

--
-- Table structure for table `storetime`
--

CREATE TABLE `storetime` (
  `store_id` bigint(100) NOT NULL,
  `user_id` bigint(100) NOT NULL,
  `daysofweek` varchar(20) NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `closed` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(200) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(350) NOT NULL,
  `image` varchar(500) NOT NULL,
  `parentcat` int(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `slug`, `name`, `description`, `image`, `parentcat`) VALUES
(6, 'invitation-printing', 'Invitation printing', 'Invitation printing', '', 16),
(7, 'mugs-printing', 'Mugs Printing', 'Mugs Printing', '', 16),
(8, 'banner-printing', 'Banner Printing', 'Banner Printing', '', 16),
(9, 'other-printing', 'Other Printing', 'Other Printing', '', 16),
(10, 'loot-goody-bags', 'Loot/Goody Bags', 'Loot/Goody Bags', '', 17),
(11, 'loot-bag-fillers', 'Loot Bag Fillers', 'Loot Bag Fillers', '', 17),
(12, 'toys', 'Toys', 'Toys', '', 17),
(13, 'stationery', 'Stationery', 'Stationery', '', 17),
(14, 'stickers', 'Stickers', 'Stickers', '', 17),
(15, 'other-party-favours', 'Other Party Favours', 'Other Party Favours', '', 17),
(16, 'paper-plates-cups-straws', 'Paper plates, Cups & Straws', 'Paper plates, Cups & Straws', '', 18),
(17, 'cutlery', 'Cutlery', 'Cutlery', '', 18),
(18, 'drinkware', 'Drinkware', 'Drinkware', '', 18),
(19, 'trays', 'Trays', 'Trays', '', 18),
(20, 'cake-holders', 'Cake Holders', 'Cake Holders', '', 18),
(21, 'water-juice-dispensers', 'Water/Juice Dispensers', 'Water/Juice Dispensers', '', 18),
(22, 'table-covers', 'Table Covers', 'Table Covers', '', 18),
(23, 'other-tableware', 'Other Tableware', 'Other Tableware', '', 18),
(24, 'costumes', 'Costumes', 'Costumes', '', 19),
(25, 'hats', 'Hats', 'Hats', '', 19),
(26, 'tiaras-and-crowns', 'Tiaras and Crowns', 'Tiaras and Crowns', '', 19),
(27, 'other-headwear', 'Other Headwear', 'Other Headwear', '', 19),
(28, 'coloured-hair-spray', 'Coloured Hair Spray', 'Coloured Hair Spray', '', 19),
(29, 'face-paint', 'Face Paint', 'Face Paint', '', 19),
(30, 'gloves', 'Gloves', 'Gloves', '', 19),
(31, 'mustaches-beards', 'Mustaches & beards', 'Mustaches & beards', '', 19),
(32, 'party-vests', 'Party Vests', 'Party Vests', '', 19),
(33, 'sunglasses', 'Sunglasses', 'Sunglasses', '', 19),
(34, 'party-jewelry', 'Party Jewelry', 'Party Jewelry', '', 19),
(35, 'wigs-extensions', 'Wigs & Extensions', 'Wigs & Extensions', '', 19),
(36, 'party-masks', 'Party Masks', 'Party Masks', '', 19),
(37, 'temporary-tattoos', 'Temporary Tattoos', 'Temporary Tattoos', '', 19),
(38, 'other-wearables', 'Other Wearables', 'Other Wearables', '', 19),
(39, 'buntings', 'Buntings', 'Buntings', '', 20),
(40, 'standups-cutouts', 'Standups & cutouts', 'Standups & cutouts', '', 20),
(41, 'photo-stand-ins', 'Photo stand-ins', 'Photo stand-ins', '', 20),
(42, 'confetti-party-strings', 'Confetti & Party Strings', 'Confetti & Party Strings', '', 20),
(43, 'paper-tissue-paper-decor', 'Paper/Tissue paper decor', 'Paper/Tissue paper decor', '', 20),
(44, 'pom-poms', 'Pom poms', 'Pom poms', '', 20),
(45, 'floor-runners', 'Floor runners', 'Floor runners', '', 20),
(46, 'disco-balls-lights', 'Disco balls & lights', 'Disco balls & lights', '', 20),
(47, 'bubble-machine', 'Bubble Machine', 'Bubble Machine', '', 20),
(48, 'smoke-machine', 'Smoke Machine', 'Smoke Machine', '', 20),
(49, 'pinatas', 'Pinatas', 'Pinatas', '', 20),
(50, 'door-decor', 'Door Decor', 'Door Decor', '', 20),
(51, 'banners', 'Banners', 'Banners', '', 20),
(52, 'table-decor', 'Table Decor', 'Table Decor', '', 20),
(53, 'other-decorations', 'Other Decorations', 'Other Decorations', '', 20),
(88, 'ice-cream', 'Ice Cream', 'Ice Cream', '', 28),
(87, 'pop-corn', 'Pop Corn', 'Pop Corn', '', 28),
(83, 'birthday-cake-decorations', 'Birthday Cake Decorations', 'Birthday Cake Decorations', '', 20),
(84, 'birthday-cakes', 'Birthday Cakes', 'Birthday Cakes', '', 26),
(85, 'party-food', 'Party Food', 'Party Food', '', 27),
(86, 'candy-floss', 'Candy Floss', 'Candy Floss', '', 28),
(82, 'candles', 'Candles', 'Candles', '', 20),
(89, 'chocolate-fountain', 'Chocolate Fountain', 'Chocolate Fountain', '', 28),
(90, 'sweets-treats', 'Sweets & Treats', 'Sweets & Treats', '', 28),
(91, 'tea-coffee-machine', 'Tea/Coffee Machine', 'Tea/Coffee Machine', '', 28),
(81, 'hanging-decorations', 'Hanging Decorations', 'Hanging Decorations', '', 20),
(67, 'latex-balloons', 'Latex Balloons', 'Latex Balloons', '', 24),
(68, 'foil-balloons', 'Foil Balloons', 'Foil Balloons', '', 24),
(69, 'gas-balloons', 'Gas Balloons', 'Gas Balloons', '', 24),
(70, 'balloons-arch-decor', 'Balloons Arch/Decor', 'Balloons Arch/Decor', '', 24),
(71, 'printed-balloons', 'Printed Balloons', 'Printed Balloons', '', 24),
(72, 'magic-balloons', 'Magic Balloons', 'Magic Balloons', '', 24),
(73, 'balloon-twisting-modelling', 'Balloon Twisting & Modelling', 'Balloon Twisting & Modelling', '', 24),
(74, 'other-balloons-decorations', 'Other Balloons Decorations', 'Other Balloons Decorations', '', 24),
(75, 'cake-table', 'Cake Table', 'Cake Table', '', 25),
(76, 'catering-tables', 'Catering Tables', 'Catering Tables', '', 25),
(77, 'adults-tables-and-chairs', 'Adults Tables and Chairs', 'Adults Tables and Chairs', '', 25),
(78, 'kids-tables-and-chairs', 'Kids Tables and Chairs', 'Kids Tables and Chairs', '', 25),
(79, 'gift-tables', 'Gift Tables', 'Gift Tables', '', 25),
(80, 'other-party-furniture', 'Other Party Furniture', 'Other Party Furniture', '', 25),
(92, 'other-party-snacks', 'Other Party Snacks', 'Other Party Snacks', '', 28),
(93, 'bounces', 'Bounces', 'Bounces', '', 29),
(94, 'trampoline', 'Trampoline', 'Trampoline', '', 29),
(95, 'merry-go-round', 'Merry-go-round', 'Merry-go-round', '', 29),
(96, 'kiddy-rides', 'Kiddy Rides', 'Kiddy Rides', '', 29),
(97, 'music-karaoke', 'Music/Karaoke', 'Music/Karaoke', '', 29),
(98, 'mascot', 'Mascot/ Cartoon character', 'Mascot/ Cartoon character', '', 29),
(99, 'clown', 'Clown', 'Clown', '', 29),
(100, 'magician', 'Magician', 'Magician', '', 29),
(101, 'dj', 'DJ', 'DJ', '', 29),
(102, 'face-body-nail-painting', 'Face/Body/Nail painting', 'Face/Body/Nail painting', '', 29),
(103, 'other-entertainers', 'Other Entertainers', 'Other Entertainers', '', 29),
(104, 'play-area-balloon-twisting-modelling', 'Balloon twisting/modelling', 'Balloon twisting/modelling', '', 29),
(105, 'fireworks-display', 'Fireworks Display', 'Fireworks display', '', 29),
(106, 'others-play-areas-entertainment', 'Others Play Areas & Entertainment', 'Others Play Areas & Entertainment', '', 29),
(107, 'games-group-activities', 'Games & Group Activities', 'Games & Group Activities', '', 30),
(108, 'photographer', 'Photographer', 'Photographer', '', 31),
(109, 'servers-helpers', 'Servers/Helpers', 'Servers/Helpers', '', 31),
(110, 'other-professionals', 'Other Professionals', 'Other Professionals', '', 31),
(111, 'slides', 'Slides', 'Slides', '', 29),
(112, 'candy-jars', 'Candy Jars', 'Candy Jars', '', 18),
(113, 'party-clothes', 'Party Clothes', 'Party Clothes', '', 19),
(114, 'projectors-and-screen', 'Projectors and Screen', 'Projectors and Screen', '', 29),
(115, 'party-concept-designers', 'Party Concept Designers', 'Party Concept Designers', '', 31),
(116, 'event-organizers', 'Event Organizers', 'Event Organizers', '', 31),
(117, 'wings', 'Wings', 'wings', '', 19),
(118, 'backdrops', 'Backdrops', 'backdrops', '', 20),
(119, 'Serviettes', 'Serviettes/napkins', 'Serviettes', '', 18),
(120, 'Party Drinks', 'Party Drinks', 'Party Drinks', '', 32),
(121, 'Handcrafts', 'Handcrafts', 'Handcrafts', '', 20),
(122, 'greeting_cards', 'Greeting Cards', 'Greeting Cards', '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `theme_id` int(100) NOT NULL,
  `themename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`theme_id`, `themename`, `type`, `image`) VALUES
(28, 'Batman', 'Popular', 'Batman.jpg'),
(29, 'Tom and Jerry', 'Popular', 'Tom-and-Jerry.jpg'),
(30, 'PAW Patrol', 'Popular', 'PAW-Patrol.jpg'),
(31, 'Barbie', 'Popular', 'Barbie.jpg'),
(32, 'BabyTV', 'Popular', 'BabyTV.jpg'),
(33, 'Disney Princess', 'Popular', 'Disney-Princess.jpg'),
(34, 'Jake and the Never Land Pirates', 'Popular', 'Jake-and-the-Never-Land-Pirates.jpg'),
(35, 'Superman', 'Popular', 'Superman.jpg'),
(36, 'Minions', 'Popular', 'Minions.jpg'),
(37, 'Moana', 'Popular', 'Moana.jpg'),
(38, 'Ben 10', 'Popular', 'Ben-10.jpg'),
(39, 'Disney Cars', 'Popular', 'Disney-Cars.jpg'),
(40, 'Sofia the First', 'Popular', 'Sofia-the-First.jpg'),
(41, 'Frozen', 'Popular', 'Frozen.jpg'),
(42, 'Mickey Mouse Clubhouse', 'Popular', 'Mickey-Mous--Clubhouse.jpg'),
(43, 'Avengers Assemble', 'Popular', 'Avengers-Assemble.jpg'),
(44, 'Angry Birds', 'All', 'angry_birds.png'),
(106, 'Other themes', 'All', 'slider-2.jpg'),
(46, 'Avengers', 'All', 'Avengers.png'),
(49, 'Ballerina', 'All', 'ballerina.png'),
(50, 'Balloons', 'All', 'Balloons.png'),
(52, 'Basket Ball', 'All', 'Basketball.jpg'),
(54, 'Beauty and the Beast', 'All', 'Beauty-And-The-Beast.png'),
(56, 'Blaze and the Monster Machines', 'All', 'blaze-and-the-monster-machines.jpeg'),
(57, 'Carnival', 'All', 'carnival.png'),
(58, 'Cricket', 'All', 'cricket.png'),
(59, 'Despicable Me Minions', 'All', 'Despicable_Me_Minions.png'),
(60, 'Dinosaurs', 'All', 'dinosaurs.png'),
(62, 'Doc McStuffins', 'All', 'doc_mcstuffins.png'),
(63, 'Dora the Explorer', 'All', 'dora_the_explorer.png'),
(64, 'Farm Animals', 'All', 'farm_animals.png'),
(105, 'Fire Fighter', 'All', 'cartoon-firefighter-pours-fire-hose-illustration-53892991.jpg'),
(66, 'Football', 'All', 'football.png'),
(68, 'Frozen Olaf', 'All', 'frozen_olaf.png'),
(69, 'Guardians of the Galaxy', 'All', 'Guardians_of_the_Galaxy-Logo.png'),
(70, 'Harry Potter', 'All', 'Harry_potter-logo_90894o.png'),
(71, 'Hello Kitty', 'All', 'hello-kitty-icon-29.png'),
(72, 'Hockey', 'All', 'hockey-150436_960_720.png'),
(73, 'International Flags', 'All', 'international_flags.png'),
(75, 'Justice League', 'All', 'justice_league.png'),
(76, 'Lightning McQueen (Disney Cars)', 'All', 'Lightning_mcqueen_cars_2.png'),
(77, 'Mater (Disney Cars)', 'All', 'mater.png'),
(79, 'Minnie Mouse', 'All', 'minnie_mouse.png'),
(81, 'Monsters', 'All', 'monsters.png'),
(82, 'Ocean', 'All', 'ocean.jpg'),
(84, 'Peppa Pig', 'All', 'peppa_pig.png'),
(85, 'Pink', 'All', 'pink.png'),
(86, 'Pirates', 'All', 'pirates.png'),
(87, 'PJ Masks', 'All', 'pj_masks.png'),
(88, 'Power Rangers', 'All', 'power_rangers.png'),
(89, 'Rainbow', 'All', 'rainbow.png'),
(90, 'Scooby Doo', 'All', 'scooby_doo.png'),
(91, 'Sesame Street', 'All', 'sesame_street.png'),
(92, 'Smiley Face', 'All', 'smiley_face.png'),
(93, 'Spider Man', 'All', 'Spider-Man-PNG-Pic.png'),
(94, 'Star Wars', 'All', 'Starwars-logo.png'),
(95, 'Super Mario', 'All', 'super_mario.png'),
(96, 'Teenage Mutant Nnja Turtles', 'All', 'teenage_mutant_ninja_turtles.png'),
(97, 'Tennis', 'All', 'tennis.png'),
(98, 'Thomas & Friends', 'All', 'Thomas-the-tank-engine--friends-4ef59dc009373.png'),
(99, 'Tinker Bell', 'All', 'tinkerbell-png-4.png'),
(101, 'Toy Story', 'All', 'Toy_Story_Logo.png'),
(102, 'Transformers', 'All', 'Transformers-Logo-PNG-Picture.jpg'),
(103, 'WWE', 'All', 'wwe.png'),
(104, 'Zoo', 'All', 'zoo.png'),
(107, 'Butterfly', 'All', 'Butterfly_Wedding_Theme_Bugs_Loft_Before_the_Big_Day_Wedding_Blog_UK_.jpg'),
(109, 'Winnie the Pooh', 'All', 'maxresdefault1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `name_slug` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(260) NOT NULL,
  `type` varchar(20) NOT NULL,
  `company` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `user_district` int(100) NOT NULL,
  `user_city` int(100) NOT NULL,
  `foget_pwd` varchar(260) NOT NULL,
  `hash` varchar(260) NOT NULL,
  `active` int(1) NOT NULL,
  `phone_verify` tinyint(1) NOT NULL,
  `reg_date` date NOT NULL,
  `overview` varchar(1000) NOT NULL,
  `address` varchar(300) NOT NULL,
  `user_image` varchar(300) DEFAULT NULL,
  `cover_image` varchar(300) NOT NULL,
  `monstart` time NOT NULL,
  `monclose` time NOT NULL,
  `tuestart` time NOT NULL,
  `tueclose` time NOT NULL,
  `wedstart` time NOT NULL,
  `wedclose` time NOT NULL,
  `thustart` time NOT NULL,
  `thuclose` time NOT NULL,
  `fristart` time NOT NULL,
  `friclose` time NOT NULL,
  `satstart` time NOT NULL,
  `satclose` time NOT NULL,
  `sunstart` time NOT NULL,
  `sunclose` time NOT NULL,
  `shop_status` int(1) NOT NULL,
  `shop_expire` datetime NOT NULL,
  `email_shop_activation` int(1) NOT NULL,
  `visits` int(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `source` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` bigint(200) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `title`, `address`, `telephone`, `email`, `web`, `image`) VALUES
(5, 'Austasia Sports & Leisure Club', '290U, Weeresekara Mw Thalawatugoda.', '94 11 5566566', '', 'http://www.austasiasports.com', '_wsb_710x512_Austasia-+Sport26leisure+Pics-2014+Oct.jpg'),
(4, 'BRC I Burgher Recreation Club', '149, Havelock Rd, Colombo 05.', '94 11 2581440', '', 'https://www.facebook.com/Newbrcclub/', '11203576_848344591880088_8159618044562135185_o.jpg'),
(6, 'Colombo Colts Cricket Club', '17, Park Road, Colombo 05. ', '94 11 2581633', '', 'http://www.colombocolts.lk/', 'colombo-colts-logo-150x150.jpg'),
(7, 'Moors Sports Club', '50. Muttiah Road, Colombo 02. ', '94 11 2304224', '', '', 'moors-sports-club.jpg'),
(8, '80 Club of Colombo', '25, Independence Avenue, Colombo 07. ', '94 11 2691468', '', '', '80_80_Club_of_Colombo.jpg'),
(9, 'Catamaran Sports Club', '181/6, New Galle Road, Moratuwa. ', '94 11 2643163', '', '', 'katamaran.JPG'),
(10, 'Havelocks Sports Club', '10. Park Lane, Colombo 05.', '94 11 2590963', '', '', 'Havelocks_Sports_Club.jpg'),
(11, 'Orient Club', '1, Rajakeeya Mawatha, Colombo 07. ', '94 11 2695068', '', '', 'orient_club.JPG'),
(12, 'SSC I Singhalese Sports Club', '35, Maitland Place, Colombo 07. ', '0112695362', '', '', 'SSC_I_Singhalese_Sports_Club.jpg'),
(13, 'The Ceylon Anglers\' Club', 'Sir Chittampalam A. Gardiner Mw, Colombo 02. ', '011 239 5006', '', '', 'Capture.JPG'),
(14, 'Ceylon Motor Yacht Club', 'Indibebba, Moratuwa. ', '011 421 2390', '', 'http://www.cmyc.lk/', 'Capture1.JPG'),
(15, 'Colombo Rowing Club', '51/1. Sir Chittampalam A.Ga rdiner Mw, Colombo 02. ', '011 243 3758', '', 'http://colomborowingclub.org/', 'untitled.png'),
(22, 'Bloomfield Cricket & Athletic Club', '25/1, Reid Avenue, Colombo 07. ', '011 533 5506', '', '', 'Bloomfield_Cricket_Athletic_Club.png'),
(21, 'GL Piyadasa Eco Friendly Bird Park', 'No.166, Buthgamuwa Road, Rajagiriya. ', '071 473 6652', 'ruwanliyanage69@yahoo.com', 'http://www.glpbirdpark.com/', 'birds_park.jpg'),
(19, 'The Sandwich Factory', '10, Palm Grove, Colombo 3', '011 433 3363', '', 'http://www.thesandwichfactory.lk/', 'Capture4.JPG'),
(20, 'Super Kids', 'No. 216, Havelock Road, Colombo 5. (Opposite Henry Pedris Ground )', '011 592 0978', 'info@superkids.lk', 'http://www.superkids.lk/', 'GFB_12_SCABDYVAN_W1_SQ.jpg'),
(23, 'Capri Club', '62, Dharmapala Mawatha, Colombo 03. ', '011 257 3576', '', '', 'Capri_Club.jpg'),
(24, 'Cinnamon lake side', 'Sir Chittampalam A Gardiner Mawatha, Colombo. ', '011 249 1064', 'lakeside@cinnamonhotels.com', 'http://www.cinnamonhotels.com/en/cinnamonlakesidecolombo', 'Cinnamon_lake_side.jpg'),
(27, 'Fun Factory', '573, Nawala Road, Rajagiriya / 3rd Floor Mount City Building, 143 3/2, Galle Road, Mt. Lavinia', '011 2862656 / 011 5882656', 'info@funfactory.lk', 'http://www.funfactory.lk/', '14731192_923292957815673_7504298408354447285_n2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_edit`
--
ALTER TABLE `items_edit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_package`
--
ALTER TABLE `items_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `items_package_edit`
--
ALTER TABLE `items_package_edit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_package_gallery`
--
ALTER TABLE `items_package_gallery`
  ADD PRIMARY KEY (`package_gallery_id`);

--
-- Indexes for table `items_package_linked`
--
ALTER TABLE `items_package_linked`
  ADD PRIMARY KEY (`linked_id`);

--
-- Indexes for table `item_gallery`
--
ALTER TABLE `item_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `maincategory`
--
ALTER TABLE `maincategory`
  ADD PRIMARY KEY (`mcatid`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `storetime`
--
ALTER TABLE `storetime`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`theme_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10373;
--
-- AUTO_INCREMENT for table `items_edit`
--
ALTER TABLE `items_edit`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;
--
-- AUTO_INCREMENT for table `items_package`
--
ALTER TABLE `items_package`
  MODIFY `package_id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `items_package_edit`
--
ALTER TABLE `items_package_edit`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `items_package_gallery`
--
ALTER TABLE `items_package_gallery`
  MODIFY `package_gallery_id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `items_package_linked`
--
ALTER TABLE `items_package_linked`
  MODIFY `linked_id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `item_gallery`
--
ALTER TABLE `item_gallery`
  MODIFY `gallery_id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=772;
--
-- AUTO_INCREMENT for table `maincategory`
--
ALTER TABLE `maincategory`
  MODIFY `mcatid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `storetime`
--
ALTER TABLE `storetime`
  MODIFY `store_id` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `theme_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
