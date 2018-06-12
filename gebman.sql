-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 21. Apr 2018 um 21:47
-- Server-Version: 5.7.20-0ubuntu0.16.04.1
-- PHP-Version: 7.0.24-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `gebman`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Bearbeitung`
--

CREATE TABLE `Bearbeitung` (
  `BearbeitungsID` int(11) NOT NULL,
  `Gebietlink` int(11) NOT NULL,
  `Verkuendiger` int(11) NOT NULL,
  `ausgabe` date NOT NULL,
  `rueckgabe` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Bearbeitung`
--

INSERT INTO `Bearbeitung` (`BearbeitungsID`, `Gebietlink`, `Verkuendiger`, `ausgabe`, `rueckgabe`) VALUES
(2, 2, 3, '2018-04-01', '2018-04-10'),
(3, 1, 1, '2018-04-03', '2018-04-10'),
(4, 1, 3, '2018-04-01', '2018-04-10'),
(5, 4, 3, '2018-02-13', '2018-04-11'),
(6, 5, 1, '2018-01-08', '2018-03-15'),
(7, 3, 3, '2018-02-13', '2018-04-11'),
(8, 334, 1, '2018-01-08', '2018-03-15'),
(9, 335, 3, '2018-02-13', '2018-04-11'),
(10, 336, 1, '2018-01-08', '2018-03-15'),
(11, 337, 3, '2018-02-13', '2018-04-11'),
(12, 338, 1, '2018-01-08', '2018-03-15'),
(13, 339, 3, '2018-02-13', '2018-04-11'),
(14, 340, 1, '2018-01-08', '2018-03-15'),
(15, 341, 3, '2018-02-13', '2018-04-11'),
(16, 341, 1, '2018-01-08', '2018-03-15'),
(17, 1, 1, '2017-12-18', '2018-02-13'),
(18, 1, 3, '2017-08-16', '2018-03-15'),
(19, 1, 1, '2017-12-18', '2018-02-13'),
(20, 1, 3, '2017-08-16', '2018-03-15'),
(21, 1, 1, '2017-12-18', '2018-02-13'),
(22, 1, 3, '2017-08-16', '2018-03-15'),
(23, 1, 1, '2017-12-18', '2018-02-13'),
(24, 1, 3, '2017-08-16', '2018-03-15'),
(25, 1, 1, '2017-12-18', '2018-02-13'),
(26, 1, 3, '2017-08-16', '2018-03-15'),
(27, 1, 1, '2017-12-18', '2018-02-13'),
(28, 1, 3, '2017-08-16', '2018-03-15'),
(29, 1, 1, '2017-12-18', '2018-02-13'),
(30, 1, 3, '2017-08-16', '2018-03-15'),
(31, 1, 1, '2017-12-18', '2018-02-13'),
(32, 1, 3, '2017-08-16', '2018-03-15'),
(33, 1, 1, '2017-12-18', '2018-02-13'),
(34, 1, 3, '2017-08-16', '2018-03-15'),
(35, 1, 1, '2017-12-18', '2018-02-13'),
(36, 1, 3, '2017-08-16', '2018-03-15'),
(37, 1, 1, '2017-12-18', '2018-02-13'),
(38, 1, 3, '2017-08-16', '2018-03-15'),
(39, 1, 1, '2017-12-18', '2018-02-13'),
(40, 1, 3, '2017-08-16', '2018-03-15'),
(41, 1, 1, '2017-12-18', '2018-02-13'),
(42, 1, 3, '2017-08-16', '2018-03-15'),
(43, 1, 1, '2017-12-18', '2018-02-13'),
(44, 1, 3, '2017-08-16', '2018-03-15'),
(45, 1, 4, '2018-04-01', '2018-04-16');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Gebiet`
--

CREATE TABLE `Gebiet` (
  `GebieteID` int(11) NOT NULL,
  `GebName` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Gebiet`
--

INSERT INTO `Gebiet` (`GebieteID`, `GebName`) VALUES
(1, '10'),
(2, '20'),
(4, '232'),
(3, '233'),
(334, '236'),
(5, '237'),
(336, '238'),
(335, '333'),
(337, '338'),
(338, '348'),
(339, '358'),
(340, '368'),
(341, '378');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Verkuendiger`
--

CREATE TABLE `Verkuendiger` (
  `VerkuendigerID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Verkuendiger`
--

INSERT INTO `Verkuendiger` (`VerkuendigerID`, `Name`) VALUES
(1, 'Bogdan Dilaj'),
(3, 'Eugen Barth'),
(4, 'Peter Pan');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Bearbeitung`
--
ALTER TABLE `Bearbeitung`
  ADD PRIMARY KEY (`BearbeitungsID`),
  ADD KEY `fk_Bearbeitung_Gebiet` (`Gebietlink`),
  ADD KEY `fk_Bearbeitung_Verkuendiger` (`Verkuendiger`);

--
-- Indizes für die Tabelle `Gebiet`
--
ALTER TABLE `Gebiet`
  ADD PRIMARY KEY (`GebieteID`),
  ADD KEY `idx_Gebiet_Name` (`GebName`);

--
-- Indizes für die Tabelle `Verkuendiger`
--
ALTER TABLE `Verkuendiger`
  ADD PRIMARY KEY (`VerkuendigerID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Bearbeitung`
--
ALTER TABLE `Bearbeitung`
  MODIFY `BearbeitungsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT für Tabelle `Gebiet`
--
ALTER TABLE `Gebiet`
  MODIFY `GebieteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;
--
-- AUTO_INCREMENT für Tabelle `Verkuendiger`
--
ALTER TABLE `Verkuendiger`
  MODIFY `VerkuendigerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Bearbeitung`
--
ALTER TABLE `Bearbeitung`
  ADD CONSTRAINT `fk_Bearbeitung_Gebiet` FOREIGN KEY (`Gebietlink`) REFERENCES `Gebiet` (`GebieteID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Bearbeitung_Verkuendiger` FOREIGN KEY (`Verkuendiger`) REFERENCES `Verkuendiger` (`VerkuendigerID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
