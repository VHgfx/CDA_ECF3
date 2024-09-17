-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 sep. 2024 à 10:24
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cda_ecf3`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(300) NOT NULL,
  `event_debut` datetime NOT NULL,
  `event_fin` datetime NOT NULL,
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `events_user_FK` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_debut`, `event_fin`, `description`, `id_user`) VALUES
(1, 'Test évènement', '2024-09-16 13:00:00', '2024-09-16 14:00:00', 'test', 1),
(2, 'Test évènement', '2024-09-16 13:00:00', '2024-09-16 14:00:00', 'test', 1),
(3, 'Test évènement 2', '2024-10-09 09:00:00', '2024-09-16 10:00:00', 'azeaz', 1),
(4, 'Test ajout 1', '2024-09-17 10:00:00', '2024-09-17 11:00:00', 'test', 1),
(5, 'Test ajout apres check date', '2024-09-17 09:00:00', '2024-09-17 10:00:00', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `event_inscriptions`
--

DROP TABLE IF EXISTS `event_inscriptions`;
CREATE TABLE IF NOT EXISTS `event_inscriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_events` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_inscriptions_user_FK` (`id_user`),
  KEY `event_inscriptions_events0_FK` (`id_events`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `event_inscriptions`
--

INSERT INTO `event_inscriptions` (`id`, `email`, `firstname`, `lastname`, `id_user`, `id_events`) VALUES
(1, 'test@test.fr', 'Virginie', 'MENDO', 1, 2),
(2, 'test@test.fr', 'Virginie', 'MENDO', 1, 1),
(4, 'hu-victor@hotmail.com', 'Victor', 'Hu', NULL, 3),
(5, 'test@test3.fr', 'test', 'Test', NULL, 3),
(8, 'victor@lgx-france.fr', 'Victor', 'Hu', NULL, 4),
(10, 'test@test.fr', 'Virginie', 'MENDO', 1, 5),
(11, 'hu-victor@hotmail.com', 'Victor', 'Test', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_nom` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role_nom`) VALUES
(1, 'Administrateur'),
(2, 'Membre');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(300) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` text NOT NULL,
  `id_roles` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_role_FK` (`id_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `firstname`, `email`, `password`, `id_roles`) VALUES
(1, 'MENDO', 'Virginie', 'test@test.fr', '$2y$10$5s8jKzs1RhXUUw/lySguVuDxHMTNgfzQdMhkaiNHujeGnsz1qEHka', 1),
(3, 'Hu', 'Victor', 'victor@lgx-france.fr', '$2y$10$J5p2hT4qiMcpI9SGh4k8J..GBpNGU.ViO/F36XnhIQhiVRaGgkY4S', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `event_inscriptions`
--
ALTER TABLE `event_inscriptions`
  ADD CONSTRAINT `event_inscriptions_events0_FK` FOREIGN KEY (`id_events`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_inscriptions_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `users_role_FK` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
