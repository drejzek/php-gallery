-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Počítač: endora-db-11.stable.cz:3306
-- Vytvořeno: Sob 10. srp 2024, 00:44
-- Verze serveru: 10.3.35-MariaDB
-- Verze PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Databáze: `urbexnation`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `is_thumbnail` tinyint(4) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `descr` varchar(1024) NOT NULL,
  `upper_gallery_id` int(11) NOT NULL,
  `max_items_count` int(11) NOT NULL,
  `is_private` tinyint(4) NOT NULL,
  `is_locked` tinyint(4) NOT NULL,
  `is_def_places` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `gid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `gallery_name` varchar(255) NOT NULL,
  `gallery_descr` varchar(255) DEFAULT NULL,
  `gallery_url` varchar(255) NOT NULL,
  `gallery_default_private` tinyint(4) NOT NULL,
  `gallery_default_lock` tinyint(4) NOT NULL,
  `user_default_verify` tinyint(4) NOT NULL,
  `user_default_banned` tinyint(4) NOT NULL,
  `gallery_private` tinyint(4) NOT NULL,
  `allow_signup` tinyint(4) NOT NULL,
  `theme_bg_header_color` varchar(7) NOT NULL DEFAULT '#000000',
  `theme_bg_page_color` varchar(7) NOT NULL DEFAULT '#f8f9fa',
  `theme_bg_gallery_card_color` varchar(7) NOT NULL DEFAULT '#ffffff',
  `theme_bg_footer_color` varchar(7) NOT NULL DEFAULT '#ffffff',
  `theme_font_color` varchar(7) NOT NULL DEFAULT '#212529',
  `theme_header_font_color` varchar(17) NOT NULL DEFAULT '#ffffff'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
