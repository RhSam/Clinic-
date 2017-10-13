-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 03 Mai 2015 à 23:04
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `clinic+`
--

-- --------------------------------------------------------

--
-- Structure de la table `bon`
--

CREATE TABLE IF NOT EXISTS `bon` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Numero` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `bon`
--

INSERT INTO `bon` (`Id`, `Date`, `Numero`) VALUES
(1, '2014-08-18', 4),
(2, '2014-08-26', 4),
(3, '2014-08-29', 4),
(4, '2014-10-23', 11),
(5, '2014-10-24', 6),
(6, '2014-10-25', 13),
(7, '2014-10-26', 9),
(8, '2014-10-27', 8),
(9, '2014-11-20', 1),
(10, '2014-11-29', 2),
(11, '2015-03-04', 1),
(12, '2015-03-31', 3),
(13, '2015-04-01', 4);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `IdCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `LibelleCategorie` varchar(35) NOT NULL,
  PRIMARY KEY (`IdCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`IdCategorie`, `LibelleCategorie`) VALUES
(1, 'Patient régulier'),
(2, 'Patient assuré'),
(3, 'Patient d''entreprise partenaire'),
(4, 'Indigent');

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE IF NOT EXISTS `chambre` (
  `NumChambre` int(11) NOT NULL AUTO_INCREMENT,
  `LibelleChambre` varchar(10) NOT NULL,
  PRIMARY KEY (`NumChambre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `chambre`
--

INSERT INTO `chambre` (`NumChambre`, `LibelleChambre`) VALUES
(1, 'C'),
(2, 'B'),
(3, 'KL');

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE IF NOT EXISTS `consultation` (
  `CodeConsultation` int(11) NOT NULL AUTO_INCREMENT,
  `Id` int(11) NOT NULL,
  `Per_Id` int(11) NOT NULL,
  `DateDebutConsultation` datetime NOT NULL,
  `Plaintes` text,
  `ObservationsEtExamenClinique` text,
  `DiagnosticClinique` text NOT NULL,
  `Diagnostic` text,
  `Remarques` text,
  `Issue` varchar(50) DEFAULT NULL,
  `DateFinConsultation` datetime DEFAULT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`CodeConsultation`),
  KEY `FK_EFFECTUER` (`Id`),
  KEY `FK_SUBIR` (`Per_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `consultation`
--

INSERT INTO `consultation` (`CodeConsultation`, `Id`, `Per_Id`, `DateDebutConsultation`, `Plaintes`, `ObservationsEtExamenClinique`, `DiagnosticClinique`, `Diagnostic`, `Remarques`, `Issue`, `DateFinConsultation`, `Date`) VALUES
(1, 1, 1, '2014-10-09 11:25:51', 'ngndf', 'bg', 'fjg', '', '', NULL, NULL, '0000-00-00 00:00:00'),
(2, 1, 2, '2014-10-21 10:02:06', 'trgd.&nbsp;&nbsp;', 'dgd.&nbsp;&nbsp;', 'dggd.&nbsp;&nbsp;', '.&nbsp;&nbsp;', '.&nbsp;&nbsp;', NULL, NULL, '0000-00-00 00:00:00'),
(3, 1, 7, '2014-10-23 16:40:54', 'Maux de dent.&nbsp;&nbsp;maux de dents', 'Gonflement de la joue.&nbsp;&nbsp;inflammation de la gencive', 'Carie.&nbsp;&nbsp;carie dentaire', '.&nbsp;&nbsp;carie', '.&nbsp;&nbsp;Patient un peu hypochondriaque', 'Guérison', '2014-10-23 16:44:17', '0000-00-00 00:00:00'),
(4, 1, 8, '2014-10-23 17:51:59', 'Maux de ventre.&nbsp;&nbsp;Douleurs aiguës à l''abdomen', 'Gonflement de l''abdomen.&nbsp;&nbsp;appendicite', 'apendicite.&nbsp;&nbsp;appendicite', '.&nbsp;&nbsp;appendicite', '.&nbsp;&nbsp;', 'Guérison', '2014-10-23 17:54:51', '0000-00-00 00:00:00'),
(5, 1, 10, '2014-10-25 11:13:51', 'maux de tête , fatigue , vomissements, fièvre.&nbsp;&nbsp;', 'fièvre, asthénie, neurasthénie, pâleur des conjonctives.&nbsp;&nbsp;', 'paludisme, fièvre typhoide.&nbsp;&nbsp;', '.&nbsp;&nbsp;', '.&nbsp;&nbsp;', NULL, NULL, '0000-00-00 00:00:00'),
(6, 1, 11, '2014-10-26 22:23:34', 'Maux de tête, fatigue, vomissements.&nbsp;&nbsp;.&nbsp;&nbsp;', 'fièvre, asthénie, neurasthénie, pâleur des conjonctives.&nbsp;&nbsp;.&nbsp;&nbsp;', 'Paludisme, fièvre typhoïde .&nbsp;&nbsp;.&nbsp;&nbsp;', '.&nbsp;&nbsp;Paludisme.&nbsp;&nbsp;', '.&nbsp;&nbsp;patient agité.&nbsp;&nbsp;', 'Guérison', '2014-10-26 22:29:38', '0000-00-00 00:00:00'),
(7, 1, 12, '2014-10-26 22:44:38', 'Maux de tête, fatigue, fièvre.&nbsp;&nbsp;fièvre.&nbsp;&nbsp;', 'fièvre, asthénie, neurathénie.&nbsp;&nbsp;.&nbsp;&nbsp;', 'paludisme, fièvre typhoïde .&nbsp;&nbsp;.&nbsp;&nbsp;', '.&nbsp;&nbsp;paludisme.&nbsp;&nbsp;', '.&nbsp;&nbsp;.&nbsp;&nbsp;', 'Guérison', '2014-10-26 22:49:18', '0000-00-00 00:00:00'),
(8, 1, 13, '2014-10-27 07:14:01', 'Maux de tete, vomissements, fatigue.&nbsp;&nbsp;maux de tête .&nbsp;&nbsp;', 'fièvre, asthénie.&nbsp;&nbsp;.&nbsp;&nbsp;', 'paludisme, fièvre typhoïde .&nbsp;&nbsp;.&nbsp;&nbsp;', '.&nbsp;&nbsp;paludisme.&nbsp;&nbsp;', '.&nbsp;&nbsp;.&nbsp;&nbsp;', 'Guérison', '2014-10-27 07:18:38', '0000-00-00 00:00:00'),
(9, 1, 14, '2014-10-27 08:21:05', 'maux de tête, fatigue, vomissements.&nbsp;&nbsp;maux de tête .&nbsp;&nbsp;', 'fièvre, asthénie, neurasthénie.&nbsp;&nbsp;.&nbsp;&nbsp;', 'paludisme, fièvre typhoïde .&nbsp;&nbsp;.&nbsp;&nbsp;', '.&nbsp;&nbsp;paludisme.&nbsp;&nbsp;', '.&nbsp;&nbsp;.&nbsp;&nbsp;', 'Guérison', '2014-10-27 08:24:45', '0000-00-00 00:00:00'),
(10, 1, 11, '2015-03-31 10:13:37', 'elelele', 'sfsf', 'sfsf', '', '', NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `enregistrer_examen`
--

CREATE TABLE IF NOT EXISTS `enregistrer_examen` (
  `Date` datetime NOT NULL,
  `IdExamen` int(11) NOT NULL,
  `CodeConsultation` int(11) NOT NULL,
  `Laboratoire` varchar(50) DEFAULT NULL,
  `Resultat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Date`,`IdExamen`,`CodeConsultation`),
  KEY `FK_ENREGISTRER_EXAMEN` (`CodeConsultation`),
  KEY `FK_ENREGISTRER_EXAMEN3` (`IdExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enregistrer_examen`
--

INSERT INTO `enregistrer_examen` (`Date`, `IdExamen`, `CodeConsultation`, `Laboratoire`, `Resultat`) VALUES
('2014-10-09 11:30:09', 2, 1, NULL, NULL),
('2014-10-18 15:13:57', 3, 1, NULL, NULL),
('2014-10-21 10:02:39', 4, 2, 'JGJGJE', 'nbfjvbjkdjvjdfldfjkdf'),
('2014-10-23 16:25:50', 1, 2, NULL, NULL),
('2014-10-23 16:41:11', 2, 3, 'LABO AGOE', 'Début de carie dentaire'),
('2014-10-23 17:52:11', 5, 4, 'LABO AGOE', 'Appendicite'),
('2014-10-25 11:14:01', 1, 5, 'LABORATOIRE DE LA NATION', 'négatif'),
('2014-10-25 11:14:13', 2, 5, 'LABORATOIRE DE LA NATION', 'négatif'),
('2014-10-25 11:14:28', 3, 5, 'LABORATOIRE DE LA NATION', 'positif'),
('2014-10-25 11:14:29', 3, 5, NULL, NULL),
('2014-10-25 11:14:30', 3, 5, 'YUIY', 'gkhgu'),
('2014-10-26 18:49:39', 1, 5, NULL, NULL),
('2014-10-26 18:49:51', 3, 5, NULL, NULL),
('2014-10-26 18:55:26', 3, 5, NULL, NULL),
('2014-10-26 22:23:49', 1, 6, 'LABO AGOE', 'paludisme'),
('2014-10-26 22:23:59', 2, 6, 'LABO AGOE', 'paludisme'),
('2014-10-26 22:24:12', 6, 6, 'LABO AGOE', 'Négatif'),
('2014-10-26 22:44:48', 1, 7, 'LABO AGOE', 'paludisme'),
('2014-10-26 22:45:04', 2, 7, 'LABO AGOE', 'paludisme'),
('2014-10-26 22:45:16', 6, 7, 'LABO AGOE', 'Négatif'),
('2014-10-27 07:14:09', 1, 8, 'LABO AGOE', 'paludisme'),
('2014-10-27 07:14:25', 2, 8, 'LABO AGOE', 'paludisme'),
('2014-10-27 07:14:27', 2, 8, NULL, NULL),
('2014-10-27 07:14:39', 6, 8, NULL, NULL),
('2014-10-27 08:21:18', 1, 9, 'LABO AGOE', 'paludisme'),
('2014-10-27 08:21:33', 2, 9, 'LABO AGOE', 'paludisme'),
('2014-10-27 08:21:47', 6, 9, 'LABO AGOE', 'négatif'),
('2014-11-29 13:38:22', 2, 5, NULL, NULL),
('2014-11-29 17:25:29', 6, 5, NULL, NULL),
('2015-03-04 09:57:49', 2, 5, NULL, NULL),
('2015-03-31 10:13:59', 4, 10, NULL, NULL),
('2015-03-31 10:21:15', 2, 10, NULL, NULL),
('2015-04-01 09:42:01', 4, 10, NULL, NULL),
('2015-04-01 10:13:03', 4, 10, NULL, NULL),
('2015-04-01 10:18:03', 2, 10, NULL, NULL),
('2015-04-01 10:45:09', 5, 10, NULL, NULL),
('2015-04-01 15:29:37', 1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `enregistrer_produit`
--

CREATE TABLE IF NOT EXISTS `enregistrer_produit` (
  `Date` datetime NOT NULL,
  `CodeConsultation` int(11) NOT NULL,
  `IdProduit` int(11) NOT NULL,
  `Quantite` varchar(25) NOT NULL,
  `Posologie` varchar(200) NOT NULL,
  PRIMARY KEY (`Date`,`CodeConsultation`,`IdProduit`),
  KEY `FK_ENREGISTRER_PRODUIT` (`IdProduit`),
  KEY `FK_ENREGISTRER_PRODUIT3` (`CodeConsultation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enregistrer_produit`
--

INSERT INTO `enregistrer_produit` (`Date`, `CodeConsultation`, `IdProduit`, `Quantite`, `Posologie`) VALUES
('2014-10-09 11:33:48', 1, 1, '6 Ampoule(s)', 'IM 1/jr'),
('2014-10-09 11:33:48', 1, 2, '1 Boite(s)', 'IV 1-IVD ; 1-Perf'),
('2014-10-21 10:03:47', 2, 1, '12 Boite(s)', 'optey'),
('2014-10-21 10:03:47', 2, 2, '3 Boite(s)', '1 // 1 /1'),
('2014-10-23 16:26:13', 2, 4, '1 Ampoule(s)', 'jkj'),
('2014-10-23 16:41:47', 3, 2, '2 Flacon(s)', '1 matin  1 midi 1 soir'),
('2014-10-23 17:52:53', 4, 1, '2 Flacon(s)', 'IVD le matin'),
('2014-10-23 17:52:53', 4, 2, '1 Boite(s)', '1 matin    1 soir'),
('2014-10-23 17:52:54', 4, 1, '2 Flacon(s)', 'IVD le matin'),
('2014-10-23 17:52:54', 4, 2, '1 Boite(s)', '1 matin    1 soir'),
('2014-10-23 17:52:55', 4, 1, '2 Flacon(s)', 'IVD le matin'),
('2014-10-23 17:52:55', 4, 2, '1 Boite(s)', '1 matin    1 soir'),
('2014-10-25 11:17:17', 5, 1, '2 Ampoule(s)', 'IVD 1matin   1 sir'),
('2014-10-25 11:17:17', 5, 2, '1 Ampoule(s)', 'IM 1 matin'),
('2014-10-26 22:25:40', 6, 1, '1 Ampoule(s)', 'IVD'),
('2014-10-26 22:25:40', 6, 4, '1 Unité(s)', '.'),
('2014-10-26 22:29:04', 6, 5, '2 Boite(s)', '1 matin  1 midi 1 soir'),
('2014-10-26 22:29:04', 6, 6, '1 Boite(s)', '1 matin pendant 3 jours.'),
('2014-10-26 22:45:53', 7, 1, '1 Flacon(s)', 'ivd'),
('2014-10-26 22:45:53', 7, 4, '1 Unité(s)', ''),
('2014-10-26 22:48:34', 7, 5, '2 Boite(s)', '1 matin  1 midi 1 soir'),
('2014-10-26 22:48:34', 7, 6, '1 Boite(s)', '1 matin pendant 3 jours.'),
('2014-10-27 07:15:19', 8, 1, '1 Ampoule(s)', 'ivd'),
('2014-10-27 07:15:19', 8, 4, '1 Unité(s)', ''),
('2014-10-27 07:18:07', 8, 5, '1 Boite(s)', '1 matin  1 midi 1 soir'),
('2014-10-27 07:18:08', 8, 6, '1 Boite(s)', '1 matin pendant 3 jours.'),
('2014-10-27 08:22:11', 9, 1, '1 Ampoule(s)', 'ivd'),
('2014-10-27 08:22:11', 9, 4, '1 Unité(s)', ''),
('2014-10-27 08:24:16', 9, 5, '1 Boite(s)', '1 matin  1 midi 1 soir'),
('2014-10-27 08:24:16', 9, 6, '1 Boite(s)', '1 matin pendant 3 jours.'),
('2014-10-27 11:49:29', 5, 1, '1 Boite(s)', '1 matin  1 midi 1 soir'),
('2014-10-27 11:49:29', 5, 5, '1 Flacon(s)', ''),
('2014-11-29 17:27:14', 5, 2, '4 Flacon(s)', '1 matin  1 midi 1 soir'),
('2014-11-29 17:27:14', 5, 5, '4 Flacon(s)', ''),
('2015-03-04 09:58:30', 5, 1, '1 Boite(s)', '1 matin  1 midi 1 soir'),
('2015-03-04 09:58:30', 5, 2, '4 Paquet(s)', 'dsq'),
('2015-03-31 10:14:33', 10, 1, '1 Boite(s)', '1 matin  1 midi 1 soir'),
('2015-03-31 10:14:33', 10, 6, '1 Ampoule(s)', '1 matin pendant 3 jours.'),
('2015-03-31 10:21:41', 10, 1, '1 Boite(s)', '1 matin  1 midi 1 soir'),
('2015-03-31 10:21:41', 10, 6, '1 Ampoule(s)', '1 matin pendant 3 jours.'),
('2015-04-01 15:30:26', 10, 1, '1 Boite(s)', '1 matin  1 midi 1 soir'),
('2015-04-01 15:30:26', 10, 5, '2 Boite(s)', '1 matin pendant 3 jours.');

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE IF NOT EXISTS `examen` (
  `IdExamen` int(11) NOT NULL AUTO_INCREMENT,
  `NomExamen` varchar(50) NOT NULL,
  PRIMARY KEY (`IdExamen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `examen`
--

INSERT INTO `examen` (`IdExamen`, `NomExamen`) VALUES
(1, 'G-E'),
(2, 'NBTH'),
(3, 'VBNXV'),
(4, 'GLYCEMIE'),
(5, 'TOMODENSITOMETRIE'),
(6, 'SEROLOGIE DE LA FIEVRE TYPHOIDE');

-- --------------------------------------------------------

--
-- Structure de la table `hospitaliser`
--

CREATE TABLE IF NOT EXISTS `hospitaliser` (
  `NumLit` int(11) NOT NULL,
  `Id` int(11) NOT NULL,
  `Per_Id` int(11) NOT NULL,
  `Motif` varchar(250) DEFAULT NULL,
  `PremiersSoins` varchar(250) DEFAULT NULL,
  `DateFinHospitalisation` datetime DEFAULT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`NumLit`,`Id`,`Per_Id`,`Date`),
  KEY `FK_HOSPITALISER` (`Per_Id`),
  KEY `FK_HOSPITALISER4` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `hospitaliser`
--

INSERT INTO `hospitaliser` (`NumLit`, `Id`, `Per_Id`, `Motif`, `PremiersSoins`, `DateFinHospitalisation`, `Date`) VALUES
(1, 1, 1, 'maux de ventre', 'edfs', NULL, '2014-10-09 11:23:17'),
(2, 1, 2, 'maux de ventre', 'perfusion de novalgin', '2015-04-01 15:40:07', '2014-10-21 10:10:11'),
(3, 3, 4, 'maux de ventre', 'perfusion de novalgin', '2014-10-23 16:23:17', '2014-10-23 16:17:59'),
(5, 1, 11, 'maux de ventre', 'perfusion de novalgin', NULL, '2015-03-31 09:53:50'),
(8, 1, 2, 'maux de ventre', 'jkg', NULL, '2015-04-01 15:40:20');

-- --------------------------------------------------------

--
-- Structure de la table `lit`
--

CREATE TABLE IF NOT EXISTS `lit` (
  `NumLit` int(11) NOT NULL AUTO_INCREMENT,
  `Occupe` tinyint(1) DEFAULT NULL,
  `NumChambre` int(11) NOT NULL,
  `LibelleLit` varchar(10) NOT NULL,
  PRIMARY KEY (`NumLit`),
  KEY `FK_CONTENIR` (`NumChambre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `lit`
--

INSERT INTO `lit` (`NumLit`, `Occupe`, `NumChambre`, `LibelleLit`) VALUES
(1, 1, 1, '1'),
(2, 0, 1, '2'),
(3, 0, 2, '1'),
(4, 0, 2, '2'),
(5, 1, 2, 'PASI'),
(6, 0, 2, 'AZ'),
(7, 0, 2, 'AZA'),
(8, 1, 2, 'IAI'),
(9, 0, 1, 'UKTT');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdPrivilege` int(11) DEFAULT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenoms` varchar(50) NOT NULL,
  `TelephoneDomicile` varchar(20) DEFAULT NULL,
  `TelephoneProfessionnel` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `NomDeJeuneFille` varchar(50) DEFAULT NULL,
  `Sexe` char(1) DEFAULT NULL,
  `DateDeNaissance` date DEFAULT NULL,
  `Adresse` text,
  `PaysOrigine` varchar(50) DEFAULT NULL,
  `Profession` varchar(50) DEFAULT NULL,
  `GroupeSanguin` varchar(3) DEFAULT NULL,
  `Allergies` varchar(200) DEFAULT NULL,
  `AntecedentsFamiliaux` text,
  `AntecedentsPersonnels` text,
  `Vaccins` text,
  `Patient` tinyint(1) DEFAULT NULL,
  `CodePatient` varchar(25) DEFAULT NULL,
  `Statut` varchar(8) NOT NULL,
  `IdCategorie` int(11) DEFAULT NULL,
  `PapNom` varchar(50) DEFAULT NULL,
  `PapPrenoms` varchar(50) DEFAULT NULL,
  `PapTelephoneDomicile` varchar(20) DEFAULT NULL,
  `PapTelephoneProfessionnel` varchar(20) DEFAULT NULL,
  `PapEmail` varchar(50) DEFAULT NULL,
  `VisiblePatient` tinyint(1) DEFAULT NULL,
  `VisibleUser` tinyint(1) DEFAULT NULL,
  `Login` varchar(25) DEFAULT NULL,
  `Pass` varchar(25) DEFAULT NULL,
  `IndicePass` varchar(25) DEFAULT NULL,
  `Photo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_AVOIR2` (`IdPrivilege`),
  KEY `FK_ETRE2` (`IdCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`Id`, `IdPrivilege`, `Nom`, `Prenoms`, `TelephoneDomicile`, `TelephoneProfessionnel`, `Email`, `NomDeJeuneFille`, `Sexe`, `DateDeNaissance`, `Adresse`, `PaysOrigine`, `Profession`, `GroupeSanguin`, `Allergies`, `AntecedentsFamiliaux`, `AntecedentsPersonnels`, `Vaccins`, `Patient`, `CodePatient`, `Statut`, `IdCategorie`, `PapNom`, `PapPrenoms`, `PapTelephoneDomicile`, `PapTelephoneProfessionnel`, `PapEmail`, `VisiblePatient`, `VisibleUser`, `Login`, `Pass`, `IndicePass`, `Photo`) VALUES
(1, 4, 'NKOUNOU', 'Eddie', '90 75 55 17', '', 'eddie.nkounou@gmail.com', '', 'M', '1993-09-16', 'kégué', 'Togo', 'Ingénieur en informatique', 'O-', '', '', '', '', 1, 'P1-NKED-0993-1014-M', 'Actif', 4, 'LKK', 'Klk', '22 22 22 88', '', '', 1, 1, 'eddie', 'acetaldehide', 'mon pass favori', '1'),
(2, 3, 'AGBONON', 'Kankoe', '22 22 22 22', '', '', '', 'M', '1999-12-06', 'lome 2', 'Royaume-Uni', 'informaticien', '', 'jcgjkdfskl', '', '', '', 1, 'P2-AGKA-1092-1014-M', 'Evadé', 4, 'ABA', 'Komi', '22 22 22 88', '', '', 1, 1, 'ab2', 'ab', 'dhfi', '2'),
(3, 2, 'DANHOUI', 'Nancy', '91216349', '', '', 'danhoui', 'F', '1994-01-24', 'lomé', 'Togo', 'developpeur', '', NULL, NULL, NULL, NULL, 1, 'P3-DANA-1094-1014-F', 'Actif', 1, 'TOTO', 'Titi', '22233344', '', '', 1, 1, 'nancymed3', 'med', 'med', 'F'),
(4, NULL, 'ABLO', 'Ayicha', '22 00 22 55', '', '', '', 'F', '1990-10-02', 'Qt adéwui.', 'Togo', 'Revendeuse', 'O-', NULL, NULL, NULL, NULL, 1, 'P4-ABAY-1090-1014-F', 'Actif', 1, 'ABLO', 'Komi', '22 55 88 88', '', '', 1, NULL, NULL, NULL, NULL, 'F'),
(7, NULL, 'GOTO', 'Lolo', '22222220', '', '', '', 'M', '2011-12-02', 'qt agoe', 'Togo', 'laveur', 'O+', NULL, NULL, NULL, NULL, 1, 'P7-GOLO-1211-1014-M', 'Actif', 1, 'ABALO', 'Gogo', '11111111', '', '', 1, NULL, NULL, NULL, NULL, 'M'),
(8, NULL, 'GORO', 'Awute', '90555555', '', '', '', 'M', '1991-09-16', 'Qt kegue', 'Togo', 'menuisier', 'O+', NULL, NULL, NULL, NULL, 1, 'P8-GOAW-0991-1014-M', 'Actif', 1, 'GORO', 'Abla', '22222220', '', '', 1, NULL, NULL, NULL, NULL, 'M'),
(10, NULL, 'ABOTSI', 'Jean', '90222290', '', '', '', 'M', '1992-01-12', 'Qt Agoe', 'Togo', 'Menuisier', 'O+', NULL, NULL, NULL, NULL, 1, 'P10-ABJE-0192-1014-M', 'Actif', 2, 'ABOTSI', 'Yawa', '22555522', '', '', 1, NULL, NULL, NULL, NULL, 'M'),
(11, NULL, 'ABALO', 'Jean', '90 55 55 90', '', '', '', 'M', '1992-01-12', 'Qt Agoe', 'Togo', 'Dentiste', 'A-', NULL, NULL, NULL, NULL, 1, 'P11-ABJE-0192-1014-M', 'Actif', 3, 'ABALO', 'Charles', '22 55 55 55', '', '', 1, NULL, NULL, NULL, NULL, 'M'),
(12, NULL, 'ABLI', 'Charles', '90 55 90 55', '', '', '', 'M', '1990-01-12', 'Qt Agoè', 'Togo', 'Menusier', 'A+', NULL, NULL, NULL, NULL, 1, 'P12-ABCH-0190-1014-M', 'Actif', 2, 'ABLI', 'Yawa', '22 55 55 55', '', '', 1, NULL, NULL, NULL, NULL, 'M'),
(13, NULL, 'ZORO', 'Paul', '22 88 88 88', '', '', '', 'M', '1991-01-12', 'Qt Agoè', 'Togo', 'Menusier', 'A+', NULL, NULL, NULL, NULL, 1, 'P13-ZOPA-0191-1014-M', 'Actif', 2, 'ZORO', 'Jean-michel', '22 88 88 88', '', '', 1, NULL, NULL, NULL, NULL, 'M'),
(14, NULL, 'NONDOWOU', 'Zinatou', '90 88 99 99', '', '', '', 'F', '1994-01-12', 'Qt agoè', 'Togo', 'informaticienne', 'A+', NULL, NULL, NULL, NULL, 1, 'P14-NOZI-0194-1014-F', 'Actif', 2, 'NKOUNOU', 'Eddie', '90 75 55 17', '', '', 1, NULL, NULL, NULL, NULL, 'F'),
(15, NULL, 'ABATA', 'Komi', '88 88 88 88', '', '', '', 'M', '1990-01-12', 'qt agoè', 'Togo', 'menusier', 'A+', NULL, NULL, NULL, NULL, 1, 'P15-ABKO-0190-1014-M', 'Actif', 2, 'ABATA', 'Yawa', '22 55 55 55', '', '', 1, NULL, NULL, NULL, NULL, 'M'),
(17, NULL, 'AGBENOWOSSI', 'Kokou', '91292470', '', '', '', 'M', '1986-03-31', 'adidogomé', 'Togo', 'derangeur', '', NULL, NULL, NULL, NULL, 1, 'P17-AGKO-0386-0315-M', 'Actif', 1, 'AGBENOWOSSI', 'Kokou', '91050505', '', '', 1, NULL, NULL, NULL, NULL, 'M'),
(18, NULL, 'WFQG', 'Dfq', '22 22 22 22', '', '', '', 'M', '2015-03-31', 'fs', 'Togo', 'fj', '', NULL, NULL, NULL, NULL, 1, 'P18-WFDF-0315-0415-M', 'Actif', 1, 'DV', 'Dvf', '22 22 22 22', '', '', 1, NULL, NULL, NULL, NULL, '18'),
(19, NULL, 'HREH', 'Rh', '22 22 22 22', '', '', '', 'M', '2015-04-01', 'fb', 'Togo', 'bv', '', NULL, NULL, NULL, NULL, 1, 'P19-HRRH-0415-0415-M', 'Actif', 1, 'BF', 'Fb', '22 22 22 22', '', '', 1, NULL, NULL, NULL, NULL, '19');

-- --------------------------------------------------------

--
-- Structure de la table `privilege`
--

CREATE TABLE IF NOT EXISTS `privilege` (
  `IdPrivilege` int(11) NOT NULL,
  `GradePrivilege` varchar(25) NOT NULL,
  PRIMARY KEY (`IdPrivilege`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `privilege`
--

INSERT INTO `privilege` (`IdPrivilege`, `GradePrivilege`) VALUES
(0, 'désactivé'),
(1, 'secrétaire'),
(2, 'infirmier'),
(3, 'médecin'),
(4, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `IdProduit` int(11) NOT NULL AUTO_INCREMENT,
  `NomProduit` varchar(50) NOT NULL,
  `FormatProduit` varchar(25) NOT NULL,
  `DosageProduit` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`IdProduit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`IdProduit`, `NomProduit`, `FormatProduit`, `DosageProduit`) VALUES
(1, 'ARTEMETHER', 'INJ', '80MG'),
(2, 'NOVALGIN', 'INJ', ''),
(3, 'RIALGIN', 'COMPRIMéS', '150MG'),
(4, 'SERINGUE', '10 GAUGES', ''),
(5, 'LUFANTHER', 'COMPRIMéS', '500 MG'),
(6, 'DOLIPRANE', 'COMPRIMéS EFFERVESCENTS', '200 MG');

-- --------------------------------------------------------

--
-- Structure de la table `relever_parametre`
--

CREATE TABLE IF NOT EXISTS `relever_parametre` (
  `Id` int(11) NOT NULL,
  `Per_Id` int(11) NOT NULL,
  `PoidsEnKg` varchar(6) DEFAULT NULL,
  `TailleEnCm` varchar(6) DEFAULT NULL,
  `Temperature` varchar(3) DEFAULT NULL,
  `TensionArterielleBG` varchar(6) DEFAULT NULL,
  `TensionArterielleBD` varchar(6) DEFAULT NULL,
  `Pouls` varchar(6) DEFAULT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`Id`,`Per_Id`,`Date`),
  KEY `FK_RELEVER_PARAMETRE` (`Per_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `relever_parametre`
--

INSERT INTO `relever_parametre` (`Id`, `Per_Id`, `PoidsEnKg`, `TailleEnCm`, `Temperature`, `TensionArterielleBG`, `TensionArterielleBD`, `Pouls`, `Date`) VALUES
(1, 2, '90', '0', '9.9', '90/80', '120/11', '0', '2014-10-21 10:01:29'),
(1, 4, '100', '0', '9.9', '', '', '0', '2014-10-23 17:56:57'),
(1, 8, '150', '0', '9.9', '', '', '0', '2014-10-23 17:58:01'),
(1, 11, '100', '', '32.', '180/12', '130/12', '', '2015-03-31 09:52:16'),
(1, 11, '100', '175', '37', '180/12', '', '', '2015-04-01 15:27:23'),
(1, 15, '90', '168', '39', '130/11', '120/80', '80', '2014-10-27 09:24:26'),
(3, 4, '95', '176', '9.9', '130/10', '140/11', '120', '2014-10-23 16:16:14'),
(3, 4, '150', '0', '39', '', '', '0', '2014-10-25 11:21:11'),
(3, 7, '50', '35', '9.9', '80/60', '90/60', '51', '2014-10-23 16:39:33'),
(3, 8, '90', '190', '9.9', '130/11', '140/11', '90', '2014-10-23 17:50:37'),
(3, 10, '85', '179', '9.9', '130/11', '120/10', '100', '2014-10-25 11:11:26'),
(3, 10, '150', '', '40', '', '', '', '2014-10-25 11:22:44'),
(3, 11, '90', '180', '37', '120/10', '130/10', '90', '2014-10-26 22:20:39'),
(3, 12, '90', '180', '38', '110/90', '130/10', '90', '2014-10-26 22:42:18'),
(3, 13, '90', '180', '39', '130/11', '120/80', '90', '2014-10-27 07:11:46'),
(3, 14, '60', '165', '39', '130/11', '120/11', '90', '2014-10-27 08:19:07');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `IdSession` int(11) NOT NULL AUTO_INCREMENT,
  `Id` int(11) NOT NULL,
  `DateDebutSession` datetime NOT NULL,
  `DateFinSession` datetime DEFAULT NULL,
  PRIMARY KEY (`IdSession`),
  KEY `FK_OUVRIR` (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Contenu de la table `session`
--

INSERT INTO `session` (`IdSession`, `Id`, `DateDebutSession`, `DateFinSession`) VALUES
(1, 1, '2014-10-05 15:13:47', NULL),
(2, 1, '2014-10-09 11:20:44', '2014-10-09 11:37:22'),
(3, 1, '2014-10-09 11:37:40', NULL),
(4, 1, '2014-10-10 22:09:33', NULL),
(5, 1, '2014-10-18 15:09:49', '2014-10-18 15:09:54'),
(6, 1, '2014-10-18 15:10:50', NULL),
(7, 1, '2014-10-18 15:12:57', NULL),
(8, 1, '2014-10-21 09:08:41', NULL),
(9, 1, '2014-10-21 09:28:33', '2014-10-21 09:44:33'),
(10, 1, '2014-10-21 09:46:22', NULL),
(11, 1, '2014-10-21 09:46:23', '2014-10-21 09:57:29'),
(12, 1, '2014-10-21 09:58:29', '2014-10-21 10:14:14'),
(13, 1, '2014-10-22 10:09:30', '2014-10-22 10:09:39'),
(14, 1, '2014-10-22 10:42:37', '2014-10-22 11:44:39'),
(15, 1, '2014-10-22 11:44:45', '2014-10-22 11:47:48'),
(16, 1, '2014-10-22 11:53:08', '2014-10-22 11:55:55'),
(17, 1, '2014-10-22 11:56:52', '2014-10-23 14:01:46'),
(18, 1, '2014-10-22 18:12:26', '2014-10-22 18:13:59'),
(19, 1, '2014-10-22 18:14:13', NULL),
(20, 1, '2014-10-23 14:03:52', '2014-10-23 14:04:14'),
(21, 1, '2014-10-23 14:04:34', '2014-10-23 14:04:44'),
(22, 1, '2014-10-23 14:58:42', '2014-10-23 16:10:57'),
(23, 3, '2014-10-23 16:11:41', '2014-10-23 16:20:57'),
(24, 3, '2014-10-23 16:21:37', '2014-10-23 16:23:57'),
(25, 1, '2014-10-23 16:24:04', '2014-10-23 16:35:24'),
(26, 3, '2014-10-23 16:35:39', '2014-10-23 16:39:45'),
(27, 1, '2014-10-23 16:39:51', '2014-10-23 16:47:28'),
(28, 1, '2014-10-23 16:48:57', '2014-10-23 16:52:47'),
(29, 1, '2014-10-23 16:53:28', '2014-10-23 16:54:39'),
(30, 3, '2014-10-23 16:54:46', '2014-10-23 16:55:54'),
(31, 1, '2014-10-23 16:56:00', '2014-10-23 17:45:03'),
(32, 3, '2014-10-23 17:47:06', '2014-10-23 17:50:47'),
(33, 1, '2014-10-23 17:50:54', '2014-10-25 09:21:31'),
(34, 1, '2014-10-25 09:44:59', '2014-10-25 10:22:23'),
(35, 1, '2014-10-25 10:22:28', '2014-10-25 11:02:46'),
(36, 3, '2014-10-25 11:03:29', '2014-10-25 11:04:04'),
(37, 3, '2014-10-25 11:04:09', '2014-10-25 11:04:24'),
(38, 3, '2014-10-25 11:04:58', '2014-10-25 11:07:36'),
(39, 1, '2014-10-25 11:07:44', '2014-10-25 11:08:10'),
(40, 3, '2014-10-25 11:08:29', '2014-10-25 11:11:37'),
(41, 1, '2014-10-25 11:11:49', '2014-10-25 11:19:52'),
(42, 3, '2014-10-25 11:20:49', NULL),
(43, 1, '2014-10-26 17:30:59', '2014-10-26 18:04:44'),
(44, 3, '2014-10-26 18:04:48', '2014-10-26 18:12:30'),
(45, 1, '2014-10-26 18:12:36', '2014-10-26 21:25:47'),
(46, 1, '2014-10-26 21:46:41', '2014-10-26 21:51:59'),
(47, 3, '2014-10-26 22:12:30', '2014-10-26 22:15:59'),
(48, 3, '2014-10-26 22:17:48', '2014-10-26 22:21:02'),
(49, 1, '2014-10-26 22:21:14', '2014-10-26 22:37:36'),
(50, 3, '2014-10-26 22:38:29', '2014-10-26 22:38:48'),
(51, 3, '2014-10-26 22:39:55', '2014-10-26 22:42:53'),
(52, 1, '2014-10-26 22:43:03', '2014-10-27 07:08:12'),
(53, 3, '2014-10-27 07:08:53', '2014-10-27 07:12:18'),
(54, 1, '2014-10-27 07:12:34', '2014-10-27 08:16:05'),
(55, 3, '2014-10-27 08:16:38', '2014-10-27 08:19:30'),
(56, 1, '2014-10-27 08:19:41', '2014-10-27 08:28:21'),
(57, 1, '2014-10-27 09:20:49', '2014-10-27 09:38:59'),
(58, 1, '2014-10-27 10:09:27', '2014-10-27 10:47:44'),
(59, 1, '2014-10-27 10:52:26', NULL),
(60, 1, '2014-11-20 09:30:48', NULL),
(61, 1, '2014-11-29 13:37:00', '2014-11-29 17:02:27'),
(62, 1, '2014-11-29 17:09:06', NULL),
(63, 1, '2015-02-08 23:55:16', NULL),
(64, 1, '2015-02-10 22:50:35', NULL),
(65, 1, '2015-02-13 11:03:48', NULL),
(66, 1, '2015-03-02 09:47:08', NULL),
(67, 1, '2015-03-04 00:04:19', '2015-03-04 08:00:31'),
(68, 1, '2015-03-04 08:00:50', '2015-03-04 09:54:59'),
(69, 1, '2015-03-04 09:55:42', '2015-03-04 10:00:34'),
(70, 1, '2015-03-31 08:44:27', '2015-03-31 08:47:53'),
(71, 1, '2015-03-31 08:51:25', '2015-03-31 09:45:56'),
(72, 1, '2015-03-31 09:48:52', '2015-04-01 08:58:07'),
(73, 1, '2015-04-01 08:58:40', '2015-04-01 15:36:44'),
(74, 1, '2015-04-01 15:39:36', NULL),
(75, 1, '2015-04-01 08:59:54', NULL),
(76, 1, '2015-04-15 15:00:59', '2015-04-15 15:24:11'),
(77, 1, '2015-04-15 15:30:01', NULL),
(78, 1, '2015-04-20 09:49:09', NULL),
(79, 1, '2015-04-22 10:16:50', '2015-04-22 12:06:31'),
(80, 1, '2015-04-22 12:07:19', '2015-04-22 12:09:09'),
(81, 1, '2015-04-22 12:30:01', NULL),
(82, 1, '2015-04-27 08:44:03', '2015-04-27 10:36:14'),
(83, 1, '2015-04-27 10:48:43', NULL),
(84, 1, '2015-05-02 19:02:10', '2015-05-03 22:59:59'),
(85, 1, '2015-05-03 23:00:22', NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `FK_EFFECTUER` FOREIGN KEY (`Id`) REFERENCES `personne` (`Id`),
  ADD CONSTRAINT `FK_SUBIR` FOREIGN KEY (`Per_Id`) REFERENCES `personne` (`Id`);

--
-- Contraintes pour la table `enregistrer_examen`
--
ALTER TABLE `enregistrer_examen`
  ADD CONSTRAINT `FK_ENREGISTRER_EXAMEN` FOREIGN KEY (`CodeConsultation`) REFERENCES `consultation` (`CodeConsultation`),
  ADD CONSTRAINT `FK_ENREGISTRER_EXAMEN3` FOREIGN KEY (`IdExamen`) REFERENCES `examen` (`IdExamen`);

--
-- Contraintes pour la table `enregistrer_produit`
--
ALTER TABLE `enregistrer_produit`
  ADD CONSTRAINT `FK_ENREGISTRER_PRODUIT` FOREIGN KEY (`IdProduit`) REFERENCES `produit` (`IdProduit`),
  ADD CONSTRAINT `FK_ENREGISTRER_PRODUIT3` FOREIGN KEY (`CodeConsultation`) REFERENCES `consultation` (`CodeConsultation`);

--
-- Contraintes pour la table `hospitaliser`
--
ALTER TABLE `hospitaliser`
  ADD CONSTRAINT `FK_HOSPITALISER` FOREIGN KEY (`Per_Id`) REFERENCES `personne` (`Id`),
  ADD CONSTRAINT `FK_HOSPITALISER2` FOREIGN KEY (`NumLit`) REFERENCES `lit` (`NumLit`),
  ADD CONSTRAINT `FK_HOSPITALISER4` FOREIGN KEY (`Id`) REFERENCES `personne` (`Id`);

--
-- Contraintes pour la table `lit`
--
ALTER TABLE `lit`
  ADD CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`NumChambre`) REFERENCES `chambre` (`NumChambre`);

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `FK_AVOIR2` FOREIGN KEY (`IdPrivilege`) REFERENCES `privilege` (`IdPrivilege`),
  ADD CONSTRAINT `FK_ETRE2` FOREIGN KEY (`IdCategorie`) REFERENCES `categorie` (`IdCategorie`);

--
-- Contraintes pour la table `relever_parametre`
--
ALTER TABLE `relever_parametre`
  ADD CONSTRAINT `FK_RELEVER_PARAMETRE` FOREIGN KEY (`Per_Id`) REFERENCES `personne` (`Id`),
  ADD CONSTRAINT `FK_RELEVER_PARAMETRE3` FOREIGN KEY (`Id`) REFERENCES `personne` (`Id`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `FK_OUVRIR` FOREIGN KEY (`Id`) REFERENCES `personne` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
