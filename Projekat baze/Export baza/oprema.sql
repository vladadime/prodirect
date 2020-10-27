-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 15. Feb 2018. u 12:36
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oprema`
--

-- --------------------------------------------------------

--
-- Struktura tabele `boja`
--

DROP TABLE IF EXISTS `boja`;
CREATE TABLE IF NOT EXISTS `boja` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `boja` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `boja`
--

INSERT INTO `boja` (`id`, `boja`) VALUES
(1, 'Crvena'),
(2, 'Plava'),
(3, 'Zelena'),
(4, 'Narandzasta'),
(5, 'Ljubicasta'),
(6, 'Roze'),
(7, 'Zuta'),
(8, 'Braon'),
(9, 'Crna'),
(10, 'Bela');

-- --------------------------------------------------------

--
-- Struktura tabele `grad`
--

DROP TABLE IF EXISTS `grad`;
CREATE TABLE IF NOT EXISTS `grad` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `grad` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `grad`
--

INSERT INTO `grad` (`id`, `grad`) VALUES
(1, 'Beograd'),
(2, 'Novi Sad'),
(3, 'Nis'),
(4, 'Leskovac'),
(5, 'Pirot'),
(6, 'Vranje'),
(7, 'Uzice'),
(8, 'Kragujevac'),
(9, 'Subotica'),
(10, 'Paracin'),
(11, 'Jagodina'),
(12, 'Pancevo'),
(13, 'Smederevo'),
(14, 'Krusevac'),
(15, 'Bor'),
(16, 'Zajecar'),
(17, 'Negotin');

-- --------------------------------------------------------

--
-- Struktura tabele `kupci`
--

DROP TABLE IF EXISTS `kupci`;
CREATE TABLE IF NOT EXISTS `kupci` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `adresa` varchar(150) NOT NULL,
  `telefon` varchar(10) NOT NULL,
  `id_grad` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `telefon` (`telefon`),
  UNIQUE KEY `email` (`email`),
  KEY `id_grad` (`id_grad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `kupci`
--

INSERT INTO `kupci` (`id`, `ime`, `prezime`, `adresa`, `telefon`, `id_grad`, `email`) VALUES
(1, 'Pera', 'Peric', 'Visegradska 155', '0641234321', 3, 'pera@hotmail.com'),
(2, 'Mika', 'Mikic', 'Kosmajska 3', '063726910', 1, 'mika@hotmail.com'),
(3, 'Laza', 'Lazic', 'Ilije Garasanina 18', '0616720132', 6, 'laza@hotmail.com'),
(4, 'Sima', 'Simic', 'Podunavska bb', '0639301342', 10, 'sima@hotmail.com'),
(5, 'Petar', 'Petrovic', 'Obilicev Venac 29', '0651267834', 3, 'petar@hotmail.com');

-- --------------------------------------------------------

--
-- Struktura tabele `marka`
--

DROP TABLE IF EXISTS `marka`;
CREATE TABLE IF NOT EXISTS `marka` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `marka` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `marka`
--

INSERT INTO `marka` (`id`, `marka`) VALUES
(1, 'Adidas'),
(2, 'Nike'),
(3, 'Puma'),
(4, 'Reebok'),
(5, 'New Balance'),
(6, 'Umbro'),
(7, 'Converse'),
(8, 'Diadora'),
(9, 'Arena'),
(10, 'Rider');

-- --------------------------------------------------------

--
-- Struktura tabele `namena`
--

DROP TABLE IF EXISTS `namena`;
CREATE TABLE IF NOT EXISTS `namena` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `namena` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `namena`
--

INSERT INTO `namena` (`id`, `namena`) VALUES
(1, 'fudbal'),
(2, 'kosarka'),
(3, 'odbojka'),
(4, 'rukomet'),
(5, 'tenis'),
(6, 'trcanje'),
(7, 'lifestyle'),
(8, 'plivanje'),
(9, 'fitnes');

-- --------------------------------------------------------

--
-- Struktura tabele `narudzbine`
--

DROP TABLE IF EXISTS `narudzbine`;
CREATE TABLE IF NOT EXISTS `narudzbine` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_robe` int(5) NOT NULL,
  `id_kupca` int(5) NOT NULL,
  `datum_narucivanja` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_robe` (`id_robe`),
  KEY `id_kupca` (`id_kupca`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `narudzbine`
--

INSERT INTO `narudzbine` (`id`, `id_robe`, `id_kupca`, `datum_narucivanja`) VALUES
(1, 1, 1, '2017-03-10'),
(2, 2, 4, '2017-04-13'),
(3, 5, 3, '2017-05-15');

-- --------------------------------------------------------

--
-- Struktura tabele `prijava`
--

DROP TABLE IF EXISTS `prijava`;
CREATE TABLE IF NOT EXISTS `prijava` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(20) NOT NULL DEFAULT '',
  `lozinka` varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `prijava`
--

INSERT INTO `prijava` (`id`, `korisnicko_ime`, `lozinka`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 'gost', '660c84c6dd1932c553806e682b8f9e7152602abf');

-- --------------------------------------------------------

--
-- Struktura tabele `roba`
--

DROP TABLE IF EXISTS `roba`;
CREATE TABLE IF NOT EXISTS `roba` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_vrsta_robe` int(5) NOT NULL,
  `id_marka` int(5) NOT NULL,
  `naziv_robe` varchar(30) DEFAULT NULL,
  `id_namena` int(5) DEFAULT NULL,
  `velicina` varchar(6) NOT NULL,
  `cena` int(10) NOT NULL,
  `pol` varchar(6) NOT NULL,
  `id_boja` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vrsta_robe` (`id_vrsta_robe`),
  KEY `id_namena` (`id_namena`),
  KEY `id_marka` (`id_marka`),
  KEY `id_boja` (`id_boja`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `roba`
--

INSERT INTO `roba` (`id`, `id_vrsta_robe`, `id_marka`, `naziv_robe`, `id_namena`, `velicina`, `cena`, `pol`, `id_boja`) VALUES
(1, 1, 1, 'Predator', 1, '43', 4000, 'muski', 1),
(2, 1, 2, 'Michael Jordan', 2, '42', 6000, 'muski', 9),
(3, 3, 3, NULL, 7, '41', 5500, 'muski', 10),
(4, 2, 2, 'Mercurial', 1, '44', 5700, 'muski', 2),
(5, 4, 2, NULL, 7, '41', 1500, 'zenski', 7),
(6, 1, 2, 'Michael Jordan', 2, '42', 6000, 'muski', 9),
(7, 4, 10, NULL, 7, '43', 1500, 'zenski', 6),
(8, 5, 1, NULL, 1, 'S', 4500, 'muski', 7),
(9, 5, 2, NULL, 9, 'XL', 6000, 'muski', 1),
(11, 7, 8, NULL, 6, 'L', 5700, 'muski', 2),
(12, 6, 3, NULL, 9, 'M', 1500, 'zenski', 7),
(13, 7, 2, 'Mercurial', 1, 'XS', 1500, 'zenski', 1);

-- --------------------------------------------------------

--
-- Struktura tabele `vrsta_robe`
--

DROP TABLE IF EXISTS `vrsta_robe`;
CREATE TABLE IF NOT EXISTS `vrsta_robe` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `vrsta_robe` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Prikaz podataka tabele `vrsta_robe`
--

INSERT INTO `vrsta_robe` (`id`, `vrsta_robe`) VALUES
(1, 'patike'),
(2, 'kopacke'),
(3, 'cipele'),
(4, 'papuce'),
(5, 'trenerke'),
(6, 'majice'),
(7, 'sorcevi'),
(8, 'kupaci kostim');

--
-- Ograničenja za izvezene tabele
--

--
-- Ograničenja za tabele `kupci`
--
ALTER TABLE `kupci`
  ADD CONSTRAINT `kupci_ibfk_1` FOREIGN KEY (`id_grad`) REFERENCES `grad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tabele `narudzbine`
--
ALTER TABLE `narudzbine`
  ADD CONSTRAINT `narudzbine_ibfk_1` FOREIGN KEY (`id_robe`) REFERENCES `roba` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `narudzbine_ibfk_2` FOREIGN KEY (`id_kupca`) REFERENCES `kupci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograničenja za tabele `roba`
--
ALTER TABLE `roba`
  ADD CONSTRAINT `roba_ibfk_1` FOREIGN KEY (`id_vrsta_robe`) REFERENCES `vrsta_robe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roba_ibfk_2` FOREIGN KEY (`id_namena`) REFERENCES `namena` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roba_ibfk_3` FOREIGN KEY (`id_marka`) REFERENCES `marka` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roba_ibfk_4` FOREIGN KEY (`id_boja`) REFERENCES `boja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
