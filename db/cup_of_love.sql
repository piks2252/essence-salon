-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2019 at 10:29 AM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cup_of_love`
--

-- --------------------------------------------------------

--
-- Table structure for table `affirmation_images`
--

CREATE TABLE `affirmation_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affirmation_images`
--

INSERT INTO `affirmation_images` (`id`, `image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'https://thedatingdoc.com/wp-content/uploads/2018/01/1-2.jpg', NULL, '2019-03-28 08:07:11', '2019-03-28 08:07:11'),
(2, 'Img-20190328132709.jpg', NULL, '2019-04-04 06:23:18', NULL),
(8, 'Img-20190328113150.jpg', '2019-03-28 06:20:31', '2019-04-04 06:24:53', NULL),
(9, 'Img-20190404050244.jpg', '2019-04-03 00:36:17', '2019-04-04 07:27:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `affirmation_quotes`
--

CREATE TABLE `affirmation_quotes` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affirmation_quotes`
--

INSERT INTO `affirmation_quotes` (`id`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'There is only one happiness in this life, to love and be loved. ...', '2019-03-27 08:13:41', '2019-03-27 09:27:14', NULL),
(2, 'If you have only one smile in you give it to the people you love. ...', '2019-03-27 08:13:46', '2019-04-04 06:26:47', NULL),
(3, 'The greatest healing therapy is friendship and love.', '2019-03-27 08:13:53', '2019-03-27 08:35:47', NULL),
(4, 'quote message 123', '2019-04-02 22:58:48', '2019-04-04 07:27:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audios`
--

CREATE TABLE `audios` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` tinyint(4) NOT NULL DEFAULT '0',
  `audio_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio_description` text COLLATE utf8mb4_unicode_ci,
  `audio_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audios`
--

INSERT INTO `audios` (`id`, `category_id`, `audio_title`, `audio_description`, `audio_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Healing Your Inner Child Meditation', NULL, 'Healing Your Inner Child Meditation.wav', '2019-03-31 13:00:00', '2019-03-31 13:00:00'),
(2, 2, 'Perfect Partner Meditation', NULL, 'Perfect Partner Meditation.wav', '2019-03-31 13:00:00', '2019-03-31 13:00:00'),
(3, 3, 'Forgiveness Meditation', NULL, 'Forgiveness Meditation.wav', '2019-04-12 18:30:00', '2019-04-12 18:30:00'),
(4, 4, 'Healing And Breaking Soul Ties Meditation', NULL, 'Healing And Breaking Soul Ties Meditation.wav', '2019-04-12 18:30:00', '2019-04-12 18:30:00'),
(5, 5, 'Healing From Rape And Sexual Assault Meditation', NULL, 'Healing From Rape And Sexual Assault Meditation.wav', '2019-04-12 18:30:00', '2019-04-12 18:30:00'),
(6, 6, 'Healing Parental Trauma Meditation', NULL, 'Healing Parental Trauma Meditation.wav', '2019-04-12 18:30:00', '2019-04-12 18:30:00'),
(7, 7, 'Visualizing Your Future Meditation', NULL, 'Visualizing Your Future Meditation.wav', '2019-04-12 18:30:00', '2019-04-12 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2019_03_26_131115_add_name_remove_firstname_lastname_to_users_table', 1),
(35, '2014_10_12_000000_create_users_table', 2),
(36, '2014_10_12_100000_create_password_resets_table', 2),
(37, '2019_03_25_063243_create_affirmation_quotes_table', 2),
(38, '2019_03_25_064823_create_affirmation_images_table', 2),
(39, '2019_03_25_065423_create_payment_transaction_table', 2),
(40, '2019_04_01_064547_create_audios_table', 3),
(41, '2019_04_01_070826_create_videos_table', 4),
(42, '2019_04_02_062253_add_is_book_purchased_to_users_table', 5),
(43, '2019_04_03_111126_add_categoty_id_to_audios_table', 6),
(44, '2019_04_04_105228_add_deleted_at_to_users_table', 7),
(45, '2019_04_04_120741_create_service_lists_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('pratik.patel@innvonix.com', '$2y$10$LrmCsZPH7xPpnIrB.kaJ3Oe7X7KfXjLJUFtNuBAs2dItrvvOUOu32', '2019-04-02 08:51:52'),
('ri@yopmail.com', '$2y$10$Ib8RHVHO1j2yyiwtPMC8Ve8ynJYT9xSggPtSd0f7DAIRvpupQ54S.', '2019-04-10 01:21:15'),
('richa.shah@innvonix.com', '$2y$10$vhErflh.jGM1I1PL3v/wP.Gzrnp6KsxyI/CLjMy2abk5xLN3TaFG.', '2019-04-10 05:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE `payment_transaction` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_lists`
--

CREATE TABLE `service_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_lists`
--

INSERT INTO `service_lists` (`id`, `service_name`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Daily Healing Activities', 20.00, '2019-04-03 18:30:00', '2019-04-04 09:54:59', NULL),
(2, 'Relationship Goal', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(3, 'Self Work', 50.00, '2019-04-03 18:30:00', '2019-04-04 09:56:05', NULL),
(4, 'Journaling Work', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(5, 'Secrets to Attracting a Healthy Relationship', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(6, 'Create Perfect Partner', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(7, 'Meditations that Manifest Love', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(8, 'Meditations that Heal Heartbreak', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(9, 'Quizzes', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(10, 'Meditation that Heals Heartbeats', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(11, 'Secrets Every Man Wants a Woman to Know but Would NEVER Tell Her!', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(12, 'Type of Man to Avoid', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(13, 'Coaching Video', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(14, 'Advice for Single Moms', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(15, 'Advice for Homosexuality', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(16, 'Advice for Men', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(17, 'Advice for Women', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(18, 'Advice for Teens', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(19, 'Coaching Product', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(20, 'Coaching Services', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(21, 'Upgrade Account', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(22, 'Purchase Book', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(23, 'Single Women Attract The Mate', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(24, 'Single Mothers Attract The Mate', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(25, 'Get Married Audio Coaching', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(26, 'Get The Girl Nice Guy System', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(27, 'TEEN DATING MADE EASY INCLUDES', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL),
(28, 'Meditations For Healing and Attracting Love Set', 1.00, '2019-04-03 18:30:00', '2019-04-03 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0=male,1=female',
  `date_of_birth` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_affirmation_quote_id` bigint(20) DEFAULT NULL,
  `read_affirmation_image_id` bigint(20) DEFAULT NULL,
  `is_book_purchased` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `date_of_birth`, `email_verified_at`, `password`, `remember_token`, `device_id`, `provider`, `provider_id`, `profile_img`, `read_affirmation_quote_id`, `read_affirmation_image_id`, `is_book_purchased`, `status`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pratik Patel', 'pratik.patel@innvonix.com', NULL, NULL, NULL, '$2y$10$erAOUdXDE8v/g4bHYR1aq.T6n6Gg1jDB.7VnY8d4ZLg8ZHWi9/vPy', 'qIGKG3NHcEQ2CLCZBmfu1hPZxZih81X5SRncuh3hNq1aRGNBmrygXmAOwWW6', '225249123', NULL, NULL, NULL, 1, 8, 0, 1, 1, '2019-03-27 08:04:31', '2019-04-04 06:10:40', NULL),
(2, 'kinjal', 'kinjal.patel@innvonix.com', NULL, NULL, NULL, '$2y$10$62jRLDsi5w.dKKd3tSwGXucXcYF/dRTdbxtznWZDuN34AlLDrYLZK', NULL, NULL, NULL, NULL, 'default.png', 1, 2, 0, 1, 0, '2019-03-27 08:14:19', '2019-04-04 07:24:16', NULL),
(3, 'Nilesh Patel', 'masterwayne243@gmail.com', NULL, NULL, NULL, '$2y$10$l/QMo0HQZTnRBn0Lae45bOjlIBhPCMpp5tz2H7qtn.yw9GkRZ.Mbi', NULL, NULL, 'facebook', '693812117700130', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=693812117700130&height=120&width=120&ext=1556286883&hash=AeTXlNGmUVc8FGH4', 1, 2, 0, 1, 0, '2019-03-27 08:24:44', '2019-04-04 07:24:53', NULL),
(4, 'parth', 'parth@gmail.com', NULL, NULL, NULL, '$2y$10$SO/oTWWQDXfKWxRPKdO17eBOQdE0i/WI0rtfaCDDKIC2OkSPodcMC', NULL, NULL, NULL, NULL, 'default.png', 1, 8, 0, 1, 0, '2019-03-27 08:26:19', '2019-03-28 09:14:20', NULL),
(5, 'richirichhah', 'richa.shah@innvonix.com', 1, '2018-11-07', NULL, '$2y$10$3pxS95L4tr.7f.shBlTo1eyW.yLov5XHXWMApGnDJI8U594BujlDO', 'fMYYtFdQwEycsqs5RTw18vW1rMIK93lplD2P4Ysu92KL4UCCASdsI5NkNBYi', NULL, NULL, NULL, 'Img-20190401083852.jpg', 1, 2, 1, 1, 0, '2019-03-27 08:30:41', '2019-04-10 05:01:08', NULL),
(7, 'Chetan kukadiya', 'chetan.kukadiya@innvonix.com', NULL, NULL, NULL, '$2y$10$uau6iRLvTA5nKwxXgloGoOO4tbrO8dyAoI3f4H.UNjzfdMyuux7xO', NULL, '225249123', NULL, NULL, 'default.png', 3, 2, 0, 1, 0, '2019-03-28 03:04:16', '2019-03-28 09:14:20', NULL),
(8, 'john', 'john@yopmail.com', 0, '1995-05-28', NULL, '$2y$10$6JYrLRbs0fZxBeMS84t1tO5RpoPgstyZLrP.80s5a9/783xCu3PC6', NULL, '225249123', NULL, NULL, 'Img-20190330051159.png', 3, 8, 0, 1, 0, '2019-03-28 03:26:35', '2019-03-30 00:29:12', NULL),
(10, 'dimple', 'dimple.mistry@innvonix.com', NULL, NULL, NULL, '$2y$10$QKnTdsEZwxpUg89ABuYnZ.yaaWitzIQmSqTchkiqoMQupj7Am1EHS', NULL, NULL, NULL, NULL, 'default.png', 1, 8, 0, 1, 0, '2019-03-28 07:52:31', '2019-03-28 09:14:20', NULL),
(11, 'sameer', 'sameer.ansari@innvonix.com', NULL, NULL, NULL, '$2y$10$M2ndEH9FYhrcrB18H/9DlegwFE86EJ7B1nAD5SS9BmHv6cRoyGNpq', NULL, NULL, NULL, NULL, 'default.png', 1, 8, 0, 1, 0, '2019-03-28 08:55:25', '2019-03-28 09:14:20', NULL),
(12, 'joy', 'joy@yopmail.com', NULL, '1991-06-19', NULL, '$2y$10$1RkDZfZ.njNLfFJK4ES55OrCeQ/JmSDzkQ3ZYT6M3ac3EFmI2fzNy', NULL, NULL, NULL, NULL, 'Img-20190330064026.jpg', 1, 2, 1, 1, 0, '2019-03-30 00:26:30', '2019-04-02 01:56:00', NULL),
(13, 'RICHA SHAH', 'richashah1656@gmail.com', NULL, NULL, NULL, '$2y$10$mhamhtBkxJ.q5nlDBJhVbu/U3R8AAzTg0E1LxSu/iQXc9yUrruRTy', NULL, NULL, 'instagram', '2260315861', 'https://scontent.cdninstagram.com/vp/064a8a3cb6645c8152c0edc1522c9cbf/5D4DF98E/t51.2885-19/s150x150/54512861_407046133190314_8613994139798732800_n.jpg?_nc_ht=scontent.cdninstagram.com', 1, 2, 0, 1, 0, '2019-04-03 01:34:09', '2019-04-03 01:34:09', NULL),
(14, 'chandani', 'ch@agg.com', NULL, NULL, NULL, '$2y$10$xBInSNP3bvzmisqfD.e46.Qj60v6NNdTWxO/PnFnRO9SfFAHgrxP6', NULL, NULL, NULL, NULL, 'default.png', 1, 2, 0, 1, 0, '2019-04-03 04:51:41', '2019-04-03 04:51:41', NULL),
(15, 'ytjrurit', 'kiyfikuf@ifu.v', NULL, NULL, NULL, '$2y$10$OuO1kxsLcB70Rs4vcea3nuF9dJetBmgPnNNghtyUUNTLCr5sp6moW', NULL, NULL, NULL, NULL, 'default.png', 1, 2, 0, 1, 0, '2019-04-03 04:52:07', '2019-04-04 05:33:14', NULL),
(16, 'chandani', 'chandani.jha@innvonix.com', NULL, NULL, NULL, '$2y$10$aVmwlg545rzfKIaDW9uN2Oj5lTHWsUR3CF2hW/3EdP6aoFXnq6KdK', 'jLzEY53fyC6CVZXUFbmykkOKI1RTiTQWRYzx2clflp41Xgd9uotL0SbEsmUx', NULL, NULL, NULL, 'default.png', 1, 2, 1, 1, 0, '2019-04-05 02:03:16', '2019-04-12 07:34:11', NULL),
(17, 'User', 'user.123@yopmail.com', NULL, NULL, NULL, '$2y$10$ODVW2O3nokBodK0OzuBxb.jsrhhR/xfjV/T5fJSA7LGSXzSa.bDF2', 'KCOm4eirWQb7TLUztHQRl4am8OFPXzFr9iAHWoGxQWOeBnRrsXnsZWQa8zCb', NULL, NULL, NULL, 'default.png', 1, 2, 1, 1, 0, '2019-04-09 02:11:59', '2019-04-09 02:41:43', NULL),
(18, 'Smith', 'smith404@yopmail.com', NULL, NULL, NULL, '$2y$10$JLlsRoe0Kc3eWGdv51I/euSB5yHKq0CDPaUrDHwhDHbpakukHdJ/S', 'YmtEmXq37GtnKUF5tw9P9nR0ZSU0KkOCVzHeM0XhwFFudCC7dPg8qeQyTlXA', NULL, NULL, NULL, 'default.png', 1, 2, 1, 1, 0, '2019-04-09 02:40:48', '2019-04-09 03:53:59', NULL),
(19, 'Sam Ansari', 'samiransari90@gmail.com', NULL, NULL, NULL, '$2y$10$OzaGySzJpUj59Ox7xjLab.SQ.iRLsvsSpOro2qQjdnbvA58FAYEXK', NULL, NULL, 'instagram', '1522623317', 'https://scontent.cdninstagram.com/vp/a2e7d1fe8f86402ac170201b5b8b6b00/5D29F6C6/t51.2885-19/10518290_635241219927109_782662534_a.jpg?_nc_ht=scontent.cdninstagram.com', 1, 2, 0, 1, 0, '2019-04-09 05:57:45', '2019-04-09 05:57:45', NULL),
(20, 'richa', 'ri@yopmail.com', 1, '2019-04-03', NULL, '$2y$10$unYGT9dSGIWe1tao3df7Juy4uL5a49fypGcV3jaHI8i2X4Grii3rK', NULL, NULL, NULL, NULL, 'default.png', 1, 2, 1, 1, 0, '2019-04-09 23:44:43', '2019-04-12 05:12:38', NULL),
(21, 'r', 'r@yopmail.com', NULL, NULL, NULL, '$2y$10$IoNIZrAOc4Nbr0UKGYE4y.MIvrrOCPQ0UwPkQG2m63siU24ieE.yy', NULL, NULL, NULL, NULL, 'default.png', 1, 2, 0, 1, 0, '2019-04-10 01:36:46', '2019-04-10 01:36:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `video_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_description` text COLLATE utf8mb4_unicode_ci,
  `video_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_title`, `video_description`, `video_path`, `created_at`, `updated_at`) VALUES
(1, 'Meditations that heal heartbeat 6', NULL, 'video_1.webm', '2019-03-31 13:00:00', '2019-03-31 13:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affirmation_images`
--
ALTER TABLE `affirmation_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affirmation_quotes`
--
ALTER TABLE `affirmation_quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_lists`
--
ALTER TABLE `service_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affirmation_images`
--
ALTER TABLE `affirmation_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `affirmation_quotes`
--
ALTER TABLE `affirmation_quotes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_lists`
--
ALTER TABLE `service_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
