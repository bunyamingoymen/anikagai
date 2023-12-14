-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 10 Ara 2023, 15:34:55
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
-- Tablo döküm verisi `animes`
--

INSERT INTO `animes` (`id`, `code`, `name`, `short_name`, `image`, `description`, `episode_count`, `season_count`, `average_min`, `date`, `main_category`, `main_category_name`, `click_count`, `comment_count`, `scoreUsers`, `score`, `showStatus`, `plusEighteen`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tokyo Ghoul', 'tokyo-ghoul', 'files/animes/animesImages/1.jpg', 'gdsgdfhtrhtrhtrh', 0, 0, 35, '2014', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 15:51:20', '2023-12-08 15:51:20'),
(2, 2, 'Attack On Titan', 'attack-on-titan', 'files/animes/animesImages/2.jpg', 'ğkorfldög.rrg', 0, 0, 45, '2015', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 15:57:12', '2023-12-08 15:57:12'),
(3, 3, 'One Piece', 'one-piece', 'files/animes/animesImages/3.jpg', 'efsdolöişrfDSÇisdfdfgfd', 0, 0, 45, '2015', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 15:57:36', '2023-12-08 15:57:36'),
(4, 4, 'Naruto', 'naruto', 'files/animes/animesImages/4.jpg', 'rfvsfgdsfvsdfvdfvsfv', 0, 0, 15, '2010', 1, 'Genel', 0, 0, 0, 0.00, 2, 0, 0, 0, 0, '2023-12-08 15:57:58', '2023-12-08 16:00:58'),
(5, 5, 'Fullmetal Alchemist: Brotherhood', 'fullmetal-alchemist:-brotherhood', 'files/animes/animesImages/5.jpg', 'dfsvsdgdsagsdg', 0, 0, 45, '2014', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:15:37', '2023-12-08 16:15:37'),
(6, 6, 'Avatar The Last Airbender', 'avatar-the-last-airbender', 'files/animes/animesImages/6.jpg', 'gfdsgsfgdsfgfdsg', 0, 0, 35, '2013', 1, 'Genel', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:16:28', '2023-12-08 16:16:28'),
(7, 7, 'Sousou No Frieren', 'sousou-no-frieren', 'files/animes/animesImages/7.jpg', 'dsffsdfdsfdsf', 0, 0, 63, '2012', 1, 'Genel', 0, 0, 0, 0.00, 0, 1, 0, NULL, 0, '2023-12-08 16:17:04', '2023-12-08 16:17:04'),
(8, 8, 'Oshi No Ko', 'oshi-no-ko', 'files/animes/animesImages/8.jpg', 'regdrsbresgreag', 0, 0, 40, '1999', 1, 'Genel', 0, 0, 0, 0.00, 2, 0, 0, NULL, 0, '2023-12-08 16:17:44', '2023-12-08 16:17:44'),
(9, 9, 'Steins Gate', 'steins-gate', 'files/animes/animesImages/9.jpg', 'hsdfgdgesgesgdr', 0, 0, 52, '2018', 1, 'Genel', 0, 0, 0, 0.00, 3, 0, 0, NULL, 0, '2023-12-08 16:18:18', '2023-12-08 16:18:18'),
(10, 10, 'Monster', 'monster', 'files/animes/animesImages/10.jpg', 'fsdafdsafdsafadaf', 3, 2, 15, '2019', 1, 'Genel', 2, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:18:43', '2023-12-10 08:20:08');

-- --------------------------------------------------------

--
-- Tablo döküm verisi `anime_episodes`
--

INSERT INTO `anime_episodes` (`id`, `code`, `name`, `anime_code`, `image`, `video`, `description`, `season_short`, `episode_short`, `click_count`, `minute`, `intro_start_time_min`, `intro_start_time_sec`, `intro_end_time_min`, `intro_end_time_sec`, `publish_date`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pilot', 10, NULL, 'files/animes/animesEpisodes/10/1/1/1.mp4', 'fdsdgdsfgfdsgdfsg', 1, 1, 0, 0, 0, 5, 0, 12, '2023-12-04', 0, NULL, 0, '2023-12-10 08:19:15', '2023-12-10 08:19:15'),
(2, 2, 'Pilot 2', 10, NULL, 'files/animes/animesEpisodes/10/1/2/2.mp4', 'fdsdgdsfgfdsgdfsg', 1, 2, 0, 0, 0, 5, 0, 12, '2023-12-04', 0, NULL, 0, '2023-12-10 08:19:35', '2023-12-10 08:19:35'),
(3, 3, 'Pliot 3', 10, NULL, 'files/animes/animesEpisodes/10/2/1/3.mp4', 'hhncgjfghjfjdgf', 2, 1, 0, 0, 0, 5, 0, 12, '2023-12-04', 0, NULL, 0, '2023-12-10 08:20:08', '2023-12-10 08:20:08');

-- --------------------------------------------------------

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
(9, 9, 'Grup Yetkileri Ekleme', 'Grup Yetkileri Ekleme Yetkisi', 1, NULL, 0, NULL, NULL),
(10, 10, 'Grup Yetkileri Listeleme', 'Grup Yetkileri Ekleme Yetkisi', 1, NULL, 0, NULL, NULL),
(11, 11, 'Grup Yetkileri Güncelleme', 'Grup Yetkileri Güncelleyebilme Yetkisi', 1, NULL, 0, NULL, NULL),
(12, 12, 'Grup Yetkileri Silme', 'Grup Yetkileri Silebilme Yetkisi', 1, NULL, 0, NULL, NULL),
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
(29, 29, 'Anime Takvimi Güncelleyebilme', 'Anime Takvimi Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(30, 30, 'Anime Takvimi Silebilme', 'Anime Takvimi Silebilme', 1, NULL, 0, NULL, NULL),
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
(41, 41, 'Webtoon Takvimi Güncelleyebilme', 'Webtoon Takvimi Güncelleyebilme', 1, NULL, 0, NULL, NULL),
(42, 42, 'Webtoon Takvimi Silebilme', 'Webtoon Takvimi Silebilme', 1, NULL, 0, NULL, NULL),
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
(64, 64, 'Slider videolarını listeleyip güncelleyebilme', 'Slider videolarını listeleyip güncelleyebilme', 1, NULL, 0, NULL, NULL);

-- --------------------------------------------------------


--
-- Tablo döküm verisi `authorization_groups`
--

INSERT INTO `authorization_groups` (`id`, `code`, `text`, `description`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'Site Yöneticisi', 1, NULL, 0, '2023-12-08 05:58:14', '2023-12-08 05:58:14');

-- --------------------------------------------------------

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `short_name`, `description`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Genel', 'genel', 'Varsayılan', 1, NULL, 0, '2023-12-08 05:58:14', '2023-12-08 05:58:14'),
(2, 2, 'Fantastik', 'fantastik', 'dfsdsfdsf', 0, NULL, 0, '2023-12-08 16:38:26', '2023-12-08 16:38:26'),
(3, 3, 'Dram', 'dram', NULL, 0, NULL, 0, '2023-12-08 16:38:32', '2023-12-08 16:38:32'),
(4, 4, 'Romantik', 'romantik', NULL, 0, NULL, 0, '2023-12-08 16:38:40', '2023-12-08 16:38:40'),
(5, 5, 'Aksiyon', 'aksiyon', NULL, 0, NULL, 0, '2023-12-08 16:38:55', '2023-12-08 16:38:55'),
(6, 6, 'Askeri', 'askeri', NULL, 0, NULL, 0, '2023-12-08 16:39:01', '2023-12-08 16:39:01'),
(7, 7, 'Doğaüstü', 'dogaustu', NULL, 0, NULL, 0, '2023-12-08 16:39:13', '2023-12-08 16:39:13'),
(8, 8, 'Komedi', 'komedi', NULL, 0, NULL, 0, '2023-12-08 16:39:27', '2023-12-08 16:39:27'),
(9, 9, 'Korku', 'korku', NULL, 0, NULL, 0, '2023-12-08 16:39:35', '2023-12-08 16:39:35'),
(10, 10, 'Polisiye', 'polisiye', NULL, 0, NULL, 0, '2023-12-08 16:39:45', '2023-12-08 16:39:45'),
(11, 11, 'Psikolojik', 'psikolojik', NULL, 0, NULL, 0, '2023-12-08 16:39:52', '2023-12-08 16:39:52'),
(12, 12, 'Tarihi', 'tarihi', NULL, 0, NULL, 0, '2023-12-08 16:40:10', '2023-12-08 16:40:10'),
(13, 13, 'Macera', 'macera', NULL, 0, NULL, 0, '2023-12-08 16:40:16', '2023-12-08 16:40:16');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------


--
-- Tablo döküm verisi `content_categories`
--

INSERT INTO `content_categories` (`id`, `category_code`, `content_code`, `content_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2023-12-08 15:51:20', '2023-12-08 15:51:20'),
(2, 1, 2, 1, '2023-12-08 15:57:12', '2023-12-08 15:57:12'),
(3, 1, 3, 1, '2023-12-08 15:57:36', '2023-12-08 15:57:36'),
(5, 1, 4, 1, '2023-12-08 16:00:58', '2023-12-08 16:00:58');

-- --------------------------------------------------------


-- --------------------------------------------------------


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tablo döküm verisi `follow_animes`
--

INSERT INTO `follow_animes` (`id`, `anime_code`, `user_code`, `created_at`, `updated_at`) VALUES
(3, 10, 1, '2023-12-09 19:57:32', '2023-12-09 19:57:32');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tablo döküm verisi `index_users`
--

INSERT INTO `index_users` (`id`, `code`, `name`, `username`, `email`, `password`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bünyamin', 'bgoymen', 'bgoymen_fb@hotmail.com', '$2y$10$cR09/eNHLVf4Mhf9Jt.b8O/Khwq8rmRk0DXiEe/e6bx0r8P.j21TS', NULL, NULL, '2023-12-09 19:34:37', '2023-12-09 19:34:37');

-- --------------------------------------------------------
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
(14, 14, 'menu', 'İletişim', '1', 'contact', 1, NULL, 0, NULL, NULL),
(15, 15, 'menu_alt', 'Hakkımızda', '1', 'p/about', 1, NULL, 0, NULL, NULL),
(16, 16, 'menu_alt', 'Discord', '1', 'https://discord.com/', 1, NULL, 0, NULL, NULL),
(17, 17, 'meta', 'description', 'Webtoon okuyabilir ve Anime izleyebilirsiniz', '', 1, NULL, 0, NULL, NULL),
(18, 18, 'meta', ' ', 'tr', 'language', 1, NULL, 0, NULL, NULL),
(19, 19, 'meta', ' ', 'ie=edge', 'x-ua-compatible', 1, NULL, 0, NULL, NULL),
(20, 20, 'admin_meta', 'author', 'Bünyamin Göymen', '', 1, NULL, 0, NULL, NULL),
(21, 21, 'admin_meta', 'author2', 'bgoymen', '', 1, NULL, 0, NULL, NULL),
(22, 22, 'admin_meta', 'Copyright', 'Bu sitenin hakları Bünyamin Göymen ve Anikagai\'ye aittir', '', 1, NULL, 0, NULL, NULL),
(23, 23, 'anime_active', '1', NULL, NULL, 1, NULL, 0, NULL, NULL),
(24, 24, 'webtoon_active', '1', NULL, NULL, 1, NULL, 0, NULL, NULL),
(25, 25, 'slider_image', 'Tokyo Ghoul', 'user/img/images/gallery_01.jpg', '/', 1, NULL, 0, NULL, NULL),
(26, 26, 'slider_image', 'Attack On Titan', 'user/img/images/gallery_02.jpg', '/', 1, NULL, 0, NULL, NULL),
(27, 27, 'slider_image', 'Bleach', 'user/img/images/gallery_03.jpg', '/', 1, NULL, 0, NULL, NULL),
(28, 28, 'slider_image', 'One Piece', 'user/img/images/gallery_04.jpg', '/', 1, NULL, 0, NULL, NULL),
(29, 29, 'selected_theme', '3', NULL, NULL, 1, NULL, 0, '2023-12-08 05:58:14', '2023-12-08 05:58:24'),
(30, 30, 'slider_video', '25', 'user/animex/videos/1.mp4', NULL, 1, NULL, 0, '2023-12-08 05:58:14', NULL),
(31, 31, 'slider_video', '26', 'user/animex/videos/2.mp4', NULL, 1, NULL, 0, '2023-12-08 05:58:14', NULL),
(32, 32, 'slider_video', '27', 'user/animex/videos/3.mp4', NULL, 1, NULL, 0, '2023-12-08 05:58:14', NULL),
(33, 33, 'slider_video', '28', 'user/animex/videos/4.mp4', NULL, 1, NULL, 0, '2023-12-08 05:58:14', NULL);

-- --------------------------------------------------------

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
(34, '2023_12_06_201443_create_webtoon_files_table', 1);

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tablo döküm verisi `themes`
--

INSERT INTO `themes` (`id`, `code`, `themeName`, `themePath`, `description`, `images`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'mox', 'themes.mox', NULL, 'user/img/themes/theme_1.png', 0, '2023-12-08 05:58:14', NULL),
(2, 2, 'Animex', 'themes.animex', NULL, 'user/img/themes/theme_2.png', 0, '2023-12-08 05:58:14', NULL),
(3, 3, 'MovieFX', 'themes.moviefx', NULL, 'user/img/themes/theme_3.png', 0, '2023-12-08 05:58:14', NULL);

-- --------------------------------------------------------

--
-- Tablo döküm verisi `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `code`, `theme_code`, `setting_name`, `setting_value`, `optional`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'listCount', '8', NULL, 0, '2023-12-08 05:58:14', NULL),
(2, 2, 1, 'showSlider', '1', NULL, 0, '2023-12-08 05:58:14', NULL),
(3, 3, 1, 'indexShowContent', '20', NULL, 0, '2023-12-08 05:58:14', NULL),
(4, 4, 2, 'listCount', '12', NULL, 0, '2023-12-08 05:58:14', NULL),
(5, 5, 2, 'showSlider', '1', NULL, 0, '2023-12-08 05:58:14', NULL),
(6, 6, 2, 'indexShowContent', '6', NULL, 0, '2023-12-08 05:58:14', NULL),
(7, 7, 3, 'listCount', '10', NULL, 0, '2023-12-08 05:58:14', NULL),
(8, 8, 3, 'showSlider', '1', NULL, 0, '2023-12-08 05:58:14', NULL),
(9, 9, 3, 'indexShowContent', '8', NULL, 0, '2023-12-08 05:58:14', NULL);

-- --------------------------------------------------------

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `code`, `name`, `surname`, `email`, `password`, `image`, `description`, `facebook`, `instagram`, `twitter`, `discord`, `user_type`, `admin`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 0, 'Bünyamin', 'Göymen', 'bunyamingoymen@gmail.com', '$2y$10$AkY6St.CFTzmA1EMjV54.eSySMbpmhDf3gfbq6SpogZL.WZU4Q8ua', 'admin/assets/images/users/avatar-1.jpg', 'Sitenin kurucusu', NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, NULL, '2023-12-08 15:50:38'),
(2, 1, 'Anikagai', 'Admin', 'anikagai@gmail.com', '$2y$10$DvKcO5ITU.FQjM4URZ8qXOr4UHqNWKJ8Rmy1UJIn09UdXWp.zQblC', 'admin/assets/images/users/avatar-1.jpg', 'Site Sahibi', NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tablo döküm verisi `webtoons`
--

INSERT INTO `webtoons` (`id`, `code`, `name`, `short_name`, `image`, `description`, `episode_count`, `season_count`, `average_min`, `main_category`, `main_category_name`, `date`, `click_count`, `comment_count`, `scoreUsers`, `score`, `showStatus`, `plusEighteen`, `create_user_code`, `update_user_code`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Who is president', 'who-is-president', 'files/webtoons/webtoonImages/1.jpg', 'dfsgdfsgfdg', 0, 0, 45, 1, 'Genel', '2012', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:28:38', '2023-12-08 16:28:38'),
(2, 2, 'Tower Of God', 'tower-of-god', 'files/webtoons/webtoonImages/2.jpg', 'dfsfdsfsdf', 0, 0, 32, 1, 'Genel', '2015', 0, 0, 0, 0.00, 2, 0, 0, NULL, 0, '2023-12-08 16:28:58', '2023-12-08 16:28:58'),
(3, 3, 'Unordinary', 'unordinary', 'files/webtoons/webtoonImages/3.jpg', 'fsadfdsfdsfdsf', 0, 0, 56, 1, 'Genel', '2015', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:29:16', '2023-12-08 16:29:16'),
(4, 4, 'Ben Regresör Değilim', 'Ben-Regresor-Degilim', 'files/webtoons/webtoonImages/4.jpg', 'fsdafdsfdsfsdfdsf', 0, 0, 56, 1, 'Genel', '2018', 0, 0, 0, 0.00, 1, 1, 0, 0, 0, '2023-12-08 16:29:34', '2023-12-08 16:31:54'),
(5, 5, 'Killer Pedro', 'killer-pedro', 'files/webtoons/webtoonImages/5.jpg', 'fsdafdasfdasffd', 0, 0, 45, 1, 'Genel', '2016', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:29:56', '2023-12-08 16:29:56'),
(6, 6, 'Suikastçının İnancı - Unutulmuş Tapınak', 'suikastcının-inancı---unutulmus-tapınak', 'files/webtoons/webtoonImages/6.jpg', 'gfgfdgfdsggffd', 0, 0, 89, 1, 'Genel', '2015', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:30:18', '2023-12-08 16:30:18'),
(7, 7, 'To My First Love', 'to-my-first-love', 'files/webtoons/webtoonImages/7.jpg', 'dsafdsfadsfadsf', 0, 0, 56, 1, 'Genel', '2019', 0, 0, 0, 0.00, 2, 0, 0, NULL, 0, '2023-12-08 16:30:43', '2023-12-08 16:30:43'),
(8, 8, 'The Redemption of Earl Nottingham', 'the-redemption-of-earl-nottingham', 'files/webtoons/webtoonImages/8.jpg', 'fdsaffdsfa', 0, 0, 52, 1, 'Genel', '2020', 0, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:32:14', '2023-12-08 16:32:14'),
(9, 9, 'Şarlot Ve 5 Havarisi', 'sarlot-ve-5-havarisi', 'files/webtoons/webtoonImages/9.jpg', 'dfdasfdasfadsfas', 0, 0, 12, 1, 'Genel', '2010', 1, 0, 0, 0.00, 0, 0, 0, NULL, 0, '2023-12-08 16:32:36', '2023-12-10 09:02:13'),
(10, 10, 'Betrayal of Deignity', 'betrayal-of-deignity', 'files/webtoons/webtoonImages/10.jpg', 'dgrsfgfdsgfdsg', 0, 0, 32, 1, 'Genel', '2015', 0, 0, 0, 0.00, 0, 1, 0, NULL, 0, '2023-12-08 16:33:03', '2023-12-08 16:33:03');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------


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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `anime_episodes`
--
ALTER TABLE `anime_episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `authorization_clauses`
--
ALTER TABLE `authorization_clauses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `content_tags`
--
ALTER TABLE `content_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `favorite_animes`
--
ALTER TABLE `favorite_animes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `favorite_webtoons`
--
ALTER TABLE `favorite_webtoons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `follow_animes`
--
ALTER TABLE `follow_animes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `key_values`
--
ALTER TABLE `key_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
