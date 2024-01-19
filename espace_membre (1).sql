-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 jan. 2024 à 16:53
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userId` int(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `info` text NOT NULL,
  `niveau` enum('0','1','2','3') NOT NULL,
  `date_ins` datetime NOT NULL,
  `date_log` datetime NOT NULL,
  `active` enum('0','1') NOT NULL,
  `cle` int(11) NOT NULL,
  `confirme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Information membre';

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userId`, `nom`, `prenom`, `email`, `pseudo`, `password`, `info`, `niveau`, `date_ins`, `date_log`, `active`, `cle`, `confirme`) VALUES
(1, 'talibi', 'abdelwahid', 'abdelwahidtalibi089@gmail', 'abdo99', 'Karimaazdad1978', 'etudiant', '2', '2024-01-08 17:03:38', '2024-01-08 17:03:38', '1', 0, 0),
(32, 'mousa', 'mousa', 'hackbird99@gmail.com', 'mousa', 'assia', '123', '1', '2024-01-05 00:00:00', '2024-01-05 00:00:00', '1', 5956114, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
