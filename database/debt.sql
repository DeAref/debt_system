-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2022 at 03:12 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipir_debt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(80) NOT NULL,
  `name` varchar(90) NOT NULL,
  `lName` varchar(180) NOT NULL,
  `countOfDept` int(11) DEFAULT NULL,
  `profilePicture` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`, `name`, `lName`, `countOfDept`, `profilePicture`) VALUES
(1, 'aref', '3a824154b16ed7dab899bf000b80eeee', 'superAdmin', 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 8, '../uploads/2022.jpg'),
(2, 'ali', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'علی', 'سلیمانی', NULL, 'https://www.toptoop.ir/files/images/99-azar/toptoop-1403131679.jpg'),
(3, 'amir', '81dc9bdb52d04dc20036dbd8313ed055', 'dev', 'امیر', 'محمدی', NULL, '../uploads/279226293_698797364890616_1850092036319561766_n.jpg'),
(6, 'saied', '81dc9bdb52d04dc20036dbd8313ed055', 'adminBank', 'Ù…Ø¯ÛŒØ± Ø³Ø¹ÛŒØ¯', 'Ø³Ø¹ÛŒØ¯ÛŒ', NULL, '../uploads/8774photo_2022-06-07_18-43-33.jpg'),
(7, 'aaa', '52d01b988b54f6c9b295029fc6f8d478', 'superAdmin', 'aref', 'soli', NULL, '../uploads/81032315784835365812949.webp');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `Ticket_ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `Text` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `Ticket_ID`, `date`, `name`, `Text`) VALUES
(1, 4, '2022-06-09', 'ادمین یک', 'از وظیقفه شناسی شما ممنونیم \r\n\r\nما رسیدگی میکنیم'),
(2, 4, '2022-06-08', 'johnDoe', 'test english'),
(3, 4, '2022-06-23', 'Ø¹Ø§Ø±Ù.Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', '<p>20202020200</p>'),
(4, 4, '2022-06-23', 'Ø¹Ø§Ø±Ù Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', '<blockquote><p>Ù¾Ø§Ø³Ø® Ø´Ù…Ø§</p></blockquote>'),
(5, 4, '2022-06-23', 'Ø¹Ø§Ø±Ù Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', '<h2>Ù¾Ø§Ø³Ø® Ø´Ù…Ø§</h2>'),
(6, 4, '2022-06-24', 'Ù…Ø¯ÛŒØ± Ø³Ø¹ÛŒØ¯ سلیمانی', '<p>تست فارسی</p>'),
(7, 1, '2022-07-03', 'test testi', '<p>Ø§Ùˆ Ù…Ø§ÛŒ Ú¯Ø§Ø¯&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deptValue` int(11) NOT NULL,
  `monthCount` int(11) NOT NULL,
  `unPayed` int(11) NOT NULL,
  `payed` int(11) NOT NULL,
  `amountPerMonth` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `date` date NOT NULL DEFAULT '2022-06-06'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id`, `user_id`, `deptValue`, `monthCount`, `unPayed`, `payed`, `amountPerMonth`, `status`, `date`) VALUES
(38, 3, 20000000, 6, 6, 1, 3333333, 1, '2022-06-22'),
(37, 3, 10000000, 24, 24, 0, 416667, 0, '2022-06-22'),
(36, 3, 10000000, 24, 24, 1, 416667, 1, '2022-06-22'),
(35, 3, 10000000, 12, 12, 1, 833333, 1, '2022-06-22'),
(34, 3, 30000000, 24, 24, 0, 1250000, 1, '2022-06-22'),
(33, 19, 30000000, 6, 6, 5, 5000000, 1, '2022-06-20'),
(39, 19, 10000000, 12, 12, 0, 833333, 2, '2022-07-03'),
(40, 17, 20000000, 12, 12, 0, 1666667, 2, '2022-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `paymentCode` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `date` date NOT NULL DEFAULT '2022-12-12',
  `price` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `installments` int(11) DEFAULT NULL,
  `payed` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `dept_id`, `paymentCode`, `date`, `price`, `paid`, `installments`, `payed`) VALUES
(99, 3, 38, '26eCHOeOhm84', '2022-06-23', 3333333, 0, 2, NULL),
(98, 3, 36, '60pFOjtyt536', '2022-06-22', 416667, 1, 1, NULL),
(97, 3, 34, '409JXAHe0X47', '2022-06-22', 1250000, 0, 1, NULL),
(96, 3, 38, '80R22321vP76', '2022-06-22', 3333333, 1, 1, NULL),
(95, 3, 35, '51KjCGq5AY6', '2022-06-22', 833333, 1, 1, NULL),
(85, 19, 33, '73axeAIMQk5', '2022-06-22', 5000000, 1, 2, NULL),
(80, 19, 33, '56HQLUpE2h39', '2022-06-20', 5000000, 1, 1, NULL),
(92, 19, 33, '29EMlGFMDt2', '2022-06-22', 5000000, 1, 4, NULL),
(93, 19, 33, '38zQSqCtDk94', '2022-06-22', 5000000, 1, 5, NULL),
(89, 19, 33, '65rXtN1riY48', '2022-06-22', 5000000, 1, 3, NULL),
(94, 19, 33, '880wKJueNd12', '2022-06-22', 5000000, 0, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `ticket_status` int(11) NOT NULL DEFAULT '0',
  `ticket_creation_date` date NOT NULL,
  `label` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `Text` text COLLATE utf8_persian_ci,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `ticket_status`, `ticket_creation_date`, `label`, `Text`, `user_id`) VALUES
(1, 1, '2022-06-01', 'test', 'texts test', 19),
(2, 2, '2022-06-23', 'dddd', '<p>ddddd</p>', 3),
(3, 0, '2022-06-23', 'dddd', '<h2>Ø³Ù„Ø§Ù… Ùˆ Ø®Ø³ØªÙ‡ Ù†Ø¨Ø§Ø´ÛŒØ¯ Ø®Ø¯Ù…Øª Ú©Ø§Ø±Ù…Ù†Ø¯Ø§Ù† Ø¨Ø§Ù†Ú©</h2><p>&nbsp;</p><p>Ø§ÛŒÙ† Ø¬Ø§Ù†Ø¨ Ø¯Ø± Ø§ÛŒÙ† <strong>ØªÛŒÚ©Øª </strong>Ø¨Ù‡ Ø´Ù…Ø§ Ø®ÙˆØ§Ù‡Ù… Ú¯ÙØª Ú†Ú¯ÙˆÙ†Ù‡ Ù…ÛŒØªÙˆØ§Ù†ÛŒØ¯ Ø§Ø² Ù‚Ø§Ø¨Ù„ÛŒØª Ù‡Ø§ÛŒ Ø§ÛŒÙ† Ø³Ø§Ù…Ø§Ù†Ù‡ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ú©Ù†ÛŒØ¯</p><p>&nbsp;</p><p>&nbsp;</p>', 3),
(4, 1, '2022-06-23', 'Ø§ÙˆÙ„ÛŒÙ† ØªÛŒÚ©Øª Ø¯Ø± Ø³Ø§Ù…Ø§Ù†Ù‡ Ù…Ø¯ÛŒØ±ÛŒØª ÙˆØ§Ù…', '<p>eeeeeeeee</p>', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_persian_ci NOT NULL,
  `lName` varchar(120) COLLATE utf8_persian_ci NOT NULL,
  `nCode` int(11) NOT NULL,
  `fatherName` varchar(80) COLLATE utf8_persian_ci NOT NULL,
  `bDate` date NOT NULL,
  `profilePicture` text COLLATE utf8_persian_ci NOT NULL,
  `password` text COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `lName`, `nCode`, `fatherName`, `bDate`, `profilePicture`, `password`, `email`) VALUES
(1, 'Ø¹Ø§Ø±Ù', 'رضا', 222, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '1399-10-10', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 'arefaa@ad.isw'),
(2, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 0, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '1399-10-10', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 'arefkiii@jhj.ir'),
(3, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 5455522, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '1399-10-10', '../uploads/95872315784835410557653.webp', '81dc9bdb52d04dc20036dbd8313ed055', 'aref@post.ir'),
(16, 'Ø±Ø¶Ø§', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 1856223045, 'Ø§Ú©Ø¨Ø±', '2020-02-02', '../uploads/48872315784835365812949.webp', 'd683533d66f266d524cbf68d5df0ee9c', 'arefsolaimany@outlook.com'),
(5, 'Ø­Ø³Ù†', 'Ù…Ù…Ø¯ÛŒ', 5352, 'Ø§Ø­Ù…Ø¯', '2022-05-11', 'https://google.com', '1111b59c67bf196a4758191e42f76670ceba', 'a@2b.c'),
(6, 'jsj', 'ØªØ³ØªØ³ÛŒ', 251, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2020-02-01', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freepik.com%2Fphotos%2Fmen&psig=AOvVaw24gS-Re-n10y1-8drtVKUH&ust=1652428556276000&source=images&cd=vfe&ved=0CAwQjRxqFwoTCKDHqJe-2fcCFQAAAAAdAAAAABAJ', '81dc9bdb52d04dc20036dbd8313ed055', 'gag@f.com'),
(7, 'Ù…Ø­Ù…Ø¯ Ø­Ø³Ù† ', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 22223, 'Ø§Ú©Ø¨Ø±', '2022-03-04', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '1e48c4420b7073bc11916c6c1de226bb', 'aref@hpost.ir'),
(8, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 654, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2020-01-10', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '698d51a19d8a121ce581499d7b701668', 'ar11ef@post.ir'),
(9, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 12, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2020-10-01', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', 'b59c67bf196a4758191e42f76670ceba', 'aref1@post.i1r'),
(10, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 2131, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2022-02-12', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', 'b59c67bf196a4758191e42f76670ceba', '1111@111.q'),
(11, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 1014, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2020-02-02', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '934b535800b1cba8f96a5d72f72f1611', 'a2ref@p2o2st.ir'),
(12, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 3322, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2020-02-01', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', 'b59c67bf196a4758191e42f76670ceba', 'are2f@2pos2.ir'),
(13, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 2228, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2020-02-02', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 'are20f@0post.ir'),
(14, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 22210, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2020-02-02', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '7e16036a55664f22e6511e460ee09d4f', 'ar02ef@p202ost.ir'),
(15, 'Ø¹Ø§Ø±Ù', 'Ø³Ù„ÛŒÙ…Ø§Ù†ÛŒ', 2213, 'Ù¾Ø¯Ø± ØªØ³ØªÛŒ', '2020-02-01', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '934b535800b1cba8f96a5d72f72f1611', 'ar2ef2@p2st.ir'),
(17, 'amir mmad ', 'akbari', 52503346, 'akbar', '1380-08-02', 'https://s6.uupload.ir/files/photo_2022-05-13_22-39-17_dfc0.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 'mail@Dw.com'),
(18, 'ÛŒÚ©ØªØ§', 'Ù¾Ø§Ø±Ø³ÛŒØ§Ù†', 2323, 'Ø¹Ù„ÛŒ', '1395-10-01', '../uploads/unnamed (1).jpg', 'ec6a6536ca304edf844d1d248a4f08dc', 'Asd@edw.dd'),
(19, 'test', 'testi', 222111000, 'twstani', '2022-08-02', '../uploads/1248699183785253087766.webp', '7b7a53e239400a13bd6be6c91c4f6c4e', 'test@test.ti');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paymentCode` (`paymentCode`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nCode` (`nCode`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
