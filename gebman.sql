-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 21. Jun 2018 um 23:37
-- Server-Version: 5.7.22-0ubuntu0.16.04.1
-- PHP-Version: 7.0.30-0ubuntu0.16.04.1

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
  `ausgabe` date DEFAULT NULL,
  `rueckgabe` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Bearbeitung`
--

INSERT INTO `Bearbeitung` (`BearbeitungsID`, `Gebietlink`, `Verkuendiger`, `ausgabe`, `rueckgabe`) VALUES
(174, 439, 35, '2010-10-28', '2011-10-28'),
(247, 439, 35, '2011-10-28', '2012-10-28'),
(249, 439, 9, '2013-10-28', '2014-09-28'),
(250, 439, 3, NULL, '1993-09-30');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Gebiet`
--

CREATE TABLE `Gebiet` (
  `GebieteID` int(11) NOT NULL,
  `GebName` varchar(6) NOT NULL,
  `iframe` varchar(800) NOT NULL,
  `Anmerkung` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Gebiet`
--

INSERT INTO `Gebiet` (`GebieteID`, `GebName`, `iframe`, `Anmerkung`) VALUES
(439, '10', '<iframe src=\'https://geoportal.bayern.de/bayernatlas/embed.html?lang=de&topic=ba&bgLayer=atkis&catalogNodes=11,122&E=4460726.04&N=5304531.82&zoom=13&layers=KML%7C%7Chttps:%2F%2Fgeoportal.bayern.de%2Fba-backend%2Ffiles%2Ff_d930cc00-71a0-11e8-afa6-2709cd4ac985_ba254ac5-778a-415b-9bc2-c9be3e1f7c5c%7C%7Ctrue\' width=\'600\' height=\'450\' frameborder=\'0\' style=\'border:0\'></iframe>', 'test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwort` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vorname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nachname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `passwort`, `vorname`, `nachname`, `created_at`, `updated_at`) VALUES
(1, 'test@test.de', '$2y$10$qCgb4MKzbMKAqUU2LOFBQ.wGoAD6yBElFA7V7EPwK.QGCViJjx4mu', '', '', '2018-06-20 12:11:23', NULL);

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
(35, 'Bogdan Dilaj'),
(9, 'Dilay Viki'),
(332, 'Eugen Barth'),
(3, 'frei'),
(28, 'Hans im GlÃ¼ck'),
(27, 'Herald Peter'),
(33, 'jÃ¼nglin'),
(88, 'JÃ¼rgen'),
(26, 'JÃ¼rgen Urban'),
(36, 'Karaisalidis Michael'),
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
  ADD UNIQUE KEY `GebName` (`GebName`),
  ADD KEY `idx_Gebiet_Name` (`GebName`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `Verkuendiger`
--
ALTER TABLE `Verkuendiger`
  ADD PRIMARY KEY (`VerkuendigerID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Bearbeitung`
--
ALTER TABLE `Bearbeitung`
  MODIFY `BearbeitungsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT für Tabelle `Gebiet`
--
ALTER TABLE `Gebiet`
  MODIFY `GebieteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `Verkuendiger`
--
ALTER TABLE `Verkuendiger`
  MODIFY `VerkuendigerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;
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
