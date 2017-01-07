-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-01-07 20:11:48
-- 服务器版本： 5.5.48-log
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hitokoto`
--

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_like`
--

CREATE TABLE IF NOT EXISTS `hitokoto_like` (
  `ID` int(11) NOT NULL,
  `sentenceID` int(11) NOT NULL,
  `ip` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_migrations`
--

CREATE TABLE IF NOT EXISTS `hitokoto_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_password_resets`
--

CREATE TABLE IF NOT EXISTS `hitokoto_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_pending`
--

CREATE TABLE IF NOT EXISTS `hitokoto_pending` (
  `id` int(11) NOT NULL,
  `hitokoto` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `creator` varchar(255) DEFAULT NULL,
  `creator_uid` int(11) DEFAULT NULL,
  `owner` varchar(255) DEFAULT '0',
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_refuse`
--

CREATE TABLE IF NOT EXISTS `hitokoto_refuse` (
  `id` int(11) NOT NULL,
  `hitokoto` text,
  `type` text,
  `from` text,
  `creator` text,
  `creator_uid` int(11) NOT NULL,
  `owner` text,
  `created_at` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_sentence`
--

CREATE TABLE IF NOT EXISTS `hitokoto_sentence` (
  `id` int(11) NOT NULL,
  `hitokoto` char(255) NOT NULL,
  `type` char(255) NOT NULL,
  `from` char(255) NOT NULL,
  `from_who` varchar(255) DEFAULT NULL,
  `creator` char(255) DEFAULT 'hitokoto',
  `creator_uid` int(11) DEFAULT NULL,
  `assessor` char(255) DEFAULT NULL,
  `owner` char(255) DEFAULT '0',
  `created_at` char(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_ticket`
--

CREATE TABLE IF NOT EXISTS `hitokoto_ticket` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL COMMENT '开设ticket用户id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '工单状态，1为开启，2为关闭',
  `content` text COLLATE utf8_unicode_ci,
  `attachment` text COLLATE utf8_unicode_ci,
  `open_time` datetime NOT NULL COMMENT '创建ticket时间',
  `last_update` datetime NOT NULL COMMENT '最后更新时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_ticket_reply`
--

CREATE TABLE IF NOT EXISTS `hitokoto_ticket_reply` (
  `id` int(10) unsigned NOT NULL,
  `belong_to` int(11) NOT NULL COMMENT '归属ticket的ID',
  `uid` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment` text COLLATE utf8_unicode_ci,
  `reply_time` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `hitokoto_users`
--

CREATE TABLE IF NOT EXISTS `hitokoto_users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否是管理员，1为是0为否',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hitokoto_like`
--
ALTER TABLE `hitokoto_like`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hitokoto_password_resets`
--
ALTER TABLE `hitokoto_password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `hitokoto_pending`
--
ALTER TABLE `hitokoto_pending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hitokoto_refuse`
--
ALTER TABLE `hitokoto_refuse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hitokoto_sentence`
--
ALTER TABLE `hitokoto_sentence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hitokoto_ticket`
--
ALTER TABLE `hitokoto_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hitokoto_ticket_reply`
--
ALTER TABLE `hitokoto_ticket_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hitokoto_users`
--
ALTER TABLE `hitokoto_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hitokoto_like`
--
ALTER TABLE `hitokoto_like`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hitokoto_pending`
--
ALTER TABLE `hitokoto_pending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hitokoto_refuse`
--
ALTER TABLE `hitokoto_refuse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hitokoto_sentence`
--
ALTER TABLE `hitokoto_sentence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hitokoto_ticket`
--
ALTER TABLE `hitokoto_ticket`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hitokoto_ticket_reply`
--
ALTER TABLE `hitokoto_ticket_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hitokoto_users`
--
ALTER TABLE `hitokoto_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
