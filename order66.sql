-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Apr 2022 um 15:05
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `order66`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `brotId` int(11) NOT NULL,
  `laengeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_topping`
--

CREATE TABLE `bestellung_topping` (
  `bestellungId` int(11) NOT NULL,
  `toppingId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `brot`
--

CREATE TABLE `brot` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `preis` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `laenge`
--

CREATE TABLE `laenge` (
  `id` int(11) NOT NULL,
  `cm` int(11) NOT NULL,
  `preis` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topping`
--

CREATE TABLE `topping` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `preis` float NOT NULL,
  `kategorieId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `vorname` varchar(64) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `passwort` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `brotId` (`brotId`),
  ADD KEY `laengeId` (`laengeId`);

--
-- Indizes für die Tabelle `bestellung_topping`
--
ALTER TABLE `bestellung_topping`
  ADD PRIMARY KEY (`bestellungId`,`toppingId`),
  ADD KEY `toppingId` (`toppingId`);

--
-- Indizes für die Tabelle `brot`
--
ALTER TABLE `brot`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `laenge`
--
ALTER TABLE `laenge`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorieId` (`kategorieId`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
