-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Apr 2022 um 10:15
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
-- Tabellenstruktur für Tabelle `bread`
--

DROP TABLE IF EXISTS `bread`;
CREATE TABLE `bread` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `length`
--

DROP TABLE IF EXISTS `length`;
CREATE TABLE `length` (
  `id` int(11) NOT NULL,
  `cm` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `breadId` int(11) NOT NULL,
  `lengthId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order_topping`
--

DROP TABLE IF EXISTS `order_topping`;
CREATE TABLE `order_topping` (
  `orderId` int(11) NOT NULL,
  `toppingId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topping`
--

DROP TABLE IF EXISTS `topping`;
CREATE TABLE `topping` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `price` float NOT NULL,
  `categorieId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `firstname`, `name`, `username`, `password`) VALUES
(1, 'Max', 'Mustermann', 'sithlord', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bread`
--
ALTER TABLE `bread`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `length`
--
ALTER TABLE `length`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `breadId` (`breadId`),
  ADD KEY `lengthId` (`lengthId`);

--
-- Indizes für die Tabelle `order_topping`
--
ALTER TABLE `order_topping`
  ADD PRIMARY KEY (`orderId`,`toppingId`),
  ADD KEY `toppingId` (`toppingId`);

--
-- Indizes für die Tabelle `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorieId` (`categorieId`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bread`
--
ALTER TABLE `bread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `length`
--
ALTER TABLE `length`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `topping`
--
ALTER TABLE `topping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`breadId`) REFERENCES `bread` (`id`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`lengthId`) REFERENCES `length` (`id`);

--
-- Constraints der Tabelle `order_topping`
--
ALTER TABLE `order_topping`
  ADD CONSTRAINT `order_topping_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_topping_ibfk_2` FOREIGN KEY (`toppingId`) REFERENCES `topping` (`id`);

--
-- Constraints der Tabelle `topping`
--
ALTER TABLE `topping`
  ADD CONSTRAINT `topping_ibfk_1` FOREIGN KEY (`categorieId`) REFERENCES `categorie` (`id`);
COMMIT;
