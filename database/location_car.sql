-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 22 août 2024 à 20:17
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `location_car`
--

-- --------------------------------------------------------

--
-- Structure de la table `carbrands`
--

CREATE TABLE `carbrands` (
  `id` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carbrands`
--

INSERT INTO `carbrands` (`id`, `name`, `image`, `description`, `added_by`, `created_at`, `is_deleted`) VALUES
('67fa5e41-8f8d-4140-913e-81ce6047e3c7', 'Honda', 'Honda.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Est inventore rem nobis dolorem numquam eaque recusandae quam voluptas porro repellendus soluta labore expedita dignissimos, debitis, alias a necessitatibus aut modi.', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '2024-08-22 15:42:57', 0),
('7ec583e4-0273-4c71-9eac-a6d29541ac9e', 'Toyota', 'Toyota.png', '                                            Toyota est un constructeur automobile japonais réputé pour sa fiabilité, sa durabilité et ses innovations technologiques. Fondée en 1937, la marque est l\'un des plus grands fabricants de voitures au monde.      ', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '2024-08-22 15:31:47', 0),
('a4e252c8-b00e-466a-ac46-45b303f5fba9', 'Jeep', 'Jeep.png', '\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ut necessitatibus possimus distinctio nisi facilis culpa vel doloremque debitis accusantium! Labore repudiandae sapiente placeat necessitatibus dolores earum architecto excepturi vel?\r\n\r\n\r', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '2024-08-22 16:27:06', 0);

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `id` varchar(255) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `brand_id` varchar(100) DEFAULT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `fuel_type` varchar(20) NOT NULL,
  `transmission` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `seats` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `availability_status` varchar(20) NOT NULL,
  `insurance_expiration` date NOT NULL,
  `documents` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `reset_code` varchar(6) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiration_date` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` varchar(255) NOT NULL,
  `rental_id` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rentals`
--

CREATE TABLE `rentals` (
  `id` varchar(255) NOT NULL,
  `car_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `rental_start_date` date NOT NULL,
  `rental_end_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_method` varchar(50) DEFAULT 'Carte',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `contact`, `birthday`, `role`, `created_at`, `is_deleted`, `is_active`, `photo`) VALUES
('72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'Laurent', 'Alphonse', 'laurentalphonsewilfried@gmail.com', '$2y$10$/4Zni1g7vgM37zgnfZgR3uzKuee7LOG95pgwW9azHVQF6mkreUOEa', '+237678536884', '2002-02-13', '1', '2024-08-22 09:51:41', 0, 1, ''),
('d5f27033-2abe-4413-94dd-02c734535d09', 'Sophie', 'Leclerc', 'sophie.leclerc@example.com', '$2y$10$uSsdbaYpbwTNjGrXU1Xrh.ESqIVXS2/jKFMJrfYa743EbR/7ZO8.a', '+237689129012', '2008-09-12', '1', '2024-08-22 11:13:15', 0, 2, ''),
('dd159427-0a1e-4ec3-b4de-edd0df6c037d', 'Mvondo', 'Fernando', 'mvondofernando7777@gmail.com', '$2y$10$xnSatgEbe5bUL1hTLzWxculxDhxF4YatPUw1oFKsH9DvFVjgBaa2G', '+237690128934', '1990-12-09', '1', '2024-08-22 17:05:36', 0, 1, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `carbrands`
--
ALTER TABLE `carbrands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id` (`id`),
  ADD KEY `added_by_2` (`added_by`);

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_number` (`registration_number`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Index pour la table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_code` (`reset_code`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `carbrands`
--
ALTER TABLE `carbrands`
  ADD CONSTRAINT `carbrands_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `carbrands` (`id`);

--
-- Contraintes pour la table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD CONSTRAINT `forgot_password_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
