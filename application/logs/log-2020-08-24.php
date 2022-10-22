<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-08-24 04:53:23 --> 404 Page Not Found: Assets/js
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-08-24 04:53:23 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 04:53:23 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 04:53:23 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 04:53:23 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 04:54:58 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 04:54:58 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 04:54:58 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 04:54:58 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 04:54:58 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 10:32:31 --> Severity: Notice --> Undefined index: student_data /home/themes91/public_html/ci/e-academy/application/controllers/Admin_profile.php 484
ERROR - 2020-08-24 11:19:42 --> Query error: Column 'admin_id' in where clause is ambiguous - Invalid query: SELECT COUNT(*) AS `numrows`
FROM (
SELECT *
FROM `practice_result`
JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id`
WHERE `admin_id` = '1'
AND `student_id` = '6'
AND  `date` LIKE '%2020-08-%' ESCAPE '!'
GROUP BY `paper_id`
) CI_count_all_results
ERROR - 2020-08-24 11:20:04 --> Query error: Duplicate column name 'id' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM (
SELECT *
FROM `practice_result`
JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id`
WHERE `practice_result`.`admin_id` = '1'
AND `student_id` = '6'
AND  `date` LIKE '%2020-08-%' ESCAPE '!'
GROUP BY `paper_id`
) CI_count_all_results
ERROR - 2020-08-24 11:23:35 --> Severity: Notice --> Undefined variable: teacher /home/themes91/public_html/ci/e-academy/application/views/admin/extra_classes.php 117
ERROR - 2020-08-24 11:23:35 --> Severity: Warning --> Invalid argument supplied for foreach() /home/themes91/public_html/ci/e-academy/application/views/admin/extra_classes.php 117
ERROR - 2020-08-24 11:23:35 --> Severity: Notice --> Undefined variable: batches /home/themes91/public_html/ci/e-academy/application/views/admin/extra_classes.php 128
ERROR - 2020-08-24 11:23:35 --> Severity: Warning --> Invalid argument supplied for foreach() /home/themes91/public_html/ci/e-academy/application/views/admin/extra_classes.php 128
ERROR - 2020-08-24 11:23:48 --> Query error: Duplicate column name 'id' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM (
SELECT *
FROM `practice_result`
JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id`
WHERE `practice_result`.`admin_id` = '1'
AND `student_id` = '6'
AND  `date` LIKE '%2020-08-%' ESCAPE '!'
GROUP BY `practice_result`.`paper_id`
) CI_count_all_results
ERROR - 2020-08-24 11:27:30 --> Query error: Duplicate column name 'id' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM (
SELECT *
FROM `practice_result`
JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id`
WHERE `practice_result`.`admin_id` = '1'
AND `student_id` = '6'
AND  date(added_at) LIKE '%2020-08-%' ESCAPE '!'
GROUP BY `paper_id`
) CI_count_all_results
ERROR - 2020-08-24 11:30:40 --> Query error: Table 'themes91_eacademy.id' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `extra_class_attendance`, `id`
WHERE `student_id` = '6'
AND  `date` LIKE '%2020-08-%' ESCAPE '!'
ERROR - 2020-08-24 11:31:07 --> Query error: Duplicate column name 'id' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM (
SELECT *
FROM `practice_result`
JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id`
WHERE `practice_result`.`admin_id` = '1'
AND `student_id` = '6'
AND  date(added_at) LIKE '%2020-08-%' ESCAPE '!'
GROUP BY `paper_id`
) CI_count_all_results
ERROR - 2020-08-24 11:33:40 --> Query error: Duplicate column name 'id' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM (
SELECT *
FROM `practice_result`
JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id`
WHERE `practice_result`.`admin_id` = '1'
AND `student_id` = '6'
AND  date(added_at) LIKE '%2020-08-%' ESCAPE '!'
GROUP BY `paper_id`
) CI_count_all_results
ERROR - 2020-08-24 11:35:04 --> Query error: Duplicate column name 'id' - Invalid query: SELECT COUNT(*) AS `numrows` FROM ( SELECT * FROM `practice_result` JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id` WHERE `practice_result`.`admin_id` = '1' AND `student_id` = '6' AND date(added_at) LIKE '%2020-08-%' ESCAPE '!' GROUP BY `paper_id` ) CI_count_all_results
ERROR - 2020-08-24 11:35:27 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 130
ERROR - 2020-08-24 11:36:01 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 130
ERROR - 2020-08-24 11:37:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT COUNT(*) AS `numrows` FROM ( SELECT practice_result.id FROM `practice_res' at line 1 - Invalid query: SELECT SELECT COUNT(*) AS `numrows` FROM ( SELECT practice_result.id FROM `practice_result` JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id` WHERE `practice_result`.`admin_id` = '1' AND `student_id` = '6' AND date(added_at) LIKE '%2020-08-%' ESCAPE '!' GROUP BY `paper_id` ) CI_count_all_results
ERROR - 2020-08-24 11:38:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT COUNT(*) AS `numrows` FROM ( SELECT practice_result.id FROM `practice_res' at line 1 - Invalid query: SELECT SELECT COUNT(*) AS `numrows` FROM ( SELECT practice_result.id FROM `practice_result` JOIN `exams` ON `exams`.`id`=`practice_result`.`paper_id` WHERE `practice_result`.`admin_id` = '1' AND `student_id` = '6' AND date(added_at) LIKE '%2020-08-%' ESCAPE '!' GROUP BY `paper_id` ) a
ERROR - 2020-08-24 11:38:59 --> Severity: Notice --> Array to string conversion /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 130
ERROR - 2020-08-24 11:39:24 --> Severity: Notice --> Array to string conversion /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 130
ERROR - 2020-08-24 11:50:18 --> Severity: Notice --> Undefined variable: total_extra_class /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 11:50:18 --> Severity: Notice --> Undefined variable: total_practice_test /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 11:50:18 --> Severity: Notice --> Undefined variable: total_mock_test /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 11:57:57 --> Severity: Notice --> Undefined variable: total_extra_class /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 11:57:57 --> Severity: Notice --> Undefined variable: total_practice_test /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 11:57:57 --> Severity: Notice --> Undefined variable: total_mock_test /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 12:02:44 --> Severity: Notice --> Undefined variable: total_practice_test /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 12:03:20 --> Severity: Notice --> Undefined variable: total_practice_test /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 12:03:56 --> Severity: Notice --> Undefined variable: total_practice_test /home/themes91/public_html/ci/e-academy/application/views/student/academic_record.php 128
ERROR - 2020-08-24 07:07:16 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:07:16 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:07:16 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:12:28 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:12:28 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:12:28 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:12:28 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:12:28 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:15:04 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:15:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:15:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:15:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:15:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:15:42 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:15:42 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:15:42 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:15:42 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:15:42 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:16:09 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:16:09 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:16:09 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:16:09 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:16:09 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:17:51 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:17:51 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:17:51 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:17:51 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:17:51 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:19:57 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:19:57 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:19:57 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:19:57 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:19:58 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:22:30 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:22:30 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:22:30 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:22:30 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:22:30 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:22:32 --> 404 Page Not Found: Ajaxcall/get_subject_lis
ERROR - 2020-08-24 07:33:31 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:33:31 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:33:31 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:33:31 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:33:31 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:35:24 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:35:24 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:35:24 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:35:24 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:35:24 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:36:17 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 07:36:17 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:36:17 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:36:18 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 07:36:18 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:21:48 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 08:21:48 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:21:48 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:21:48 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:21:48 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:22:11 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 08:22:11 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:22:11 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:22:11 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:22:11 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:25:55 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:25:55 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:25:55 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:25:55 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 08:25:55 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:27:14 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 08:27:14 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:27:14 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:27:14 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:27:14 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:29:10 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 08:29:10 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:29:10 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:29:10 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:29:10 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:30:29 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 08:30:29 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:30:29 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:30:29 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:30:29 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:54:53 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:54:53 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 08:54:53 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 12:30:07 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 12:30:07 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 12:30:07 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 12:30:07 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 12:30:07 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 13:14:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 13:14:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 13:14:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 13:14:05 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 13:14:05 --> 404 Page Not Found: Assets/css
ERROR - 2020-08-24 13:31:49 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 13:31:49 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 13:31:49 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 13:31:49 --> 404 Page Not Found: Assets/js
ERROR - 2020-08-24 13:31:49 --> 404 Page Not Found: Assets/css
