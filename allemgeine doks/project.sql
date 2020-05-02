-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 26 avr. 2020 à 20:40
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `street` varchar(30) NOT NULL,
  `zip` varchar(15) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `coordx` varchar(255) DEFAULT NULL,
  `coordy` varchar(255) DEFAULT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `address`
--

INSERT INTO `address` (`address_id`, `street`, `zip`, `city`, `country`, `coordx`, `coordy`, `fk_user_id`) VALUES
(1, 'bluestreet 123', '1100', 'Graz', 'Austria', '48.208176', '16.373819', 1),
(5, 'troll Str. 456', '1110', 'Vienna', 'Austria', '48.208176', '16.373819', 1),
(6, 'test', 'zip', '', '', '45.0000', '15.0000', 1),
(8, '2 rue avenue des chats perdus', '75000', '', '', '36.437097', '25.429128', 1),
(23, '5 Sir cat Street', 'WC2R', '', '', '46.02145', '45.25486', 9),
(27, 'Mautner-Markhof-Gasse 28', '1110', 'Vienna', 'Austria', '48.208', '16.3738', 13),
(29, 'Mautner-Markhof-Gasse, 28/1/12', '1110', 'Vienna', 'Austria', '50.222', '15.8864', 9);

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `answers_id` int(11) NOT NULL,
  `answer_msg` varchar(250) NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`answers_id`, `answer_msg`, `fk_user_id`, `fk_question_id`) VALUES
(25, 'yes very nice', 13, 3);

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `card_id` int(11) NOT NULL,
  `fk_product_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`card_id`, `fk_product_id`, `fk_user_id`, `cart_qty`) VALUES
(30, 1, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `discount_code`
--

CREATE TABLE `discount_code` (
  `discount_id` int(11) NOT NULL,
  `codemsg` varchar(10) NOT NULL,
  `discountname` varchar(20) NOT NULL,
  `activated` enum('yes','no') NOT NULL DEFAULT 'yes',
  `discount_amount` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `discount_code`
--

INSERT INTO `discount_code` (`discount_id`, `codemsg`, `discountname`, `activated`, `discount_amount`) VALUES
(1, 'BlackF20', 'Every Friday', 'yes', 20);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `fk_product_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_price` int(11) NOT NULL,
  `orderedpdt_name` varchar(255) NOT NULL,
  `fk_discount_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`order_id`, `fk_product_id`, `fk_user_id`, `order_qty`, `order_price`, `orderedpdt_name`, `fk_discount_id`) VALUES
(4, 1, 1, 1, 2500, 'MacBook Pro', NULL),
(5, 1, 9, 1, 2500, '', 1),
(6, 2, 9, 1, 35, '', 1),
(7, 1, 13, 1, 2500, '', 1),
(8, 2, 13, 1, 35, '', 1),
(9, 3, 13, 1, 270, '', 1),
(10, 4, 13, 1, 250, '', 1),
(11, 5, 13, 2, 10, '', 1),
(12, 6, 13, 1, 15, '', 1),
(13, 7, 13, 1, 35, '', 1),
(14, 8, 13, 2, 25, '', 1),
(15, 14, 13, 1, 4, '', 1),
(16, 20, 13, 1, 14, '', 1),
(17, 22, 13, 1, 0, '', 1),
(18, 13, 13, 1, 3, '', 1),
(19, 2, 9, 1, 35, '', 1),
(20, 3, 9, 1, 270, '', 1),
(21, 4, 9, 1, 250, '', 1),
(22, 1, 9, 1, 2500, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `category` enum('electronics','household','clothes','food','medicine','pets_kids') NOT NULL,
  `product_price` float NOT NULL,
  `description` varchar(200) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `available_amount` int(11) NOT NULL,
  `sales_discount` float NOT NULL,
  `display` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category`, `product_price`, `description`, `product_img`, `available_amount`, `sales_discount`, `display`) VALUES
(1, 'MacBook Pro', 'electronics', 3000, '8‐Core Intel Core i9 Processors, 9th Generation.\r\nBrilliant Retina display with True Tone technology.\r\nTouch Bar and Touch ID.\r\nAMD Radeon Pro 5500M with 4GB GDDR6 Graphics Memory.\r\nUltra-fast SSD.', '../img/mac.jpg', 15, 0, 'yes'),
(2, 'Braun Satin Hairdryer', 'electronics', 35, 'Revolutionary IONTEC technology releases millins of active IONS to boost shine, combat frizz, smooth hair.\r\nSwitch on the Satin Protect feature, designed for 100% protection from overheating.', 'https://images-na.ssl-images-amazon.com/images/I/61NFY2TpJzL._AC_SL1500_.jpg', 20, 0, 'yes'),
(3, 'Samsung Galaxy M30s', 'electronics', 270, 'Operating system: Android 9.0 (Pie) with One UI.\r\nOptical sensor resolution: 13 MP, F1.9 con AF, Flash LED.\r\nMemory capacity: 32 GB, expandable with 512 GB MicroSD.', 'https://images-na.ssl-images-amazon.com/images/I/612deTUC7xL._AC_SL1500_.jpg', 10, 0, 'yes'),
(4, 'Sony WH-1000XM3 Headphones', 'electronics', 250, 'Extra Bass for, powerful sound.\r\nDigital Noicecancelling on a buttonclick.\r\nUp to 30 hours battery life.', 'https://images-na.ssl-images-amazon.com/images/I/61ObHjcfkfL._AC_SL1500_.jpg', 20, 0, 'yes'),
(5, 'Muffin Tray', 'household', 10, 'Perforated Baking Tray Specially Curved for Three Ultra Crispy Baguettes\r\nWith high-quality, non-stick coating.\r\nSize 38.5 x 28 cm.', 'https://images-na.ssl-images-amazon.com/images/I/81Vy-eUVGbL._AC_SL1500_.jpg', 25, 0, 'yes'),
(6, 'Cups Set of 4', 'household', 15, 'Handcraft: smooth black border without burrs or splinters. Glossy enamel coating gives the cup rust resistance. Comfortable to use with firm grip\r\nBorderless design for easy drinking.', 'https://images-na.ssl-images-amazon.com/images/I/615a22-z3xL._AC_SL1000_.jpg', 20, 0, 'yes'),
(7, 'AEG Mixer', 'household', 35, 'Powerful chop the compact mini mixer 0.4 PS motor easily up all creamy smoothies and delicious shakes. Cap on the mixer bottle screws – and the favourite drink is the Genussvolle daily companion.', 'https://images-na.ssl-images-amazon.com/images/I/61hPmD9EreL._AC_SL1500_.jpg', 10, 0, 'yes'),
(8, 'Bath Towel Set', 'household', 25, 'Do not use bleach, fabric softener or iron, as this may affect quality; always wash the towels separately to avoid lint.\r\nThe set contains six identical cotton pool, fitness and bath towels.', 'https://images-na.ssl-images-amazon.com/images/I/A1teV2ikevL._AC_SL1500_.jpg', 30, 0, 'yes'),
(9, 'Kids Shorts', 'clothes', 10, 'Highly functional material wicks the perspiration away from your skin, keeping you dry and comfortable, even during training.\r\nThermally printed PUMA Cat logo on the left leg.\r\n100% polyester.', 'https://images-na.ssl-images-amazon.com/images/I/71OOvlmdGeL._AC_SL1500_.jpg', 20, 0, 'yes'),
(10, 'Jacket', 'clothes', 70, 'Outer material: high-quality 100% cotton. Lining: warm, soft fleece lining (100% polyester).\r\nMedium length trench coat jacket with removable zip hood to turn it into a stand-up jacket.', 'https://images-na.ssl-images-amazon.com/images/I/6144CO%2BZAdL._AC_SL1288_.jpg', 15, 0, 'yes'),
(11, 'Women\'s Socks Pack of 6', 'clothes', 10, 'Breathable and antibacterial\r\nHigh-quality cotton is highly breathable. \r\nSilver ions, which have a strong bacteriostasis, are added to our socks to protect the health of your feet and prevent odours.', 'https://images-na.ssl-images-amazon.com/images/I/71gKtKyeASL._AC_SL1200_.jpg', 15, 0, 'yes'),
(12, 'Pasta Spirali', 'food', 0.8, 'Original Italian Pasta', 'https://images-na.ssl-images-amazon.com/images/I/81wqDnITw8L._SL1500_.jpg', 25, 0, 'yes'),
(13, 'Premium Basmati Rice', 'food', 2.5, 'First Class Basmati Rice from India, grown in the feet of the Himalaya.', 'https://images-na.ssl-images-amazon.com/images/I/81fdybdTcOL._SL1500_.jpg', 20, 0, 'yes'),
(14, 'Chili-Bean Sauce', 'food', 3.6, 'High quality Chili-Bean Sauce.\r\nBright red chili paste and spicy.', 'https://images-na.ssl-images-amazon.com/images/I/81s1Ty2U96L._SL1500_.jpg', 25, 0, 'yes'),
(15, 'Neutrogena Hand Cream', 'medicine', 10, 'Instantly smooth hands after applying.\r\nProvides intense moisture and protects against the drying out.', 'https://images-na.ssl-images-amazon.com/images/I/71sWNQgECHL._AC_SL1500_.jpg', 15, 0, 'yes'),
(16, 'Colgate Toothpaste,Double Pack', 'medicine', 10, 'Tooth protection\r\nProtects against plaque\r\nGum protection\r\nEffectively protects against pain\r\nAgainst tartar and protects the enamel', 'https://images-na.ssl-images-amazon.com/images/I/81uaN2tmXTL._AC_SL1500_.jpg', 15, 0, 'yes'),
(17, 'Green Tea Body Cream', 'medicine', 20, 'Extreme hydration cream for the whole body.', 'https://images-na.ssl-images-amazon.com/images/I/51QUwiePL9L._SL1000_.jpg', 15, 0, 'yes'),
(18, 'Uttora Outdoor Researcher Set', 'pets_kids', 25.5, '22 piece exploration kit for: Halloween, holiday, summer or all year over.\r\nIncludes high-quality working binoculars; bug collector; butterfly net; whistle; tweezers & more.', 'https://images-na.ssl-images-amazon.com/images/I/71V5Dn-R20L._AC_SL1200_.jpg', 15, 0, 'yes'),
(19, 'Galaxy Slime 3pcs', 'pets_kids', 10, 'No Borax: Made of natural resin which is harmless and environmentally friendly.\r\nGalaxy Fluffy Slime: simulated starry sky color.', 'https://images-na.ssl-images-amazon.com/images/I/71MCZaZ1NBL._AC_SL1200_.jpg', 20, 0, 'yes'),
(20, 'Cat Toy Ball', 'pets_kids', 13.5, 'Auto rolling & LED chaser- Just press the button.\r\nOur cat toy ball automatically moves at random and lights up red to attract your kitten\'s attention.\r\nIt can also automatically change direction.', 'https://images-na.ssl-images-amazon.com/images/I/71tpTmR9xLL._AC_SL1500_.jpg', 25, 0, 'yes'),
(21, 'Dog Toy Ball', 'pets_kids', 5.5, 'Made from natural rubber with hand strap, floats in water.', 'https://images-na.ssl-images-amazon.com/images/I/61UzZyvpr4L._AC_SL1500_.jpg', 15, 0, 'yes'),
(22, 'Pizzamix Gluten-free', 'food', 0, 'preparation for gluten-free pizza', '../img/pizza.png', 5, 0, 'yes'),
(29, 'test product', 'electronics', 15, 'random test', '../img/bag3.png', 5, 0, 'yes'),
(30, 'lisa', 'household', 500000000, 'girl', '../img/fee.jpg', 1, 0, 'yes');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_msg` varchar(250) NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`question_id`, `question_msg`, `fk_user_id`, `fk_product_id`) VALUES
(2, 'nice product?', 9, 2),
(3, 'works well?', 9, 3),
(4, 'nice product?', 1, 4),
(23, 'are they fluffy?', 13, 8);

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `reviews_id` int(11) NOT NULL,
  `fk_product_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `review_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `review_msg` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`reviews_id`, `fk_product_id`, `fk_user_id`, `review_time`, `review_msg`) VALUES
(2, 1, 1, '2020-04-22 09:14:18', 'I bought that mac - so fast - so great i recommand that laptop to everyone!\n:D'),
(3, 2, 13, '2020-04-22 14:42:45', 'my girlfriend likes it, thanks for fast delivery'),
(4, 3, 13, '2020-04-22 14:43:33', 'perfect phone');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `role` enum('user','admin','superAdmin') NOT NULL DEFAULT 'user',
  `active` enum('yes','no','banned') NOT NULL DEFAULT 'no',
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_img` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `role`, `active`, `email`, `password`, `first_name`, `last_name`, `user_img`, `phone_number`, `token`) VALUES
(1, 'superAdmin', 'yes', 'super@email.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Super', 'Super', '../img/kitty.png', '1234567890', ''),
(2, 'admin', 'yes', 'admin@email.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Admin', 'Admin', '../img/shop.png', '1234567890', ''),
(9, 'user', 'no', 'user@email.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user', 'user', '../img/cat.png', '0000000000000', ''),
(12, 'admin', 'yes', 'serri@email.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'serri', 'serri', '../img/poulet.jpg', '0000000', ''),
(13, 'user', 'no', 'nihad.abouzid@hotmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'Nihad', 'Abou-Zid', '../img/cat.png', '1234567890', ''),
(14, 'user', 'yes', 'lisa.66@hotmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Lisa', 'Scelli', '../img/fee.jpg', '06706061313', '');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `fk_product_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `fk_product_id`, `fk_user_id`) VALUES
(13, 1, 9);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`fk_user_id`);

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answers_id`),
  ADD KEY `user_id` (`fk_user_id`),
  ADD KEY `fk_question_id` (`fk_question_id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `product_id` (`fk_product_id`),
  ADD KEY `user_id` (`fk_user_id`);

--
-- Index pour la table `discount_code`
--
ALTER TABLE `discount_code`
  ADD PRIMARY KEY (`discount_id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`fk_product_id`),
  ADD KEY `discount_id` (`fk_discount_id`),
  ADD KEY `user_id` (`fk_user_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `user_id` (`fk_user_id`),
  ADD KEY `fk_product_id` (`fk_product_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviews_id`),
  ADD KEY `product_id` (`fk_product_id`),
  ADD KEY `user_id` (`fk_user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`fk_user_id`),
  ADD KEY `product_id` (`fk_product_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
  MODIFY `answers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviews_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`fk_question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`fk_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`fk_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`fk_discount_id`) REFERENCES `discount_code` (`discount_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`fk_product_id`) REFERENCES `product` (`product_id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`fk_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`fk_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
