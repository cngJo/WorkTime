-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.1.35-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für worktimes
CREATE DATABASE IF NOT EXISTS `worktimes` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `worktimes`;

-- Exportiere Struktur von Tabelle worktimes.login_tokens
CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(64) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_login_tokens_users` (`user_id`),
  CONSTRAINT `FK_login_tokens_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle worktimes.times
CREATE TABLE IF NOT EXISTS `times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign` char(1) NOT NULL,
  `minutes` int(5) NOT NULL,
  `date` varchar(8) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle worktimes.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` text NOT NULL,
  `role` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
