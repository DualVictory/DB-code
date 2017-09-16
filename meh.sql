-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 16 Septembre 2017 à 19:52
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `meh`
--

-- --------------------------------------------------------

--
-- Structure de la table `connectes`
--

CREATE TABLE `connectes` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `connectes`
--

INSERT INTO `connectes` (`ip`, `timestamp`) VALUES
('::1', 1497862596),
('192.168.10.3', 1497862476);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `credits` int(255) NOT NULL,
  `fiche` int(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `pari` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`pseudo`, `password`, `mail`, `credits`, `fiche`, `ip`, `pari`) VALUES
('Maxime', 'chevre', 'trinquelage@gmail.com', 4996, 4, '127.0.0.1', 821564),
('Emilien', 'lama', 'emilien.cathignol@gmail.com', 376, 2, '192.168.10.1', 276032),
('Theo', 'impala', 'theo.carrel84@gmail.com', 106, 3, '192.168.10.2', 887330),
('Mayeul', 'bouc', 'mephicene26081756@gmail.com', 168, 2, '192.168.10.3', 636292),
('Billy', 'impala', 'billy@gmail.com', 104, 4, '192.168.10.2', 608338);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`pseudo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
