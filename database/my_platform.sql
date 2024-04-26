-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 avr. 2024 à 23:11
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_platform`
--

-- --------------------------------------------------------

--
-- Structure de la table `cour`
--

CREATE TABLE `cour` (
  `courID` int(11) NOT NULL,
  `courParentID` int(11) NOT NULL,
  `courName` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `courID` int(11) NOT NULL,
  `userID` int(44) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`courID`, `userID`, `name`, `password`) VALUES
(476, 70071, 'linux', '333'),
(486, 70071, 'c avance', '1123'),
(773, 121462, 'web developement', 'sss');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(400) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userID`, `name`, `email`, `password`, `image`, `user`) VALUES
(34532, 'ilyass', 'ilyass2001@gmail.com', '222', 'newwtoken.png', 'etudiant'),
(70071, 'amine', 'amine@gmail.com', 'ddd', 'creation rep.png', 'professeur'),
(121462, 'saad barhrouj', 'saad.barhrouj2001@gmail.com', 'sss', 'saad3.png', 'professeur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cour`
--
ALTER TABLE `cour`
  ADD PRIMARY KEY (`courID`),
  ADD KEY `courParentID` (`courParentID`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`courID`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cour`
--
ALTER TABLE `cour`
  ADD CONSTRAINT `cour_ibfk_1` FOREIGN KEY (`courParentID`) REFERENCES `cours` (`courID`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
