-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 28 jan. 2022 à 11:20
-- Version du serveur :  10.1.25-MariaDB
-- Version de PHP :  7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mados_group`
--

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques`
--

CREATE TABLE `caracteristiques` (
  `ID_CARACTERISTIQUE` int(11) NOT NULL,
  `NOM_CARACTERISTIQUE` varchar(255) NOT NULL,
  `PLACEHOLDER_CARACTERISTIQUE` varchar(255) NOT NULL,
  `SLUG_CARACTERISTIQUE` varchar(255) NOT NULL,
  `CODE_CARACTERISTIQUE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `caracteristiques`
--

INSERT INTO `caracteristiques` (`ID_CARACTERISTIQUE`, `NOM_CARACTERISTIQUE`, `PLACEHOLDER_CARACTERISTIQUE`, `SLUG_CARACTERISTIQUE`, `CODE_CARACTERISTIQUE`) VALUES
(1, 'Nombre de chambres', 'Exemple: 5 chambres', 'nombre-de-chambres', '9107de29cd89f31fa9fc91f83023bd59'),
(2, 'Nombre de toilette', 'Exemple: 2 toilettes ', 'nombre-de-toilette', 'f9a0d050e9231666864ccba6ab960518'),
(3, 'Nombre de douches', 'Exemple: 2 douches', 'nombre-de-douches', '90126a4f7592617981432bb788f1ca41'),
(4, 'Garage', 'Exemple: Oui', 'garage', '624540d278e6627823419a1da33c2b3a'),
(5, 'Largeur', 'Exemple: 400 mètres', 'largeur', '06fb6c8e52d3ce51db4de442a9df59de'),
(6, 'Longeur', 'Exemple: 500 mètres ', 'longeur', 'b233c8a02300ad1d22715373b31bba7d'),
(7, 'Surface', 'Exemple: 400 mètres carrée ', 'surface', '3617a0f8f37cc17c2d818cc304ddf394');

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques_propriete`
--

CREATE TABLE `caracteristiques_propriete` (
  `CODE_PROPRIETE` varchar(255) NOT NULL,
  `CODE_CARACTERISTIQUE` varchar(255) NOT NULL,
  `VALEUR_CARACTERISTIQUE` varchar(255) NOT NULL,
  `SLUG_VALEUR_CARACTERISTIQUE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `caracteristiques_propriete`
--

INSERT INTO `caracteristiques_propriete` (`CODE_PROPRIETE`, `CODE_CARACTERISTIQUE`, `VALEUR_CARACTERISTIQUE`, `SLUG_VALEUR_CARACTERISTIQUE`) VALUES
('24bae6d78c1ecb36eaf899f1469c27f8', '9107de29cd89f31fa9fc91f83023bd59', '4 chambres', '4-chambres'),
('24bae6d78c1ecb36eaf899f1469c27f8', 'f9a0d050e9231666864ccba6ab960518', '2 toilettes', '2-toilettes'),
('24bae6d78c1ecb36eaf899f1469c27f8', '90126a4f7592617981432bb788f1ca41', '2 douches', '2-douches'),
('24bae6d78c1ecb36eaf899f1469c27f8', '624540d278e6627823419a1da33c2b3a', 'Oui', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiques_type_propriete`
--

CREATE TABLE `caracteristiques_type_propriete` (
  `CODE_CARACTERISTIQUE` varchar(255) NOT NULL,
  `CODE_TYPE_PROPRIETE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `caracteristiques_type_propriete`
--

INSERT INTO `caracteristiques_type_propriete` (`CODE_CARACTERISTIQUE`, `CODE_TYPE_PROPRIETE`) VALUES
('9107de29cd89f31fa9fc91f83023bd59', '81164b5d0419ba4c0521f790b96e27eb'),
('f9a0d050e9231666864ccba6ab960518', '81164b5d0419ba4c0521f790b96e27eb'),
('90126a4f7592617981432bb788f1ca41', '81164b5d0419ba4c0521f790b96e27eb'),
('624540d278e6627823419a1da33c2b3a', '81164b5d0419ba4c0521f790b96e27eb'),
('06fb6c8e52d3ce51db4de442a9df59de', '020fdb7c449d4d75129ec2c3e8f9f00a'),
('b233c8a02300ad1d22715373b31bba7d', '020fdb7c449d4d75129ec2c3e8f9f00a'),
('3617a0f8f37cc17c2d818cc304ddf394', '020fdb7c449d4d75129ec2c3e8f9f00a');

-- --------------------------------------------------------

--
-- Structure de la table `propriete`
--

CREATE TABLE `propriete` (
  `ID_PROPRIETE` bigint(22) NOT NULL,
  `NOM_PROPRIETE` varchar(255) NOT NULL,
  `SLUG_NOM_PROPRIETE` varchar(255) NOT NULL,
  `PROPRIETE_VIEWS` int(11) NOT NULL,
  `PROPRIETE_RATING_NOTE` double NOT NULL,
  `PHOTO_PRINCIPALE_PROPRIETE` varchar(255) NOT NULL,
  `PRIX_PROPRIETE` double NOT NULL,
  `CODE_TYPE_PROPRIETE` varchar(255) NOT NULL,
  `DESCRIPTION_PROPRIETE` longtext NOT NULL,
  `VALIDE` tinyint(1) NOT NULL,
  `ACTIF` tinyint(1) NOT NULL,
  `DATE_CREATION` datetime NOT NULL,
  `CODE_PROPRIETE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `propriete`
--

INSERT INTO `propriete` (`ID_PROPRIETE`, `NOM_PROPRIETE`, `SLUG_NOM_PROPRIETE`, `PROPRIETE_VIEWS`, `PROPRIETE_RATING_NOTE`, `PHOTO_PRINCIPALE_PROPRIETE`, `PRIX_PROPRIETE`, `CODE_TYPE_PROPRIETE`, `DESCRIPTION_PROPRIETE`, `VALIDE`, `ACTIF`, `DATE_CREATION`, `CODE_PROPRIETE`) VALUES
(1, 'Maison d\'habitation haut standing de ', 'maison-dhabitation-haut-standing-de', 0, 0, 'propriete24bae6d78c1ecb36eaf899f1469c27f8.jpeg', 500000000, '81164b5d0419ba4c0521f790b96e27eb', 'Une belle maison a vendre ', 0, 0, '2022-01-28 11:16:42', '24bae6d78c1ecb36eaf899f1469c27f8');

-- --------------------------------------------------------

--
-- Structure de la table `type_propriete`
--

CREATE TABLE `type_propriete` (
  `ID_TYPE_PROPRIETE` int(11) NOT NULL,
  `TYPE_PROPRIETE` varchar(255) NOT NULL,
  `SLUG_TYPE_PROPRIETE` varchar(255) NOT NULL,
  `CODE_TYPE_PROPRIETE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_propriete`
--

INSERT INTO `type_propriete` (`ID_TYPE_PROPRIETE`, `TYPE_PROPRIETE`, `SLUG_TYPE_PROPRIETE`, `CODE_TYPE_PROPRIETE`) VALUES
(3, 'Maison', 'maison', '81164b5d0419ba4c0521f790b96e27eb'),
(4, 'Parcelle', 'parcelle', '020fdb7c449d4d75129ec2c3e8f9f00a');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  ADD PRIMARY KEY (`ID_CARACTERISTIQUE`);

--
-- Index pour la table `propriete`
--
ALTER TABLE `propriete`
  ADD PRIMARY KEY (`ID_PROPRIETE`);

--
-- Index pour la table `type_propriete`
--
ALTER TABLE `type_propriete`
  ADD PRIMARY KEY (`ID_TYPE_PROPRIETE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caracteristiques`
--
ALTER TABLE `caracteristiques`
  MODIFY `ID_CARACTERISTIQUE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `propriete`
--
ALTER TABLE `propriete`
  MODIFY `ID_PROPRIETE` bigint(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `type_propriete`
--
ALTER TABLE `type_propriete`
  MODIFY `ID_TYPE_PROPRIETE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
