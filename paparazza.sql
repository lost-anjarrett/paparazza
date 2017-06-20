-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2017 at 11:01 AM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paparazza`
--

-- --------------------------------------------------------

--
-- Table structure for table `ppz_admin`
--

CREATE TABLE `ppz_admin` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8_unicode_ci NOT NULL,
  `doc` datetime NOT NULL,
  `last_connexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ppz_admin`
--

INSERT INTO `ppz_admin` (`id`, `name`, `password`, `doc`, `last_connexion`) VALUES
(3, 'ppzadmin', '$2y$10$3R694GUE3BM/A6WdfSDlReIpVp13ACxx9nuWOtpPWQQgJ8bTddzT.', '2017-06-15 11:06:10', '2017-06-19 14:16:35'),
(4, 'fripouille', '$2y$10$YyhUF/d0P/M/ra.Hs4LD5eU9NDhBbjauTLU8Ksaf2nawdQV/emE4K', '2017-06-19 14:32:05', NULL),
(5, 'testeur', '$2y$10$pDpnm.8H95T7W1W0z4aTbeRc.PUgC04Q6UCF7gdprx6oHZRPwKQ56', '2017-06-19 14:58:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ppz_gallery_img`
--

CREATE TABLE `ppz_gallery_img` (
  `id` int(11) NOT NULL,
  `img_src` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show` int(1) NOT NULL DEFAULT '1',
  `added_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppz_infos`
--

CREATE TABLE `ppz_infos` (
  `id` int(1) NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `tel1` char(14) COLLATE utf8_unicode_ci NOT NULL,
  `tel2` char(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress1` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `complt_adress1` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp1` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `city1` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `adress2` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complt_adress2` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp2` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city2` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ppz_infos`
--

INSERT INTO `ppz_infos` (`id`, `email`, `tel1`, `tel2`, `adress1`, `complt_adress1`, `cp1`, `city1`, `adress2`, `complt_adress2`, `cp2`, `city2`) VALUES
(1, 'contact@paparazza.fr', '06 70 53 48 90', NULL, 'Pôle Pixel, 26 rue Emile Decorps', 'Bâtiment Minoterie', '69100', 'Villeurbanne', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ppz_products`
--

CREATE TABLE `ppz_products` (
  `id` int(4) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `anchor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `appearance_order` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppz_products_img`
--

CREATE TABLE `ppz_products_img` (
  `id` int(11) NOT NULL,
  `img_src` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(4) NOT NULL,
  `main_img` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppz_products_logos`
--

CREATE TABLE `ppz_products_logos` (
  `id` int(11) NOT NULL,
  `img_src` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(4) NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppz_slider_img`
--

CREATE TABLE `ppz_slider_img` (
  `id` int(11) NOT NULL,
  `img_src` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ppz_admin`
--
ALTER TABLE `ppz_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppz_gallery_img`
--
ALTER TABLE `ppz_gallery_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppz_infos`
--
ALTER TABLE `ppz_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppz_products`
--
ALTER TABLE `ppz_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppz_products_img`
--
ALTER TABLE `ppz_products_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `ppz_products_logos`
--
ALTER TABLE `ppz_products_logos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ppz_admin`
--
ALTER TABLE `ppz_admin`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ppz_gallery_img`
--
ALTER TABLE `ppz_gallery_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ppz_infos`
--
ALTER TABLE `ppz_infos`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ppz_products`
--
ALTER TABLE `ppz_products`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ppz_products_img`
--
ALTER TABLE `ppz_products_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ppz_products_logos`
--
ALTER TABLE `ppz_products_logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ppz_products_img`
--
ALTER TABLE `ppz_products_img`
  ADD CONSTRAINT `ppz_products_img_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `ppz_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ppz_products_logos`
--
ALTER TABLE `ppz_products_logos`
  ADD CONSTRAINT `ppz_products_logos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `ppz_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
