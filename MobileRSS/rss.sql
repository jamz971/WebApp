-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Sam 11 Août 2012 à 01:46
-- Version du serveur: 5.5.15
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `flux_rss`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_categorie` (`nom_categorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
(1, 'cinema'),
(2, 'culture'),
(3, 'immobilier'),
(4, 'international'),
(5, 'sport'),
(6, 'style'),
(7, 'sante'),
(8, 'societe'),
(9, 'mode'),
(10, 'sciences'),
(11, 'economie'),
(12, 'education'),
(13, 'politique'),
(14, 'informatique'),
(15, 'jeux videos');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `categ` int(11) DEFAULT NULL COMMENT 'en ref à id de la table categorie',
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`url`),
  UNIQUE KEY `nom_site` (`nom`),
  UNIQUE KEY `url` (`url`),
  KEY `id_categ` (`categ`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `site`
--

INSERT INTO `site` (`id`, `nom`, `categ`, `url`) VALUES
(1, 'lemonde international', 4, 'http://www.lemonde.fr/rss/tag/international.xml'),
(2, 'lemonde sciences', 10, 'http://www.lemonde.fr/rss/tag/sciences.xml'),
(3, 'lemonde sport', 5, 'http://www.lemonde.fr/rss/tag/sport.xml'),
(4, 'lemonde politique', 13, 'http://www.lemonde.fr/rss/tag/politique.xml'),
(5, 'Le Mag de jeu video', 15, 'http://fluxrss.fr/actualite/redirect?code=xEfPXf2yvi'),
(6, 'Julsa', 15, 'http://fluxrss.fr/actualite/redirect?code=zdvNWEwQM2'),
(7, 'aetuts+', 12, 'http://feeds.feedburner.com/aetuts'),
(8, 'Gizmodo', 13, 'http://www.gizmodo.fr/feed'),
(9, 'psdtuts', 12, 'http://feeds.feedburner.com/psdtuts');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
