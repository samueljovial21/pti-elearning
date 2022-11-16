-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2022 at 04:33 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eacademy`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_versions`
--

CREATE TABLE `app_versions` (
  `id` int(11) NOT NULL,
  `latest_version` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `admin_id`, `cat_id`, `sub_cat_id`, `batch_name`, `start_date`, `end_date`, `start_time`, `end_time`, `batch_type`, `batch_price`, `batch_offer_price`, `description`, `batch_image`, `no_of_student`, `status`, `pay_mode`) VALUES
(1, 1, 123, 123456, 'Hehe_Batch', '2022-10-18', '2024-10-18', '00:00:00', '06:00:00', 1, '', '', '', '', 0, 1, 'Online'),
(2, 1, 123, 123456, 'Ini_Testing_Batch_2', '2022-10-29', '2023-10-29', '07:00:00', '10:00:00', 1, '', '', 'Ini testing deskripsi', 'putih_github_221029175754.png', 1, 1, 'Online'),
(3, 1, 127, 123460, 'Kelas A', '2022-10-29', '2022-10-30', '00:00:00', '00:00:00', 1, '', '', 'Gambar Test', '20201001_170421_221029200246.jpg', 0, 0, 'Online'),
(4, 1, 127, 123461, 'English_UTBK', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', 1, '', '', 'This is a preparation of UTBK Course', 'Hehe_221107140212.jpg', 1, 1, 'Online'),
(5, 1, 128, 123458, 'Belajar_Dasar_English', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', 1, '', '', 'Ayam', 'DSCF9871_221107141309.JPG', 1, 1, 'Online'),
(6, 1, 128, 123458, 'Programming_English', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', 1, '', '', 'One Ok Rock', '_21_one-ok-rock-wallpaper_One-Ok-Rock-Taking-Off-official-Video-From-Nagisaen-_logo_added_221107141604.jpg', 1, 1, 'Online');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_category`
--

INSERT INTO `batch_category` (`id`, `name`, `slug`, `status`, `time`, `admin_id`) VALUES
(123, 'Batch_Testing', 'Just a testing bacth', 1, '2022-10-18 02:57:51', 1),
(126, 'SMP', 'smp', 1, '2022-10-29 09:42:47', 1),
(127, 'SMA', 'sma', 1, '2022-10-29 09:42:53', 1),
(128, 'Perguruan Tinggi', 'perguruan_tinggi', 1, '2022-10-29 09:43:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `batch_fecherd`
--

CREATE TABLE `batch_fecherd` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `batch_specification_heading` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch_fecherd` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, 6, 'No Benefit', '[\"No Fitures\"]');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_subcategory`
--

INSERT INTO `batch_subcategory` (`id`, `cat_id`, `name`, `slug`, `status`, `time`, `admin_id`) VALUES
(123456, 123, 'Test_Subcategory', 'test', 1, '2022-10-18 03:03:51', 1),
(123457, 128, 'Bimbingan TOEFL', 'bimbingan_toefl', 1, '2022-10-29 09:45:43', 1),
(123458, 128, 'Umum', 'umum', 1, '2022-10-29 09:45:59', 1),
(123459, 127, 'X', 'x', 1, '2022-10-29 13:00:01', 1),
(123460, 127, 'XI', 'xi', 1, '2022-10-29 13:00:10', 1),
(123461, 127, 'XII', 'xii', 1, '2022-10-29 13:00:16', 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch_subjects`
--

INSERT INTO `batch_subjects` (`id`, `batch_id`, `teacher_id`, `subject_id`, `chapter`, `sub_start_date`, `sub_end_date`, `sub_start_time`, `sub_end_time`, `chapter_status`, `chapter_complt_date`, `total_chapter_complt_date`, `added_on`) VALUES
(1, 1, 15, 1234, '[\"12345\"]', '2022-10-18', '2023-10-18', '00:00:00', '06:00:00', '', '', '0000-00-00 00:00:00', '2022-10-18 10:07:34'),
(4, 2, 17, 1234, '[\"12345\"]', '2022-10-29', '2023-10-28', '07:00:00', '10:00:00', '', '', '0000-00-00 00:00:00', '2022-11-07 13:38:19'),
(3, 3, 18, 1234, '[\"12345\"]', '2022-10-29', '2022-10-30', '00:00:00', '00:00:00', '', '', '0000-00-00 00:00:00', '2022-10-29 20:02:46'),
(5, 4, 18, 1234, '[\"12345\"]', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', '', '', '0000-00-00 00:00:00', '2022-11-07 14:02:12'),
(6, 5, 18, 1234, '[\"12345\"]', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', '', '', '0000-00-00 00:00:00', '2022-11-07 14:13:09'),
(7, 6, 18, 1234, '[\"12345\"]', '2022-11-07', '2023-11-07', '00:00:00', '12:00:00', '', '', '0000-00-00 00:00:00', '2022-11-07 14:16:04');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_pdf`
--

INSERT INTO `book_pdf` (`id`, `admin_id`, `title`, `batch`, `topic`, `subject`, `file_name`, `status`, `added_by`, `added_at`) VALUES
(1, 1, 'Ini_Buku', '[\"5\"]', '', '1234', 'Kelas-RB-Kelompok-04221107213410.pdf', 1, 18, '2022-11-07 21:34:10');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `subject_id`, `chapter_name`, `status`, `no_of_questions`) VALUES
(12345, 1234, 'Testing_Chapter', 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL,
  `course_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `admin_id`, `name`, `type`, `format`, `batch_id`, `total_question`, `time_duration`, `question_ids`, `mock_sheduled_date`, `mock_sheduled_time`, `status`, `added_by`, `added_at`) VALUES
(1, 1, 'Developing_Test_Paper', 1, 1, 1, '1', '10', '[\"1\"]', '2022-10-29', '06:40:00', 1, 1, '2022-10-29 15:52:03'),
(2, 1, 'Test_Quiz', 1, 1, 5, '4', '60', '[\"12\",\"8\",\"7\",\"6\"]', '2022-11-07', '20:00:00', 1, 1, '2022-11-07 20:01:19');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra_classes`
--

INSERT INTO `extra_classes` (`id`, `admin_id`, `date`, `start_time`, `end_time`, `teacher_id`, `description`, `status`, `batch_id`, `added_at`, `completed_date_time`) VALUES
(1, 1, '2022-11-08', '07:00:00', '09:00:00', 18, 'Desc', 'Incomplete', '[\"4\"]', '2022-11-07 19:39:52', '0000-00-00 00:00:00'),
(2, 1, '2022-11-09', '06:00:00', '08:00:00', 18, 'Ok', 'Incomplete', '[\"5\"]', '2022-11-07 19:45:18', '0000-00-00 00:00:00'),
(3, 1, '2022-11-10', '08:00:00', '09:00:00', 18, 'Okehhh', 'Incomplete', '[\"5\"]', '2022-11-07 19:46:02', '0000-00-00 00:00:00');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frontend_details`
--

INSERT INTO `frontend_details` (`id`, `mobile`, `email`, `address`, `facebook`, `youtube`, `twitter`, `instagram`, `linkedin`, `map_api`, `slider_details`, `cont_heading`, `cont_sub_heading`, `cont_form_heading`, `faci_heading`, `faci_sub_heading`, `frst_crse_heading`, `frst_crse_sub_heading`, `frst_crse_desc`, `sec_crse_heading`, `sec_crse_sub_heading`, `abt_frst_heading`, `abt_frst_sub_heading`, `abt_year`, `abt_frst_desc`, `abt_frst_img`, `abt_sec_img`, `abt_sec_heading`, `abt_sec_desc`, `abt_secbtn_text`, `abt_secbtn_url`, `abt_thrd_heading`, `abt_thrd_sub_heading`, `abt_thrd_desc`, `abt_thrd_img`, `total_toppers`, `trusted_students`, `years_of_histry`, `testimonial`, `testi_heading`, `testi_subheading`, `selectn_heading`, `selectn_subheading`, `selection`, `teacher_heading`, `teacher_subheading`, `no_of_teacher`, `header_btn_txt`, `header_btn_url`, `client_imgs`) VALUES
(1, '081379523955', 'NoEmailYet@nomail.com', 'Jl, Karang Rejo, Kec. Semaka, Kabupaten Tanggamus, Lampung 35386', 'https://web.facebook.com/groups/406245664709720/', 'https://www.youtube.com/channel/UCKTAiQlRx1YFd6LcXsDL5Ew', 'https://www.twitter.com', 'https://www.instagram.com/smart_school_foundation/', 'https://www.linkedin.com', '', '{\"slider_heading\":[\"&quot;Be Smart with Our Private&quot;\",\"Raih Prestasimu Bersama Kami\",\"Siap Membimbingmu Menuju Dunia Penuh Prestasi\"],\"slider_subheading\":[\"Welcome to SSF E-Learning\",\"Ayo Bergabung\",\"Mari Bergabung Bersama Kami\"],\"slider_desc\":[\"\",\"\",\"\"],\"slider_img\":[\"page.jpg\",\"page_2.jpg\",\"page_3.jpg\"]}', 'Hubungi kami bila berminat di :', 'MARI BERGABUNG', 'Anda dapat mengirim pesan kepada kami juga di sini :', 'Tersedia', 'Fasilitas-fasilitas Kami', 'Online Learning Plateform', 'WE ARE E - ACADEMY', '', 'Course Kami', 'KAMI SIAP MEMBIMBING ANDA', 'Smart School Foundation', 'Tentang Kami', '2012', 'Smart School Foundation adalah lembaga kursus bahasa Inggris yang beralamat di Jl. Alim Ulama No. 1 Semaka Kabupaten Tanggamus. Smart School Foundation sudah berdiri sejak tahun 2012. Jenjang pendidikan lembaga ini dimulai dari jenjang SD sampai dengan Umum. Tersedia kelas dengan mekanisme offline dan online. Selain kelas reguler, terdapat juga kelas prestasi untuk mengasah kemampuan dan minat bakat dalam berbahasa Inggris.', 'page_4.jpg', 'page_5.jpg', 'Kami siap membimbing Anda dari dasar hingga puncak.', 'Tunggu apa lagi? Mari bergabung bersama kami', 'Hubungi Kami', 'http://kamleshyadav.in/e-academy/contact-us', 'Mengapa Memilih Kami Dibanding dengan yang Lain?', 'Misi Kami adalah Memberikan yang Terbaik Bagi Anda', 'Misi kami adalah membantu Anda mencapai tingkat kepuasan Anda dalam belajar berbahasa Inggris. Kami sudah membantu beragam kalangan baik dari SD sampai dengan Umum untuk mencapai tingkat maksimum mereka.<br><br>Dengan bergabung pada kami, kami berharap untuk dapat memberikan yang terbaik bagi Anda hingga tingkat kepuasan tertinggi Anda dalam proses belajar berbahasa Inggris', 'about.jpg', 54, 100, 10, '{\"4\":\"fsghhjjgh\",\"3\":\"fgfhg jjyjy qweqe qewfre ret\",\"1\":\"Consectetur adipiscing elit, sed do eiusmod tempor incididunt uerset labore et dolore magna aliqua. Qesuis ipsum esuspendisse ultriceies gravida Risus commodo viverra andes aecenas accumsan lacus vel facilisis. \",\"2\":\"Consectetur adipiscing elit, sed do eiusmod tempor incididunt uerset labore et dolore magna aliqua. Qesuis ipsum esuspendisse ultriceies gravida Risus commodo viverra andes aecenas accumsan lacus vel facilisis. \"}', 'Apa yang bimbingan kami katakan?', 'REVIEW OLEH BIMBINGAN', 'Perkenalkan', 'Para Bimbingan Kami', '{\"2\":\"student\",\"3\":\"student\",\"1\":\"student\"}', 'Perkenalkan', 'Para Tentor', 6, '', '', '[\"011.png\",\"021.png\",\"031.png\",\"041.png\",\"051.png\",\"063.png\"]');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `type`, `upload`, `image`, `video_url`, `video`, `status`, `admin_id`) VALUES
(1, 'OneOkRock', 'Image', 'File', '_21_one-ok-rock-wallpaper_One-Ok-Rock-Taking-Off-official-Video-From-Nagisaen-_logo_added.jpg', '', '', 1, 1),
(2, 'Queen_Meme', 'Video', 'File', '', '', '305800521_3280359682212129_1031705061698675248_n.mp4', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `key_text` text NOT NULL,
  `velue_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homeworks`
--

INSERT INTO `homeworks` (`id`, `admin_id`, `teacher_id`, `date`, `subject_id`, `batch_id`, `description`, `added_at`) VALUES
(1, 1, 18, '2022-11-07', 1234, '5', 'Ini Tugas', '2022-11-07 21:24:47');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `student_id`, `batch_id`, `notification_type`, `msg`, `url`, `status`, `time`, `seen_by`) VALUES
(1, 0, 0, 'Vacancy', 'New Upcoming Exam Added', 'student/vacancy', 0, '2022-10-28 12:48:08', '0000-00-00 00:00:00'),
(2, 2, 5, 'Extra-class', 'New ExtraClass Added', 'student/extra-classes', 1, '2022-11-07 19:46:02', '2022-11-07 19:46:16'),
(3, 2, 5, 'Exam', 'New Quiz Paper Added', 'student/mock-paper', 1, '2022-11-07 20:01:19', '2022-11-07 20:01:48'),
(4, 2, 5, 'Library', 'New Book Added', 'student/book', 0, '2022-11-07 21:34:10', '0000-00-00 00:00:00'),
(5, 2, 5, 'Notes', 'New Notes Added', 'student/notes', 0, '2022-11-07 21:34:46', '0000-00-00 00:00:00'),
(6, 0, 0, 'Vacancy', 'New Upcoming Exam Added', 'student/vacancy', 0, '2022-11-07 22:19:53', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy_data`
--

CREATE TABLE `privacy_policy_data` (
  `id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `admin_id`, `subject_id`, `chapter_id`, `question`, `options`, `answer`, `added_by`, `status`, `category`, `added_on`) VALUES
(1, 1, 1234, 12345, '<p>Who&#39;s this?<img alt=\"\" src=\"http://localhost:8080/pti-elearning/assets/images/25d691e14fa9_test.png\" style=\"height:605px; width:536px\" /></p>\r\n', '[\"\\u003Cp\\u003EKowalksky\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003ERico\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EJokow....\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EWho know\\u0026#39;s?\\u003C\\/p\\u003E\\r\\n\"]', 'A', 1, 1, 0, '2022-10-28 15:13:49'),
(2, 1, 1234, 12345, 'Adaptive radiation in fishes started about number of million years ago1:', '[1200,500,1000,1500]', 'D', 1, 1, 0, '2022-11-01 08:02:47'),
(3, 1, 1234, 12345, 'Adaptive radiation in fishes started about number of million years ago2:', '[1200,500,1000,1500]', 'B', 1, 1, 0, '2022-11-01 08:02:47'),
(4, 1, 1234, 12345, 'Adaptive radiation in fishes started about number of million years ago3', '[1200,500,1000,1500]', 'A', 1, 1, 0, '2022-11-01 08:02:47'),
(5, 1, 1234, 12345, 'Adaptive radiation in fishes started about number of million years ago4:', '[1200,500,1000,1500]', 'C', 1, 1, 0, '2022-11-01 08:02:47'),
(6, 1, 1234, 12345, 'Adaptive radiation in fishes started about number of million years ago5:', '[1200,500,1000,1500]', 'D', 1, 1, 0, '2022-11-01 08:02:47'),
(7, 1, 1234, 12345, 'Siapa Presiden Sekarang?', '[\"Jokowi\",\"Jakawi\",\"SBY\",\"Brock Lesnar\"]', '', 1, 1, 0, '2022-11-01 08:14:28'),
(8, 1, 1234, 12345, 'Siapa Orang yang Terkenal dari PDIP?', '[\"Puan\",\"Megawati\",\"Optimum Pride\",\"Megatron\"]', '', 1, 1, 0, '2022-11-01 08:14:28'),
(9, 1, 1234, 12345, '', '[null,null,null,null]', 'A', 1, 1, 0, '2022-11-01 08:14:28'),
(10, 1, 1234, 12345, '', '[null,null,null,null]', 'A', 1, 1, 0, '2022-11-01 08:14:28'),
(13, 1, 1234, 12345, '<p>Ini Soal</p>\r\n', '[\"\\u003Cp\\u003EIni Opsi A\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EIni Opsi B\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EIni Opsi C\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EIni Opsi D\\u003C\\/p\\u003E\\r\\n\"]', 'C', 18, 1, 0, '2022-11-07 21:36:52'),
(12, 1, 1234, 12345, '<p>Siapa Nama Dosen Terganteng ITERA???</p>\r\n', '[\"\\u003Cp\\u003EPak Andre\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EPak Andre\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EPak Andre\\u003C\\/p\\u003E\\r\\n\",\"\\u003Cp\\u003EPak Andre\\u003C\\/p\\u003E\\r\\n\"]', 'A', 1, 1, 0, '2022-11-01 09:42:43');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_details`
--

INSERT INTO `site_details` (`id`, `site_title`, `site_favicon`, `site_logo`, `site_minilogo`, `site_loader`, `site_author`, `site_keywords`, `site_description`, `enrollment_word`, `copyright_text`, `timezone`) VALUES
(1, 'SSF E-Learning', 'ssf_white1.png', 'nyamping_new1.png', 'ssf_white.png', 'Hourglass.gif', 'Andi Wonosobo', 'Smart School Foundation', '&quot;Be smart with our private&quot;', 'SSF', 'Copyright © 2022 Smart School Foundation. All Right Reserved.', 'Asia/Jakarta');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admin_id`, `name`, `enrollment_id`, `password`, `image`, `email`, `contact_no`, `gender`, `dob`, `father_name`, `father_designtn`, `address`, `batch_id`, `login_status`, `admission_date`, `status`, `payment_status`, `brewers_check`, `token`, `app_version`, `added_by`, `last_login_app`, `pay_mode`, `multi_batch`) VALUES
(4, 1, 'Yoimiya', 'SSF1317', '00404a6c7f0954e363c12434f6ce7067', 'yoimiya_genshin_impact_character_render_by_deg5270_depft9v-fullview_221024215356.png', 'yoimiya@gmail.com', '082168915818', 'female', '2001-06-21', 'Unknown', 'Me', 'Inazuma City', '[\"1\"]', 0, '2022-10-24', 1, 0, 'TnxyL0jtir', '1', '', '', '0000-00-00 00:00:00', 0, ''),
(2, 1, 'Kamisato Ayaka', 'SSF1153', '6e12cf90ab474aa4175ac6ce335094e3', 'avatar_ayaka_221024213812.png', 'inibukangmail@gmail.com', '088888888888', 'female', '2002-09-28', 'Yes_Papa', 'Me', 'Inazuma, Kamisato Estate', '5', 0, '2022-10-18', 1, 0, 'YjMvfKQ8dI', '1', '', 'student', '2022-11-07 19:45:25', 0, '[\"1\"]'),
(3, 1, 'Keqing', 'SSF1273', '1e4483e833025ac10e6184e75cb2d19d', 'avatar_keqing.png', 'animal@gmail.com', '1234567890', 'female', '2002-11-20', 'No_Papa', 'Bjirr', 'Liyue', '[\"1\"]', 0, '2022-10-18', 1, 0, 'aKV5kNZGFC', '1', '', '', '0000-00-00 00:00:00', 0, '');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_doubts_class`
--

INSERT INTO `student_doubts_class` (`doubt_id`, `student_id`, `teacher_id`, `batch_id`, `subjects_id`, `chapters_id`, `users_description`, `teacher_description`, `appointment_date`, `appointment_time`, `create_at`, `status`, `admin_id`) VALUES
(1, 2, 18, 5, '1234', '12345', 'Pak... kamu nanyaaa', '', '0000-00-00', '', '2022-11-07 22:05:18', 0, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(8, 4, 1, 'Cash', 'offline', 0, '2022-10-24 22:01:18', 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `status`, `no_of_questions`, `admin_id`) VALUES
(1234, 'Testing_Subject', 1, 13, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 2, 5, 0, '2022-11-07 19:45:25', 'student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_data`
--

CREATE TABLE `temp_data` (
  `id` int(11) NOT NULL,
  `temp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `term_condition_data`
--

CREATE TABLE `term_condition_data` (
  `id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin_id`, `name`, `email`, `password`, `role`, `teach_education`, `teach_image`, `teach_batch`, `teach_subject`, `teach_gender`, `parent_id`, `status`, `token`, `brewers_check`, `super_admin`, `access`) VALUES
(1, '1', 'admin', 'admin@ssf.com', '202cb962ac59075b964b07152d234b70', 1, '', '', '', '', '', 0, 1, '1', 'lxsXLtzbrq', '1', ''),
(17, '1', 'Rico', 'rico@gmail.com', 'be89e250d8388c5e7ded2f1630e5daa4', 3, 'Magister', 'base_img1.png', '2', '[\"1234\"]', 'male', 1, 1, '', '', '', '{\"live_class\":\"1\",\"notice\":\"1\",\"assignment\":\"1\",\"extraclasses\":\"1\",\"doubtsask\":\"1\",\"video_lecture\":\"1\",\"course_content\":\"1\",\"question_manager\":\"1\",\"student_leave\":\"1\",\"student_manage\":\"1\",\"exam\":\"1\"}'),
(18, '1', 'Kowalski', 'kowalski@gmail.com', '9310f83135f238b04af729fec041cca8', 3, 'Bachelor', 'penguin.jpg', '3,4,5,6', '[\"1234\"]', 'male', 1, 1, '1', 'Gy7PdJNHMA', '', '{\"academics\":null,\"live_class\":\"1\",\"notice\":\"1\",\"assignment\":\"1\",\"extraclasses\":\"1\",\"doubtsask\":\"1\",\"video_lecture\":\"1\",\"question_manager\":\"1\",\"course_content\":\"1\",\"student_leave\":\"1\",\"student_manage\":\"1\",\"exam\":\"1\"}');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`id`, `title`, `description`, `start_date`, `last_date`, `mode`, `files`, `status`, `admin_id`, `added_at`) VALUES
(1, 'Testing_Exam', 'This\'s just using for a development testing', '2022-10-28', '2022-10-29', 'Online', '[\"1120_-_Surat_Tugas_PkM_an_Harmiansyah.pdf\"]', 1, 1, '2022-10-28 12:48:08'),
(2, 'Test_Lagi', 'Ini deskripsi', '2022-11-09', '2022-11-10', '', '[\"DRPL-ITERA_Tugas_1_Kelompok_2_Kelas_A.pdf\"]', 1, 1, '2022-11-07 22:19:53');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `views_notification_student`
--

CREATE TABLE `views_notification_student` (
  `n_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `notice_type` varchar(100) NOT NULL,
  `views_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zoom_api_credentials`
--

CREATE TABLE `zoom_api_credentials` (
  `id` int(11) NOT NULL,
  `android_api_key` varchar(250) NOT NULL,
  `android_api_secret` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `batch_category`
--
ALTER TABLE `batch_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `batch_fecherd`
--
ALTER TABLE `batch_fecherd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `batch_subcategory`
--
ALTER TABLE `batch_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123462;

--
-- AUTO_INCREMENT for table `batch_subjects`
--
ALTER TABLE `batch_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_setting`
--
ALTER TABLE `certificate_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12346;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `extra_classes`
--
ALTER TABLE `extra_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `extra_class_attendance`
--
ALTER TABLE `extra_class_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontend_details`
--
ALTER TABLE `frontend_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_management`
--
ALTER TABLE `leave_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_class_history`
--
ALTER TABLE `live_class_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_class_setting`
--
ALTER TABLE `live_class_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mock_result`
--
ALTER TABLE `mock_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes_pdf`
--
ALTER TABLE `notes_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `old_paper_pdf`
--
ALTER TABLE `old_paper_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `practice_result`
--
ALTER TABLE `practice_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policy_data`
--
ALTER TABLE `privacy_policy_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `site_details`
--
ALTER TABLE `site_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_doubts_class`
--
ALTER TABLE `student_doubts_class`
  MODIFY `doubt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_payment_history`
--
ALTER TABLE `student_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;

--
-- AUTO_INCREMENT for table `sudent_batchs`
--
ALTER TABLE `sudent_batchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `temp_data`
--
ALTER TABLE `temp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term_condition_data`
--
ALTER TABLE `term_condition_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme_color`
--
ALTER TABLE `theme_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `video_lectures`
--
ALTER TABLE `video_lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `views_notification_student`
--
ALTER TABLE `views_notification_student`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoom_api_credentials`
--
ALTER TABLE `zoom_api_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
