-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum`;

-- Listage de la structure de la table forum. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `icone` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.categorie : ~6 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_categorie`, `nom`, `icone`) VALUES
	(1, 'aventure', 'https://img.icons8.com/doodle/48/000000/compass--v1.png'),
	(2, 'action', 'https://img.icons8.com/color/48/000000/nerf-gun.png'),
	(3, 'course', 'https://img.icons8.com/color/48/000000/f1-race-car-top-veiw.png'),
	(4, 'survie', 'https://img.icons8.com/color/48/000000/survival-bag.png'),
	(5, 'open world', 'https://img.icons8.com/doodle/48/000000/meeting-arrows-globe.png'),
	(6, 'sport', 'https://img.icons8.com/doodle/48/000000/basketball--v1.png');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table forum. reponse
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text,
  `datecreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `utilisateur_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `id_utilisateur` (`utilisateur_id`),
  KEY `id_sujet` (`topic_id`),
  CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`),
  CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `sujet` (`id_sujet`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.reponse : ~4 rows (environ)
/*!40000 ALTER TABLE `reponse` DISABLE KEYS */;
INSERT INTO `reponse` (`id_reponse`, `texte`, `datecreation`, `utilisateur_id`, `topic_id`) VALUES
	(2, 'Les jeux de simulation sont clairement au top ! Niveau sensation de conduite et graphismes ont fait pas mieux en général.', '2020-10-08 08:53:09', 1, 3),
	(3, 'Arcade ! Le réalisme c\'est bien mais il ne faut pas oublier que dans un jeu il s\'agit avant tout de jouer !', '2020-10-08 08:54:16', 2, 3),
	(5, 'Excellent, j\'espere qu\'il y aura de bon topics !', '2020-10-08 09:03:42', 4, 5),
	(6, 'Les semi-Open World ! Plus petit mais proposant souvent un contenu plus dense et intéressant', '2020-10-08 10:44:48', 3, 8),
	(8, 'reponse test', '2020-10-29 13:36:27', 18, 15);
/*!40000 ALTER TABLE `reponse` ENABLE KEYS */;

-- Listage de la structure de la table forum. sujet
CREATE TABLE IF NOT EXISTS `sujet` (
  `id_sujet` int(11) NOT NULL AUTO_INCREMENT,
  `statut` tinyint(1) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `datecreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu` text,
  `utilisateur_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id_sujet`),
  KEY `id_utilisateur` (`utilisateur_id`),
  KEY `id_categorie` (`categorie_id`),
  CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`),
  CONSTRAINT `sujet_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.sujet : ~9 rows (environ)
/*!40000 ALTER TABLE `sujet` DISABLE KEYS */;
INSERT INTO `sujet` (`id_sujet`, `statut`, `titre`, `datecreation`, `contenu`, `utilisateur_id`, `categorie_id`) VALUES
	(3, NULL, 'Simulation ou arcade?', '2020-10-08 08:55:14', 'Lequel vous plaît le plus? Discutons des avantages et inconvénients de chacun', 2, 3),
	(5, NULL, 'Ouverture du Forum', '2020-10-08 08:58:07', 'Bienvenue sur le Forum !', 1, 4),
	(7, NULL, 'Ouverture du Forum', '2020-10-08 09:00:02', 'Bienvenue sur le Forum !', 1, 6),
	(8, NULL, 'Open World ou semi-Open World?', '2020-10-08 10:39:51', 'Lequel préférez-vous? Expliquez pourquoi.', 1, 5),
	(9, NULL, 'Top 10 de vos jeux d\'aventure', '2020-10-20 09:12:44', 'Listez votre Top 10 !', 6, 1),
	(10, NULL, 'Fps ou Tps ?', '2020-10-20 09:13:58', 'Discussion autour de nos préférences...', 5, 2),
	(11, NULL, 'Nombre max de jours survecus dans Green Hell ', '2020-10-20 09:15:49', 'Précisez dans quel mode de difficulté', 4, 4),
	(13, NULL, 'Fifa et Loot Box', '2020-10-20 09:18:22', 'Exprimez vous sur le dévenir de jeux de sports dans le modèle économique actuel', 3, 6),
	(15, NULL, 'Test', '2020-10-29 13:36:18', 'sujet test', 18, 1);
/*!40000 ALTER TABLE `sujet` ENABLE KEYS */;

-- Listage de la structure de la table forum. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT '3',
  `avatar` varchar(255) DEFAULT 'https://i.stack.imgur.com/YaL3s.jpg',
  `dateinscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.utilisateur : ~13 rows (environ)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `mdp`, `role`, `avatar`, `dateinscription`, `mail`) VALUES
	(2, 'Ahmed', '987654', '3', NULL, '2020-10-06 15:39:07', 'ahmed@beautiful.com'),
	(3, 'Matthias', '456987', '3', NULL, '2020-10-08 09:00:49', 'matthias@allemand.com'),
	(4, 'Benjamin', '147896', '3', NULL, '2020-10-08 09:01:43', 'benjamin@dwwm.com'),
	(5, 'BaptistEasy', '369852', '3', NULL, '2020-10-08 09:21:59', 'baptiste@lemagnifique.com'),
	(6, 'Microstophe', '789654', '3', NULL, '2020-10-08 09:22:01', 'cricri@tropmimi.com'),
	(7, 'Virgule', '852147', '3', NULL, '2020-10-08 09:22:01', 'virgile@lavirgule.com'),
	(8, 'JJ', '$2y$10$2cdbMluBCFpCu4d3YeiJm..Bl0xvyOxdvpl9KmQeVHSKM3sTjNzme', '3', NULL, '2020-10-22 14:24:21', 'jeffrey@jefferson.com'),
	(9, 'flo', '123456789', '1', NULL, '2020-10-29 08:59:38', 'flo@flo.com'),
	(11, 'musa', '$2y$10$gBxDawiDkW2ozI7pdtZgCeRcsRcUuvxeR.xYKcnMqKQXP37NlSNeS', '2', NULL, '2020-10-29 09:12:24', 'musa@royalfood.com'),
	(12, 'lolo', '$2y$10$7ZmWg7KNtXhSJtJJvOnTZOrZ/md3Vct0X3ca.yobNhlFacZep2skq', '3', NULL, '2020-10-29 09:20:07', 'lolo@lolo.com'),
	(13, 'brassomax', '$2y$10$gcp9E26FtqST5/iSwzJFGuCsvg4BlTMPtlytTTvpHG1X0B6d5/VsK', '3', NULL, '2020-10-29 09:22:32', 'max@taxi.com'),
	(18, 'Sinana', '$2y$10$Jol6MRLpIJgXZRtikyesROVSPl/PRMeuB4mlN7ag3vom9oVQInmfy', '3', '', '2020-10-29 10:09:30', 'sinan@sinan.com'),
	(19, 'souley', '$2y$10$znVCvg61gC7FQjowTBLsqO/GnTy2F5cNzQWrnHs3TeZXMcEQf3eL6', '3', NULL, '2020-10-29 17:37:58', 'souley@souley.com'),
	(20, 'Benala', '$2y$10$C.JJzM52khunL6Gtax/LjOYaWnVLYducXhlnJmVkAFXydi5Al3TnC', '3', NULL, '2020-10-30 14:44:47', 'benji@lamalice.com'),
	(21, 'Belqiss', '$2y$10$VefzAxz3I2CQNII3b6HcSegeS4f/0EhbXPIwDtnDYbs2HZOjD00bG', '3', NULL, '2020-11-02 11:53:24', 'belqiss@fresh.com'),
	(22, 'stephan', '$2y$10$vyWV21JabM3uJAlPnmamkeCPggXCuHd7puvVVnpH94JvfKeVK6GgO', '3', 'avatar-22.png', '2020-11-03 08:46:56', 'stephanie@stephanie.com');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
