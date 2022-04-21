-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Apr 2022 um 16:57
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `order66`
--
CREATE DATABASE IF NOT EXISTS `order66` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `order66`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

DROP TABLE IF EXISTS `bestellung`;
CREATE TABLE IF NOT EXISTS `bestellung` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `brotId` int(11) NOT NULL,
  `laengeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `brotId` (`brotId`),
  KEY `laengeId` (`laengeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_topping`
--

DROP TABLE IF EXISTS `bestellung_topping`;
CREATE TABLE IF NOT EXISTS `bestellung_topping` (
  `bestellungId` int(11) NOT NULL,
  `toppingId` int(11) NOT NULL,
  PRIMARY KEY (`bestellungId`,`toppingId`),
  KEY `toppingId` (`toppingId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `brot`
--

DROP TABLE IF EXISTS `brot`;
CREATE TABLE IF NOT EXISTS `brot` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `preis` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

DROP TABLE IF EXISTS `kategorie`;
CREATE TABLE IF NOT EXISTS `kategorie` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `laenge`
--

DROP TABLE IF EXISTS `laenge`;
CREATE TABLE IF NOT EXISTS `laenge` (
  `id` int(11) NOT NULL,
  `cm` int(11) NOT NULL,
  `preis` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topping`
--

DROP TABLE IF EXISTS `topping`;
CREATE TABLE IF NOT EXISTS `topping` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `preis` float NOT NULL,
  `kategorieId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kategorieId` (`kategorieId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `vorname` varchar(64) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `passwort` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `bestellung_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `bestellung_ibfk_2` FOREIGN KEY (`brotId`) REFERENCES `brot` (`id`),
  ADD CONSTRAINT `bestellung_ibfk_3` FOREIGN KEY (`laengeId`) REFERENCES `laenge` (`id`);

--
-- Constraints der Tabelle `bestellung_topping`
--
ALTER TABLE `bestellung_topping`
  ADD CONSTRAINT `bestellung_topping_ibfk_1` FOREIGN KEY (`bestellungId`) REFERENCES `bestellung` (`id`),
  ADD CONSTRAINT `bestellung_topping_ibfk_2` FOREIGN KEY (`toppingId`) REFERENCES `topping` (`id`);

--
-- Constraints der Tabelle `topping`
--
ALTER TABLE `topping`
  ADD CONSTRAINT `topping_ibfk_1` FOREIGN KEY (`kategorieId`) REFERENCES `kategorie` (`id`);
COMMIT;