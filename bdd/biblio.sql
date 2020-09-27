-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 27 sep. 2020 à 16:35
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `biblio`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$/0VycxRF0GKESReNrLZapeuqjSa215Lufy0nxGA0gdX4dgWDc9Cky');

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

DROP TABLE IF EXISTS `manga`;
CREATE TABLE IF NOT EXISTS `manga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `edition` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`id`, `titre`, `edition`, `genre`, `image`, `description`) VALUES
(1, 'One piece', 'Glenat', 'Shonen', 'onePiece.jpg', 'The series focuses on Monkey D. Luffy, a young man who, inspired by his childhood idol and powerful pirate \"Red Haired\" Shanks, sets off on a journey from the East Blue Sea to find the titular treasure and proclaim himself the King of the Pirates. In an effort to organize his own crew, the Straw Hat Pirates, Luffy rescues and befriends a swordsman named Roronoa Zoro, and they head off in search of the One Piece. They are joined in their journey by Nami, a navigator and thief; Usopp, a sniper and a pathological liar; and Vinsmoke Sanji, a womanizing chef. They acquire a ship named the Going Merry and engage in confrontations with notorious pirates of the East Blue. \r\n\r\nAs Luffy and his crew set out on their adventures, others join the crew later in the series, including Tony Tony Chopper, a doctor and anthropomorphized reindeer; Nico Robin, an archaeologist and former assassin; Franky, a cyborg shipwright; Brook, a skeletal musician and swordsman; and Jimbei, a fish-man helmsman and former member of the Seven Warlords of the Sea. Once the Going Merry becomes damaged beyond repair, the Straw Hat Pirates acquire a new ship named the Thousand Sunny[Jp 3]. Together, they encounter other pirates, bounty hunters, criminal organizations, revolutionaries, secret agents and soldiers of the corrupt World Government, and various other friends and foes, as they sail the seas in pursuit of their dreams.'),
(2, 'Magus of the library', 'Ki-oon', 'Seinen', 'magus.jpg', 'A story about a poor boy swept away by a kind library mage and the (literal) magic of reading, Magus of the Library is a beautifully-drawn, spirited fantasy adventure, like a Fullmetal Alchemist for all ages!\r\n\r\nIn the small village of Amun lives a poor boy named Theo. Theo adores books, but because of his pointed ears and impoverished life, he isn’t allowed to use the village library. As he endures the prejudice and hatred of the village, he dreams of going where such things don’t exist: Aftzaak, City of Books. But one day, Theo chances to meet a Kafna—a librarian who works for the great library of Aftzaak—and his life changes forever …'),
(3, 'Re/member', 'Ki-oon', 'Shonen', 'remember.jpg', 'Asuka and her classmates are haunted by a ghost, who has asked them to retrieve the eight limbs that make up her body. If they can\'t find them all, they will die and have to face this terrible day again ...');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
