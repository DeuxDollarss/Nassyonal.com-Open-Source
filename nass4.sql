-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 19 juil. 2021 à 17:15
-- Version du serveur :  10.3.29-MariaDB-0+deb10u1
-- Version de PHP : 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `nass4`
--

-- --------------------------------------------------------

--
-- Structure de la table `api`
--

CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `keyy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `api`
--

INSERT INTO `api` (`id`, `keyy`) VALUES
(1, 'nano'),
(0, 'lol'),
(2, 'lol'),
(5, '1884189z18ra188az1raz8rsaq8r8as8ras1as8pp');

-- --------------------------------------------------------

--
-- Structure de la table `basic_users`
--

CREATE TABLE `basic_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `keyy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rank` int(1) NOT NULL,
  `money` varchar(20) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `allowed_ip` text DEFAULT NULL,
  `skin` int(1) NOT NULL DEFAULT 0,
  `cape` int(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `confirmed` varchar(25) DEFAULT NULL,
  `auth-uuid` varchar(255) DEFAULT NULL,
  `auth-accessToken` varchar(255) DEFAULT NULL,
  `auth-clientToken` varchar(255) DEFAULT NULL,
  `forum-last_activity` datetime DEFAULT NULL,
  `sub` int(11) NOT NULL,
  `bonus` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `basic_users`
--
ALTER TABLE `basic_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `basic_users`
--
ALTER TABLE `basic_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
