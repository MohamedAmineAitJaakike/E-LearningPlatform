-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 avr. 2024 à 22:44
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `platform`
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

--
-- Déchargement des données de la table `cour`
--

INSERT INTO `cour` (`courID`, `courParentID`, `courName`, `content`) VALUES
(1, 2, '', ''),
(2, 514, '', ''),
(220, 514, 'chapitre33', 'mobile (4).gif'),
(466, 514, 'chapitre11', 'Macbook-Air-localhost (2).png'),
(544, 514, 'chapitre11', 'Macbook-Air-localhost (2).png'),
(592, 514, 'chapitre11', 'Macbook-Air-localhost (2).png');

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
(1, 349916, 'xdvzxcv', 'vvv'),
(2, 349916, 'c avance', '444'),
(77, 14, 'chimie', '333'),
(174, 14, 'algorithme', '\"\"\"\"'),
(354, 497958, 'aicha', '222'),
(388, 14, 'c avance', 'ssss'),
(514, 864820, 'electro', '222'),
(589, 14, 'electro2', '444'),
(737, 497958, 'aicha2', 'ddd'),
(799, 864820, 'algorithme', '333'),
(885, 864820, 'electro2', '444'),
(975, 239372, 'c avance', '1234');

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
(1, 'merakchi', 'merakchi444@gmail.com', '1234', '13413021_197004767361356_1627172055209682313_n.jpg', 'etudiant'),
(2, 'amine', 'amine444@gmail.com', '444', '60728316_752015708526923_1278331452978626560_n.jpg', 'etudiant'),
(3, 'saad', 'saad@gmail.com', 'fff', '14066364_238577896537376_1423348461229504649_o.jpg', 'etudiant'),
(4, 'werwer', 'amine4e44@gmail.com', 'rrr', '23915747_457132991348531_4388543922166524097_n.jpg', 'etudiant'),
(5, 'werwer', 'amine4e4ff4@gmail.com', 'fff', '23795157_457184211343409_5884776880355934629_n.jpg', 'etudiant'),
(6, 'rfrrrr', 'amine4e4rff4@gmail.com', 'hhh', '23795157_457184211343409_5884776880355934629_n.jpg', 'professeur'),
(7, 'uahya', 'yahya@gmail.com', '111', '28577223_500442483684248_3033551730001340254_n.jpg', 'etudiant'),
(8, 'saad2', 'saad2@gmail.com', '222', 'Macbook-Air-localhost (2).png', 'professeur'),
(9, 'daad4', 'daad4@gmail.com', '444', 'Macbook-Air-localhost (2).png', 'etudiant'),
(10, 'ggg', 'ggg@gmail.com', 'hhh', '32191472_528695300858966_2664754584118886400_n.jpg', 'etudiant'),
(11, 'ilyass9', 'ilyass9@gmail.com', 'eee', '32191472_528695300858966_2664754584118886400_n.jpg', 'professeur'),
(12, 'merakchi', 'merakchi@gmail.com', '222', 'Macbook-Air-localhost (3).png', 'professeur'),
(13, 'ilyass', 'ailyas77@gmail.com', '55', 'mobile (2).gif', 'professeur'),
(14, 'amine', 'amine444@gmail.com', '555', '28577223_500442483684248_3033551730001340254_n.jpg', 'professeur'),
(15, 'ilyass', 'amine444@gmail.com', '444', '28577223_500442483684248_3033551730001340254_n.jpg', 'professeur'),
(16, 'saad barouj', 'barouj@gmail.com', '333', 'mobile (3).gif', 'etudiant'),
(17, 'barouj', 'barouj@gmail.com', 'ddd', '57485330_736321616762999_1569337387320868864_n.jpg', 'etudiant'),
(18, 'aicha', 'aicha@gmail.com', 'hhh', 'mobile (3).gif', 'professeur'),
(19, 'ilyass', 'ilyassee@gmail.com', 'eee', 'Macbook-Air-localhost (2).png', 'professeur'),
(226271, 'saad', 'saad@gmail.com', 'ddd', 'saad.jpeg', 'professeur'),
(239372, 'merakchi', 'merakchi@gmail.com', 'ddd', 'amine.jpeg', 'professeur'),
(311044, 'saad', 'saad@gmail.com', 'ddd', 'mobile (2).gif', 'professeur'),
(336471, 'ilyass', 'ilyass@gmail.com', 'ddd', 'amine.jpeg', 'professeur'),
(349916, 'amine', 'amine444@gmail.com', 'ddd', 'Macbook-Air-localhost (2).png', 'professeur'),
(421267, 'saad23', 'saad@gmail.com', 'ddd', 'saad.jpeg', 'etudiant'),
(497958, 'ilyass', 'amine444@gmail.com', 'xx', 'mobile (2).gif', 'professeur'),
(703157, 'ilyass', 'ilyass777@gmail.com', 'sss', 'Macbook-Air-localhost (2).png', 'professeur'),
(773086, 'saad', 'saad@gmail.com', 'gg', 'mobile (2).gif', 'professeur'),
(805067, 'saad', 'saad@gmail.com', 'ddd', 'saad.jpeg', 'professeur'),
(864820, 'amine', 'amine444@gmail.com', 'ddd', 'mobile (4).gif', 'professeur');

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
