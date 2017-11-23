-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2016 at 01:36 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mfinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `mf_attachments`
--

CREATE TABLE `mf_attachments` (
  `id` int(11) NOT NULL,
  `model` varchar(20) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `attachment_name` varchar(255) NOT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mf_attachments`
--

INSERT INTO `mf_attachments` (`id`, `model`, `foreign_key`, `name`, `attachment_name`, `dir`, `type`, `size`, `is_primary`, `active`) VALUES
(1, 'User', 1, 'UserProfile', 'logo1.png', '1\\62\\93\\64', 'image/png', 10002, 0, 1),
(2, 'User', 2, 'UserProfile', 'logo_converted.png', '2\\14\\59\\42', 'image/png', 7504, 0, 1),
(6, 'User', 3, 'UserProfile', 'logo_converted.png', '6\\04\\77\\21', 'image/png', 7504, 0, 1),
(7, 'Group', 1, 'GroupProfile', 'pictures-high-quality-13.jpg', '7\\98\\43\\93', 'image/jpeg', 4258598, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mf_centers`
--

CREATE TABLE `mf_centers` (
  `id` int(11) NOT NULL,
  `city` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_centers`
--

INSERT INTO `mf_centers` (`id`, `city`, `name`, `uid`, `is_active`, `is_delete`, `created`, `updated`) VALUES
(1, 'Nambiyur', 'Nambiyur', 'NAM001', 1, 0, '2016-10-16 13:52:04', '2016-10-16 13:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `mf_dues`
--

CREATE TABLE `mf_dues` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `min_amt_paid` float NOT NULL,
  `extra_amt_paid` float DEFAULT NULL,
  `amount` float NOT NULL,
  `type` int(11) NOT NULL,
  `extra_amount` int(11) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_dues`
--

INSERT INTO `mf_dues` (`id`, `user_id`, `loan_id`, `min_amt_paid`, `extra_amt_paid`, `amount`, `type`, `extra_amount`, `created`, `updated`) VALUES
(1, 3, 1, 325, 394, 719, 1, 1, '2016-12-02', '2016-12-02 18:01:42'),
(2, 4, 2, 325, NULL, 325, 1, 0, '2016-12-02', '2016-12-02 18:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `mf_groups`
--

CREATE TABLE `mf_groups` (
  `id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `disp_amount` float NOT NULL,
  `interest` float NOT NULL,
  `no_of_members` int(11) NOT NULL,
  `min_amount` float NOT NULL,
  `min_amt_interest` float NOT NULL,
  `min_amt_week` int(11) NOT NULL,
  `extra_amount` float NOT NULL,
  `extra_amt_interest` float NOT NULL,
  `extra_amt_week` int(11) NOT NULL,
  `first_collection_date` date NOT NULL,
  `final_collection_date` date NOT NULL,
  `is_closed` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_groups`
--

INSERT INTO `mf_groups` (`id`, `center_id`, `name`, `disp_amount`, `interest`, `no_of_members`, `min_amount`, `min_amt_interest`, `min_amt_week`, `extra_amount`, `extra_amt_interest`, `extra_amt_week`, `first_collection_date`, `final_collection_date`, `is_closed`, `is_delete`, `created`, `updated`) VALUES
(1, 1, 'Loan For Coimbatore', 35000, 10000, 5, 5000, 1500, 20, 5000, 1300, 16, '2016-10-16', '2017-02-26', 0, 0, '2016-10-16 13:52:45', '2016-10-16 13:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `mf_loans`
--

CREATE TABLE `mf_loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `group_id` int(11) NOT NULL,
  `min_amount` float NOT NULL,
  `min_amt_interest` float NOT NULL,
  `min_amt_week` int(11) NOT NULL,
  `min_amt_total` float NOT NULL,
  `extra_amount` float NOT NULL DEFAULT '0',
  `extra_amt_interest` float NOT NULL DEFAULT '0',
  `extra_amt_week` int(11) NOT NULL DEFAULT '0',
  `extra_amt_total` float NOT NULL DEFAULT '0',
  `is_closed` int(11) NOT NULL DEFAULT '0',
  `is_delete` float NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_loans`
--

INSERT INTO `mf_loans` (`id`, `user_id`, `uid`, `group_id`, `min_amount`, `min_amt_interest`, `min_amt_week`, `min_amt_total`, `extra_amount`, `extra_amt_interest`, `extra_amt_week`, `extra_amt_total`, `is_closed`, `is_delete`, `created`, `updated`) VALUES
(1, 3, 'adaeds21q313', 1, 5000, 1500, 20, 6500, 5000, 1300, 16, 6300, 0, 0, '2016-11-23 20:43:36', '2016-11-23 20:43:36'),
(2, 4, 'asdasda21', 1, 5000, 1500, 20, 6500, 0, 0, 0, 0, 0, 0, '2016-11-23 20:50:44', '2016-11-24 20:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `mf_rotations`
--

CREATE TABLE `mf_rotations` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(500) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `payment_amount` float NOT NULL,
  `payment_date` date NOT NULL,
  `closed_date` date NOT NULL,
  `collection_amount` float NOT NULL,
  `balance_amount` float DEFAULT NULL,
  `is_closed` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_rotations`
--

INSERT INTO `mf_rotations` (`id`, `customer_name`, `contact`, `payment_amount`, `payment_date`, `closed_date`, `collection_amount`, `balance_amount`, `is_closed`, `created`, `updated`) VALUES
(1, 'asdasddad', '2312312321', 25000, '2016-11-17', '2016-11-17', 25000, 0, 1, '2016-11-17 07:10:34', '0000-00-00 00:00:00'),
(2, 'asdad asdasdasd', '4131313213', 10, '2016-11-17', '2016-11-17', 10, 0, 1, '2016-11-17 07:19:51', '2016-11-17 07:20:11'),
(3, 'vijay', '8056936599', 90000, '2016-11-29', '2016-11-29', 100000, 0, 1, '2016-11-29 07:24:17', '2016-11-29 07:24:39'),
(4, 'test', '7010419497', 1000, '2016-12-01', '2016-12-01', 1999, 0, 1, '2016-12-01 07:17:47', '2016-12-01 07:18:23'),
(5, 'sASsasdda', '2331313131', 100, '2016-12-01', '2016-12-01', 5643, 0, 1, '2016-12-01 07:19:25', '2016-12-01 07:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `mf_sessions`
--

CREATE TABLE `mf_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '',
  `client_ip` varchar(40) NOT NULL,
  `data` text,
  `expires` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mf_sessions`
--

INSERT INTO `mf_sessions` (`id`, `client_ip`, `data`, `expires`) VALUES
('4biduqd7mpd4lahasht5h22ug1', '', 'Config|a:3:{s:9:"userAgent";s:32:"3a852ce3eb6f781323011a6e54638706";s:4:"time";i:1476610185;s:9:"countdown";i:10;}Message|a:1:{s:4:"auth";a:3:{s:7:"message";s:47:"You are not authorized to access that location.";s:7:"element";s:5:"alert";s:6:"params";a:2:{s:6:"plugin";s:9:"BoostCake";s:5:"class";s:11:"alert-error";}}}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}', 1476610185),
('j7npqnbtm5m3dabqkk60vn96l1', '', 'Config|a:3:{s:9:"userAgent";s:32:"3a852ce3eb6f781323011a6e54638706";s:4:"time";i:1476716585;s:9:"countdown";i:10;}Auth|a:1:{s:8:"redirect";s:17:"/admin/dashboards";}', 1476716585),
('b0bc2f6hkej7nh57voasef9nq2', '', 'Config|a:3:{s:9:"userAgent";s:32:"3a852ce3eb6f781323011a6e54638706";s:4:"time";i:1477215020;s:9:"countdown";i:10;}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}Message|a:0:{}', 1477215020),
('dksdfctdq8d8e4eps4qs0032g0', '', 'Config|a:3:{s:9:"userAgent";s:32:"3a852ce3eb6f781323011a6e54638706";s:4:"time";i:1477792322;s:9:"countdown";i:10;}', 1477792322),
('80hrsu1j418mecjtp71bi91e23', '', 'Config|a:3:{s:9:"userAgent";s:32:"feed0cc1c53b3e959ea9908b7bd7eafe";s:4:"time";i:1479351282;s:9:"countdown";i:10;}Auth|a:1:{s:8:"redirect";s:19:"/admin/Loans/closed";}', 1479351282),
('b7827l5ir1hupunlgdb7boleb5', '', 'Config|a:3:{s:9:"userAgent";s:32:"feed0cc1c53b3e959ea9908b7bd7eafe";s:4:"time";i:1479399356;s:9:"countdown";i:10;}Message|a:1:{s:4:"auth";a:3:{s:7:"message";s:47:"You are not authorized to access that location.";s:7:"element";s:5:"alert";s:6:"params";a:2:{s:6:"plugin";s:9:"BoostCake";s:5:"class";s:11:"alert-error";}}}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}', 1479399356),
('nrfqd19gd88rrj6on18p9i3ga5', '', 'Config|a:3:{s:9:"userAgent";s:32:"feed0cc1c53b3e959ea9908b7bd7eafe";s:4:"time";i:1479921116;s:9:"countdown";i:10;}Message|a:1:{s:4:"auth";a:3:{s:7:"message";s:47:"You are not authorized to access that location.";s:7:"element";s:5:"alert";s:6:"params";a:2:{s:6:"plugin";s:9:"BoostCake";s:5:"class";s:11:"alert-error";}}}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}', 1479921116),
('5ovqnb75ctc1b5o4p5gv6lj2i7', '', 'Config|a:3:{s:9:"userAgent";s:32:"ac28be2f3f169cb1d106d06d264a86f5";s:4:"time";i:1480002060;s:9:"countdown";i:10;}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}Message|a:0:{}', 1480002060),
('l3gttnipnmpo1l4ru3nfqru2a4', '', 'Config|a:3:{s:9:"userAgent";s:32:"ac28be2f3f169cb1d106d06d264a86f5";s:4:"time";i:1480390243;s:9:"countdown";i:10;}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}Message|a:0:{}', 1480390243),
('vbn7r13ku6o994l5id3ih3qi90', '', 'Config|a:3:{s:9:"userAgent";s:32:"ac28be2f3f169cb1d106d06d264a86f5";s:4:"time";i:1480475750;s:9:"countdown";i:10;}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}', 1480475751),
('olldt7rt89dim988ai7p3rr342', '', 'Config|a:3:{s:9:"userAgent";s:32:"ac28be2f3f169cb1d106d06d264a86f5";s:4:"time";i:1480561348;s:9:"countdown";i:10;}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}Message|a:0:{}', 1480561348),
('9ercot4v880f8agrh8a4hnn3f4', '', 'Config|a:3:{s:9:"userAgent";s:32:"ac28be2f3f169cb1d106d06d264a86f5";s:4:"time";i:1480685745;s:9:"countdown";i:10;}Auth|a:1:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}}User|a:2:{s:4:"User";a:14:{s:2:"id";s:1:"1";s:9:"user_type";s:5:"admin";s:4:"name";s:5:"admin";s:5:"email";s:18:"admin@mfinance.com";s:7:"contact";s:0:"";s:7:"address";s:0:"";s:4:"salt";s:22:"GO1cN.aXf6yJSDPNsFJslA";s:14:"password_token";s:0:"";s:22:"password_token_expires";s:19:"0000-00-00 00:00:00";s:8:"password";s:40:"5a1472c8a50a6f2372fc2491c3acf8c9c55387b9";s:9:"is_active";s:1:"1";s:9:"is_delete";s:1:"0";s:7:"created";s:19:"2016-09-27 00:00:00";s:7:"updated";s:19:"2016-10-13 06:57:54";}s:16:"UserProfileImage";a:3:{s:3:"dir";s:10:"1\\62\\93\\64";s:15:"attachment_name";s:9:"logo1.png";s:2:"id";s:1:"1";}}ProfileImage|a:3:{s:15:"attachment_name";s:9:"logo1.png";s:3:"dir";s:10:"1\\62\\93\\64";s:2:"id";s:1:"1";}Message|a:0:{}', 1480685745);

-- --------------------------------------------------------

--
-- Table structure for table `mf_users`
--

CREATE TABLE `mf_users` (
  `id` int(11) NOT NULL,
  `user_type` enum('admin','subadmin','customer') NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `contact` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `salt` varchar(500) DEFAULT NULL,
  `password_token` text,
  `password_token_expires` datetime DEFAULT NULL,
  `password` text,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_users`
--

INSERT INTO `mf_users` (`id`, `user_type`, `name`, `email`, `contact`, `address`, `salt`, `password_token`, `password_token_expires`, `password`, `is_active`, `is_delete`, `created`, `updated`) VALUES
(1, 'admin', 'admin', 'admin@mfinance.com', '', '', 'GO1cN.aXf6yJSDPNsFJslA', '', '0000-00-00 00:00:00', '5a1472c8a50a6f2372fc2491c3acf8c9c55387b9', 1, 0, '2016-09-27 00:00:00', '2016-10-13 06:57:54'),
(2, 'admin', 'sundar', 'sundar@gmail.com', '', 'Coimbatore', 'he9TNjBq5rNDYRWnHoozS1', '', NULL, '91e842fcc8244911fea2362d25b8f8bebeb29122', 1, 0, '2016-10-09 00:00:00', '2016-10-09 07:13:04'),
(3, 'customer', 'Sundara Moorthi', 'sundarwamp@gmail.com', '8056936599', '285, Mariyamman koil street, Malayappalayam road, Nambiyur, Gobi, Erode, 638458\r\n31/3D, Ramanujam nagar, Upplilipalayam, Coimbatore, 641015', NULL, NULL, NULL, NULL, 1, 0, '2016-09-28 07:01:01', '2016-10-09 07:13:13'),
(4, 'customer', 'vijay', '', '7010419497', '285, Mariyamman koil street, Malayappalayam road, Nambiyur, Gobi, Erode, 638458\r\n31/3D, Ramanujam nagar, Upplilipalayam, Coimbatore, 641015', NULL, NULL, NULL, NULL, 1, 0, '2016-10-16 10:35:22', '2016-10-16 10:35:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mf_attachments`
--
ALTER TABLE `mf_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_centers`
--
ALTER TABLE `mf_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_dues`
--
ALTER TABLE `mf_dues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_groups`
--
ALTER TABLE `mf_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_loans`
--
ALTER TABLE `mf_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_rotations`
--
ALTER TABLE `mf_rotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_users`
--
ALTER TABLE `mf_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mf_attachments`
--
ALTER TABLE `mf_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mf_centers`
--
ALTER TABLE `mf_centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mf_dues`
--
ALTER TABLE `mf_dues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mf_groups`
--
ALTER TABLE `mf_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mf_loans`
--
ALTER TABLE `mf_loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mf_rotations`
--
ALTER TABLE `mf_rotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mf_users`
--
ALTER TABLE `mf_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
