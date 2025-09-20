-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 19, 2025 at 09:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `immobilier`
--

-- --------------------------------------------------------

--
-- Table structure for table `favoris`
--

CREATE TABLE `favoris` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `propriete_id` int(11) NOT NULL,
  `date_ajout` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favoris`
--

INSERT INTO `favoris` (`id`, `user_id`, `propriete_id`, `date_ajout`) VALUES
(1, 30, 45, '2025-05-07 12:26:56'),
(2, 33, 44, '2025-05-07 12:27:32'),
(3, 30, 44, '2025-05-16 21:09:10'),
(6, 33, 57, '2025-05-17 11:58:47'),
(7, 33, 64, '2025-05-17 23:18:09'),
(9, 39, 69, '2025-06-01 15:06:06'),
(19, 33, 74, '2025-06-01 23:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `propriete`
--

CREATE TABLE `propriete` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `contacts` varchar(100) NOT NULL,
  `type` enum('appartement','maison','commercial','terrain') NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `cree_a` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifie_a` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photos` varchar(55) NOT NULL,
  `image_01` varchar(50) NOT NULL,
  `image_02` varchar(50) NOT NULL,
  `image_03` varchar(50) NOT NULL,
  `image_04` varchar(50) NOT NULL,
  `image_05` varchar(50) NOT NULL,
  `statut` varchar(20) DEFAULT 'en_attente',
  `utilisateur_id` int(11) DEFAULT NULL,
  `type_offre` enum('a_louer','a_vendre') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propriete`
--

INSERT INTO `propriete` (`id`, `titre`, `description`, `prix`, `contacts`, `type`, `localisation`, `cree_a`, `modifie_a`, `photos`, `image_01`, `image_02`, `image_03`, `image_04`, `image_05`, `statut`, `utilisateur_id`, `type_offre`) VALUES
(67, 'Villa avec jardin à Oran', 'Villa spacieuse de 200m² avec un grand jardin, garage et terrasse, située dans un quartier résidentiel calme.', 250000.00, '0661 22 33 44', 'maison', 'Oran', '2025-05-17 22:35:52', '2025-06-01 19:49:36', '', '1747521352_pexels-itsterrymag-2635038.jpg', '1747521352_avi-werde-hHz4yrvxwlA-unsplash.jpg', '1747521352_kenny-eliason-mGZX2MOPR-s-unsplash.jpg', '1747521352_ch.jpg', '', 'acceptee', 33, 'a_louer'),
(73, 'Terrain à Tizi Ouzou', 'Terrain de 1000m² constructible, vue dégagée, accès route goudronnée. Acte et livret foncier disponibles.', 45000.00, '0556 78 90 12', 'terrain', 'Draa Ben Khedda, Tizi Ouzou', '2025-06-01 19:38:55', '2025-06-01 19:39:05', '', '1748806735_beau-paysage-avec-epingle-rouge.jpg', '', '', '', '', 'acceptee', 33, 'a_vendre'),
(74, 'Terrain agricole à Mostaganem', 'Terrain agricole de 2 hectares, terre fertile, accès à l’eau, parfait pour exploitation agricole ou projet d’investissement à long terme.', 70000.00, '0678 99 88 77', 'terrain', 'Hassi Mameche, Mostaganem', '2025-06-01 19:59:08', '2025-06-01 19:59:38', '', '1748807948_beau-paysage-avec-petit-village.jpg', '', '', '', '', 'acceptee', 30, 'a_vendre'),
(75, 'appartement f2', '90m2', 5000000.00, '0794882726', 'appartement', 'sidi bel abbess', '2025-06-02 08:59:41', '2025-06-02 09:02:46', '', '1748854781_beau-paysage-avec-petit-village.jpg', '', '', '', '', 'acceptee', 45, 'a_vendre');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('admin','visiteur','proprietaire') NOT NULL,
  `cree_a` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom_utilisateur`, `email`, `mot_de_passe`, `role`, `cree_a`) VALUES
(30, 'moustafa', 'mus2alive@gmail.com', '$2y$10$HF3wFqA.oE/vSAwFApIX2.52IudhmVWl/2K7zk2oxQ0uvKFuSNcFO', 'proprietaire', '2025-04-24 22:15:21'),
(33, 'alaa', 'musmzr0123@gmail.com', '$2y$10$cQp6tA8iUF41bjwumUzmlO1R1X4oWErNqowWGMn5/xCcPru6jeEvm', 'proprietaire', '2025-05-01 18:56:46'),
(39, 'musalaaadmin', 'zatermoustafa@gmail.com', '$2y$10$UYGkGwFacSkJ85Fp01EJV.40lrC6lrxw6PzOZmCcMYFSZJq1lqGEy', 'admin', '2025-05-19 12:48:35'),
(45, 'mustafa', 'mustafalaw3692016@gmail.com', '$2y$10$9FuXFweLi5pJPzUHbUcNBe1zCUAfpupQ9.fhZEYgTPsZMHyRps.4O', 'proprietaire', '2025-06-02 08:47:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `propriete`
--
ALTER TABLE `propriete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utilisateur` (`utilisateur_id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `propriete`
--
ALTER TABLE `propriete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `propriete`
--
ALTER TABLE `propriete`
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
