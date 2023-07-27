-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 juil. 2023 à 16:00
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agenceloc`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `vehicules_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `vehicules_id`, `users_id`, `start_at`, `end_at`, `total`, `created_at`) VALUES
(1, 5, 1, '2023-07-24 00:00:00', '2023-07-28 00:00:00', 1000, '2023-02-22 12:23:04'),
(2, 1, 1, '2018-01-01 00:00:00', '2018-01-01 00:00:00', 0, '2023-02-22 14:00:18'),
(3, 1, 1, '2023-02-22 00:00:00', '2023-02-23 00:00:00', 500, '2023-02-22 15:16:40'),
(4, 5, 1, '2023-02-25 00:00:00', '2023-02-26 00:00:00', 1000, '2023-02-22 15:35:25'),
(5, 1, 1, '2023-02-22 00:00:00', '2023-02-25 00:00:00', 1500, '2023-02-22 16:56:55'),
(6, 1, 1, '2023-03-13 00:00:00', '2023-03-15 00:00:00', 1000, '2023-03-13 10:20:21'),
(7, 1, 1, '2023-07-20 00:00:00', '2023-07-20 00:00:00', 0, '2023-07-19 09:51:59'),
(8, 1, 1, '2023-07-20 00:00:00', '2023-07-20 00:00:00', 500, '2023-07-19 09:58:01'),
(9, 1, 1, '2023-07-20 00:00:00', '2023-07-20 00:00:00', 500, '2023-07-19 10:00:14'),
(10, 4, 1, '2023-07-20 00:00:00', '2023-07-20 00:00:00', 500, '2023-07-19 10:04:37'),
(11, 1, 1, '2023-07-20 00:00:00', '2023-07-21 00:00:00', 500, '2023-07-19 10:06:08'),
(12, 1, 1, '2023-08-19 00:00:00', '2023-09-02 00:00:00', 7000, '2023-07-19 11:57:18'),
(13, 1, 1, '2023-07-28 00:00:00', '2023-07-30 00:00:00', 1000, '2023-07-27 15:57:59');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230221090314', '2023-02-21 10:03:25', 57),
('DoctrineMigrations\\Version20230221103220', '2023-02-21 11:32:26', 49),
('DoctrineMigrations\\Version20230221125614', '2023-02-21 13:56:21', 129),
('DoctrineMigrations\\Version20230222103524', '2023-02-22 11:36:46', 36);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `civility` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `firstname`, `lastname`, `civility`, `created_at`) VALUES
(1, 'lebron.pro.77@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$BwcNklvrA7waSDa31AW7j.s4dmsqAT931ZaI0wQebR69ODXuLHz5O', 'Ryu', 'Julien', 'Lebron', 'Homme', '2023-02-21 11:41:45'),
(3, 'test@gmail.com', '[]', '$2y$13$YtJPEsZQOHLYLPebqVcP5ON58/GuEAN3STquatYdQdmeIv9EWHn/S', 'test', 'test', 'test', 'homme', '2023-02-22 16:04:35'),
(4, 'adriana.gonzalez@live.fr', '[]', '$2y$13$2maz/j3QgIyKLPXlvOqVjeU6YDD3y.ZQjlorrAIIfsajVzg9Xszna', 'Adriana1090', 'Adriana', 'Gonzalez', 'Femme', '2023-02-22 16:26:07');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `title`, `brand`, `model`, `content`, `image`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Mercedes AMG GT Coupe AMG Speedshift DCT Black Series', 'Mercedes', 'AMG GT Coupe', 'La Mercedes-AMG GT est une voiture sportive produite par le constructeur automobile allemand Mercedes-AMG de 2014 à 2021. Il s\'agit de la seconde voiture de sport développée complètement en interne après la Mercedes-Benz SLS AMG.', 'mercedes-amg-63f5f34bf407e790442919.jpg', 500, '2023-02-22 11:49:47', '2023-02-22 11:49:47'),
(2, 'Audi R8 V10 5.2 FSI 620 S tronic 7 Performance Quattro', 'Audi', 'R8', 'L\'Audi R8 est une voiture de compétition faisant partie de la catégorie LMP900 (devenue LMP1) des épreuves d\'endurance, telles que les 24 Heures du Mans, l\'ALMS ou encore la série LMS.\r\n', 'audi-r8-63f615c422a4e229465994.jpg', 250, '2023-02-22 14:16:34', '2023-02-22 14:16:52'),
(3, 'BMW M4 CSL', 'BMW', 'M4 CSL', 'La BMW M4 est un coupé du constructeur automobile allemand BMW M du groupe BMW, commercialisée de 2014 à 2021. Basée sur la BMW Série 4, elle s\'inscrit dans la lignée et dans la philosophie des BMW M3, avec pour vocation de remplacer la BMW série 3 coupé.', 'bmw-63f61687dd7d2438746760.jpg', 300, '2023-02-22 14:20:07', '2023-02-22 14:20:07'),
(4, 'Mercedes amg gt 4.0 v8 black series 730 cv - monaco', 'Mercedes', 'AMG GT', 'Mercedes-AMG est un préparateur allemand de voitures du constructeur Mercedes-Benz. Devenu une filiale de la marque depuis 1999, c\'est le seul constructeur au monde à proposer plus de quinze modèles de plus de 500 chevaux et certains modèles dépassent les 600 chevaux.', 'amg-gt-black-63f61b268aed6653049132.jpg', 500, '2023-02-22 14:39:50', '2023-02-22 14:39:50'),
(5, 'Porsche Carrera GT - Argent GT', 'Porsche', 'Carrera GT', 'La Porsche Carrera GT est une supercar produite par le constructeur automobile allemand Porsche de 2003 à 2006, successeur de la Porsche 911 GT1. À l\'origine présentée comme un concept car par le constructeur, elle est ensuite devenue un des rares véhicules de série dont la vitesse de pointe dépasse les 300 km/h. Pour atteindre de telles performances, l\'engin est équipé d\'un moteur V10 développant 612 chevaux et de freins céramiques perforés et ventilés.', 'carrera-gt-63f61ba5044c4691027897.jpg', 1000, '2023-02-22 14:41:56', '2023-02-22 14:41:56'),
(7, 'Mercedes Classe C 200 d 9G-Tronic AMG', 'MERCEDES-BENZ', 'Classe C', 'Dans son design et comme dans sa conduite, la Mercedes-AMG Classe C Coupé  incarne le nec plus ultra en matière de performance. Le dynamisme exacerbé transparaît dans les plus petits détails – les traits dominateurs du design ont été accentués lors du restylage et révèlent une personnalité plus expressive et charismatique que jamais.', 'mercedes-classe-c-64b7a6538f8e1802729499.jpg', 149, '2023-07-19 11:01:07', '2023-07-19 11:01:07');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D8D8BD7E2` (`vehicules_id`),
  ADD KEY `IDX_6EEAA67D67B3B43D` (`users_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_6EEAA67D8D8BD7E2` FOREIGN KEY (`vehicules_id`) REFERENCES `vehicule` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
