
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 68.178.143.50
-- Generation Time: Apr 17, 2015 at 01:12 AM
-- Server version: 5.5.40
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cabbookingccv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `gcm_users`
--

CREATE TABLE `gcm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gcm_regid` text,
  `driver_status` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gcm_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `nearest_driver`
--

CREATE TABLE `nearest_driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `driver_email` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `cab_type` int(11) NOT NULL,
  `driver_status` varchar(20) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `nearest_driver`
--


-- --------------------------------------------------------

--
-- Table structure for table `refer_friend`
--

CREATE TABLE `refer_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `friend_ids` varchar(255) NOT NULL,
  `valid_flag` tinyint(4) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `refer_friend`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL DEFAULT '',
  `admin_password` varchar(100) DEFAULT NULL,
  `admin_email` varchar(255) NOT NULL DEFAULT '',
  `admin_last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin_site_root` varchar(255) NOT NULL,
  `admin_site_owner` varchar(255) NOT NULL,
  `admin_send_email` varchar(255) NOT NULL,
  `admin_address` text NOT NULL,
  `admin_city` varchar(255) NOT NULL,
  `admin_state` varchar(255) NOT NULL,
  `admin_country` varchar(255) NOT NULL,
  `admin_post_code` varchar(255) NOT NULL,
  `shipping_charges` float(11,2) NOT NULL,
  `shipping_charges2` float(11,2) NOT NULL,
  `admin_site_title` varchar(255) NOT NULL,
  `paypal_account` varchar(255) NOT NULL,
  `paypal_url` varchar(255) NOT NULL,
  `paypal_test_account` varchar(255) NOT NULL,
  `paypal_test_url` varchar(255) NOT NULL,
  `is_testing` enum('0','1') NOT NULL,
  `Cheque_favour` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` VALUES(1, 'admin', 'admin', 'contact@eprofitbooster.com', '2014-07-07 07:25:12', 'www.eprofitbooster.com', 'DATATELMAN', 'contact@eprofitbooster.com', 'Dilshad Garden, Delhi, India', 'New Delhi', 'Delhi', 'INDIA', '110034', 10.00, 55.00, 'DATATELMAN', 'pankaj_1224502687_biz@abc.com', 'https://www.paypal.com/cgi-bin/webscr', 'pankaj_1224502687_biz@abc.com', 'https://www.sandbox.paypal.com/us/cgi-bin/webscr', '1', 'DATATELMAN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cab`
--

CREATE TABLE `tbl_cab` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` bigint(20) NOT NULL,
  `cab_number` varchar(50) NOT NULL,
  `fare_per_hour` double(5,2) NOT NULL,
  `fare_per_km` double(5,2) NOT NULL,
  `waiting_charge_per_10_min` double(5,2) NOT NULL,
  `cab_image1` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_cab`
--

INSERT INTO `tbl_cab` VALUES(1, 8, 'My CAB', 100.00, 15.00, 0.00, '31f266a2c0709629166d93fd93b3d16e.jpg', 1);
INSERT INTO `tbl_cab` VALUES(2, 9, 'Luxury Limousine Service', 250.00, 25.00, 0.00, 'c02e3ecf72e19dcccaac1491edaf6341.jpg', 1);
INSERT INTO `tbl_cab` VALUES(3, 7, 'Yellow Service CAB', 75.00, 10.00, 0.00, '46a6fa0a6a856aff289bee93016057db.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_name` varchar(100) NOT NULL DEFAULT '',
  `cat_image` varchar(100) NOT NULL,
  `cat_desc` longtext NOT NULL,
  `cat_status` enum('Active','Inactive','Delete') NOT NULL DEFAULT 'Active',
  `latest` varchar(20) NOT NULL DEFAULT 'N',
  `cat_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` VALUES(8, 0, 'Personal CAB', 'cd2ee3bb9aa4408f74a77957c571df7a.jpg', 'Personal CAB', 'Active', 'N', 0);
INSERT INTO `tbl_category` VALUES(9, 0, 'Limouzine ', '34ef24461b1d1744df444c1d6690d805.jpg', 'Limouzine ', 'Active', 'N', 0);
INSERT INTO `tbl_category` VALUES(7, 0, 'Yellow CAB', 'a88a3af6ea1c4c8c02ea9003998cb3ca.jpg', 'Newyork Yellow CAB', 'Active', 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE `tbl_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  `doller_value` float NOT NULL,
  `ship_charges` float NOT NULL,
  `wholesaler_qty` varchar(10) NOT NULL,
  `site_address` text NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` VALUES(1, 'Admin email', 'contact@eprofitbooster.com', 1, 5, '20', 'dilshad garden, New Delhi-110018');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL DEFAULT '',
  `page_text` longtext NOT NULL,
  `page_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` VALUES(1, 'About Us', '<p style="text-align: justify;">\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\n	<br />\r\n	It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here&#39;, making it&nbsp;&nbsp; look like readable English.</p>\r\n<p style="text-align: justify;">\r\n	There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by&nbsp;&nbsp; injected humour, or randomised words which don&#39;t look even slightly believable. If you are&nbsp;&nbsp; going to use a passage of Lorem&nbsp;&nbsp;&nbsp;&nbsp; Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of&nbsp;&nbsp; text. All the Lorem Ipsum generators on the&nbsp; Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.<br />\r\n	<br />\r\n	It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\n	<br />\r\n	It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>', 'Active');
INSERT INTO `tbl_content` VALUES(2, 'Our Services', '<p style="text-align: justify;">\r\n	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\n	<br />\r\n	It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here&#39;, making it&nbsp;&nbsp; look like readable English.</p>\r\n<p style="text-align: justify;">\r\n	There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by&nbsp;&nbsp; injected humour, or randomised words which don&#39;t look even slightly believable. If you are&nbsp;&nbsp; going to use a passage of Lorem&nbsp;&nbsp;&nbsp;&nbsp; Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of&nbsp;&nbsp; text. All the Lorem Ipsum generators on the&nbsp; Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.<br />\r\n	<br />\r\n	It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\n	<br />\r\n	It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>', 'Active');
INSERT INTO `tbl_content` VALUES(4, 'Contact Us', '<br />\r\nBusiness Affiliates Contact at<br />\r\n<strong>Direct email:</strong> bookyourcab@gmail.com<br />\r\n<strong>Email :</strong> info@bookyourcab.com<br />\r\n<strong>Skype :</strong> bookyourcab<br />\r\n<strong>G-Talk :</strong> bookyourcab<br />\r\n<strong>Phone :</strong> +91xxxxxxxxxx, +91xxxxxxxxxx<br />\r\n<strong>Address :</strong><br />\r\n<strong>Pin :</strong>', 'Active');
INSERT INTO `tbl_content` VALUES(13, 'Gallery', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit dolore magna aliqua', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country_master`
--

CREATE TABLE `tbl_country_master` (
  `contId` int(11) NOT NULL AUTO_INCREMENT,
  `contCode` varchar(5) DEFAULT NULL,
  `contName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`contId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=236 ;

--
-- Dumping data for table `tbl_country_master`
--

INSERT INTO `tbl_country_master` VALUES(1, 'AF', 'Afghanistan');
INSERT INTO `tbl_country_master` VALUES(2, 'AL', 'Albania');
INSERT INTO `tbl_country_master` VALUES(3, 'DZ', 'Algeria');
INSERT INTO `tbl_country_master` VALUES(4, 'AS', 'American Samoa');
INSERT INTO `tbl_country_master` VALUES(5, 'AD', 'Andorra');
INSERT INTO `tbl_country_master` VALUES(6, 'AO', 'Angola');
INSERT INTO `tbl_country_master` VALUES(7, 'AI', 'Anguilla');
INSERT INTO `tbl_country_master` VALUES(8, 'AQ', 'Antarctica');
INSERT INTO `tbl_country_master` VALUES(9, 'AG', 'Antigua and Barbuda');
INSERT INTO `tbl_country_master` VALUES(10, 'AR', 'Argentina');
INSERT INTO `tbl_country_master` VALUES(11, 'AM', 'Armenia');
INSERT INTO `tbl_country_master` VALUES(12, 'AW', 'Aruba');
INSERT INTO `tbl_country_master` VALUES(13, 'AU', 'Australia');
INSERT INTO `tbl_country_master` VALUES(14, 'AT', 'Austria');
INSERT INTO `tbl_country_master` VALUES(15, 'AZ', 'Azerbaijan');
INSERT INTO `tbl_country_master` VALUES(16, 'BS', 'Bahamas');
INSERT INTO `tbl_country_master` VALUES(17, 'BH', 'Bahrain');
INSERT INTO `tbl_country_master` VALUES(18, 'BD', 'Bangladesh');
INSERT INTO `tbl_country_master` VALUES(19, 'BB', 'Barbados');
INSERT INTO `tbl_country_master` VALUES(20, 'BY', 'Belarus');
INSERT INTO `tbl_country_master` VALUES(21, 'BE', 'Belgium');
INSERT INTO `tbl_country_master` VALUES(22, 'BZ', 'Belize');
INSERT INTO `tbl_country_master` VALUES(23, 'BJ', 'Benin');
INSERT INTO `tbl_country_master` VALUES(24, 'BM', 'Bermuda');
INSERT INTO `tbl_country_master` VALUES(25, 'BT', 'Bhutan');
INSERT INTO `tbl_country_master` VALUES(26, 'BO', 'Bolivia');
INSERT INTO `tbl_country_master` VALUES(27, 'BA', 'Bosnia and Herzegowina');
INSERT INTO `tbl_country_master` VALUES(28, 'BW', 'Botswana');
INSERT INTO `tbl_country_master` VALUES(29, 'BV', 'Bouvet Island');
INSERT INTO `tbl_country_master` VALUES(30, 'BR', 'Brazil');
INSERT INTO `tbl_country_master` VALUES(31, 'IO', 'British Indian Ocean Territory');
INSERT INTO `tbl_country_master` VALUES(32, 'BN', 'Brunei Darussalam');
INSERT INTO `tbl_country_master` VALUES(33, 'BG', 'Bulgaria');
INSERT INTO `tbl_country_master` VALUES(34, 'BF', 'Burkina Faso');
INSERT INTO `tbl_country_master` VALUES(35, 'BI', 'Burundi');
INSERT INTO `tbl_country_master` VALUES(36, 'KH', 'Cambodia');
INSERT INTO `tbl_country_master` VALUES(37, 'CM', 'Cameroon');
INSERT INTO `tbl_country_master` VALUES(38, 'CA', 'Canada');
INSERT INTO `tbl_country_master` VALUES(39, 'CV', 'Cape Verde');
INSERT INTO `tbl_country_master` VALUES(40, 'KY', 'Cayman Islands');
INSERT INTO `tbl_country_master` VALUES(41, 'CF', 'Central African Republic');
INSERT INTO `tbl_country_master` VALUES(42, 'TD', 'Chad');
INSERT INTO `tbl_country_master` VALUES(43, 'CL', 'Chile');
INSERT INTO `tbl_country_master` VALUES(44, 'CN', 'China');
INSERT INTO `tbl_country_master` VALUES(45, 'CX', 'Christmas Island');
INSERT INTO `tbl_country_master` VALUES(46, 'CC', 'Cocos (Keeling) Islands');
INSERT INTO `tbl_country_master` VALUES(47, 'CO', 'Colombia');
INSERT INTO `tbl_country_master` VALUES(48, 'KM', 'Comoros');
INSERT INTO `tbl_country_master` VALUES(49, 'CG', 'Congo');
INSERT INTO `tbl_country_master` VALUES(50, 'CK', 'Cook Islands');
INSERT INTO `tbl_country_master` VALUES(51, 'CR', 'Costa Rica');
INSERT INTO `tbl_country_master` VALUES(52, 'HR', 'Croatia (local name: Hrvatska)');
INSERT INTO `tbl_country_master` VALUES(53, 'CU', 'Cuba');
INSERT INTO `tbl_country_master` VALUES(54, 'CY', 'Cyprus');
INSERT INTO `tbl_country_master` VALUES(55, 'CZ', 'Czech Republic');
INSERT INTO `tbl_country_master` VALUES(56, 'DK', 'Denmark');
INSERT INTO `tbl_country_master` VALUES(57, 'DJ', 'Djibouti');
INSERT INTO `tbl_country_master` VALUES(58, 'DM', 'Dominica');
INSERT INTO `tbl_country_master` VALUES(59, 'DO', 'Dominican Republic');
INSERT INTO `tbl_country_master` VALUES(60, 'TP', 'East Timor');
INSERT INTO `tbl_country_master` VALUES(61, 'EC', 'Ecuador');
INSERT INTO `tbl_country_master` VALUES(62, 'EG', 'Egypt');
INSERT INTO `tbl_country_master` VALUES(63, 'SV', 'El Salvador');
INSERT INTO `tbl_country_master` VALUES(64, 'GQ', 'Equatorial Guinea');
INSERT INTO `tbl_country_master` VALUES(65, 'ER', 'Eritrea');
INSERT INTO `tbl_country_master` VALUES(66, 'EE', 'Estonia');
INSERT INTO `tbl_country_master` VALUES(67, 'ET', 'Ethiopia');
INSERT INTO `tbl_country_master` VALUES(68, 'FK', 'Falkland Islands (Malvinas)');
INSERT INTO `tbl_country_master` VALUES(69, 'FO', 'Faroe Islands');
INSERT INTO `tbl_country_master` VALUES(70, 'FJ', 'Fiji');
INSERT INTO `tbl_country_master` VALUES(71, 'FI', 'Finland');
INSERT INTO `tbl_country_master` VALUES(72, 'FR', 'France');
INSERT INTO `tbl_country_master` VALUES(73, 'FX', 'France Metropolitan');
INSERT INTO `tbl_country_master` VALUES(74, 'GF', 'French Guiana');
INSERT INTO `tbl_country_master` VALUES(75, 'PF', 'French Polynesia');
INSERT INTO `tbl_country_master` VALUES(76, 'TF', 'French Southern Territories');
INSERT INTO `tbl_country_master` VALUES(77, 'GA', 'Gabon');
INSERT INTO `tbl_country_master` VALUES(78, 'GM', 'Gambia');
INSERT INTO `tbl_country_master` VALUES(79, 'GE', 'Georgia');
INSERT INTO `tbl_country_master` VALUES(80, 'DE', 'Germany');
INSERT INTO `tbl_country_master` VALUES(81, 'GH', 'Ghana');
INSERT INTO `tbl_country_master` VALUES(82, 'GI', 'Gibraltar');
INSERT INTO `tbl_country_master` VALUES(83, 'GR', 'Greece');
INSERT INTO `tbl_country_master` VALUES(84, 'GL', 'Greenland');
INSERT INTO `tbl_country_master` VALUES(85, 'GD', 'Grenada');
INSERT INTO `tbl_country_master` VALUES(86, 'GP', 'Guadeloupe');
INSERT INTO `tbl_country_master` VALUES(87, 'GU', 'Guam');
INSERT INTO `tbl_country_master` VALUES(88, 'GT', 'Guatemala');
INSERT INTO `tbl_country_master` VALUES(89, 'GN', 'Guinea');
INSERT INTO `tbl_country_master` VALUES(90, 'GW', 'Guinea-Bissau');
INSERT INTO `tbl_country_master` VALUES(91, 'GY', 'Guyana');
INSERT INTO `tbl_country_master` VALUES(92, 'HT', 'Haiti');
INSERT INTO `tbl_country_master` VALUES(93, 'HM', 'Heard and Mc Donald Islands');
INSERT INTO `tbl_country_master` VALUES(94, 'HN', 'Honduras');
INSERT INTO `tbl_country_master` VALUES(95, 'HK', 'Hong Kong');
INSERT INTO `tbl_country_master` VALUES(96, 'HU', 'Hungary');
INSERT INTO `tbl_country_master` VALUES(97, 'IS', 'Iceland');
INSERT INTO `tbl_country_master` VALUES(98, 'IN', 'India');
INSERT INTO `tbl_country_master` VALUES(99, 'ID', 'Indonesia');
INSERT INTO `tbl_country_master` VALUES(100, 'IR', 'Iran (Islamic Republic of)');
INSERT INTO `tbl_country_master` VALUES(101, 'IQ', 'Iraq');
INSERT INTO `tbl_country_master` VALUES(102, 'IE', 'Ireland');
INSERT INTO `tbl_country_master` VALUES(103, 'IL', 'Israel');
INSERT INTO `tbl_country_master` VALUES(104, 'IT', 'Italy');
INSERT INTO `tbl_country_master` VALUES(105, 'JM', 'Jamaica');
INSERT INTO `tbl_country_master` VALUES(106, 'JP', 'Japan');
INSERT INTO `tbl_country_master` VALUES(107, 'JO', 'Jordan');
INSERT INTO `tbl_country_master` VALUES(108, 'KZ', 'Kazakhstan');
INSERT INTO `tbl_country_master` VALUES(109, 'KE', 'Kenya');
INSERT INTO `tbl_country_master` VALUES(110, 'KI', 'Kiribati');
INSERT INTO `tbl_country_master` VALUES(111, 'KW', 'Kuwait');
INSERT INTO `tbl_country_master` VALUES(112, 'KG', 'Kyrgyzstan');
INSERT INTO `tbl_country_master` VALUES(113, 'LV', 'Latvia');
INSERT INTO `tbl_country_master` VALUES(114, 'LB', 'Lebanon');
INSERT INTO `tbl_country_master` VALUES(115, 'LS', 'Lesotho');
INSERT INTO `tbl_country_master` VALUES(116, 'LR', 'Liberia');
INSERT INTO `tbl_country_master` VALUES(117, 'LY', 'Libyan Arab Jamahiriya');
INSERT INTO `tbl_country_master` VALUES(118, 'LI', 'Liechtenstein');
INSERT INTO `tbl_country_master` VALUES(119, 'LT', 'Lithuania');
INSERT INTO `tbl_country_master` VALUES(120, 'LU', 'Luxembourg');
INSERT INTO `tbl_country_master` VALUES(121, 'MO', 'Macao');
INSERT INTO `tbl_country_master` VALUES(122, 'MK', 'Macedonia');
INSERT INTO `tbl_country_master` VALUES(123, 'MG', 'Madagascar');
INSERT INTO `tbl_country_master` VALUES(124, 'MW', 'Malawi');
INSERT INTO `tbl_country_master` VALUES(125, 'MY', 'Malaysia');
INSERT INTO `tbl_country_master` VALUES(126, 'MV', 'Maldives');
INSERT INTO `tbl_country_master` VALUES(127, 'ML', 'Mali');
INSERT INTO `tbl_country_master` VALUES(128, 'MT', 'Malta');
INSERT INTO `tbl_country_master` VALUES(129, 'MH', 'Marshall Islands');
INSERT INTO `tbl_country_master` VALUES(130, 'MQ', 'Martinique');
INSERT INTO `tbl_country_master` VALUES(131, 'MR', 'Mauritania');
INSERT INTO `tbl_country_master` VALUES(132, 'MU', 'Mauritius');
INSERT INTO `tbl_country_master` VALUES(133, 'YT', 'Mayotte');
INSERT INTO `tbl_country_master` VALUES(134, 'MX', 'Mexico');
INSERT INTO `tbl_country_master` VALUES(135, 'FM', 'Micronesia');
INSERT INTO `tbl_country_master` VALUES(136, 'MD', 'Moldova');
INSERT INTO `tbl_country_master` VALUES(137, 'MC', 'Monaco');
INSERT INTO `tbl_country_master` VALUES(138, 'MN', 'Mongolia');
INSERT INTO `tbl_country_master` VALUES(139, 'MS', 'Montserrat');
INSERT INTO `tbl_country_master` VALUES(140, 'MA', 'Morocco');
INSERT INTO `tbl_country_master` VALUES(141, 'MZ', 'Mozambique');
INSERT INTO `tbl_country_master` VALUES(142, 'MM', 'Myanmar');
INSERT INTO `tbl_country_master` VALUES(143, 'NA', 'Namibia');
INSERT INTO `tbl_country_master` VALUES(144, 'NR', 'Nauru');
INSERT INTO `tbl_country_master` VALUES(145, 'NP', 'Nepal');
INSERT INTO `tbl_country_master` VALUES(146, 'NL', 'Netherlands');
INSERT INTO `tbl_country_master` VALUES(147, 'AN', 'Netherlands Antilles');
INSERT INTO `tbl_country_master` VALUES(148, 'NC', 'New Caledonia');
INSERT INTO `tbl_country_master` VALUES(149, 'NZ', 'New Zealand');
INSERT INTO `tbl_country_master` VALUES(150, 'NI', 'Nicaragua');
INSERT INTO `tbl_country_master` VALUES(151, 'NE', 'Niger');
INSERT INTO `tbl_country_master` VALUES(152, 'NG', 'Nigeria');
INSERT INTO `tbl_country_master` VALUES(153, 'NU', 'Niue');
INSERT INTO `tbl_country_master` VALUES(154, 'NF', 'Norfolk Island');
INSERT INTO `tbl_country_master` VALUES(155, 'KP', 'North Korea');
INSERT INTO `tbl_country_master` VALUES(156, 'MP', 'Northern Mariana Islands');
INSERT INTO `tbl_country_master` VALUES(157, 'NO', 'Norway');
INSERT INTO `tbl_country_master` VALUES(158, 'OM', 'Oman');
INSERT INTO `tbl_country_master` VALUES(159, 'PK', 'Pakistan');
INSERT INTO `tbl_country_master` VALUES(160, 'PW', 'Palau');
INSERT INTO `tbl_country_master` VALUES(161, 'PA', 'Panama');
INSERT INTO `tbl_country_master` VALUES(162, 'PG', 'Papua New Guinea');
INSERT INTO `tbl_country_master` VALUES(163, 'PY', 'Paraguay');
INSERT INTO `tbl_country_master` VALUES(164, 'PE', 'Peru');
INSERT INTO `tbl_country_master` VALUES(165, 'PH', 'Philippines');
INSERT INTO `tbl_country_master` VALUES(166, 'PN', 'Pitcairn');
INSERT INTO `tbl_country_master` VALUES(167, 'PL', 'Poland');
INSERT INTO `tbl_country_master` VALUES(168, 'PT', 'Portugal');
INSERT INTO `tbl_country_master` VALUES(169, 'PR', 'Puerto Rico');
INSERT INTO `tbl_country_master` VALUES(170, 'QA', 'Qatar');
INSERT INTO `tbl_country_master` VALUES(171, 'RE', 'Reunion');
INSERT INTO `tbl_country_master` VALUES(172, 'RO', 'Romania');
INSERT INTO `tbl_country_master` VALUES(173, 'RU', 'Russian Federation');
INSERT INTO `tbl_country_master` VALUES(174, 'RW', 'Rwanda');
INSERT INTO `tbl_country_master` VALUES(175, 'KN', 'Saint Kitts and Nevis');
INSERT INTO `tbl_country_master` VALUES(176, 'LC', 'Saint Lucia');
INSERT INTO `tbl_country_master` VALUES(177, 'VC', 'Saint Vincent and the Grenadines');
INSERT INTO `tbl_country_master` VALUES(178, 'WS', 'Samoa');
INSERT INTO `tbl_country_master` VALUES(179, 'SM', 'San Marino');
INSERT INTO `tbl_country_master` VALUES(180, 'ST', 'Sao Tome and Principe');
INSERT INTO `tbl_country_master` VALUES(181, 'SA', 'Saudi Arabia');
INSERT INTO `tbl_country_master` VALUES(182, 'SN', 'Senegal');
INSERT INTO `tbl_country_master` VALUES(183, 'SC', 'Seychelles');
INSERT INTO `tbl_country_master` VALUES(184, 'SL', 'Sierra Leone');
INSERT INTO `tbl_country_master` VALUES(185, 'SG', 'Singapore');
INSERT INTO `tbl_country_master` VALUES(186, 'SK', 'Slovakia (Slovak Republic)');
INSERT INTO `tbl_country_master` VALUES(187, 'SI', 'Slovenia');
INSERT INTO `tbl_country_master` VALUES(188, 'SB', 'Solomon Islands');
INSERT INTO `tbl_country_master` VALUES(189, 'SO', 'Somalia');
INSERT INTO `tbl_country_master` VALUES(190, 'ZA', 'South Africa');
INSERT INTO `tbl_country_master` VALUES(191, 'KR', 'South Korea');
INSERT INTO `tbl_country_master` VALUES(192, 'ES', 'Spain');
INSERT INTO `tbl_country_master` VALUES(193, 'LK', 'Sri Lanka');
INSERT INTO `tbl_country_master` VALUES(194, 'SH', 'St. Helena');
INSERT INTO `tbl_country_master` VALUES(195, 'PM', 'St. Pierre and Miquelon');
INSERT INTO `tbl_country_master` VALUES(196, 'SD', 'Sudan');
INSERT INTO `tbl_country_master` VALUES(197, 'SR', 'Suriname');
INSERT INTO `tbl_country_master` VALUES(198, 'SJ', 'Svalbard and Jan Mayen Islands');
INSERT INTO `tbl_country_master` VALUES(199, 'SZ', 'Swaziland');
INSERT INTO `tbl_country_master` VALUES(200, 'SE', 'Sweden');
INSERT INTO `tbl_country_master` VALUES(201, 'CH', 'Switzerland');
INSERT INTO `tbl_country_master` VALUES(202, 'SY', 'Syrian Arab Republic');
INSERT INTO `tbl_country_master` VALUES(203, 'TW', 'Taiwan');
INSERT INTO `tbl_country_master` VALUES(204, 'TJ', 'Tajikistan');
INSERT INTO `tbl_country_master` VALUES(205, 'TZ', 'Tanzania');
INSERT INTO `tbl_country_master` VALUES(206, 'TH', 'Thailand');
INSERT INTO `tbl_country_master` VALUES(207, 'TG', 'Togo');
INSERT INTO `tbl_country_master` VALUES(208, 'TK', 'Tokelau');
INSERT INTO `tbl_country_master` VALUES(209, 'TO', 'Tonga');
INSERT INTO `tbl_country_master` VALUES(210, 'TT', 'Trinidad and Tobago');
INSERT INTO `tbl_country_master` VALUES(211, 'TN', 'Tunisia');
INSERT INTO `tbl_country_master` VALUES(212, 'TR', 'Turkey');
INSERT INTO `tbl_country_master` VALUES(213, 'TM', 'Turkmenistan');
INSERT INTO `tbl_country_master` VALUES(214, 'TC', 'Turks and Caicos Islands');
INSERT INTO `tbl_country_master` VALUES(215, 'TV', 'Tuvalu');
INSERT INTO `tbl_country_master` VALUES(216, 'UG', 'Uganda');
INSERT INTO `tbl_country_master` VALUES(217, 'UA', 'Ukraine');
INSERT INTO `tbl_country_master` VALUES(218, 'AE', 'United Arab Emirates');
INSERT INTO `tbl_country_master` VALUES(219, 'UK', 'United Kingdom');
INSERT INTO `tbl_country_master` VALUES(220, 'US', 'United States');
INSERT INTO `tbl_country_master` VALUES(221, 'UY', 'Uruguay');
INSERT INTO `tbl_country_master` VALUES(222, 'UZ', 'Uzbekistan');
INSERT INTO `tbl_country_master` VALUES(223, 'VU', 'Vanuatu');
INSERT INTO `tbl_country_master` VALUES(224, 'VA', 'Vatican City State (Holy See)');
INSERT INTO `tbl_country_master` VALUES(225, 'VE', 'Venezuela');
INSERT INTO `tbl_country_master` VALUES(226, 'VN', 'Vietnam');
INSERT INTO `tbl_country_master` VALUES(227, 'VG', 'Virgin Islands (British)');
INSERT INTO `tbl_country_master` VALUES(228, 'VI', 'Virgin Islands (U.S.)');
INSERT INTO `tbl_country_master` VALUES(229, 'WF', 'Wallis And Futuna Islands');
INSERT INTO `tbl_country_master` VALUES(230, 'EH', 'Western Sahara');
INSERT INTO `tbl_country_master` VALUES(231, 'YE', 'Yemen');
INSERT INTO `tbl_country_master` VALUES(232, 'YU', 'Yugoslavia');
INSERT INTO `tbl_country_master` VALUES(233, 'ZM', 'Zambia');
INSERT INTO `tbl_country_master` VALUES(234, 'ZW', 'Zimbabwe');
INSERT INTO `tbl_country_master` VALUES(235, 'OT', 'Other Country');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupon`
--

CREATE TABLE `tbl_coupon` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `coupon` varchar(100) NOT NULL,
  `flat_discount` double(10,2) NOT NULL,
  `percentile` double(5,2) NOT NULL,
  `add_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_coupon`
--

INSERT INTO `tbl_coupon` VALUES(1, 'PQsVkcs6563LKO', 25.00, 2.00, '2014-04-02', 1);
INSERT INTO `tbl_coupon` VALUES(2, 'XsVk11s6563LKO', 20.00, 2.00, '2014-04-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float(10,2) NOT NULL,
  `amount_refunded` float(10,2) NOT NULL,
  `transaction_id` varchar(125) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `pickup_address` text NOT NULL,
  `dropoff_address` text NOT NULL,
  `distance` varchar(20) NOT NULL,
  `cab_number` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_payments`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `driver` bigint(20) NOT NULL,
  `cab` bigint(20) NOT NULL,
  `passenger` bigint(20) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pickuptime` time NOT NULL COMMENT 'entry for ride later',
  `pickup_address` text NOT NULL,
  `dropoff_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dropoff_address` text NOT NULL,
  `distance` int(4) NOT NULL,
  `cab_number` varchar(100) NOT NULL,
  `coupon_used` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL,
  `ride_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_ride`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `name_on_card` varchar(255) NOT NULL,
  `card_num` varchar(50) NOT NULL,
  `exp_date` varchar(20) NOT NULL,
  `cvv_num` varchar(10) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `paid_yet` double(10,2) NOT NULL,
  `add_date` date NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `cab_type` int(11) NOT NULL,
  `cab_no` varchar(50) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `refer_count` int(11) NOT NULL,
  `status` enum('Active','Inactive','Delete') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_user`
--

