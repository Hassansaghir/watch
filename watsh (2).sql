-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 04:07 PM
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
-- Database: `watsh`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `name`, `email`, `username`, `password`, `photo`) VALUES
(1, 'Ali Haydar', 'ali@gamil.com', 'ali', 'ali', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `item_id`, `quantity`) VALUES
(0, '', 29, 1),
(12, '', 27, 1),
(0, '', 28, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'apple watsh'),
(2, 'galaxy watsh'),
(3, 'tagheure watsh');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(29) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `password`, `phone`, `address`) VALUES
(25, 'ali haydar', '202cb962ac59075b964b07152d234b70', '81066912', 'tyre'),
(26, 'hassan', '81dc9bdb52d04dc20036dbd8313ed055', '81777888', 'sayda');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `unit_price` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `unit_price`, `stock`, `photo`, `category_id`, `description`) VALUES
(27, 'Apple watsh serie:1', 100, 0, 'Apple1.jpg', 1, 'Plateforme de messagerie instantanée appartenant à Facebook, utilisée pour envoyer des messages textuels, vocaux et vidéo.'),
(28, 'Apple watsh serie:2', 120, 0, 'Apple2.jpg', 1, 'Permet aux utilisateurs de partager des photos et des vidéos avec leurs contacts individuels ou dans des groupes.\r\n\r\n'),
(29, 'Apple watsh serie:3', 150, 4, 'Apple3.jpg', 1, 'Possibilité de passer des appels vidéo individuels ou en groupe avec une qualité audio et vidéo élevée.\r\n\r\n'),
(30, 'Apple watsh serie:4', 170, 3, 'Apple4.jfif', 1, 'Intégration de fonctionnalités telles que les statuts, les emojis et les stickers pour personnaliser les conversations.\r\n\r\n'),
(31, 'Apple watsh serie:5', 200, 5, 'Apple5.jpg', 1, 'Chiffrement de bout en bout pour assurer la sécurité et la confidentialité des conversations.\r\n\r\n\r\n\r\n'),
(32, 'Apple watsh serie:6', 220, 5, 'Apple6.jfif', 1, 'Disponible sur plusieurs plateformes, y compris Android, iOS, Windows et macOS.\r\n\r\n'),
(33, 'Apple watsh serie:7', 260, 5, 'Apple7.jfif', 1, 'Chiffrement de bout en bout pour assurer la sécurité et la confidentialité des conversations.\r\n\r\n'),
(34, 'Apple watsh serie:8', 300, 5, 'Apple8.jfif', 1, 'Permet de créer des salons de discussion pour des discussions thématiques ou professionnelles.\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(35, 'tagheure watsh serie:1', 200, 5, 'Tagheure1.jfif', 3, 'Tag Heuer est une marque horlogère suisse de luxe, réputée pour ses montres de haute précision et son design innovant.\r\n\r\n'),
(36, 'tagheure watsh serie:2', 250, 5, 'Tagheure2.jfif', 3, 'Connu pour ses collaborations avec des marques de technologie, Tag Heuer fusionne tradition horlogère et innovation numérique.\r\n\r\n'),
(37, 'tagheure watsh serie:3', 300, 4, 'Tagheure3.jfif', 3, 'Offre une gamme de montres connectées alliant artisanat traditionnel suisse et technologies modernes de pointe.\r\n\r\n'),
(38, 'tagheure watsh serie:4', 400, 5, 'Tagheure4.jfif', 3, 'Équipées de capteurs de fitness avancés et de fonctionnalités de suivi de santé pour un mode de vie actif.\r\n\r\n'),
(39, 'tagheure watsh serie:5', 500, 4, 'Tagheure5.jfif', 3, 'Équipées de capteurs de fitness avancés et de fonctionnalités de suivi de santé pour un mode de vie actif.\r\n\r\n'),
(40, 'tagheure watsh serie:6', 600, 5, 'Tagheure6.jfif', 3, 'Connectivité LTE en option pour recevoir et passer des appels directement depuis la montre.\r\n\r\n'),
(41, 'tagheure watsh serie:7', 700, 5, 'Tagheure7.jfif', 3, 'Équipées de capteurs de fitness avancés et de fonctionnalités de suivi de santé pour un mode de vie actif.\r\n\r\n'),
(42, 'tagheure watsh serie:8', 800, 5, 'Tagheure8.jfif', 3, 'Disponibles en plusieurs styles et matériaux, incluant des éditions spéciales en collaboration avec des sportifs et des personnalités célèbres.\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(43, 'galaxy watsh serie:1', 120, 5, 'galaxy1.jfif', 2, 'Galaxy Watch est une montre intelligente de Samsung, offrant des fonctionnalités avancées de suivi de la santé et du fitness.\r\n\r\n'),
(44, 'galaxy watsh serie:2', 130, 5, 'galaxy2.png', 2, 'Galaxy Watch est une montre intelligente de Samsung, offrant des fonctionnalités avancées de suivi de la santé et du fitness.\r\n\r\n'),
(45, 'galaxy watsh serie:3', 150, 5, 'galaxy3.jfif', 2, 'Intègre des capteurs de fréquence cardiaque et de suivi de sommeil pour un suivi continu de la condition physique.\r\n\r\n'),
(46, 'galaxy watsh serie:4', 160, 5, 'galaxy4.jfif', 2, 'Intègre des capteurs de fréquence cardiaque et de suivi de sommeil pour un suivi continu de la condition physique.\r\n\r\n'),
(47, 'galaxy watsh serie:5', 170, 5, 'galaxy5.jfif', 2, 'Galaxy Watch est une montre intelligente de Samsung, offrant des fonctionnalités avancées de suivi de la santé et du fitness.\r\n\r\n'),
(48, 'galaxy watsh serie:6', 200, 5, 'galaxy6.jfif', 2, ''),
(49, 'galaxy watsh serie:7', 220, 4, 'galaxy7.jfif', 2, 'Connectivité LTE en option pour recevoir et passer des appels directement depuis la montre.\r\n\r\n'),
(50, 'galaxy watsh serie:8', 250, 5, 'galaxy8.jfif', 2, 'Connectivité LTE en option pour recevoir et passer des appels directement depuis la montre.\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `user_id`) VALUES
(69, '2024-07-11 15:31:29', 25);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `item_id`, `item_name`, `quantity`, `price`) VALUES
(34, 69, 28, 'Apple watsh serie:2', 1, 120),
(35, 69, 30, 'Apple watsh serie:4', 2, 340);

-- --------------------------------------------------------

--
-- Table structure for table `whishlist`
--

CREATE TABLE `whishlist` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `whishlist`
--
ALTER TABLE `whishlist`
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
