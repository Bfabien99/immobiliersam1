-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 15 avr. 2022 à 15:37
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobiliersam`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenoms`, `email`, `password`) VALUES
(1, 'brou', 'fabien', 'zanpolobino99@gmail.com', '0c7540eb7e65b553ec1ba6b20de79608');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenoms` varchar(200) NOT NULL,
  `pseudo` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact1` varchar(200) NOT NULL,
  `contact2` varchar(200) DEFAULT NULL,
  `password` varchar(225) NOT NULL,
  `cree_le` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenoms`, `pseudo`, `email`, `contact1`, `contact2`, `password`, `cree_le`) VALUES
(1, 'brou', 'kouadio stéphane-fabien', 'brou', 'fabienbrou99@gmail.com', '0153148864', '0504774183', '8082b382bea4c85367617e7271768276', '2022-04-12 14:33:43'),
(2, 'konan', 'arsene', 'arsene', 'arseneesaie@gmail.com', '0101010101', '', 'c3b55d35cac16f624ff737c5d7785d00', '2022-04-14 14:10:34'),
(3, 'fabien', 'id consequatur pari', 'fabiien', 'licynusyzu@mailinator.com', '11497033614', '12073234936', '8082b382bea4c85367617e7271768276', '2022-04-14 14:56:43'),
(4, 'essoh', 'jean penuel', 'penuel', 'penuel@gmail.com', '001001010', '00101000', '6aa8b883a5db6d90874b79ea21c52a25', '2022-04-15 10:28:54');

-- --------------------------------------------------------

--
-- Structure de la table `interest`
--

CREATE TABLE `interest` (
  `id` int(11) NOT NULL,
  `maison_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `interest`
--

INSERT INTO `interest` (`id`, `maison_id`, `client_id`) VALUES
(1, 2, 2),
(3, 2, 3),
(4, 4, 3),
(5, 2, 1),
(6, 4, 1),
(7, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `maisons`
--

CREATE TABLE `maisons` (
  `id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `image` text NOT NULL,
  `lieu` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `maisons`
--

INSERT INTO `maisons` (`id`, `description`, `image`, `lieu`, `contact`, `date`) VALUES
(2, 'belle maison de mon pap', '$2y$10$jdiHi51JT7hmHb2jyo5wd.2FDC44DvVSWUCJjG7ZhDaQdYhh8CfQamaison.jpg', 'abobo', '0709167244', '2022-04-14 13:09:07'),
(4, 'maison propre', '$2y$10$q70t3w2KxsUaanQwOEN5Xe5ck5ZlhHL2KCnVO.6Qxll3Bw1d2iI5Wkelly-sikkema-tDtwC11XjuU-unsplash.jpg', 'cocody', '+1 (395) 853-9227', '2022-04-14 15:03:29');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT 0,
  `fait_le` datetime DEFAULT current_timestamp(),
  `maison_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date_res` date NOT NULL,
  `heure` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `active`, `fait_le`, `maison_id`, `client_id`, `date_res`, `heure`) VALUES
(11, 1, '2022-04-15 13:09:56', 4, 1, '2022-04-17', '7 heure 0 minute'),
(12, 0, '2022-04-15 13:29:41', 4, 3, '2022-04-29', '11 heure 30 minute'),
(13, 0, '2022-04-15 13:33:14', 2, 3, '2022-04-26', '9 heure 15 minute');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `maison_id` (`maison_id`);

--
-- Index pour la table `maisons`
--
ALTER TABLE `maisons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maison_id` (`maison_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `maisons`
--
ALTER TABLE `maisons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `interest`
--
ALTER TABLE `interest`
  ADD CONSTRAINT `interest_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interest_ibfk_2` FOREIGN KEY (`maison_id`) REFERENCES `maisons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`maison_id`) REFERENCES `maisons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
