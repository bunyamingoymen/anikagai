-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Ara 2023, 07:59:34
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `anikagai`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `animes`
--

CREATE TABLE `animes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `episode_count` int(11) NOT NULL DEFAULT 0,
  `season_count` int(11) NOT NULL DEFAULT 0,
  `average_min` int(11) NOT NULL DEFAULT 0,
  `date` varchar(255) NOT NULL DEFAULT '2000',
  `main_category` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `main_category_name` varchar(255) NOT NULL DEFAULT 'Genel',
  `click_count` int(11) NOT NULL DEFAULT 0,
  `comment_count` int(11) NOT NULL DEFAULT 0,
  `scoreUsers` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `score` double(5,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `showStatus` tinyint(4) NOT NULL DEFAULT 0,
  `plusEighteen` tinyint(4) NOT NULL DEFAULT 1,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `animes`
--

INSERT INTO `animes` (`id`, `code`, `name`, `short_name`, `image`, `description`, `episode_count`, `season_count`, `average_min`, `date`, `main_category`, `main_category_name`, `click_count`, `comment_count`, `scoreUsers`, `score`, `showStatus`, `plusEighteen`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tokyo Ghoul', 'tokyo-ghoul', 'files/animes/animesImages/1.jpg', 'gdsgdfhtrhtrhtrh', 0, 0, 35, '2014', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 12:51:20', '2023-12-08 12:51:20'),
(2, 2, 'Attack On Titan', 'attack-on-titan', 'files/animes/animesImages/2.jpg', 'ğkorfldög.rrg', 0, 0, 45, '2015', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 12:57:12', '2023-12-08 12:57:12'),
(3, 3, 'One Piece', 'one-piece', 'files/animes/animesImages/3.jpg', 'efsdolöişrfDSÇisdfdfgfd', 0, 0, 45, '2015', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 12:57:36', '2023-12-08 12:57:36'),
(4, 4, 'Naruto', 'naruto', 'files/animes/animesImages/4.jpg', 'rfvsfgdsfvsdfvdfvsfv', 0, 0, 15, '2010', 1, 'Genel', 0, 0, 0, 0.00, 2, 0, 0, 0, 0, '2023-12-08 12:57:58', '2023-12-08 13:00:58'),
(5, 5, 'Fullmetal Alchemist: Brotherhood', 'fullmetal-alchemist:-brotherhood', 'files/animes/animesImages/5.jpg', 'dfsvsdgdsagsdg', 0, 0, 45, '2014', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:15:37', '2023-12-08 13:15:37'),
(6, 6, 'Avatar The Last Airbender', 'avatar-the-last-airbender', 'files/animes/animesImages/6.jpg', 'gfdsgsfgdsfgfdsg', 0, 0, 35, '2013', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:16:28', '2023-12-08 13:16:28'),
(7, 7, 'Sousou No Frieren', 'sousou-no-frieren', 'files/animes/animesImages/7.jpg', 'dsffsdfdsfdsf', 0, 0, 63, '2012', 1, 'Genel', 0, 0, 0, 0.00, 0, 1, 0, NULL, 0, '2023-12-08 13:17:04', '2023-12-08 13:17:04'),
(8, 8, 'Oshi No Ko', 'oshi-no-ko', 'files/animes/animesImages/8.jpg', 'regdrsbresgreag', 0, 0, 40, '1999', 1, 'Genel', 0, 0, 0, 0.00, 2, 0, 0, NULL, 0, '2023-12-08 13:17:44', '2023-12-08 13:17:44'),
(9, 9, 'Steins Gate', 'steins-gate', 'files/animes/animesImages/9.jpg', 'hsdfgdgesgesgdr', 0, 0, 52, '2018', 1, 'Genel', 0, 0, 0, 0.00, 3, 0, 0, NULL, 0, '2023-12-08 13:18:18', '2023-12-08 13:18:18'),
(10, 10, 'Monster', 'monster', 'files/animes/animesImages/10.jpg', 'fsdafdsafdsafadaf', 3, 2, 15, '2019', 1, 'Genel', 2, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:18:43', '2023-12-10 05:20:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anime_calendars`
--

CREATE TABLE `anime_calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `anime_code` bigint(20) UNSIGNED NOT NULL,
  `description` longtext DEFAULT NULL,
  `first_date` date NOT NULL DEFAULT '1970-01-01',
  `cycle_type` int(11) NOT NULL DEFAULT 0,
  `special_type` int(11) DEFAULT NULL,
  `special_count` int(11) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `background_color` varchar(255) NOT NULL DEFAULT '#007BFF',
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `anime_calendars`
--

INSERT INTO `anime_calendars` (`id`, `code`, `anime_code`, `description`, `first_date`, `cycle_type`, `special_type`, `special_count`, `end_date`, `background_color`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1.sezon 1.Bölüm', '2023-12-18', 2, 1, NULL, '2024-04-01', '#007BFF', 0, 0, 0, '2023-12-17 03:14:43', '2023-12-17 03:15:16'),
(2, 2, 2, '1.sezon 1.Bölüm', '2023-12-19', 0, 1, NULL, NULL, '#FF0500', 0, NULL, 0, '2023-12-17 03:16:47', '2023-12-17 03:16:47'),
(3, 3, 3, '2.Sezon 1.Bölüm', '2023-12-18', 3, 1, NULL, '2024-05-18', '#DC3545', 0, 0, 0, '2023-12-17 03:18:29', '2023-12-17 03:18:57'),
(4, 4, 4, 'Yeni Sezon', '2023-12-18', 2, 1, NULL, '2024-02-01', '#DC3545', 0, NULL, 0, '2023-12-17 03:28:07', '2023-12-17 03:28:07'),
(5, 5, 5, 'Yeni Bölüm', '2023-12-18', 2, 1, NULL, '2024-04-01', '#6C757D', 0, NULL, 0, '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(6, 6, 8, '1.Sezon 1.Bölüm', '2023-12-18', 0, 1, NULL, NULL, '#800080', 0, NULL, 0, '2023-12-17 03:29:16', '2023-12-17 03:29:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anime_calendar_lists`
--

CREATE TABLE `anime_calendar_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `anime_calendar_code` bigint(20) UNSIGNED NOT NULL,
  `calendar_order` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `anime_calendar_lists`
--

INSERT INTO `anime_calendar_lists` (`id`, `code`, `anime_calendar_code`, `calendar_order`, `date`, `created_at`, `updated_at`) VALUES
(16, 1, 1, 1, '2023-12-18', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(17, 2, 1, 2, '2023-12-25', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(18, 3, 1, 3, '2024-01-01', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(19, 4, 1, 4, '2024-01-08', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(20, 5, 1, 5, '2024-01-15', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(21, 6, 1, 6, '2024-01-22', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(22, 7, 1, 7, '2024-01-29', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(23, 8, 1, 8, '2024-02-05', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(24, 9, 1, 9, '2024-02-12', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(25, 10, 1, 10, '2024-02-19', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(26, 11, 1, 11, '2024-02-26', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(27, 12, 1, 12, '2024-03-04', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(28, 13, 1, 13, '2024-03-11', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(29, 14, 1, 14, '2024-03-18', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(30, 15, 1, 15, '2024-03-25', '2023-12-17 03:15:16', '2023-12-17 03:15:16'),
(31, 16, 2, 1, '2023-12-19', '2023-12-17 03:16:47', '2023-12-17 03:16:47'),
(37, 17, 3, 1, '2023-12-18', '2023-12-17 03:18:57', '2023-12-17 03:18:57'),
(38, 18, 3, 2, '2024-01-18', '2023-12-17 03:18:57', '2023-12-17 03:18:57'),
(39, 19, 3, 3, '2024-02-18', '2023-12-17 03:18:57', '2023-12-17 03:18:57'),
(40, 20, 3, 4, '2024-03-18', '2023-12-17 03:18:57', '2023-12-17 03:18:57'),
(41, 21, 3, 5, '2024-04-18', '2023-12-17 03:18:57', '2023-12-17 03:18:57'),
(42, 22, 4, 1, '2023-12-18', '2023-12-17 03:28:07', '2023-12-17 03:28:07'),
(43, 23, 4, 2, '2023-12-25', '2023-12-17 03:28:07', '2023-12-17 03:28:07'),
(44, 24, 4, 3, '2024-01-01', '2023-12-17 03:28:07', '2023-12-17 03:28:07'),
(45, 25, 4, 4, '2024-01-08', '2023-12-17 03:28:07', '2023-12-17 03:28:07'),
(46, 26, 4, 5, '2024-01-15', '2023-12-17 03:28:07', '2023-12-17 03:28:07'),
(47, 27, 4, 6, '2024-01-22', '2023-12-17 03:28:07', '2023-12-17 03:28:07'),
(48, 28, 4, 7, '2024-01-29', '2023-12-17 03:28:07', '2023-12-17 03:28:07'),
(49, 29, 5, 1, '2023-12-18', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(50, 30, 5, 2, '2023-12-25', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(51, 31, 5, 3, '2024-01-01', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(52, 32, 5, 4, '2024-01-08', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(53, 33, 5, 5, '2024-01-15', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(54, 34, 5, 6, '2024-01-22', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(55, 35, 5, 7, '2024-01-29', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(56, 36, 5, 8, '2024-02-05', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(57, 37, 5, 9, '2024-02-12', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(58, 38, 5, 10, '2024-02-19', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(59, 39, 5, 11, '2024-02-26', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(60, 40, 5, 12, '2024-03-04', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(61, 41, 5, 13, '2024-03-11', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(62, 42, 5, 14, '2024-03-18', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(63, 43, 5, 15, '2024-03-25', '2023-12-17 03:28:43', '2023-12-17 03:28:43'),
(64, 44, 6, 1, '2023-12-18', '2023-12-17 03:29:16', '2023-12-17 03:29:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anime_episodes`
--

CREATE TABLE `anime_episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `anime_code` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `season_short` int(11) NOT NULL DEFAULT 0,
  `episode_short` int(11) NOT NULL DEFAULT 0,
  `click_count` int(11) NOT NULL DEFAULT 0,
  `minute` int(11) NOT NULL DEFAULT 0,
  `intro_start_time_min` int(11) NOT NULL DEFAULT 0,
  `intro_start_time_sec` int(11) NOT NULL DEFAULT 0,
  `intro_end_time_min` int(11) NOT NULL DEFAULT 0,
  `intro_end_time_sec` int(11) NOT NULL DEFAULT 5,
  `publish_date` date NOT NULL DEFAULT '1970-01-01',
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `anime_episodes`
--

INSERT INTO `anime_episodes` (`id`, `code`, `name`, `anime_code`, `image`, `video`, `description`, `season_short`, `episode_short`, `click_count`, `minute`, `intro_start_time_min`, `intro_start_time_sec`, `intro_end_time_min`, `intro_end_time_sec`, `publish_date`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pilot', 10, NULL, 'files/animes/animesEpisodes/10/1/1/1.mp4', 'fdsdgdsfgfdsgdfsg', 1, 1, 0, 0, 0, 5, 0, 12, '2023-12-04', 0, NULL, 0, '2023-12-10 05:19:15', '2023-12-10 05:19:15'),
(2, 2, 'Pilot 2', 10, NULL, 'files/animes/animesEpisodes/10/1/2/2.mp4', 'fdsdgdsfgfdsgdfsg', 1, 2, 0, 0, 0, 5, 0, 12, '2023-12-04', 0, NULL, 0, '2023-12-10 05:19:35', '2023-12-10 05:19:35'),
(3, 3, 'Pliot 3', 10, NULL, 'files/animes/animesEpisodes/10/2/1/3.mp4', 'hhncgjfghjfjdgf', 2, 1, 0, 0, 0, 5, 0, 12, '2023-12-04', 0, NULL, 0, '2023-12-10 05:20:08', '2023-12-10 05:20:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `authorization_clauses`
--

CREATE TABLE `authorization_clauses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `authorization_clauses`
--

INSERT INTO `authorization_clauses` (`id`, `code`, `text`, `description`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kullanıcı Ekleme', 'Kullanıcı Ekleme Yetkisi', 1, NULL, 0, NULL, NULL),
(2, 2, 'Kullanıcı Listeleme', 'Kullanıcı Ekleme Yetkisi', 1, NULL, 0, NULL, NULL),
(3, 3, 'Kullanıcı Güncelleme', 'Kullanıcı Güncelleyebilme Yetkisi', 1, NULL, 0, NULL, NULL),
(4, 4, 'Kullanıcı Silme', 'Kullanıcı Silebilme Yetkisi', 1, NULL, 0, NULL, NULL),
(5, 5, 'Kullanıcı Grupları Ekleme', 'Kullanıcı Grupları Ekleme Yetkisi', 1, NULL, 0, NULL, NULL),
(6, 6, 'Kullanıcı Grupları Listeleme', 'Kullanıcı Grupları Ekleme Yetkisi', 1, NULL, 0, NULL, NULL),
(7, 7, 'Kullanıcı Grupları Güncelleme', 'Kullanıcı Grupları Güncelleyebilme Yetkisi', 1, NULL, 0, NULL, NULL),
(8, 8, 'Kullanıcı Grupları Silme', 'Kullanıcı Grupları Silebilme Yetkisi', 1, NULL, 0, NULL, NULL),
(9, 0, 'Grup Yetkileri Ekleme', 'Grup Yetkileri Ekleme Yetkisi', 1, NULL, 0, NULL, NULL),
(10, 10, 'Grup Yetkileri Listeleme', 'Grup Yetkileri Ekleme Yetkisi', 1, NULL, 0, NULL, NULL),
(11, 0, 'Grup Yetkileri Güncelleme', 'Grup Yetkileri Güncelleyebilme Yetkisi', 1, NULL, 0, NULL, NULL),
(12, 0, 'Grup Yetkileri Silme', 'Grup Yetkileri Silebilme Yetkisi', 1, NULL, 0, NULL, NULL),
(13, 13, 'Anasayfa Ayarlarını Değiştirebilme', 'Anasayfa Ayarlarını Değiştirebilme', 1, NULL, 0, NULL, NULL),
(14, 14, 'Logoları Değiştirebilme', 'Logoları Değiştirebilme', 1, NULL, 0, NULL, NULL),
(15, 15, 'Meta Etiketlerini Değiştirebilme', 'Meta Etiketlerini Değiştirebilme', 1, NULL, 0, NULL, NULL),
(16, 16, 'Başlıkları Değiştirebilme', 'Başlıkları Değiştirebilme', 1, NULL, 0, NULL, NULL),
(17, 17, 'Menüleri Değiştirebilme', 'Menüleri Değiştirebilme', 1, NULL, 0, NULL, NULL),
(18, 18, 'Sosyal Medya Linkerini Değiştirebilme', 'Sosyal Medya Linkerini Değiştirebilme', 1, NULL, 0, NULL, NULL),
(19, 19, 'Anime Ekleyebilme', 'Anime Ekleyebilme', 1, NULL, 0, NULL, NULL),
(20, 20, 'Anime Listeleyebilme', 'Anime Listeleyebilme', 1, NULL, 0, NULL, NULL),
(21, 21, 'Anime Güncelleyebilme', 'Anime Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(22, 22, 'Anime Silebilme', 'Anime Silebilme', 1, NULL, 0, NULL, NULL),
(23, 23, 'Anime Bölümü Ekleyebilme', 'Anime Bölümü Ekleyebilme', 1, NULL, 0, NULL, NULL),
(24, 24, 'Anime Bölümü Listeleyebilme', 'Anime Bölümü Listeleyebilme', 1, NULL, 0, NULL, NULL),
(25, 25, 'Anime Bölümü Güncelleyebilme', 'Anime Bölümü Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(26, 26, 'Anime Bölümü Silebilme', 'Anime Bölümü Silebilme', 1, NULL, 0, NULL, NULL),
(27, 27, 'Anime Takvimi Ekleyebilme', 'Anime Takvimi Ekleyebilme', 1, NULL, 0, NULL, NULL),
(28, 28, 'Anime Takvimi Listeleyebilme', 'Anime Takvimi Listeleyebilme', 1, NULL, 0, NULL, NULL),
(29, 0, 'Anime Takvimi Güncelleyebilme', 'Anime Takvimi Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(30, 0, 'Anime Takvimi Silebilme', 'Anime Takvimi Silebilme', 1, NULL, 0, NULL, NULL),
(31, 31, 'Webtoon Ekleyebilme', 'Webtoon Ekleyebilme', 1, NULL, 0, NULL, NULL),
(32, 32, 'Webtoon Listeleyebilme', 'Webtoon Listeleyebilme', 1, NULL, 0, NULL, NULL),
(33, 33, 'Webtoon Güncelleyebilme', 'Webtoon Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(34, 34, 'Webtoon Silebilme', 'Webtoon Silebilme', 1, NULL, 0, NULL, NULL),
(35, 35, 'Webtoon Bölümü Ekleyebilme', 'Webtoon Bölümü Ekleyebilme', 1, NULL, 0, NULL, NULL),
(36, 36, 'Webtoon Bölümü Listeleyebilme', 'Webtoon Bölümü Listeleyebilme', 1, NULL, 0, NULL, NULL),
(37, 37, 'Webtoon Bölümü Güncelleyebilme', 'Webtoon Bölümü Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(38, 38, 'Webtoon Bölümü Silebilme', 'Webtoon Bölümü Silebilme', 1, NULL, 0, NULL, NULL),
(39, 39, 'Webtoon Takvimi Ekleyebilme', 'Webtoon Takvimi Ekleyebilme', 1, NULL, 0, NULL, NULL),
(40, 40, 'Webtoon Takvimi Listeleyebilme', 'Webtoon Takvimi Listeleyebilme', 1, NULL, 0, NULL, NULL),
(41, 0, 'Webtoon Takvimi Güncelleyebilme', 'Webtoon Takvimi Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(42, 0, 'Webtoon Takvimi Silebilme', 'Webtoon Takvimi Silebilme', 1, NULL, 0, NULL, NULL),
(43, 43, 'Sayfa Ekleyebilme', 'Sayfa Ekleyebilme', 1, NULL, 0, NULL, NULL),
(44, 44, 'Sayfa Listeleyebilme', 'Sayfa Listeleyebilme', 1, NULL, 0, NULL, NULL),
(45, 45, 'Sayfa Güncelleyebilme', 'Sayfa Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(46, 46, 'Sayfa Silebilme', 'Sayfa Silebilme', 1, NULL, 0, NULL, NULL),
(47, 47, 'Kategori Ekleyebilme', 'Kategori Ekleyebilme', 1, NULL, 0, NULL, NULL),
(48, 48, 'Kategori Listeleyebilme', 'Kategori Listeleyebilme', 1, NULL, 0, NULL, NULL),
(49, 49, 'Kategori Güncelleyebilme', 'Kategori Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(50, 50, 'Kategori Silebilme', 'Kategori Silebilme', 1, NULL, 0, NULL, NULL),
(51, 51, 'Etiket Ekleyebilme', 'Etiket Ekleyebilme', 1, NULL, 0, NULL, NULL),
(52, 52, 'Etiket Listeleyebilme', 'Etiket Listeleyebilme', 1, NULL, 0, NULL, NULL),
(53, 53, 'Etiket Güncelleyebilme', 'Etiket Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(54, 54, 'Etiket Silebilme', 'Etiket Silebilme', 1, NULL, 0, NULL, NULL),
(55, 55, 'Yorumları Görüntüleyebilme', 'Yorumları Görüntüleyebilme', 1, NULL, 0, NULL, NULL),
(56, 56, 'Yorumları Silebilme', 'Yorumları Silebilme', 1, NULL, 0, NULL, NULL),
(57, 57, 'İletişimleri Görebilme', 'İletişimleri Görebilme', 1, NULL, 0, NULL, NULL),
(58, 58, 'İletişimleri Silebilme', 'İletişimleri Silebilme', 1, NULL, 0, NULL, NULL),
(59, 59, 'İletişimleri Cevaplayabilme', 'İletişimleri Cevaplayabilme', 1, NULL, 0, NULL, NULL),
(60, 60, 'Üye oluşturabilme', 'Üye Oluşturabilme', 1, NULL, 0, NULL, NULL),
(61, 61, 'Üye Listeleyebilme', 'Üye Listeleyebilme', 1, NULL, 0, NULL, NULL),
(62, 62, 'Üye Güncelleyebilme', 'Üye Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(63, 63, 'Üye Silebilme', 'Üye Silebilme', 1, NULL, 0, NULL, NULL),
(64, 64, 'Slider videolarını listeleyip güncelleyebilme', 'Slider videolarını listeleyip güncelleyebilme', 1, NULL, 0, NULL, NULL),
(65, 65, 'Tema ayarlarını güncelleyebilme', 'Tema ayarlarını güncelleyebilme', 1, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `authorization_clause_groups`
--

CREATE TABLE `authorization_clause_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `clause_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `authorization_groups`
--

CREATE TABLE `authorization_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `authorization_groups`
--

INSERT INTO `authorization_groups` (`id`, `code`, `text`, `description`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'Site Yöneticisi', 1, NULL, 0, '2023-12-16 04:47:18', '2023-12-16 04:47:18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `short_name`, `description`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Genel', 'genel', 'Varsayılan', 1, NULL, 0, '2023-12-16 04:43:32', '2023-12-16 04:43:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `content_code` bigint(20) UNSIGNED NOT NULL,
  `content_type` tinyint(4) NOT NULL,
  `comment_type` tinyint(4) NOT NULL,
  `comment_top_code` bigint(20) UNSIGNED DEFAULT NULL,
  `comment_short` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `message` longtext NOT NULL,
  `user_code` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL DEFAULT '1970-01-01',
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `answered` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `content_categories`
--

CREATE TABLE `content_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_code` bigint(20) UNSIGNED NOT NULL,
  `content_code` bigint(20) UNSIGNED NOT NULL,
  `content_type` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `content_tags`
--

CREATE TABLE `content_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_code` bigint(20) UNSIGNED NOT NULL,
  `content_code` bigint(20) UNSIGNED NOT NULL,
  `content_type` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favorite_animes`
--

CREATE TABLE `favorite_animes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anime_code` varchar(255) NOT NULL,
  `user_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favorite_webtoons`
--

CREATE TABLE `favorite_webtoons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `webtoon_code` varchar(255) NOT NULL,
  `user_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `follow_animes`
--

CREATE TABLE `follow_animes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anime_code` bigint(20) UNSIGNED NOT NULL,
  `user_code` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `follow_index_users`
--

CREATE TABLE `follow_index_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `followed_user_code` bigint(20) UNSIGNED NOT NULL,
  `user_code` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `follow_users`
--

CREATE TABLE `follow_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `followed_user_code` bigint(20) UNSIGNED NOT NULL,
  `user_code` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `follow_webtoons`
--

CREATE TABLE `follow_webtoons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `webtoon_code` bigint(20) UNSIGNED NOT NULL,
  `user_code` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `index_users`
--

CREATE TABLE `index_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `key_values`
--

CREATE TABLE `key_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `optional` varchar(255) DEFAULT NULL,
  `optional_2` varchar(255) DEFAULT NULL,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `key_values`
--

INSERT INTO `key_values` (`id`, `code`, `key`, `value`, `optional`, `optional_2`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'index_logo', 'user/img/logo/logo.png', NULL, NULL, 1, NULL, 0, NULL, NULL),
(2, 2, 'index_logo_footer', 'user/img/logo/logo.png', NULL, NULL, 1, NULL, 0, NULL, NULL),
(3, 3, 'index_icon', 'user/img/favicon.png', NULL, NULL, 1, NULL, 0, NULL, NULL),
(4, 4, 'index_title', 'Anikagai - Webtoon Ve Anime', NULL, NULL, 1, NULL, 0, NULL, NULL),
(5, 5, 'index_text', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas illo animi dolore vitae nemo assumenda praesentium aperiam commodi, eum repellendus sint error, veritatis tempora unde maxime rerum corporis ipsum sunt.', NULL, NULL, 1, NULL, 0, NULL, NULL),
(6, 6, 'footer_copyright', 'Copyright &copy; 2023. All Rights Reserved By <a href=\"index.html\">Anikagai</a>', NULL, NULL, 1, NULL, 0, NULL, NULL),
(7, 7, 'social_media', 'facebook', NULL, NULL, 1, NULL, 0, NULL, NULL),
(8, 8, 'social_media', 'instagram', NULL, NULL, 1, NULL, 0, NULL, NULL),
(9, 9, 'social_media', 'twitter', NULL, NULL, 1, NULL, 0, NULL, NULL),
(10, 10, 'social_media', 'discord', NULL, NULL, 1, NULL, 0, NULL, NULL),
(11, 11, 'menu', 'Anasayfa', '1', '/', 1, NULL, 0, NULL, NULL),
(12, 12, 'menu', 'Animeler', '1', 'animeler', 1, NULL, 0, NULL, NULL),
(13, 13, 'menu', 'Webtoonlar', '1', 'webtoonlar', 1, NULL, 0, NULL, NULL),
(14, 14, 'menu', 'Takvim', '1', 'calendar', 1, NULL, 0, NULL, '2023-12-17 03:43:23'),
(15, 15, 'menu', 'Anime Takvimi', '0', 'animeCalendar', 1, NULL, 0, NULL, '2023-12-17 03:43:19'),
(16, 16, 'menu', 'Webtoon Takvimi', '0', 'webtoonCalendar', 1, NULL, 0, NULL, '2023-12-17 03:43:14'),
(17, 17, 'menu', 'İletişim', '1', 'contact', 1, NULL, 0, NULL, NULL),
(18, 18, 'menu_alt', 'Hakkımızda', '1', 'p/about', 1, NULL, 0, NULL, NULL),
(19, 19, 'menu_alt', 'Discord', '1', 'https://discord.com/', 1, NULL, 0, NULL, NULL),
(20, 20, 'meta', 'description', 'Webtoon okuyabilir ve Anime izleyebilirsiniz', '', 1, NULL, 0, NULL, NULL),
(21, 21, 'meta', ' ', 'tr', 'language', 1, NULL, 0, NULL, NULL),
(22, 22, 'meta', ' ', 'ie=edge', 'x-ua-compatible', 1, NULL, 0, NULL, NULL),
(23, 23, 'admin_meta', 'author', 'Bünyamin Göymen', '', 1, NULL, 0, NULL, NULL),
(24, 24, 'admin_meta', 'author2', 'bgoymen', '', 1, NULL, 0, NULL, NULL),
(25, 25, 'admin_meta', 'Copyright', 'Bu sitenin hakları Bünyamin Göymen ve Anikagai\'ye aittir', '', 1, NULL, 0, NULL, NULL),
(26, 26, 'slider_image', 'Tokyo Ghoul', 'user/img/images/gallery_01.jpg', '/', 1, NULL, 0, NULL, NULL),
(27, 27, 'slider_image', 'Attack On Titan', 'user/img/images/gallery_02.jpg', '/', 1, NULL, 0, NULL, NULL),
(28, 28, 'slider_image', 'Bleach', 'user/img/images/gallery_03.jpg', '/', 1, NULL, 0, NULL, NULL),
(29, 29, 'slider_image', 'One Piece', 'user/img/images/gallery_04.jpg', '/', 1, NULL, 0, NULL, NULL),
(30, 30, 'selected_theme', '2', NULL, NULL, 1, NULL, 0, '2023-12-17 03:39:58', '2023-12-17 03:41:12'),
(31, 31, 'slider_video', '25', 'user/animex/videos/1.mp4', NULL, 1, NULL, 0, '2023-12-17 03:39:58', NULL),
(32, 32, 'slider_video', '26', 'user/animex/videos/2.mp4', NULL, 1, NULL, 0, '2023-12-17 03:39:58', NULL),
(33, 33, 'slider_video', '27', 'user/animex/videos/3.mp4', NULL, 1, NULL, 0, '2023-12-17 03:39:58', NULL),
(34, 34, 'slider_video', '28', 'user/animex/videos/4.mp4', NULL, 1, NULL, 0, '2023-12-17 03:39:58', NULL),
(35, 35, 'anime_active', '1', NULL, NULL, 1, NULL, 0, NULL, NULL),
(36, 36, 'webtoon_active', '1', NULL, NULL, 1, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_11_14_103407_create_authorization_clauses_table', 1),
(4, '2023_11_14_103419_create_authorization_groups_table', 1),
(5, '2023_11_14_103433_create_authorization_clause_groups_table', 1),
(6, '2023_11_14_103446_create_key_values_table', 1),
(7, '2023_11_14_103616_create_webtoons_table', 1),
(8, '2023_11_14_103623_create_webtoon_episodes_table', 1),
(9, '2023_11_14_103629_create_webtoon_calendars_table', 1),
(10, '2023_11_14_103639_create_animes_table', 1),
(11, '2023_11_14_103646_create_anime_episodes_table', 1),
(12, '2023_11_14_103651_create_anime_calendars_table', 1),
(13, '2023_11_14_103725_create_notification_admins_table', 1),
(14, '2023_11_14_103734_create_notification_users_table', 1),
(15, '2023_11_14_105317_create_follow_users_table', 1),
(16, '2023_11_22_081940_create_pages_table', 1),
(17, '2023_11_22_115448_create_categories_table', 1),
(18, '2023_11_22_115454_create_tags_table', 1),
(19, '2023_11_22_120038_create_content_tags_table', 1),
(20, '2023_11_22_120049_create_content_categories_table', 1),
(21, '2023_11_24_183552_create_themes_table', 1),
(22, '2023_11_24_184045_create_theme_settings_table', 1),
(23, '2023_11_25_105317_create_follow_index_users_table', 1),
(24, '2023_11_25_105322_create_follow_webtoons_table', 1),
(25, '2023_11_25_105326_create_follow_animes_table', 1),
(26, '2023_11_25_224228_create_index_users_table', 1),
(27, '2023_11_26_024158_create_readed_webtoons_table', 1),
(28, '2023_11_26_024212_create_watched_animes_table', 1),
(29, '2023_11_26_024229_create_favorite_animes_table', 1),
(30, '2023_11_26_024241_create_favorite_webtoons_table', 1),
(31, '2023_11_26_142203_create_contacts_table', 1),
(32, '2023_11_27_142821_create_scored_contents_table', 1),
(33, '2023_11_29_085011_create_comments_table', 1),
(34, '2023_12_06_201443_create_webtoon_files_table', 1),
(35, '2023_12_14_101404_create_anime_calendar_lists_table', 1),
(36, '2023_12_15_220722_create_webtoon_calendar_lists_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notification_admins`
--

CREATE TABLE `notification_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `notification_title` varchar(255) NOT NULL,
  `notification_text` longtext NOT NULL,
  `from_user_code` bigint(20) UNSIGNED NOT NULL,
  `to_user_code` bigint(20) UNSIGNED NOT NULL,
  `notification_date` date NOT NULL DEFAULT '1970-01-01',
  `readed` tinyint(4) NOT NULL DEFAULT 0,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notification_users`
--

CREATE TABLE `notification_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `notification_title` varchar(255) NOT NULL,
  `notification_text` longtext NOT NULL,
  `from_user_code` bigint(20) UNSIGNED NOT NULL,
  `to_user_code` bigint(20) UNSIGNED NOT NULL,
  `notification_date` date NOT NULL DEFAULT '1970-01-01',
  `readed` tinyint(4) NOT NULL DEFAULT 0,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `description` longtext DEFAULT NULL,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `readed_webtoons`
--

CREATE TABLE `readed_webtoons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `webtoon_code` varchar(255) NOT NULL,
  `user_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `scored_contents`
--

CREATE TABLE `scored_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_code` bigint(20) UNSIGNED NOT NULL,
  `content_code` bigint(20) UNSIGNED NOT NULL,
  `score` double(5,2) UNSIGNED NOT NULL,
  `content_type` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `themes`
--

CREATE TABLE `themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `themeName` varchar(255) NOT NULL,
  `themePath` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `themes`
--

INSERT INTO `themes` (`id`, `code`, `themeName`, `themePath`, `description`, `images`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'mox', 'themes.mox', NULL, 'user/img/themes/theme_1.png', 0, '2023-12-16 04:43:32', NULL),
(2, 2, 'Animex', 'themes.animex', NULL, 'user/img/themes/theme_2.png', 0, '2023-12-16 04:43:32', NULL),
(3, 3, 'MovieFX', 'themes.moviefx', NULL, 'user/img/themes/theme_3.png', 0, '2023-12-16 04:43:32', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `theme_code` bigint(20) UNSIGNED NOT NULL,
  `setting_name` varchar(255) DEFAULT NULL,
  `setting_value` varchar(255) DEFAULT NULL,
  `optional` longtext DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `code`, `theme_code`, `setting_name`, `setting_value`, `optional`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'listCount', '8', NULL, 0, '2023-12-16 04:43:32', NULL),
(2, 2, 1, 'showSlider', '1', NULL, 0, '2023-12-16 04:43:32', NULL),
(3, 3, 1, 'indexShowContent', '20', NULL, 0, '2023-12-16 04:43:32', NULL),
(4, 4, 1, 'colors_code', 'e4d804', NULL, 0, '2023-12-16 04:43:32', NULL),
(5, 5, 1, 'colors_code', '252631', NULL, 0, '2023-12-16 04:43:32', NULL),
(6, 6, 1, 'colors_code', '20212B', NULL, 0, '2023-12-16 04:43:32', NULL),
(7, 7, 1, 'colors_code', '171B27', NULL, 0, '2023-12-16 04:43:32', NULL),
(8, 8, 1, 'colors_code', '12151E', NULL, 0, '2023-12-16 04:43:32', NULL),
(9, 9, 1, 'colors_code_default', 'e4d804', NULL, 0, '2023-12-16 04:43:32', NULL),
(10, 10, 1, 'colors_code_default', '252631', NULL, 0, '2023-12-16 04:43:32', NULL),
(11, 11, 1, 'colors_code_default', '20212B', NULL, 0, '2023-12-16 04:43:32', NULL),
(12, 12, 1, 'colors_code_default', '171B27', NULL, 0, '2023-12-16 04:43:32', NULL),
(13, 13, 1, 'colors_code_default', '12151E', NULL, 0, '2023-12-16 04:43:32', NULL),
(14, 14, 2, 'listCount', '12', NULL, 0, '2023-12-16 04:43:32', NULL),
(15, 15, 2, 'showSlider', '1', NULL, 0, '2023-12-16 04:43:32', NULL),
(16, 16, 2, 'indexShowContent', '6', NULL, 0, '2023-12-16 04:43:32', NULL),
(17, 17, 2, 'colors_code', '14161D', NULL, 0, '2023-12-16 04:43:32', '2023-12-17 03:57:47'),
(18, 18, 2, 'colors_code', '111216', NULL, 0, '2023-12-16 04:43:32', '2023-12-17 03:57:47'),
(19, 19, 2, 'colors_code', 'e53639', NULL, 0, '2023-12-16 04:43:32', '2023-12-17 03:58:11'),
(20, 20, 2, 'colors_code_default', '14161D', NULL, 0, '2023-12-16 04:43:32', NULL),
(21, 21, 2, 'colors_code_default', '111216', NULL, 0, '2023-12-16 04:43:32', NULL),
(22, 22, 2, 'colors_code_default', 'e53639', NULL, 0, '2023-12-16 04:43:32', NULL),
(23, 23, 3, 'listCount', '10', NULL, 0, '2023-12-16 04:43:32', NULL),
(24, 24, 3, 'showSlider', '1', NULL, 0, '2023-12-16 04:43:32', NULL),
(25, 25, 3, 'indexShowContent', '8', NULL, 0, '2023-12-16 04:43:32', NULL),
(26, 26, 3, 'colors_code', 'FDFD96', NULL, 0, '2023-12-16 04:43:32', NULL),
(27, 27, 3, 'colors_code', '14161D', NULL, 0, '2023-12-16 04:43:32', NULL),
(28, 28, 3, 'colors_code', '111216', NULL, 0, '2023-12-16 04:43:32', NULL),
(29, 29, 3, 'colors_code', 'FDFD96', NULL, 0, '2023-12-16 04:43:32', NULL),
(30, 30, 3, 'colors_code', '1E2029', NULL, 0, '2023-12-16 04:43:32', NULL),
(31, 31, 3, 'colors_code', '491f1f', NULL, 0, '2023-12-16 04:43:32', NULL),
(32, 32, 3, 'colors_code_default', 'FDFD96', NULL, 0, '2023-12-16 04:43:32', NULL),
(33, 33, 3, 'colors_code_default', '14161D', NULL, 0, '2023-12-16 04:43:32', NULL),
(34, 34, 3, 'colors_code_default', '111216', NULL, 0, '2023-12-16 04:43:32', NULL),
(35, 35, 3, 'colors_code_default', 'FDFD96', NULL, 0, '2023-12-16 04:43:32', NULL),
(36, 36, 3, 'colors_code_default', '1E2029', NULL, 0, '2023-12-16 04:43:32', NULL),
(37, 37, 3, 'colors_code_default', '491f1f', NULL, 0, '2023-12-16 04:43:32', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `discord` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 2,
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `code`, `name`, `surname`, `email`, `password`, `image`, `description`, `facebook`, `instagram`, `twitter`, `discord`, `user_type`, `admin`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 0, 'Bünyamin', 'Göymen', 'bunyamingoymen@gmail.com', '$2y$10$UJA5mhL4Ehu.EZ.aGluEZ.WO5qmbWlpP049moGxgrH7r4KUs6Z4ti', 'admin/assets/images/users/avatar-1.jpg', 'Sitenin kurucusu', NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, NULL, NULL),
(2, 1, 'Anikagai', 'Admin', 'anikagai@gmail.com', '$2y$10$RP4VA4R1PWqt8mG6nPE78ObAykBi7OFxqCMQwM9lfVfsl4cdvPaNG', 'admin/assets/images/users/avatar-1.jpg', 'Site Sahibi', NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `watched_animes`
--

CREATE TABLE `watched_animes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anime_code` varchar(255) NOT NULL,
  `anime_episode_code` varchar(255) NOT NULL,
  `content_type` varchar(255) NOT NULL,
  `user_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `webtoons`
--

CREATE TABLE `webtoons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `episode_count` int(11) NOT NULL DEFAULT 0,
  `season_count` int(11) NOT NULL DEFAULT 0,
  `average_min` int(11) NOT NULL DEFAULT 0,
  `main_category` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `main_category_name` varchar(255) NOT NULL DEFAULT 'Genel',
  `date` varchar(255) NOT NULL DEFAULT '2000',
  `click_count` int(11) NOT NULL DEFAULT 0,
  `comment_count` int(11) NOT NULL DEFAULT 0,
  `scoreUsers` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `score` double(5,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `showStatus` tinyint(4) NOT NULL DEFAULT 0,
  `plusEighteen` tinyint(4) NOT NULL DEFAULT 1,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `webtoons`
--

INSERT INTO `webtoons` (`id`, `code`, `name`, `short_name`, `image`, `description`, `episode_count`, `season_count`, `average_min`, `main_category`, `main_category_name`, `date`, `click_count`, `comment_count`, `scoreUsers`, `score`, `showStatus`, `plusEighteen`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Who is president', 'who-is-president', 'files/webtoons/webtoonImages/1.jpg', 'dfsgdfsgfdg', 0, 0, 45, 1, 'Genel', '2012', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:28:38', '2023-12-08 13:28:38'),
(2, 2, 'Tower Of God', 'tower-of-god', 'files/webtoons/webtoonImages/2.jpg', 'dfsfdsfsdf', 0, 0, 32, 1, 'Genel', '2015', 0, 0, 0, 0.00, 2, 0, 0, NULL, 0, '2023-12-08 13:28:58', '2023-12-08 13:28:58'),
(3, 3, 'Unordinary', 'unordinary', 'files/webtoons/webtoonImages/3.jpg', 'fsadfdsfdsfdsf', 0, 0, 56, 1, 'Genel', '2015', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:29:16', '2023-12-08 13:29:16'),
(4, 4, 'Ben Regresör Değilim', 'Ben-Regresor-Degilim', 'files/webtoons/webtoonImages/4.jpg', 'fsdafdsfdsfsdfdsf', 0, 0, 56, 1, 'Genel', '2018', 0, 0, 0, 0.00, 1, 1, 0, 0, 0, '2023-12-08 13:29:34', '2023-12-08 13:31:54'),
(5, 5, 'Killer Pedro', 'killer-pedro', 'files/webtoons/webtoonImages/5.jpg', 'fsdafdasfdasffd', 0, 0, 45, 1, 'Genel', '2016', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:29:56', '2023-12-08 13:29:56'),
(6, 6, 'Suikastçının İnancı - Unutulmuş Tapınak', 'suikastcının-inancı---unutulmus-tapınak', 'files/webtoons/webtoonImages/6.jpg', 'gfgfdgfdsggffd', 0, 0, 89, 1, 'Genel', '2015', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:30:18', '2023-12-08 13:30:18'),
(7, 7, 'To My First Love', 'to-my-first-love', 'files/webtoons/webtoonImages/7.jpg', 'dsafdsfadsfadsf', 0, 0, 56, 1, 'Genel', '2019', 0, 0, 0, 0.00, 2, 0, 0, NULL, 0, '2023-12-08 13:30:43', '2023-12-08 13:30:43'),
(8, 8, 'The Redemption of Earl Nottingham', 'the-redemption-of-earl-nottingham', 'files/webtoons/webtoonImages/8.jpg', 'fdsaffdsfa', 0, 0, 52, 1, 'Genel', '2020', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:32:14', '2023-12-08 13:32:14'),
(9, 9, 'Şarlot Ve 5 Havarisi', 'sarlot-ve-5-havarisi', 'files/webtoons/webtoonImages/9.jpg', 'dfdasfdasfadsfas', 0, 0, 12, 1, 'Genel', '2010', 1, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 13:32:36', '2023-12-10 06:02:13'),
(10, 10, 'Betrayal of Deignity', 'betrayal-of-deignity', 'files/webtoons/webtoonImages/10.jpg', 'dgrsfgfdsgfdsg', 0, 0, 32, 1, 'Genel', '2015', 0, 0, 0, 0.00, 0, 1, 0, NULL, 0, '2023-12-08 13:33:03', '2023-12-08 13:33:03');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `webtoon_calendars`
--

CREATE TABLE `webtoon_calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `webtoon_code` bigint(20) UNSIGNED NOT NULL,
  `description` longtext DEFAULT NULL,
  `first_date` date NOT NULL DEFAULT '1970-01-01',
  `cycle_type` int(11) NOT NULL DEFAULT 0,
  `special_type` int(11) DEFAULT NULL,
  `special_count` int(11) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `background_color` varchar(255) NOT NULL DEFAULT '#007BFF',
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `webtoon_calendars`
--

INSERT INTO `webtoon_calendars` (`id`, `code`, `webtoon_code`, `description`, `first_date`, `cycle_type`, `special_type`, `special_count`, `end_date`, `background_color`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'bnmööşi,şlkjbmnökçl.şişlkjhgcfgvhjkş.', '2023-12-01', 2, 1, NULL, '2024-04-01', '#FFC107', 0, NULL, 0, '2023-12-16 05:05:47', '2023-12-16 05:05:47'),
(2, 2, 1, NULL, '2023-12-13', 2, 1, NULL, '2024-05-01', '#000', 0, NULL, 0, '2023-12-16 05:08:13', '2023-12-16 05:08:13'),
(3, 3, 1, NULL, '2023-12-13', 2, 1, NULL, '2024-05-01', '#000', 0, NULL, 0, '2023-12-16 05:09:05', '2023-12-16 05:09:05'),
(4, 4, 1, 'fbdsgfdgfdgdfg', '2023-12-01', 2, 1, NULL, '2024-06-01', '#28a745', 0, NULL, 0, '2023-12-16 05:09:27', '2023-12-16 05:09:27'),
(5, 5, 1, 'vc cxxcvxcv', '2023-12-01', 2, 1, NULL, '2024-04-01', '#28a745', 0, NULL, 0, '2023-12-16 05:10:47', '2023-12-16 05:10:47'),
(6, 6, 1, 'fgdgdfgfdgfdg', '2023-12-01', 1, 1, NULL, '2024-04-01', '#FF0500', 0, 0, 0, '2023-12-16 05:21:55', '2023-12-16 05:24:43'),
(7, 7, 1, 'bnmö', '2023-12-01', 3, 1, NULL, '2024-04-01', '#FFC107', 0, 0, 1, '2023-12-16 05:29:27', '2023-12-16 05:33:48'),
(8, 8, 1, 'Yeni Bölümler', '2023-12-01', 5, 2, 2, '2024-04-01', '#007BFF', 0, NULL, 0, '2023-12-17 03:36:51', '2023-12-17 03:36:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `webtoon_calendar_lists`
--

CREATE TABLE `webtoon_calendar_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `webtoon_calendar_code` bigint(20) UNSIGNED NOT NULL,
  `calendar_order` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `webtoon_calendar_lists`
--

INSERT INTO `webtoon_calendar_lists` (`id`, `code`, `webtoon_calendar_code`, `calendar_order`, `date`, `created_at`, `updated_at`) VALUES
(159, 1, 7, 1, '2023-12-01', '2023-12-16 05:32:40', '2023-12-16 05:32:40'),
(160, 2, 7, 2, '2024-01-01', '2023-12-16 05:32:40', '2023-12-16 05:32:40'),
(161, 3, 7, 3, '2024-02-01', '2023-12-16 05:32:40', '2023-12-16 05:32:40'),
(162, 4, 7, 4, '2024-03-01', '2023-12-16 05:32:40', '2023-12-16 05:32:40'),
(163, 5, 8, 1, '2023-12-01', '2023-12-17 03:36:51', '2023-12-17 03:36:51'),
(164, 6, 8, 2, '2023-12-15', '2023-12-17 03:36:51', '2023-12-17 03:36:51'),
(165, 7, 8, 3, '2023-12-29', '2023-12-17 03:36:51', '2023-12-17 03:36:51'),
(166, 8, 8, 4, '2024-01-12', '2023-12-17 03:36:51', '2023-12-17 03:36:51'),
(167, 9, 8, 5, '2024-01-26', '2023-12-17 03:36:51', '2023-12-17 03:36:51'),
(168, 10, 8, 6, '2024-02-09', '2023-12-17 03:36:51', '2023-12-17 03:36:51'),
(169, 11, 8, 7, '2024-02-23', '2023-12-17 03:36:51', '2023-12-17 03:36:51'),
(170, 12, 8, 8, '2024-03-08', '2023-12-17 03:36:51', '2023-12-17 03:36:51'),
(171, 13, 8, 9, '2024-03-22', '2023-12-17 03:36:51', '2023-12-17 03:36:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `webtoon_episodes`
--

CREATE TABLE `webtoon_episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `webtoon_code` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `season_short` int(11) NOT NULL DEFAULT 0,
  `episode_short` int(11) NOT NULL DEFAULT 0,
  `click_count` int(11) NOT NULL DEFAULT 0,
  `minute` int(11) NOT NULL DEFAULT 0,
  `publish_date` date NOT NULL DEFAULT '1970-01-01',
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `webtoon_files`
--

CREATE TABLE `webtoon_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) UNSIGNED NOT NULL,
  `webtoon_episode_code` bigint(20) UNSIGNED NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_order` bigint(20) UNSIGNED NOT NULL,
  `create_user_code` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `update_user_code` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `anime_calendars`
--
ALTER TABLE `anime_calendars`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `anime_calendar_lists`
--
ALTER TABLE `anime_calendar_lists`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `anime_episodes`
--
ALTER TABLE `anime_episodes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `authorization_clauses`
--
ALTER TABLE `authorization_clauses`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `authorization_clause_groups`
--
ALTER TABLE `authorization_clause_groups`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `authorization_groups`
--
ALTER TABLE `authorization_groups`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `content_categories`
--
ALTER TABLE `content_categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `content_tags`
--
ALTER TABLE `content_tags`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `favorite_animes`
--
ALTER TABLE `favorite_animes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `favorite_webtoons`
--
ALTER TABLE `favorite_webtoons`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `follow_animes`
--
ALTER TABLE `follow_animes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `follow_index_users`
--
ALTER TABLE `follow_index_users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `follow_users`
--
ALTER TABLE `follow_users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `follow_webtoons`
--
ALTER TABLE `follow_webtoons`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `index_users`
--
ALTER TABLE `index_users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `key_values`
--
ALTER TABLE `key_values`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `notification_admins`
--
ALTER TABLE `notification_admins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `notification_users`
--
ALTER TABLE `notification_users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `readed_webtoons`
--
ALTER TABLE `readed_webtoons`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `scored_contents`
--
ALTER TABLE `scored_contents`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Tablo için indeksler `watched_animes`
--
ALTER TABLE `watched_animes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `webtoons`
--
ALTER TABLE `webtoons`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `webtoon_calendars`
--
ALTER TABLE `webtoon_calendars`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `webtoon_calendar_lists`
--
ALTER TABLE `webtoon_calendar_lists`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `webtoon_episodes`
--
ALTER TABLE `webtoon_episodes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `webtoon_files`
--
ALTER TABLE `webtoon_files`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `animes`
--
ALTER TABLE `animes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `anime_calendars`
--
ALTER TABLE `anime_calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `anime_calendar_lists`
--
ALTER TABLE `anime_calendar_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Tablo için AUTO_INCREMENT değeri `anime_episodes`
--
ALTER TABLE `anime_episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `authorization_clauses`
--
ALTER TABLE `authorization_clauses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Tablo için AUTO_INCREMENT değeri `authorization_clause_groups`
--
ALTER TABLE `authorization_clause_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `authorization_groups`
--
ALTER TABLE `authorization_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `content_categories`
--
ALTER TABLE `content_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `content_tags`
--
ALTER TABLE `content_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `favorite_animes`
--
ALTER TABLE `favorite_animes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `favorite_webtoons`
--
ALTER TABLE `favorite_webtoons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `follow_animes`
--
ALTER TABLE `follow_animes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `follow_index_users`
--
ALTER TABLE `follow_index_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `follow_users`
--
ALTER TABLE `follow_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `follow_webtoons`
--
ALTER TABLE `follow_webtoons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `index_users`
--
ALTER TABLE `index_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `key_values`
--
ALTER TABLE `key_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `notification_admins`
--
ALTER TABLE `notification_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `notification_users`
--
ALTER TABLE `notification_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `readed_webtoons`
--
ALTER TABLE `readed_webtoons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `scored_contents`
--
ALTER TABLE `scored_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `watched_animes`
--
ALTER TABLE `watched_animes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `webtoons`
--
ALTER TABLE `webtoons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `webtoon_calendars`
--
ALTER TABLE `webtoon_calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `webtoon_calendar_lists`
--
ALTER TABLE `webtoon_calendar_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- Tablo için AUTO_INCREMENT değeri `webtoon_episodes`
--
ALTER TABLE `webtoon_episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `webtoon_files`
--
ALTER TABLE `webtoon_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
