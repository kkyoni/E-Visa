-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2021 at 09:04 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_visa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_sub_questions`
--

CREATE TABLE `admin_sub_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_question` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_answer_type` enum('text','drop-down','datepicker') COLLATE utf8_unicode_ci DEFAULT NULL,
  `subque_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_add_droup` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_note` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_tooltip` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_proceed` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_sub_questions`
--

INSERT INTO `admin_sub_questions` (`id`, `sub_question`, `sub_answer_type`, `subque_id`, `sub_add_droup`, `sub_note`, `sub_tooltip`, `sub_proceed`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'i am responsible person', 'drop-down', '3', 'yes', 'dfgfdg', 'dfgdsgfdsgdfg', '1', '2020-05-11 23:10:44', '2020-05-11 23:10:44', NULL),
(2, 'then what is issue', 'drop-down', '5', 'yes', 'dfgfdg', 'no problem', '1', '2020-05-11 23:12:35', '2020-05-11 23:12:35', NULL),
(3, 'ghgfhfgh', 'text', '4', NULL, '35345', 'gdfg passport must have', '0', '2021-04-13 05:15:41', '2021-04-13 05:18:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `description`, `blog`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'blog.png', 'active', '2020-05-26 02:35:30', '2020-06-09 04:39:04', NULL),
(2, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'blog.png', 'active', '2020-05-26 02:35:57', '2020-06-09 04:40:02', NULL),
(3, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32', 'blog.png', 'active', '2020-06-09 04:30:56', '2020-06-09 04:40:22', NULL),
(4, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc', 'blog.png', 'active', '2020-06-09 04:31:27', '2020-06-09 04:40:42', NULL),
(5, 'Lorem Ipsum is simply dummy', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains', 'blog.png', 'active', '2020-06-09 04:31:39', '2020-06-09 04:42:12', NULL),
(6, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'blog.png', 'active', '2020-06-09 04:31:55', '2020-06-09 04:41:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_number` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_holder_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_expiry_month` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_expiry_year` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cvv` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`id`, `user_id`, `card_type`, `card_number`, `card_holder_name`, `card_expiry_month`, `card_expiry_year`, `card_name`, `cvv`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7', 'visa', '4012 0010 3714 1112', 'swapnil', '02', '2022', NULL, '123', '2020-06-06 03:40:57', '2020-06-06 03:40:57', NULL),
(2, '18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-13 05:29:33', '2021-04-13 05:29:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `slug`, `title`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'popular-destinations', 'Popular Destinations', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', 'active', '2020-04-30 04:27:38', '2020-05-14 06:33:17', NULL),
(2, 'about-us', 'About us', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', 'active', '2020-04-30 04:27:38', '2020-05-06 07:21:52', NULL),
(3, 'privacy-policy', 'Privacy Policy', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', 'active', '2020-04-30 04:27:38', '2020-05-06 07:16:12', NULL),
(4, 'payment-terms', 'Payment Terms', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', 'active', '2020-04-30 04:27:38', '2020-05-06 07:13:10', NULL),
(5, 'terms-condition', 'Terms and condition', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', 'active', '2020-04-30 04:27:38', '2020-09-07 08:38:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_read` enum('read','unread') COLLATE utf8_unicode_ci DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `contact_no`, `country`, `message`, `admin_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Swapnil Nath', 'swapnil@gmail.com', '7678456378', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley ', 'read', '2020-05-02 05:53:32', '2021-02-19 10:55:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_tax_fee` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_rate` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country`, `service_tax_fee`, `image`, `currency`, `currency_rate`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Afghanistan', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(2, 'Albania', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(3, 'Algeria', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(4, 'Andorra', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(5, 'Angola', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-21 05:48:44', NULL),
(6, 'Antigua and Barbuda', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(7, 'Argentina', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(8, 'Armenia', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(9, 'Australia', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(10, 'Austria', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(11, 'Azerbaijan', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:16', '2020-05-03 09:00:16', NULL),
(12, 'The Bahamas', '11', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(13, 'Bahrain', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-20 04:51:55', NULL),
(14, 'Bangladesh', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(15, 'Barbados', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(16, 'Belarus', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(17, 'Belgium', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(18, 'Belize', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(19, 'Benin', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(20, 'Bhutan', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(21, 'Bolivia', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(22, 'Bosnia and Herzegovina', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(23, 'Botswana', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(24, 'Brazil', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(25, 'Brunei', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(26, 'Bulgaria', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(27, 'Burkina Faso', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(28, 'Cambodia', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(29, 'Cameroon', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(30, 'Canada', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(31, 'Cape Verde', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(32, 'Central African Republic', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:17', '2020-05-03 09:00:17', NULL),
(33, 'Chad', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(34, 'Chile', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(35, 'China', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(36, 'Colombia', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(37, 'Comoros', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(38, 'Congo, Republic of the', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(39, 'Congo, Democratic Republic of the', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(40, 'Costa Rica', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(41, 'Cote d\'Ivoire', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(42, 'Croatia', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(43, 'Cuba', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(44, 'Cyprus', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(45, 'Czech Republic', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(46, 'Denmark', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(47, 'Djibouti', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:18', '2020-05-03 09:00:18', NULL),
(48, 'Dominica', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(49, 'Dominican Republic', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(50, 'East Timor (Timor-Leste)', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(51, 'Ecuador', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(52, 'Egypt', '0', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2021-04-03 01:12:37', NULL),
(53, 'El Salvador', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(54, 'Equatorial Guinea', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(55, 'Eritrea', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(56, 'Estonia', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(57, 'Ethiopia', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(58, 'Fiji', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-25 04:08:37', NULL),
(59, 'Finland', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(60, 'France', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(61, 'Gabon', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(62, 'The Gambia', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(63, 'Georgia', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(64, 'Germany', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(65, 'Ghana', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:19', '2020-05-03 09:00:19', NULL),
(66, 'Greece', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(67, 'Grenada', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(68, 'Guatemala', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(69, 'Guinea', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(70, 'Guinea-Bissau', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(71, 'Guyana', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(72, 'Haiti', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(73, 'Honduras', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(74, 'Hungary', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(75, 'Iceland', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(76, 'India', '18', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2021-04-13 04:50:04', NULL),
(77, 'Indonesia', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(78, 'Iran', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(79, 'Iraq', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(80, 'Ireland', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(81, 'Israel', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(82, 'Italy', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(83, 'Jamaica', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:20', '2020-05-03 09:00:20', NULL),
(84, 'Japan', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(85, 'Jordan', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(86, 'Kazakhstan', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(87, 'Kenya', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(88, 'Kiribati', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(89, 'Korea, North', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(90, 'Korea, South', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(91, 'Kosovo', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(92, 'Kuwait', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(93, 'Kyrgyzstan', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:21', '2020-05-03 09:00:21', NULL),
(94, 'Laos', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(95, 'Latvia', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(96, 'Lebanon', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(97, 'Lesotho', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(98, 'Liberia', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(99, 'Libya', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(100, 'Liechtenstein', '11', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(101, 'Lithuania', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(102, 'Luxembourg', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(103, 'Macedonia', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(104, 'Madagascar', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(105, 'Malawi', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:22', '2020-05-03 09:00:22', NULL),
(106, 'Malaysia', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(107, 'Maldives', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(108, 'Mali', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(109, 'Malta', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(110, 'Marshall Islands', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(111, 'Mauritania', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(112, 'Mauritius', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(113, 'Mexico', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(114, 'Micronesia, Federated States of', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(115, 'Moldova', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:23', '2020-05-03 09:00:23', NULL),
(116, 'Monaco', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(117, 'Mongolia', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(118, 'Montenegro', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(119, 'Mozambique', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(120, 'Myanmar (Burma)', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(121, 'Namibia', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(122, 'Nauru', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(123, 'Nepal', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(124, 'Netherlands', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(125, 'New Zealand', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(126, 'Nicaragua', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(127, 'Niger', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(128, 'Nigeria', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(129, 'Norway', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(130, 'Oman', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(131, 'Pakistan', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(132, 'Palau', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(133, 'Papua New Guinea', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:24', '2020-05-03 09:00:24', NULL),
(134, 'Paraguay', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(135, 'Peru', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(136, 'Philippines', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(137, 'Poland', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(138, 'Portugal', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(139, 'Qatar', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(140, 'Romania', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(141, 'Russia', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2021-02-19 00:53:07', NULL),
(142, 'Rwanda', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(143, 'Saint Kitts and Nevis', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(144, 'Saint Lucia', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(145, 'Saint Vincent and the Grenadines', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(146, 'Samoa', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(147, 'San Marino', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(148, 'Sao Tome and Principe', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(149, 'Saudi Arabia', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(150, 'Senegal', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(151, 'Serbia', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:25', '2020-05-03 09:00:25', NULL),
(152, 'Seychelles', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:15:48', NULL),
(153, 'Sierra Leone', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:15:53', NULL),
(154, 'Singapore', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:15:56', NULL),
(155, 'Slovakia', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:00', NULL),
(156, 'Slovenia', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:05', NULL),
(157, 'Solomon Islands', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:09', NULL),
(158, 'Somalia', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:36', NULL),
(159, 'South Africa', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:17', NULL),
(160, 'South Sudan', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:22', NULL),
(161, 'Spain', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:43', NULL),
(162, 'Sri Lanka', '0', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-03-08 06:13:04', NULL),
(163, 'Sudan', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:53', NULL),
(164, 'Suriname', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:16:58', NULL),
(165, 'Swaziland', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:17:02', NULL),
(166, 'Sweden', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2021-02-04 06:17:06', NULL),
(167, 'Switzerland', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2020-05-03 09:00:26', NULL),
(168, 'Syria', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:26', '2020-05-03 09:00:26', NULL),
(169, 'Taiwan', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:14:41', NULL),
(170, 'Tajikistan', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:14:46', NULL),
(171, 'Tanzania', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:14:50', NULL),
(172, 'Thailand', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:14:54', NULL),
(173, 'Togo', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:14:59', NULL),
(174, 'Tonga', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:15:05', NULL),
(175, 'Trinidad and Tobago', '12', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:15:10', NULL),
(176, 'Tunisia', '11', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:15:14', NULL),
(177, 'Turkey', '10', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:15:19', NULL),
(178, 'Turkmenistan', '9', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:15:23', NULL),
(179, 'Tuvalu', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:15:29', NULL),
(180, 'Uganda', '7', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:27', '2021-02-04 06:15:32', NULL),
(181, 'Ukraine', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:28', '2021-02-04 06:12:59', NULL),
(182, 'United Arab Emirates', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:28', '2021-02-04 06:14:28', NULL),
(183, 'United Kingdom', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:28', '2021-02-04 06:14:32', NULL),
(184, 'United States of America', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:28', '2021-02-04 06:14:36', NULL),
(185, 'Uruguay', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:29', '2021-02-04 06:13:41', NULL),
(186, 'Uzbekistan', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:29', '2021-02-04 06:13:45', NULL),
(187, 'Vanuatu', '1', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:29', '2021-02-04 06:12:55', NULL),
(188, 'Vatican City (Holy See)', '8', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:30', '2020-06-01 04:09:53', NULL),
(189, 'Venezuela', '6', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:30', '2021-02-04 06:11:45', NULL),
(190, 'Vietnam', '5', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:30', '2021-02-04 06:12:15', NULL),
(191, 'Yemen', '4', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:30', '2021-02-04 06:12:13', NULL),
(192, 'Zambia', '3', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:30', '2021-02-04 06:12:49', NULL),
(193, 'Zimbabwe', '2', 'default.png', NULL, NULL, 'active', '2020-05-03 09:00:30', '2021-02-04 06:13:36', NULL),
(194, 'Morocco', '1', 'default.png', NULL, NULL, 'active', '2021-02-16 06:09:15', '2021-02-17 13:57:20', NULL),
(195, 'Palestine', '10', 'SLSYk0yL1ndestination-1.jpg', NULL, NULL, 'active', '2021-02-16 06:09:27', '2021-02-16 06:09:27', NULL),
(196, 'Anguilla', '10', 'Kz3egUTk18destination-1.jpg', NULL, NULL, 'active', '2021-02-24 01:39:54', '2021-02-24 01:39:54', NULL),
(197, 'Aruba', '10', 'nawIS2hwrbdestination-2.jpg', NULL, NULL, 'active', '2021-02-24 01:40:07', '2021-02-24 01:40:07', NULL),
(198, 'Brunei Darussalam', '10', 'yUxca1VxCEdestination-2 (1).jpg', NULL, NULL, 'active', '2021-02-24 01:40:19', '2021-02-24 01:40:19', NULL),
(199, 'Burundi', '10', 'Whf0Nv830mdestination-2.jpg', NULL, NULL, 'active', '2021-02-24 01:40:31', '2021-02-24 01:40:31', NULL),
(200, 'Cayman Islands', '10', 'iTEp62psEOdestination-2.jpg', NULL, NULL, 'active', '2021-02-24 01:40:43', '2021-02-24 01:40:43', NULL),
(201, 'Cook Islands', '8', 'g1DrCan2ybdestination-2.jpg', NULL, NULL, 'active', '2021-02-24 01:40:56', '2021-02-24 01:40:56', NULL),
(202, 'Hong Kong', '10', 'HKNHpwLlAKdestination-2 (1).jpg', NULL, NULL, 'active', '2021-02-24 01:41:10', '2021-02-24 01:41:10', NULL),
(203, 'Ivory Coast', '8', 'glbV07JDDndestination-3.jpg', NULL, NULL, 'active', '2021-02-24 01:41:23', '2021-02-24 01:41:23', NULL),
(204, 'Macau', '10', 'i6Yvs9DjWNdestination-3.jpg', NULL, NULL, 'inactive', '2021-02-24 01:41:36', '2021-03-16 23:08:03', NULL),
(205, 'Montserrat', '8', 'g5B7Qfonh7destination-1.jpg', NULL, NULL, 'active', '2021-02-24 01:41:48', '2021-02-24 01:41:48', NULL),
(206, 'Niue', '10', 'UFd2AQ4aLYdestination-2.jpg', NULL, NULL, 'active', '2021-02-24 01:42:08', '2021-02-24 01:42:08', NULL),
(207, 'Palestinian Territory', '10', 'Y5AevFwuwqdestination-2 (1).jpg', NULL, NULL, 'active', '2021-02-24 01:42:20', '2021-02-24 01:42:20', NULL),
(208, 'Panama', '8', 'hU3skxSGycdestination-2 (1).jpg', NULL, NULL, 'active', '2021-02-24 01:42:36', '2021-02-24 01:42:36', NULL),
(209, 'Republic of Cyprus', '10', 'fQWcd0WX7tdestination-2 (1).jpg', NULL, NULL, 'active', '2021-02-24 01:42:53', '2021-02-24 01:42:53', NULL),
(210, 'Russian Federation', '10', 'NB9ek7kKAFdestination-2 (1).jpg', NULL, NULL, 'active', '2021-02-24 01:43:15', '2021-02-26 23:50:37', '2021-02-26 23:50:37'),
(211, 'Turks and Caicos Islands', '8', '92SMlNK42ydestination-3.jpg', NULL, NULL, 'active', '2021-02-24 01:43:33', '2021-03-09 04:58:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country_visa_fees`
--

CREATE TABLE `country_visa_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_visa_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_type_entry_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regular_gov_fee` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `express_gov_fee` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regular_service_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_validity` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stay_validity` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_fee` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processing_time` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processing_day` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_tax` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country_visa_fees`
--

INSERT INTO `country_visa_fees` (`id`, `country_visa_id`, `visa_type_entry_id`, `regular_gov_fee`, `express_gov_fee`, `regular_service_type`, `visa_validity`, `stay_validity`, `service_fee`, `processing_time`, `processing_day`, `vat_tax`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '2', '565', '11', NULL, NULL, NULL, NULL, '01:05', '3', '22', '2020-05-07 23:44:03', '2020-05-07 23:44:03', NULL),
(2, '1', '1', '11', '11', NULL, NULL, NULL, NULL, '01:05', '3', '1', '2020-05-07 23:44:03', '2020-05-07 23:44:03', NULL),
(13, '3', '1', '12', NULL, '12', '12', '12', NULL, '01:05', '3', NULL, '2020-05-15 03:06:05', '2020-05-15 03:06:05', NULL),
(14, '3', '2', '13', NULL, '13', '13', '13', NULL, '01:05', '3', NULL, '2020-05-15 03:06:05', '2020-05-15 03:06:05', NULL),
(15, '3', '6', '21', NULL, '12', '21', '21', NULL, '01:05', '3', NULL, '2020-05-15 03:06:05', '2020-05-15 03:06:05', NULL),
(16, '2', '2', '565', NULL, '34', '11', '11', NULL, '01:05', '3', NULL, '2020-05-15 03:06:14', '2020-05-15 03:06:14', NULL),
(17, '2', '1', '11', NULL, '34', '11', '11', NULL, '01:05', '3', NULL, '2020-05-15 03:06:14', '2020-05-15 03:06:14', NULL),
(18, '2', '4', '33', NULL, '34', '11', '11', NULL, '01:05', '3', NULL, '2020-05-15 03:06:14', '2020-05-15 03:06:14', NULL),
(26, '6', '2', '565', NULL, '34', '11', '11', '23', '01:05', '3', NULL, '2020-05-24 23:49:56', '2020-05-24 23:49:56', NULL),
(27, '6', '1', '11', NULL, '34', '11', '11', '23', '01:05', '3', NULL, '2020-05-24 23:49:56', '2020-05-24 23:49:56', NULL),
(28, '4', '4', '23', NULL, '32', '23', '32', '12', '01:05', '3', NULL, '2020-05-24 23:50:16', '2020-05-24 23:50:16', NULL),
(31, '7', '1', '13', NULL, '13', '13', '134', '13', '01:05', '3', NULL, '2020-05-24 23:52:20', '2020-05-24 23:52:20', NULL),
(32, '7', '3', '34', NULL, '34', '34', '34', '34', '01:05', '3', NULL, '2020-05-24 23:52:20', '2020-05-24 23:52:20', NULL),
(33, '7', '6', '32', NULL, '32', '32', '32', '32', '01:05', '3', NULL, '2020-05-24 23:52:20', '2020-05-24 23:52:20', NULL),
(37, '8', '1', '13', NULL, '13', '13', '134', '13', '01:05', '3', NULL, '2020-05-25 04:07:45', '2020-05-25 04:07:45', NULL),
(38, '8', '2', '34', NULL, '34', '34', '34', '34', '01:05', '3', NULL, '2020-05-25 04:07:45', '2020-05-25 04:07:45', NULL),
(39, '8', '6', '32', NULL, '32', '32', '32', '32', '01:05', '3', NULL, '2020-05-25 04:07:45', '2020-05-25 04:07:45', NULL),
(40, '5', '2', '23', NULL, '23', '23', '23', '21', '01:05', '3', NULL, '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(41, '5', '4', '12', NULL, '12', '12', '12', '11', '01:05', '3', NULL, '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(46, '9', '1', '50', NULL, '100', '90', '30', '150', '01:05', '3', NULL, '2021-02-11 00:35:13', '2021-02-11 00:35:13', NULL),
(99, '13', '9', '400', NULL, '10', '30', '30', '150', '01:05', '3', NULL, '2021-02-11 20:55:26', '2021-02-11 20:55:26', NULL),
(100, '13', '10', '400', NULL, '10', '30', '30', '250', '01:05', '3', NULL, '2021-02-11 20:55:26', '2021-02-11 20:55:26', NULL),
(129, '14', '9', '335', NULL, '10', '30', '30', '265', '01:05', '3', NULL, '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(130, '14', '12', '635', NULL, '10', '30', '30', '250', '01:05', '3', NULL, '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(165, '17', '9', '470', NULL, '10', '30', '30', '300', '01:05', NULL, NULL, '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(166, '17', '12', '920', NULL, '10', '30', '30', '300', '01:05', NULL, NULL, '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(193, '15', '1', '150', NULL, '10', '60', '16', '100', '01:05', NULL, NULL, '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(203, '21', '1', '185', NULL, '10', '90', '15', '100', NULL, NULL, NULL, '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(214, '22', '9', '450', NULL, '10', '60', '30', '100', '01:05', NULL, NULL, '2021-02-18 08:50:41', '2021-02-18 08:50:41', NULL),
(215, '22', '10', '1170', NULL, '10', '60', '90', '150', '01:05', NULL, NULL, '2021-02-18 08:50:41', '2021-02-18 08:50:41', NULL),
(216, '10', '9', '370', NULL, '100', '60', '30', '100', '01:05', NULL, NULL, '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(217, '10', '10', '970', NULL, '100', '60', '90', '130', '01:05', NULL, NULL, '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(230, '23', '14', '150', NULL, '10', '60', '16', '100', '01:05', NULL, NULL, '2021-02-19 01:37:26', '2021-02-19 01:37:26', NULL),
(236, '24', '9', '110', NULL, '10', '30', '30', '100', NULL, NULL, NULL, '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(237, '24', '5', '160', NULL, '10', '365', '180', '210', NULL, NULL, NULL, '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(240, '25', '5', '510', NULL, '10', '365', '90', '120', NULL, NULL, NULL, '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(243, '20', '9', '432', NULL, NULL, '30', '30', '250', NULL, '35', NULL, '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(244, '19', '9', '470', NULL, NULL, '30', '30', '250', NULL, '7', NULL, '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(245, '19', '12', '770', NULL, NULL, '30', '30', '250', NULL, '3', NULL, '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(246, '18', '9', '922', NULL, NULL, '30', '30', '300', NULL, '10', NULL, '2021-02-26 23:53:11', '2021-02-26 23:53:11', NULL),
(247, '16', '9', '310', NULL, NULL, '30', '30', '150', NULL, '3', NULL, '2021-02-26 23:53:32', '2021-02-26 23:53:32', NULL),
(248, '16', '12', '610', NULL, NULL, '30', '30', '150', NULL, '3', NULL, '2021-02-26 23:53:32', '2021-02-26 23:53:32', NULL),
(255, '12', '9', '350', NULL, NULL, '60', '30', '100', NULL, '3', NULL, '2021-03-16 23:15:56', '2021-03-16 23:15:56', NULL),
(256, '12', '10', '750', NULL, NULL, '60', '90', '150', NULL, '3', NULL, '2021-03-16 23:15:56', '2021-03-16 23:15:56', NULL),
(257, '12', '14', '1500', NULL, NULL, '90', '60', '100', NULL, '3', NULL, '2021-03-16 23:15:56', '2021-03-16 23:15:56', NULL),
(258, '27', '5', '160', NULL, NULL, '365', '180', '210', NULL, '5', NULL, '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(259, '27', '2', '565', NULL, NULL, '11', '11', '12', NULL, '3', NULL, '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(260, '26', '1', '130', NULL, NULL, '90', '30', '100', NULL, '4', NULL, '2021-03-18 01:34:19', '2021-03-18 01:34:19', NULL),
(261, '26', '11', '32', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, '2021-03-18 01:34:19', '2021-03-18 01:34:19', NULL),
(262, '11', '9', '370', NULL, NULL, '60', '30', '100', NULL, '3', NULL, '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(263, '11', '10', '970', NULL, NULL, '60', '90', '150', NULL, '3', NULL, '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(264, '11', '13', '459', NULL, NULL, '70', '90', '110', NULL, '3', NULL, '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(265, '28', '2', '34', NULL, NULL, '3', '4', '3', NULL, '4', NULL, '2021-04-04 23:27:56', '2021-04-04 23:28:13', '2021-04-04 23:28:13'),
(272, '29', '2', '34', NULL, NULL, '3', '4', '3', NULL, '50', NULL, '2021-04-13 04:41:50', '2021-04-13 04:41:50', NULL),
(273, '29', '4', '12', NULL, NULL, '1', '1', '2', NULL, '2', NULL, '2021-04-13 04:41:50', '2021-04-13 04:41:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country_wise_visas`
--

CREATE TABLE `country_wise_visas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_type_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_from_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_type_entry_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_validity` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stay_validity` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regular_service_cost` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `express_service_cost` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `express_gov_fee` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regular_gov_fee` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regular_service_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `express_service_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `information` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `required_docs` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `favourite_status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '1=favourite and 0=notfavourite',
  `status` enum('active','inactive') COLLATE utf8_unicode_ci DEFAULT 'active',
  `processing_days` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country_wise_visas`
--

INSERT INTO `country_wise_visas` (`id`, `country_id`, `visa_type_id`, `country_from_id`, `visa_type_entry_id`, `visa_validity`, `stay_validity`, `regular_service_cost`, `express_service_cost`, `express_gov_fee`, `regular_gov_fee`, `regular_service_type`, `express_service_type`, `information`, `required_docs`, `favourite_status`, `status`, `processing_days`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '8', '2', NULL, NULL, '11', '11', '12', '23', NULL, NULL, '34', '23', 'test', 'test', '1', 'active', '12', '2020-05-07 23:44:03', '2021-02-10 11:25:57', NULL),
(2, '14', '2', NULL, NULL, '11', '11', '12', '23', NULL, NULL, '34', '23', 'test', 'test', '0', 'active', '2', '2020-05-07 23:44:15', '2021-02-10 11:26:03', NULL),
(3, '5', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'test', '1', 'active', '4', '2020-05-15 03:05:44', '2021-02-10 11:26:24', NULL),
(4, '11', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'demo', 'demo', '1', 'active', '8', '2020-05-18 03:59:26', '2021-02-10 11:26:13', NULL),
(5, '13', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test demo', 'test demo', '0', 'active', '4', '2020-05-20 04:51:37', '2021-02-10 11:25:51', NULL),
(6, '8', '2', NULL, NULL, '11', '11', '12', '23', NULL, NULL, '34', '23', 'test', 'test', '0', 'active', NULL, '2020-05-22 05:51:09', '2021-02-10 11:26:08', NULL),
(7, '58', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test information', 'test docs', '0', 'active', NULL, '2020-05-24 23:51:59', '2021-02-10 11:25:43', NULL),
(8, '58', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test information', 'test docs', '0', 'active', NULL, '2020-05-25 04:07:23', '2021-02-10 11:25:34', NULL),
(9, '13', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'We provide Bahrain visa and process time is between 24 to 72 hours.', 'Passport copy\r\n1 Photo', '1', 'active', NULL, '2020-05-25 07:18:11', '2021-02-11 14:02:25', NULL),
(10, '182', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Travel to UAE', 'Passport Validity 6 month\r\n1 Photo', '0', 'active', NULL, '2021-02-11 14:00:41', '2021-02-18 08:51:21', NULL),
(11, '182', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Travel to UAE', 'Passport Validity 6 month\r\n1 Photo', '0', 'active', NULL, '2021-02-11 14:24:08', '2021-04-03 01:47:19', NULL),
(12, '182', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Travel to UAE', 'Passport Validity 6 month\r\n1 Photo', '0', 'active', NULL, '2021-02-11 14:49:14', '2021-03-16 23:15:56', NULL),
(13, '141', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Travel to Russia information', 'Passport Valid 6 Months\r\n1 Photo White Background', '0', 'active', NULL, '2021-02-11 15:49:39', '2021-02-11 20:55:26', NULL),
(14, '141', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Travel to Russia information', 'Passport Valid 6 Months\r\n1 Photo White Background', '0', 'active', NULL, '2021-02-11 15:49:59', '2021-02-15 14:47:53', NULL),
(15, '141', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Duration of Stay 13 days only\r\nVisa is valid to below \r\n\r\nAir Checkpoints : «Khabarovsk (Novy Airport)», «Kaliningrad (Khrabrovo)», «Pulkovo», «Belgorod», «Volgograd (Gumrak)», «Ekaterinburg (Koltsovo)», «Kazan», «Krasnodar (Pashkovsky)», «Krasnoyarsk (Yemelyanovo)», «Moscow (Vnukovo)», «Moscow (Domodedovo)», «Moscow (Sheremetyevo)», «Nizhny Novgorod (Strigino)», «Novosibirsk (Tolmachevo)», «Rostov-on-Don (Platov)», «Samara (Kurumoch)»\r\n\r\nNaval Check Points\r\n«Vladivostok», «Zarubino», «Kaliningrad (checkpoints in the cities of Kaliningrad and Svetly)», «Big port Saint Petersburg (Marine Station)», «Passenger port Saint Petersburg», «Sochi (International Center for Sea Passenger and Cruise Transportation)»;\r\n\r\nAutomobile checkpoints «Bagrationovsk», «Gusev», «Mamonovo (Grzechotki)», «Mamonovo (Gronowo)», «Morskoje», «Pogranichny», «Sovetsk», «Chernyshevskoye», «Ivangorod», «Ubylinka», «Burachki», «Vyartsilya», «Kunichina Gora», «Shumilkino»;', 'Valid Passport 6 Months\r\n1 Photo White background', '0', 'inactive', NULL, '2021-02-15 11:15:27', '2021-02-18 09:04:32', NULL),
(16, '141', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Travel to Russia information', 'Passport Valid 6 Months\r\n1 Photo White Background', '0', 'active', NULL, '2021-02-15 15:10:08', '2021-02-26 23:53:32', NULL),
(17, '141', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Travel to Russia information', 'Passport Valid 6 Months\r\n1 Photo White Background', '0', 'active', NULL, '2021-02-15 15:13:32', '2021-02-17 12:27:16', NULL),
(18, '141', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Apply for Russia Visa', 'Passport Valid 6 Months\r\n1 Photo White background', '0', 'active', NULL, '2021-02-15 15:33:29', '2021-02-26 23:53:11', NULL),
(19, '141', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Russia Visa', 'Passport Validity 6 month\r\n1 Photo', '0', 'active', NULL, '2021-02-15 15:48:12', '2021-02-26 23:52:45', NULL),
(20, '141', '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Apply Russia Visa', 'Passport Valid 6 Months\r\n1 Photo White Background\r\nMust have Private or FMS Invitation', '0', 'active', NULL, '2021-02-15 16:10:00', '2021-02-26 23:52:04', NULL),
(21, '188', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kenya Visa', 'Passport Must be Valid 6 Months\r\n1 Photo Whitebackground.', '0', 'active', NULL, '2021-02-17 15:30:15', '2021-02-18 08:36:05', NULL),
(22, '182', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Travel to UAE', 'Passport Validity 6 month\r\n1 Photo', '0', 'inactive', NULL, '2021-02-18 08:49:30', '2021-02-18 09:03:43', NULL),
(23, '52', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Duration of Stay 90 days\r\nVisa is valid to below \r\n\r\nAir Checkpoints : «Khabarovsk (Novy Airport)», «Kaliningrad (Khrabrovo)», «Pulkovo», «Belgorod», «Volgograd (Gumrak)», «Ekaterinburg (Koltsovo)», «Kazan», «Krasnodar (Pashkovsky)», «Krasnoyarsk (Yemelyanovo)», «Moscow (Vnukovo)», «Moscow (Domodedovo)», «Moscow (Sheremetyevo)», «Nizhny Novgorod (Strigino)», «Novosibirsk (Tolmachevo)», «Rostov-on-Don (Platov)», «Samara (Kurumoch)»\r\n\r\nNaval Check Points\r\n«Vladivostok», «Zarubino», «Kaliningrad (checkpoints in the cities of Kaliningrad and Svetly)», «Big port Saint Petersburg (Marine Station)», «Passenger port Saint Petersburg», «Sochi (International Center for Sea Passenger and Cruise Transportation)»;\r\n\r\nAutomobile checkpoints «Bagrationovsk», «Gusev», «Mamonovo (Grzechotki)», «Mamonovo (Gronowo)», «Morskoje», «Pogranichny», «Sovetsk», «Chernyshevskoye», «Ivangorod», «Ubylinka», «Burachki», «Vyartsilya», «Kunichina Gora», «Shumilkino»;', 'Valid Passport 6 Months\r\n1 Photo White background', '0', 'active', NULL, '2021-02-19 01:25:33', '2021-02-19 01:37:25', NULL),
(24, '76', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'India Visa in 3 days', 'Passport Must be Valid 6 Months\r\n1 Photo Whitebackground.', '0', 'active', NULL, '2021-02-19 02:18:44', '2021-02-19 09:32:08', NULL),
(25, '149', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Saudi Visa', 'Passport must be Valid 6 Month\r\n1 Photo White background', '0', 'active', NULL, '2021-02-19 12:40:49', '2021-02-19 12:44:04', NULL),
(26, '162', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sri Lanka Visa', 'Passport Must be Valid 6 Months\r\n1 Photo Whitebackground.\r\nDouble Entry', '0', 'active', NULL, '2021-02-28 00:07:46', '2021-03-18 01:34:09', NULL),
(27, '162', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sri Lanka Visa', 'Passport Valid 6 months\r\n2 Photo white background\r\n3 Months Bank Statement.', '0', 'active', NULL, '2021-02-28 01:12:53', '2021-03-17 04:20:32', NULL),
(28, '18', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sf', 'sdf', '0', 'active', NULL, '2021-04-04 23:27:56', '2021-04-04 23:28:13', '2021-04-04 23:28:13'),
(29, '18', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sf', 'sdf', '0', 'active', NULL, '2021-04-04 23:27:56', '2021-04-13 04:41:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `slug`, `title`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'marketing_pdf_attached', 'Marketing PDF attached', '<p>Marketing PDF attached</p>', 'active', '2020-04-29 22:57:38', '2020-04-29 22:57:38', NULL),
(2, 'social_share_link', 'Social Share link', '<p>Social Share link</p>', 'active', '2020-04-29 22:57:38', '2020-04-29 22:57:38', NULL),
(3, 'complete_payment', 'Complete Payment', '<p>Complete Payment</p>', 'active', '2020-04-29 22:57:38', '2020-04-29 22:57:38', NULL),
(4, 'order_status_reject', 'Order status - Reject', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'active', '2020-04-29 22:57:38', '2020-04-29 22:57:38', NULL),
(5, 'order_status_approved', 'Order status - Approved', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'active', '2020-04-29 22:57:38', '2020-04-29 22:57:38', NULL),
(6, 'order_status_pending', 'Order status - Pending', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'active', '2020-04-29 22:57:38', '2020-04-29 22:57:38', NULL),
(7, 'informative_links', 'Informative Links', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'active', '2020-04-29 22:57:38', '2020-04-29 22:57:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `embassy`
--

CREATE TABLE `embassy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `embassy_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `embassy`
--

INSERT INTO `embassy` (`id`, `country_id`, `embassy_id`, `address`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '2', 'Nyerere Road', 'active', '2020-04-30 17:53:40', '2020-05-04 16:19:36', '2020-05-04 16:19:36'),
(2, '1', '182', 'Zanbaq Talayi square Kabul', 'active', '2020-05-04 16:13:11', '2020-05-04 16:13:11', NULL),
(3, '1', '149', 'Shish Dark Area - Main Street - behind the International Peacekeeping Forces (ISAF) Kabul', 'active', '2020-05-04 16:20:09', '2020-05-04 16:20:09', NULL),
(4, '1', '76', '5, 50F, Shantipath, Chanakyapuri, New Delhi, Delhi 110021, Indi', 'active', '2020-05-29 04:30:59', '2020-05-29 04:30:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_by` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_type_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `order_by`, `country_id`, `visa_type_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'What is Lorem Ipsum?', 'lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', NULL, '1', '1', 'active', '2020-05-26 02:30:01', '2020-05-26 02:30:01', NULL),
(2, 'Why do we use it?', 'lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, '2', '2', 'active', '2020-05-26 02:30:13', '2020-05-26 02:30:13', NULL),
(3, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, '3', '3', 'active', '2020-05-26 02:30:27', '2020-05-26 02:30:27', NULL),
(4, 'Where can I get some?', 'lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc', NULL, '4', '4', 'active', '2020-05-26 02:30:46', '2020-05-26 02:30:46', NULL),
(5, 'Which Countries are eligible for Evisa?', 'Our website contains up to date list of countries eligible for Russia EVisa.', NULL, '141', '3', 'active', '2021-02-15 13:43:43', '2021-02-15 13:52:39', NULL),
(6, 'Can I enter from any Airport in Russia?', 'You can enter from any of mentioned airports like Khabarovsk (Novy Airport), Kaliningrad (Khrabrovo), Pulkovo, Belgorod, Volgograd (Gumrak), Ekaterinburg (Koltsovo), Kazan, Krasnodar (Pashkovsky), Krasnoyarsk (Yemelyanovo), Moscow (Vnukovo), Moscow (Domodedovo), Moscow (Sheremetyevo), Nizhny Novgorod (Strigino), Novosibirsk (Tolmachevo), Rostov-on-Don (Platov), Samara (Kurumoch)', NULL, '141', '3', 'active', '2021-02-15 13:48:49', '2021-02-15 13:52:29', NULL),
(7, 'I am travelling with Sea Cruise, can I enter from any Sea Port', 'You can enter from any naval check points like Vladivostok, Zarubino, Kaliningrad (checkpoints in the cities of Kaliningrad and Svetly), Big port Saint Petersburg (Marine Station), Passenger port Saint Petersburg, Sochi (International Center for Sea Passenger and Cruise Transportation)', NULL, '141', '3', 'active', '2021-02-15 13:51:21', '2021-02-15 13:52:19', NULL),
(8, 'Can I travel by Rail and use Russia Evisa?', 'Yes, only two ports are allowed Pogranichny and Khasan', NULL, '141', '3', 'active', '2021-02-15 13:55:27', '2021-02-15 13:55:27', NULL),
(9, 'Do I need Tourist Voucher like invitation to apply for Russia Evisa?', 'It is not required for Russia E-Visa applicants to submit an Invitation letter, or hotel confirmation or flight. We takecare of all documentation.', NULL, '141', '3', 'active', '2021-02-15 13:56:57', '2021-02-15 13:58:16', NULL),
(10, 'Can I visit any city in Russia using E-visa?', 'Yes,  you have the right to freedom of movement within the entire territory of the Russian Federation.', NULL, '141', '3', 'active', '2021-02-15 14:01:07', '2021-02-15 14:01:07', NULL),
(11, 'How long is the Russia E-Visa Valid?', 'The validity period of a Russia E-Visa is 60 days from the date of issue and Maximum stay is 16 days.', NULL, '141', '3', 'active', '2021-02-15 14:03:33', '2021-02-15 14:03:33', NULL),
(12, 'Can I stay longer than 16 Days?', 'No, You need to exit on time. example 24hours x 16 days = 384 Hours Maximum.', NULL, '141', '3', 'active', '2021-02-15 14:06:04', '2021-02-15 14:06:04', NULL),
(13, 'When can I start applying for Russia E-Visa?', 'The application can be submitted no earlier than 40 days and no later than 4 days before the expected date of entry into the Russian Federation.', NULL, '141', '3', 'active', '2021-02-15 14:08:09', '2021-02-15 14:08:09', NULL),
(14, 'How about Children in my passport?', 'If you are travelling with minor children indicated in your passport, a separate application for a unified e-visa must be submitted for each child. All minor children travelling with their parents must have a separate e-visa.', NULL, '141', '3', 'active', '2021-02-15 14:09:49', '2021-02-15 14:09:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` varchar(244) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `rating`, `review`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 6, '5', 'The process was seamless! Well done!\r\nThank you so much', '2020-05-12 13:00:00', '2020-05-13 13:00:00', NULL),
(7, 7, '3', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century.', '2020-05-12 13:00:00', '2020-05-13 13:00:00', NULL),
(8, 5, '2', 'I was very angry with the results online because of an email I Received   Then I...', '2020-05-12 13:00:00', '2020-05-13 13:00:00', NULL),
(9, 8, '1', 'Having to apply for a visa for our trip to Russia you first require a letter of...', '2020-05-12 13:00:00', '2020-05-13 13:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `from_countries`
--

CREATE TABLE `from_countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_visa_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `from_countries`
--

INSERT INTO `from_countries` (`id`, `country_visa_id`, `from_country_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '35', '2020-05-07 23:44:03', '2020-05-07 23:44:03', NULL),
(2, '1', '76', '2020-05-07 23:44:03', '2020-05-07 23:44:03', NULL),
(3, '1', '10', '2020-05-07 23:44:03', '2020-05-07 23:44:03', NULL),
(4, '1', '16', '2020-05-07 23:44:03', '2020-05-07 23:44:03', NULL),
(23, '3', '2', '2020-05-15 03:06:05', '2020-05-15 03:06:05', NULL),
(24, '3', '3', '2020-05-15 03:06:05', '2020-05-15 03:06:05', NULL),
(25, '3', '4', '2020-05-15 03:06:05', '2020-05-15 03:06:05', NULL),
(26, '3', '6', '2020-05-15 03:06:05', '2020-05-15 03:06:05', NULL),
(27, '2', '10', '2020-05-15 03:06:14', '2020-05-15 03:06:14', NULL),
(28, '2', '16', '2020-05-15 03:06:14', '2020-05-15 03:06:14', NULL),
(29, '2', '35', '2020-05-15 03:06:14', '2020-05-15 03:06:14', NULL),
(30, '2', '76', '2020-05-15 03:06:14', '2020-05-15 03:06:14', NULL),
(31, '2', '121', '2020-05-15 03:06:14', '2020-05-15 03:06:14', NULL),
(51, '6', '10', '2020-05-24 23:49:56', '2020-05-24 23:49:56', NULL),
(52, '6', '16', '2020-05-24 23:49:56', '2020-05-24 23:49:56', NULL),
(53, '6', '35', '2020-05-24 23:49:56', '2020-05-24 23:49:56', NULL),
(54, '6', '76', '2020-05-24 23:49:56', '2020-05-24 23:49:56', NULL),
(55, '4', '1', '2020-05-24 23:50:16', '2020-05-24 23:50:16', NULL),
(56, '4', '2', '2020-05-24 23:50:16', '2020-05-24 23:50:16', NULL),
(57, '4', '4', '2020-05-24 23:50:16', '2020-05-24 23:50:16', NULL),
(58, '4', '5', '2020-05-24 23:50:16', '2020-05-24 23:50:16', NULL),
(59, '4', '6', '2020-05-24 23:50:16', '2020-05-24 23:50:16', NULL),
(64, '7', '3', '2020-05-24 23:52:19', '2020-05-24 23:52:19', NULL),
(65, '7', '20', '2020-05-24 23:52:19', '2020-05-24 23:52:19', NULL),
(66, '7', '55', '2020-05-24 23:52:19', '2020-05-24 23:52:19', NULL),
(67, '7', '69', '2020-05-24 23:52:19', '2020-05-24 23:52:19', NULL),
(72, '8', '3', '2020-05-25 04:07:45', '2020-05-25 04:07:45', NULL),
(73, '8', '20', '2020-05-25 04:07:45', '2020-05-25 04:07:45', NULL),
(74, '8', '55', '2020-05-25 04:07:45', '2020-05-25 04:07:45', NULL),
(75, '8', '69', '2020-05-25 04:07:45', '2020-05-25 04:07:45', NULL),
(76, '5', '48', '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(77, '5', '49', '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(78, '5', '58', '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(79, '5', '59', '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(80, '5', '60', '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(81, '5', '76', '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(82, '5', '87', '2020-05-25 07:16:29', '2020-05-25 07:16:29', NULL),
(109, '9', '48', '2021-02-11 00:35:12', '2021-02-11 00:35:12', NULL),
(110, '9', '49', '2021-02-11 00:35:12', '2021-02-11 00:35:12', NULL),
(111, '9', '58', '2021-02-11 00:35:12', '2021-02-11 00:35:12', NULL),
(112, '9', '59', '2021-02-11 00:35:13', '2021-02-11 00:35:13', NULL),
(113, '9', '60', '2021-02-11 00:35:13', '2021-02-11 00:35:13', NULL),
(114, '9', '76', '2021-02-11 00:35:13', '2021-02-11 00:35:13', NULL),
(115, '9', '87', '2021-02-11 00:35:13', '2021-02-11 00:35:13', NULL),
(116, '9', '131', '2021-02-11 00:35:13', '2021-02-11 00:35:13', NULL),
(117, '9', '171', '2021-02-11 00:35:13', '2021-02-11 00:35:13', NULL),
(118, '9', '182', '2021-02-11 00:35:13', '2021-02-11 00:35:13', NULL),
(237, '13', '76', '2021-02-11 20:55:26', '2021-02-11 20:55:26', NULL),
(238, '13', '85', '2021-02-11 20:55:26', '2021-02-11 20:55:26', NULL),
(547, '14', '2', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(548, '14', '4', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(549, '14', '8', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(550, '14', '10', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(551, '14', '11', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(552, '14', '16', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(553, '14', '17', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(554, '14', '22', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(555, '14', '26', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(556, '14', '42', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(557, '14', '44', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(558, '14', '45', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(559, '14', '46', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(560, '14', '56', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(561, '14', '59', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(562, '14', '60', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(563, '14', '63', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(564, '14', '64', '2021-02-15 14:47:53', '2021-02-15 14:47:53', NULL),
(565, '14', '66', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(566, '14', '74', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(567, '14', '82', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(568, '14', '86', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(569, '14', '95', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(570, '14', '100', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(571, '14', '101', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(572, '14', '102', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(573, '14', '103', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(574, '14', '109', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(575, '14', '115', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(576, '14', '116', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(577, '14', '118', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(578, '14', '124', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(579, '14', '129', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(580, '14', '137', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(581, '14', '138', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(582, '14', '140', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(583, '14', '151', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(584, '14', '155', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(585, '14', '156', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(586, '14', '161', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(587, '14', '166', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(588, '14', '167', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(589, '14', '177', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(590, '14', '181', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(591, '14', '188', '2021-02-15 14:47:54', '2021-02-15 14:47:54', NULL),
(873, '17', '3', '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(874, '17', '30', '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(875, '17', '78', '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(876, '17', '85', '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(877, '17', '177', '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(878, '17', '178', '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(879, '17', '194', '2021-02-17 12:27:16', '2021-02-17 12:27:16', NULL),
(1097, '15', '4', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1098, '15', '10', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1099, '15', '13', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1100, '15', '17', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1101, '15', '26', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1102, '15', '35', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1103, '15', '42', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1104, '15', '44', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1105, '15', '45', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1106, '15', '46', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1107, '15', '56', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1108, '15', '59', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1109, '15', '60', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1110, '15', '64', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1111, '15', '66', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1112, '15', '74', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1113, '15', '75', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1114, '15', '76', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1115, '15', '77', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1116, '15', '78', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1117, '15', '80', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1118, '15', '82', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1119, '15', '84', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1120, '15', '92', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1121, '15', '95', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1122, '15', '100', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1123, '15', '101', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1124, '15', '102', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1125, '15', '103', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1126, '15', '106', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1127, '15', '109', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1128, '15', '113', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1129, '15', '116', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1130, '15', '124', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1131, '15', '129', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1132, '15', '130', '2021-02-17 15:08:54', '2021-02-17 15:08:54', NULL),
(1133, '15', '136', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1134, '15', '137', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1135, '15', '138', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1136, '15', '140', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1137, '15', '147', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1138, '15', '149', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1139, '15', '151', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1140, '15', '154', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1141, '15', '155', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1142, '15', '156', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1143, '15', '161', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1144, '15', '166', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1145, '15', '167', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1146, '15', '177', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1147, '15', '188', '2021-02-17 15:08:55', '2021-02-17 15:08:55', NULL),
(1501, '21', '1', '2021-02-18 08:36:05', '2021-02-18 08:36:05', NULL),
(1502, '21', '2', '2021-02-18 08:36:05', '2021-02-18 08:36:05', NULL),
(1503, '21', '3', '2021-02-18 08:36:05', '2021-02-18 08:36:05', NULL),
(1504, '21', '4', '2021-02-18 08:36:05', '2021-02-18 08:36:05', NULL),
(1505, '21', '5', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1506, '21', '6', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1507, '21', '7', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1508, '21', '8', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1509, '21', '9', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1510, '21', '10', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1511, '21', '11', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1512, '21', '12', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1513, '21', '13', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1514, '21', '14', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1515, '21', '15', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1516, '21', '16', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1517, '21', '17', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1518, '21', '18', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1519, '21', '19', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1520, '21', '20', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1521, '21', '21', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1522, '21', '22', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1523, '21', '23', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1524, '21', '24', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1525, '21', '25', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1526, '21', '26', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1527, '21', '27', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1528, '21', '28', '2021-02-18 08:36:06', '2021-02-18 08:36:06', NULL),
(1529, '21', '29', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1530, '21', '30', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1531, '21', '31', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1532, '21', '32', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1533, '21', '33', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1534, '21', '34', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1535, '21', '35', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1536, '21', '36', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1537, '21', '37', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1538, '21', '38', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1539, '21', '39', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1540, '21', '40', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1541, '21', '41', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1542, '21', '42', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1543, '21', '43', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1544, '21', '44', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1545, '21', '45', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1546, '21', '46', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1547, '21', '47', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1548, '21', '48', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1549, '21', '49', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1550, '21', '50', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1551, '21', '51', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1552, '21', '52', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1553, '21', '53', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1554, '21', '54', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1555, '21', '55', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1556, '21', '56', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1557, '21', '57', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1558, '21', '58', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1559, '21', '59', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1560, '21', '60', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1561, '21', '61', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1562, '21', '62', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1563, '21', '63', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1564, '21', '64', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1565, '21', '65', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1566, '21', '66', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1567, '21', '67', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1568, '21', '68', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1569, '21', '69', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1570, '21', '70', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1571, '21', '71', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1572, '21', '72', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1573, '21', '73', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1574, '21', '74', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1575, '21', '75', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1576, '21', '76', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1577, '21', '77', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1578, '21', '78', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1579, '21', '79', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1580, '21', '80', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1581, '21', '81', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1582, '21', '82', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1583, '21', '83', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1584, '21', '84', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1585, '21', '85', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1586, '21', '86', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1587, '21', '87', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1588, '21', '88', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1589, '21', '89', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1590, '21', '90', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1591, '21', '91', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1592, '21', '92', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1593, '21', '93', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1594, '21', '94', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1595, '21', '95', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1596, '21', '96', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1597, '21', '97', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1598, '21', '98', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1599, '21', '99', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1600, '21', '100', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1601, '21', '101', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1602, '21', '102', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1603, '21', '103', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1604, '21', '104', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1605, '21', '105', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1606, '21', '106', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1607, '21', '107', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1608, '21', '108', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1609, '21', '109', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1610, '21', '110', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1611, '21', '111', '2021-02-18 08:36:07', '2021-02-18 08:36:07', NULL),
(1612, '21', '112', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1613, '21', '113', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1614, '21', '114', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1615, '21', '115', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1616, '21', '116', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1617, '21', '117', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1618, '21', '118', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1619, '21', '119', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1620, '21', '120', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1621, '21', '121', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1622, '21', '122', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1623, '21', '123', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1624, '21', '124', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1625, '21', '125', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1626, '21', '126', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1627, '21', '127', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1628, '21', '128', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1629, '21', '129', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1630, '21', '130', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1631, '21', '131', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1632, '21', '132', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1633, '21', '133', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1634, '21', '134', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1635, '21', '135', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1636, '21', '136', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1637, '21', '137', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1638, '21', '138', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1639, '21', '139', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1640, '21', '140', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1641, '21', '141', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1642, '21', '142', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1643, '21', '143', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1644, '21', '144', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1645, '21', '145', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1646, '21', '146', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1647, '21', '147', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1648, '21', '148', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1649, '21', '149', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1650, '21', '150', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1651, '21', '151', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1652, '21', '152', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1653, '21', '153', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1654, '21', '154', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1655, '21', '155', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1656, '21', '156', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1657, '21', '157', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1658, '21', '158', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1659, '21', '159', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1660, '21', '160', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1661, '21', '161', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1662, '21', '162', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1663, '21', '163', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1664, '21', '164', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1665, '21', '165', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1666, '21', '166', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1667, '21', '167', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1668, '21', '168', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1669, '21', '169', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1670, '21', '170', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1671, '21', '171', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1672, '21', '172', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1673, '21', '173', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1674, '21', '174', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1675, '21', '175', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1676, '21', '176', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1677, '21', '177', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1678, '21', '178', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1679, '21', '179', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1680, '21', '180', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1681, '21', '181', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1682, '21', '182', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1683, '21', '183', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1684, '21', '184', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1685, '21', '185', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1686, '21', '186', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1687, '21', '187', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1688, '21', '188', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1689, '21', '189', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1690, '21', '190', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1691, '21', '191', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1692, '21', '192', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1693, '21', '193', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1694, '21', '194', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1695, '21', '195', '2021-02-18 08:36:08', '2021-02-18 08:36:08', NULL),
(1770, '22', '99', '2021-02-18 08:50:41', '2021-02-18 08:50:41', NULL),
(1771, '22', '128', '2021-02-18 08:50:41', '2021-02-18 08:50:41', NULL),
(1772, '22', '168', '2021-02-18 08:50:41', '2021-02-18 08:50:41', NULL),
(1773, '22', '191', '2021-02-18 08:50:41', '2021-02-18 08:50:41', NULL),
(1774, '22', '195', '2021-02-18 08:50:41', '2021-02-18 08:50:41', NULL),
(1775, '10', '5', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1776, '10', '19', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1777, '10', '23', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1778, '10', '27', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1779, '10', '29', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1780, '10', '31', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1781, '10', '32', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1782, '10', '33', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1783, '10', '37', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1784, '10', '38', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1785, '10', '39', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1786, '10', '41', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1787, '10', '47', '2021-02-18 08:51:21', '2021-02-18 08:51:21', NULL),
(1788, '10', '54', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1789, '10', '55', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1790, '10', '57', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1791, '10', '61', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1792, '10', '65', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1793, '10', '69', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1794, '10', '87', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1795, '10', '97', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1796, '10', '98', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1797, '10', '104', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1798, '10', '105', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1799, '10', '108', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1800, '10', '111', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1801, '10', '112', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1802, '10', '119', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1803, '10', '121', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1804, '10', '127', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1805, '10', '142', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1806, '10', '152', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1807, '10', '158', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1808, '10', '159', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1809, '10', '171', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1810, '10', '173', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1811, '10', '180', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1812, '10', '192', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1813, '10', '193', '2021-02-18 08:51:22', '2021-02-18 08:51:22', NULL),
(1980, '23', '2', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1981, '23', '9', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1982, '23', '10', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1983, '23', '17', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1984, '23', '26', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1985, '23', '30', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1986, '23', '42', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1987, '23', '44', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1988, '23', '45', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1989, '23', '46', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1990, '23', '56', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1991, '23', '59', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1992, '23', '60', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1993, '23', '64', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1994, '23', '66', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1995, '23', '74', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1996, '23', '80', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1997, '23', '82', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1998, '23', '89', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(1999, '23', '90', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2000, '23', '95', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2001, '23', '100', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2002, '23', '101', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2003, '23', '102', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2004, '23', '103', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2005, '23', '109', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2006, '23', '115', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2007, '23', '116', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2008, '23', '118', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2009, '23', '124', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2010, '23', '129', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2011, '23', '137', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2012, '23', '138', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2013, '23', '140', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2014, '23', '141', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2015, '23', '147', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2016, '23', '151', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2017, '23', '155', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2018, '23', '156', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2019, '23', '161', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2020, '23', '166', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2021, '23', '167', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2022, '23', '181', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2023, '23', '183', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2024, '23', '184', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2025, '23', '188', '2021-02-19 01:37:25', '2021-02-19 01:37:25', NULL),
(2599, '24', '1', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2600, '24', '2', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2601, '24', '3', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2602, '24', '4', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2603, '24', '5', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2604, '24', '6', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2605, '24', '7', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2606, '24', '8', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2607, '24', '9', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2608, '24', '10', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2609, '24', '11', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2610, '24', '12', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2611, '24', '13', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2612, '24', '14', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2613, '24', '15', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2614, '24', '16', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2615, '24', '17', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2616, '24', '18', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2617, '24', '19', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2618, '24', '20', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2619, '24', '21', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2620, '24', '22', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2621, '24', '23', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2622, '24', '24', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2623, '24', '25', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2624, '24', '26', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2625, '24', '27', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2626, '24', '28', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2627, '24', '29', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2628, '24', '30', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2629, '24', '31', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2630, '24', '34', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2631, '24', '35', '2021-02-19 09:32:08', '2021-02-19 09:32:08', NULL),
(2632, '24', '36', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2633, '24', '37', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2634, '24', '38', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2635, '24', '40', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2636, '24', '42', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2637, '24', '43', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2638, '24', '44', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2639, '24', '45', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2640, '24', '46', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2641, '24', '48', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2642, '24', '49', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2643, '24', '50', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2644, '24', '51', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2645, '24', '53', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2646, '24', '54', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2647, '24', '56', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2648, '24', '58', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2649, '24', '59', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2650, '24', '60', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2651, '24', '61', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2652, '24', '62', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2653, '24', '63', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2654, '24', '64', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2655, '24', '65', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2656, '24', '66', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2657, '24', '67', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2658, '24', '68', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2659, '24', '69', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2660, '24', '70', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2661, '24', '71', '2021-02-19 09:32:09', '2021-02-19 09:32:09', NULL),
(2662, '24', '72', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2663, '24', '73', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2664, '24', '74', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2665, '24', '75', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2666, '24', '76', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2667, '24', '77', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2668, '24', '78', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2669, '24', '79', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2670, '24', '80', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2671, '24', '81', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2672, '24', '82', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2673, '24', '83', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2674, '24', '84', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2675, '24', '85', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2676, '24', '86', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2677, '24', '87', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2678, '24', '88', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2679, '24', '89', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2680, '24', '91', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2681, '24', '92', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2682, '24', '93', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2683, '24', '94', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2684, '24', '95', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2685, '24', '96', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2686, '24', '97', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2687, '24', '98', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2688, '24', '99', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2689, '24', '100', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2690, '24', '101', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2691, '24', '102', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2692, '24', '103', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2693, '24', '104', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2694, '24', '105', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2695, '24', '106', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2696, '24', '107', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2697, '24', '108', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2698, '24', '109', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2699, '24', '110', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2700, '24', '111', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2701, '24', '112', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2702, '24', '113', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2703, '24', '114', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2704, '24', '115', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2705, '24', '116', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2706, '24', '117', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2707, '24', '118', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2708, '24', '119', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2709, '24', '120', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2710, '24', '121', '2021-02-19 09:32:10', '2021-02-19 09:32:10', NULL),
(2711, '24', '122', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2712, '24', '123', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2713, '24', '124', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2714, '24', '125', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2715, '24', '126', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2716, '24', '127', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2717, '24', '129', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2718, '24', '130', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2719, '24', '131', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2720, '24', '132', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2721, '24', '133', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2722, '24', '134', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2723, '24', '135', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2724, '24', '136', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2725, '24', '137', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2726, '24', '138', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2727, '24', '139', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2728, '24', '140', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2729, '24', '141', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2730, '24', '142', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2731, '24', '143', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2732, '24', '144', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2733, '24', '145', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2734, '24', '146', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2735, '24', '147', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2736, '24', '148', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2737, '24', '149', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2738, '24', '150', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2739, '24', '151', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2740, '24', '152', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2741, '24', '153', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2742, '24', '154', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2743, '24', '155', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2744, '24', '156', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2745, '24', '157', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2746, '24', '159', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2747, '24', '160', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2748, '24', '161', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2749, '24', '162', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2750, '24', '163', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2751, '24', '164', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2752, '24', '165', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2753, '24', '166', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2754, '24', '167', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2755, '24', '168', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2756, '24', '169', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2757, '24', '170', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2758, '24', '171', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2759, '24', '172', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2760, '24', '173', '2021-02-19 09:32:11', '2021-02-19 09:32:11', NULL),
(2761, '24', '174', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2762, '24', '175', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2763, '24', '176', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2764, '24', '177', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2765, '24', '178', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2766, '24', '179', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2767, '24', '180', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2768, '24', '181', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2769, '24', '183', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2770, '24', '184', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2771, '24', '185', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2772, '24', '186', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2773, '24', '187', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2774, '24', '188', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2775, '24', '189', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2776, '24', '190', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2777, '24', '191', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2778, '24', '192', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2779, '24', '193', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2780, '24', '194', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2781, '24', '195', '2021-02-19 09:32:12', '2021-02-19 09:32:12', NULL),
(2870, '25', '4', '2021-02-19 12:44:04', '2021-02-19 12:44:04', NULL),
(2871, '25', '9', '2021-02-19 12:44:04', '2021-02-19 12:44:04', NULL),
(2872, '25', '10', '2021-02-19 12:44:04', '2021-02-19 12:44:04', NULL),
(2873, '25', '17', '2021-02-19 12:44:04', '2021-02-19 12:44:04', NULL),
(2874, '25', '25', '2021-02-19 12:44:04', '2021-02-19 12:44:04', NULL),
(2875, '25', '26', '2021-02-19 12:44:04', '2021-02-19 12:44:04', NULL),
(2876, '25', '30', '2021-02-19 12:44:04', '2021-02-19 12:44:04', NULL),
(2877, '25', '35', '2021-02-19 12:44:04', '2021-02-19 12:44:04', NULL),
(2878, '25', '44', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2879, '25', '45', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2880, '25', '46', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2881, '25', '56', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2882, '25', '59', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2883, '25', '64', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2884, '25', '66', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2885, '25', '74', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2886, '25', '75', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2887, '25', '82', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2888, '25', '84', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2889, '25', '86', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2890, '25', '90', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2891, '25', '95', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2892, '25', '100', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2893, '25', '101', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2894, '25', '102', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2895, '25', '106', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2896, '25', '116', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2897, '25', '118', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2898, '25', '124', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2899, '25', '125', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2900, '25', '129', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2901, '25', '137', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2902, '25', '138', '2021-02-19 12:44:05', '2021-02-19 12:44:05', NULL),
(2903, '25', '141', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2904, '25', '147', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2905, '25', '154', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2906, '25', '155', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2907, '25', '156', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2908, '25', '161', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2909, '25', '166', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2910, '25', '167', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2911, '25', '181', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2912, '25', '183', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2913, '25', '184', '2021-02-19 12:44:06', '2021-02-19 12:44:06', NULL),
(2918, '20', '1', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2919, '20', '14', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2920, '20', '29', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2921, '20', '65', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2922, '20', '99', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2923, '20', '128', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2924, '20', '131', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2925, '20', '168', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2926, '20', '191', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2927, '20', '195', '2021-02-26 23:52:04', '2021-02-26 23:52:04', NULL),
(2928, '19', '5', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2929, '19', '19', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2930, '19', '23', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2931, '19', '27', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2932, '19', '31', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2933, '19', '32', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2934, '19', '33', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2935, '19', '37', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2936, '19', '38', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2937, '19', '39', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2938, '19', '41', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2939, '19', '47', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2940, '19', '54', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2941, '19', '55', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2942, '19', '57', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2943, '19', '61', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2944, '19', '69', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2945, '19', '87', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2946, '19', '97', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2947, '19', '98', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2948, '19', '99', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2949, '19', '104', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2950, '19', '105', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2951, '19', '108', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2952, '19', '111', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2953, '19', '112', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2954, '19', '119', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2955, '19', '121', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2956, '19', '127', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2957, '19', '142', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2958, '19', '152', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2959, '19', '158', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2960, '19', '159', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2961, '19', '163', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2962, '19', '171', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2963, '19', '173', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2964, '19', '176', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL);
INSERT INTO `from_countries` (`id`, `country_visa_id`, `from_country_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2965, '19', '180', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2966, '19', '192', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2967, '19', '193', '2021-02-26 23:52:45', '2021-02-26 23:52:45', NULL),
(2968, '18', '184', '2021-02-26 23:53:11', '2021-02-26 23:53:11', NULL),
(2969, '16', '28', '2021-02-26 23:53:32', '2021-02-26 23:53:32', NULL),
(2970, '16', '76', '2021-02-26 23:53:32', '2021-02-26 23:53:32', NULL),
(2971, '16', '84', '2021-02-26 23:53:32', '2021-02-26 23:53:32', NULL),
(3742, '12', '76', '2021-03-16 23:15:56', '2021-03-16 23:15:56', NULL),
(3743, '12', '123', '2021-03-16 23:15:56', '2021-03-16 23:15:56', NULL),
(3744, '12', '136', '2021-03-16 23:15:56', '2021-03-16 23:15:56', NULL),
(3745, '12', '162', '2021-03-16 23:15:56', '2021-03-16 23:15:56', NULL),
(3746, '27', '1', '2021-03-17 04:20:32', '2021-03-17 04:20:32', NULL),
(3747, '27', '29', '2021-03-17 04:20:32', '2021-03-17 04:20:32', NULL),
(3748, '27', '38', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3749, '27', '39', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3750, '27', '41', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3751, '27', '61', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3752, '27', '65', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3753, '27', '69', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3754, '27', '70', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3755, '27', '87', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3756, '27', '89', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3757, '27', '98', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3758, '27', '108', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3759, '27', '120', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3760, '27', '128', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3761, '27', '131', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3762, '27', '153', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3763, '27', '160', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3764, '27', '163', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3765, '27', '168', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3766, '27', '180', '2021-03-17 04:20:33', '2021-03-17 04:20:33', NULL),
(3767, '26', '2', '2021-03-18 01:34:09', '2021-03-18 01:34:09', NULL),
(3768, '26', '3', '2021-03-18 01:34:09', '2021-03-18 01:34:09', NULL),
(3769, '26', '4', '2021-03-18 01:34:09', '2021-03-18 01:34:09', NULL),
(3770, '26', '5', '2021-03-18 01:34:09', '2021-03-18 01:34:09', NULL),
(3771, '26', '6', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3772, '26', '7', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3773, '26', '8', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3774, '26', '9', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3775, '26', '10', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3776, '26', '11', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3777, '26', '12', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3778, '26', '13', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3779, '26', '14', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3780, '26', '15', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3781, '26', '16', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3782, '26', '17', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3783, '26', '18', '2021-03-18 01:34:10', '2021-03-18 01:34:10', NULL),
(3784, '26', '20', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3785, '26', '21', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3786, '26', '22', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3787, '26', '23', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3788, '26', '24', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3789, '26', '25', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3790, '26', '26', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3791, '26', '27', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3792, '26', '28', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3793, '26', '30', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3794, '26', '31', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3795, '26', '33', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3796, '26', '34', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3797, '26', '35', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3798, '26', '36', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3799, '26', '37', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3800, '26', '40', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3801, '26', '42', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3802, '26', '43', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3803, '26', '44', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3804, '26', '45', '2021-03-18 01:34:11', '2021-03-18 01:34:11', NULL),
(3805, '26', '46', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3806, '26', '47', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3807, '26', '48', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3808, '26', '49', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3809, '26', '50', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3810, '26', '51', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3811, '26', '53', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3812, '26', '54', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3813, '26', '55', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3814, '26', '56', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3815, '26', '57', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3816, '26', '58', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3817, '26', '59', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3818, '26', '60', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3819, '26', '62', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3820, '26', '63', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3821, '26', '64', '2021-03-18 01:34:12', '2021-03-18 01:34:12', NULL),
(3822, '26', '66', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3823, '26', '67', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3824, '26', '68', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3825, '26', '69', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3826, '26', '70', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3827, '26', '71', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3828, '26', '72', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3829, '26', '73', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3830, '26', '74', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3831, '26', '75', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3832, '26', '76', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3833, '26', '77', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3834, '26', '78', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3835, '26', '79', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3836, '26', '80', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3837, '26', '81', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3838, '26', '82', '2021-03-18 01:34:13', '2021-03-18 01:34:13', NULL),
(3839, '26', '83', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3840, '26', '84', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3841, '26', '85', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3842, '26', '86', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3843, '26', '88', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3844, '26', '89', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3845, '26', '90', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3846, '26', '91', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3847, '26', '92', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3848, '26', '93', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3849, '26', '94', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3850, '26', '95', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3851, '26', '96', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3852, '26', '97', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3853, '26', '99', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3854, '26', '100', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3855, '26', '101', '2021-03-18 01:34:14', '2021-03-18 01:34:14', NULL),
(3856, '26', '102', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3857, '26', '103', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3858, '26', '104', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3859, '26', '105', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3860, '26', '106', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3861, '26', '107', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3862, '26', '109', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3863, '26', '110', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3864, '26', '111', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3865, '26', '112', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3866, '26', '113', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3867, '26', '114', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3868, '26', '115', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3869, '26', '116', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3870, '26', '117', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3871, '26', '118', '2021-03-18 01:34:15', '2021-03-18 01:34:15', NULL),
(3872, '26', '119', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3873, '26', '121', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3874, '26', '122', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3875, '26', '123', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3876, '26', '124', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3877, '26', '125', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3878, '26', '126', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3879, '26', '127', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3880, '26', '129', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3881, '26', '130', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3882, '26', '132', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3883, '26', '133', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3884, '26', '134', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3885, '26', '135', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3886, '26', '136', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3887, '26', '137', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3888, '26', '138', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3889, '26', '139', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3890, '26', '140', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3891, '26', '141', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3892, '26', '142', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3893, '26', '143', '2021-03-18 01:34:16', '2021-03-18 01:34:16', NULL),
(3894, '26', '145', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3895, '26', '146', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3896, '26', '147', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3897, '26', '148', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3898, '26', '149', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3899, '26', '150', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3900, '26', '151', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3901, '26', '152', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3902, '26', '154', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3903, '26', '155', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3904, '26', '156', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3905, '26', '157', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3906, '26', '158', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3907, '26', '159', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3908, '26', '161', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3909, '26', '162', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3910, '26', '164', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3911, '26', '165', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3912, '26', '166', '2021-03-18 01:34:17', '2021-03-18 01:34:17', NULL),
(3913, '26', '167', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3914, '26', '169', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3915, '26', '170', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3916, '26', '171', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3917, '26', '172', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3918, '26', '175', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3919, '26', '176', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3920, '26', '177', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3921, '26', '178', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3922, '26', '179', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3923, '26', '181', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3924, '26', '182', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3925, '26', '183', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3926, '26', '184', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3927, '26', '185', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3928, '26', '186', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3929, '26', '187', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3930, '26', '188', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3931, '26', '189', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3932, '26', '190', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3933, '26', '191', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3934, '26', '192', '2021-03-18 01:34:18', '2021-03-18 01:34:18', NULL),
(3935, '26', '193', '2021-03-18 01:34:19', '2021-03-18 01:34:19', NULL),
(3936, '26', '194', '2021-03-18 01:34:19', '2021-03-18 01:34:19', NULL),
(3937, '26', '195', '2021-03-18 01:34:19', '2021-03-18 01:34:19', NULL),
(3938, '11', '3', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3939, '11', '8', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3940, '11', '21', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3941, '11', '51', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3942, '11', '52', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3943, '11', '78', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3944, '11', '85', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3945, '11', '93', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3946, '11', '96', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3947, '11', '131', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3948, '11', '170', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3949, '11', '176', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3950, '11', '177', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3951, '11', '178', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3952, '11', '186', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3953, '11', '189', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3954, '11', '194', '2021-04-03 01:47:19', '2021-04-03 01:47:19', NULL),
(3955, '28', '3', '2021-04-04 23:27:56', '2021-04-04 23:28:13', '2021-04-04 23:28:13'),
(3960, '29', '3', '2021-04-13 04:41:50', '2021-04-13 04:41:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_00_00_000000_create_settings_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2018_03_08_050743_create_permission_tables', 1),
(5, '2019_10_12_0000056_create_rating_reviews_table', 1),
(6, '2019_11_28_173353_create_cms_table', 1),
(7, '2020_03_30_090456_create_visa_types_table', 1),
(8, '2020_03_31_103918_create_visa_type_entries_table', 1),
(9, '2020_04_01_070308_create_country_wise_visas_table', 1),
(10, '2020_04_01_072825_create_script_table', 1),
(11, '2020_04_01_113400_create_transactions_table', 1),
(12, '2020_04_02_073202_create_country_table', 1),
(13, '2020_04_02_081256_create_prices_table', 1),
(14, '2020_04_06_044227_create_email_templates_table', 1),
(15, '2020_04_07_060444_create_products_table', 1),
(16, '2020_04_08_105919_create_contact_us_table', 1),
(17, '2020_04_13_062813_create_embassy_table', 1),
(18, '2020_04_13_090150_create_blog_table', 1),
(19, '2020_04_17_112539_create_pre_post_payment_table', 1),
(20, '2020_04_20_103800_add_to_columns_permission_table', 1),
(21, '2020_04_22_064020_create_faqs_table', 1),
(22, '2020_04_29_123539_create_visa_applications_table', 1),
(23, '2020_04_29_123607_create_visa_applicants_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifiction`
--

CREATE TABLE `notifiction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_expiry` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `profile_image_update` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `visa_statua_update` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifiction`
--

INSERT INTO `notifiction` (`id`, `user_id`, `passport_expiry`, `profile_image_update`, `visa_statua_update`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7', 'block', 'active', 'block', '2020-05-06 23:28:52', '2021-03-05 02:01:03', NULL),
(2, '1', 'active', 'block', 'block', '2020-05-06 23:28:52', '2020-05-20 03:49:24', NULL),
(3, '2', 'active', 'block', 'block', '2020-05-06 23:28:52', '2020-05-20 03:49:24', NULL),
(4, '3', 'active', 'block', 'block', '2020-05-06 23:28:52', '2020-05-20 03:49:24', NULL),
(5, '4', 'active', 'block', 'block', '2020-05-06 23:28:52', '2020-05-20 03:49:24', NULL),
(6, '5', 'active', 'block', 'block', '2020-05-06 23:28:52', '2020-05-20 03:49:24', NULL),
(7, '6', 'active', 'block', 'block', '2020-05-06 23:28:52', '2020-05-20 03:49:24', NULL),
(8, '16', 'active', 'active', 'active', '2021-03-16 05:56:33', '2021-03-16 05:56:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_country`
--

CREATE TABLE `payment_country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_country`
--

INSERT INTO `payment_country` (`id`, `country_id`, `visa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3', '2', '2020-06-09 22:07:14', '2020-06-09 22:07:14', NULL),
(2, '4', '3', '2020-06-09 22:07:31', '2020-06-09 22:07:31', NULL),
(3, '2', '2', '2020-06-10 00:46:46', '2020-06-10 00:46:46', NULL),
(4, '3', '2', '2020-06-15 23:35:52', '2020-06-15 23:35:52', NULL),
(5, '182', '3', '2021-02-14 04:13:34', '2021-02-18 02:44:28', NULL),
(6, '182', '3', '2021-02-14 04:15:07', '2021-02-18 02:42:19', NULL),
(7, '141', '1', '2021-02-15 11:23:20', '2021-02-18 02:28:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `module_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `module_name`) VALUES
(1, 'user-list', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'User Management'),
(2, 'user-create', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'User Management'),
(3, 'user-edit', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'User Management'),
(4, 'user-delete', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'User Management'),
(5, 'emb-list', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Embassy Management'),
(6, 'emb-create', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Embassy Management'),
(7, 'emb-edit', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Embassy Management'),
(8, 'emb-delete', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Embassy Management'),
(9, 'visa-list', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Visa Management'),
(10, 'visa-create', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Visa Management'),
(11, 'visa-edit', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Visa Management'),
(12, 'visa-delete', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Visa Management'),
(13, 'visatype-list', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'VisaType Management'),
(14, 'visatype-create', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'VisaType Management'),
(15, 'visatype-edit', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'VisaType Management'),
(16, 'visatype-delete', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'VisaType Management'),
(17, 'country-list', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Country Management'),
(18, 'country-create', 'web', '2020-04-30 04:27:38', '2020-04-30 04:27:38', 'Country Management'),
(19, 'country-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Country Management'),
(20, 'country-delete', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Country Management'),
(21, 'role-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Role Management'),
(22, 'role-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Role Management'),
(23, 'countrywisevisa-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Country Wise Visa Management'),
(24, 'countrywisevisa-create', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Country Wise Visa Management'),
(25, 'countrywisevisa-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Country Wise Visa Management'),
(26, 'countrywisevisa-delete', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Country Wise Visa Management'),
(27, 'price-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Price Management'),
(28, 'price-create', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Price Management'),
(29, 'price-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Price Management'),
(30, 'price-delete', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Price Management'),
(31, 'referral-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Referral Management'),
(32, 'question-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Question Management'),
(33, 'question-create', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Question Management'),
(34, 'question-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Question Management'),
(35, 'question-delete', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Question Management'),
(36, 'email-template-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Email Templates'),
(37, 'email-template-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Email Templates'),
(38, 'transaction-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Report Management'),
(39, 'cms-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Cms Management'),
(40, 'cms-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Cms Management'),
(41, 'faq-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Faq'),
(42, 'faq-create', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Faq'),
(43, 'faq-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Faq'),
(44, 'faq-delete', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Faq'),
(45, 'setting-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Setting Management'),
(46, 'setting-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Setting Management'),
(47, 'script-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Script Management'),
(48, 'blog-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Blog Management'),
(49, 'blog-create', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Blog Management'),
(50, 'blog-edit', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Blog Management'),
(51, 'blog-delete', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Blog Management'),
(52, 'order-list', 'web', '2020-04-29 22:57:39', '2020-04-29 22:57:39', 'Order Status'),
(53, 'feedback-list', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'FeedBack Management'),
(54, 'inquiry-list', 'web', '2020-04-29 22:57:39', '2020-04-29 22:57:39', 'Inquiry Management'),
(55, 'inquiry-delete', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'Inquiry Management');

-- --------------------------------------------------------

--
-- Table structure for table `pre_post_payment`
--

CREATE TABLE `pre_post_payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_type` enum('text','drop-down','datepicker') COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_droup` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tooltip` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` enum('pre','post') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `proceed` enum('0','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_question` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_ans_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_note` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_tooltip` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_proceed` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_add_drop` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_question` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_ans_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pre_post_payment`
--

INSERT INTO `pre_post_payment` (`id`, `u_id`, `question`, `answer`, `answer_type`, `add_droup`, `note`, `tooltip`, `payment_status`, `status`, `proceed`, `sub_question`, `sub_ans_type`, `sub_note`, `sub_tooltip`, `sub_proceed`, `sub_add_drop`, `last_question`, `last_ans_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'when were you born', NULL, 'datepicker', NULL, NULL, NULL, 'pre', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-09 22:07:14', '2021-02-14 04:12:05', '2021-02-14 04:12:05'),
(2, '2', 'what is you name', NULL, 'text', NULL, NULL, NULL, 'pre', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-09 22:07:31', '2021-02-14 04:11:59', '2021-02-14 04:11:59'),
(3, '3', 'are you pakistani', NULL, 'drop-down', 'no', 'yes i am', 'offcouse i am', 'pre', 'active', '1', 'do you have passport', 'drop-down', 'test note', 'passport must have', '1', 'no', 'any co passenger with you', 'text', '2020-06-10 00:46:46', '2021-02-14 04:11:54', '2021-02-14 04:11:54'),
(4, '4', 'test question', NULL, 'drop-down', 'no', 'yes i am', 'offcouse i am', 'post', 'active', '1', 'do you have passport', 'drop-down', 'test note', 'passport must have', '1', 'no', 'any co passenger with you', 'text', '2020-06-15 23:35:53', '2021-04-13 05:18:44', NULL),
(5, '5', 'Are you travelling to look for a JOB?', NULL, 'drop-down', 'no', 'Yes', 'Are you travelling to look for a job?', 'pre', 'active', '0', NULL, NULL, NULL, NULL, NULL, 'no', 'offer letter', 'text', '2021-02-14 04:13:34', '2021-02-18 02:44:28', NULL),
(6, '6', 'Have you been in UAE before?', NULL, 'drop-down', 'yes', 'Yes or No', 'is it your first time to UAE?', 'pre', 'active', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-14 04:15:07', '2021-02-18 02:42:19', NULL),
(7, '7', 'Are you going to stay more than 15 days?', NULL, 'drop-down', NULL, 'Yes', 'This Visa is valid for only 16 Days and Cannot be extended, Choose Another Option.', 'pre', 'active', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-15 11:23:20', '2021-02-18 02:28:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_type_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('pickup','drop-off','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `amount` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `country_id`, `visa_type_id`, `status`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '172', '3', 'drop-off', '15', '2020-05-04 16:56:00', '2020-05-04 16:58:00', NULL),
(2, '172', '3', 'pickup', '15', '2020-05-04 16:58:27', '2020-05-04 16:58:27', NULL),
(3, '141', '5', 'drop-off', '50', '2021-02-14 04:09:52', '2021-02-14 04:11:27', NULL),
(4, '141', '5', 'pickup', '0', '2021-02-14 04:10:20', '2021-02-14 04:10:20', NULL),
(5, '52', '5', 'pickup', '0', '2021-02-14 04:10:51', '2021-02-14 04:10:51', NULL),
(6, '52', '5', 'drop-off', '50', '2021-02-14 04:11:14', '2021-02-14 04:11:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_reviews`
--

CREATE TABLE `rating_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviews` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39'),
(2, 'user', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(3, 'back Office 1', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(4, 'back Office 2', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(5, 'back Office 3', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(6, 'back Office 4', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(7, 'back Office 5', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(8, 'back Office 6', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(9, 'back Office 7', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(10, 'back Office 8', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(11, 'back Office 9', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40'),
(12, 'back Office 10', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 12),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `script`
--

CREATE TABLE `script` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_script` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `body_script` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_script` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `script`
--

INSERT INTO `script` (`id`, `header_script`, `body_script`, `footer_script`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<!-- Google Tag Manager (noscript) -->\r\n<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-XXXX\"\r\nheight=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>\r\n<!-- End Google Tag Manager (noscript) -->', '<!-- Google Tag Manager (noscript) -->\r\n<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-XXXX\"\r\nheight=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>\r\n<!-- End Google Tag Manager (noscript) -->', 'Lorem Ipsum', '2020-04-30 04:27:38', '2020-06-02 23:51:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('BOOLEAN','NUMBER','DATE','TEXT','SELECT','FILE','TEXTAREA') COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `type`, `label`, `value`, `hidden`, `created_at`, `updated_at`) VALUES
(1, 'site_logo', 'FILE', 'Site Logo', 'site_logo.png', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38'),
(2, 'project_title', 'TEXT', 'Project Title', 'URGENT E-VISA', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38'),
(3, 'whatapp_number', 'NUMBER', 'Whatapp Number', '30', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38'),
(4, 'favicon_logo', 'FILE', 'favicon Logo', 'favicon_logo.jpg', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38'),
(5, 'fb_link', 'TEXT', 'Facebook Link', 'https://www.Facebook.com/', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38'),
(6, 'twitter_link', 'TEXT', 'Twitter Link', 'https://www.Twitter.com/', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38'),
(7, 'instagram_link', 'TEXT', 'Instagram Link', 'https://www.Instagram.com/', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38'),
(8, 'linkedin_link', 'TEXT', 'Linkedin Link', 'https://www.Linkedin.com/', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38'),
(9, 'address', 'TEXT', 'address', 'Al Khaleej Center, P.O.Box 8432, Dubai, UAE', 0, '2020-04-30 04:27:38', '2020-05-29 04:39:39'),
(10, 'whatsapp_number', 'NUMBER', 'whatsapp_number', '971566778825', 0, '2020-04-30 04:27:38', '2020-05-29 04:38:28'),
(11, 'footer_text', 'TEXT', 'footer_text', 'Urgentevisa.com. All rights reserved. Urgentevisa and Urgentevisa logo are registered trademarks of Urgentevisa.com.', 0, '2020-04-30 04:27:38', '2020-06-09 04:43:53'),
(12, 'slider_logo', 'FILE', 'Slider Logo', 'slider_logo.png', 0, '2020-04-30 04:27:38', '2020-04-30 04:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `site_setting`
--

CREATE TABLE `site_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` varchar(191) COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_setting`
--

INSERT INTO `site_setting` (`id`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 'site_maintenance', '0', '2019-11-17 14:19:20', '2021-04-23 07:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `color` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `color`, `created_at`, `updated_at`) VALUES
(1, '#0f4373', '2020-06-15 13:00:00', '2020-06-16 23:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` enum('success','pending','cancelled','reject') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_type` enum('visa','master') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'visa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `user_id`, `transaction_id`, `payment_status`, `payment_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'pending', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(2, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'cancelled', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(3, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'reject', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(4, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'reject', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(5, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'cancelled', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(6, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'pending', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(7, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'pending', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(8, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'pending', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(9, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'cancelled', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(10, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'success', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(11, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'success', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(12, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'success', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(13, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'success', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(14, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'success', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(15, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'success', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL),
(16, '2', '7', '6d1fc1cc-59d2-454b-a75c-5fce25c678fb', 'success', 'visa', '2020-06-06 04:19:12', '2020-06-06 04:19:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `encrypt_password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_photo` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_photo` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` enum('superadmin','user','bo_user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `language` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unique_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `ref_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `passport` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_issue_date` date DEFAULT NULL,
  `passport_expiry_date` date DEFAULT NULL,
  `wpmobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `social_status` enum('facebook','google','web') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'web',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `avatar_date` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `encrypt_password`, `user_photo`, `passport_photo`, `user_type`, `language`, `avatar`, `unique_id`, `status`, `ref_id`, `role_id`, `mobile`, `passport`, `passport_issue_date`, `passport_expiry_date`, `wpmobile`, `social_status`, `email_verified_at`, `avatar_date`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Khalid', 'khalid@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', NULL, NULL, NULL, 'superadmin', NULL, 'BSjJKEXNmq.png', '5EAAA1135DD83', 'active', NULL, '1', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:39', '2020-04-30 04:27:39', 'xJrtZbGk2iViRxwhVIEakmnSxI3H2TVOTJtn56x9A6iHlj4KecgTaIEFxZfS', '2020-04-30 04:27:39', '2021-02-04 06:22:13', NULL),
(2, 'BO Level 1', 'bolevel1@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA1142078B', 'active', NULL, '3', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'EbxWYVbbeGPPxacwa78fETReB4PZ2RQBOeaN0tVdiRQ1d7pA77m8lsLqymmp', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(3, 'BO Level 2', 'bolevel2@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA114225DA', 'active', NULL, '4', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'YwlEcELnLW', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(4, 'BO Level 3', 'bolevel3@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA11424664', 'active', NULL, '5', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'YI3UYMTHtq', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(5, 'lorem ipsum', 'loremipsum@mailinator.com', '$2y$10$/stQP8ylDXwqHsxfAf0BjO3lvcRDEqXjsl/7mOp5Tu856duefp8iK', NULL, NULL, NULL, 'user', NULL, 'QmdXGJttge.png', '5EABB7AE61547', 'active', NULL, '2', '1234567890', '1234567890', '2020-05-19', '2020-05-27', '1234567890', 'web', NULL, '2020-04-30 04:27:39', NULL, '2020-05-01 00:16:22', '2021-02-04 06:08:36', NULL),
(6, 'test', 'testuser@gmail.com', '$2y$10$jkaUQYwGqO77.CyNgs4gI.4f1eZy78GaflxTomVBtYb.CMQI6cngu', NULL, NULL, NULL, 'user', NULL, 'bF2QkoKsHR.png', '5EABEC491ACAE', 'active', NULL, '2', '7845348573', 'weeyr83457648ry34r438r', '2020-05-14', '2020-05-05', '4835634875', 'web', NULL, '2020-04-30 04:27:39', NULL, '2020-05-01 04:00:49', '2021-02-04 06:08:23', NULL),
(7, 'PHP1 Team', 'php1@aistechnolabs.co.uk', '$2y$10$JeSxFnMHTbRpKko6t1S58uePA88rvi9wJV5eIbvKhuaxeSNrGytBi', NULL, 'WiVF2L1les.jpg', '2V6RpEOnsU.jpg', 'user', NULL, 'HvhppeNfQw.png', '5EAC13A702BF6', 'active', NULL, '2', '43543543543', '34543543534', '2020-05-17', '2021-02-12', '65465465465', 'google', NULL, '2021-02-10 06:39:33', NULL, '2020-05-01 06:48:47', '2021-02-10 06:39:33', NULL),
(8, 'lorem', 'lorem@mailinator.com', '$2y$10$PMZLV7RT3hC2CYJvknFGUehlOksK/AaOqrxacphLbMIDVmBW92N5q', NULL, NULL, NULL, 'user', NULL, 'c6HtvIShop.png', '5EABB7AE61547', 'active', NULL, '2', '1234567899', '1234567899', '2020-05-19', '2020-05-27', '1234567890', 'web', NULL, '2020-04-30 04:27:39', NULL, '2020-05-01 00:16:22', '2021-02-04 06:09:00', NULL),
(9, 'BO Level 4', 'bolevel4@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA1142078B', 'active', NULL, '6', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'EbxWYVbbeGPPxacwa78fETReB4PZ2RQBOeaN0tVdiRQ1d7pA77m8lsLqymmp', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(10, 'BO Level 5', 'bolevel5@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA114225DA', 'active', NULL, '7', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'YwlEcELnLW', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(11, 'BO Level 6', 'bolevel6@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA11424664', 'active', NULL, '8', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'YI3UYMTHtq', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(12, 'BO Level 7', 'bolevel7@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA11424664', 'active', NULL, '9', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'U0slrXXqSdQiyXoNWI8yS6dG6afgNgFmDG6zsVTARFbVlrUNGOqMxnU2VcqS', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(13, 'BO Level 8', 'bolevel8@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA1142078B', 'active', NULL, '10', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'EbxWYVbbeGPPxacwa78fETReB4PZ2RQBOeaN0tVdiRQ1d7pA77m8lsLqymmp', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(14, 'BO Level 9', 'bolevel9@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA114225DA', 'active', NULL, '11', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'YwlEcELnLW', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(15, 'BO Level 10', 'bolevel10@aistechnolabs.xyz', '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', 'MTIzNDU2', NULL, NULL, 'bo_user', NULL, NULL, '5EAAA11424664', 'active', NULL, '12', '', NULL, NULL, NULL, '', 'web', '2020-04-30 04:27:40', '2020-04-30 04:27:39', 'SMhqdr7rKbL5EtDuRjXI5GsPxXN5LAk9jzFqD5KJ6vVOPedsTjY8PU6CzOJ5', '2020-04-30 04:27:40', '2020-04-30 04:27:40', NULL),
(16, 'PHP2 Team', 'php2@aistechnolabs.co.uk', '$2y$10$X9jdDQjMrOWDg7ZVUz.73OC2a4UsWAEsO.lTM7L43nBT0IQw0FRI2', NULL, NULL, NULL, 'user', NULL, 'default.png', '605095E9C463D', 'active', NULL, '2', '', NULL, NULL, NULL, '', 'google', NULL, '2021-03-15 18:30:00', NULL, '2021-03-16 05:56:33', '2021-03-17 04:25:48', '2021-03-17 04:25:48'),
(17, 'max', 'max@aistechnolabs.com', '$2y$10$2tXVVto4RKeqjS.8xfpgWOwsbyH3kSU0t7TTPWYMEV3O/dO5i8woa', NULL, NULL, NULL, 'user', NULL, 'default.png', '60680DC1DE6DA', 'active', NULL, '2', '', NULL, NULL, NULL, '', 'web', NULL, NULL, NULL, '2021-04-03 01:10:01', '2021-04-03 01:10:01', NULL),
(18, 'jaymin', 'jaymin@gmail.com', '$2y$10$GlFJFWVHLMWZgdAYiN5huui0a8Vn7EIqCGRAeyx9adggXDImbnnAy', NULL, NULL, NULL, 'user', NULL, 'default.png', '607571B228D0F', 'active', NULL, '2', '', NULL, NULL, NULL, '', 'web', NULL, NULL, NULL, '2021-04-13 04:55:54', '2021-04-13 04:55:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_ques_ans`
--

CREATE TABLE `user_ques_ans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_que` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_ans` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_que` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_ans` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_ques_ans`
--

INSERT INTO `user_ques_ans` (`id`, `user_id`, `application_id`, `question_id`, `answer`, `status`, `sub_que`, `sub_ans`, `last_que`, `last_ans`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7', NULL, '1', '05/07/2020', 'active', NULL, NULL, NULL, NULL, '2020-05-15 02:44:18', '2020-05-15 02:44:18', NULL),
(2, '7', NULL, '2', '05/07/2020', 'active', NULL, NULL, NULL, NULL, '2020-05-15 02:44:18', '2020-05-15 02:44:18', NULL),
(3, '7', NULL, '3', 'swapnil', 'active', NULL, NULL, NULL, NULL, '2020-05-15 02:44:18', '2020-05-15 02:44:18', NULL),
(4, '7', NULL, '1', 'swapnil', 'active', NULL, NULL, NULL, NULL, '2020-05-15 05:34:03', '2020-05-15 05:34:03', NULL),
(5, '7', NULL, '2', '05/08/2020', 'active', NULL, NULL, NULL, NULL, '2020-05-15 05:34:03', '2020-05-15 05:34:03', NULL),
(6, '7', NULL, '3', 'yes', 'active', NULL, NULL, NULL, NULL, '2020-05-15 05:34:03', '2020-05-15 05:34:03', NULL),
(7, '7', '3', '4', 'yes', 'active', NULL, NULL, NULL, NULL, '2021-02-16 01:39:46', '2021-02-16 01:39:46', NULL),
(8, '1', '4', '4', 'no', 'active', NULL, NULL, NULL, NULL, '2021-02-17 14:08:44', '2021-02-17 14:08:44', NULL),
(9, '1', '6', '4', 'yes', 'active', NULL, NULL, NULL, NULL, '2021-02-19 01:22:45', '2021-02-19 01:22:45', NULL),
(10, NULL, '1', '4', 'yes', 'active', NULL, NULL, NULL, NULL, '2021-04-03 01:09:36', '2021-04-03 01:09:36', NULL),
(11, NULL, '2', '4', 'yes', 'active', NULL, NULL, NULL, NULL, '2021-04-13 04:53:41', '2021-04-13 04:53:41', NULL),
(12, '18', '2', '4', 'no', 'active', NULL, NULL, NULL, NULL, '2021-04-13 04:56:04', '2021-04-13 04:56:04', NULL),
(13, '18', '9', '4', 'yes', 'active', NULL, NULL, NULL, NULL, '2021-04-13 05:02:16', '2021-04-13 05:02:16', NULL),
(14, '18', '9', '4', 'no', 'active', NULL, NULL, NULL, NULL, '2021-04-13 05:02:22', '2021-04-13 05:02:22', NULL),
(15, '18', '2', '5', 'yes', 'active', NULL, NULL, 'offer letter', NULL, '2021-04-13 05:05:43', '2021-04-13 05:05:44', NULL),
(16, '18', '2', '6', 'no', 'active', NULL, NULL, NULL, NULL, '2021-04-13 05:05:44', '2021-04-13 05:05:44', NULL),
(17, '18', '2', '7', 'no', 'active', NULL, NULL, NULL, NULL, '2021-04-13 05:05:44', '2021-04-13 05:05:44', NULL),
(18, '18', '10', '4', 'no', 'active', 'do you have passport', 'no', '[\"any co passenger with you\"]', '[\"dgdfgdf\"]', '2021-04-13 05:24:15', '2021-04-13 05:24:15', NULL),
(19, '18', '2', '4', 'yes', 'active', NULL, NULL, NULL, NULL, '2021-04-13 05:29:29', '2021-04-13 05:29:29', NULL),
(20, '18', '2', '4', 'yes', 'active', NULL, NULL, NULL, NULL, '2021-04-13 05:29:29', '2021-04-13 05:29:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visa_applicants`
--

CREATE TABLE `visa_applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_country` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resident_country` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_entry_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_issue_date` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_expiry_date` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('pending','in-progress','approved','completed','rejected','waiting_for_gov') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `reason` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visa_applicants`
--

INSERT INTO `visa_applicants` (`id`, `application_id`, `first_name`, `last_name`, `gender`, `nationality`, `birthdate`, `birth_country`, `resident_country`, `visa_entry_id`, `passport_number`, `passport_issue_date`, `passport_expiry_date`, `passport_image`, `applicant_image`, `status`, `reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'swapnil', 'modi', 'Male', '17', '06/06/1995', '6', '3', '3', '233423423423', '13/05/2020', '28/05/2020', 'aF6A7cPb83.jpg', 's8FfXxIbkv.jpg', 'approved', NULL, '2020-05-15 05:33:50', '2020-05-15 05:40:33', NULL),
(2, '1', 'test', 'kevin', 'Female', '3', '02/03/1995', '3', '4', '5', '233423423423', NULL, NULL, 'tMGZALJhRw.png', 'CMdeihPJz0.png', 'rejected', 'you have fake details', '2020-05-15 05:33:50', '2020-05-15 05:40:27', NULL),
(3, '2', 'asfs', 'sdf', 'Male', '14', '21/05/2020', '17', '19', '6', 'dsfsdf', '25/05/2020', '28/05/2020', 'UG5az3sQf2.png', 'oQRMtci10O.jpeg', 'pending', NULL, '2020-05-25 00:48:40', '2020-05-25 00:48:40', NULL),
(4, '3', 'Max', 'Sony', 'Male', '76', '16/02/1991', '76', '76', '9', '9876543212', '02/02/2021', '25/02/2026', 'IqY7zhS9pu.jpg', 'oQxPQRkZ5t.jpg', 'pending', NULL, '2021-02-16 01:39:31', '2021-02-16 01:39:31', NULL),
(5, '4', 'Khalid', 'Kassim', 'Male', '87', '22/03/2001', '182', '182', '9', '21321s211', '02/02/2021', '23/03/2021', 'FtZ57yaf2g.gif', 'x3VZ0KxyuG.png', 'pending', NULL, '2021-02-17 14:08:29', '2021-02-17 14:08:29', NULL),
(6, '4', 'Khalid', 'Kassim', 'Female', '13', '18/06/2008', '182', '6', '', '342342', '17/02/2021', '09/08/2028', '0gkNt2Ce8Y.png', 'ftGQDC7IgD.png', 'pending', NULL, '2021-02-17 14:08:29', '2021-02-17 14:08:29', NULL),
(7, '5', 'Khalid', 'Kassim', 'Male', '2', '18/02/2021', '182', '76', '9', '32413242131', '18/02/2021', '05/03/2026', '', '', 'pending', NULL, '2021-02-18 02:46:09', '2021-02-18 02:46:09', NULL),
(8, '6', 'Khalid', 'Kassim', 'Male', '76', '19/02/2021', '182', '76', '9', '32413242131', '19/02/2021', '22/02/2021', '', '', 'pending', NULL, '2021-02-19 01:22:38', '2021-02-19 01:22:38', NULL),
(9, '6', 'Khalid', 'Kassim', 'Male', '76', '19/02/2021', '182', '76', '', '21321s211', '19/02/2021', '05/03/2026', '', '', 'pending', NULL, '2021-02-19 01:22:38', '2021-02-19 01:22:38', NULL),
(10, '7', 'Max', 'Sony', 'Male', '76', '18/06/1996', '76', '76', '9', 'AWVPD876', '03/04/2021', '22/07/2027', 'ZWWrBOzasy.jpg', 'fem4OWKygs.jpg', 'pending', NULL, '2021-04-03 01:10:02', '2021-04-03 01:10:02', NULL),
(11, '8', 'jaymin', 'modi', 'Male', '3', '13/04/2021', '2', '76', '4', '12423552353523', '13/04/2021', '14/04/2021', '4qnZ1Hc88b.jpg', '3gFNuc8NCf.jpg', 'pending', NULL, '2021-04-13 04:55:54', '2021-04-13 04:55:54', NULL),
(12, '9', 'ff', 'modi', 'Male', '3', '13/04/2021', '18', '76', '4', '213423432', '13/04/2021', '30/04/2021', 'ozNHOaQm9W.png', 'QXVLXc7ELf.png', 'pending', NULL, '2021-04-13 05:02:10', '2021-04-13 05:02:10', NULL),
(13, '10', 'ff', 'modi', 'Male', '3', '13/04/2021', '18', '76', '4', '213423432', '13/04/2021', '30/04/2021', 'EHcMeUSrFz.png', 'GLHt3bgA13.png', 'pending', NULL, '2021-04-13 05:04:44', '2021-04-13 05:04:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visa_applicant_temps`
--

CREATE TABLE `visa_applicant_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_country` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resident_country` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_entry_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_number` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_issue_date` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_expiry_date` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `app_status` enum('pending','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `reason` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visa_applicant_temps`
--

INSERT INTO `visa_applicant_temps` (`id`, `application_id`, `first_name`, `last_name`, `gender`, `nationality`, `birthdate`, `birth_country`, `resident_country`, `visa_entry_id`, `passport_number`, `passport_issue_date`, `passport_expiry_date`, `passport_image`, `applicant_image`, `app_status`, `reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'Max', 'Sony', 'Male', '76', '18/06/1996', '76', '76', '9', 'AWVPD876', '03/04/2021', '22/07/2027', 'ZWWrBOzasy.jpg', 'fem4OWKygs.jpg', 'pending', NULL, '2021-04-03 01:09:12', '2021-04-03 01:09:12', NULL),
(2, '2', 'jaymin', 'modi', 'Male', '3', '13/04/2021', '2', '76', '4', '12423552353523', '13/04/2021', '14/04/2021', '4qnZ1Hc88b.jpg', '3gFNuc8NCf.jpg', 'pending', NULL, '2021-04-13 04:53:33', '2021-04-13 04:53:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visa_applications`
--

CREATE TABLE `visa_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_no` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatapp_number` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrival_date` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_date` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `destination_country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_type_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_entry_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gov_fee` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('pending','in-progress','approved','completed','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visa_applications`
--

INSERT INTO `visa_applications` (`id`, `user_id`, `application_no`, `email`, `whatapp_number`, `arrival_date`, `departure_date`, `from_country_id`, `destination_country_id`, `visa_type_id`, `visa_entry_id`, `service_type`, `total_price`, `gov_fee`, `tax`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7', '74435571', 'php1@aistechnolabs.co.uk', '65465465465', '27/05/2020', '30/05/2020', NULL, NULL, NULL, NULL, 'regular', '230', '21', '21', 'pending', '2020-05-15 05:33:50', '2020-05-15 05:33:50', NULL),
(2, '7', '90475157', 'php1@aistechnolabs.co.uk', '65465465465', '25/05/2020', '29/05/2020', NULL, NULL, NULL, NULL, 'regular', NULL, NULL, NULL, 'in-progress', '2020-05-25 00:48:40', '2020-05-29 04:32:22', NULL),
(3, '7', '94455341', 'php1@aistechnolabs.co.uk', '65465465465', '2021-02-17', '2021-03-18', '76', '182', '3', '9', 'express', '525', '350', '5', 'pending', '2021-02-16 01:39:31', '2021-02-16 01:39:31', NULL),
(4, '1', '80352170', 'khalid@aistechnolabs.xyz', '0552721151', '2021-02-26', '2021-02-27', '96', '182', '3', '9', 'express', '525', '350', '5', 'pending', '2021-02-17 14:08:29', '2021-02-17 14:08:29', NULL),
(5, '1', '94354358', 'khalid@aistechnolabs.xyz', '0552721151', '2021-02-26', '2021-02-27', '76', '182', '3', '9', 'regular', '525', '350', '5', 'pending', '2021-02-18 02:46:09', '2021-02-18 02:46:09', NULL),
(6, '1', '77614411', 'khalid@aistechnolabs.xyz', '1322132131', '2021-02-26', '2021-02-27', '76', '182', '3', '9', 'express', '473', '350', '5', 'pending', '2021-02-19 01:22:38', '2021-02-19 01:22:38', NULL),
(7, '17', '41736614', 'max@aistechnolabs.com', '987654321', '2021-04-22', '2021-04-30', '76', '182', '3', '9', NULL, NULL, '350', NULL, 'pending', '2021-04-03 01:10:01', '2021-04-03 01:10:01', NULL),
(8, '18', '5159333', 'jaymin@gmail.com', '8488080145', '2021-04-13', '2021-04-15', '76', '18', '1', '4', NULL, NULL, '12', NULL, 'pending', '2021-04-13 04:55:54', '2021-04-13 04:55:54', NULL),
(9, '18', '75320007', 'jaymin@gmail.com', '8488080145', '2021-04-13', '2021-04-15', '76', '18', '1', '4', NULL, NULL, '12', NULL, 'pending', '2021-04-13 05:02:10', '2021-04-13 05:02:10', NULL),
(10, '18', '84275179', 'jaymin@gmail.com', '8488080145', '2021-04-13', '2021-04-15', '76', '18', '1', '4', NULL, NULL, '12', NULL, 'pending', '2021-04-13 05:04:44', '2021-04-13 05:04:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visa_application_temps`
--

CREATE TABLE `visa_application_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatapp_number` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrival_date` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departure_date` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `destination_country_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_type_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_entry_id` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gov_fee` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `app_status` enum('pending','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visa_application_temps`
--

INSERT INTO `visa_application_temps` (`id`, `email`, `whatapp_number`, `arrival_date`, `departure_date`, `from_country_id`, `destination_country_id`, `visa_type_id`, `visa_entry_id`, `service_type`, `total_price`, `gov_fee`, `tax`, `app_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'max@aistechnolabs.com', '987654321', '2021-04-22', '2021-04-30', '76', '182', '3', '9', NULL, NULL, '350', NULL, 'pending', '2021-04-03 01:09:12', '2021-04-03 01:09:12', NULL),
(2, 'jaymin@gmail.com', '8488080145', '2021-04-13', '2021-04-15', '76', '18', '1', '4', NULL, NULL, '12', NULL, 'pending', '2021-04-13 04:53:33', '2021-04-13 04:53:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visa_types`
--

CREATE TABLE `visa_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visa_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visa_types`
--

INSERT INTO `visa_types` (`id`, `visa_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'On Arrival Visa', 'active', '2020-04-30 04:27:38', '2020-04-30 04:27:38', NULL),
(2, 'Business Visa', 'active', '2020-04-30 04:27:38', '2020-04-30 04:27:38', NULL),
(3, 'Tourist Visa', 'active', '2020-04-30 04:27:38', '2020-04-30 04:27:38', NULL),
(4, 'Student Visa', 'active', '2020-04-30 04:27:38', '2020-05-06 03:47:50', NULL),
(5, 'Tourist Stamped Visa', 'active', '2021-02-11 14:51:28', '2021-02-11 14:51:28', NULL),
(6, 'Business Stamped 30 days Visa', 'active', '2021-02-11 14:51:49', '2021-02-18 02:26:02', NULL),
(7, 'Private Stamped Visa', 'active', '2021-02-11 14:52:06', '2021-02-11 14:52:06', NULL),
(8, 'Stamped Visa In Person', 'active', '2021-02-11 14:54:21', '2021-02-11 14:54:21', NULL),
(9, 'Tourist Stamped Visa URGENT', 'active', '2021-02-11 15:52:15', '2021-02-11 15:53:15', '2021-02-11 15:53:15'),
(10, 'Business Stamped Visa URGENT', 'active', '2021-02-11 15:52:36', '2021-02-11 15:53:09', '2021-02-11 15:53:09'),
(11, 'Business 1 Year Multiple', 'active', '2021-02-15 16:16:29', '2021-02-18 02:25:36', NULL),
(12, 'Business 1 Year Multiple Urgent', 'active', '2021-02-15 16:16:55', '2021-02-18 02:25:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visa_type_entries`
--

CREATE TABLE `visa_type_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visa_type_entry` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visa_type_entries`
--

INSERT INTO `visa_type_entries` (`id`, `visa_type_entry`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Single', 'active', '2020-04-30 04:27:38', '2020-04-30 04:27:38', NULL),
(2, 'Double', 'active', '2020-04-30 04:27:38', '2020-04-30 04:27:38', NULL),
(3, 'Multiple 6 Months', 'active', '2020-04-30 04:27:38', '2021-02-17 12:26:16', NULL),
(4, 'Private Visa', 'active', '2020-04-30 17:54:44', '2020-04-30 17:54:44', NULL),
(5, 'Multiple 1 Year', 'active', '2020-04-30 17:55:26', '2021-02-17 12:25:52', NULL),
(6, 'Single Urgent', 'active', '2020-05-06 06:04:49', '2020-05-29 04:25:57', NULL),
(7, 'Double Urgent', 'active', '2020-05-29 04:26:38', '2020-05-29 04:26:38', NULL),
(8, 'test', 'active', '2021-02-10 04:02:21', '2021-02-10 04:02:39', '2021-02-10 04:02:39'),
(9, 'Single 30 Days', 'active', '2021-02-11 14:07:39', '2021-02-17 12:25:38', NULL),
(10, 'Single 90 Days', 'active', '2021-02-11 14:09:05', '2021-02-17 12:25:20', NULL),
(11, 'Single 14 Days', 'active', '2021-02-11 14:11:36', '2021-02-17 12:25:01', NULL),
(12, 'Single 30 Days Urgent', 'active', '2021-02-11 15:54:01', '2021-02-17 12:24:47', NULL),
(13, 'Single 90 Days Urgent', 'active', '2021-02-11 15:54:51', '2021-02-19 01:36:57', NULL),
(14, 'Multiple 90 Days', 'active', '2021-02-19 01:36:38', '2021-02-19 01:36:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_sub_questions`
--
ALTER TABLE `admin_sub_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_details_card_type_index` (`card_type`),
  ADD KEY `card_details_card_number_index` (`card_number`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_visa_fees`
--
ALTER TABLE `country_visa_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_wise_visas`
--
ALTER TABLE `country_wise_visas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `embassy`
--
ALTER TABLE `embassy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `from_countries`
--
ALTER TABLE `from_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `notifiction`
--
ALTER TABLE `notifiction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_country`
--
ALTER TABLE `payment_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_post_payment`
--
ALTER TABLE `pre_post_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prices_status_index` (`status`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_reviews`
--
ALTER TABLE `rating_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_reviews_status_index` (`status`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `script`
--
ALTER TABLE `script`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_code_unique` (`code`);

--
-- Indexes for table `site_setting`
--
ALTER TABLE `site_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_setting_meta_value_index` (`meta_value`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_payment_status_index` (`payment_status`),
  ADD KEY `transactions_payment_type_index` (`payment_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_ques_ans`
--
ALTER TABLE `user_ques_ans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_applicants`
--
ALTER TABLE `visa_applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_applicant_temps`
--
ALTER TABLE `visa_applicant_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_applications`
--
ALTER TABLE `visa_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_application_temps`
--
ALTER TABLE `visa_application_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_types`
--
ALTER TABLE `visa_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_type_entries`
--
ALTER TABLE `visa_type_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_sub_questions`
--
ALTER TABLE `admin_sub_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `card_details`
--
ALTER TABLE `card_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `country_visa_fees`
--
ALTER TABLE `country_visa_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `country_wise_visas`
--
ALTER TABLE `country_wise_visas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `embassy`
--
ALTER TABLE `embassy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `from_countries`
--
ALTER TABLE `from_countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3961;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notifiction`
--
ALTER TABLE `notifiction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_country`
--
ALTER TABLE `payment_country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `pre_post_payment`
--
ALTER TABLE `pre_post_payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_reviews`
--
ALTER TABLE `rating_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `script`
--
ALTER TABLE `script`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `site_setting`
--
ALTER TABLE `site_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_ques_ans`
--
ALTER TABLE `user_ques_ans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `visa_applicants`
--
ALTER TABLE `visa_applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `visa_applicant_temps`
--
ALTER TABLE `visa_applicant_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visa_applications`
--
ALTER TABLE `visa_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `visa_application_temps`
--
ALTER TABLE `visa_application_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visa_types`
--
ALTER TABLE `visa_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `visa_type_entries`
--
ALTER TABLE `visa_type_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
