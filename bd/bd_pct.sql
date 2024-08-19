-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 08 août 2024 à 01:33
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `artisan_pct`
--

-- --------------------------------------------------------

--
-- Structure de la table `advertising_packages`
--

CREATE TABLE `advertising_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `advertising_packages`
--

INSERT INTO `advertising_packages` (`id`, `name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Standard', '1000.00', NULL, '2024-08-07 15:00:11', '2024-08-07 15:00:11'),
(2, 'Pro', '3000.00', NULL, '2024-08-07 15:00:44', '2024-08-07 15:00:44'),
(3, 'Premium', '5000.00', NULL, '2024-08-07 15:01:03', '2024-08-07 15:01:03');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `boutique`
--

CREATE TABLE `boutique` (
  `id_btk` varchar(25) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `id_artisan` int(10) NOT NULL,
  `datecreat` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `boutique`
--

INSERT INTO `boutique` (`id_btk`, `nom`, `description`, `id_artisan`, `datecreat`) VALUES
('btk_1_07082478', 'shop market', 'grande boutique pésentant nos réalisations en menuisierie', 1, '07/08/2024'),
('btk_4_07082496', 'Cecile couture', 'Atelier de couture pour femme', 4, '07/08/2024');

-- --------------------------------------------------------

--
-- Structure de la table `boutique_pro`
--

CREATE TABLE `boutique_pro` (
  `id_prod` varchar(20) NOT NULL,
  `nom_prod` varchar(50) NOT NULL,
  `prix` int(10) NOT NULL,
  `id_btk` varchar(25) NOT NULL,
  `image` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `boutique_pro`
--

INSERT INTO `boutique_pro` (`id_prod`, `nom_prod`, `prix`, `id_btk`, `image`, `description`) VALUES
('Pr_btk_1_07082478_49', 'table', 15000, 'btk_1_07082478', 'Art1tablemanger.jfif', 'table à manger'),
('Pr_btk_1_07082478_50', 'armoire', 60000, 'btk_1_07082478', 'Art1armoire2.jfif', 'armoire de rangement'),
('Pr_btk_1_07082478_65', 'table simple', 25000, 'btk_1_07082478', 'Art1table2.jfif', 'table avec pied en fer'),
('Pr_btk_1_07082478_88', 'placard', 20000, 'btk_1_07082478', 'Art1placard.jfif', 'placard de rangement'),
('Pr_btk_4_07082496_83', 'femme pagne', 15000, 'btk_4_07082496', 'Art4femme2.jfif', 'Modele pour sortie');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `emetteur` int(10) NOT NULL,
  `objet` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateEnvoi` varchar(15) NOT NULL,
  `heureEnvoi` varchar(15) NOT NULL,
  `recepteur` int(10) NOT NULL,
  `statMesEmett` int(1) NOT NULL,
  `statMesRecept` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `emetteur`, `objet`, `contenu`, `dateEnvoi`, `heureEnvoi`, `recepteur`, `statMesEmett`, `statMesRecept`) VALUES
(5, 5, 'besoin de meuble', 'Pourriez vous me fabriquer une table de 6 places.', '07/08/2024', '22:08:27', 1, 1, 1),
(6, 5, 'besoin de pantalon ', 'besoin de pantalon pour la semaine prochaine.\r\nurgent', '07/08/2024', '23:05:37', 4, 1, 1),
(7, 5, 'table', 'besoin de table', '07/08/2024', '23:06:59', 1, 1, 1),
(8, 6, 'chaise pour enfant', 'besoin de cinq chaises pour enfants', '07/08/2024', '23:10:54', 1, 1, 1),
(10, 1, 'gguu', 'jjijijij', '07/08/2024', '23:14:37', 4, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'Abidjan-Lagunes'),
(2, 'Bas-Sassandra'),
(3, 'Comoé'),
(4, 'Denguélé'),
(5, 'Gôh-Djiboua Sud-Bandama'),
(6, 'Haut-Sassandra Marahoue'),
(7, 'Lacs'),
(8, 'Lagunes Agnéby'),
(9, 'Montagnes Moyen-Cavally'),
(10, 'Savanes'),
(11, 'Vallée du Bandama'),
(12, 'Woroba Worodougou'),
(13, 'Zanzan');

-- --------------------------------------------------------

--
-- Structure de la table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `specialties`
--

INSERT INTO `specialties` (`id`, `name`) VALUES
(1, 'Mécanique'),
(2, 'Menuiserie/Charpenterie'),
(3, 'Maçonnerie'),
(4, 'Couture'),
(5, 'Spécialiste en froid'),
(6, 'Transport'),
(7, 'Coiffure'),
(8, 'Briqueterie'),
(9, 'Vente de marchandises'),
(10, 'Jardinier'),
(11, 'Agroalimentaire, alimentation, restauration'),
(12, 'ferronnerie'),
(13, 'Cordonnerie'),
(14, 'Hygiène et soins corporels'),
(15, 'Audiovisuel et communication'),
(16, 'Tapisserie'),
(17, 'Bijouterie'),
(18, 'Boucherie'),
(19, 'Boulangé'),
(20, 'Photographe'),
(21, 'Vitrerie'),
(22, 'Electronique (réparateur TV, portable, etc)'),
(23, 'Plomberie'),
(24, 'BLANCHISSERIE'),
(25, 'Elevage'),
(26, 'Commerce'),
(27, 'Boutique'),
(28, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(10) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(16) DEFAULT NULL,
  `niveau` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `longitude` varchar(110) NOT NULL,
  `latitude` varchar(110) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `telp`, `niveau`, `ville`, `longitude`, `latitude`, `photo`, `profession`, `mdp`, `type`) VALUES
(1, 'YAO', 'Roland  ', 'yao@gmail.com', '0700000001  ', 'cepe', 'Koumassi', '-3.9528215160636884  ', '5.3026856931514565,  ', 'menuisier3.jfif', 'Menuiserie/Charpenterie', '6cb6e60275b692278ff3b61eb68b11b25838f7b8', 'P'),
(2, 'COULIBALY', 'Seydou', 'coulibaly@gmail.com', '0700000002', 'bepc', 'Adjamé', '-4.005679826255184', '5.3841859759719615', 'menuisier1.jfif', 'Menuiserie/Charpenterie', '515da5a29f60ba941412cc074d88ae4cf2643f71', 'P'),
(3, 'KOFFI', 'Alain', 'koffi@gmail.com', '0700000003', 'bac', 'Bingerville', '-71.2547666555705', '46.7813961839762', 'couture1.jfif', 'Couture', 'e7fc0e63e685965839a2022f98657eebea3c0f76', 'P'),
(4, 'AMON', 'Cécile', 'amon@gmail.com', '0700000004', 'cepe', 'ABOBO', '-4.00264981713563', '5.3876602007119105', 'couturiere2.jfif', 'Couture', '22e29e02973e22efd0a5d303ee0dd541fc645168', 'P'),
(5, 'DIGBEU', 'Roger', 'digbeu@gmail.com', NULL, '', '', '', '', '', '', 'ef9dc9a6f9687d86d78097e731f6ef5a3113f28b', 'C'),
(6, 'fofana', 'adama', 'fofana@gmail.com', NULL, '', '', '', '', '', '', 'a2fe17beee602ae3429597a65d977b84c6022eb2', 'C');

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `name`, `region_id`) VALUES
(1, 'Abobo Avocatier - PK18', 1),
(2, 'Abobo Baoulé - Biabou', 1),
(3, 'Abobo Mairie - Rail - Sogephia', 1),
(4, 'Abobo N\'dotré', 1),
(5, 'ABOBO Plateau Dokui', 1),
(6, 'Adjamé', 1),
(7, 'Anyama', 1),
(8, 'Bingerville', 1),
(9, 'Cocody 2 Plateaux', 1),
(10, 'Cocody Angré - Chateau - CHU', 1),
(11, 'Cocody Faya - Abatta', 1),
(12, 'Cocody Palmeraie - Bonoumin', 1),
(13, 'Cocody Riviera 2 - Attoban - Golf', 1),
(14, 'Cocody Riviera 3 - 4 - M\'badon', 1),
(15, 'Koumassi Divo - Remblais - SIR', 1),
(16, 'Koumassi Grand Carrefour - Sogefia', 1),
(17, 'Marcory Bietry - Zone 4', 1),
(18, 'Marcory Marché - Anoumabo', 1),
(19, 'Marcory Residentiel', 1),
(20, 'Plateau', 1),
(21, 'Port-Bouet Centre - Vridi', 1),
(22, 'Port-Bouet Gonzagueville', 1),
(23, 'Songon', 1),
(24, 'Treichville', 1),
(25, 'Yopougon Koweit - Toit rouge', 1),
(26, 'Yopougon Maroc - Gesco', 1),
(27, 'Yopougon Niangon - Académie', 1),
(28, 'Yopougon Port Bouet 2 - SIDECI', 1),
(29, 'Yopougon Zone Industrielle - CHU', 1),
(30, '4 Carrefours', 2),
(31, 'Angagui', 2),
(32, 'Dagadji', 2),
(33, 'Dakpadou', 2),
(34, 'Dassioko', 2),
(35, 'Djouroutou', 2),
(36, 'Dobré', 2),
(37, 'Dogbo', 2),
(38, 'Domaine SOGB', 2),
(39, 'Fresco', 2),
(40, 'Gabiadji', 2),
(41, 'Gagny', 2),
(42, 'Gbakayo', 2),
(43, 'Glibiadji', 2),
(44, 'Grabo', 2),
(45, 'Grand-Zattry', 2),
(46, 'GrandBereby', 2),
(47, 'gueyo', 2),
(48, 'Konedougou', 2),
(49, 'Liliyo', 2),
(50, 'Meagui', 2),
(51, 'Moussadougou', 2),
(52, 'Néka', 2),
(53, 'Niapidou', 2),
(54, 'Okrouyo', 2),
(55, 'Oupoyo', 2),
(56, 'Pauly-Brousse', 2),
(57, 'Roc-Oulidié', 2),
(58, 'Sagboya V6', 2),
(59, 'SAHOUA', 2),
(60, 'San-Pedro', 2),
(61, 'Sassandra', 2),
(62, 'Soubre', 2),
(63, 'Tabou', 2),
(64, 'Walebo', 2),
(65, 'Watté', 2),
(66, 'Yabayo', 2),
(67, 'Abengourou', 3),
(68, 'Aboisso', 3),
(69, 'Adaou', 3),
(70, 'Adiaké', 3),
(71, 'Agnibilekrou', 3),
(72, 'Akakro', 3),
(73, 'Akoboissué', 3),
(74, 'AMORIAKRO', 3),
(75, 'Andé', 3),
(76, 'Aniassue', 3),
(77, 'Appoisso', 3),
(78, 'Arrah', 3),
(79, 'Attiekro', 3),
(80, 'Ayamé', 3),
(81, 'Bocanda', 3),
(82, 'Bonaouin', 3),
(83, 'Bongouanou', 3),
(84, 'Bonoua', 3),
(85, 'Daoukro', 3),
(86, 'Dimbokro', 3),
(87, 'Djatokro', 3),
(88, 'Duffrébo', 3),
(89, 'Ebilassokro', 3),
(90, 'Grand-Bassam', 3),
(91, 'Kofikro', 3),
(92, 'Kotobi', 3),
(93, 'Larabia', 3),
(94, 'M\'batto', 3),
(95, 'Mafere', 3),
(96, 'Manzanouan', 3),
(97, 'Niablé', 3),
(98, 'Ouellé', 3),
(99, 'Prikro', 3),
(100, 'Yaou', 3),
(101, 'ZAMBLEKRO', 3),
(102, 'Booko', 4),
(103, 'Madinani', 4),
(104, 'Maninian', 4),
(105, 'Minignan', 4),
(106, 'Odienne', 4),
(107, 'Seydougou', 4),
(108, 'Bayota', 5),
(109, 'Dabouyo', 5),
(110, 'Damanasso', 5),
(111, 'Diégonefla', 5),
(112, 'Divo', 5),
(113, 'Gagnoa', 5),
(114, 'Galebre-Galébouo', 5),
(115, 'Groussikro', 5),
(116, 'Guiberoua', 5),
(117, 'Guitry', 5),
(118, 'Hiré', 5),
(119, 'Lakota', 5),
(120, 'Néko', 5),
(121, 'Ogoudou', 5),
(122, 'Oumé', 5),
(123, 'Ouragahio', 5),
(124, 'Zikisso', 5),
(125, 'Bazra-Nattis', 6),
(126, 'Bediala', 6),
(127, 'Bonon', 6),
(128, 'Bouafle', 6),
(129, 'Buyo', 6),
(130, 'Daloa', 6),
(131, 'GBALAGOUA', 6),
(132, 'Gboguhe', 6),
(133, 'Gonaté', 6),
(134, 'Guépahouo', 6),
(135, 'Issia', 6),
(136, 'Kanzra', 6),
(137, 'Kétro-Bassam', 6),
(138, 'Kononfla', 6),
(139, 'Saioua', 6),
(140, 'Sinfra', 6),
(141, 'Vavoua', 6),
(142, 'YAOKRO', 6),
(143, 'Yuala', 6),
(144, 'Zagoréta-Gadouan', 6),
(145, 'Zoukougbeu', 6),
(146, 'Zuenoula', 6),
(147, 'ASSOUNVOUÉ', 7),
(148, 'Didievi', 7),
(149, 'Djekanou', 7),
(150, 'KOSSOU', 7),
(151, 'Kpouèbo', 7),
(152, 'Tiebissou', 7),
(153, 'Toumodi', 7),
(154, 'Yamoussoukro', 7),
(155, 'Adzope', 8),
(156, 'Agboville', 8),
(157, 'Agou', 8),
(158, 'Ahouanou', 8),
(159, 'Ahougnan-Fatou', 8),
(160, 'Akoupé', 8),
(161, 'Alépé', 8),
(162, 'Attiguéi', 8),
(163, 'Azaguié', 8),
(164, 'Bacanda', 8),
(165, 'Belleville', 8),
(166, 'Bettie', 8),
(167, 'Braffedon', 8),
(168, 'Dabou', 8),
(169, 'Diateke', 8),
(170, 'Dibou', 8),
(171, 'Ebounou', 8),
(172, 'Grand Lahou', 8),
(173, 'Grand Yapo', 8),
(174, 'Hermankono-Garo', 8),
(175, 'Irobo', 8),
(176, 'Jacqueville', 8),
(177, 'Krokrom', 8),
(178, 'Lahou-Kpanda', 8),
(179, 'Liboli', 8),
(180, 'N\'Douci', 8),
(181, 'N\'zianouan', 8),
(182, 'Nandibo II', 8),
(183, 'NDjem', 8),
(184, 'Nianda', 8),
(185, 'Petit Bouna', 8),
(186, 'Rubino', 8),
(187, 'Sikensi', 8),
(188, 'Tamabo', 8),
(189, 'Tamabo-Dongbo', 8),
(190, 'Tiassalé', 8),
(191, 'Tieviessou', 8),
(192, 'Toukouzou', 8),
(193, 'Toupah', 8),
(194, 'Yakasse Attobrou', 8),
(195, 'Yocoboue', 8),
(196, 'Akekro', 9),
(197, 'Bagohouo', 9),
(198, 'Bangolo', 9),
(199, 'Biankouman', 9),
(200, 'Blolequin', 9),
(201, 'Danané', 9),
(202, 'Danane2', 9),
(203, 'Diédrou', 9),
(204, 'Duekoue', 9),
(205, 'Facobly', 9),
(206, 'Gbapleu', 9),
(207, 'Guehiebly', 9),
(208, 'Guessabo', 9),
(209, 'Guézon', 9),
(210, 'Guiglo', 9),
(211, 'Kouibly', 9),
(212, 'Logoualé', 9),
(213, 'Mahapleu', 9),
(214, 'Man', 9),
(215, 'Méo', 9),
(216, 'Pehe', 9),
(217, 'Sangouine', 9),
(218, 'Sémien', 9),
(219, 'Sipilou', 9),
(220, 'Tai', 9),
(221, 'Toulepleu', 9),
(222, 'Zagne', 9),
(223, 'Zéaglo', 9),
(224, 'ZOUAN-HOUIEN', 9),
(225, 'Boron', 10),
(226, 'Boundiali', 10),
(227, 'Diawala', 10),
(228, 'Dikodougou', 10),
(229, 'Ferkessedougou', 10),
(230, 'Kanoroba', 10),
(231, 'Kasséré', 10),
(232, 'Kong', 10),
(233, 'Korhogo', 10),
(234, 'Kouto', 10),
(235, 'M\'Bengué', 10),
(236, 'Napiéolédougou', 10),
(237, 'Nielle', 10),
(238, 'Ouangolo', 10),
(239, 'Ouangolodougou', 10),
(240, 'Samatiguila', 10),
(241, 'Sinematiali', 10),
(242, 'Sirasso', 10),
(243, 'Tingrela', 10),
(244, 'Tongon', 10),
(245, 'Bassawa', 11),
(246, 'Béoumi', 11),
(247, 'Bilimono', 11),
(248, 'Botro', 11),
(249, 'Bouake ', 11),
(250, 'Dabakala', 11),
(251, 'Diabo', 11),
(252, 'Djebonoua', 11),
(253, 'Katiola', 11),
(254, 'KONANBLEKRO KANBLESSO', 11),
(255, 'KONGOBO', 11),
(256, 'M\'Bahiakro', 11),
(257, 'Niakara', 11),
(258, 'Sakassou', 11),
(259, 'Tafire', 11),
(260, 'Tié N\\’diékro', 11),
(261, 'Tortiya', 11),
(262, 'Borotou', 12),
(263, 'Dianra', 12),
(264, 'Diarabana', 12),
(265, 'Djiboroso', 12),
(266, 'Guinteguela', 12),
(267, 'Kani', 12),
(268, 'Kongaso', 12),
(269, 'Koro', 12),
(270, 'Mankono', 12),
(271, 'Massala', 12),
(272, 'Morityedougou', 12),
(273, 'Morondo', 12),
(274, 'Ouaninou', 12),
(275, 'Seguela', 12),
(276, 'Tieningboue', 12),
(277, 'Touba', 12),
(278, 'Bondoukou', 13),
(279, 'Bouko', 13),
(280, 'Bouna', 13),
(281, 'Doropo', 13),
(282, 'Gouméré', 13),
(283, 'Kouassi-Datèkro', 13),
(284, 'Koun Fao', 13),
(285, 'Tanda', 13),
(286, 'Transua', 13),
(287, 'Varale', 13);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advertising_packages`
--
ALTER TABLE `advertising_packages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `boutique`
--
ALTER TABLE `boutique`
  ADD PRIMARY KEY (`id_btk`),
  ADD KEY `id_artisan` (`id_artisan`);

--
-- Index pour la table `boutique_pro`
--
ALTER TABLE `boutique_pro`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `mat_user` (`id_btk`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_pro` (`email`,`telp`),
  ADD UNIQUE KEY `email_user` (`email`),
  ADD UNIQUE KEY `tel_user` (`telp`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `advertising_packages`
--
ALTER TABLE `advertising_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `boutique`
--
ALTER TABLE `boutique`
  ADD CONSTRAINT `boutique_ibfk_1` FOREIGN KEY (`id_artisan`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `boutique_pro`
--
ALTER TABLE `boutique_pro`
  ADD CONSTRAINT `boutique_pro_ibfk_1` FOREIGN KEY (`id_btk`) REFERENCES `boutique` (`id_btk`);

--
-- Contraintes pour la table `villes`
--
ALTER TABLE `villes`
  ADD CONSTRAINT `villes_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
