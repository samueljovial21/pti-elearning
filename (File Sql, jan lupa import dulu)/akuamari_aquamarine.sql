-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2022 at 04:52 PM
-- Server version: 10.3.37-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akuamari_aquamarine`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_versions`
--

CREATE TABLE `app_versions` (
  `id` int(11) NOT NULL,
  `latest_version` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `app_versions`
--

INSERT INTO `app_versions` (`id`, `latest_version`) VALUES
(1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `added_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(250) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `batch_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `batch_type` int(11) NOT NULL COMMENT '1=batch free , 2=batch paid',
  `batch_price` varchar(100) NOT NULL,
  `batch_offer_price` varchar(50) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch_image` varchar(200) NOT NULL,
  `no_of_student` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `pay_mode` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `admin_id`, `cat_id`, `sub_cat_id`, `batch_name`, `start_date`, `end_date`, `start_time`, `end_time`, `batch_type`, `batch_price`, `batch_offer_price`, `description`, `batch_image`, `no_of_student`, `status`, `pay_mode`) VALUES
(7, 1, 130, 123462, 'English With British Accent', '2022-11-19', '2022-12-31', '13:00:00', '15:00:00', 1, '', '', 'An English Class But Using British Accent. A Bo\'oh Oh Wo\'ah', 'british_221127191116.jpg', 2, 1, 'Online'),
(8, 1, 130, 123463, 'English With Japanese Accent', '2022-11-19', '2022-12-31', '13:00:00', '15:00:00', 1, '', '', 'English Class With Japanese Accent. Makudonarudo.', 'japanese_221127191105.jpg', 0, 1, 'Online'),
(9, 1, 130, 123464, 'English WIth Murica Accent', '2022-11-19', '2022-12-31', '13:00:00', '15:00:00', 1, '', '', 'English Class With American Accent. Let\'s Head To Middle East And Take The Oil.', 'murica_221127191047.jpg', 3, 1, 'Online'),
(11, 1, 130, 123463, 'qwweqwe', '2022-12-07', '2022-12-21', '00:00:00', '03:00:00', 1, '', '', '', '', 0, 1, 'Online'),
(12, 1, 130, 123463, 'Ching Bing Chilling', '2022-12-11', '2023-12-11', '00:00:00', '12:00:00', 1, '', '', 'There\'s no description.. Get ur as* off', 'b7856ba4b9670f426d8b347b3fc20a52_403x363x1_221211131056.png', 0, 1, 'Online'),
(13, 1, 130, 123463, 'TestingForVideo', '2022-12-20', '2023-12-20', '00:00:00', '12:00:00', 1, '', '', 'Ini dekripsi', 'Hehe_221220110854.jpg', 1, 1, 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `batch_category`
--

CREATE TABLE `batch_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `batch_category`
--

INSERT INTO `batch_category` (`id`, `name`, `slug`, `status`, `time`, `admin_id`) VALUES
(130, 'English', 'english', 1, '2022-11-19 13:09:30', 1),
(131, 'User Guideline for Admin', 'user_guideline_for_admin', 1, '2022-11-26 10:55:04', 1),
(132, 'Testing Master', 'testing_master', 1, '2022-11-28 05:50:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `batch_fecherd`
--

CREATE TABLE `batch_fecherd` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `batch_specification_heading` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch_fecherd` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_fecherd`
--

INSERT INTO `batch_fecherd` (`id`, `batch_id`, `batch_specification_heading`, `batch_fecherd`) VALUES
(1, 1, '', '[\"\"]'),
(2, 2, '', '[\"\"]'),
(3, 3, 'Pintar Grammar', '[\"Layanan full service grammar\"]'),
(4, 2, 'Bebas belajar', '[\"Banyak fitur\"]'),
(5, 4, 'U will learn UTBK Simulation', '[\"Bonus TOEFL test\"]'),
(6, 5, 'U will learn anything here', '[\"Family\"]'),
(7, 6, 'No Benefit', '[\"No Fitures\"]'),
(8, 7, '', '[\"\"]'),
(9, 8, '', '[\"\"]'),
(10, 9, '', '[\"\"]'),
(11, 10, '', '[\"\"]'),
(12, 11, '', '[\"\"]'),
(13, 12, 'What will U learn?', '[\"Haiyaaaa.... Bing chilling\"]'),
(14, 13, 'Kita akan belajar diantaranya :', '[\"Tidak ada\"]');

-- --------------------------------------------------------

--
-- Table structure for table `batch_subcategory`
--

CREATE TABLE `batch_subcategory` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `batch_subcategory`
--

INSERT INTO `batch_subcategory` (`id`, `cat_id`, `name`, `slug`, `status`, `time`, `admin_id`) VALUES
(123456, 123, 'Test_Subcategory', 'test', 1, '2022-10-18 03:03:51', 1),
(123457, 128, 'Bimbingan TOEFL', 'bimbingan_toefl', 1, '2022-10-29 09:45:43', 1),
(123458, 128, 'Umum', 'umum', 1, '2022-10-29 09:45:59', 1),
(123460, 127, 'XI', 'xi', 1, '2022-10-29 13:00:10', 1),
(123461, 127, 'XII', 'xii', 1, '2022-10-29 13:00:16', 1),
(123462, 130, 'English British', 'english_british', 1, '2022-11-19 13:10:23', 1),
(123463, 130, 'English Japanese', 'english_japanese', 1, '2022-11-19 13:10:38', 1),
(123464, 130, 'English Murica', 'english_murica', 1, '2022-11-19 13:10:48', 1),
(123465, 131, 'User Guideline for Admin : Basic', 'user_guideline_for_admin_:_basic', 1, '2022-11-26 10:56:10', 1),
(123466, 132, 'Subcateg', 'subcat', 1, '2022-11-28 06:31:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `batch_subjects`
--

CREATE TABLE `batch_subjects` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter` varchar(500) NOT NULL,
  `sub_start_date` date NOT NULL,
  `sub_end_date` date NOT NULL,
  `sub_start_time` time NOT NULL,
  `sub_end_time` time NOT NULL,
  `chapter_status` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'id of completed chapter',
  `chapter_complt_date` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total_chapter_complt_date` datetime NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `batch_subjects`
--

INSERT INTO `batch_subjects` (`id`, `batch_id`, `teacher_id`, `subject_id`, `chapter`, `sub_start_date`, `sub_end_date`, `sub_start_time`, `sub_end_time`, `chapter_status`, `chapter_complt_date`, `total_chapter_complt_date`, `added_on`) VALUES
(1, 1, 15, 1234, '[\"12345\"]', '2022-10-18', '2023-10-18', '00:00:00', '06:00:00', '', '', '0000-00-00 00:00:00', '2022-10-18 10:07:34'),
(4, 2, 17, 1234, '[\"12345\"]', '2022-10-29', '2023-10-28', '07:00:00', '10:00:00', '', '', '0000-00-00 00:00:00', '2022-11-07 13:38:19'),
(3, 3, 18, 1234, '[\"12345\"]', '2022-10-29', '2022-10-30', '00:00:00', '00:00:00', '', '', '0000-00-00 00:00:00', '2022-10-29 20:02:46'),
(5, 4, 18, 1234, '[\"12345\"]', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', '', '', '0000-00-00 00:00:00', '2022-11-07 14:02:12'),
(6, 5, 18, 1234, '[\"12345\"]', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', '', '', '0000-00-00 00:00:00', '2022-11-07 14:13:09'),
(7, 6, 18, 1234, '[\"12345\"]', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', '', '', '0000-00-00 00:00:00', '2022-11-07 14:16:04'),
(13, 7, 19, 1235, '[\"12346\"]', '2022-11-19', '2022-12-31', '13:00:00', '15:00:00', '', '', '0000-00-00 00:00:00', '2022-11-27 19:11:16'),
(12, 8, 20, 1235, '[\"12346\"]', '2022-11-19', '2022-12-31', '13:00:00', '15:00:00', '', '', '0000-00-00 00:00:00', '2022-11-27 19:11:05'),
(15, 9, 21, 1235, '[\"12346\"]', '2022-11-19', '2022-12-31', '13:00:00', '15:00:00', '', '', '0000-00-00 00:00:00', '2022-12-01 18:08:05'),
(16, 10, 20, 1235, '[\"12347\"]', '2022-12-08', '2022-12-14', '00:00:00', '00:00:00', '', '', '0000-00-00 00:00:00', '2022-12-06 09:07:41'),
(17, 11, 20, 1235, '[\"12346\"]', '2022-12-07', '2022-12-21', '00:00:00', '03:00:00', '', '', '0000-00-00 00:00:00', '2022-12-06 09:11:20'),
(18, 12, 21, 1235, '[\"12347\"]', '2022-12-11', '2023-12-11', '00:00:00', '12:00:00', '', '', '0000-00-00 00:00:00', '2022-12-11 13:10:56'),
(19, 13, 21, 1235, '[\"12347\"]', '2022-12-20', '2023-12-20', '00:00:00', '12:00:00', '', '', '0000-00-00 00:00:00', '2022-12-20 11:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `image`, `description`, `admin_id`, `added_by`, `status`, `create_at`) VALUES
(1, 'This Is Blog', 'akari_221201183520.jpg', 'Yea Yea Yea', 1, '', 1, '2022-12-01 18:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_role` varchar(11) NOT NULL,
  `user_name` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `user_email` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `user_mobile` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `comments` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = painding ,1 =complete , 2 = decline',
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments_reply`
--

CREATE TABLE `blog_comments_reply` (
  `id` int(11) NOT NULL,
  `comment_id` varchar(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `name` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `reply` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_pdf`
--

CREATE TABLE `book_pdf` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book_pdf`
--

INSERT INTO `book_pdf` (`id`, `admin_id`, `title`, `batch`, `topic`, `subject`, `file_name`, `status`, `added_by`, `added_at`) VALUES
(1, 1, 'Ini_Buku', '[\"5\"]', '', '1234', 'Kelas-RB-Kelompok-04221107213410.pdf', 1, 18, '2022-11-07 21:34:10'),
(2, 1, 'Harry Potter', '[\"7\"]', '', '1235', 'TP3_119140170221202001532.pdf', 1, 1, '2022-12-02 00:15:32'),
(3, 1, 'Test2', '[\"8\"]', '', '1235', '1120_-_Surat_Tugas_PkM_an_Harmiansyah221202101954.pdf', 1, 20, '2022-12-02 10:19:54'),
(4, 1, 'hayo', '[\"7\"]', '', '1235', 'TP3_119140170221204150906.pdf', 1, 19, '2022-12-04 15:09:06'),
(5, 1, '1qaserf', '[\"8\"]', '', '1235', 'CamScanner_12-02-2022_15.36221205161217.pdf', 1, 1, '2022-12-05 16:12:17'),
(6, 1, 'Buku Contoh', '[\"8\"]', '', '1235', 'jcosine.v1i1.19221220111727.pdf', 1, 20, '2022-12-20 11:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `added_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `student_id`, `batch_id`, `added_id`, `date`) VALUES
(1, 2, 5, 1, '2022-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_setting`
--

CREATE TABLE `certificate_setting` (
  `id` int(11) NOT NULL,
  `heading` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_heading` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `certificate_logo` varchar(500) NOT NULL,
  `signature_image` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `certificate_setting`
--

INSERT INTO `certificate_setting` (`id`, `heading`, `sub_heading`, `title`, `description`, `certificate_logo`, `signature_image`) VALUES
(1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `no_of_questions` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `subject_id`, `chapter_name`, `status`, `no_of_questions`) VALUES
(12345, 1234, 'Testing_Chapter', 1, 27),
(12346, 1235, 'What is English?', 1, 25),
(12347, 1235, 'Why English', 1, 2),
(12348, 1235, 'How To English', 1, 10),
(12349, 1236, 'User Guideline Chapter 1', 1, 1),
(12350, 1236, 'User Guideline Chapter 2', 1, 0),
(12351, 1236, 'User Guideline Chapter 3', 1, 0),
(12352, 1237, 'Aku', 1, 0),
(12353, 1237, 'Who am I', 1, 5),
(12354, 1237, 'I am You', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `course_duration` varchar(255) NOT NULL,
  `class_size` varchar(255) NOT NULL,
  `time_duration` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 - mock, 2 - practice',
  `format` int(11) NOT NULL COMMENT '1 - Shuffle, 2 - Fix',
  `batch_id` int(11) NOT NULL,
  `total_question` varchar(255) NOT NULL,
  `time_duration` varchar(255) NOT NULL COMMENT 'In Minute Only',
  `question_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mock_sheduled_date` date NOT NULL,
  `mock_sheduled_time` time NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `admin_id`, `name`, `type`, `format`, `batch_id`, `total_question`, `time_duration`, `question_ids`, `mock_sheduled_date`, `mock_sheduled_time`, `status`, `added_by`, `added_at`) VALUES
(8, 1, 'Usagi', 1, 1, 8, '1', '1000', '[\"57\"]', '2022-12-01', '19:00:00', 1, 1, '2022-12-01 18:59:30'),
(7, 1, 'User Guideline Test', 1, 1, 8, '1', '1000', '[\"34\"]', '2022-11-26', '18:45:00', 1, 1, '2022-11-26 18:44:17'),
(9, 19, 'Test example', 2, 1, 7, '1', '100', '[\"58\"]', '0000-00-00', '00:00:00', 1, 19, '2022-12-04 14:11:21'),
(10, 19, 'quiz exam', 1, 1, 7, '1', '100', '[\"58\"]', '2022-12-15', '00:00:00', 1, 19, '2022-12-04 14:13:35'),
(11, 19, 'test wrong', 1, 1, 7, '1', '15', '[\"58\"]', '2022-12-01', '00:00:00', 1, 19, '2022-12-04 14:16:53'),
(12, 1, 'qwert', 1, 1, 8, '1', '126', '[\"64\"]', '2022-12-05', '16:05:00', 1, 1, '2022-12-05 16:08:59'),
(13, 1, 'testinggg', 2, 1, 9, '4', '200', '[\"69\",\"68\",\"67\",\"66\"]', '0000-00-00', '00:00:00', 1, 1, '2022-12-06 03:25:02'),
(14, 1, 'quizzzz', 1, 1, 9, '4', '7200', '[\"61\",\"62\",\"63\",\"64\"]', '2022-12-06', '03:00:00', 1, 1, '2022-12-06 03:26:23'),
(15, 1, '1wertyuio', 1, 1, 8, '1', '1120', '[\"70\"]', '2022-12-06', '02:00:00', 1, 1, '2022-12-06 09:26:57'),
(17, 1, '57756765', 1, 1, 8, '1', '3000', '[\"71\"]', '2022-12-06', '09:00:00', 1, 1, '2022-12-06 09:52:13'),
(18, 1, 'Testing_Again', 1, 1, 8, '1', '120', '[\"72\"]', '2022-12-06', '21:00:00', 1, 1, '2022-12-06 21:19:16'),
(19, 1, 'You', 2, 1, 7, '1', '120', '[\"73\"]', '0000-00-00', '00:00:00', 1, 1, '2022-12-06 21:55:17'),
(20, 1, 'Contoh Untuk Video', 1, 1, 13, '4', '120', '[\"77\",\"76\",\"75\",\"74\"]', '2022-12-20', '11:00:00', 1, 1, '2022-12-20 11:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `extra_classes`
--

CREATE TABLE `extra_classes` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) NOT NULL,
  `batch_id` varchar(500) NOT NULL,
  `added_at` datetime NOT NULL,
  `completed_date_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `extra_classes`
--

INSERT INTO `extra_classes` (`id`, `admin_id`, `date`, `start_time`, `end_time`, `teacher_id`, `description`, `status`, `batch_id`, `added_at`, `completed_date_time`) VALUES
(1, 1, '2022-11-08', '07:00:00', '09:00:00', 18, 'Desc', 'Incomplete', '[\"4\"]', '2022-11-07 19:39:52', '0000-00-00 00:00:00'),
(2, 1, '2022-11-09', '06:00:00', '08:00:00', 18, 'Ok', 'Incomplete', '[\"5\"]', '2022-11-07 19:45:18', '0000-00-00 00:00:00'),
(3, 1, '2022-11-10', '08:00:00', '09:00:00', 18, 'Okehhh', 'Incomplete', '[\"5\"]', '2022-11-07 19:46:02', '0000-00-00 00:00:00'),
(4, 1, '2022-11-28', '18:49:00', '18:50:00', 22, 'good 4 u', 'Incomplete', '[\"7\"]', '2022-11-28 18:48:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `extra_class_attendance`
--

CREATE TABLE `extra_class_attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `added_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `title`, `icon`, `description`, `status`) VALUES
(1, 'Ruang AC', '<i class=\"icofont-snow-alt\"></i>', 'AC Dingin', 1),
(2, 'Ruangan Luas', '<i class=\"icofont-resize\"></i>', 'Beragam ruangan yang luas', 1),
(3, 'Tentor-tentor terbaik', '<i class=\"icofont-people\"></i>', 'Tentor-tentor yang siap membimbing Anda', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frontend_details`
--

CREATE TABLE `frontend_details` (
  `id` int(11) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `map_api` varchar(255) NOT NULL,
  `slider_details` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cont_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cont_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cont_form_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `faci_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `faci_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `frst_crse_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `frst_crse_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `frst_crse_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sec_crse_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sec_crse_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_frst_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_frst_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_year` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_frst_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_frst_img` varchar(255) NOT NULL,
  `abt_sec_img` varchar(255) NOT NULL,
  `abt_sec_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_sec_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_secbtn_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_secbtn_url` varchar(255) NOT NULL,
  `abt_thrd_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_thrd_sub_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_thrd_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abt_thrd_img` varchar(255) NOT NULL,
  `total_toppers` int(11) NOT NULL,
  `trusted_students` int(11) NOT NULL,
  `years_of_histry` int(11) NOT NULL,
  `testimonial` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `testi_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `testi_subheading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `selectn_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `selectn_subheading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `selection` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_heading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_subheading` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `no_of_teacher` int(11) NOT NULL,
  `header_btn_txt` varchar(255) NOT NULL,
  `header_btn_url` varchar(255) NOT NULL,
  `client_imgs` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `frontend_details`
--

INSERT INTO `frontend_details` (`id`, `mobile`, `email`, `address`, `facebook`, `youtube`, `twitter`, `instagram`, `linkedin`, `map_api`, `slider_details`, `cont_heading`, `cont_sub_heading`, `cont_form_heading`, `faci_heading`, `faci_sub_heading`, `frst_crse_heading`, `frst_crse_sub_heading`, `frst_crse_desc`, `sec_crse_heading`, `sec_crse_sub_heading`, `abt_frst_heading`, `abt_frst_sub_heading`, `abt_year`, `abt_frst_desc`, `abt_frst_img`, `abt_sec_img`, `abt_sec_heading`, `abt_sec_desc`, `abt_secbtn_text`, `abt_secbtn_url`, `abt_thrd_heading`, `abt_thrd_sub_heading`, `abt_thrd_desc`, `abt_thrd_img`, `total_toppers`, `trusted_students`, `years_of_histry`, `testimonial`, `testi_heading`, `testi_subheading`, `selectn_heading`, `selectn_subheading`, `selection`, `teacher_heading`, `teacher_subheading`, `no_of_teacher`, `header_btn_txt`, `header_btn_url`, `client_imgs`) VALUES
(1, '081379523955', 'smartschoolfoundation@gmail.com', 'Jl, Karang Rejo, Kec. Semaka, Kabupaten Tanggamus, Lampung 35386', 'https://web.facebook.com/groups/406245664709720/', 'https://www.youtube.com/channel/UCKTAiQlRx1YFd6LcXsDL5Ew', 'https://www.twitter.com', 'https://www.instagram.com/smart_school_foundation/', 'https://www.linkedin.com', '', '{\"slider_heading\":[\"&quot;Be Smart with Our Private&quot;\",\"Raih Prestasimu Bersama Kami\",\"Siap Membimbingmu Menuju Dunia Penuh Prestasi\"],\"slider_subheading\":[\"Welcome to SSF E-Learning\",\"Ayo Bergabung\",\"Mari Bergabung Bersama Kami\"],\"slider_desc\":[\"Kami sudah berhasil membimbing beragam kalangan untuk dapat meningkatkan skill berbahasa Inggris mereka.\",\"Beragam prestasi oleh bimbingan kami sudah diperoleh. Tentunya dengan kerja keras dan bantuan dari bimbingan kami.\",\"Tunggu apalagi, tertarik untuk bergabung? Kami bersedia menerima dan membimbing Anda kapanpun Anda mau.\"],\"slider_img\":[\"page.jpg\",\"page_2.jpg\",\"page_3.jpg\"]}', 'Hubungi kami bila berminat di :', 'MARI BERGABUNG', 'Anda dapat mengirim pesan kepada kami juga di sini :', 'Tersedia', 'Fasilitas-fasilitas Kami', 'Online Learning Plateform', 'WE ARE E - ACADEMY', '', 'Course Kami', 'KAMI SIAP MEMBIMBING ANDA', 'Smart School Foundation', 'Tentang Kami', '2012', 'Smart School Foundation adalah lembaga kursus bahasa Inggris yang beralamat di Jl. Alim Ulama No. 1 Semaka Kabupaten Tanggamus. Smart School Foundation sudah berdiri sejak tahun 2012. Jenjang pendidikan lembaga ini dimulai dari jenjang SD sampai dengan Umum. Tersedia kelas dengan mekanisme offline dan online. Selain kelas reguler, terdapat juga kelas prestasi untuk mengasah kemampuan dan minat bakat dalam berbahasa Inggris.', 'page_4.jpg', 'page_5.jpg', 'Kami siap membimbing Anda dari dasar hingga puncak.', 'Tunggu apa lagi? Mari bergabung bersama kami', 'Hubungi Kami', 'https://www.akuamarin.my.id/contact-us', 'Mengapa Memilih Kami Dibanding dengan yang Lain?', 'Misi Kami adalah Memberikan yang Terbaik Bagi Anda', 'Misi kami adalah membantu Anda mencapai tingkat kepuasan Anda dalam belajar berbahasa Inggris. Kami sudah membantu beragam kalangan baik dari SD sampai dengan Umum untuk mencapai tingkat maksimum mereka.<br><br>Dengan bergabung pada kami, kami berharap untuk dapat memberikan yang terbaik bagi Anda hingga tingkat kepuasan tertinggi Anda dalam proses belajar berbahasa Inggris', 'about.jpg', 54, 100, 10, '{\"9\":\"Osmanthus Wine taste the same as I remember, but where are Those Who Share The Memory?\",\"6\":\"AKMJ, Asik Keren Mantap Jiwa\",\"8\":\"Gokil\",\"12\":\"Reflek Turu\",\"10\":\"Menurut kitab Tatang Sutarman, nenek moyang gwe, Bimbel disini mantap\"}', 'Apa yang bimbingan kami katakan?', 'REVIEW OLEH BIMBINGAN', 'Perkenalkan', 'Para Bimbingan Kami', '{\"6\":\"student\",\"12\":\"student\",\"10\":\"student\"}', 'Perkenalkan', 'Para Tentor', 6, '', '', '[\"011.png\",\"021.png\",\"031.png\",\"041.png\",\"051.png\",\"063.png\"]');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) NOT NULL,
  `upload` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `type`, `upload`, `image`, `video_url`, `video`, `status`, `admin_id`) VALUES
(1, 'OneOkRock', 'Image', 'File', '_21_one-ok-rock-wallpaper_One-Ok-Rock-Taking-Off-official-Video-From-Nagisaen-_logo_added.jpg', '', '', 1, 1),
(2, 'Queen_Meme', 'Video', 'File', '', '', '305800521_3280359682212129_1031705061698675248_n.mp4', 1, 1),
(3, 'Ini Video', 'Video', 'File', '', '', 'Facebook_2.mp4', 1, 1),
(4, 'Ini Gambar', 'Image', 'File', '9dd.jpg', '', '', 1, 1),
(5, 'Ngetes galeri foto', 'Image', 'File', 'SVuXO7tTLeMT6ZALGoZpP-transformed-removebg-preview.png', '', '', 1, 1),
(6, 'ngetes galeri video dari file', 'Video', 'File', '', '', 'Facebook_9.mp4', 1, 1),
(7, 'ngetes galeri video dari url', 'Video', 'URL', '', 'https://youtu.be/zGtTXEFUytc', '', 1, 0),
(8, 'tes lagi tapi dari url', 'Video', 'URL', '', 'https://youtu.be/zGtTXEFUytc', '', 1, 0),
(9, 'food', 'Video', 'URL', '', 'https://youtu.be/DrTr_EI2dsA', '', 1, 0),
(10, 'holaaa', 'Video', 'URL', '', 'https://youtu.be/DrTr_EI2dsA', '', 1, 0),
(11, 'halo', 'Image', 'File', '001.png', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `key_text` text NOT NULL,
  `velue_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `key_text`, `velue_text`) VALUES
(1, 'payment gateway type select 1 = razorpay, 2 paypal', 'payment_type', '1'),
(2, 'razorpay key id ', 'razorpay_key_id', 'rzp_test_QFKjgPljh9GufG'),
(3, 'razorpay secret key', 'razorpay_secret_key', 'Xay0wYHnWRZ21ZVvsE4TQLE2'),
(4, 'paypal client id', 'paypal_client_id', 'AQoZsAppdXNlefqgf7DnKi9udy75SL4DmqPqRdP-HUODw7CpJDK3BAXClECVoS31dtTOPuNix_L04JD0'),
(5, 'paypal secret key', 'paypal_secret_key', ''),
(6, 'select language type ', 'language_name', 'english'),
(7, 'select currency code', 'currency_code', 'INR'),
(8, 'select currency decimal code', 'currency_decimal_code', '₹'),
(9, 'currency converter api', 'currency_converter_api', ''),
(10, 'send mails SMTP ', 'smtp_mail', 'info@themes91.in'),
(11, 'smtp password mail', 'smtp_pwd', '(I)7A2i!8jzE'),
(12, 'smtp server type mail', 'server_type', 'smtp'),
(13, 'smtp host mail', 'smtp_host', 'mail.themes91.in'),
(14, 'smtp host mails', 'smtp_port', '587'),
(15, 'smtp smtp encryption', 'smtp_encryption', 'tlc'),
(16, 'sandbox accounts', 'sandbox_accounts', 'EHDaz3PQlfFzI6EzgrXmqqfEbqp9bLqm593GIBcq36e4V46zusKiF9EmQ5_dVPoqCXSRoAiOreBrkvTF'),
(17, 'Firebase Accounts', 'firebase_key', 'AAAAFU0Nyks:APA91bFWu1zpzRasM60cqJjMvfcL5Uc667MP38b5CaYd5O3g-ioRYGtVSvBCdFUt5ea4H8eIDbPKNs98z5W0RxFfRsswy07p1EbSKRRlQkUA1b9sb_fBC2sHvFJZWhpILlZlOqz0_M4u');

-- --------------------------------------------------------

--
-- Table structure for table `homeworks`
--

CREATE TABLE `homeworks` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject_id` int(11) NOT NULL,
  `batch_id` text NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `homeworks`
--

INSERT INTO `homeworks` (`id`, `admin_id`, `teacher_id`, `date`, `subject_id`, `batch_id`, `description`, `added_at`) VALUES
(1, 1, 18, '2022-11-07', 1234, '5', 'Ini Tugas', '2022-11-07 21:24:47'),
(2, 1, 20, '2022-12-11', 1235, '8', 'Ini tugas kalian', '2022-12-02 10:28:12'),
(3, 1, 19, '2022-12-08', 1235, '7', 'Make an assigment', '2022-12-04 22:08:29'),
(5, 1, 20, '2022-12-06', 1235, '8', 'Kerjakan halaman 1 sampai 10', '2022-12-06 01:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `leave_management`
--

CREATE TABLE `leave_management` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `leave_msg` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leave_management`
--

INSERT INTO `leave_management` (`id`, `teacher_id`, `student_id`, `admin_id`, `batch_id`, `subject`, `leave_msg`, `from_date`, `to_date`, `total_days`, `status`, `added_at`) VALUES
(1, 20, 0, 1, 8, 'ge', 'Hello Sir,  w', '2022-11-02', '2022-11-10', 8, 0, '2022-11-29 10:13:19'),
(2, 0, 8, 1, 0, 'Izin pak', 'Hello Sir, Hehehe', '2022-12-02', '2022-12-05', 3, 0, '2022-12-02 03:18:17'),
(3, 19, 0, 1, 7, 'Leave', 'Hello Sir,', '2022-12-04', '2022-12-14', 10, 0, '2022-12-04 10:02:48'),
(4, 20, 0, 1, 8, 'Sakit', 'Hello Sir, Izin sakit', '2022-12-22', '2022-12-23', 1, 1, '2022-12-20 04:15:11'),
(5, 0, 8, 1, 13, 'Izin sir', 'Hello Sir, Izin', '2022-12-22', '2022-12-25', 3, 2, '2022-12-20 04:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `live_class_history`
--

CREATE TABLE `live_class_history` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `start_time` varchar(500) NOT NULL,
  `end_time` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `entry_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `live_class_history`
--

INSERT INTO `live_class_history` (`id`, `uid`, `batch_id`, `subject_id`, `chapter_id`, `start_time`, `end_time`, `date`, `entry_date_time`, `admin_id`) VALUES
(1, 1, 7, 1235, 12348, '11:58:10 pm', '', '2022-11-27', '2022-11-27 16:58:10', 0),
(2, 1, 7, 1235, 12348, '11:58:16 pm', '', '2022-11-27', '2022-11-27 16:58:16', 0),
(3, 20, 8, 1235, 12348, '12:01:53 am', '', '2022-11-28', '2022-11-27 17:01:53', 0),
(4, 20, 8, 1235, 12348, '12:01:59 am', '', '2022-11-28', '2022-11-27 17:01:59', 0),
(5, 20, 8, 1235, 12347, '08:42:10 pm', '', '2022-11-28', '2022-11-28 13:42:10', 0),
(6, 1, 8, 1235, 12348, '08:56:13 pm', '08:56:23 pm', '2022-11-28', '2022-11-28 13:56:23', 0),
(7, 1, 8, 1235, 12347, '08:56:36 pm', '', '2022-11-28', '2022-11-28 13:56:36', 0),
(8, 1, 8, 1235, 12347, '08:56:46 pm', '', '2022-11-28', '2022-11-28 13:56:46', 0),
(9, 1, 8, 1235, 12347, '08:56:51 pm', '', '2022-11-28', '2022-11-28 13:56:51', 0),
(10, 1, 8, 1235, 12347, '08:57:01 pm', '', '2022-11-28', '2022-11-28 13:57:01', 0),
(11, 1, 8, 1235, 12347, '08:57:13 pm', '', '2022-11-28', '2022-11-28 13:57:13', 0),
(12, 1, 8, 1235, 12347, '08:57:19 pm', '', '2022-11-28', '2022-11-28 13:57:19', 0),
(13, 1, 8, 1235, 12347, '08:57:31 pm', '08:57:41 pm', '2022-11-28', '2022-11-28 13:57:41', 0),
(14, 1, 8, 1235, 12348, '08:57:59 pm', '', '2022-11-28', '2022-11-28 13:57:59', 0),
(15, 1, 8, 1235, 12348, '08:58:02 pm', '', '2022-11-28', '2022-11-28 13:58:02', 0),
(16, 1, 8, 1235, 12347, '09:00:26 pm', '', '2022-11-28', '2022-11-28 14:00:26', 0),
(17, 1, 8, 1235, 12347, '09:00:50 pm', '', '2022-11-28', '2022-11-28 14:00:50', 0),
(18, 1, 8, 1235, 12346, '09:02:04 pm', '', '2022-11-28', '2022-11-28 14:02:04', 0),
(19, 1, 8, 1235, 12346, '06:24:43 pm', '', '2022-12-01', '2022-12-01 11:24:43', 0),
(20, 1, 8, 1235, 12346, '06:24:56 pm', '', '2022-12-01', '2022-12-01 11:24:56', 0),
(21, 1, 8, 1235, 12346, '06:26:42 pm', '', '2022-12-01', '2022-12-01 11:26:42', 0),
(22, 1, 8, 1235, 12346, '06:26:51 pm', '', '2022-12-01', '2022-12-01 11:26:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `live_class_setting`
--

CREATE TABLE `live_class_setting` (
  `id` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `zoom_api_key` varchar(500) NOT NULL,
  `zoom_api_secret` varchar(500) NOT NULL,
  `meeting_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `live_class_setting`
--

INSERT INTO `live_class_setting` (`id`, `batch`, `zoom_api_key`, `zoom_api_secret`, `meeting_number`, `password`, `status`, `admin_id`, `added_at`) VALUES
(3, 8, '70v2YIr3SQ-iOIX98OEOUg', '8tvle9VKYDFBxhYH7eCWVplZLjvFdB4YOWfM', '75697378277', 'i3bt98', 1, 1, '2022-12-01 18:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `mock_result`
--

CREATE TABLE `mock_result` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `paper_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `submit_time` time NOT NULL,
  `total_question` int(11) NOT NULL,
  `time_duration` varchar(255) NOT NULL,
  `attempted_question` int(11) NOT NULL,
  `question_answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `percentage` double NOT NULL,
  `added_on` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mock_result`
--

INSERT INTO `mock_result` (`id`, `admin_id`, `student_id`, `paper_id`, `paper_name`, `date`, `start_time`, `submit_time`, `total_question`, `time_duration`, `attempted_question`, `question_answer`, `percentage`, `added_on`) VALUES
(2, 1, 2, 3, 'Paper_NoName', '2022-11-13', '20:33:00', '20:33:48', 4, '90', 4, '{\"9\":\"A\",\"10\":\"A\",\"12\":\"A\",\"13\":\"C\"}', 100, '2022-11-13 20:33:49'),
(3, 1, 2, 4, 'Basing', '2022-11-15', '09:40:00', '09:41:39', 3, '900', 3, '{\"20\":\"D\",\"21\":\"C\",\"22\":\"D\"}', 58.33, '2022-11-15 09:41:41'),
(4, 1, 5, 6, 'Aquamarine', '2022-11-22', '08:11:00', '08:11:50', 4, '600', 4, '{\"28\":\"A\",\"29\":\"B\",\"30\":\"D\",\"31\":\"A\"}', 100, '2022-11-22 08:11:52'),
(5, 1, 6, 6, 'Aquamarine', '2022-11-22', '08:16:00', '08:16:19', 4, '600', 4, '{\"28\":\"B\",\"29\":\"C\",\"30\":\"A\",\"31\":\"C\"}', 0, '2022-11-22 08:16:20'),
(6, 1, 8, 7, 'User Guideline Test', '2022-11-26', '18:52:00', '18:52:39', 1, '1000', 1, '{\"34\":\"A\"}', 0, '2022-11-26 18:52:40'),
(7, 1, 6, 8, 'Usagi', '2022-12-01', '19:01:00', '19:02:35', 1, '1000', 1, '{\"57\":\"A\"}', 0, '2022-12-01 19:02:37'),
(8, 1, 8, 12, 'qwert', '2022-12-05', '16:10:00', '16:10:45', 1, '126', 1, '{\"64\":\"B\"}', 100, '2022-12-05 16:10:47'),
(9, 1, 15, 14, 'quizzzz', '2022-12-06', '03:38:00', '03:38:34', 4, '7200', 4, '{\"61\":\"A\",\"62\":\"A\",\"63\":\"A\",\"64\":\"A\"}', 37.5, '2022-12-06 03:38:36'),
(10, 1, 8, 15, '1wertyuio', '2022-12-06', '09:27:00', '09:31:04', 1, '1120', 1, '{\"70\":\"C\"}', 100, '2022-12-06 09:31:06'),
(11, 1, 8, 17, '57756765', '2022-12-06', '09:52:00', '09:52:45', 1, '3000', 1, '{\"71\":\"B\"}', 100, '2022-12-06 09:52:46'),
(12, 1, 8, 18, 'Testing_Again', '2022-12-06', '21:19:00', '21:44:31', 1, '120', 1, '{\"72\":\"C\"}', 100, '2022-12-06 21:44:33'),
(13, 1, 8, 20, 'Contoh Untuk Video', '2022-12-20', '11:21:00', '11:21:44', 4, '120', 4, '{\"74\":\"A\",\"75\":\"C\",\"76\":\"A\",\"77\":\"D\"}', 0, '2022-12-20 11:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `notes_pdf`
--

CREATE TABLE `notes_pdf` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notes_pdf`
--

INSERT INTO `notes_pdf` (`id`, `admin_id`, `title`, `batch`, `topic`, `subject`, `file_name`, `status`, `added_by`, `added_at`) VALUES
(1, 1, 'Ini_Notes', '[\"5\"]', '12345', '1234', '6._Manejemen_Waktu_dalam_Proyek_221107213446.pdf', 1, 18, '2022-11-07 21:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notice_for` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL,
  `admin_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `read_status` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `description`, `notice_for`, `status`, `date`, `admin_id`, `student_id`, `teacher_id`, `added_by`, `read_status`, `added_at`) VALUES
(1, 'Notis', 'Semoga kalian tidak belajar', 'Student', 1, '2022-11-28', 1, 0, 0, '', 0, '2022-11-28 14:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `time` datetime DEFAULT NULL,
  `seen_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `student_id`, `batch_id`, `notification_type`, `msg`, `url`, `status`, `time`, `seen_by`) VALUES
(1, 0, 0, 'Vacancy', 'New Upcoming Exam Added', 'student/vacancy', 0, '2022-10-28 12:48:08', '0000-00-00 00:00:00'),
(2, 2, 5, 'Extra-class', 'New ExtraClass Added', 'student/extra-classes', 1, '2022-11-07 19:46:02', '2022-11-07 19:46:16'),
(3, 2, 5, 'Exam', 'New Mock Paper Added', 'student/mock-paper', 1, '2022-11-07 20:01:19', '2022-11-07 20:01:48'),
(4, 2, 5, 'Library', 'New Book Added', 'student/book', 1, '2022-11-07 21:34:10', '2022-11-16 15:38:13'),
(5, 2, 5, 'Notes', 'New Notes Added', 'student/notes', 1, '2022-11-07 21:34:46', '2022-11-16 15:38:13'),
(6, 0, 0, 'Vacancy', 'New Upcoming Exam Added', 'student/vacancy', 0, '2022-11-07 22:19:53', '0000-00-00 00:00:00'),
(7, 2, 5, 'Exam', 'New Mock Paper Added', 'student/mock-paper', 1, '2022-11-13 20:32:38', '2022-11-16 15:38:13'),
(8, 2, 5, 'Exam', 'New Mock Paper Added', 'student/mock-paper', 1, '2022-11-15 09:38:43', '2022-11-16 15:38:13'),
(9, 2, 5, 'Exam', 'New Practice Paper Added', 'student/practice-paper', 1, '2022-11-16 15:41:33', '2022-11-16 15:41:51'),
(10, 5, 0, 'Notice', 'New Notice Added', 'student/notice', 1, '2022-11-28 14:11:15', '2022-12-01 17:38:37'),
(11, 6, 0, 'Notice', 'New Notice Added', 'student/notice', 1, '2022-11-28 14:11:15', '2022-12-01 19:00:30'),
(12, 7, 0, 'Notice', 'New Notice Added', 'student/notice', 1, '2022-11-28 14:11:15', '2022-12-04 18:51:07'),
(13, 8, 0, 'Notice', 'New Notice Added', 'student/notice', 1, '2022-11-28 14:11:15', '2022-12-01 18:01:33'),
(14, 9, 0, 'Notice', 'New Notice Added', 'student/notice', 0, '2022-11-28 14:11:15', '0000-00-00 00:00:00'),
(15, 10, 0, 'Notice', 'New Notice Added', 'student/notice', 0, '2022-11-28 14:11:15', '0000-00-00 00:00:00'),
(16, 11, 0, 'Notice', 'New Notice Added', 'student/notice', 0, '2022-11-28 14:11:15', '0000-00-00 00:00:00'),
(17, 12, 0, 'Notice', 'New Notice Added', 'student/notice', 0, '2022-11-28 14:11:15', '0000-00-00 00:00:00'),
(18, 13, 0, 'Notice', 'New Notice Added', 'student/notice', 0, '2022-11-28 14:11:15', '0000-00-00 00:00:00'),
(19, 14, 0, 'Notice', 'New Notice Added', 'student/notice', 0, '2022-11-28 14:11:15', '0000-00-00 00:00:00'),
(20, 15, 0, 'Notice', 'New Notice Added', 'student/notice', 1, '2022-11-28 14:11:15', '2022-12-06 03:22:42'),
(21, 16, 0, 'Notice', 'New Notice Added', 'student/notice', 0, '2022-11-28 14:11:15', '0000-00-00 00:00:00'),
(22, 17, 0, 'Notice', 'New Notice Added', 'student/notice', 0, '2022-11-28 14:11:15', '0000-00-00 00:00:00'),
(23, 0, 0, 'Vacancy', 'New Upcoming Exam Added', 'student/vacancy', 0, '2022-11-28 16:37:05', '0000-00-00 00:00:00'),
(24, 6, 9, 'Exam', 'New Test Paper Added', 'student/practice-paper', 1, '2022-12-06 03:25:02', '2022-12-06 21:55:28'),
(25, 6, 9, 'Exam', 'New Quiz Paper Added', 'student/mock-paper', 1, '2022-12-06 03:26:23', '2022-12-06 21:55:28'),
(26, 6, 7, 'Exam', 'New Test Paper Added', 'student/practice-paper', 1, '2022-12-06 21:55:17', '2022-12-06 21:55:28'),
(27, 7, 7, 'Exam', 'New Test Paper Added', 'student/practice-paper', 0, '2022-12-06 21:55:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `old_paper_pdf`
--

CREATE TABLE `old_paper_pdf` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `batch` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `topic` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `subject` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `file_name` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `old_paper_pdf`
--

INSERT INTO `old_paper_pdf` (`id`, `admin_id`, `title`, `batch`, `topic`, `subject`, `file_name`, `status`, `added_by`, `added_at`) VALUES
(1, 1, 'Ini_Old_Paper', '[\"5\"]', '', '1234', '7._Manajemen_Biaya_dalam_Proyek_221107213512.pdf', 1, 18, '2022-11-07 21:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `practice_result`
--

CREATE TABLE `practice_result` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `paper_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `submit_time` time NOT NULL,
  `total_question` int(11) NOT NULL,
  `time_duration` varchar(255) NOT NULL,
  `attempted_question` int(11) NOT NULL,
  `question_answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `percentage` double NOT NULL,
  `added_on` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `practice_result`
--

INSERT INTO `practice_result` (`id`, `admin_id`, `student_id`, `paper_id`, `paper_name`, `date`, `start_time`, `submit_time`, `total_question`, `time_duration`, `attempted_question`, `question_answer`, `percentage`, `added_on`) VALUES
(1, 1, 15, 13, 'testinggg', '2022-12-06', '03:32:00', '03:32:34', 4, '200', 4, '{\"66\":\"A\",\"67\":\"B\",\"68\":\"A\",\"69\":\"C\"}', 37.5, '2022-12-06 03:33:06'),
(2, 1, 15, 13, 'testinggg', '2022-12-06', '03:36:00', '03:36:08', 4, '200', 4, '{\"66\":\"A\",\"67\":\"A\",\"68\":\"C\",\"69\":\"A\"}', 6.25, '2022-12-06 03:36:09'),
(3, 1, 15, 13, 'testinggg', '2022-12-06', '03:36:00', '03:36:42', 4, '200', 4, '{\"66\":\"B\",\"67\":\"B\",\"68\":\"B\",\"69\":\"B\"}', 6.25, '2022-12-06 03:36:44'),
(4, 1, 15, 13, 'testinggg', '2022-12-06', '03:36:00', '03:37:04', 4, '200', 4, '{\"66\":\"A\",\"67\":\"A\",\"68\":\"A\",\"69\":\"A\"}', 37.5, '2022-12-06 03:37:07'),
(5, 1, 15, 13, 'testinggg', '2022-12-06', '03:54:00', '03:54:46', 4, '200', 1, '{\"68\":\"B\"}', 0, '2022-12-06 03:54:48'),
(6, 1, 6, 19, 'You', '2022-12-06', '21:56:00', '21:56:57', 1, '120', 1, '{\"73\":\"A\"}', 100, '2022-12-06 21:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy_data`
--

CREATE TABLE `privacy_policy_data` (
  `id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `privacy_policy_data`
--

INSERT INTO `privacy_policy_data` (`id`, `description`) VALUES
(1, '&lt;p&gt;Privasi dan Polri&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `options` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `admin_id`, `subject_id`, `chapter_id`, `question`, `options`, `answer`, `added_by`, `status`, `category`, `added_on`) VALUES
(67, 1, 1235, 12346, 'Bruh', '[\"Bruh?\",\"Bruh!\",\"Bruh\",\"Bruh.\"]', 'C', 20, 1, 0, '2022-12-06 01:09:37'),
(68, 1, 1235, 12346, 'Testing file', '[\"Opt A\",\"Opt B\",\"Opt C\",\"Opt D\"]', 'A', 20, 1, 0, '2022-12-06 01:09:37'),
(69, 1, 1235, 12346, 'Add more question if you want, by following the format', '[\"Ok\",\"OK\",\"Y\",\"Right\"]', 'B', 20, 1, 0, '2022-12-06 01:09:37'),
(70, 1, 1235, 12346, '<p>wikwok</p>\r\n', '[\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/deee72f68d5b_test.jpg\\u0022 style=\\u0022height:1080px; width:1920px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/85cb9c8e164d_test.png\\u0022 style=\\u0022height:354px; width:236px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/4a6c0cbabe19_test.png\\u0022 style=\\u0022height:472px; width:354px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003Eqwertyukl\\u003C\\/p\\u003E\\r\\n\"]', 'C', 1, 1, 0, '2022-12-06 09:26:20'),
(71, 1, 1235, 12346, '<p><img alt=\"\" src=\"https://www.akuamarin.my.id/assets/images/70d9fb132313_test.png\" style=\"float:left; height:300px; width:300px\" />&nbsp;sipapasi pukipuki cukimai</p>\r\n', '[\"\\u003Cp\\u003EKamisato dude\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/da3d2917ce81_test.png\\u0022 style=\\u0022height:200px; width:200px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003Emy partner in crime\\u0026nbsp;\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/b3982b367297_test.png\\u0022 style=\\u0022height:200px; width:200px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003Emy bro\\u0026nbsp;\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/8e40d3fab365_test.png\\u0022 style=\\u0022height:200px; width:200px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003Epala bapak kau\\u0026nbsp;\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/5615574998e1_test.png\\u0022 style=\\u0022height:200px; width:200px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\"]', 'B', 1, 1, 0, '2022-12-06 09:49:14'),
(72, 1, 1235, 12347, '<p><strong><img alt=\"\" src=\"https://www.akuamarin.my.id/assets/images/d3ea46efabaf_test.jpg\" style=\"float:left; height:500px; width:500px\" />Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', '[\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/f3a6772c28e0_test.jpg\\u0022 style=\\u0022float:left; height:281px; width:500px\\u0022 \\/\\u003EIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\u0026#39;Content here, content here\\u0026#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\u0026#39;lorem ipsum\\u0026#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cstrong\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/6e670df8d8b1_test.png\\u0022 style=\\u0022float:left; height:564px; width:500px\\u0022 \\/\\u003ELorem Ipsum\\u003C\\/strong\\u003E\\u0026nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\u0026#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\\u003C\\/p\\u003E\\r\\n\\r\\n\\u003Cp\\u003EIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\u0026#39;Content here, content here\\u0026#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\u0026#39;lorem ipsum\\u0026#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cstrong\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/96362e91a280_test.jpg\\u0022 style=\\u0022float:left; height:1083px; width:500px\\u0022 \\/\\u003ELorem Ipsum\\u003C\\/strong\\u003E\\u0026nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\u0026#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cstrong\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/ad19ce498096_test.jpg\\u0022 style=\\u0022float:left; height:500px; width:500px\\u0022 \\/\\u003ELorem Ipsum\\u003C\\/strong\\u003E\\u0026nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\u0026#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\\u003C\\/p\\u003E\\r\\n\"]', 'C', 1, 1, 0, '2022-12-06 21:15:14'),
(59, 1, 1235, 12346, '<p>Aku adalah</p>\r\n', '[\"\\u003Cp\\u003EI\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EMe\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EAI\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EMI\\u003C\\/p\\u003E\\r\\n\"]', 'B', 19, 1, 0, '2022-12-05 15:00:21'),
(60, 1, 1237, 12353, 'Who is the current President of Indonesia?', '[\"Soekarno\",\"Joko Widodo\",\"Aqua\",\"Marina\"]', 'B', 1, 1, 0, '2022-12-05 16:07:50'),
(61, 1, 1237, 12353, 'It is what….', '[\"It is\",\"that is\",\"that was\",\"it was\"]', 'A', 1, 1, 0, '2022-12-05 16:07:50'),
(62, 1, 1237, 12353, 'Bruh', '[\"Bruh?\",\"Bruh!\",\"Bruh\",\"Bruh.\"]', 'C', 1, 1, 0, '2022-12-05 16:07:50'),
(63, 1, 1237, 12353, 'Testing file', '[\"Opt A\",\"Opt B\",\"Opt C\",\"Opt D\"]', 'A', 1, 1, 0, '2022-12-05 16:07:50'),
(64, 1, 1237, 12353, 'Add more question if you want, by following the format', '[\"Ok\",\"OK\",\"Y\",\"Right\"]', 'B', 1, 1, 0, '2022-12-05 16:07:50'),
(65, 1, 1235, 12346, 'Who is the current President of Indonesia?', '[\"Soekarno\",\"Joko Widodo\",\"Aqua\",\"Marina\"]', 'B', 20, 1, 0, '2022-12-06 01:09:37'),
(66, 1, 1235, 12346, 'It is what….', '[\"It is\",\"that is\",\"that was\",\"it was\"]', 'A', 20, 1, 0, '2022-12-06 01:09:37'),
(58, 1, 1237, 12354, '<p>Ini soal<img alt=\"\" src=\"https://www.akuamarin.my.id/assets/images/cacf6dd6dafb_test.jpg\" style=\"height:1154px; width:1154px\" /></p>\r\n', '[\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/7fd62b4d7a29_test.jpg\\u0022 style=\\u0022height:600px; width:800px\\u0022 \\/\\u003EOpsi A\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/6ce821622a36_test.jpg\\u0022 style=\\u0022height:1080px; width:1920px\\u0022 \\/\\u003EOpsi B\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/fb554df06b36_test.jpg\\u0022 style=\\u0022height:1932px; width:2576px\\u0022 \\/\\u003EBenar\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/4f2370118b91_test.jpg\\u0022 style=\\u0022height:3000px; width:3000px\\u0022 \\/\\u003EOpsi D\\u003C\\/p\\u003E\\r\\n\"]', 'C', 1, 1, 0, '2022-12-01 19:04:06'),
(73, 1, 1235, 12347, '<p><img alt=\"\" src=\"https://www.akuamarin.my.id/assets/images/d90af8b6a4be_test.jpg\" style=\"float:left; height:800px; width:800px\" /><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '[\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/dbe63ab5d688_test.jpg\\u0022 style=\\u0022float:left; height:450px; width:800px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/b5d9b09da97e_test.jpg\\u0022 style=\\u0022float:left; height:450px; width:800px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/1bd84ae1d9dd_test.jpg\\u0022 style=\\u0022float:left; height:450px; width:800px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003E\\u003Cimg alt=\\u0022\\u0022 src=\\u0022https:\\/\\/www.akuamarin.my.id\\/assets\\/images\\/3faf480f9be9_test.jpg\\u0022 style=\\u0022float:left; height:500px; width:800px\\u0022 \\/\\u003E\\u003C\\/p\\u003E\\r\\n\"]', 'A', 1, 1, 0, '2022-12-06 21:51:51'),
(74, 1, 1235, 12348, 'Who is the current President of Indonesia?', '[\"Soekarno\",\"Joko Widodo\",\"Aqua\",\"Marina\"]', 'B', 1, 1, 0, '2022-12-20 11:10:59'),
(75, 1, 1235, 12348, 'It is what….', '[\"It is\",\"that is\",\"that was\",\"it was\"]', 'A', 1, 1, 0, '2022-12-20 11:10:59'),
(76, 1, 1235, 12348, 'Bruh', '[\"Bruh?\",\"Bruh!\",\"Bruh\",\"Bruh.\"]', 'C', 1, 1, 0, '2022-12-20 11:10:59'),
(77, 1, 1235, 12348, 'Testing file', '[\"Opt A\",\"Opt B\",\"Opt C\",\"Opt D\"]', 'A', 1, 1, 0, '2022-12-20 11:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `site_details`
--

CREATE TABLE `site_details` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_minilogo` varchar(255) NOT NULL,
  `site_loader` varchar(255) NOT NULL,
  `site_author` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `site_keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `site_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `enrollment_word` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `copyright_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timezone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `site_details`
--

INSERT INTO `site_details` (`id`, `site_title`, `site_favicon`, `site_logo`, `site_minilogo`, `site_loader`, `site_author`, `site_keywords`, `site_description`, `enrollment_word`, `copyright_text`, `timezone`) VALUES
(1, 'SSF E-Learning', 'ssf_white1.png', 'nyamping_new1.png', 'ssf_white.png', 'Hourglass.gif', 'Andi Wonosobo', 'Smart School Foundation, SSF', '&quot;Be smart with our private&quot;', 'SSF', 'Copyright © 2022 Smart School Foundation. All Right Reserved.', 'Asia/Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `enrollment_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `father_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `father_designtn` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch_id` text NOT NULL,
  `login_status` int(11) NOT NULL,
  `admission_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL COMMENT '(0 unpaid ) (1 paid)',
  `brewers_check` varchar(50) NOT NULL,
  `token` varchar(500) NOT NULL,
  `app_version` varchar(100) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `last_login_app` datetime NOT NULL,
  `pay_mode` int(11) NOT NULL,
  `multi_batch` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admin_id`, `name`, `enrollment_id`, `password`, `image`, `email`, `contact_no`, `gender`, `dob`, `father_name`, `father_designtn`, `address`, `batch_id`, `login_status`, `admission_date`, `status`, `payment_status`, `brewers_check`, `token`, `app_version`, `added_by`, `last_login_app`, `pay_mode`, `multi_batch`) VALUES
(6, 1, 'Sangonomiya Kokomi', 'SSF1589', '5471aad362780085fe8a12d6f763e7bb', 'kokomi.jpg', 'kokomi@gmail.com', '349128128323', 'female', '2003-11-12', 'Sangonomiya Dude', 'Pemancing Handal', '', '7', 0, '2022-11-19', 1, 0, 'hi51FnPJ8X', '1', '', 'student', '2022-12-06 21:54:32', 0, '[\"1\"]'),
(7, 1, 'Raiden Shogun', 'SSF1630', '2eded819c2f4c65cecb7e0dbc4e377ff', 'shogun.jpg', 'shogun@gmail.com', '342343254234', 'female', '2005-11-08', 'Raiden Suzuki', 'Pembalap', '', '7', 0, '2022-11-19', 1, 0, 'bSCOK154ot', '1', '', 'student', '2022-12-04 18:56:53', 0, '[\"1\"]'),
(8, 1, 'Hu Tao', 'SSF1724', 'a4b4b88b8cc98eff1ab5311f57f1bd79', 'hutao.jpg', 'hutao@ssf.com', '342341212312', 'female', '2004-11-08', 'Hu Gali Kubur', 'Gali Kubur', '', '13', 0, '2022-11-19', 1, 0, '2uBaJrYcnR', '1', '', 'student', '2022-12-20 11:20:19', 0, '[\"1\"]'),
(9, 1, 'Datuk Bokek', 'SSF1816', '8805b735f0fb6057252fe9fb54e0b3b0', 'zhongli.jpg', 'zhongli@ssf.com', '674523412', 'male', '2005-11-14', 'Zhongli', 'Dewa', '', '[\"8\"]', 0, '2022-11-19', 1, 0, 'g8lJhBfnqQ', '1', '', '', '0000-00-00 00:00:00', 0, ''),
(10, 1, 'Tatang Surtatang', 'SSF1921', '342701a71a0f3827184574c3149d1331', 'childe.jpg', 'tatang@ssf.com', '98657667', 'male', '2000-11-01', 'Tatangia', 'Atlet Rusuh', '', '[\"8\"]', 1, '2022-11-19', 1, 0, '0lDHeu5Xfx', '1', '', '', '0000-00-00 00:00:00', 0, ''),
(11, 1, 'John MacTavish', 'SSF11014', 'd11bb0bd5b13178d4f0a49d33b6de9a0', 'soap.jpg', 'soap@ssf.com', '76543212214', 'male', '2003-11-03', 'John', 'Englishman', '', '[\"7\"]', 0, '2022-11-19', 1, 0, 'sScg8zZ0y3', '1', '', '', '0000-00-00 00:00:00', 0, ''),
(12, 1, 'Kamisato Ayaka', 'SSF11188', '661471524cb17b011a1dc714f8429db5', 'ayaka.jpg', 'ayaka@ssf.com', '32410999', 'female', '2004-11-03', 'Kamisato Dude', 'samrai', '', '[\"8\"]', 0, '2022-11-19', 1, 0, 'Nn04hMHvW8', '1', '', '', '0000-00-00 00:00:00', 0, ''),
(13, 1, 'Kyle Garrick', 'SSF11287', '8313bd6f708a9dbaa05bbff5b954c50d', 'gaz.jpg', 'gaz@ssf.com', '23123123', 'male', '2006-11-02', 'Kail Garuk', 'Penggaruk', '', '[\"7\"]', 0, '2022-11-19', 1, 0, 'UCzH58FT3w', '1', '', '', '0000-00-00 00:00:00', 0, ''),
(14, 1, 'John Price', 'SSF11392', '202cb962ac59075b964b07152d234b70', 'price.jpg', 'price@ssf.com', '123341231231', 'male', '2001-11-06', 'Johnson', 'Jon', '', '[\"7\"]', 0, '2022-11-19', 1, 0, 'x93L2UyD1C', '1', '', '', '0000-00-00 00:00:00', 0, ''),
(15, 1, 'Alejandro Vargas', 'SSF11416', '6630813dbfeaf52a056c0deb20cd4b33', 'vargas.png', 'alejandro@ssf.com', '1302392139', 'male', '2022-11-01', 'Ale', 'Ale Ale', '', '[\"9\"]', 1, '2022-11-19', 1, 0, 'ksgi0IHYqE', '1', '', '', '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `student_doubts_class`
--

CREATE TABLE `student_doubts_class` (
  `doubt_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `subjects_id` varchar(100) NOT NULL,
  `chapters_id` varchar(500) NOT NULL,
  `users_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL COMMENT '0 = pending, 1 = approve, 2 = decline',
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_payment_history`
--

CREATE TABLE `student_payment_history` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `transaction_id` longtext NOT NULL,
  `mode` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_payment_history`
--

INSERT INTO `student_payment_history` (`id`, `student_id`, `batch_id`, `transaction_id`, `mode`, `amount`, `create_at`, `admin_id`) VALUES
(1, 2, 1, 'Cash', 'offline', 0, '2022-10-18 10:08:50', 1),
(2, 3, 1, 'Cash', 'offline', 0, '2022-10-18 10:12:59', 1),
(3, 2, 1, 'Cash', 'offline', 0, '2022-10-24 21:36:54', 1),
(4, 2, 1, 'Cash', 'offline', 0, '2022-10-24 21:38:12', 1),
(5, 3, 1, 'Cash', 'offline', 0, '2022-10-24 21:39:42', 1),
(6, 4, 1, 'Cash', 'offline', 0, '2022-10-24 21:53:56', 1),
(7, 3, 1, 'Cash', 'offline', 0, '2022-10-24 22:00:59', 1),
(8, 4, 1, 'Cash', 'offline', 0, '2022-10-24 22:01:18', 1),
(9, 5, 8, 'Cash', 'offline', 0, '2022-11-19 20:44:15', 1),
(10, 6, 8, 'Cash', 'offline', 0, '2022-11-19 20:46:34', 1),
(11, 7, 8, 'Cash', 'offline', 0, '2022-11-19 20:49:35', 1),
(12, 8, 8, 'Cash', 'offline', 0, '2022-11-19 20:51:13', 1),
(13, 9, 8, 'Cash', 'offline', 0, '2022-11-19 20:52:48', 1),
(14, 10, 8, 'Cash', 'offline', 0, '2022-11-19 21:05:32', 1),
(15, 11, 7, 'Cash', 'offline', 0, '2022-11-19 21:17:05', 1),
(16, 12, 8, 'Cash', 'offline', 0, '2022-11-19 21:18:56', 1),
(17, 13, 7, 'Cash', 'offline', 0, '2022-11-19 21:21:04', 1),
(18, 14, 7, 'Cash', 'offline', 0, '2022-11-19 21:31:58', 1),
(19, 15, 9, 'Cash', 'offline', 0, '2022-11-19 21:34:50', 1),
(20, 16, 9, 'Cash', 'offline', 0, '2022-11-19 21:36:56', 1),
(21, 17, 9, 'Cash', 'offline', 0, '2022-11-19 21:38:18', 1),
(22, 18, 9, 'Cash', 'offline', 0, '2022-11-28 17:15:38', 1),
(23, 19, 8, 'Cash', 'offline', 0, '2022-11-28 20:40:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `no_of_questions` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `status`, `no_of_questions`, `admin_id`) VALUES
(1235, 'English For Idiots', 1, 37, 1),
(1236, 'User Guideline Subject', 1, 1, 1),
(1237, 'PTI-OKEE', 1, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sudent_batchs`
--

CREATE TABLE `sudent_batchs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `added_by` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sudent_batchs`
--

INSERT INTO `sudent_batchs` (`id`, `student_id`, `batch_id`, `status`, `create_at`, `added_by`, `admin_id`) VALUES
(4, 2, 1, 0, '2022-10-24 21:38:12', 'Admin', 1),
(7, 3, 1, 0, '2022-10-24 22:00:59', 'Admin', 1),
(8, 4, 1, 0, '2022-10-24 22:01:18', 'Admin', 1),
(9, 2, 2, 0, '2022-11-07 13:59:08', 'student', 1),
(10, 2, 6, 0, '2022-11-07 14:39:26', 'student', 1),
(11, 2, 4, 0, '2022-11-07 19:40:10', 'student', 1),
(12, 2, 5, 0, '2022-11-07 19:45:25', 'student', 1),
(14, 6, 8, 0, '2022-11-19 20:46:34', 'Admin', 1),
(15, 7, 8, 0, '2022-11-19 20:49:35', 'Admin', 1),
(16, 8, 8, 0, '2022-11-19 20:51:13', 'Admin', 1),
(17, 9, 8, 0, '2022-11-19 20:52:48', 'Admin', 1),
(18, 10, 8, 0, '2022-11-19 21:05:32', 'Admin', 1),
(19, 11, 7, 0, '2022-11-19 21:17:05', 'Admin', 1),
(20, 12, 8, 0, '2022-11-19 21:18:56', 'Admin', 1),
(21, 13, 7, 0, '2022-11-19 21:21:04', 'Admin', 1),
(22, 14, 7, 0, '2022-11-19 21:31:58', 'Admin', 1),
(23, 15, 9, 0, '2022-11-19 21:34:50', 'Admin', 1),
(24, 16, 9, 0, '2022-11-19 21:36:56', 'Admin', 1),
(29, 7, 9, 0, '2022-12-04 18:56:03', 'student', 1),
(30, 7, 7, 0, '2022-12-04 18:56:53', 'student', 1),
(31, 6, 9, 0, '2022-12-06 01:27:01', 'student', 1),
(32, 8, 10, 0, '2022-12-06 09:09:11', 'student', 1),
(33, 6, 7, 0, '2022-12-06 21:54:32', 'student', 1),
(34, 8, 13, 0, '2022-12-20 11:20:19', 'student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_data`
--

CREATE TABLE `temp_data` (
  `id` int(11) NOT NULL,
  `temp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `term_condition_data`
--

CREATE TABLE `term_condition_data` (
  `id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `term_condition_data`
--

INSERT INTO `term_condition_data` (`id`, `description`) VALUES
(1, '&lt;p&gt;Terminator dan Kondisi&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `theme_color`
--

CREATE TABLE `theme_color` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `primary_color` varchar(500) NOT NULL,
  `border_color` varchar(500) NOT NULL,
  `font_color` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theme_color`
--

INSERT INTO `theme_color` (`id`, `admin_id`, `primary_color`, `border_color`, `font_color`) VALUES
(1, 1, '#4d4a81', '#e7e7e9', '#888888'),
(2, 1, '#514D8D', '#7C78CB', '#6C68B3'),
(3, 1, '#C2BC8B', '#091C15', '#3D6657');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin_id` text NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL COMMENT '1 - admin, 3 - teacher',
  `teach_education` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teach_image` varchar(255) NOT NULL,
  `teach_batch` varchar(255) NOT NULL,
  `teach_subject` varchar(255) NOT NULL,
  `teach_gender` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `token` text NOT NULL,
  `brewers_check` varchar(500) NOT NULL,
  `super_admin` text NOT NULL,
  `access` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin_id`, `name`, `email`, `password`, `role`, `teach_education`, `teach_image`, `teach_batch`, `teach_subject`, `teach_gender`, `parent_id`, `status`, `token`, `brewers_check`, `super_admin`, `access`) VALUES
(1, '1', 'admin', 'admin@ssf.com', '76d80224611fc919a5d54f0ff9fba446', 1, '', '', '', '', '', 0, 1, '1', 'OtRFXZbHWr', '1', ''),
(19, '1', 'Shaq O Neal', 'shaq@gmail.com', 'dd6652895030f6b3b1b711d8334192f2', 3, 'Bachelor of English British', 'shaq.jpg', '7', '[\"1235\"]', 'male', 1, 1, '1', 'qC9Qzb1OFe', '', '{\"academics\":null,\"live_class\":null,\"notice\":\"1\",\"assignment\":\"1\",\"extraclasses\":null,\"doubtsask\":null,\"video_lecture\":null,\"question_manager\":\"1\",\"course_content\":\"1\",\"student_leave\":\"1\",\"student_manage\":\"1\",\"exam\":null}'),
(20, '1', 'Shaq Kesurupan', 'shap@gmail.com', 'f7968361b24e2189c636bf03a51ab926', 3, 'Bachelor of English Japanese', 'posessed_shaq.jpg', '8,10,11', '[\"1235\"]', 'male', 1, 1, '1', 'lX6moSHeg2', '', '{\"academics\":null,\"live_class\":null,\"notice\":\"1\",\"assignment\":\"1\",\"extraclasses\":null,\"doubtsask\":null,\"video_lecture\":null,\"question_manager\":\"1\",\"course_content\":\"1\",\"student_leave\":\"1\",\"student_manage\":\"1\",\"exam\":null}'),
(21, '1', 'Shaq Bangkit', 'shay@gmail.com', '0780a9d09fa68c211ad81d017827be8e', 3, 'Bachelor of English Murica', 'ascended_shaq.jpg', '9,12,13', '[\"1235\"]', 'male', 1, 1, '1', 'IHC5Ewd3sf', '', '{\"academics\":null,\"live_class\":null,\"notice\":\"1\",\"assignment\":\"1\",\"extraclasses\":null,\"doubtsask\":null,\"video_lecture\":null,\"question_manager\":\"1\",\"course_content\":\"1\",\"student_leave\":\"1\",\"student_manage\":\"1\",\"exam\":null}'),
(22, '1', 'Aqua', 'aqua@gmail.com', '65cb59645b852c2394ba3ff8b295e83c', 3, 'Magister of Mulut Anda Kotor', 'kau.jpg', '', '[\"1236\"]', 'male', 1, 1, '', '', '', '{\"academics\":null,\"live_class\":null,\"notice\":\"1\",\"assignment\":\"1\",\"extraclasses\":null,\"doubtsask\":null,\"video_lecture\":null,\"question_manager\":\"1\",\"course_content\":\"1\",\"student_leave\":\"1\",\"student_manage\":null,\"exam\":null}'),
(23, '1', 'Ahmad HohoHihi', 'paahmad@ssf.com', '76d80224611fc919a5d54f0ff9fba446', 3, 'SMA', 'itera1.png', '', '[\"1237\"]', 'male', 1, 1, '', '', '', '{\"academics\":null,\"live_class\":\"1\",\"notice\":\"1\",\"assignment\":\"1\",\"extraclasses\":\"1\",\"doubtsask\":null,\"video_lecture\":null,\"question_manager\":null,\"course_content\":null,\"student_leave\":null,\"student_manage\":null,\"exam\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `last_date` date NOT NULL,
  `mode` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_lectures`
--

CREATE TABLE `video_lectures` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `url` varchar(255) NOT NULL,
  `video_type` varchar(255) NOT NULL,
  `preview_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `video_lectures`
--

INSERT INTO `video_lectures` (`id`, `admin_id`, `title`, `batch`, `topic`, `subject`, `description`, `url`, `video_type`, `preview_type`, `status`, `added_by`, `added_at`) VALUES
(2, 1, 'Test_Video', '9', 'How To English', 'English For Idiots', 'Test', 'uploads/video/Facebook_3.mp4', 'video', 'not_preview', 1, 1, '2022-11-27 23:55:32'),
(3, 1, 'tobat', '8', 'How To English', 'English For Idiots', 'jangan lupa tobat', 'https://www.youtube.com/watch?v=Qeb8tLjJH2E', 'youtube', 'not_preview', 1, 20, '2022-11-29 16:39:58'),
(4, 1, 'tobat', '8', 'Why English', 'English For Idiots', 'tobat', 'https://www.youtube.com/watch?v=Qeb8tLjJH2E', 'youtube', 'not_preview', 1, 20, '2022-11-29 16:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `views_notification_student`
--

CREATE TABLE `views_notification_student` (
  `n_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `notice_type` varchar(100) NOT NULL,
  `views_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zoom_api_credentials`
--

CREATE TABLE `zoom_api_credentials` (
  `id` int(11) NOT NULL,
  `android_api_key` varchar(250) NOT NULL,
  `android_api_secret` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_versions`
--
ALTER TABLE `app_versions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `batch_category`
--
ALTER TABLE `batch_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `batch_fecherd`
--
ALTER TABLE `batch_fecherd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_subcategory`
--
ALTER TABLE `batch_subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `batch_subjects`
--
ALTER TABLE `batch_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments_reply`
--
ALTER TABLE `blog_comments_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_pdf`
--
ALTER TABLE `book_pdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_setting`
--
ALTER TABLE `certificate_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `extra_classes`
--
ALTER TABLE `extra_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `extra_class_attendance`
--
ALTER TABLE `extra_class_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `frontend_details`
--
ALTER TABLE `frontend_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `leave_management`
--
ALTER TABLE `leave_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`teacher_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `live_class_history`
--
ALTER TABLE `live_class_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_class_setting`
--
ALTER TABLE `live_class_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mock_result`
--
ALTER TABLE `mock_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `notes_pdf`
--
ALTER TABLE `notes_pdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `old_paper_pdf`
--
ALTER TABLE `old_paper_pdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `practice_result`
--
ALTER TABLE `practice_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `privacy_policy_data`
--
ALTER TABLE `privacy_policy_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `site_details`
--
ALTER TABLE `site_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `student_doubts_class`
--
ALTER TABLE `student_doubts_class`
  ADD PRIMARY KEY (`doubt_id`);

--
-- Indexes for table `student_payment_history`
--
ALTER TABLE `student_payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sudent_batchs`
--
ALTER TABLE `sudent_batchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_data`
--
ALTER TABLE `temp_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_condition_data`
--
ALTER TABLE `term_condition_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_color`
--
ALTER TABLE `theme_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `video_lectures`
--
ALTER TABLE `video_lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `views_notification_student`
--
ALTER TABLE `views_notification_student`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `zoom_api_credentials`
--
ALTER TABLE `zoom_api_credentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_versions`
--
ALTER TABLE `app_versions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `batch_category`
--
ALTER TABLE `batch_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `batch_fecherd`
--
ALTER TABLE `batch_fecherd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `batch_subcategory`
--
ALTER TABLE `batch_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123467;

--
-- AUTO_INCREMENT for table `batch_subjects`
--
ALTER TABLE `batch_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_comments_reply`
--
ALTER TABLE `blog_comments_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_pdf`
--
ALTER TABLE `book_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate_setting`
--
ALTER TABLE `certificate_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12355;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `extra_classes`
--
ALTER TABLE `extra_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `extra_class_attendance`
--
ALTER TABLE `extra_class_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `frontend_details`
--
ALTER TABLE `frontend_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_management`
--
ALTER TABLE `leave_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `live_class_history`
--
ALTER TABLE `live_class_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `live_class_setting`
--
ALTER TABLE `live_class_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mock_result`
--
ALTER TABLE `mock_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notes_pdf`
--
ALTER TABLE `notes_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `old_paper_pdf`
--
ALTER TABLE `old_paper_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `practice_result`
--
ALTER TABLE `practice_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `privacy_policy_data`
--
ALTER TABLE `privacy_policy_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `site_details`
--
ALTER TABLE `site_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student_doubts_class`
--
ALTER TABLE `student_doubts_class`
  MODIFY `doubt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_payment_history`
--
ALTER TABLE `student_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1238;

--
-- AUTO_INCREMENT for table `sudent_batchs`
--
ALTER TABLE `sudent_batchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `temp_data`
--
ALTER TABLE `temp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term_condition_data`
--
ALTER TABLE `term_condition_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `theme_color`
--
ALTER TABLE `theme_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `video_lectures`
--
ALTER TABLE `video_lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `views_notification_student`
--
ALTER TABLE `views_notification_student`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoom_api_credentials`
--
ALTER TABLE `zoom_api_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
