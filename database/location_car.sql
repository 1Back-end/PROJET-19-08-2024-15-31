-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 29 août 2024 à 23:52
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
-- Base de données : `db_0003`
--

-- --------------------------------------------------------

--
-- Structure de la table `agencies`
--

CREATE TABLE `agencies` (
  `id` varchar(255) NOT NULL,
  `owner_id` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('a22fdc57-1090-4d47-b994-421e9120f4e1', 'Citroen', 'Citroën.png', '\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nulla quae eveniet cumque maxime voluptatibus accusantium, quas aliquid porro amet sed neque praesentium commodi eos placeat eius tempora nisi in qui?', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '2024-08-28 16:12:47', 0),
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
  `added_by` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `registration_number`, `brand_id`, `model`, `year`, `fuel_type`, `transmission`, `color`, `seats`, `mileage`, `price_per_day`, `availability_status`, `insurance_expiration`, `documents`, `notes`, `created_at`, `added_by`, `image`, `is_deleted`) VALUES
('00e6fc58-6897-44a9-8779-e2218d53b1ac', 'P6E9773441', 'a22fdc57-1090-4d47-b994-421e9120f4e1', 'BMW 3 Series', 1993, 'Diesel', 'Automatique', 'Jaune', 6, 25000, 130000.00, 'Disponible', '2024-09-12', 'Cahier des charges (1).pdf', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Vel doloribus magnam consequatur inventore! Impedit, quae natus nostrum autem cum consequuntur unde, eveniet odio facere doloribus qui tenetur, quidem reprehenderit quam?', '2024-08-29 12:47:57', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'car1.jpg,car2.jpg,car3.jpg,car4.jpg', 0),
('3ab1a545-fcbd-4f13-a935-cac8b9950d32', 'E26W9BDB1P', '67fa5e41-8f8d-4140-913e-81ce6047e3c7', 'Toyota Camry', 1992, 'Essence', 'Manuelle', 'Argent', 5, 15000, 15000.00, 'Disponible', '2024-09-12', 'doc.pdf', '\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Harum quas atque perspiciatis optio perferendis a vero excepturi ipsam quos asperiores? Error eveniet ducimus delectus, veritatis impedit quod esse ipsa quasi.', '2024-08-28 15:31:24', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'pngegg(22).png,pngegg(21).png,pngegg(20).png', 0),
('47dfc2cc-4a67-4305-ba4b-f00e46359ac8', '1BPCD5P1A0', '7ec583e4-0273-4c71-9eac-a6d29541ac9e', 'Nissan Altima', 2018, 'Hybride', 'CVT', 'Rouge', 8, 10000, 12000.00, 'Disponible', '2024-09-12', 'Cahier des charges (1).pdf', '\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Esse asperiores expedita itaque perspiciatis explicabo laudantium dolorum placeat fugit delectus. Rerum quaerat facilis ad sed dolorem, a dolor voluptas. Voluptas, expedita!', '2024-08-28 16:08:03', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'pngegg(19).png,pngegg(18).png,pngegg(17).png', 0),
('4ad6ed6b-c773-456f-b8ee-2ca9cae0e2bf', 'E4P3B4WBT1', 'a4e252c8-b00e-466a-ac46-45b303f5fba9', 'Honda Accord', 1996, 'Hydrogène', 'Semi-Automatique', 'Rose', 5, 10000, 10000.00, 'Disponible', '2024-07-12', 'Cahier des charges (1).pdf', '\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, unde tempore doloremque nihil soluta tempora, nesciunt non odit aut repellat impedit dolores nobis! Omnis sapiente quia aspernatur consequatur, recusandae voluptatum?', '2024-08-28 16:03:53', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'car1.png,pngegg(16).png,pngegg(15).png,pngegg(14).png', 0),
('6077e1a4-c491-4a43-a972-eed97553be54', '322D324BWA', '67fa5e41-8f8d-4140-913e-81ce6047e3c7', 'Volkswagen Jetta', 1995, 'Électrique', 'Manuelle', 'Noir', 5, 20000, 17000.00, 'Disponible', '2024-09-12', 'Cahier des charges (1).pdf', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla quae eveniet cumque maxime voluptatibus accusantium, quas aliquid porro amet sed neque praesentium commodi eos placeat eius tempora nisi in qui?', '2024-08-28 16:10:35', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'pngegg(8).png,pngegg(7).png,pngegg(6).png', 0),
('6787aeba-8dfc-44f3-9bcc-c90ce9bf0954', '5C4BDD3W01', 'a22fdc57-1090-4d47-b994-421e9120f4e1', 'Audi A4', 1994, 'Essence', 'Semi-Automatique', 'Argent', 5, 25000, 25000.00, 'Disponible', '2025-09-12', 'Cahier des charges (1).pdf', '\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nulla quae eveniet cumque maxime voluptatibus accusantium, quas aliquid porro amet sed neque praesentium commodi eos placeat eius tempora nisi in qui?', '2024-08-28 16:14:52', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'pngegg(15).png,pngegg(14).png,pngegg(5).png,pngegg(4).png', 0);

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
-- Structure de la table `owners`
--

CREATE TABLE `owners` (
  `id` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` varchar(255) NOT NULL,
  `reservation_id` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `is_deleted` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` varchar(255) NOT NULL,
  `id_car` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `number_of_days` int(11) NOT NULL,
  `options` varchar(255) DEFAULT NULL,
  `cni_file` varchar(255) DEFAULT NULL,
  `permis_file` varchar(255) NOT NULL,
  `comments` text DEFAULT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `num_reservation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `id_car`, `full_name`, `email`, `phone`, `start_date`, `end_date`, `number_of_days`, `options`, `cni_file`, `permis_file`, `comments`, `reservation_date`, `status`, `created_at`, `is_deleted`, `num_reservation`) VALUES
('1fcd9e15-1cf5-4efc-b1f7-36bf4a8a3a0b', '3ab1a545-fcbd-4f13-a935-cac8b9950d32', 'James Lee', 'james.lee@example.com', '+3456789012', '2024-09-01', '2024-09-18', 17, NULL, 'cn1.jpg', 'permis1.jpg', '', '2024-08-28 16:47:49', 'pending', '2024-08-28 16:47:49', 0, 'RES-20240828184749-34FF67D7'),
('c74ab33e-c4fa-44e6-ab56-3caf672ef148', '00e6fc58-6897-44a9-8779-e2218d53b1ac', 'John Doe', 'john.doe@example.com', '+1234567890', '2024-09-08', '2024-09-10', 2, NULL, 'cni.jpg', 'permis.jpg', '', '2024-08-29 12:50:24', 'pending', '2024-08-29 12:50:24', 0, 'RES-20240829145024-6E26C7'),
('f6f1297a-5e0a-4053-ad69-0739fc43aa11', '3ab1a545-fcbd-4f13-a935-cac8b9950d32', 'John Deo', 'juddeinnaffepau-6016@yopmail.com', '+6789012345', '2024-09-08', '2024-09-20', 12, NULL, 'cni.jpg', 'permis.jpg', '', '2024-08-28 15:33:25', 'pending', '2024-08-28 15:33:25', 0, 'RES-20240828173325-506954D4'),
('f74e2336-9e73-4644-a054-d4d13913ff8e', '6787aeba-8dfc-44f3-9bcc-c90ce9bf0954', 'Isabella White', 'isabella.white@example.com', '+4567890123', '2024-08-30', '2024-09-08', 9, NULL, 'cni.jpg', 'permis.jpg', '', '2024-08-28 16:38:15', 'pending', '2024-08-28 16:38:15', 0, 'RES-20240828183815-CC46906F');

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` varchar(255) NOT NULL,
  `agency_id` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('active','inactive','expired') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
-- Index pour la table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `added_by` (`added_by`);

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
-- Index pour la table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_car` (`id_car`);

--
-- Index pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agency_id` (`agency_id`);

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
-- Contraintes pour la table `agencies`
--
ALTER TABLE `agencies`
  ADD CONSTRAINT `agencies_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agencies_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

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
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_car`) REFERENCES `cars` (`id`);

--
-- Contraintes pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
