-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Sob 27. čec 2024, 19:46
-- Verze serveru: 8.0.36
-- Verze PHP: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Databáze: `gallery`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `files`
--

CREATE TABLE `files` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `alt_text` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `size` int NOT NULL,
  `is_thumbnail` tinyint DEFAULT '0',
  `user_id` int NOT NULL,
  `gallery_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktura tabulky `galleries`
--

CREATE TABLE `galleries` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `descr` varchar(1024) NOT NULL,
  `upper_gallery_id` int NOT NULL,
  `max_items_count` int NOT NULL,
  `is_private` tinyint NOT NULL,
  `is_locked` tinyint NOT NULL,
  `is_def_places` tinyint NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `gid` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Struktura tabulky `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `gallery_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gallery_descr` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gallery_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gallery_default_private` tinyint NOT NULL,
  `gallery_default_lock` tinyint NOT NULL,
  `user_default_verify` tinyint NOT NULL,
  `user_default_banned` tinyint NOT NULL,
  `gallery_private` tinyint NOT NULL,
  `allow_signup` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `aid` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint NOT NULL DEFAULT '0',
  `folder_name` varchar(16) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_md5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexy pro tabulku `settings`
--
ALTER TABLE `settings`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;
