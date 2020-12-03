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


-- Listage de la structure de la base pour niveau2
DROP DATABASE IF EXISTS `niveau2`;
CREATE DATABASE IF NOT EXISTS `niveau2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `niveau2`;

-- Listage de la structure de la table niveau2. bans
DROP TABLE IF EXISTS `bans`;
CREATE TABLE IF NOT EXISTS `bans` (
  `ip` varchar(50) NOT NULL,
  `banned_till` datetime NOT NULL,
  PRIMARY KEY (`ip`,`banned_till`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table niveau2.bans : ~0 rows (environ)
/*!40000 ALTER TABLE `bans` DISABLE KEYS */;
/*!40000 ALTER TABLE `bans` ENABLE KEYS */;

-- Listage de la structure de la table niveau2. connexions
DROP TABLE IF EXISTS `connexions`;
CREATE TABLE IF NOT EXISTS `connexions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `success` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- Listage des données de la table niveau2.connexions : ~6 rows (environ)
/*!40000 ALTER TABLE `connexions` DISABLE KEYS */;
/*!40000 ALTER TABLE `connexions` ENABLE KEYS */;

-- Listage de la structure de la table niveau2. utilisateurs
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(127) NOT NULL,
  `password` varchar(127) NOT NULL,
  `is_pro` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_token` varchar(127) DEFAULT NULL,
  `expiration_token` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Listage des données de la table niveau2.utilisateurs : ~2 rows (environ)
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
