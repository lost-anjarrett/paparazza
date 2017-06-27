-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Lun 26 Juin 2017 à 18:46
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `paparazza`
--

-- --------------------------------------------------------

--
-- Structure de la table `ppz_admin`
--

CREATE TABLE `ppz_admin` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8_unicode_ci NOT NULL,
  `doc` datetime NOT NULL,
  `last_connexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ppz_admin`
--

INSERT INTO `ppz_admin` (`id`, `name`, `password`, `doc`, `last_connexion`) VALUES
(3, 'ppzadmin', '$2y$10$3R694GUE3BM/A6WdfSDlReIpVp13ACxx9nuWOtpPWQQgJ8bTddzT.', '2017-06-15 11:06:10', '2017-06-26 15:32:46'),
(4, 'fripouille', '$2y$10$YyhUF/d0P/M/ra.Hs4LD5eU9NDhBbjauTLU8Ksaf2nawdQV/emE4K', '2017-06-19 14:32:05', NULL),
(5, 'testeur', '$2y$10$pDpnm.8H95T7W1W0z4aTbeRc.PUgC04Q6UCF7gdprx6oHZRPwKQ56', '2017-06-19 14:58:04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ppz_gallery_img`
--

CREATE TABLE `ppz_gallery_img` (
  `id` int(11) NOT NULL,
  `img_src` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show` int(1) NOT NULL DEFAULT '1',
  `added_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ppz_gallery_img`
--

INSERT INTO `ppz_gallery_img` (`id`, `img_src`, `description`, `show`, `added_at`) VALUES
(2, 'sh7M8Bj413giNfQoLkad.png', 'PEOPLE HAVING FUN', 1, '0000-00-00 00:00:00'),
(3, 'CMPbT6vCrAc8lXA4RwPB.png', 'PEOPLE HAVING FUN', 1, '0000-00-00 00:00:00'),
(4, 'CN6cpG5ijR2iI3ubfTAA.png', 'PEOPLE HAVING FUN', 1, '0000-00-00 00:00:00'),
(5, 'Xuoc9jgtV0H6KSnflMQB.png', 'petit paumé', 1, '0000-00-00 00:00:00'),
(6, 'WyEEcANdi7PJf2Vjh8Lg.png', 'PEOPLE HAVING FUN', 1, '0000-00-00 00:00:00'),
(7, 'u6a8wtxQTzzw6e99S1po.png', 'PEOPLE HAVING FUN', 1, '0000-00-00 00:00:00'),
(8, '54qAMtgbgsWoO3taKdPG.png', 'people having fun', 1, '0000-00-00 00:00:00'),
(9, 'NDpMTNK0QcPcMnucetCx.png', 'PEOPLE HAVING FUN', 1, '0000-00-00 00:00:00'),
(10, 'NvlKKIhU7seTMO4gmC8m.png', 'petit paumé', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `ppz_infos`
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
-- Contenu de la table `ppz_infos`
--

INSERT INTO `ppz_infos` (`id`, `email`, `tel1`, `tel2`, `adress1`, `complt_adress1`, `cp1`, `city1`, `adress2`, `complt_adress2`, `cp2`, `city2`) VALUES
(1, 'contact@paparazza.fr', '06 70 53 48 90', NULL, 'Pôle Pixel, 26 rue Emile Decorps', 'Bâtiment Minoterie', '69100', 'Villeurbanne', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ppz_products`
--

CREATE TABLE `ppz_products` (
  `id` int(4) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `anchor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `appearance_order` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ppz_products_img`
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
-- Structure de la table `ppz_products_logos`
--

CREATE TABLE `ppz_products_logos` (
  `id` int(11) NOT NULL,
  `img_src` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(4) NOT NULL,
  `description` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ppz_slider_img`
--

CREATE TABLE `ppz_slider_img` (
  `id` int(11) NOT NULL,
  `img_src` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Contenu de la table `ppz_slider_img`
--

INSERT INTO `ppz_slider_img` (`id`, `img_src`, `description`) VALUES
(16, 'XqTbxFyK7jpiHEFGHrva.png', 'people having fun'),
(17, 'tXBawnunLtapYGMtFcx0.png', 'Daft Punk'),
(18, 'lvNJpIKMIS741S0XAGy5.png', 'stormtroopers'),
(19, 'Q6HHTwEp4dcFWYfqn7RQ.png', 'Daft Punk');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ppz_admin`
--
ALTER TABLE `ppz_admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ppz_gallery_img`
--
ALTER TABLE `ppz_gallery_img`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ppz_infos`
--
ALTER TABLE `ppz_infos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ppz_products`
--
ALTER TABLE `ppz_products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ppz_products_img`
--
ALTER TABLE `ppz_products_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `ppz_products_logos`
--
ALTER TABLE `ppz_products_logos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `ppz_slider_img`
--
ALTER TABLE `ppz_slider_img`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ppz_admin`
--
ALTER TABLE `ppz_admin`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `ppz_gallery_img`
--
ALTER TABLE `ppz_gallery_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `ppz_infos`
--
ALTER TABLE `ppz_infos`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ppz_products`
--
ALTER TABLE `ppz_products`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ppz_products_img`
--
ALTER TABLE `ppz_products_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ppz_products_logos`
--
ALTER TABLE `ppz_products_logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ppz_slider_img`
--
ALTER TABLE `ppz_slider_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ppz_products_img`
--
ALTER TABLE `ppz_products_img`
  ADD CONSTRAINT `ppz_products_img_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `ppz_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ppz_products_logos`
--
ALTER TABLE `ppz_products_logos`
  ADD CONSTRAINT `ppz_products_logos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `ppz_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
