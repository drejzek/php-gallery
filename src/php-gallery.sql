-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: db.dw128.webglobe.com
-- Vytvořeno: Pát 26. čec 2024, 19:25
-- Verze serveru: 10.5.24-MariaDB-1:10.5.24+maria~ubu2004-log
-- Verze PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `davidrejzek_cz`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `is_thumbnail` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` int(3) NOT NULL,
  `gallery_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Vypisuji data pro tabulku `files`
--

INSERT INTO `files` (`id`, `name`, `alt_text`, `size`, `is_thumbnail`, `user_id`, `gallery_id`) VALUES
(26, 'IMG_1476.jpeg', '', 0, 0, 4, 9),
(27, 'IMG_1478.jpeg', '', 0, 0, 4, 9),
(28, 'IMG_1479.jpeg', '', 0, 0, 4, 9),
(29, 'IMG_2657.jpeg', '', 0, 0, 4, 9),
(30, 'IMG_2661.jpeg', '', 0, 0, 4, 9),
(31, 'IMG_0111.jpeg', '', 0, 0, 4, 13),
(32, 'IMG_0116.jpeg', '', 0, 0, 4, 13),
(33, 'IMG_0059.jpeg', '', 0, 0, 4, 13),
(34, 'IMG_0716.jpeg', '', 0, 0, 4, 13),
(35, 'IMG_0061.jpeg', '', 0, 0, 4, 13),
(36, 'IMG_0090.jpeg', '', 0, 0, 4, 13),
(37, 'IMG_0095.jpeg', '', 0, 0, 4, 13),
(38, 'IMG_0096.jpeg', '', 0, 0, 4, 13),
(39, 'IMG_0107.jpeg', '', 0, 0, 4, 13),
(40, 'IMG_1015_jpg.jpg', '', 0, 0, 4, 3),
(41, 'IMG_1019_jpg.jpg', '', 0, 0, 4, 3),
(42, 'IMG_4229.jpeg', '', 0, 0, 4, 3),
(43, 'IMG_1144.jpeg', '', 0, 0, 4, 3),
(44, 'IMG_4231.jpeg', '', 0, 0, 4, 3),
(45, 'IMG_4234.jpeg', '', 0, 0, 4, 3),
(46, 'IMG_4237.jpeg', '', 0, 0, 4, 3),
(47, 'IMG_4238.jpeg', '', 0, 0, 4, 3),
(48, 'IMG_4240.jpeg', '', 0, 0, 4, 3),
(49, 'IMG_4242.jpeg', '', 0, 0, 4, 3),
(50, 'IMG_4245.jpeg', '', 0, 0, 4, 3),
(51, 'IMG_4251.jpeg', '', 0, 0, 4, 3),
(52, 'IMG_0740.jpeg', '', 0, 0, 4, 4),
(53, 'IMG_0768.jpeg', '', 0, 0, 4, 4),
(54, 'IMG_0749.jpg', '', 0, 0, 4, 4),
(55, 'IMG_0741.jpeg', '', 0, 0, 4, 4),
(56, 'IMG_0752.jpeg', '', 0, 0, 4, 4),
(57, 'IMG_0758.jpeg', '', 0, 0, 4, 4),
(58, 'IMG_0759.jpeg', '', 0, 0, 4, 4),
(59, 'IMG_0762.jpeg', '', 0, 0, 4, 4),
(60, 'IMG_0760.jpeg', '', 0, 0, 4, 4),
(61, 'IMG_0765.jpeg', '', 0, 0, 4, 4),
(62, 'IMG_0766.jpeg', '', 0, 0, 4, 4),
(63, 'IMG_0767.jpeg', '', 0, 0, 4, 4),
(64, 'IMG_0513.jpeg', '', 0, 0, 4, 11),
(65, 'IMG_1476.jpeg', '', 0, 0, 4, 11),
(66, 'IMG_2718.jpeg', '', 0, 0, 4, 11),
(67, 'IMG_9965.jpg', '', 0, 0, 4, 11),
(68, 'IMG_9967.jpg', '', 0, 0, 4, 11),
(69, 'IMG_9993.jpeg', '', 0, 0, 4, 11),
(70, 'IMG_9974.jpg', '', 0, 0, 4, 11),
(71, 'IMG_0004.jpeg', '', 0, 0, 4, 11),
(72, 'IMG_0014.jpeg', '', 0, 0, 4, 11),
(73, 'IMG_0206.jpeg', '', 0, 0, 4, 11),
(74, 'IMG_0201.jpeg', '', 0, 0, 4, 11),
(75, 'IMG_0224.jpeg', '', 0, 0, 4, 11),
(76, 'IMG_2664.jpeg', '', 0, 0, 4, 14),
(77, 'IMG_2668.jpg', '', 0, 0, 4, 14),
(78, 'IMG_2673.jpeg', '', 0, 0, 4, 14),
(79, 'IMG_2676.jpg', '', 0, 0, 4, 14),
(81, 'IMG_1019_jpg.jpg', 'Hovězí porážka', 0, 0, 4, 18),
(82, 'IMG_1144.jpeg', 'Stará kalkulačka s tiskárnou', 0, 0, 4, 18),
(83, 'IMG_4129.jpeg', 'Chlív', 0, 0, 4, 18),
(84, 'IMG_4229.jpeg', 'Zadní východ do ul. Plzeňská', 0, 0, 4, 18),
(85, 'IMG_4231.jpeg', 'Chodba zadního východu', 0, 0, 4, 18),
(86, 'IMG_4234.jpeg', '', 0, 0, 4, 18),
(87, 'IMG_4237.jpeg', '', 0, 0, 4, 18),
(88, 'IMG_4238.jpeg', '', 0, 0, 4, 18),
(89, 'IMG_4240.jpeg', 'Kancelář - administrativní budova', 0, 0, 4, 18),
(90, 'IMG_4242.jpeg', 'Vchod na půdu', 0, 0, 4, 18),
(91, 'IMG_0741.jpeg', '', 0, 0, 4, 19),
(92, 'IMG_0740.jpeg', '', 0, 0, 4, 19),
(93, 'IMG_0749.jpg', '', 0, 0, 4, 19),
(94, 'IMG_0752.jpeg', '', 0, 0, 4, 19),
(95, 'IMG_0759.jpeg', '', 0, 0, 4, 19),
(96, 'IMG_0758.jpeg', 'Pohled na budovu od nástupiště', 0, 1, 4, 19),
(97, 'IMG_0762.jpeg', '', 0, 0, 4, 19),
(98, 'IMG_0760.jpeg', '', 0, 0, 4, 19),
(99, 'IMG_0766.jpeg', '', 0, 0, 4, 19),
(100, 'IMG_0765.jpeg', '', 0, 0, 4, 19),
(101, 'IMG_0767.jpeg', '', 0, 0, 4, 19),
(102, 'IMG_0768.jpeg', '', 0, 0, 4, 19),
(104, 'IMG_1478.jpeg', '', 0, 0, 4, 24),
(105, 'IMG_1479.jpeg', '', 0, 1, 4, 24),
(106, 'IMG_2657.jpeg', '', 0, 0, 4, 24),
(107, 'IMG_2662.jpeg', '', 0, 0, 4, 24),
(108, 'IMG_2661.jpeg', '', 0, 0, 4, 24),
(109, 'IMG_0004.jpeg', '', 0, 0, 4, 26),
(110, 'IMG_0014.jpeg', '', 0, 0, 4, 26),
(111, 'IMG_0206.jpeg', '', 0, 0, 4, 26),
(112, 'IMG_0201.jpeg', '', 0, 0, 4, 26),
(113, 'IMG_0513.jpeg', '', 0, 0, 4, 26),
(114, 'IMG_0224.jpeg', '', 0, 0, 4, 26),
(115, 'IMG_2718.jpeg', '', 0, 0, 4, 26),
(116, 'IMG_1476.jpeg', '', 0, 0, 4, 26),
(117, 'IMG_9965.jpg', '', 0, 0, 4, 26),
(118, 'IMG_9967.jpg', '', 0, 0, 4, 26),
(119, 'IMG_9974.jpg', '', 0, 0, 4, 26),
(120, 'IMG_9993.jpeg', '', 0, 0, 4, 26),
(132, 'IMG_0059.jpeg', '', 0, 0, 4, 28),
(133, 'IMG_0061.jpeg', '', 0, 0, 4, 28),
(134, 'IMG_0095.jpeg', '', 0, 0, 4, 28),
(135, 'IMG_0090.jpeg', '', 0, 0, 4, 28),
(136, 'IMG_0096.jpeg', '', 0, 0, 4, 28),
(137, 'IMG_0107.jpeg', '', 0, 0, 4, 28),
(138, 'IMG_0111.jpeg', '', 0, 0, 4, 28),
(139, 'IMG_0116.jpeg', '', 0, 0, 4, 28),
(140, 'IMG_0716.jpeg', '', 0, 1, 4, 28),
(141, 'IMG_2668.jpg', '', 0, 0, 4, 29),
(142, 'IMG_2664.jpeg', '', 0, 0, 4, 29),
(143, 'IMG_2676.jpg', '', 0, 0, 4, 29),
(144, 'IMG_2673.jpeg', '', 0, 0, 4, 29),
(145, 'IMG_0365.jpg', '', 0, 0, 4, 30),
(146, 'IMG_0366.jpg', '', 0, 0, 4, 30),
(147, 'IMG_0369.jpg', '', 0, 0, 4, 30),
(148, 'IMG_0378.jpg', '', 0, 0, 4, 30),
(149, 'IMG_0411.jpg', '', 0, 0, 4, 30),
(150, 'IMG_0387.jpg', '', 0, 0, 4, 30),
(151, 'IMG_0424.jpg', '', 0, 0, 4, 30),
(152, 'IMG_0427.jpg', '', 0, 0, 4, 30),
(153, 'IMG_0433.jpg', '', 0, 0, 4, 30),
(154, 'IMG_0440.jpg', '', 0, 1, 4, 30),
(155, 'IMG_1015_jpg.jpg', '', 0, 0, 4, 18),
(156, 'IMG_1450.jpeg', '', 0, 0, 4, 31),
(157, 'IMG_1449.jpeg', '', 0, 0, 4, 31),
(158, 'IMG_1443.jpeg', '', 0, 0, 4, 31),
(159, 'IMG_1441.jpeg', '', 0, 1, 4, 31),
(160, 'IMG_1440.jpeg', '', 0, 0, 4, 31),
(161, 'IMG_1442.jpeg', '', 0, 0, 4, 31),
(162, 'IMG_1475.jpeg', '', 0, 1, 4, 23),
(163, 'IMG_1473.jpeg', '', 0, 0, 4, 23),
(164, 'IMG_1472.jpeg', '', 0, 0, 4, 23),
(165, 'IMG_1470.jpeg', '', 0, 0, 4, 23),
(166, 'IMG_1462.jpeg', '', 0, 0, 4, 23),
(167, 'IMG_1459.jpeg', '', 0, 0, 4, 23),
(168, 'IMG_1457.jpeg', '', 0, 0, 4, 23),
(169, 'IMG_1455.jpeg', '', 0, 0, 4, 23),
(170, 'IMG_1453.jpeg', '', 0, 0, 4, 23),
(171, 'IMG_2656.jpeg', '', 0, 0, 4, 23),
(172, 'IMG_2650.jpeg', '', 0, 0, 4, 23),
(173, 'IMG_0650.jpeg', '', 0, 1, 4, 20),
(174, 'IMG_3153.jpeg', '', 0, 0, 4, 20),
(175, 'IMG_3146.jpeg', '', 0, 0, 4, 20),
(176, 'IMG_3103.jpeg', '', 0, 0, 4, 20),
(177, 'IMG_3115.jpeg', '', 0, 0, 4, 20),
(178, 'IMG_3117.jpeg', '', 0, 0, 4, 20),
(179, 'IMG_3125.jpeg', '', 0, 0, 4, 20),
(180, 'IMG_3135.jpeg', '', 0, 0, 4, 20),
(181, 'IMG_3139.jpeg', '', 0, 0, 4, 20),
(182, 'IMG_1594.jpeg', '', 0, 0, 4, 25),
(183, 'IMG_1596.jpeg', '', 0, 0, 4, 25),
(184, 'IMG_1597.jpeg', '', 0, 0, 4, 25),
(185, 'IMG_2341.jpeg', '', 0, 0, 4, 25),
(186, '3564.jpg', '', 0, 1, 4, 21),
(187, 'IMG_1703.jpeg', '', 0, 1, 4, 22),
(188, 'IMG_2336.jpeg', '', 0, 1, 4, 25),
(189, 'IMG_1557.jpeg', '', 0, 1, 4, 26),
(190, '32258.jpg', '', 0, 1, 4, 29),
(191, '20774.jpg', 'Bytový dům nádraží Obrnice', 0, 0, 4, 17),
(192, '3564.jpg', 'Hotel Nachtigall Praha', 0, 0, 4, 17),
(193, '32258.jpg', 'Nádraží Tvršice', 0, 0, 4, 17),
(194, '48035.jpg', 'Jatka Žatec', 0, 0, 4, 17),
(195, 'bd-trnovany.jpeg', 'Bytový dům Trnovany', 0, 0, 4, 17),
(196, 'depo-trnovany.jpeg', 'Depo Trnovany', 0, 0, 4, 17),
(197, 'IMG_0440.jpeg', 'Administrativní­ budova, Nádraží­ Obrnice', 0, 0, 4, 17),
(198, 'IMG_0758.jpeg', 'Nádraží Třebušice', 0, 0, 4, 17),
(199, 'IMG_0716.jpeg', 'Mendlova továrna', 0, 0, 4, 17),
(200, 'IMG_1703.jpeg', 'Hrázdeňka', 0, 0, 4, 17),
(201, 'IMG_1557.jpeg', 'Kolektory VS-1', 0, 0, 4, 17),
(202, 'IMG_4220.jpeg', 'Vojenský velín Horní Počaply', 0, 0, 4, 17),
(203, 'IMG_2336.jpeg', 'Výměníková stanice VS-1', 0, 0, 4, 17),
(204, 'IMG_4260.jpeg', 'Jatka Žatec', 0, 0, 4, 17),
(207, '48035.jpg', 'Pohled na podnikovou prodejnu', 0, 1, 4, 18),
(208, 'IMG_1860.jpeg', 'Jatka byla v létě roku 2024 zdemolována', 0, 0, 4, 18),
(209, 'IMG_1441.jpeg', 'Stavení u řeky', 0, 0, 4, 17),
(210, 'IMG_2322.jpeg', '', 0, 0, 4, 21),
(211, 'IMG_4181.jpeg', '', 0, 0, 1, 27),
(212, 'IMG_4183.jpeg', '', 0, 0, 1, 27),
(213, 'IMG_4187.jpeg', '', 0, 0, 1, 27),
(214, 'IMG_4191.jpeg', '', 0, 0, 1, 27),
(215, 'IMG_4193.jpeg', '', 0, 0, 1, 27),
(216, 'IMG_4200.jpeg', '', 0, 0, 1, 27),
(217, 'IMG_4203.jpeg', '', 0, 0, 1, 27),
(218, 'IMG_4206.jpeg', '', 0, 0, 1, 27),
(219, 'IMG_4211.jpeg', '', 0, 0, 1, 27),
(220, 'IMG_4212.jpeg', '', 0, 0, 1, 27),
(221, 'IMG_4220.jpeg', '', 0, 1, 1, 27);

-- --------------------------------------------------------

--
-- Struktura tabulky `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descr` varchar(1024) NOT NULL,
  `upper_gallery_id` int(3) NOT NULL,
  `max_items_count` int(3) NOT NULL,
  `is_public` tinyint(4) NOT NULL,
  `is_locked` tinyint(4) NOT NULL,
  `is_def_places` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `gid` int(8) NOT NULL,
  `user_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Vypisuji data pro tabulku `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `descr`, `upper_gallery_id`, `max_items_count`, `is_public`, `is_locked`, `is_def_places`, `password`, `gid`, `user_id`) VALUES
(17, 'UrbexNation', '', 0, 999, 1, 0, 1, 'd41d8cd98f00b204e9800998ecf8427e', 795605, 1),
(18, 'Jatka Žatec', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 284999, 1),
(19, 'Nádraží Třebušice', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 877873, 1),
(20, 'Bytový dům nádraží Obrnice', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 947395, 1),
(21, 'Hotel Nachtigall Praha', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 277367, 1),
(22, 'Hrázděnka', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 495228, 1),
(23, 'Bytový dům Trnovany', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 542321, 1),
(24, 'Depo Trnovany', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 253388, 1),
(25, 'Výměníková stanice VS-1', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 434388, 1),
(26, 'Kolektory VS-1', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 425745, 1),
(27, 'Vojenský velín Horní Počaply', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 173934, 1),
(28, 'Mendlova továrna', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 299210, 1),
(29, 'Nádraží Tvršice', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 684993, 1),
(30, 'Administrativní­ budova, Nádraží­ Obrnice', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 599836, 1),
(31, 'Stavení u řeky', '', 17, 999, 1, 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', 151553, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `aid` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  `folder_name` varchar(16) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_md5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT pro tabulku `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
