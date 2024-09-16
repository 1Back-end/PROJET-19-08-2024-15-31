-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 sep. 2024 à 17:44
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
-- Structure de la table `admin_role`
--

CREATE TABLE `admin_role` (
  `id` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin_role`
--

INSERT INTO `admin_role` (`id`, `role`, `created_at`, `updated_at`, `added_by`, `is_deleted`) VALUES
('c3d4e5f6-7a8b-9c0d-1e2f-3g4h5i6j7k8l', 'Administrateur', '2024-09-10 13:03:42', '2024-09-10 13:17:29', '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 0),
('d4e5f6g7-8b9c-0d1e-2f3g-4h5i6j7k8l9m', 'Edimestre', '2024-09-10 13:09:10', '2024-09-10 13:09:10', NULL, 0),
('da98b748-6f94-11ef-8f2b-24418c1325d5', 'Super Admin', '2024-09-10 16:50:58', '2024-09-10 16:50:58', NULL, 0),
('da98c82d-6f94-11ef-8f2b-24418c1325d5', 'Manager', '2024-09-10 16:50:58', '2024-09-10 16:50:58', NULL, 0),
('da98c88c-6f94-11ef-8f2b-24418c1325d5', 'Agent', '2024-09-10 16:50:58', '2024-09-10 16:50:58', NULL, 0),
('da98c9a2-6f94-11ef-8f2b-24418c1325d5', 'Comptable', '2024-09-10 16:50:58', '2024-09-10 16:50:58', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `agencies`
--

CREATE TABLE `agencies` (
  `id` varchar(255) NOT NULL,
  `owner_id` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
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
  `added_by` varchar(255) DEFAULT NULL,
  `comments` varchar(255) NOT NULL,
  `agency_code` varchar(255) NOT NULL,
  `url_link` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agencies`
--

INSERT INTO `agencies` (`id`, `owner_id`, `name`, `email`, `phone`, `address`, `city`, `country`, `postal_code`, `logo`, `created_at`, `updated_at`, `is_deleted`, `is_active`, `added_by`, `comments`, `agency_code`, `url_link`, `year`) VALUES
('21c7cd45-f666-492b-8520-4e2a5d5b5959', 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', 'Prime Living', 'contact@agencemarseillaise.fr', '+237 345 678 901', '789 Boulevard Saint-Germain, Marseille, France', 'Marseille', 'France', '13001', '21c7cd45-f666-492b-8520-4e2a5d5b5959_logo.jpg', '2024-08-30 11:44:45', '2024-09-10 12:40:16', 0, 1, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '', 'AGC-20240830-771388', 'www.primeliving.co', NULL),
('62e4eec7-289e-4650-a97a-4d951c9014da', 'bba6d8a7-2fa9-485b-a0c5-405f4462cb06', 'AutoRent', 'contact@agencebordelaise.fr', '+237 456 789 012', '202 Rue du Faubourg Saint-Antoine, Bordeaux, France', 'Bordeaux', 'France', '33000', '62e4eec7-289e-4650-a97a-4d951c9014da_logo_agence.jpg', '2024-09-03 09:11:53', '2024-09-10 12:42:11', 0, 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '\r\n                ', 'AGC-20240903-854067', ' www.autorent.info', NULL),
('78be05e9-583f-4100-9ec0-628d2867c524', '73d45fe6-08ac-4958-8326-fb5470111d40', 'Elite Car Rental', 'contact@elitecarrental.cm', '+237 691 234 567', 'Avenue Kennedy, Quartier Centre-Ville', 'Yaoundé', 'Cameroun', '237', 'logo7.jpg', '2024-09-01 15:50:22', '2024-09-10 12:41:31', 0, 1, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '\r\n                ', 'AGC-20240901-258507', ' www.elitecarrental.org', NULL),
('ca714596-7d5d-4e52-a260-422652dfa3e1', '0d5495ab-d373-414c-89d8-04d25726a565', 'Enterprise Rent-A-Car', 'contact@agencetoulousaine.fr', '+237 567 890 123', '03 Rue de la Liberté, Toulouse,', 'Berlin', 'Allemagne', '31000', 'ca714596-7d5d-4e52-a260-422652dfa3e1_logo3.jpg', '2024-08-30 14:10:58', '2024-09-10 12:41:05', 0, 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '\r\n                ', 'AGC-20240830-044424', 'www.enterpriserentacar.biz', NULL),
('d26de0ec-d856-4931-af2a-4d0594d9f24e', '0d5495ab-d373-414c-89d8-04d25726a565', 'Speedy Cars', 'contact@agencelyonnaise.fr', '+237 987 654 321', '456 Avenue de Lyon, Lyon, France', 'Akra', 'Ghana', '69001', 'd26de0ec-d856-4931-af2a-4d0594d9f24e_logo2.jpg', '2024-08-30 10:46:04', '2024-09-10 12:39:53', 0, 1, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '\r\n                ', 'AGC-20240830-931864', 'www.speedycars.net', NULL),
('fb1d1d63-24e8-45af-8661-65a9eb139daa', 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', 'AutoDrive Rentals', 'contact@agenceparisienne.fr', '+237 123 456 789', '123 Rue de Paris, Paris, France', 'Paris', 'France', '75001', 'fb1d1d63-24e8-45af-8661-65a9eb139daa_logo1.jpg', '2024-08-30 10:41:27', '2024-09-10 12:37:24', 0, 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', '\r\n                ', 'AGC-20240830-611229', 'www.autodrive-rentals.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `carbrands`
--

CREATE TABLE `carbrands` (
  `id` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` varchar(255) DEFAULT NULL,
  `agency_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carbrands`
--

INSERT INTO `carbrands` (`id`, `image`, `name`, `description`, `created_at`, `is_deleted`, `added_by`, `agency_id`) VALUES
('014d3d1d-3d4f-49ab-9fb6-58b76e8e3031', 'Capture d\'écran 2024-09-10 201933.png', 'CITROEN', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quo, odio voluptatibus minima, fuga natus totam unde temporibus nesciunt ducimus cum error culpa harum illo. Id nesciunt dolorem maxime quam laborum!', '2024-09-12 14:22:24', 0, 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959'),
('2a7cff68-2744-48ab-a5fc-294d51300386', 'Capture d\'écran 2024-08-19 193548.png', 'BMW', 'ALPINE', '2024-09-11 09:48:16', 0, 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959'),
('67fa5e41-8f8d-4140-913e-81ce6047e3c7', 'Honda.png', 'Honda', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Est inventore rem nobis dolorem numquam eaque recusandae quam voluptas porro repellendus soluta labore expedita dignissimos, debitis, alias a necessitatibus aut modi.', '2024-08-22 15:42:57', 0, '73d45fe6-08ac-4958-8326-fb5470111d40', NULL),
('7ec583e4-0273-4c71-9eac-a6d29541ac9e', 'Toyota.png', 'Toyota', '                                            Toyota est un constructeur automobile japonais réputé pour sa fiabilité, sa durabilité et ses innovations technologiques. Fondée en 1937, la marque est l\'un des plus grands fabricants de voitures au monde.      ', '2024-08-22 15:31:47', 0, '73d45fe6-08ac-4958-8326-fb5470111d40', NULL),
('9ea38e91-78dc-41ab-b886-f3b32ba1f4d6', 'Opel.png', 'Opel', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo saepe fugit odio mollitia porro modi. Praesentium magnam reprehenderit quod excepturi consectetur? Perferendis hic officiis atque eligendi veritatis, provident suscipit nisi.', '2024-09-10 14:24:37', 0, '73d45fe6-08ac-4958-8326-fb5470111d40', '78be05e9-583f-4100-9ec0-628d2867c524'),
('a22fdc57-1090-4d47-b994-421e9120f4e1', 'Citroën.png', 'Citroen', '\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nulla quae eveniet cumque maxime voluptatibus accusantium, quas aliquid porro amet sed neque praesentium commodi eos placeat eius tempora nisi in qui?', '2024-08-28 16:12:47', 0, NULL, NULL),
('a4e252c8-b00e-466a-ac46-45b303f5fba9', 'Jeep.png', 'Jeep', '\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Vitae ut necessitatibus possimus distinctio nisi facilis culpa vel doloremque debitis accusantium! Labore repudiandae sapiente placeat necessitatibus dolores earum architecto excepturi vel?\r\n\r\n\r', '2024-08-22 16:27:06', 0, NULL, NULL),
('b507d800-dfe4-4085-a260-866ef09d8dfb', 'images1.jpg', 'ABARTH', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus eaque ex est hic a? Quidem officia dolorem enim excepturi veniam harum itaque facilis earum expedita, quis eveniet repudiandae praesentium alias?', '2024-09-11 08:41:03', 0, '73d45fe6-08ac-4958-8326-fb5470111d40', '78be05e9-583f-4100-9ec0-628d2867c524'),
('c0498415-7018-11ef-b95d-24418c1325d5', NULL, 'AUDI', '', '2024-09-11 08:35:07', 0, NULL, NULL),
('c159bcc8-afbf-4c66-886e-5bada55be898', 'Sans titre-3.png', 'Toyota', '\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Ut architecto distinctio, nobis a veritatis est vel, quos cum reiciendis, fuga quaerat repellendus incidunt aliquam impedit ad explicabo cupiditate ea beatae.', '2024-09-11 09:46:32', 0, 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959');

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
  `image` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` varchar(255) DEFAULT NULL,
  `agency_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `registration_number`, `brand_id`, `model`, `year`, `fuel_type`, `transmission`, `color`, `seats`, `mileage`, `price_per_day`, `availability_status`, `insurance_expiration`, `documents`, `notes`, `created_at`, `image`, `is_deleted`, `added_by`, `agency_id`) VALUES
('00e6fc58-6897-44a9-8779-e2218d53b1ac', 'P6E9773441', 'a22fdc57-1090-4d47-b994-421e9120f4e1', 'BMW 3 Series', 1993, 'Diesel', 'Automatique', 'Jaune', 6, 25000, 130000.00, 'Disponible', '2024-09-12', 'Cahier des charges (1).pdf', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Vel doloribus magnam consequatur inventore! Impedit, quae natus nostrum autem cum consequuntur unde, eveniet odio facere doloribus qui tenetur, quidem reprehenderit quam?', '2024-08-29 12:47:57', 'car1.jpg,car2.jpg,car3.jpg,car4.jpg', 0, NULL, NULL),
('15d1ac59-135e-4a9d-9fed-d743b5077134', 'E3BTDWWT9D', 'a22fdc57-1090-4d47-b994-421e9120f4e1', 'Toyota Camry', 1990, 'Essence', 'Manuelle', 'Gris', 4, 10000, 15000.00, 'Disponible', '2024-09-12', 'CV_2024-09-03_Laurent Alphonse_ETOUDI BODO.pdf', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur beatae iure omnis, velit porro enim, aspernatur dolorem sequi at tempora dolor. Dolores voluptates aperiam magni? Amet delectus soluta asperiores distinctio.', '2024-09-05 14:34:45', 'pngegg(9).png,pngegg(6).png,pngegg(5).png,pngegg(4).png', 0, '73d45fe6-08ac-4958-8326-fb5470111d40', NULL),
('3ab1a545-fcbd-4f13-a935-cac8b9950d32', 'E26W9BDB1P', '67fa5e41-8f8d-4140-913e-81ce6047e3c7', 'Toyota Camry', 1992, 'Essence', 'Manuelle', 'Argent', 5, 15000, 15000.00, 'Disponible', '2024-09-12', 'doc.pdf', '\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Harum quas atque perspiciatis optio perferendis a vero excepturi ipsam quos asperiores? Error eveniet ducimus delectus, veritatis impedit quod esse ipsa quasi.', '2024-08-28 15:31:24', 'pngegg(22).png,pngegg(21).png,pngegg(20).png', 0, NULL, NULL),
('46c09cd2-80c6-4b17-bf10-5987267ef610', 'BC9W1DP789', '9ea38e91-78dc-41ab-b886-f3b32ba1f4d6', 'Audi A4', 1993, 'Électrique', 'Manuelle', 'Blanc', 5, 10000, 2800.00, 'Disponible', '2024-10-12', 'doc.pdf', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quae eos, rerum iste qui molestias rem? Dolore doloremque, delectus illo, explicabo repellat adipisci consequatur vitae atque corrupti a quas necessitatibus.', '2024-09-10 14:41:05', 'pngegg(22).png,pngegg(21).png,pngegg(20).png', 0, '73d45fe6-08ac-4958-8326-fb5470111d40', '78be05e9-583f-4100-9ec0-628d2867c524'),
('47878786-6fdf-4367-8d24-ede47c395677', '67229AT54D', '2a7cff68-2744-48ab-a5fc-294d51300386', 'BMW Z4', 1991, 'Diesel', 'Automatique', 'Argent', 4, 180, 1000.00, 'Disponible', '2024-09-12', 'app1.pdf', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Alias velit molestias sint quam aliquid explicabo, nobis necessitatibus labore eveniet, consequatur sequi fuga fugiat sit inventore tenetur quasi sunt at maxime.', '2024-09-12 14:37:49', 'Sans titre-1.png,Sans titre-2.png,Sans titre-3.png', 0, 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959'),
('47dfc2cc-4a67-4305-ba4b-f00e46359ac8', '1BPCD5P1A0', '7ec583e4-0273-4c71-9eac-a6d29541ac9e', 'Nissan Altima', 2018, 'Hybride', 'CVT', 'Rouge', 8, 10000, 12000.00, 'Disponible', '2024-09-12', 'Cahier des charges (1).pdf', '\r\nLorem, ipsum dolor sit amet consectetur adipisicing elit. Esse asperiores expedita itaque perspiciatis explicabo laudantium dolorum placeat fugit delectus. Rerum quaerat facilis ad sed dolorem, a dolor voluptas. Voluptas, expedita!', '2024-08-28 16:08:03', 'pngegg(19).png,pngegg(18).png,pngegg(17).png', 0, NULL, NULL),
('4ad6ed6b-c773-456f-b8ee-2ca9cae0e2bf', 'E4P3B4WBT1', 'a4e252c8-b00e-466a-ac46-45b303f5fba9', 'Honda Accord', 1996, 'Hydrogène', 'Semi-Automatique', 'Rose', 5, 10000, 10000.00, 'Disponible', '2024-07-12', 'Cahier des charges (1).pdf', '\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, unde tempore doloremque nihil soluta tempora, nesciunt non odit aut repellat impedit dolores nobis! Omnis sapiente quia aspernatur consequatur, recusandae voluptatum?', '2024-08-28 16:03:53', 'car1.png,pngegg(16).png,pngegg(15).png,pngegg(14).png', 0, NULL, NULL),
('5741190f-528c-4e53-9875-586d298e2242', 'P5B73P0DW5', 'a4e252c8-b00e-466a-ac46-45b303f5fba9', 'Ford Mustang', 1992, 'Électrique', 'Automatique', 'Argent', 6, 30000, 14000.00, 'Disponible', '2025-09-12', 'CV_2024-09-03_Laurent Alphonse_ETOUDI BODO.pdf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, qui animi! Tempore quisquam temporibus tenetur recusandae minus, non sint nulla earum unde rerum debitis exercitationem. Fuga sequi officia laboriosam dolorum.', '2024-09-05 15:26:03', 'pngegg(8).png,pngegg(7).png,pngegg(4).png', 0, '73d45fe6-08ac-4958-8326-fb5470111d40', NULL),
('6077e1a4-c491-4a43-a972-eed97553be54', '322D324BWA', '67fa5e41-8f8d-4140-913e-81ce6047e3c7', 'Volkswagen Jetta', 1995, 'Électrique', 'Manuelle', 'Noir', 5, 20000, 17000.00, 'Disponible', '2024-09-12', 'Cahier des charges (1).pdf', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla quae eveniet cumque maxime voluptatibus accusantium, quas aliquid porro amet sed neque praesentium commodi eos placeat eius tempora nisi in qui?', '2024-08-28 16:10:35', 'pngegg(8).png,pngegg(7).png,pngegg(6).png', 0, NULL, NULL),
('6787aeba-8dfc-44f3-9bcc-c90ce9bf0954', '5C4BDD3W01', 'a22fdc57-1090-4d47-b994-421e9120f4e1', 'Audi A4', 1994, 'Essence', 'Semi-Automatique', 'Argent', 5, 25000, 25000.00, 'Disponible', '2025-09-12', 'Cahier des charges (1).pdf', '\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Nulla quae eveniet cumque maxime voluptatibus accusantium, quas aliquid porro amet sed neque praesentium commodi eos placeat eius tempora nisi in qui?', '2024-08-28 16:14:52', 'pngegg(15).png,pngegg(14).png,pngegg(5).png,pngegg(4).png', 0, NULL, NULL),
('c35ec521-a39c-4c13-91fe-58e1c002759f', 'P147W037B0', '2a7cff68-2744-48ab-a5fc-294d51300386', 'BMW SERIE 1', 1992, 'Hybride', 'Manuelle', 'Gris', 5, 100, 11000.00, 'Disponible', '2024-09-12', 'CHAPITRE 3.pdf,Tuto-Django.pdf', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Itaque temporibus nam similique modi atque, provident doloribus tenetur. In veritatis reiciendis reprehenderit quisquam nobis, molestiae temporibus harum. Sapiente dolorum unde sint.', '2024-09-12 14:45:44', 'Capture d’écran 2024-09-06 130429.png,Capture d’écran 2024-09-10 202200.png,Capture d\'écran 2024-08-19 193548.png', 0, 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959');

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
-- Structure de la table `models_car`
--

CREATE TABLE `models_car` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cardbrands_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` varchar(255) DEFAULT NULL,
  `agency_id` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `models_car`
--

INSERT INTO `models_car` (`id`, `name`, `cardbrands_id`, `created_at`, `updated_at`, `added_by`, `agency_id`, `is_deleted`) VALUES
('02380d1b-022f-449f-aaf6-41116f7a8196', 'BMW X1', '2a7cff68-2744-48ab-a5fc-294d51300386', '2024-09-12 12:09:56', '2024-09-12 12:09:56', 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959', 0),
('1cb4eeaa-3a03-4a20-ae64-7d3ee24e0e7c', 'TOYOTA HILUX', 'c159bcc8-afbf-4c66-886e-5bada55be898', '2024-09-12 12:10:52', '2024-09-12 12:10:52', 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959', 0),
('3a7b8f2c-aa49-4fad-a140-096537edaf15', 'BMW I4', '2a7cff68-2744-48ab-a5fc-294d51300386', '2024-09-12 12:05:32', '2024-09-12 12:05:32', 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959', 0),
('622b0aed-0521-43c8-98c4-53f25c75f855', 'CITROEN C3', '014d3d1d-3d4f-49ab-9fb6-58b76e8e3031', '2024-09-12 14:31:45', '2024-09-12 14:31:45', 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959', 0),
('e23f4fc4-273f-4bae-913b-c12b11c2fd29', 'CITROEN C5 X', '014d3d1d-3d4f-49ab-9fb6-58b76e8e3031', '2024-09-12 14:32:07', '2024-09-12 14:32:07', 'c45b2c2a-51d8-41f4-a81d-25dd97eca748', '21c7cd45-f666-492b-8520-4e2a5d5b5959', 0);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` varchar(255) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` varchar(255) DEFAULT NULL
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
  `image` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `owners`
--

INSERT INTO `owners` (`id`, `name`, `email`, `phone`, `address`, `city`, `country`, `postal_code`, `image`, `password_hash`, `created_at`, `updated_at`, `is_deleted`, `added_by`, `status`) VALUES
('0d5495ab-d373-414c-89d8-04d25726a565', 'Jean Dupont', 'jean.dupont@example.com', '+237 123 456 789', '123 Rue de Paris, Paris, France', 'Douala', 'Cameroun', '75001', '', '$2y$10$32PVvdrtZhAH2sVsil0Z1uM5MAm./AeoXf/4EnAbjg72AV3KajF1.', '2024-08-30 08:15:40', '2024-08-30 09:03:16', 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'active'),
('73d45fe6-08ac-4958-8326-fb5470111d40', 'Marie Curie', 'marie.curie@example.com', '+237 987 654 321', '456 Avenue de Lyon, Lyon, France', 'Lyon', 'France', '69001', '73d45fe6-08ac-4958-8326-fb5470111d40_photo4.jpg', '$2y$10$Z4FJZrFisy1gDOffQr6EQez7Ke0GBuZWqoAWLTrW9pvJCt04nYEiC', '2024-08-30 08:32:21', '2024-09-05 13:59:14', 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'active'),
('bba6d8a7-2fa9-485b-a0c5-405f4462cb06', 'Sophie Dubois', 'sophie.dubois@example.com', '+237 456 789 012', '101 Avenue de la République, Marseille, France', 'Marseille', 'France', '13001', NULL, '$2y$10$aVVyYziBB9VCKBpfCvgjq.wHtvz8iqLiyfEj6u0T5tPrR8MJJ6BMG', '2024-09-03 08:28:51', '2024-09-04 16:02:53', 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'inactive'),
('c45b2c2a-51d8-41f4-a81d-25dd97eca748', 'Paul Martin', 'paul.martin@example.com', '+237 345 678 901', '789 Boulevard Saint-Germain, Paris, France', 'Ghana', 'Akra', '75002', 'c45b2c2a-51d8-41f4-a81d-25dd97eca748_WhatsApp Image 2024-05-23 à 14.11.42_a12d25c4.jpg', '$2y$10$Z4FJZrFisy1gDOffQr6EQez7Ke0GBuZWqoAWLTrW9pvJCt04nYEiC', '2024-08-30 09:00:20', '2024-09-11 09:36:37', 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` varchar(255) NOT NULL,
  `subscription_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`id`, `subscription_id`, `amount`, `payment_date`, `payment_method`, `status`, `transaction_id`, `created_at`, `updated_at`, `added_by`, `is_deleted`) VALUES
('0279cb6c-f5d4-4cfd-8a31-b7757857eaca', '2cdc236f-64ec-4332-84db-6496505e22b6', 29999.70, '2024-09-05 16:51:53', 'card', 'completed', 'pi_3PviuQ08QILWwY1z1ykUvKaO', '2024-09-05 16:51:53', '2024-09-05 16:51:53', '', 0),
('0c3500c5-d1b7-4f83-b294-fde497622974', 'f2d4a853-e70a-4881-8f08-e2234d3b7a3f', 29699.01, '2024-09-04 16:46:52', 'card', 'completed', 'pi_3PvMM108QILWwY1z03hAX2yX', '2024-09-04 16:46:52', '2024-09-04 16:46:52', '', 0),
('45868583-5574-416b-bab5-f2724026215f', '90f5dffe-a76f-4211-83f4-b305716dcb18', 29999.70, '2024-09-04 15:43:58', 'card', 'completed', 'pi_3PvLQ008QILWwY1z1PdrOKrB', '2024-09-04 15:43:58', '2024-09-04 17:02:30', '', 0),
('b273a72f-27c8-4dd9-8635-f92d8e6a6a6a', '90f5dffe-a76f-4211-83f4-b305716dcb18', 29999.70, '2024-09-04 15:44:22', 'card', 'completed', 'pi_3PvLN808QILWwY1z06cFvqET', '2024-09-04 15:44:22', '2024-09-04 17:02:46', '', 0),
('d0585c11-83e0-4dde-83b1-df26f7e41570', '2cdc236f-64ec-4332-84db-6496505e22b6', 29999.70, '2024-09-04 15:27:21', 'card', 'completed', 'pi_3PvL5F08QILWwY1z1ZyUH5yI', '2024-09-04 15:27:21', '2024-09-04 17:03:00', '', 0),
('d70b1083-5dc8-48d6-a083-38f9aae3c189', '2cdc236f-64ec-4332-84db-6496505e22b6', 29999.70, '2024-09-04 15:46:56', 'card', 'completed', 'pi_3PvKs808QILWwY1z1Wy4iV3x', '2024-09-04 15:46:56', '2024-09-04 17:03:11', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `payment_errors`
--

CREATE TABLE `payment_errors` (
  `id` varchar(255) NOT NULL,
  `subscription_id` varchar(255) NOT NULL,
  `error_message` text NOT NULL,
  `error_date` timestamp NOT NULL DEFAULT current_timestamp()
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
('5c41dce5-20b4-40ef-a5a0-855f4b25459a', '5741190f-528c-4e53-9875-586d298e2242', 'Laurent Alphonse', 'laurentalphonsewilfried@gmail.com', '+6789012345', '2024-09-05', '2024-10-20', 45, NULL, '13146685_Tired woman sitting at table on work flat vector illustration.jpg', '13146685_Tired woman sitting at table on work flat vector illustration.jpg', '', '2024-09-05 16:35:29', 'pending', '2024-09-05 16:35:29', 0, 'RES-20240905183529-FB1601'),
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
  `id_type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive','expired') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` varchar(255) DEFAULT NULL,
  `added_by_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `agency_id`, `id_type`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `is_deleted`, `added_by`, `added_by_owner`) VALUES
('2cdc236f-64ec-4332-84db-6496505e22b6', '78be05e9-583f-4100-9ec0-628d2867c524', '550e8400-e29b-41d4-a716-446655440000', '2024-09-05', '2024-10-05', 'active', '2024-09-04 13:47:01', '2024-09-05 16:51:53', 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', NULL),
('90f5dffe-a76f-4211-83f4-b305716dcb18', '21c7cd45-f666-492b-8520-4e2a5d5b5959', '550e8400-e29b-41d4-a716-446655440000', '2024-09-04', '2024-10-04', 'active', '2024-08-30 17:22:44', '2024-09-04 15:43:58', 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', NULL),
('aca51a91-2197-46a5-9d9a-17d1cb4dbca5', '78be05e9-583f-4100-9ec0-628d2867c524', 'd80e8bed-6c5a-11ef-ac6d-3552fdfdfbf2', '2024-09-06', '2024-10-06', 'inactive', '2024-09-06 14:33:39', '2024-09-06 14:38:00', 0, NULL, '73d45fe6-08ac-4958-8326-fb5470111d40'),
('c7f558cd-56dc-4422-8e85-85a0f90a1176', '78be05e9-583f-4100-9ec0-628d2867c524', 'd80e9956-6c5a-11ef-ac6d-3552fdfdfbf2', '2024-09-06', '2025-09-06', 'inactive', '2024-09-06 20:46:22', '2024-09-06 20:46:22', 0, NULL, '73d45fe6-08ac-4958-8326-fb5470111d40'),
('f2d4a853-e70a-4881-8f08-e2234d3b7a3f', 'd26de0ec-d856-4931-af2a-4d0594d9f24e', '550e8400-e29b-41d4-a716-446655440001', '2024-09-04', '2024-12-12', 'active', '2024-09-04 15:53:01', '2024-09-04 16:46:52', 0, '72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `subscription_types`
--

CREATE TABLE `subscription_types` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `vehicle_limit` int(11) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `subscription_types`
--

INSERT INTO `subscription_types` (`id`, `name`, `description`, `price`, `vehicle_limit`, `duration`, `is_active`, `created_at`, `updated_at`, `start_date`, `end_date`) VALUES
('d80e8bed-6c5a-11ef-ac6d-3552fdfdfbf2', 'Basique', 'Abonnement d\'un mois avec une gestion limité 55 véhicules.', '50000', 55, NULL, 1, '2024-09-06 14:18:09', '2024-09-09 08:53:43', '2024-09-06', '2024-10-06'),
('d80e9866-6c5a-11ef-ac6d-3552fdfdfbf2', 'Standard', 'Abonnement de 6 mois avec une gestion limité à 150 véhicules.', '150000', 150, NULL, 1, '2024-09-06 14:18:09', '2024-09-09 08:52:53', '2024-09-06', '2025-03-06'),
('d80e9956-6c5a-11ef-ac6d-3552fdfdfbf2', 'Professionnel', 'Abonnement d\'un an avec une gestion limité à 400 véhicules.', '200000', 300, NULL, 1, '2024-09-06 14:18:09', '2024-09-09 08:53:20', '2024-09-06', '2025-09-06'),
('d80e99a3-6c5a-11ef-ac6d-3552fdfdfbf2', 'Premium', 'Abonnement de 2 ans avec une gestion limité à 800 véhicules', '2500000', 800, NULL, 1, '2024-09-06 14:18:09', '2024-09-09 08:53:37', '2024-09-06', '2026-09-06');

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
  `photo` varchar(255) NOT NULL,
  `role_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `contact`, `birthday`, `role`, `created_at`, `is_deleted`, `is_active`, `photo`, `role_id`) VALUES
('72265e52-f7be-4e2b-b6b2-72ceae2aa8c1', 'Laurent', 'Alphonse', 'laurentalphonsewilfried@gmail.com', '$2y$10$/4Zni1g7vgM37zgnfZgR3uzKuee7LOG95pgwW9azHVQF6mkreUOEa', '+237678536884', '2002-02-13', '1', '2024-08-22 09:51:41', 0, 1, '', 'c3d4e5f6-7a8b-9c0d-1e2f-3g4h5i6j7k8l'),
('7e9edba6-319f-476b-b6c0-b3a71aab4978', 'Laurent', 'ETOUDI', 'laurent@example.com', '$2y$10$rYOnDFWRnddIfogUzclxN.6gks3l/li4yhP9/GpB0.XNdVd1upNLe', '+237 655123456', '2002-09-12', '1', '2024-09-10 17:05:54', 1, 1, '', NULL),
('d5f27033-2abe-4413-94dd-02c734535d09', 'Sophie', 'Leclerc', 'sophie.leclerc@example.com', '$2y$10$uSsdbaYpbwTNjGrXU1Xrh.ESqIVXS2/jKFMJrfYa743EbR/7ZO8.a', '+237689129012', '2008-09-12', '1', '2024-08-22 11:13:15', 0, 2, '', 'd4e5f6g7-8b9c-0d1e-2f3g-4h5i6j7k8l9m'),
('dd159427-0a1e-4ec3-b4de-edd0df6c037d', 'Mvondo', 'Fernando', 'mvondofernando7777@gmail.com', '$2y$10$xnSatgEbe5bUL1hTLzWxculxDhxF4YatPUw1oFKsH9DvFVjgBaa2G', '+237690128934', '1990-12-09', '1', '2024-08-22 17:05:36', 0, 2, '', 'c3d4e5f6-7a8b-9c0d-1e2f-3g4h5i6j7k8l');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`),
  ADD KEY `added_by` (`added_by`);

--
-- Index pour la table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `agency_code` (`agency_code`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_by_2` (`added_by`);

--
-- Index pour la table `carbrands`
--
ALTER TABLE `carbrands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_number` (`registration_number`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `added_by_2` (`added_by`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Index pour la table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_code` (`reset_code`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `models_car`
--
ALTER TABLE `models_car`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `cardbrands_id` (`cardbrands_id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `added_by` (`added_by`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_id` (`subscription_id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_by_2` (`added_by`);

--
-- Index pour la table `payment_errors`
--
ALTER TABLE `payment_errors`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `added_by_owner` (`added_by_owner`);

--
-- Index pour la table `subscription_types`
--
ALTER TABLE `subscription_types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin_role`
--
ALTER TABLE `admin_role`
  ADD CONSTRAINT `admin_role_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `carbrands_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `owners` (`id`),
  ADD CONSTRAINT `carbrands_ibfk_2` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`);

--
-- Contraintes pour la table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `carbrands` (`id`),
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `owners` (`id`),
  ADD CONSTRAINT `cars_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`);

--
-- Contraintes pour la table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD CONSTRAINT `forgot_password_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `models_car`
--
ALTER TABLE `models_car`
  ADD CONSTRAINT `models_car_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `owners` (`id`),
  ADD CONSTRAINT `models_car_ibfk_2` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`),
  ADD CONSTRAINT `models_car_ibfk_3` FOREIGN KEY (`cardbrands_id`) REFERENCES `carbrands` (`id`);

--
-- Contraintes pour la table `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `owners_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_car`) REFERENCES `cars` (`id`);

--
-- Contraintes pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `subscription_types` (`id`),
  ADD CONSTRAINT `subscriptions_ibfk_3` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscriptions_ibfk_4` FOREIGN KEY (`added_by_owner`) REFERENCES `owners` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
