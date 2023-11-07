-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2023 at 04:45 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trendy_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_page`
--

CREATE TABLE `about_page` (
  `id` bigint NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `github` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `about_page`
--

INSERT INTO `about_page` (`id`, `title`, `description`, `address`, `facebook`, `linkedin`, `github`) VALUES
(1, 'About me', 'I am Rana as a PHP developer, I possess a deep understanding of the PHP programming language and its various frameworks. I am skilled in developing dynamic and interactive web applications that are both efficient and user-friendly. My expertise lies in writing clean, well-structured code that adheres to industry best practices. In addition to my technical skills, I am also experienced in working collaboratively with cross-functional teams. I have a strong ability to communicate complex technical concepts to non-technical stakeholders, ensuring effective project coordination and successful delivery. As a PHP developer, I constantly strive to stay updated with the latest trends and advancements in the field. This allows me to leverage new technologies and tools that can enhance the performance and functionality of the applications I develop. Furthermore, I am adept at troubleshooting and debugging code, ensuring smooth operation of applications even under challenging circumstances. I have a keen eye for detail and take pride in delivering high-quality solutions that meet client requirements. Overall, being a PHP developer empowers me to create innovative web solutions that', 'Lorem 142 Str., 2352, Ipsum, State, BD', 'https://www.facebook.com/rana', 'https://www.linkedin.com/rana', 'https://github.com/rana');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `avatar`) VALUES
(1, 'Mr. Admin', 'rana@gmail.com', '$2y$10$.O.pnQ64BGBMN2jr.Vo8xuZKwqow4LgZhhwWMRhqf4jF3LFDaaQyi', 'IMG-654785f5eec955.86000033.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'সর্বশেষ', 'সর্বশেষ'),
(2, 'বিশেষ সংবাদ', 'বিশেষ-সংবাদ'),
(3, 'রাজনীতি', 'রাজনীতি'),
(4, 'বাংলাদেশ', 'বাংলাদেশ'),
(5, 'অপরাধ', 'অপরাধ'),
(6, 'বিশ্ব', 'বিশ্ব'),
(7, 'বাণিজ্য', 'বাণিজ্য'),
(8, 'মতামত', 'মতামত'),
(9, 'খেলা', 'খেলা'),
(10, 'বিনোদন', 'বিনোদন'),
(11, 'চাকরি', 'চাকরি'),
(12, 'জীবনযাপন', 'জীবনযাপন');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint NOT NULL,
  `post_id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `reply` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `message`, `reply`, `status`, `created_at`) VALUES
(42, 8, 'rana', 'rana@email.com', 'nice post', 'thanks you!', 1, '2023-11-04 06:32:20'),
(45, 8, 'Rahat', 'rahat@email.com', 'wonderfull', 'thanks', 1, '2023-11-05 09:20:33'),
(47, 8, 'sofikul', 'sofikul@gmail.com', 'good post', NULL, 0, '2023-11-05 09:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `contact_page`
--

CREATE TABLE `contact_page` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `contact_page`
--

INSERT INTO `contact_page` (`id`, `name`, `email`, `message`) VALUES
(2, 'Reuben Scott', 'pycaxycany@mailinator.com', 'Magnam illo accusant'),
(3, 'Brenden Camacho', 'tapysuf@mailinator.com', 'Vel ex sint ipsum al');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `admin_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `admin_id`, `title`, `slug`, `description`, `image`, `status`, `is_featured`, `created_at`, `updated_at`) VALUES
(5, 4, 1, 'গাজীপুরে শ্রমিকদের বিক্ষোভের সময় অনন্ত জলিলের কারখানায় আগুন', 'গাজীপুরে-শ্রমিকদের-বিক্ষোভের-সময়-অনন্ত-জলিলের-কারখানায়-আগুন', '<p>গাজীপুর মহানগরীর কোনাবাড়ী এলাকায় বেতন বৃদ্ধির দাবিতে শ্রমিকদের বিক্ষোভের সময় পাশেই চিত্রনায়ক অনন্ত জলিলের মালিকানাধীন একটি তৈরি পোশাক কারখানায় আগুন দেওয়া হয়েছে।</p><p>আজ সোমবার বিকেলে সাড়ে পাঁচটার দিকে অর্ধশতাধিক ব্যক্তি কারখানার গেট ভেঙে ভেতরে প্রবেশ করে আগুন দেয়। তাঁরা কারা, তা কেউ নিশ্চিত করে বলতে পারছেন না। খবর পেয়ে দমকল বাহিনীর কর্মীরা আগুন নিয়ন্ত্রণের চেষ্টা করছেন।</p><p>কারখানাটির নাম এবিএম ফ্যাশন লিমিটেড। গাজীপুর সদর ফায়ার সার্ভিসের দুটি ইউনিট কারখানাটির আগুন নিয়ন্ত্রণে কাজ করছে। গাজীপুর ফায়ার সার্ভিসের উপপরিচালক আবদুল্লাহ আল আরেফিন বলেন, সন্ধ্যা পৌনে ৭টার দিকে আগুন নিয়ন্ত্রণে চলে এসেছে। তবে ভেতর থেকে এখনো প্রচুর ধোঁয়া বের হচ্ছে। তাৎক্ষণিকভাবে আগুনের ক্ষয়ক্ষতির বিষয়টি নিরুপণ করা সম্ভব হয়নি।</p>', 'IMG-653fb202178b76.68662838.webp', 1, 1, '2023-10-30 13:39:14', '2023-10-30 13:39:14'),
(6, 3, 1, 'ইসরায়েলের সঙ্গে ইরান কি সত্যিই যুদ্ধে জড়িয়ে পড়বে?', 'ইসরায়েলের-সঙ্গে-ইরান-কি-সত্যিই-যুদ্ধে-জড়িয়ে-পড়বে', '<p>গাজা উপত্যকায় ইসরায়েল যদি নির্বিচার বোমাবর্ষণ বন্ধ না করে তাহলে ইসরায়েলকে মারাত্মক পরিণতি ভোগ করতে হবে বলে সতর্ক করে দিয়েছে ইরান। তেহরানের এই সতর্কবার্তাকে ব্যাখ্যা করা হচ্ছে, ইরান তার মিত্রদের ও প্রক্সি যোদ্ধাদের মাধ্যমে মধ্যপ্রাচ্য সংঘাতে প্রবেশ করতে চলেছে। সশস্ত্র গোষ্ঠী হিজবুল্লাহ এরই মধ্যে লেবানন সীমান্তে ইসরায়েলের সঙ্গে ছোট মাত্রার সংঘর্ষে জড়িয়ে পড়েছে। এ ছাড়া সিরিয়ার আসাদ সরকারও ইরানের খুব ঘনিষ্ঠ মিত্র।</p><p>ইরানের দিক থেকে আক্রমণাত্মক কথাবার্তা বাড়ার প্রেক্ষাপটে ইসরায়েল ও যুক্তরাষ্ট্র এখন এই বিবেচনা করছে যে তেহরান কখন ও কীভাবে এই সংঘাতে জড়িয়ে পড়তে পারে।</p>', 'IMG-653fb245db65b5.84433234.webp', 1, 0, '2023-10-30 13:40:21', '2023-10-30 13:40:21'),
(7, 4, 1, 'শ্রমিক বিক্ষোভ থেকে গাজীপুরে পুলিশ ফাঁড়িতে হামলা, মহাসড়ক অবরোধ', 'শ্রমিক-বিক্ষোভ-থেকে-গাজীপুরে-পুলিশ-ফাঁড়িতে-হামলা-মহাসড়ক-অবরোধ', '<p>মজুরি বাড়ানোর দাবিতে পোশাকশ্রমিকদের চলমান বিক্ষোভ থেকে গাজীপুরের কালিয়াকৈর উপজেলার মৌচাক বাজার এলাকায় অবস্থিত পুলিশ ফাঁড়িতে হামলা করা হয়েছে। উত্তেজিত শ্রমিকেরা ফাঁড়ির ফটক, কার্যালয়ের কাচ ও সাইনবোর্ড ভাঙচুর করেছেন। আজ মঙ্গলবার সকালে এ ঘটনা ঘটে।</p><p>কালিয়াকৈর থানার ভারপ্রাপ্ত কর্মকর্তা (ওসি) আকবর আলী খান বলেন, কয়েক হাজার শ্রমিক মৌচাক পুলিশ ফাঁড়ির সামনে অবস্থান নিয়ে বিক্ষোভ করছেন। তাঁদের নিয়ন্ত্রণ করতে চেষ্টা চালিয়ে যাওয়া হচ্ছে।</p><p>পুলিশ ও প্রত্যক্ষদর্শী ব্যক্তিদের সঙ্গে কথা বলে জানা গেছে, আজ সকাল থেকে মৌচাক বাজার এলাকায় শ্রমিকেরা বিক্ষোভ শুরু করেন। এ সময় মহাসড়কে ১০-১২টি যানবাহন ভাঙচুর করেন তাঁরা। শিল্প পুলিশ ও থানা-পুলিশ তাঁদের নিয়ন্ত্রণের চেষ্টা করলে শত শত শ্রমিক ক্ষিপ্ত হয়ে পুলিশকে ধাওয়া দেন। আত্মরক্ষার্থে পুলিশ মৌচাক বাজার এলাকায় অবস্থিত কালিয়াকৈর থানাধীন পুলিশ ফাঁড়িতে অবস্থান নেয়। এ সময় শ্রমিকেরা উত্তেজিত হয়ে পুলিশ ফাঁড়িতে হামলা চালান।</p>', 'IMG-654096bf036f59.77950294.webp', 1, 1, '2023-10-31 05:55:11', '2023-10-31 05:55:11'),
(8, 4, 1, 'নির্বাচন নির্ধারিত সময়ে হবে, কোনো অপশন নেই', 'নির্বাচন-নির্ধারিত-সময়ে-হবে-কোনো-অপশন-নেই', '<p>নির্বাচন নির্ধারিত সময়ে এবং নির্ধারিত পদ্ধতিতে হবে বলে জানিয়েছেন প্রধান নির্বাচন কমিশনার (সিইসি) কাজী হাবিবুল আউয়াল। তিনি বলেছেন, এ ব্যাপারে নির্বাচন কমিশন দৃঢ়প্রতিজ্ঞ। তাদের হাতে অন্য কোনো অপশন নেই।</p><p>আজ মঙ্গলবার নির্বাচন ভবনে সিইসির সঙ্গে দেখা করতে যান ঢাকায় নিযুক্ত মার্কিন রাষ্ট্রদূত পিটার হাস। ওই বৈঠক শেষে সিইসি সাংবাদিকদের এসব কথা বলেন।</p><p>পিটার হাসের সঙ্গে বৈঠকে নির্বাচনের অনুকূল প্রতিকূল পরিবেশ নিয়ে কিছু কথা উঠেছে এমন মন্তব্য করে সিইসি বলেন, তারা সব সময় চান নির্বাচনের জন্য অনুকূল পরিবেশ হোক। কিন্তু প্রতিকূল পরিবেশ হলে নির্বাচন হবে না, এমন মিসআন্ডারস্ট্যান্ডিং যেন জনগণের মাঝে না থাকে।</p><p>নির্বাচন নির্ধারিত সময়ে এবং নির্ধারিত পদ্ধতিতে হবে বলে জানিয়েছেন প্রধান নির্বাচন কমিশনার (সিইসি) কাজী হাবিবুল আউয়াল। তিনি বলেছেন, এ ব্যাপারে নির্বাচন কমিশন দৃঢ়প্রতিজ্ঞ। তাদের হাতে অন্য কোনো অপশন নেই।</p><p>আজ মঙ্গলবার নির্বাচন ভবনে সিইসির সঙ্গে দেখা করতে যান ঢাকায় নিযুক্ত মার্কিন রাষ্ট্রদূত পিটার হাস। ওই বৈঠক শেষে সিইসি সাংবাদিকদের এসব কথা বলেন।</p><p>&nbsp;</p>', 'IMG-6540a2d7ba3666.10477305.webp', 1, 1, '2023-10-31 06:46:47', '2023-10-31 06:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` bigint NOT NULL,
  `tag_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(5, 6),
(5, 5),
(5, 4),
(6, 6),
(6, 5),
(6, 4),
(0, 6),
(7, 7),
(7, 6),
(8, 6),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint NOT NULL,
  `logo` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `site_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `logo_text` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `keywords` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pagination` tinyint DEFAULT NULL,
  `pop_per_page` tinyint DEFAULT NULL,
  `rel_posts_limit` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `site_title`, `logo_text`, `description`, `keywords`, `pagination`, `pop_per_page`, `rel_posts_limit`) VALUES
(1, NULL, 'Trendy Blog', 'Trendy Blog', 'welcome to my blog website.', 'tech, news', 4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`) VALUES
(1, 'ত্রাণ তহবিল', 'ত্রাণ-তহবিল'),
(2, 'গাজা', 'গাজা'),
(3, 'মিসর', 'মিসর'),
(4, 'রক্তাক্ত ফিলিস্তিন', 'রক্তাক্ত-ফিলিস্তিন'),
(5, 'হামাস', 'হামাস'),
(6, 'বিমান হামলা', 'বিমান-হামলা'),
(7, 'প্রধানমন্ত্রী', 'প্রধানমন্ত্রী');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_page`
--
ALTER TABLE `about_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `contact_page`
--
ALTER TABLE `contact_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_category_id_index` (`category_id`),
  ADD KEY `post_admin_id_index` (`admin_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD KEY `postIdIndex` (`post_id`),
  ADD KEY `tagIdIndex` (`tag_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_page`
--
ALTER TABLE `about_page`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `contact_page`
--
ALTER TABLE `contact_page`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
