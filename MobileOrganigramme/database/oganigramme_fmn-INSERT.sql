-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Jeu 19 Avril 2012 à 05:34
-- Version du serveur: 5.5.15
-- Version de PHP: 5.3.8

SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `oganigramme_fmn`
--

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `employe_id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_nom` varchar(25) NOT NULL,
  `employe_prenom` varchar(25) NOT NULL,
  `employe_chef` int(11) DEFAULT NULL COMMENT 'id du superviseur',
  `employe_poste` int(11) NOT NULL,
  `employe_departement` varchar(50) NOT NULL,
  `employe_tel_bureau` varchar(10) DEFAULT NULL,
  `employe_port` varchar(10) DEFAULT NULL,
  `employe_mail` varchar(50) NOT NULL,
  `employe_ville` varchar(50) DEFAULT NULL,
  `employe_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`employe_id`),
  KEY `employe_poste` (`employe_poste`)
) TYPE=InnoDB  AUTO_INCREMENT=14 ;

--
-- Contenu de la table `employe`
--

INSERT INTO `employe` (`employe_id`, `employe_nom`, `employe_prenom`, `employe_chef`, `employe_poste`, `employe_departement`, `employe_tel_bureau`, `employe_port`, `employe_mail`, `employe_ville`, `employe_image`) VALUES
(1, 'TAYLOR', 'Franck', 0, 1, 'Direction', '0590811260', '0690894523', 'francktaylor@gmail.com', 'Basse-Terre', 'franck_taylor.jpg'),
(2, 'HASTON', 'Martin', 1, 2, 'Direction', '0590811261', '069056217', 'haston_martin@gmail.com', 'Basse-Terre', 'martin_haston.jpg'),
(3, 'CRUZ', 'Laura', 1, 3, 'Commercial', '0590811270', '0690523212', 'laulaucruz@gmail.com', 'Abymes', 'laura_cruz.jpg'),
(4, 'PEREZ', 'Sarah', 1, 4, 'Informatique', '0590811280', '0690223523', 'sarahP@gmail.com', 'Saint-Rose', 'sarah_perez.jpg'),
(5, 'THOMSON', 'Gary', 1, 5, 'Ventes', '0590811266', '0690242414', 'garythomson@gmail.com', 'Gosier', 'gary_thomson.jpg'),
(6, 'MOORE', 'Ray', 5, 6, 'Ventes', '0590811291', '0690242919', 'raymoore@gmail.com', 'Abymes', 'ray_moore.jpg'),
(7, 'WILLIAMS', 'John', 4, 7, 'Informatique', '0590811281', '0690242882', 'will_joh@gmail.com', 'Gosier', 'john_williams.jpg'),
(8, 'ZYAOU', 'Lisa', 12, 7, 'Informatique', '0590811283', '0690586414', 'lisz@gmail.com', 'Saint-Rose', 'lisa_zyaou.jpg'),
(9, 'LEE', 'Eugene', 3, 8, 'Commercial', '0590811285', '0690539854', 'eugenelee@gmail.com', 'Jarry', 'eugene_lee.jpg'),
(10, 'FLENDERS', 'Toby', 3, 8, 'Commercial', '0590811032', '0690811032', 'tobyflenders@gmail.com', 'Petit-Bourg', 'Toby_FLENDERS.jpg'),
(11, 'Beesly', 'pamela', 5, 6, 'Ventes', '', '', 'pamelab@gmail.com', 'Petit-Bourg', 'pamela_Beesly.jpg'),
(12, 'BRATON', 'Creed', 1, 4, 'Informatique', '0590811045', '0690811452', 'Creedb@gmail.com', 'Abymes', 'Creed_BRATON.jpg'),
(13, 'Kapoor', 'Kelly', 2, 9, 'Direction', '0590811052', '0690811052', 'kellykapoor@gmail.com', 'Saint-Claude', 'Kelly_Kapoor.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

DROP TABLE IF EXISTS `fonction`;
CREATE TABLE IF NOT EXISTS `fonction` (
  `id_fonction` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fonction` varchar(50) NOT NULL,
  PRIMARY KEY (`id_fonction`),
  UNIQUE KEY `nom_fonction` (`nom_fonction`)
) TYPE=InnoDB  AUTO_INCREMENT=10 ;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`id_fonction`, `nom_fonction`) VALUES
(8, 'Agent Commercial'),
(4, 'Chef de Projet'),
(5, 'Directeur des Ventes'),
(3, 'Directrice Commercial'),
(7, 'Ingenieur'),
(1, 'President Directeur General CEO'),
(9, 'Secretaire'),
(6, 'Vendeur'),
(2, 'Vice Directeur');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`employe_poste`) REFERENCES `fonction` (`id_fonction`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
