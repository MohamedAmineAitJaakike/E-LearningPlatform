-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 28, 2024 at 12:00 AM
-- Server version: 8.2.0
-- PHP Version: 8.1.26
DROP DATABASE IF EXISTS platform;
CREATE DATABASE platform;
USE platform;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 28, 2024 at 12:00 AM
-- Server version: 8.2.0
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `mail`, `mot_de_passe`) VALUES
(1, 'Admin', 'Platform', 'md@gmail.com', '111');

-- --------------------------------------------------------

--
-- Table structure for table `chapitre`
--

DROP TABLE IF EXISTS `chapitre`;
CREATE TABLE IF NOT EXISTS `chapitre` (
  `IdChap` int NOT NULL AUTO_INCREMENT,
  `IdModule` int DEFAULT NULL,
  `contenu` varchar(255) NOT NULL,
  `accessible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`IdChap`),
  KEY `IdModule` (`IdModule`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courssuivis`
--

DROP TABLE IF EXISTS `courssuivis`;
CREATE TABLE IF NOT EXISTS `courssuivis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idEtudiant` int DEFAULT NULL,
  `idCours` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEtudiant` (`idEtudiant`),
  KEY `idCours` (`idCours`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCours` int NOT NULL,
  `idExpediteur` int NOT NULL,
  `idRecepteur` int NOT NULL,
  `contenu` text NOT NULL,
  `date_envoi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `est_annonce` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCours` (`idCours`),
  KEY `idExpediteur` (`idExpediteur`),
  KEY `idRecepteur` (`idRecepteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `IdParent` int DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `presentation` varchar(255) NOT NULL,
  `mots_cles` varchar(255) NOT NULL,
  `Code_Cours` varchar(255) NOT NULL,
  `cible` varchar(255) NOT NULL,
  `prerequis` varchar(255) NOT NULL,
  `est_progressif` tinyint(1) DEFAULT NULL,
  `proprietaire` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proprietaire` (`proprietaire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('etudiant','professeur','administrateur') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Adding foreign key constraints after table creation

ALTER TABLE `chapitre`
  ADD CONSTRAINT `FK_chapitre_IdModule` FOREIGN KEY (`IdModule`) REFERENCES `module` (`IdParent`);

ALTER TABLE `courssuivis`
  ADD CONSTRAINT `FK_courssuivis_idEtudiant` FOREIGN KEY (`idEtudiant`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `FK_courssuivis_idCours` FOREIGN KEY (`idCours`) REFERENCES `module` (`IdParent`);

ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_idCours` FOREIGN KEY (`idCours`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `FK_message_idExpediteur` FOREIGN KEY (`idExpediteur`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `FK_message_idRecepteur` FOREIGN KEY (`idRecepteur`) REFERENCES `utilisateurs` (`id`);

ALTER TABLE `module`
  ADD CONSTRAINT `FK_module_proprietaire` FOREIGN KEY (`proprietaire`) REFERENCES `utilisateurs` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
