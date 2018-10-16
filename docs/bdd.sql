-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 29 mars 2018 à 13:32
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mealoclock`
--

-- --------------------------------------------------------

--
-- Structure de la table `communities`
--

CREATE TABLE `communities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text,
  `picture` varchar(32) NOT NULL,
  `slug` varchar(32) NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `communities`
--

INSERT INTO `communities` (`id`, `name`, `description`, `picture`, `slug`, `creator_id`) VALUES
(1, 'Vegan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'vegan.jpg', 'vegan', 1),
(2, 'Sans lactose', 'Les trucs à manger sans lactose !', 'lactosefree.jpg', 'sans-lactose', 1),
(3, 'Sans gluten', 'Pleins de plats délicieux sans gluten !!! Rejoignez la secte !', 'glutenfree.jpg', 'sans-gluten', 1);

-- --------------------------------------------------------

--
-- Structure de la table `communities_members`
--

CREATE TABLE `communities_members` (
  `community_id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `event_date` datetime DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `event_limit` int(11) DEFAULT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `community_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `name`, `event_date`, `address`, `event_limit`, `creator_id`, `community_id`) VALUES
(1, 'Le rendez vous des légumes', '2018-04-01 12:00:00', '1 rue de la paix, 75000, Paris', 6, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `events_members`
--

CREATE TABLE `events_members` (
  `event_id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `events_members`
--

INSERT INTO `events_members` (`event_id`, `member_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `firstname` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `lastname` varchar(128) CHARACTER SET utf8mb4 DEFAULT NULL,
  `photo` varchar(64) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'profil.jpg',
  `address` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `email`, `password`, `firstname`, `lastname`, `photo`, `address`, `description`, `is_admin`) VALUES
(1, 'julien@oclock.io', 'azerty', 'julien', 'pouillard', 'profil.jpg', '1 rue de la paix, 75000 Paris', 'coucou comment ça va les gens ?', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Index pour la table `communities_members`
--
ALTER TABLE `communities_members`
  ADD PRIMARY KEY (`community_id`,`member_id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `community_id` (`community_id`);

--
-- Index pour la table `events_members`
--
ALTER TABLE `events_members`
  ADD PRIMARY KEY (`event_id`,`member_id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
