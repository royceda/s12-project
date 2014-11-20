DROP DATABASE rrl_test;

CREATE DATABASE rrl_test;

USE rrl_test;

-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 18 Novembre 2014 à 18:40
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `rrl_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(12) NOT NULL,
  `rue` varchar(16) NOT NULL,
  `code_postal` int(5) NOT NULL,
  `pays` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

CREATE TABLE IF NOT EXISTS `catalogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(12) CHARACTER SET utf8 NOT NULL,
  `maj` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `code_promo`
--

CREATE TABLE IF NOT EXISTS `code_promo` (
  `ncl` int(11) NOT NULL,
  `pourcentage` int(11) NOT NULL,
  `ncmd` int(11) DEFAULT NULL,
  KEY `ncl` (`ncl`),
  KEY `ncmd` (`ncmd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nprod` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `nclient` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `nprod` (`nprod`),
  KEY `nclient` (`nclient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `expedition`
--

CREATE TABLE IF NOT EXISTS `expedition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addr` int(11) NOT NULL,
  `dexp` date DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `addr` (`addr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `prenom` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `mail` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `telephone` int(10) DEFAULT NULL,
  `adresse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `adresse` (`adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL,
  `designation` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `descriptif` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `disponible` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `catalogue` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `catalogue` (`catalogue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalogue` int(11) DEFAULT NULL,
  `reduction` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `catalogue` (`catalogue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `code_promo`
--
ALTER TABLE `code_promo`
  ADD CONSTRAINT `code_promo_ibfk_1` FOREIGN KEY (`ncl`) REFERENCES `membre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `code_promo_ibfk_2` FOREIGN KEY (`ncmd`) REFERENCES `commande` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`nprod`) REFERENCES `produit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`nclient`) REFERENCES `membre` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `expedition`
--
ALTER TABLE `expedition`
  ADD CONSTRAINT `expedition_ibfk_1` FOREIGN KEY (`addr`) REFERENCES `adresse` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `membre_ibfk_1` FOREIGN KEY (`adresse`) REFERENCES `adresse` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`catalogue`) REFERENCES `catalogue` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `promo_ibfk_1` FOREIGN KEY (`catalogue`) REFERENCES `catalogue` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
