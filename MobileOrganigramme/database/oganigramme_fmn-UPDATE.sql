-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Jeu 19 Avril 2012 à 05:35
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

UPDATE `employe` SET `employe_id` = 1,`employe_nom` = 'TAYLOR',`employe_prenom` = 'Franck',`employe_chef` = 0,`employe_poste` = 1,`employe_departement` = 'Direction',`employe_tel_bureau` = '0590811260',`employe_port` = '0690894523',`employe_mail` = 'francktaylor@gmail.com',`employe_ville` = 'Basse-Terre',`employe_image` = 'franck_taylor.jpg' WHERE `employe`.`employe_id` = 1;
UPDATE `employe` SET `employe_id` = 2,`employe_nom` = 'HASTON',`employe_prenom` = 'Martin',`employe_chef` = 1,`employe_poste` = 2,`employe_departement` = 'Direction',`employe_tel_bureau` = '0590811261',`employe_port` = '069056217',`employe_mail` = 'haston_martin@gmail.com',`employe_ville` = 'Basse-Terre',`employe_image` = 'martin_haston.jpg' WHERE `employe`.`employe_id` = 2;
UPDATE `employe` SET `employe_id` = 3,`employe_nom` = 'CRUZ',`employe_prenom` = 'Laura',`employe_chef` = 1,`employe_poste` = 3,`employe_departement` = 'Commercial',`employe_tel_bureau` = '0590811270',`employe_port` = '0690523212',`employe_mail` = 'laulaucruz@gmail.com',`employe_ville` = 'Abymes',`employe_image` = 'laura_cruz.jpg' WHERE `employe`.`employe_id` = 3;
UPDATE `employe` SET `employe_id` = 4,`employe_nom` = 'PEREZ',`employe_prenom` = 'Sarah',`employe_chef` = 1,`employe_poste` = 4,`employe_departement` = 'Informatique',`employe_tel_bureau` = '0590811280',`employe_port` = '0690223523',`employe_mail` = 'sarahP@gmail.com',`employe_ville` = 'Saint-Rose',`employe_image` = 'sarah_perez.jpg' WHERE `employe`.`employe_id` = 4;
UPDATE `employe` SET `employe_id` = 5,`employe_nom` = 'THOMSON',`employe_prenom` = 'Gary',`employe_chef` = 1,`employe_poste` = 5,`employe_departement` = 'Ventes',`employe_tel_bureau` = '0590811266',`employe_port` = '0690242414',`employe_mail` = 'garythomson@gmail.com',`employe_ville` = 'Gosier',`employe_image` = 'gary_thomson.jpg' WHERE `employe`.`employe_id` = 5;
UPDATE `employe` SET `employe_id` = 6,`employe_nom` = 'MOORE',`employe_prenom` = 'Ray',`employe_chef` = 5,`employe_poste` = 6,`employe_departement` = 'Ventes',`employe_tel_bureau` = '0590811291',`employe_port` = '0690242919',`employe_mail` = 'raymoore@gmail.com',`employe_ville` = 'Abymes',`employe_image` = 'ray_moore.jpg' WHERE `employe`.`employe_id` = 6;
UPDATE `employe` SET `employe_id` = 7,`employe_nom` = 'WILLIAMS',`employe_prenom` = 'John',`employe_chef` = 4,`employe_poste` = 7,`employe_departement` = 'Informatique',`employe_tel_bureau` = '0590811281',`employe_port` = '0690242882',`employe_mail` = 'will_joh@gmail.com',`employe_ville` = 'Gosier',`employe_image` = 'john_williams.jpg' WHERE `employe`.`employe_id` = 7;
UPDATE `employe` SET `employe_id` = 8,`employe_nom` = 'ZYAOU',`employe_prenom` = 'Lisa',`employe_chef` = 12,`employe_poste` = 7,`employe_departement` = 'Informatique',`employe_tel_bureau` = '0590811283',`employe_port` = '0690586414',`employe_mail` = 'lisz@gmail.com',`employe_ville` = 'Saint-Rose',`employe_image` = 'lisa_zyaou.jpg' WHERE `employe`.`employe_id` = 8;
UPDATE `employe` SET `employe_id` = 9,`employe_nom` = 'LEE',`employe_prenom` = 'Eugene',`employe_chef` = 3,`employe_poste` = 8,`employe_departement` = 'Commercial',`employe_tel_bureau` = '0590811285',`employe_port` = '0690539854',`employe_mail` = 'eugenelee@gmail.com',`employe_ville` = 'Jarry',`employe_image` = 'eugene_lee.jpg' WHERE `employe`.`employe_id` = 9;
UPDATE `employe` SET `employe_id` = 10,`employe_nom` = 'FLENDERS',`employe_prenom` = 'Toby',`employe_chef` = 3,`employe_poste` = 8,`employe_departement` = 'Commercial',`employe_tel_bureau` = '0590811032',`employe_port` = '0690811032',`employe_mail` = 'tobyflenders@gmail.com',`employe_ville` = 'Petit-Bourg',`employe_image` = 'Toby_FLENDERS.jpg' WHERE `employe`.`employe_id` = 10;
UPDATE `employe` SET `employe_id` = 11,`employe_nom` = 'Beesly',`employe_prenom` = 'pamela',`employe_chef` = 5,`employe_poste` = 6,`employe_departement` = 'Ventes',`employe_tel_bureau` = '',`employe_port` = '',`employe_mail` = 'pamelab@gmail.com',`employe_ville` = 'Petit-Bourg',`employe_image` = 'pamela_Beesly.jpg' WHERE `employe`.`employe_id` = 11;
UPDATE `employe` SET `employe_id` = 12,`employe_nom` = 'BRATON',`employe_prenom` = 'Creed',`employe_chef` = 1,`employe_poste` = 4,`employe_departement` = 'Informatique',`employe_tel_bureau` = '0590811045',`employe_port` = '0690811452',`employe_mail` = 'Creedb@gmail.com',`employe_ville` = 'Abymes',`employe_image` = 'Creed_BRATON.jpg' WHERE `employe`.`employe_id` = 12;
UPDATE `employe` SET `employe_id` = 13,`employe_nom` = 'Kapoor',`employe_prenom` = 'Kelly',`employe_chef` = 2,`employe_poste` = 9,`employe_departement` = 'Direction',`employe_tel_bureau` = '0590811052',`employe_port` = '0690811052',`employe_mail` = 'kellykapoor@gmail.com',`employe_ville` = 'Saint-Claude',`employe_image` = 'Kelly_Kapoor.jpg' WHERE `employe`.`employe_id` = 13;

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

UPDATE `fonction` SET `id_fonction` = 8,`nom_fonction` = 'Agent Commercial' WHERE `fonction`.`id_fonction` = 8;
UPDATE `fonction` SET `id_fonction` = 4,`nom_fonction` = 'Chef de Projet' WHERE `fonction`.`id_fonction` = 4;
UPDATE `fonction` SET `id_fonction` = 5,`nom_fonction` = 'Directeur des Ventes' WHERE `fonction`.`id_fonction` = 5;
UPDATE `fonction` SET `id_fonction` = 3,`nom_fonction` = 'Directrice Commercial' WHERE `fonction`.`id_fonction` = 3;
UPDATE `fonction` SET `id_fonction` = 7,`nom_fonction` = 'Ingenieur' WHERE `fonction`.`id_fonction` = 7;
UPDATE `fonction` SET `id_fonction` = 1,`nom_fonction` = 'President Directeur General CEO' WHERE `fonction`.`id_fonction` = 1;
UPDATE `fonction` SET `id_fonction` = 9,`nom_fonction` = 'Secretaire' WHERE `fonction`.`id_fonction` = 9;
UPDATE `fonction` SET `id_fonction` = 6,`nom_fonction` = 'Vendeur' WHERE `fonction`.`id_fonction` = 6;
UPDATE `fonction` SET `id_fonction` = 2,`nom_fonction` = 'Vice Directeur' WHERE `fonction`.`id_fonction` = 2;

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
