<!DOCTYPE html>
<html <?php if ($this->common->language_name == 'arabic') {
            echo 'lang="ar" dir="rtl"';
        } else if ($this->common->language_name == 'french') {
            echo 'lang="fr" dir="ltr"';
        } else if ($this->common->language_name == 'english') {
            echo 'lang="en" dir="ltr"';
        } ?>>
<!--<![endif]-->
<!-- Header Start -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> <?php echo html_escape($this->common->siteTitle) . ((isset($title) && !empty($title)) ? ' | ' . $title : ''); ?></title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="<?php echo html_escape($this->common->siteDescription); ?>" />
    <meta name="keywords" content="<?php echo html_escape($this->common->siteKeywords); ?>" />
    <meta name="author" content="<?php echo html_escape($this->common->siteAuthorName); ?>" />
    <meta name="MobileOptimized" content="320" />

    <!-- main css section start-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/fontawesome.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/jquery-ui.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/datatable/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="  https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/toastr.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/select2.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/timepicker/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/magnific-popup.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/icofont.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/summernote.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/admin-fonts.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/backend-rtl.css?' . time(); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/backend.css?' . time(); ?>" />
    <!-- favicon links -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo html_escape($this->common->siteFavicon); ?>" />
    <script>
        var base_url = "<?php echo base_url(); ?>";
        var ltr_status_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_status_msg')); ?>";
        var ltr_matching_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_matching_msg')); ?>";
        var ltr_select_chapter = "<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?>";
        var ltr_select_subject = "<?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?>";
        var ltr_subject = "<?php echo html_escape($this->common->languageTranslator('ltr_subject')); ?>";
        var ltr_teacher = "<?php echo html_escape($this->common->languageTranslator('ltr_teacher')); ?>";
        var ltr_select_teacher = "<?php echo html_escape($this->common->languageTranslator('ltr_select_teacher')); ?>";
        var ltr_start_date = "<?php echo html_escape($this->common->languageTranslator('ltr_start_date')); ?>";
        var ltr_end_date = "<?php echo html_escape($this->common->languageTranslator('ltr_end_date')); ?>";
        var ltr_start_time = "<?php echo html_escape($this->common->languageTranslator('ltr_start_time')); ?>";
        var ltr_end_time = "<?php echo html_escape($this->common->languageTranslator('ltr_end_time')); ?>";
        var ltr_cant_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_cant_msg')); ?>";
        var ltr_are_you_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_are_you_msg')); ?>";
        var ltr_add_course = "<?php echo html_escape($this->common->languageTranslator('ltr_add_course')); ?>";
        var ltr_edit_course = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_course')); ?>";
        var ltr_add_doubts_date_class = "<?php echo html_escape($this->common->languageTranslator('ltr_add_doubts_date_class')); ?>";
        var ltr_add_new_exam = "<?php echo html_escape($this->common->languageTranslator('ltr_add_new_exam')); ?>";
        var ltr_end_date_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_end_date_msg')); ?>";
        var ltr_subject_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_subject_msg')); ?>";
        var ltr_characters_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_characters_msg')); ?>";
        var ltr_password_student_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_password_student_msg')); ?>";
        var ltr_enrollment_id = "<?php echo html_escape($this->common->languageTranslator('ltr_enrollment_id')); ?>";
        var ltr_password = "<?php echo html_escape($this->common->languageTranslator('ltr_password')); ?>";
        var ltr_add_another_student = "<?php echo html_escape($this->common->languageTranslator('ltr_add_another_student')); ?>";
        var ltr_select_batch_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_select_batch_msg')); ?>";
        var ltr_select_batch = "<?php echo html_escape($this->common->languageTranslator('ltr_select_batch')); ?>";
        var ltr_changed_batch_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_changed_batch_msg')); ?>";
        var ltr_changed_password_for_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_changed_password_for_msg')); ?>";
        var ltr_confirm_password_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_confirm_password_msg')); ?>";
        var ltr_password_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_password_msg')); ?>";
        var ltr_subject_name_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_subject_name_msg')); ?>";
        var ltr_letters_characters_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_letters_characters_msg')); ?>";
        var ltr_subject_updated_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_subject_updated_msg')); ?>";
        var ltr_subject_add_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_subject_add_msg')); ?>";
        var ltr_subject_exists_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_subject_exists_msg')); ?>";
        var ltr_are_you_so_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_are_you_so_msg')); ?>";
        var ltr_subject_delete_alert_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_subject_delete_alert_msg')); ?>";
        var ltr_cat_updated_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_cat_updated_msg')); ?>";
        var ltr_cat_add_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_cat_add_msg')); ?>";
        var ltr_cat_name_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_cat_name_msg')); ?>";
        var ltr_cat_exists_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_cat_exists_msg')); ?>";
        var ltr_cat_delete_alert_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_cat_delete_alert_msg')); ?>";
        var ltr_atleast_chapter_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_atleast_chapter_msg')); ?>";
        var ltr_add_chapter_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_add_chapter_msg')); ?>";
        var ltr_exists_chapter_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_exists_chapter_msg')); ?>";
        var ltr_chapter_name_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_chapter_name_msg')); ?>";
        var ltr_chapter_updated_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_chapter_updated_msg')); ?>";
        var ltr_chapter_delete_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_chapter_delete_msg')); ?>";
        var ltr_loading_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_loading_msg')); ?>";
        var ltr_select_subject_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_select_subject_msg')); ?>";
        var ltr_select_subject_both_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_select_subject_both_msg')); ?>";
        var ltr_word_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_word_msg')); ?>";
        var ltr_answer_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_answer_msg')); ?>";
        var ltr_start_date_greater_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_start_date_greater_msg')); ?>";
        var ltr_add_teacher = "<?php echo html_escape($this->common->languageTranslator('ltr_add_teacher')); ?>";
        var ltr_edit_teacher = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_teacher')); ?>";
        var ltr_update_teacher = "<?php echo html_escape($this->common->languageTranslator('ltr_update_teacher')); ?>";
        var ltr_add_extra_class = "<?php echo html_escape($this->common->languageTranslator('ltr_add_extra_class')); ?>";
        var ltr_add_class = "<?php echo html_escape($this->common->languageTranslator('ltr_add_class')); ?>";
        var ltr_edit_extra_class = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_extra_class')); ?>";
        var ltr_update_class = "<?php echo html_escape($this->common->languageTranslator('ltr_update_class')); ?>";
        var ltr_past_time_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_past_time_msg')); ?>";
        var ltr_end_greater_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_end_greater_msg')); ?>";
        var ltr_today_greater_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_today_greater_msg')); ?>";
        var ltr_class_already_added_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_class_already_added_msg')); ?>";
        var ltr_valid_time_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_valid_time_msg')); ?>";
        var ltr_select_date_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_select_date_msg')); ?>";
        var ltr_atleast_question_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_atleast_question_msg')); ?>";
        var ltr_select_year_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_select_year_msg')); ?>";
        var ltr_select_paper_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_select_paper_msg')); ?>";
        var ltr_add_facility = "<?php echo html_escape($this->common->languageTranslator('ltr_add_facility')); ?>";
        var ltr_edit_facility = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_facility')); ?>";
        var ltr_add_assignment = "<?php echo html_escape($this->common->languageTranslator('ltr_add_assignment')); ?>";
        var ltr_edit_assignment = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_assignment')); ?>";
        var ltr_update_assignment = "<?php echo html_escape($this->common->languageTranslator('ltr_update_assignment')); ?>";
        var ltr_select_from_date_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_select_from_date_msg')); ?>";
        var ltr_select_to_date_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_select_to_date_msg')); ?>";
        var ltr_batch_inactive_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_batch_inactive_msg')); ?>";
        var ltr_mark_complete = "<?php echo html_escape($this->common->languageTranslator('ltr_mark_complete')); ?>";
        var ltr_complete = "<?php echo html_escape($this->common->languageTranslator('ltr_complete')); ?>";
        var ltr_all_fields_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_all_fields_msg')); ?>";
        var ltr_hide_password = "<?php echo html_escape($this->common->languageTranslator('ltr_hide_password')); ?>";
        var ltr_change_password = "<?php echo html_escape($this->common->languageTranslator('ltr_change_password')); ?>";
        var ltr_new_password_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_new_password_msg')); ?>";
        var ltr_all_test_record_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_all_test_record_msg')); ?>";
        var ltr_once_deleted_alert_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_once_deleted_alert_msg')); ?>";
        var ltr_are_deleted_alert_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_are_deleted_alert_msg')); ?>";
        var ltr_updated_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_updated_msg')); ?>";
        var ltr_alert_updated_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_alert_updated_msg')); ?>";
        var ltr_category_changed_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_category_changed_msg')); ?>";
        var ltr_invalid_birth_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_invalid_birth_msg')); ?>";
        var ltr_to_greater_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_to_greater_msg')); ?>";
        var ltr_message = "<?php echo html_escape($this->common->languageTranslator('ltr_message')); ?>";
        var ltr_add_live_class = "<?php echo html_escape($this->common->languageTranslator('ltr_add_live_class')); ?>";
        var ltr_edit_live_class = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_live_class')); ?>";
        var ltr_atleast_student_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_atleast_student_msg')); ?>";
        var ltr_atleast_date_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_atleast_date_msg')); ?>";
        var ltr_maximum40_characters_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_maximum40_characters_msg')); ?>";
        var ltr_maximum50_characters_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_maximum50_characters_msg')); ?>";
        var ltr_double_class_date_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_double_class_date_msg')); ?>";
        var ltr_ok = "<?php echo html_escape($this->common->languageTranslator('ltr_ok')); ?>";
        var ltr_cancel = "<?php echo html_escape($this->common->languageTranslator('ltr_cancel')); ?>";
        var ltr_select_student = "<?php echo html_escape($this->common->languageTranslator('ltr_select_student')); ?>";
        var ltr_description = "<?php echo html_escape($this->common->languageTranslator('ltr_description')); ?>";
        var ltr_can_remove_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_can_remove_msg')); ?>";
        var ltr_some_required = "<?php echo html_escape($this->common->languageTranslator('ltr_some_required')); ?>";
        var ltr_only_letters_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_only_letters_msg')); ?>";
        var ltr_search = "<?php echo html_escape($this->common->languageTranslator('ltr_search')); ?>";
        var ltr_show = "<?php echo html_escape($this->common->languageTranslator('ltr_show')); ?>";
        var ltr_heading = "<?php echo html_escape($this->common->languageTranslator('ltr_heading')); ?>";
        var ltr_benefit = "<?php echo html_escape($this->common->languageTranslator('ltr_benefit')); ?>";
        var ltr_sub_heading = "<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading')); ?>";
        var ltr_batch_speci_heading = "<?php echo html_escape($this->common->languageTranslator('ltr_batch_speci_heading')); ?>";
        var ltr_fecherd = "<?php echo html_escape($this->common->languageTranslator('ltr_fecherd')); ?>";
        var ltr_email = "<?php echo html_escape($this->common->languageTranslator('ltr_email')); ?>";
        var ltr_wrong_credentials_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_wrong_credentials_msg')); ?>";
        var ltr_batch_spe_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_batch_spe_msg')); ?>";
        var ltr_you_delete = "<?php echo html_escape($this->common->languageTranslator('ltr_you_delete')); ?>";
        var ltr_i_learn = "<?php echo html_escape($this->common->languageTranslator('ltr_i_learn')); ?>";
        var ltr_chapters = "<?php echo html_escape($this->common->languageTranslator('ltr_chapters')); ?>";
        var ltr_offer_price_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_offer_price_msg')); ?>";
        var ltr_batch_price_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_batch_price_msg')); ?>";
        var ltr_payment_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_payment_msg')); ?>";
        var ltr_something_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_something_msg')); ?>";
        var ltr_live_class_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_live_class_msg')); ?>";
        var ltr_add_blog = "<?php echo html_escape($this->common->languageTranslator('ltr_add_blog')); ?>";
        var ltr_no_result = "<?php echo html_escape($this->common->languageTranslator('ltr_no_result')); ?>";
        var ltr_edit_image = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_image')); ?>";
        var ltr_add_image = "<?php echo html_escape($this->common->languageTranslator('ltr_add_image')); ?>";
        var ltr_enter_position = "<?php echo html_escape($this->common->languageTranslator('ltr_enter_position')); ?>";
        var ltr_add_book = "<?php echo html_escape($this->common->languageTranslator('ltr_add_book')); ?>";
        var ltr_edit_book = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_book')); ?>";
        var ltr_add = "<?php echo html_escape($this->common->languageTranslator('ltr_add')); ?>";
        var ltr_edit = "<?php echo html_escape($this->common->languageTranslator('ltr_edit')); ?>";
        var ltr_add_notes = "<?php echo html_escape($this->common->languageTranslator('ltr_add_notes')); ?>";
        var ltr_edit_notes = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_notes')); ?>";
        var ltr_add_old_paper = "<?php echo html_escape($this->common->languageTranslator('ltr_add_old_paper')); ?>";
        var ltr_edit_old_paper = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_old_paper')); ?>";
        var ltr_duplicate_email = "<?php echo html_escape($this->common->languageTranslator('ltr_duplicate_email')); ?>";
        var mock_config;
    </script>
</head>

<body class="<?php if ($this->common->language_name == 'arabic') {
                    echo 'rtl';
                } ?>">
    <!----- Preloader Box ----->
    <div class="edu_preloader">
        <div class="edu_status">
            <img src="<?php echo html_escape($this->common->siteLoader); ?>" alt="loader">
        </div>
    </div>
    <!----- Preloader Box ----->

    <?php

    $timezoneDB = $this->db_model->select_data('timezone', 'site_details', array('id' => 1));

    if (isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])) {
        date_default_timezone_set($timezoneDB[0]['timezone']);
    }

    $cur_arr = explode('/', $_SERVER['REQUEST_URI']);



    $cur_arr = explode('/', $_SERVER['REQUEST_URI']);
    $timezoneDB = $this->db_model->select_data('timezone', 'site_details', array('id' => 1));

    if (isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])) {
        date_default_timezone_set($timezoneDB[0]['timezone']);
    }

    $admin_id = $this->session->userdata('admin_id');
    $teacher_id = $this->session->userdata('uid');
    $condN = "admin_id = $admin_id AND teacher_id = $teacher_id AND status = 1 AND read_status = 0";
    $notice_count = $this->db_model->countAll('notices use index(id)', $condN);
    $logo = current($this->db_model->select_data('*', 'users use index (id)', array('id' => $admin_id)));
    $lastrecord = current($this->db_model->select_data('access', 'users', array('id' => $this->session->userdata('uid')), 1, array('id', 'desc')));
    //  print_r($lastrecord);
    if (isset($lastrecord['access']))
        $access = json_decode($lastrecord['access']);


    ?>
    <div class="edu_header_sidebar">
        <header class="edu_left_header">
            <div class="edu_admin_logo">
                <a href="<?php echo base_url() . 'admin/dashboard'; ?>"><img src="<?php echo html_escape($this->common->siteLogo); ?>" class="logoRelativeCls main_logo" alt="Logo"></a>
                <a href="#"><img src="<?php echo html_escape($this->common->siteminiLogo); ?>" class="mini_logo" alt="Minilogo"></a>
                <div class="edu_header_close responsive_btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="edu_admin_header_right">
                <div class="edu_admin_menu">
                    <ul>
                        <li <?php echo in_array("dashboard", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url() ?>admin/dashboard">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M23.047,9.399c-0.305-0.301-0.783-0.345-1.141-0.105c-1.344,0.902-8.088,5.438-8.813,6.151
                                        c-1.051,1.037-1.051,2.721,0,3.756c0.525,0.514,1.217,0.773,1.906,0.773c0.691,0,1.381-0.26,1.907-0.773
                                        c0.725-0.715,5.332-7.354,6.248-8.678C23.398,10.172,23.354,9.7,23.047,9.399z M15.634,17.949c-0.35,0.346-0.92,0.346-1.27,0
                                        c-0.35-0.344-0.352-0.906,0-1.25c0.281-0.273,2.196-1.621,4.551-3.232C17.279,15.786,15.914,17.672,15.634,17.949z M7.642,21.436
                                        l-1.107,0.533c-0.813-1.426-1.238-3.016-1.238-4.645c0-1.195,0.225-2.34,0.633-3.394l1.27,0.601
                                        c0.125,0.059,0.258,0.086,0.389,0.086c0.334,0,0.656-0.185,0.811-0.502c0.215-0.439,0.025-0.968-0.422-1.18l-1.254-0.593
                                        c1.559-2.504,4.258-4.249,7.379-4.533v1.331c0,0.488,0.402,0.884,0.898,0.884s0.898-0.396,0.898-0.884V7.81
                                        c1.071,0.096,2.106,0.364,3.09,0.801c0.451,0.201,0.984,0.003,1.188-0.442c0.205-0.445,0.004-0.969-0.449-1.17
                                        C18.238,6.336,16.646,6,15,6c-3.072,0-5.959,1.178-8.131,3.316S3.5,14.298,3.5,17.324c0,2.232,0.674,4.406,1.949,6.283
                                        C5.621,23.859,5.904,24,6.195,24c0.133,0,0.268-0.029,0.395-0.09l1.842-0.885c0.445-0.213,0.631-0.742,0.414-1.182
                                        C8.626,21.404,8.089,21.223,7.642,21.436z M25.486,12.668c-0.203-0.445-0.736-0.643-1.188-0.442
                                        c-0.453,0.201-0.654,0.726-0.449,1.171c0.566,1.236,0.854,2.558,0.854,3.928c0,1.631-0.428,3.225-1.24,4.65l-1.158-0.541
                                        c-0.447-0.211-0.984-0.023-1.197,0.418c-0.213,0.439-0.023,0.969,0.424,1.178l1.887,0.885C23.543,23.973,23.674,24,23.805,24
                                        c0.291,0,0.576-0.141,0.748-0.393c1.273-1.877,1.947-4.051,1.947-6.283C26.5,15.701,26.16,14.135,25.486,12.668z" />
                                        </g>
                                    </g>
                                </svg>
                                <span><?php echo html_escape($this->common->languageTranslator('ltr_dashboard')); ?></span>
                            </a>
                        </li>
                        <?php if ($this->session->userdata['super_admin'] == 1) { ?>

                            <li <?php echo in_array("manage-admin", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url() . $profile; ?>admin/manage-admin">

                                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.17 14.16">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: #4267C8;
                                                }
                                            </style>
                                        </defs>
                                        <title>Search results for Multiple users - Flaticon-2</title>
                                        <path class="cls-1" d="M3.45,5a1.94,1.94,0,0,0,1.43-.6,2,2,0,0,0,.59-1.43,2,2,0,0,0-.59-1.43A2,2,0,0,0,3.45.92,2,2,0,0,0,2,1.51a2,2,0,0,0-.59,1.43A1.92,1.92,0,0,0,2,4.37,1.93,1.93,0,0,0,3.45,5Z" transform="translate(-0.42 -0.92)" />
                                        <path class="cls-1" d="M5.85,8.12A2.91,2.91,0,0,0,8,9a2.91,2.91,0,0,0,2.15-.89A2.92,2.92,0,0,0,11,6a3,3,0,0,0-3-3A3,3,0,0,0,5,6,2.91,2.91,0,0,0,5.85,8.12Z" transform="translate(-0.42 -0.92)" />
                                        <path class="cls-1" d="M12.55,5A1.93,1.93,0,0,0,14,4.37a1.92,1.92,0,0,0,.59-1.43A2,2,0,0,0,14,1.51a2,2,0,0,0-2.86,0,2,2,0,0,0-.59,1.43,2,2,0,0,0,.59,1.43A1.94,1.94,0,0,0,12.55,5Z" transform="translate(-0.42 -0.92)" />
                                        <path class="cls-1" d="M14.6,5a1.46,1.46,0,0,0-.34.16,6,6,0,0,1-.77.34,2.83,2.83,0,0,1-.94.17,3.22,3.22,0,0,1-1.05-.18,3.28,3.28,0,0,1,0,.52,3.46,3.46,0,0,1-.64,2A2.72,2.72,0,0,1,13,9h1.06a1.83,1.83,0,0,0,1.09-.32,1.05,1.05,0,0,0,.44-.93C15.58,5.9,15.26,5,14.6,5Z" transform="translate(-0.42 -0.92)" />
                                        <path class="cls-1" d="M13.42,11.35a5.28,5.28,0,0,0-.21-.85,3.72,3.72,0,0,0-.33-.77,3,3,0,0,0-.49-.64,2.13,2.13,0,0,0-.68-.43,2.5,2.5,0,0,0-.88-.15.82.82,0,0,0-.34.17l-.58.37a3.32,3.32,0,0,1-.84.38,3.45,3.45,0,0,1-2.14,0,3.32,3.32,0,0,1-.84-.38l-.58-.37a.82.82,0,0,0-.34-.17,2.5,2.5,0,0,0-.88.15,2,2,0,0,0-.67.43,2.47,2.47,0,0,0-.49.64,3.29,3.29,0,0,0-.34.77,5.28,5.28,0,0,0-.21.85,5.75,5.75,0,0,0-.11.87q0,.39,0,.81A2,2,0,0,0,3,14.53a2.14,2.14,0,0,0,1.54.55h6.9A2.14,2.14,0,0,0,13,14.53a2,2,0,0,0,.57-1.5q0-.42,0-.81A5.75,5.75,0,0,0,13.42,11.35Z" transform="translate(-0.42 -0.92)" />
                                        <path class="cls-1" d="M5.1,8a3.46,3.46,0,0,1-.64-2,3.28,3.28,0,0,1,0-.52,3.22,3.22,0,0,1-1,.18,2.88,2.88,0,0,1-.94-.17,6,6,0,0,1-.77-.34A1.46,1.46,0,0,0,1.4,5c-.66,0-1,.93-1,2.79a1.05,1.05,0,0,0,.44.93A1.83,1.83,0,0,0,2,9H3A2.72,2.72,0,0,1,5.1,8Z" transform="translate(-0.42 -0.92)" />
                                    </svg>
                                    <span><?php echo html_escape($this->common->languageTranslator('ltr_manager_admin')); ?></span>
                                </a>
                            </li>

                        <?php  } ?>
                        <?php
                        if (isset($access->academics) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->academics == '1' || $this->session->userdata['super_admin'] == 1) { ?>
                                <li class="has_sub_menu <?php echo (in_array("batch-manage", $cur_arr) || in_array("notice-manage", $cur_arr) || in_array("subject-manage", $cur_arr) || in_array("question-manage", $cur_arr) || in_array("question-manage", $cur_arr) || in_array("vacancy-manage", $cur_arr) || in_array("live-class", $cur_arr) || in_array("live-class-history", $cur_arr) || in_array("batch-cat-manage", $cur_arr) || in_array("batch-subcat-manage", $cur_arr)) ? 'active' : ''; ?>">
                                    <a href="javascript:void(0);" class="">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                            <g>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.277,5.308c1.112,0.336,2.223,0.682,3.338,1.004
                                        c1.992,0.575,3.986,1.137,5.98,1.703C25,8.13,25.377,8.268,25.367,8.782c-0.006,0.517-0.398,0.637-0.795,0.75
                                        c-1.094,0.31-2.186,0.623-3.277,0.936c-1.906,0.543-3.807,1.103-5.721,1.615c-0.36,0.097-0.795,0.092-1.155-0.008
                                        c-3.033-0.844-6.054-1.723-9.083-2.58C4.947,9.386,4.634,9.232,4.629,8.777C4.625,8.325,4.926,8.16,5.32,8.049
                                        c2.984-0.845,5.965-1.701,8.945-2.558c0.156-0.045,0.305-0.121,0.458-0.184C14.907,5.308,15.091,5.308,15.277,5.308z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.185,22.387c0.216-0.342,0.512-0.473,0.926-0.469
                                        c2.106,0.016,4.213,0.002,6.32,0.008c1.49,0.006,2.902,0.285,4.121,1.217c0.294,0.225,0.601,0.223,0.895,0
                                        c1.219-0.928,2.631-1.211,4.122-1.217c2.107-0.006,4.215,0.008,6.322-0.008c0.412-0.004,0.707,0.129,0.924,0.469
                                        c0,0.152,0,0.307,0,0.461c-0.223,0.363-0.545,0.473-0.967,0.469c-2.162-0.016-4.324-0.051-6.482,0.018
                                        c-0.807,0.027-1.627,0.258-2.4,0.516c-0.535,0.174-1.004,0.555-1.503,0.844c-0.308,0-0.615,0-0.923,0
                                        c-0.229-0.115-0.482-0.199-0.681-0.354c-1.018-0.803-2.199-1.029-3.452-1.029c-2.084-0.002-4.168-0.012-6.253,0.006
                                        c-0.423,0.004-0.745-0.105-0.968-0.469C3.185,22.693,3.185,22.539,3.185,22.387z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.628,20.539c0-0.277-0.022-0.521,0.006-0.758
                                        c0.049-0.416,0.314-0.623,0.724-0.623c2.368-0.002,4.737-0.021,7.104,0.016c1.019,0.018,1.845,0.527,2.604,1.428
                                        c0.093-0.156,0.147-0.309,0.251-0.414c0.646-0.648,1.432-1.016,2.346-1.025c2.307-0.016,4.613-0.01,6.92-0.004
                                        c0.689,0.002,0.908,0.404,0.746,1.381c-0.156,0-0.322,0-0.486,0c-1.877,0.002-3.752-0.014-5.629,0.012
                                        c-1.402,0.018-2.736,0.34-3.969,1.041c-0.123,0.07-0.357,0.076-0.479,0.008c-1.229-0.711-2.565-1.027-3.969-1.047
                                        c-1.875-0.029-3.75-0.012-5.627-0.014C5.003,20.539,4.837,20.539,4.628,20.539z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.154,12.314c1.402,0.398,2.731,0.763,4.051,1.157
                                        c0.537,0.162,1.047,0.164,1.582,0.009c1.323-0.389,2.651-0.76,4.02-1.15c0,0.743,0.031,1.458-0.023,2.166
                                        c-0.016,0.181-0.281,0.393-0.48,0.499c-0.826,0.441-1.678,0.834-2.504,1.273c-0.441,0.238-0.867,0.519-1.278,0.812
                                        c-0.291,0.205-0.563,0.295-0.892,0.109c-1.187-0.671-2.353-1.385-3.574-1.982c-0.679-0.332-0.997-0.733-0.911-1.489
                                        C10.194,13.278,10.154,12.829,10.154,12.314z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.615,11.529c0,0.503,0,0.928,0,1.352
                                        c0,0.905,0.01,1.811-0.004,2.716c-0.01,0.496-0.303,0.799-0.713,0.785c-0.395-0.016-0.658-0.307-0.664-0.787
                                        c-0.01-1.119,0.002-2.24-0.01-3.359c-0.002-0.246,0.082-0.355,0.322-0.406C21.875,11.76,22.193,11.649,22.615,11.529z" />
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_academics')); ?></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li <?php echo (in_array("batch-cat-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/batch-cat-manage"> <?php echo html_escape($this->common->languageTranslator('ltr_batch_cat_manager')); ?></a></li>
                                        <li <?php echo (in_array("batch-subcat-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/batch-subcat-manage"> <?php echo html_escape($this->common->languageTranslator('ltr_batch_subcat_manager')); ?></a></li>
                                        <li <?php echo (in_array("batch-manage", $cur_arr) || in_array("add-batch", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/batch-manage"> <?php echo html_escape($this->common->languageTranslator('ltr_batch_manager')); ?></a></li>

                                        <li <?php echo (in_array("notice-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/notice-manage"><?php echo html_escape($this->common->languageTranslator('ltr_notice_manager')); ?></a>
                                        <li <?php echo (in_array("subject-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/subject-manage"><?php echo html_escape($this->common->languageTranslator('ltr_subject_manager')); ?></a></li>
                                        <li <?php echo (in_array("question-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/question-manage"><?php echo html_escape($this->common->languageTranslator('ltr_question_manager')); ?></a></li>
                                        <li <?php echo (in_array("vacancy-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/vacancy-manage"><?php echo html_escape($this->common->languageTranslator('ltr_upcoming_exams_manager')); ?></a></li>
                                        <li <?php echo (in_array("live-class", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/live-class"><?php echo html_escape($this->common->languageTranslator('ltr_live_class')); ?></a></li>
                                        <li <?php echo (in_array("live-class-history", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/live-class-history"><?php echo html_escape($this->common->languageTranslator('ltr_live_class_history')); ?></a></li>

                                    </ul>
                                </li>
                            <?php }
                        }
                        if (isset($access->student_manage) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->student_manage == '1' || $this->session->userdata['super_admin'] == 1) { ?>
                                <li class="has_sub_menu <?php echo (in_array("add-student", $cur_arr) || in_array("student-manage", $cur_arr) || in_array("manage-student-leave", $cur_arr)) ? 'active' : ''; ?>"><a href="javascript:void(0);">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                            <g>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.489,22.06c0.063-0.261,0.107-0.525,0.189-0.78
                                    c0.351-1.078,1.049-1.865,2.094-2.302c1.589-0.662,3.194-1.29,4.795-1.928c0.333-0.133,0.624,0.008,0.75,0.354
                                    c0.363,0.999,0.723,1.999,1.083,2.998c0.022,0.059,0.047,0.117,0.087,0.221c0.082-0.231,0.155-0.425,0.214-0.618
                                    c0.014-0.048-0.011-0.113-0.032-0.164c-0.097-0.245-0.199-0.485-0.296-0.729c-0.177-0.443,0.057-0.8,0.527-0.802
                                    c0.733-0.002,1.465-0.002,2.198,0c0.471,0.002,0.704,0.358,0.527,0.802c-0.075,0.189-0.142,0.385-0.235,0.566
                                    c-0.098,0.192-0.111,0.37-0.019,0.566c0.052,0.107,0.083,0.226,0.139,0.375c0.038-0.091,0.065-0.152,0.089-0.217
                                    c0.358-0.987,0.714-1.974,1.074-2.96c0.146-0.41,0.411-0.53,0.813-0.371c1.528,0.61,3.061,1.211,4.583,1.836
                                    c1.384,0.565,2.196,1.596,2.41,3.085c0.004,0.021,0.021,0.044,0.031,0.067c0,1.452,0,2.904,0,4.358
                                    c-0.129,0.128-0.258,0.257-0.386,0.385c-6.75,0-13.5,0-20.25,0c-0.129-0.128-0.257-0.257-0.386-0.385
                                    C4.489,24.964,4.489,23.512,4.489,22.06z M20.606,21.788c-0.585,0-1.168-0.003-1.753,0c-0.381,0.001-0.594,0.217-0.596,0.6
                                    c0,0.513,0,1.028,0,1.541c0,0.404,0.209,0.624,0.613,0.624c1.161,0.004,2.325,0.005,3.488,0c0.391-0.002,0.604-0.224,0.604-0.613
                                    c0.002-0.514,0.002-1.028,0-1.542c-0.001-0.395-0.214-0.608-0.604-0.609C21.775,21.788,21.19,21.788,20.606,21.788z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.752,3.197c0.355,0.078,0.716,0.134,1.064,0.237
                                    c0.696,0.205,1.331,0.542,1.891,1.005c0.756,0.628,1.082,1.49,1.246,2.427c0.104,0.596,0.135,1.196,0.101,1.803
                                    C20.034,9,20.091,9.334,20.12,9.667c0.002,0.038,0.035,0.083,0.065,0.107c0.609,0.463,0.701,1.106,0.607,1.8
                                    c-0.068,0.499-0.223,0.975-0.517,1.394c-0.276,0.392-0.636,0.662-1.112,0.773c-0.078,0.019-0.162,0.094-0.206,0.167
                                    c-0.321,0.518-0.617,1.05-0.948,1.561c-0.552,0.847-1.384,1.258-2.353,1.413c-0.729,0.117-1.441,0.035-2.14-0.217
                                    c-0.688-0.249-1.211-0.694-1.6-1.297c-0.305-0.474-0.577-0.969-0.87-1.452c-0.042-0.068-0.113-0.15-0.184-0.166
                                    c-0.646-0.149-1.074-0.559-1.345-1.14C9.235,12,9.091,11.361,9.23,10.685c0.072-0.353,0.254-0.637,0.53-0.871
                                    c0.066-0.057,0.108-0.164,0.122-0.253c0.039-0.232-0.029-0.438-0.136-0.656C9.33,8.049,9.493,7.202,9.871,6.384
                                    c0.297-0.645,0.805-1.073,1.512-1.187c0.305-0.05,0.466-0.193,0.638-0.426c0.673-0.912,1.604-1.393,2.718-1.536
                                    c0.056-0.007,0.11-0.025,0.165-0.038C15.187,3.197,15.47,3.197,15.752,3.197z M12.993,7.486c-0.364,0.886-1.05,1.442-1.884,1.841
                                    C11,9.379,10.958,9.44,10.964,9.559c0.009,0.173,0.005,0.347,0.004,0.521c-0.003,0.274-0.132,0.452-0.393,0.521
                                    c-0.189,0.051-0.28,0.181-0.299,0.358c-0.058,0.531,0.074,1.019,0.378,1.455c0.126,0.181,0.308,0.304,0.541,0.276
                                    c0.337-0.04,0.51,0.132,0.661,0.408c0.322,0.59,0.663,1.169,1.012,1.744c0.319,0.525,0.824,0.792,1.406,0.929
                                    c0.417,0.099,0.839,0.114,1.261,0.038c0.646-0.117,1.225-0.365,1.583-0.949c0.366-0.594,0.714-1.2,1.053-1.81
                                    c0.136-0.244,0.3-0.394,0.594-0.36c0.239,0.027,0.433-0.073,0.568-0.259c0.318-0.443,0.452-0.944,0.39-1.488
                                    c-0.019-0.162-0.107-0.286-0.275-0.337c-0.303-0.093-0.416-0.249-0.415-0.561c0-0.205-0.01-0.412,0.002-0.616
                                    c0.01-0.154-0.06-0.194-0.197-0.21c-0.737-0.087-1.479-0.164-2.213-0.278c-0.88-0.138-1.752-0.327-2.54-0.773
                                    C13.718,7.958,13.369,7.721,12.993,7.486z" />
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_student_manager')); ?></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li <?php echo (in_array("add-student", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/add-student"><?php echo html_escape($this->common->languageTranslator('ltr_add_student')); ?></a></li>

                                        <li <?php echo (in_array("student-manage", $cur_arr) || in_array("doubts-ask", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/student-manage"><?php echo html_escape($this->common->languageTranslator('ltr_manage_students')); ?></a></li>
                                        <li <?php echo (in_array("manage-student-leave", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/manage-student-leave"><?php echo html_escape($this->common->languageTranslator('ltr_manage_student_leave')); ?></a></li>
                                        <!-- Payment Hiistory Sub Menu -->
                                    </ul>
                                </li>
                            <?php }
                        }
                        if (isset($access->teacher_manager) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->teacher_manager == '1' || $this->session->userdata['super_admin'] == 1) { ?>
                                <li class="has_sub_menu <?php echo (in_array("extra-classes", $cur_arr) || in_array("teacher-manage", $cur_arr) || in_array("manage-teacher-leave", $cur_arr)) ? 'active' : ''; ?>">
                                    <a href="javascript:void(0);">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.537,23.995c0,0.157,0,0.313,0,0.471
                                    c-0.102,0.233-0.256,0.412-0.5,0.511c-0.164,0.063-0.316,0.154-0.477,0.224c-2.129,0.944-4.355,1.498-6.672,1.689
                                    c-0.258,0.022-0.516,0.055-0.772,0.081c-0.705,0-1.41,0-2.115,0c-0.069-0.013-0.138-0.035-0.208-0.041
                                    c-0.672-0.07-1.349-0.109-2.017-0.212c-1.977-0.303-3.873-0.883-5.695-1.707c-0.27-0.122-0.505-0.259-0.62-0.545
                                    c0-0.157,0-0.313,0-0.471c0.017-0.101,0.036-0.203,0.053-0.303c0.269-1.603,0.868-3.065,1.873-4.349
                                    c0.775-0.992,1.729-1.644,3.066-1.493c0.063,0.006,0.128,0,0.192,0c-0.026-0.049-0.049-0.062-0.073-0.068
                                    c-0.037-0.011-0.076-0.017-0.114-0.025c-1.444-0.317-2.445-1.147-2.939-2.553c-0.223-0.633-0.326-1.293-0.286-1.961
                                    c0.054-0.922,0.15-1.841,0.23-2.763C7.561,9.36,7.849,8.288,8.367,7.29c1.285-2.475,3.274-3.965,6.086-4.229
                                    c1.267-0.12,2.498,0.105,3.643,0.679c2.432,1.215,3.777,3.244,4.311,5.854c0.15,0.738,0.205,1.496,0.291,2.245
                                    c0.105,0.91,0.139,1.821-0.047,2.725c-0.346,1.672-1.318,2.753-2.996,3.166c-0.102,0.025-0.205,0.054-0.307,0.082
                                    c0.227,0.04,0.447,0.037,0.668,0.042c0.145,0.002,0.289,0,0.43,0.021c0.656,0.104,1.193,0.444,1.652,0.904
                                    c1.203,1.204,1.875,2.692,2.271,4.321C24.441,23.394,24.482,23.696,24.537,23.995z M11.765,16.759
                                    c0.06-0.479,0.038-0.517-0.202-0.865c-0.28-0.406-0.537-0.831-0.813-1.242c-0.044-0.066-0.128-0.11-0.201-0.153
                                    c-0.243-0.146-0.538-0.241-0.725-0.438c-0.694-0.734-1.013-1.619-0.861-2.632c0.079-0.523,0.36-0.896,0.892-1.085
                                    c0.47-0.168,0.935-0.371,1.369-0.617c1.455-0.822,2.579-1.957,3.219-3.529c0.101-0.248,0.295-0.375,0.566-0.37
                                    c0.272,0.004,0.441,0.146,0.557,0.387c0.177,0.369,0.343,0.75,0.566,1.09c0.977,1.493,2.365,2.461,4.025,3.05
                                    c0.469,0.167,0.754,0.479,0.84,0.943c0.213,1.172-0.154,2.159-1.043,2.944c-0.125,0.112-0.311,0.155-0.461,0.244
                                    c-0.09,0.052-0.182,0.116-0.236,0.2c-0.26,0.384-0.471,0.803-0.764,1.156c-0.238,0.291-0.189,0.583-0.189,0.931
                                    c0.338-0.062,0.654-0.103,0.959-0.178c0.967-0.238,1.689-0.767,2.025-1.742c0.232-0.675,0.303-1.376,0.256-2.082
                                    c-0.059-0.837-0.148-1.673-0.25-2.507c-0.154-1.272-0.605-2.433-1.363-3.47c-1.697-2.324-4.653-3.196-7.252-2.066
                                    c-2.316,1.007-3.506,2.903-3.931,5.328c-0.11,0.627-0.163,1.265-0.225,1.9c-0.079,0.819-0.116,1.641,0.066,2.453
                                    c0.151,0.68,0.441,1.283,1.03,1.697C10.26,16.556,10.993,16.698,11.765,16.759z M19.141,19.022c-0.018,0.083-0.037,0.146-0.043,0.21
                                    c-0.084,0.795-0.164,1.593-0.248,2.389c-0.088,0.861-0.172,1.725-0.271,2.583c-0.063,0.534-0.523,0.748-0.973,0.458
                                    c-0.873-0.563-1.745-1.134-2.625-1.707c-0.029,0.026-0.065,0.065-0.109,0.092c-0.847,0.552-1.69,1.109-2.545,1.648
                                    c-0.37,0.23-0.845-0.012-0.9-0.447c-0.068-0.536-0.116-1.074-0.172-1.611c-0.087-0.835-0.174-1.672-0.261-2.507
                                    c-0.034-0.324-0.065-0.647-0.11-0.97c-0.007-0.052-0.073-0.138-0.113-0.138c-0.339-0.006-0.682-0.028-1.016,0.016
                                    c-0.515,0.063-0.887,0.396-1.208,0.774c-0.957,1.12-1.533,2.421-1.805,3.864c-0.026,0.138-0.066,0.249,0.12,0.329
                                    c2.551,1.105,5.213,1.703,7.994,1.755c1.175,0.02,2.344-0.074,3.502-0.266c1.66-0.272,3.252-0.763,4.779-1.467
                                    c0.131-0.062,0.18-0.131,0.141-0.271c-0.17-0.58-0.297-1.173-0.51-1.737c-0.334-0.881-0.801-1.698-1.471-2.379
                                    c-0.303-0.305-0.641-0.57-1.086-0.612C19.863,18.997,19.51,19.022,19.141,19.022z M18.99,11.216c0.047,0.2,0.123,0.391,0.129,0.584
                                    c0.014,0.647-0.26,1.19-0.682,1.659c-0.789,0.874-2.229,0.785-2.86-0.213c-0.196-0.311-0.392-0.394-0.708-0.354
                                    c-0.013,0.001-0.026,0.002-0.039,0c-0.152-0.027-0.226,0.042-0.292,0.182c-0.407,0.846-1.672,1.274-2.449,0.803
                                    c-0.771-0.469-1.176-1.185-1.208-2.089c-0.006-0.194,0.081-0.39,0.125-0.583c-0.246,0.093-0.504,0.182-0.753,0.293
                                    c-0.06,0.027-0.123,0.126-0.124,0.193c-0.016,0.584,0.161,1.103,0.561,1.535c0.033,0.036,0.102,0.061,0.151,0.058
                                    c0.434-0.028,0.566,0.069,0.769,0.445c0.281,0.521,0.571,1.04,0.901,1.53c0.362,0.54,0.822,0.997,1.39,1.33
                                    c0.732,0.43,1.468,0.435,2.206,0.009c0.477-0.275,0.861-0.65,1.207-1.072c0.461-0.564,0.828-1.187,1.131-1.847
                                    c0.141-0.312,0.361-0.424,0.686-0.392c0.061,0.005,0.145-0.025,0.186-0.068c0.393-0.421,0.561-0.931,0.557-1.498
                                    c0-0.069-0.037-0.177-0.088-0.199C19.52,11.406,19.246,11.312,18.99,11.216z M14.999,7.809c-0.842,1.338-1.953,2.326-3.286,3.085
                                    c0.357,0.026,0.702,0.031,1.045,0.025c0.79-0.015,1.602,0.496,1.859,1.246c0.087,0.256,0.342,0.076,0.516,0.114
                                    c0.097,0.021,0.211,0.037,0.264-0.12c0.195-0.58,0.614-0.948,1.183-1.131c0.236-0.076,0.496-0.093,0.746-0.107
                                    c0.316-0.017,0.633-0.004,0.949-0.004c0.006-0.018,0.014-0.036,0.021-0.054C16.949,10.128,15.839,9.141,14.999,7.809z
                                     M12.972,17.402c0,0.408-0.006,0.783,0.005,1.158c0.003,0.094,0.042,0.207,0.103,0.277c0.504,0.591,1.017,1.175,1.527,1.759
                                    c0.131,0.15,0.263,0.299,0.407,0.462c0.07-0.076,0.122-0.133,0.173-0.191c0.492-0.564,0.964-1.151,1.482-1.691
                                    c0.336-0.349,0.514-0.713,0.445-1.197c-0.029-0.193-0.004-0.394-0.004-0.636C15.725,18.364,14.366,18.376,12.972,17.402z
                                     M12.82,13.389c0.005,0.016,0.011,0.032,0.016,0.048c0.237-0.081,0.485-0.138,0.707-0.25c0.295-0.148,0.494-0.4,0.494-0.743
                                    c0-0.346-0.208-0.585-0.502-0.737c-0.588-0.305-1.208-0.265-1.828-0.13c-0.169,0.037-0.237,0.17-0.207,0.347
                                    c0.081,0.472,0.304,0.87,0.654,1.193C12.338,13.288,12.551,13.413,12.82,13.389z M17.57,11.473c0,0.006-0.002,0.012-0.002,0.018
                                    c-0.104,0-0.209-0.006-0.313,0.002c-0.371,0.026-0.719,0.125-1.004,0.375c-0.212,0.185-0.336,0.415-0.271,0.709
                                    c0.148,0.674,1.152,1.059,1.725,0.648c0.426-0.305,0.68-0.73,0.779-1.243c0.053-0.27-0.027-0.4-0.295-0.446
                                    C17.986,11.501,17.777,11.493,17.57,11.473z M12.514,23.143c0.593-0.386,1.147-0.745,1.721-1.12
                                    c-0.685-0.754-1.351-1.491-2.018-2.226c-0.016,0.009-0.032,0.016-0.049,0.023C12.281,20.911,12.395,22.003,12.514,23.143z
                                     M17.486,23.143c0.119-1.145,0.232-2.236,0.344-3.326c-0.018-0.004-0.035-0.009-0.055-0.013c-0.664,0.734-1.328,1.467-2.01,2.221
                                    C16.34,22.397,16.893,22.757,17.486,23.143z" />
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_teacher_manager')); ?></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li <?php echo (in_array("extra-classes", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/extra-classes"><?php echo html_escape($this->common->languageTranslator('ltr_extra_classes')); ?></a></li>
                                        <li <?php echo (in_array("teacher-manage", $cur_arr) || in_array("teacher-academic-record", $cur_arr) || in_array("teacher-progress", $cur_arr) || in_array("teacher-notice", $cur_arr) || in_array("doubts-class", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/teacher-manage"><?php echo html_escape($this->common->languageTranslator('ltr_manage_teachers')); ?></a></li>
                                        <li <?php echo (in_array("manage-teacher-leave", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/manage-teacher-leave"><?php echo html_escape($this->common->languageTranslator('ltr_manage_teacher_leave')); ?></a></li>
                                    </ul>
                                </li>
                            <?php }
                        }
                        // Code ilang
                        if (isset($access->library_manager) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->library_manager == '1' || $this->session->userdata['super_admin'] == 1) { ?>
                                <!--library section new-->
                                <li class="has_sub_menu <?php echo (in_array("book-manage", $cur_arr) || in_array("notes-manage", $cur_arr) || in_array("old-paper", $cur_arr)) ? 'active' : ''; ?>">
                                    <a href="javascript:void(0);">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.004 512.004" style="enable-background:new 0 0 512.004 512.004;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path d="M291.057,242.811c1.51,2.953,4.514,4.659,7.62,4.659c1.297,0,2.628-0.299,3.866-0.93
                                        c0.503-0.256,50.731-25.771,75.503-33.596c4.489-1.425,6.98-6.221,5.555-10.709c-1.417-4.489-6.178-6.989-10.709-5.572
                                        c-26.095,8.252-75.981,33.596-78.097,34.671C290.596,233.467,288.924,238.605,291.057,242.811z"></path>
                                                        <path d="M298.677,145.071c1.297,0,2.628-0.299,3.866-0.93c0.503-0.256,50.731-25.771,75.503-33.596
                                        c4.489-1.425,6.98-6.221,5.555-10.709c-1.417-4.489-6.178-6.989-10.709-5.572c-26.095,8.252-75.981,33.596-78.097,34.671
                                        c-4.198,2.133-5.871,7.27-3.738,11.477C292.567,143.364,295.571,145.071,298.677,145.071z"></path>
                                                        <path d="M503.469,128.004c-4.719,0-8.533,3.823-8.533,8.533v332.8c0,14.114-11.486,25.6-25.6,25.6h-204.8v-19.635
                                        c12.442-4.352,44.851-14.498,76.8-14.498c74.334,0,124.809,16.461,125.312,16.631c2.568,0.853,5.436,0.427,7.68-1.178
                                        c2.227-1.604,3.541-4.181,3.541-6.921V93.871c0-4.002-2.773-7.467-6.682-8.329c0,0-6.69-1.493-18.125-3.593
                                        c-4.617-0.853-9.079,2.219-9.933,6.844c-0.853,4.642,2.21,9.088,6.844,9.941c4.361,0.802,8.013,1.51,10.829,2.074v357.188
                                        c-19.337-5.069-62.276-14.259-119.467-14.259c-37.18,0-73.702,12.211-85.001,16.35c-10.044-4.437-40.405-16.35-77.133-16.35
                                        c-58.778,0-107.196,9.694-128,14.618V100.475c17.041-4.19,67.371-15.138,128-15.138c31.113,0,57.796,9.685,68.267,14.063v335.804
                                        c0,3.072,1.655,5.914,4.326,7.424c2.671,1.519,5.965,1.476,8.602-0.111c0.845-0.503,85.393-51.004,160.435-76.015
                                        c3.49-1.169,5.837-4.42,5.837-8.098V8.537c0-2.799-1.374-5.419-3.678-7.014c-2.287-1.596-5.222-1.963-7.859-0.981
                                        C346.856,26.15,277.771,69.141,277.079,69.568c-3.994,2.5-5.214,7.765-2.714,11.759c2.492,3.994,7.757,5.214,11.759,2.714
                                        c0.631-0.401,60.732-37.794,123.477-63.027v331.281c-58.249,20.241-119.066,53.291-145.067,68.087V93.871
                                        c0-3.234-1.826-6.187-4.719-7.637c-1.468-0.725-36.437-17.963-80.614-17.963c-77.107,0-136.388,16.683-138.88,17.399
                                        c-3.661,1.041-6.187,4.395-6.187,8.201v375.467c0,2.671,1.263,5.197,3.388,6.81c1.502,1.135,3.311,1.724,5.146,1.724
                                        c0.785,0,1.57-0.111,2.338-0.333c0.589-0.162,59.597-16.734,134.195-16.734c31.198,0,57.856,9.711,68.267,14.071v20.062h-204.8
                                        c-14.114,0-25.6-11.486-25.6-25.6v-332.8c0-4.71-3.823-8.533-8.533-8.533s-8.533,3.823-8.533,8.533v332.8
                                        c0,23.526,19.14,42.667,42.667,42.667h426.667c23.526,0,42.667-19.14,42.667-42.667v-332.8
                                        C512.002,131.827,508.188,128.004,503.469,128.004z"></path>
                                                        <path d="M291.057,191.611c1.51,2.953,4.514,4.659,7.62,4.659c1.297,0,2.628-0.299,3.866-0.93
                                        c0.503-0.256,50.731-25.771,75.503-33.596c4.489-1.425,6.98-6.221,5.555-10.709c-1.417-4.489-6.178-6.989-10.709-5.572
                                        c-26.095,8.252-75.981,33.596-78.097,34.671C290.596,182.267,288.924,187.405,291.057,191.611z"></path>
                                                        <path d="M291.057,294.011c1.51,2.953,4.514,4.659,7.62,4.659c1.297,0,2.628-0.299,3.866-0.93
                                        c0.503-0.256,50.731-25.771,75.503-33.596c4.489-1.425,6.98-6.221,5.555-10.709c-1.417-4.489-6.178-6.989-10.709-5.572
                                        c-26.095,8.252-75.981,33.596-78.097,34.671C290.596,284.667,288.924,289.805,291.057,294.011z"></path>
                                                        <path d="M206.748,158.366c-52.693-12.365-112.572,3.388-115.089,4.062c-4.548,1.22-7.253,5.896-6.033,10.453
                                        c1.024,3.814,4.471,6.323,8.235,6.323c0.734,0,1.476-0.094,2.219-0.29c0.572-0.162,58.223-15.326,106.778-3.934
                                        c4.565,1.067,9.182-1.775,10.257-6.366C214.189,164.032,211.339,159.441,206.748,158.366z"></path>
                                                        <path d="M206.748,209.566c-52.693-12.356-112.572,3.388-115.089,4.062c-4.548,1.22-7.253,5.897-6.033,10.453
                                        c1.024,3.814,4.471,6.323,8.235,6.323c0.734,0,1.476-0.094,2.219-0.29c0.572-0.162,58.223-15.326,106.778-3.934
                                        c4.565,1.067,9.182-1.775,10.257-6.366C214.189,215.232,211.339,210.641,206.748,209.566z"></path>
                                                        <path d="M291.057,345.211c1.51,2.953,4.514,4.659,7.62,4.659c1.297,0,2.628-0.299,3.866-0.93
                                        c0.503-0.256,50.731-25.771,75.503-33.596c4.489-1.425,6.98-6.221,5.555-10.709c-1.417-4.488-6.178-6.989-10.709-5.572
                                        c-26.095,8.252-75.981,33.596-78.097,34.671C290.596,335.867,288.924,341.005,291.057,345.211z"></path>
                                                        <path d="M206.748,260.766c-52.693-12.356-112.572,3.379-115.089,4.062c-4.548,1.22-7.253,5.897-6.033,10.453
                                        c1.024,3.814,4.471,6.332,8.235,6.332c0.734,0,1.476-0.102,2.219-0.299c0.572-0.162,58.223-15.326,106.778-3.934
                                        c4.565,1.067,9.182-1.775,10.257-6.366C214.189,266.432,211.339,261.841,206.748,260.766z"></path>
                                                        <path d="M206.748,363.166c-52.693-12.365-112.572,3.388-115.089,4.062c-4.548,1.22-7.253,5.897-6.033,10.453
                                        c1.024,3.814,4.471,6.332,8.235,6.332c0.734,0,1.476-0.102,2.219-0.299c0.572-0.162,58.223-15.326,106.778-3.934
                                        c4.565,1.058,9.182-1.775,10.257-6.366C214.189,368.832,211.339,364.241,206.748,363.166z"></path>
                                                        <path d="M206.748,311.966c-52.693-12.365-112.572,3.379-115.089,4.062c-4.548,1.22-7.253,5.897-6.033,10.453
                                        c1.024,3.814,4.471,6.332,8.235,6.332c0.734,0,1.476-0.102,2.219-0.299c0.572-0.162,58.223-15.326,106.778-3.934
                                        c4.565,1.067,9.182-1.775,10.257-6.366C214.189,317.632,211.339,313.041,206.748,311.966z"></path>
                                                    </g>
                                                </g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_library_manager')); ?></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li <?php echo (in_array("book-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/book-manage"><?php echo html_escape($this->common->languageTranslator('ltr_books')); ?></a></li>
                                        <li <?php echo (in_array("notes-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/notes-manage"><?php echo html_escape($this->common->languageTranslator('ltr_notes')); ?></a></li>
                                        <li <?php echo (in_array("old-paper", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/old-paper"><?php echo html_escape($this->common->languageTranslator('ltr_old_papers')); ?></a></li>
                                    </ul>
                                </li>
                            <?php }
                        }
                        if (isset($access->exam) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->exam == '1' || $this->session->userdata['super_admin'] == 1) { ?>
                                <li class="has_sub_menu <?php echo (in_array("create-paper", $cur_arr) || in_array("exam-manage", $cur_arr) || in_array("mock-result", $cur_arr) || in_array("practice-result", $cur_arr)) ? 'active' : ''; ?>">
                                    <a href="javascript:void(0);" class="">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                            <g>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.207,4.605c0.082,0.068,0.172,0.131,0.248,0.206
                                        c1.086,1.085,2.172,2.172,3.256,3.259c0.048,0.047,0.098,0.095,0.137,0.149c0.1,0.138,0.081,0.327-0.041,0.442
                                        c-0.132,0.124-0.28,0.125-0.428,0.037c-0.063-0.037-0.112-0.096-0.166-0.148c-1.037-1.038-2.076-2.075-3.111-3.116
                                        c-0.098-0.1-0.193-0.143-0.335-0.141c-3.551,0.003-7.103,0.002-10.654,0.002c-0.688,0-1.125,0.438-1.125,1.129
                                        c-0.002,5.716-0.002,11.434,0,17.149c0,0.69,0.435,1.129,1.126,1.129c2.928,0,5.858,0,8.786,0.001c0.087,0,0.195-0.012,0.256,0.031
                                        c0.089,0.067,0.185,0.167,0.211,0.271c0.05,0.185-0.093,0.294-0.229,0.389c-3.126,0-6.253,0-9.379,0
                                        c-0.28-0.138-0.581-0.243-0.834-0.418c-0.36-0.241-0.515-0.64-0.627-1.045c0-5.954,0-11.909,0-17.864
                                        c0.136-0.28,0.242-0.579,0.414-0.835c0.244-0.362,0.643-0.51,1.047-0.627C10.574,4.605,14.392,4.605,18.207,4.605z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.314,25.395c-0.187-0.104-0.252-0.256-0.247-0.468
                                        c0.011-0.621-0.006-1.243,0.01-1.866c0.003-0.133,0.063-0.299,0.155-0.392c1.479-1.494,2.965-2.982,4.454-4.464
                                        c0.565-0.563,1.326-0.563,1.898-0.011c0.229,0.22,0.446,0.452,0.676,0.671c0.244,0.233,0.362,0.526,0.442,0.844
                                        c0,0.054,0,0.107,0,0.162c-0.058,0.488-0.361,0.821-0.691,1.148c-1.387,1.379-2.763,2.762-4.146,4.142
                                        c-0.085,0.087-0.186,0.155-0.278,0.233C18.83,25.395,18.072,25.395,17.314,25.395z M22.81,21.217
                                        c-0.177-0.182-0.351-0.359-0.51-0.522c-0.991,0.986-1.986,1.979-2.955,2.946c0.169,0.174,0.342,0.354,0.507,0.529
                                        C20.836,23.187,21.827,22.198,22.81,21.217z M21.264,19.652c-0.997,0.995-1.99,1.987-2.982,2.979
                                        c0.167,0.164,0.346,0.337,0.508,0.495c0.986-0.984,1.984-1.98,2.984-2.978C21.607,19.985,21.43,19.814,21.264,19.652z
                                         M21.813,19.112c0.507,0.507,1.031,1.029,1.558,1.554c0.144-0.141,0.314-0.295,0.466-0.467c0.213-0.24,0.217-0.538,0-0.77
                                        c-0.259-0.277-0.527-0.545-0.804-0.802c-0.219-0.207-0.509-0.223-0.736-0.029C22.107,18.759,21.953,18.96,21.813,19.112z
                                         M19.258,24.694c-0.496-0.495-1.003-1.001-1.483-1.482c0,0.461,0,0.97,0,1.482C18.29,24.694,18.793,24.694,19.258,24.694z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.604,10.149c-0.102,0-0.182,0-0.26,0
                                        c-0.926,0-1.854,0.004-2.779,0c-0.854-0.004-1.512-0.481-1.731-1.258c-0.041-0.147-0.067-0.305-0.069-0.457
                                        c-0.008-0.562-0.004-1.124-0.003-1.685c0-0.26,0.128-0.406,0.348-0.404c0.221,0.001,0.341,0.144,0.341,0.408
                                        c0.001,0.521,0,1.042,0,1.563c0.001,0.708,0.423,1.135,1.134,1.138c1.066,0.004,2.136,0,3.205,0.001c0.42,0,0.51,0.092,0.51,0.516
                                        c0,2.197,0,4.396,0,6.594c0,0.074,0.001,0.15-0.012,0.221c-0.028,0.178-0.136,0.278-0.314,0.285c-0.18,0.01-0.3-0.076-0.344-0.249
                                        c-0.021-0.091-0.022-0.188-0.022-0.282c-0.002-2.036-0.002-4.071-0.002-6.106C22.604,10.346,22.604,10.26,22.604,10.149z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.128,21.935c-0.312,0-0.622,0.001-0.934,0
                                        c-0.311-0.004-0.438-0.133-0.439-0.449c-0.001-0.635-0.002-1.271,0-1.904c0.001-0.291,0.132-0.424,0.42-0.428
                                        c0.649-0.003,1.298-0.003,1.945,0c0.271,0.004,0.406,0.13,0.408,0.397c0.006,0.662,0.007,1.322-0.001,1.985
                                        c-0.003,0.269-0.138,0.393-0.407,0.396C10.791,21.936,10.458,21.935,10.128,21.935z M10.822,21.239c0-0.473,0-0.921,0-1.375
                                        c-0.461,0-0.909,0-1.375,0c0,0.433-0.003,0.851,0.004,1.268c0.001,0.036,0.057,0.103,0.089,0.103
                                        C9.963,21.241,10.388,21.239,10.822,21.239z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.128,10.847c0.338,0,0.676-0.003,1.014,0.002
                                        c0.25,0.003,0.381,0.118,0.385,0.368c0.008,0.674,0.009,1.35,0,2.025c-0.004,0.254-0.145,0.373-0.406,0.375
                                        c-0.647,0.001-1.296,0.001-1.945,0c-0.286-0.002-0.419-0.135-0.42-0.427c-0.002-0.642-0.002-1.283,0-1.925
                                        c0.001-0.293,0.126-0.415,0.42-0.418C9.492,10.845,9.811,10.847,10.128,10.847z M10.822,12.913c0-0.459,0-0.906,0-1.358
                                        c-0.461,0-0.909,0-1.359,0c0,0.464,0,0.911,0,1.358C9.925,12.913,10.367,12.913,10.822,12.913z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.067,15.689c-0.555,0-1.109,0.002-1.663,0
                                        c-0.263,0-0.407-0.127-0.407-0.346c0.001-0.216,0.15-0.344,0.41-0.344c1.109,0,2.217,0,3.327,0c0.257,0,0.407,0.133,0.406,0.349
                                        s-0.148,0.341-0.41,0.341C18.178,15.69,17.621,15.689,17.067,15.689z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.001,10.847c0.548,0,1.096-0.001,1.642,0.001
                                        c0.277,0.001,0.431,0.131,0.426,0.349c-0.006,0.208-0.165,0.343-0.421,0.343c-1.109,0.002-2.217,0-3.325,0
                                        c-0.179,0-0.326-0.063-0.385-0.237c-0.05-0.153-0.018-0.307,0.132-0.392c0.076-0.044,0.178-0.06,0.269-0.061
                                        C13.893,10.844,14.446,10.847,15.001,10.847z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.732,16.897c0.392-0.587,0.754-1.141,1.132-1.684
                                        c0.065-0.094,0.191-0.188,0.298-0.2c0.097-0.01,0.232,0.067,0.302,0.148c0.105,0.124,0.071,0.278-0.019,0.413
                                        c-0.381,0.568-0.758,1.136-1.135,1.703c-0.074,0.112-0.144,0.228-0.225,0.337c-0.143,0.187-0.358,0.21-0.529,0.052
                                        c-0.236-0.223-0.464-0.454-0.688-0.688c-0.149-0.155-0.145-0.349-0.007-0.49c0.136-0.138,0.331-0.145,0.49,0.002
                                        C9.479,16.609,9.592,16.746,9.732,16.897z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.116,12.926c0.439,0,0.879-0.001,1.317,0
                                        c0.254,0.001,0.394,0.119,0.398,0.33c0.007,0.216-0.146,0.359-0.396,0.359c-0.887,0.003-1.77,0.003-2.656,0
                                        c-0.248,0-0.404-0.146-0.399-0.357c0.004-0.209,0.147-0.331,0.396-0.332C17.225,12.925,17.671,12.926,18.116,12.926z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.637,17.765c-0.438,0-0.879,0.002-1.316,0
                                        c-0.255,0-0.394-0.117-0.396-0.329c-0.007-0.217,0.142-0.358,0.394-0.36c0.886-0.002,1.771-0.002,2.655,0
                                        c0.246,0.002,0.411,0.153,0.404,0.358c-0.007,0.204-0.155,0.331-0.402,0.331C15.529,17.767,15.083,17.765,14.637,17.765z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.646,21.241c0.439,0,0.879-0.002,1.317,0.001
                                        c0.261,0,0.413,0.132,0.413,0.342c0,0.205-0.16,0.349-0.413,0.349c-0.878,0.002-1.757,0.002-2.635,0
                                        c-0.258,0-0.407-0.137-0.405-0.351c0-0.219,0.139-0.34,0.406-0.341C13.769,21.239,14.207,21.241,14.646,21.241z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.638,19.847c-0.432,0-0.864,0.002-1.297-0.001
                                        c-0.274,0-0.414-0.114-0.417-0.33c-0.007-0.226,0.142-0.36,0.414-0.362c0.871-0.001,1.743-0.003,2.614,0
                                        c0.344,0.004,0.543,0.283,0.363,0.524c-0.067,0.09-0.223,0.157-0.341,0.161C15.53,19.857,15.085,19.847,14.638,19.847z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.43,17.765c-0.324,0-0.648,0.004-0.973,0
                                        c-0.244-0.003-0.388-0.134-0.386-0.345c0.002-0.2,0.159-0.343,0.394-0.345c0.661-0.004,1.323-0.004,1.985,0.002
                                        c0.236,0,0.385,0.145,0.382,0.352c-0.002,0.216-0.137,0.335-0.39,0.336C19.104,17.769,18.767,17.765,18.43,17.765z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.311,12.926c0.331,0,0.661-0.002,0.992,0.001
                                        c0.223,0.003,0.378,0.138,0.382,0.331c0.006,0.197-0.154,0.356-0.384,0.357c-0.667,0.003-1.336,0.005-2.003,0
                                        c-0.238-0.001-0.381-0.144-0.374-0.357c0.002-0.206,0.139-0.328,0.374-0.331C13.635,12.924,13.973,12.926,14.311,12.926z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6,15.689c-0.114,0-0.229,0.004-0.344-0.002
                                        c-0.2-0.009-0.33-0.142-0.332-0.332c-0.006-0.193,0.12-0.343,0.313-0.352c0.243-0.011,0.487-0.01,0.731,0
                                        c0.187,0.006,0.335,0.168,0.333,0.343c-0.002,0.177-0.148,0.331-0.337,0.341C13.845,15.694,13.722,15.689,13.6,15.689z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.745,19.839c-0.128,0-0.256,0.012-0.385-0.002
                                        c-0.177-0.021-0.275-0.137-0.287-0.314c-0.011-0.176,0.077-0.324,0.249-0.34c0.287-0.027,0.579-0.025,0.867-0.003
                                        c0.177,0.014,0.277,0.181,0.259,0.354c-0.02,0.176-0.118,0.288-0.297,0.306C18.017,19.851,17.88,19.84,17.745,19.839
                                        C17.745,19.839,17.745,19.839,17.745,19.839z" />
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_exam')); ?></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li <?php echo (in_array("create-paper", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/create-paper"><?php echo html_escape($this->common->languageTranslator('ltr_create_paper')); ?></a></li>

                                        <li <?php echo (in_array("exam-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/exam-manage"><?php echo html_escape($this->common->languageTranslator('ltr_manage_paper')); ?></a></li>
                                        <li <?php echo (in_array("practice-result", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/practice-result"><?php echo html_escape($this->common->languageTranslator('ltr_practice_result')); ?></a></li>
                                        <li <?php echo (in_array("mock-result", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/mock-result"><?php echo html_escape($this->common->languageTranslator('ltr_mock_test_result')); ?></a></li>

                                    </ul>
                                </li>
                            <?php }
                        }
                        if (isset($access->gallary_manage) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->gallary_manage == '1' || $this->session->userdata['super_admin'] == 1) { ?>
                                <li <?php echo (in_array("gallery-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/gallery-manage">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
                                            <g>
                                                <path d="M57,6H1C0.448,6,0,6.447,0,7v44c0,0.553,0.448,1,1,1h56c0.552,0,1-0.447,1-1V7C58,6.447,57.552,6,57,6z M56,50H2V8h54V50z" />
                                                <path d="M16,28.138c3.071,0,5.569-2.498,5.569-5.568C21.569,19.498,19.071,17,16,17s-5.569,2.498-5.569,5.569
                                    C10.431,25.64,12.929,28.138,16,28.138z M16,19c1.968,0,3.569,1.602,3.569,3.569S17.968,26.138,16,26.138s-3.569-1.601-3.569-3.568
                                    S14.032,19,16,19z" />
                                                <path d="M7,46c0.234,0,0.47-0.082,0.66-0.249l16.313-14.362l10.302,10.301c0.391,0.391,1.023,0.391,1.414,0s0.391-1.023,0-1.414
                                    l-4.807-4.807l9.181-10.054l11.261,10.323c0.407,0.373,1.04,0.345,1.413-0.062c0.373-0.407,0.346-1.04-0.062-1.413l-12-11
                                    c-0.196-0.179-0.457-0.268-0.72-0.262c-0.265,0.012-0.515,0.129-0.694,0.325l-9.794,10.727l-4.743-4.743
                                    c-0.374-0.373-0.972-0.392-1.368-0.044L6.339,44.249c-0.415,0.365-0.455,0.997-0.09,1.412C6.447,45.886,6.723,46,7,46z" />
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_gallery_manager')); ?></span>
                                    </a>
                                </li>
                            <?php }
                        }
                        if (isset($access->video_lecture) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->video_lecture == '1' || $this->session->userdata['super_admin'] == 1) { ?>
                                <li <?php echo (in_array("video-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/video-manage">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                            <g>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.753,23.958c-7.167,0-14.334,0-21.506,0
                                    c0-5.968,0-11.938,0-17.916c7.166,0,14.336,0,21.506,0C25.753,12.009,25.753,17.981,25.753,23.958z M22.153,23.233
                                    c0-5.502,0-10.986,0-16.465c-4.784,0-9.551,0-14.314,0c0,5.497,0,10.976,0,16.465C12.612,23.233,17.375,23.233,22.153,23.233z
                                     M4.975,6.761c0,0.722,0,1.427,0,2.125c0.721,0,1.425,0,2.124,0c0-0.717,0-1.416,0-2.125C6.389,6.761,5.69,6.761,4.975,6.761z
                                     M22.903,6.755c0,0.712,0,1.421,0,2.133c0.712,0,1.416,0,2.117,0c0-0.719,0-1.423,0-2.133C24.31,6.755,23.615,6.755,22.903,6.755z
                                     M7.095,11.761c0-0.722,0-1.426,0-2.124c-0.72,0-1.424,0-2.125,0c0,0.717,0,1.416,0,2.124C5.682,11.761,6.38,11.761,7.095,11.761z
                                     M25.021,11.761c0-0.722,0-1.426,0-2.124c-0.72,0-1.424,0-2.124,0c0,0.717,0,1.416,0,2.124
                                    C23.607,11.761,24.307,11.761,25.021,11.761z M7.099,14.629c0-0.725,0-1.424,0-2.128c-0.715,0-1.42,0-2.123,0
                                    c0,0.718,0,1.421,0,2.128C5.69,14.629,6.389,14.629,7.099,14.629z M22.9,12.497c0,0.722,0,1.425,0,2.124c0.72,0,1.426,0,2.125,0
                                    c0-0.717,0-1.416,0-2.124C24.315,12.497,23.615,12.497,22.9,12.497z M7.101,15.371c-0.722,0-1.426,0-2.123,0
                                    c0,0.72,0,1.424,0,2.124c0.717,0,1.415,0,2.123,0C7.101,16.784,7.101,16.086,7.101,15.371z M25.021,17.498c0-0.723,0-1.428,0-2.126
                                    c-0.72,0-1.424,0-2.124,0c0,0.718,0,1.416,0,2.126C23.607,17.498,24.307,17.498,25.021,17.498z M7.106,18.242
                                    c-0.711,0-1.421,0-2.133,0c0,0.711,0,1.416,0,2.116c0.72,0,1.424,0,2.133,0C7.106,19.647,7.106,18.954,7.106,18.242z M22.9,18.232
                                    c0,0.723,0,1.427,0,2.126c0.72,0,1.426,0,2.125,0c0-0.718,0-1.416,0-2.126C24.315,18.232,23.615,18.232,22.9,18.232z M4.976,21.102
                                    c0,0.722,0,1.427,0,2.124c0.721,0,1.424,0,2.123,0c0-0.719,0-1.416,0-2.124C6.389,21.102,5.688,21.102,4.976,21.102z
                                     M25.021,23.233c0-0.724,0-1.427,0-2.124c-0.72,0-1.424,0-2.124,0c0,0.717,0,1.416,0,2.124
                                    C23.607,23.233,24.307,23.233,25.021,23.233z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.131,14.996c0-0.918-0.001-1.836,0-2.755
                                    c0.001-0.434,0.253-0.586,0.624-0.374c1.617,0.923,3.234,1.846,4.851,2.771c0.356,0.204,0.355,0.511-0.002,0.717
                                    c-1.616,0.923-3.233,1.848-4.851,2.77c-0.37,0.212-0.621,0.06-0.622-0.375C12.13,16.833,12.131,15.914,12.131,14.996z
                                     M12.864,12.758c0,1.506,0,2.98,0,4.479c1.313-0.749,2.6-1.485,3.92-2.241C15.459,14.239,14.175,13.506,12.864,12.758z" />
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_video_lecture_manager')); ?></span>
                                    </a>
                                </li>
                            <?php }
                        }
                        if (isset($access->doubtsask) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->doubtsask == '1' || $this->session->userdata['super_admin'] == 1) {  ?>
                                <!-- Doubt Class -->
                                <li <?php echo in_array("doubts-classes", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/doubts-classes">
                                        <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m471.367 146.669h-108.468v-75.335c0-22.404-18.228-40.632-40.633-40.632h-281.633c-22.405 0-40.633 18.228-40.633 40.632v111.686c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-111.686c0-14.134 11.499-25.632 25.633-25.632h281.634c14.134 0 25.633 11.498 25.633 25.632v198.803c0 14.134-11.498 25.633-25.632 25.633h-162.238c-4.218 0-8.182 1.643-11.16 4.622l-49.7 49.7c-.139.141-.372.37-.854.171-.483-.2-.483-.528-.483-.724v-37.986c0-8.703-7.081-15.783-15.784-15.783h-41.416c-14.134 0-25.633-11.499-25.633-25.633v-57.117c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v57.117c0 22.405 18.228 40.633 40.633 40.633h41.416c.433 0 .784.352.784.783v37.986c0 6.406 3.824 12.13 9.743 14.581 1.965.815 4.02 1.21 6.056 1.21 4.1-.001 8.118-1.604 11.146-4.631l39.323-39.324v64.729c0 22.404 18.227 40.632 40.632 40.632h90.834c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-90.834c-14.134 0-25.632-11.498-25.632-25.632v-75.334h158.167c22.404 0 40.632-18.228 40.632-40.633v-108.468h108.468c14.134 0 25.633 11.499 25.633 25.633v198.803c0 14.134-11.499 25.632-25.633 25.632h-41.416c-8.703 0-15.784 7.08-15.784 15.783v37.986c0 .196 0 .523-.483.725-.48.2-.715-.03-.853-.171l-49.699-49.698c-2.98-2.982-6.944-4.625-11.161-4.625h-41.402c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h41.402c.205 0 .406.083.553.23l49.7 49.7c3.027 3.026 7.046 4.631 11.146 4.631 2.035-.001 4.092-.396 6.056-1.21 5.919-2.451 9.743-8.175 9.743-14.582v-37.986c0-.432.352-.783.784-.783h41.416c22.405 0 40.633-18.228 40.633-40.632v-198.803c-.003-22.405-18.231-40.633-40.636-40.633z" />
                                                <path d="m231.934 352.97c0 13.271 10.796 24.066 24.066 24.066 13.271 0 24.066-10.796 24.066-24.066s-10.795-24.067-24.066-24.067c-13.27 0-24.066 10.796-24.066 24.067zm33.132 0c0 4.999-4.067 9.066-9.066 9.066s-9.066-4.067-9.066-9.066 4.067-9.066 9.066-9.066 9.066 4.067 9.066 9.066z" />
                                                <path d="m157.383 253.569c0 13.27 10.797 24.066 24.067 24.066 13.271 0 24.066-10.796 24.066-24.066 0-13.271-10.796-24.066-24.066-24.066s-24.067 10.796-24.067 24.066zm33.134 0c0 4.999-4.067 9.066-9.066 9.066-5 0-9.067-4.067-9.067-9.066s4.067-9.066 9.067-9.066c4.998 0 9.066 4.067 9.066 9.066z" />
                                                <path d="m205.517 172.937c21.462-9.945 34.639-32.09 32.994-55.905-1.95-28.296-24.759-51.105-53.052-53.058-15.796-1.094-31.485 4.463-43.033 15.242-11.552 10.781-18.177 26.024-18.177 41.82 0 13.271 10.797 24.066 24.067 24.066s24.066-10.796 24.066-24.066c0-2.578.998-4.871 2.885-6.632 1.854-1.729 4.302-2.58 6.877-2.411 4.306.297 8.05 4.042 8.347 8.352.273 3.948-1.979 7.602-5.604 9.09-16.709 6.861-27.505 23.073-27.505 41.302v16.566c0 13.271 10.796 24.067 24.066 24.067s24.067-10.797 24.067-24.067v-14.366zm-8.041-12.853c-4.228 1.735-6.959 5.917-6.959 10.652v16.566c0 5-4.067 9.067-9.067 9.067-4.999 0-9.066-4.067-9.066-9.067v-16.566c0-12.12 7.145-22.886 18.202-27.427 9.614-3.947 15.59-13.592 14.871-23.998-.806-11.689-10.592-21.477-22.289-22.283-.572-.039-1.141-.059-1.706-.059-6.142 0-11.921 2.263-16.426 6.467-4.935 4.604-7.652 10.855-7.652 17.6 0 4.999-4.067 9.066-9.066 9.066-5 0-9.067-4.067-9.067-9.066 0-11.653 4.889-22.9 13.411-30.855 8.518-7.952 20.078-12.059 31.766-11.242 20.863 1.438 37.682 18.259 39.12 39.125 1.256 18.212-9.222 35.1-26.072 42.02z" />
                                                <path d="m429.167 352.97c0-13.271-10.796-24.066-24.066-24.066s-24.066 10.796-24.066 24.066 10.796 24.066 24.066 24.066 24.066-10.796 24.066-24.066zm-33.133 0c0-4.999 4.067-9.066 9.066-9.066s9.066 4.067 9.066 9.066-4.067 9.066-9.066 9.066c-4.998 0-9.066-4.067-9.066-9.066z" />
                                                <path d="m330.551 377.036c13.27 0 24.066-10.796 24.066-24.066s-10.796-24.066-24.066-24.066c-13.271 0-24.067 10.796-24.067 24.066s10.796 24.066 24.067 24.066zm0-33.133c4.999 0 9.066 4.067 9.066 9.066s-4.067 9.066-9.066 9.066c-5 0-9.067-4.067-9.067-9.066s4.067-9.066 9.067-9.066z" />
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_doubts_class')); ?></span>
                                    </a></li>
                            <?php }
                        }
                        if (isset($access->enquiry) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->enquiry == '1' || $this->session->userdata['super_admin'] == 1) {  ?>
                                <!-- Enquiry -->
                        <?php }
                        } ?>
                        <!-- <li <?php echo (in_array("timezone", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/timezone">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.827,14.239c0.067-0.474,0.12-0.952,0.204-1.423
                                        c0.381-2.14,1.277-4.042,2.684-5.696C7.605,4.896,10,3.534,12.867,2.999c0.371-0.069,0.746-0.115,1.119-0.171
                                        c0.676,0,1.353,0,2.028,0c0.057,0.015,0.111,0.04,0.168,0.045c1.949,0.187,3.748,0.811,5.391,1.876
                                        c0.379,0.246,0.742,0.514,1.139,0.791c0-0.752,0.006-1.477-0.004-2.202c-0.004-0.225,0.064-0.394,0.256-0.51
                                        c0.102,0,0.203,0,0.305,0c0.193,0.116,0.258,0.286,0.256,0.51c-0.008,0.998-0.002,1.995-0.004,2.992
                                        c0,0.391-0.146,0.545-0.527,0.547c-1.006,0.003-2.012,0.001-3.018,0c-0.066,0-0.137-0.004-0.199-0.023
                                        c-0.211-0.065-0.334-0.212-0.305-0.435c0.027-0.216,0.164-0.35,0.395-0.351c0.6-0.003,1.201-0.001,1.801-0.001
                                        c0.092,0,0.184,0,0.332,0c-0.082-0.076-0.121-0.122-0.17-0.157c-1.578-1.183-3.34-1.919-5.297-2.176
                                        c-5.895-0.775-11.325,3.002-12.62,8.793c-0.141,0.631-0.191,1.284-0.26,1.929c-0.025,0.235-0.053,0.438-0.314,0.514
                                        c-0.257,0.072-0.385-0.1-0.51-0.273C2.827,14.544,2.827,14.392,2.827,14.239z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.174,15.761c-0.035,0.272-0.072,0.546-0.104,0.819
                                        c-0.033,0.299-0.191,0.461-0.439,0.447s-0.391-0.195-0.369-0.496c0.027-0.385,0.045-0.772,0.111-1.151
                                        c0.021-0.129,0.156-0.289,0.277-0.334c0.107-0.039,0.271,0.051,0.402,0.105c0.053,0.021,0.08,0.1,0.121,0.154
                                        C27.174,15.456,27.174,15.608,27.174,15.761z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.645,27.172c-0.071-0.09-0.163-0.168-0.209-0.27
                                        c-0.114-0.246,0.086-0.523,0.384-0.539c0.378-0.02,0.758-0.033,1.137-0.047c0.276-0.01,0.46,0.139,0.472,0.379
                                        c0.012,0.252-0.139,0.402-0.422,0.43c-0.082,0.01-0.163,0.031-0.245,0.047C15.389,27.172,15.017,27.172,14.645,27.172z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.997,6.473c4.728,0.001,8.524,3.816,8.522,8.563
                                        c-0.002,4.681-3.84,8.485-8.556,8.483c-4.672-0.004-8.489-3.844-8.483-8.532C6.486,10.275,10.29,6.472,14.997,6.473z
                                         M22.689,14.591c-0.137-2.025-0.902-3.728-2.334-5.123c-1.371-1.335-3.023-2.035-4.951-2.173c0,0.393,0.001,0.755,0,1.117
                                        c-0.001,0.293-0.159,0.486-0.396,0.493c-0.244,0.007-0.411-0.195-0.412-0.502c-0.002-0.362,0-0.723,0-1.085
                                        c-1.533,0.028-3.694,0.712-5.311,2.521c-1.205,1.346-1.859,2.922-1.97,4.754c0.416,0,0.795-0.005,1.173,0.001
                                        c0.25,0.005,0.412,0.156,0.424,0.379c0.012,0.225-0.158,0.408-0.409,0.43c-0.109,0.008-0.22,0.002-0.33,0.002
                                        c-0.282,0-0.565,0-0.848,0c0.223,4.409,4.02,7.253,7.27,7.241c0-0.379-0.006-0.758,0.002-1.137c0.007-0.305,0.269-0.5,0.532-0.402
                                        c0.198,0.072,0.279,0.229,0.277,0.438c-0.004,0.375-0.001,0.75-0.001,1.127c4.363-0.207,7.238-3.961,7.246-7.267
                                        c-0.361,0-0.725,0.004-1.086-0.002c-0.295-0.004-0.479-0.17-0.477-0.414c0.002-0.246,0.18-0.394,0.484-0.396
                                        C21.934,14.589,22.295,14.591,22.689,14.591z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.691,19.811c-0.106,0.107-0.199,0.25-0.329,0.324
                                        c-0.167,0.098-0.366,0.027-0.438-0.133c-0.199-0.441-0.379-0.896-0.517-1.361c-0.031-0.102,0.118-0.299,0.233-0.393
                                        c0.149-0.121,0.372-0.063,0.444,0.088C4.303,18.797,4.477,19.279,4.691,19.811z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.421,25.07c-0.009,0.352-0.311,0.566-0.554,0.426
                                        c-0.399-0.23-0.783-0.49-1.153-0.766c-0.178-0.133-0.172-0.344-0.04-0.521c0.133-0.178,0.327-0.221,0.515-0.105
                                        c0.364,0.225,0.722,0.463,1.069,0.715C9.349,24.883,9.389,25.02,9.421,25.07z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M23.109,23.914c-0.088,0.143-0.131,0.271-0.219,0.348
                                        c-0.303,0.254-0.617,0.496-0.938,0.727c-0.23,0.166-0.463,0.129-0.602-0.07c-0.133-0.193-0.078-0.428,0.137-0.594
                                        c0.295-0.227,0.576-0.469,0.887-0.672c0.115-0.074,0.309-0.105,0.436-0.063C22.928,23.629,23.004,23.791,23.109,23.914z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.129,25.293c0.027,0.008,0.092,0.023,0.154,0.049
                                        c0.343,0.135,0.686,0.271,1.029,0.408c0.261,0.104,0.366,0.301,0.288,0.533c-0.073,0.219-0.301,0.322-0.557,0.227
                                        c-0.377-0.141-0.751-0.291-1.121-0.451c-0.19-0.082-0.283-0.246-0.234-0.453C9.735,25.406,9.873,25.291,10.129,25.293z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M26.857,17.865c-0.146,0.445-0.277,0.896-0.449,1.332
                                        c-0.076,0.189-0.275,0.24-0.475,0.164c-0.209-0.08-0.305-0.248-0.246-0.461c0.107-0.406,0.232-0.807,0.363-1.205
                                        c0.072-0.219,0.266-0.318,0.48-0.256C26.734,17.496,26.834,17.641,26.857,17.865z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.773,22.135c-0.063,0.133-0.09,0.234-0.15,0.309
                                        c-0.25,0.307-0.504,0.613-0.77,0.906c-0.189,0.209-0.42,0.217-0.602,0.045c-0.172-0.166-0.176-0.383-0.002-0.588
                                        c0.252-0.295,0.508-0.588,0.76-0.881c0.133-0.154,0.311-0.203,0.477-0.109C24.605,21.881,24.68,22.025,24.773,22.135z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.086,24.131c-0.143-0.078-0.26-0.113-0.339-0.189
                                        c-0.279-0.268-0.55-0.545-0.813-0.828c-0.173-0.188-0.166-0.434-0.005-0.588c0.18-0.172,0.399-0.156,0.6,0.047
                                        c0.268,0.268,0.551,0.523,0.79,0.814c0.089,0.109,0.124,0.316,0.088,0.455C7.376,23.955,7.205,24.031,7.086,24.131z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.515,27.098c-0.405-0.078-0.813-0.145-1.216-0.234
                                        c-0.231-0.051-0.341-0.26-0.292-0.486c0.045-0.209,0.251-0.334,0.485-0.293c0.365,0.061,0.731,0.123,1.096,0.184
                                        c0.28,0.047,0.423,0.213,0.4,0.461C13.967,26.959,13.796,27.086,13.515,27.098z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.892,17.467c-0.008,0.176-0.105,0.332-0.329,0.371
                                        c-0.218,0.037-0.404-0.049-0.451-0.268c-0.093-0.434-0.168-0.873-0.215-1.314c-0.022-0.207,0.107-0.368,0.338-0.401
                                        c0.224-0.031,0.399,0.064,0.443,0.278C3.766,16.561,3.819,16.994,3.892,17.467z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M26.039,20.041c-0.045,0.139-0.059,0.215-0.094,0.279
                                        c-0.182,0.342-0.363,0.686-0.559,1.02c-0.141,0.24-0.371,0.301-0.578,0.176c-0.191-0.113-0.244-0.348-0.123-0.576
                                        c0.184-0.34,0.371-0.68,0.559-1.018c0.105-0.191,0.287-0.266,0.471-0.188C25.85,19.793,25.941,19.945,26.039,20.041z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.871,21.926c-0.08,0.088-0.161,0.258-0.283,0.295
                                        c-0.125,0.039-0.354-0.002-0.426-0.094c-0.271-0.352-0.514-0.729-0.734-1.113c-0.102-0.18-0.049-0.383,0.146-0.508
                                        c0.187-0.119,0.406-0.088,0.536,0.102c0.237,0.348,0.46,0.703,0.684,1.059C5.827,21.721,5.833,21.793,5.871,21.926z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.043,25.422c-0.039,0.051-0.102,0.193-0.211,0.254
                                        c-0.361,0.195-0.734,0.371-1.111,0.539c-0.223,0.1-0.439,0.014-0.533-0.184c-0.1-0.211-0.02-0.436,0.207-0.549
                                        c0.354-0.176,0.707-0.352,1.066-0.514C20.76,24.834,21.051,25.023,21.043,25.422z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.803,26.303c-0.012,0.164-0.111,0.305-0.301,0.355
                                        c-0.398,0.107-0.799,0.207-1.201,0.297c-0.205,0.045-0.416-0.102-0.467-0.299c-0.053-0.211,0.07-0.432,0.293-0.492
                                        c0.396-0.105,0.797-0.205,1.199-0.295C18.568,25.814,18.803,26.021,18.803,26.303z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.595,11.904c0-0.566-0.001-1.132,0-1.698
                                        c0.001-0.31,0.141-0.478,0.394-0.483c0.268-0.005,0.415,0.163,0.415,0.487c0.001,1.132,0.003,2.264-0.002,3.396
                                        c0,0.156,0.029,0.252,0.185,0.335c0.462,0.245,0.71,0.771,0.619,1.254c-0.102,0.529-0.494,0.909-1.039,1.007
                                        c-0.463,0.082-0.986-0.178-1.224-0.63c-0.071-0.135-0.148-0.172-0.29-0.17c-0.608,0.006-1.216,0.006-1.824,0
                                        c-0.304-0.002-0.496-0.182-0.478-0.436c0.016-0.229,0.182-0.372,0.454-0.373c0.608-0.004,1.216-0.006,1.824,0.001
                                        c0.151,0.002,0.228-0.046,0.319-0.175c0.131-0.188,0.309-0.353,0.494-0.49c0.108-0.08,0.158-0.143,0.157-0.277
                                        C14.591,13.069,14.595,12.486,14.595,11.904z M15.003,14.593c-0.224-0.002-0.403,0.169-0.409,0.391
                                        c-0.006,0.223,0.194,0.424,0.415,0.418c0.214-0.006,0.398-0.197,0.396-0.412C15.404,14.769,15.228,14.595,15.003,14.593z" />
                                    </g>
                                </svg>
                                <span><?php echo html_escape($this->common->languageTranslator('ltr_set_time_zone')); ?></span>
                            </a>
                        </li> -->
                        <?php if ($_SESSION['super_admin'] == 1) {
                        ?>
                            <li class="has_sub_menu <?php echo (in_array("site-settings", $cur_arr) || in_array("home-page", $cur_arr) || in_array("course-page", $cur_arr) || in_array("about-page", $cur_arr) || in_array("course-manage", $cur_arr) || in_array("contact-page", $cur_arr) || in_array("facility-manage", $cur_arr)  || in_array("privacy-policy", $cur_arr) || in_array("terms-conditions", $cur_arr)) ? 'active' : ''; ?>"><a href="javascript:void(0);">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.631,6.982c0,5.065,0,10.13,0,15.195
                                    c-0.242,0.703-0.736,0.959-1.471,0.954c-2.678-0.023-5.355-0.011-8.033-0.011c-0.096,0-0.191,0-0.299,0c0,0.587,0,1.141,0,1.722
                                    c0.1,0,0.188,0,0.277,0c0.83,0,1.658-0.002,2.488,0c0.383,0,0.492,0.11,0.494,0.5c0.002,0.368,0,0.735,0,1.104
                                    c0.297,0.076,0.67-0.107,0.805,0.299c0.072,0.217-0.072,0.351-0.232,0.465c-4.441,0-8.881,0-13.321,0
                                    c-0.16-0.114-0.304-0.248-0.232-0.465c0.135-0.405,0.509-0.223,0.804-0.299c0-0.369-0.001-0.736,0-1.104
                                    c0.002-0.391,0.112-0.499,0.495-0.5c0.641-0.002,1.281,0,1.922,0c0.277,0,0.554,0,0.835,0c0-0.588,0-1.147,0-1.722
                                    c-0.12,0-0.218,0-0.315,0c-2.702,0-5.404,0.001-8.107-0.001c-0.163,0-0.33-0.004-0.487-0.041c-0.48-0.111-0.725-0.468-0.884-0.901
                                    c0-5.065,0-10.13,0-15.195c0.266-0.734,0.813-0.954,1.56-0.941C5.571,6.069,7.213,6.05,8.856,6.05c0.088,0,0.177,0,0.212,0
                                    C9.156,5.881,9.196,5.73,9.292,5.633c0.543-0.56,1.1-1.107,1.652-1.658c0.169-0.168,0.352-0.194,0.55-0.046
                                    c0.145,0.107,0.286,0.225,0.445,0.307c0.084,0.044,0.214,0.057,0.303,0.025c0.262-0.093,0.506-0.238,0.771-0.315
                                    c0.214-0.063,0.292-0.165,0.325-0.384c0.041-0.278,0-0.611,0.331-0.772c0.888,0,1.776,0,2.665,0c0.23,0.113,0.289,0.325,0.295,0.554
                                    c0.01,0.354,0.135,0.606,0.523,0.66c0.08,0.011,0.164,0.041,0.229,0.089c0.395,0.293,0.727,0.199,1.074-0.11
                                    c0.25-0.224,0.398-0.19,0.637,0.047c0.508,0.504,1.018,1.005,1.518,1.519c0.127,0.133,0.217,0.307,0.352,0.503
                                    c0.023,0,0.113,0,0.203,0c1.736,0,3.469-0.001,5.203,0.001c0.6,0,1.008,0.292,1.215,0.855C27.592,6.935,27.613,6.957,27.631,6.982z
                                     M25.643,17.882c0-2.618,0-5.212,0-7.807c-1.252,0-2.488,0-3.738,0c0,0.257,0.002,0.495,0,0.733
                                    c-0.002,0.325-0.092,0.48-0.418,0.489c-0.488,0.014-0.684,0.255-0.873,0.688c-0.209,0.476-0.254,0.831,0.131,1.211
                                    c0.168,0.167,0.133,0.375-0.039,0.548c-0.553,0.551-1.104,1.104-1.658,1.654c-0.195,0.193-0.361,0.229-0.563,0.041
                                    c-0.369-0.345-0.693-0.35-1.17-0.147c-0.465,0.195-0.719,0.406-0.738,0.916c-0.012,0.297-0.156,0.389-0.457,0.391
                                    c-0.757,0.002-1.513,0.002-2.27,0c-0.298-0.002-0.426-0.122-0.475-0.42c-0.028-0.18-0.053-0.358-0.095-0.533
                                    c-0.014-0.058-0.069-0.127-0.124-0.149c-0.361-0.152-0.728-0.294-1.107-0.444c-0.001,0.002-0.024,0.012-0.044,0.025
                                    c-0.154,0.109-0.308,0.219-0.462,0.328c-0.267,0.187-0.419,0.179-0.647-0.049c-0.525-0.521-1.048-1.044-1.571-1.568
                                    c-0.252-0.254-0.283-0.391-0.048-0.656c0.306-0.345,0.418-0.679,0.111-1.073c-0.009-0.012-0.014-0.029-0.017-0.045
                                    c-0.08-0.498-0.374-0.712-0.876-0.736c-0.335-0.017-0.404-0.145-0.405-0.49c0-0.235,0-0.471,0-0.71c-1.268,0-2.502,0-3.732,0
                                    c0,2.614,0,5.207,0,7.805C11.46,17.882,18.543,17.882,25.643,17.882z M3.111,19.871c0,0.717-0.012,1.421,0.013,2.125
                                    c0.005,0.121,0.149,0.271,0.268,0.345c0.098,0.062,0.253,0.041,0.384,0.041c7.481,0.001,14.962,0.001,22.445,0.001
                                    c0.057,0,0.115,0.001,0.172,0c0.334-0.01,0.496-0.171,0.498-0.507c0.002-0.542,0-1.086,0-1.628c0-0.127,0-0.254,0-0.377
                                    C18.945,19.871,11.039,19.871,3.111,19.871z M19.982,13.394c-0.094-0.134-0.18-0.275-0.285-0.399
                                    c-0.186-0.217-0.193-0.421-0.047-0.672c0.158-0.275,0.332-0.566,0.389-0.871c0.102-0.57,0.418-0.814,0.967-0.814
                                    c0.135-0.001,0.162-0.069,0.162-0.188c-0.006-0.362-0.004-0.724-0.004-1.085c0-0.564,0.002-0.568-0.553-0.663
                                    c-0.244-0.042-0.371-0.166-0.453-0.412c-0.145-0.434-0.328-0.855-0.527-1.267c-0.104-0.214-0.109-0.382,0.033-0.566
                                    c0.119-0.151,0.225-0.314,0.322-0.453c-0.443-0.442-0.861-0.86-1.293-1.291c-0.154,0.108-0.322,0.223-0.486,0.344
                                    c-0.164,0.122-0.318,0.111-0.504,0.027c-0.445-0.202-0.9-0.388-1.357-0.563c-0.18-0.068-0.295-0.162-0.324-0.357
                                    c-0.031-0.209-0.075-0.415-0.113-0.62c-0.617,0-1.214,0-1.82,0c-0.038,0.212-0.08,0.411-0.109,0.613
                                    c-0.029,0.205-0.153,0.298-0.341,0.368c-0.444,0.165-0.886,0.343-1.314,0.544c-0.203,0.096-0.364,0.111-0.544-0.026
                                    c-0.16-0.124-0.33-0.232-0.446-0.313c-0.448,0.448-0.869,0.87-1.3,1.301c0.102,0.146,0.25,0.309,0.337,0.498
                                    c0.057,0.124,0.068,0.305,0.021,0.431c-0.174,0.475-0.385,0.937-0.573,1.407c-0.067,0.167-0.166,0.273-0.351,0.3
                                    C9.259,8.693,9.052,8.738,8.854,8.773c-0.011,0.034-0.02,0.049-0.02,0.064C8.831,9.225,8.83,9.61,8.829,9.997
                                    c0,0.592,0,0.593,0.579,0.692c0.202,0.034,0.336,0.125,0.415,0.331c0.175,0.467,0.368,0.927,0.57,1.382
                                    c0.076,0.169,0.081,0.312-0.025,0.461c-0.101,0.14-0.209,0.275-0.298,0.423c-0.029,0.047-0.035,0.152-0.004,0.185
                                    c0.397,0.41,0.804,0.812,1.209,1.218c0.184-0.131,0.346-0.242,0.504-0.359c0.163-0.124,0.322-0.115,0.505-0.035
                                    c0.456,0.202,0.916,0.395,1.38,0.576c0.17,0.066,0.274,0.164,0.303,0.346c0.032,0.21,0.074,0.418,0.115,0.646
                                    c0.419,0,0.83,0,1.239,0c0.578,0,0.579,0.001,0.671-0.576c0.035-0.225,0.148-0.351,0.375-0.428c0.441-0.151,0.871-0.334,1.293-0.532
                                    c0.209-0.099,0.379-0.119,0.566,0.029c0.152,0.121,0.318,0.226,0.465,0.331C19.125,14.249,19.543,13.831,19.982,13.394z
                                     M20.377,6.789c0.195,0.491,0.195,0.491,0.67,0.491c1.604,0,3.207,0,4.809,0c0.447,0,0.543,0.099,0.543,0.553
                                    c0.002,3.412,0.002,6.823,0,10.236c0,0.478-0.082,0.561-0.555,0.561c-7.227,0-14.454,0-21.681,0c-0.478,0-0.563-0.083-0.563-0.554
                                    c0-3.411,0-6.823,0-10.236c0-0.467,0.093-0.56,0.56-0.56c1.678,0,3.355,0.001,5.032-0.004c0.083,0,0.198-0.03,0.245-0.09
                                    C9.52,7.082,9.56,6.945,9.634,6.789c-0.111,0-0.191,0-0.27,0c-1.875,0-3.75,0-5.625,0c-0.491,0-0.631,0.141-0.631,0.629
                                    c0,3.807,0,7.612,0,11.419c0,0.089,0,0.176,0,0.268c7.941,0,15.854,0,23.782,0c0-0.098,0-0.179,0-0.259c0-3.815,0-7.631,0-11.445
                                    c0-0.468-0.148-0.611-0.625-0.611c-1.873,0-3.748,0-5.623,0C20.561,6.789,20.482,6.789,20.377,6.789z M20.336,25.6
                                    c-3.568,0-7.12,0-10.672,0c0,0.295,0,0.572,0,0.854c3.566,0,7.117,0,10.672,0C20.336,26.156,20.336,25.881,20.336,25.6z
                                     M17.063,23.14c-1.39,0-2.756,0-4.125,0c0,0.571,0,1.126,0,1.69c1.38,0,2.746,0,4.125,0C17.063,24.265,17.063,23.711,17.063,23.14z
                                     M25.646,8.032c-1.465,0-2.908,0-4.354,0c0.037,0.032,0.074,0.034,0.113,0.042c0.43,0.076,0.498,0.16,0.498,0.604
                                    c0,0.209,0,0.418,0,0.627c1.27,0,2.498,0,3.742,0C25.646,8.878,25.646,8.463,25.646,8.032z M8.638,8.051
                                    C8.636,8.044,8.634,8.038,8.631,8.032c-1.424,0-2.848,0-4.279,0c0,0.429,0,0.844,0,1.268c1.247,0,2.479,0,3.738,0
                                    c0-0.285,0-0.553,0-0.822c0-0.199,0.095-0.325,0.289-0.372C8.465,8.085,8.551,8.068,8.638,8.051z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.019,5.65c2.233,0.004,4.032,1.825,4.026,4.079
                                    c-0.006,2.198-1.838,4.012-4.052,4.01c-2.232-0.002-4.042-1.828-4.039-4.072C10.958,7.449,12.781,5.647,15.019,5.65z M18.307,9.711
                                    c0.002-1.819-1.467-3.316-3.263-3.322c-1.853-0.005-3.348,1.46-3.351,3.284c-0.002,1.829,1.473,3.321,3.288,3.327
                                    C16.807,13.006,18.303,11.524,18.307,9.711z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.615,8.312c0.139,0,0.28-0.008,0.418,0.001
                                    C6.232,8.325,6.35,8.438,6.367,8.637C6.386,8.835,6.294,9,6.1,9.016C5.768,9.043,5.43,9.043,5.098,9.015
                                    C4.903,8.997,4.814,8.83,4.833,8.633c0.02-0.198,0.139-0.311,0.338-0.32C5.319,8.305,5.467,8.311,5.615,8.312z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.022,7.28c1.319,0.005,2.399,1.105,2.394,2.434
                                    c-0.008,1.305-1.105,2.395-2.414,2.395c-1.33,0-2.425-1.105-2.417-2.439C12.592,8.351,13.689,7.274,15.022,7.28z M13.384,10.065
                                    c0.177,0.79,0.917,1.349,1.687,1.303c0.762-0.047,1.45-0.629,1.53-1.303C15.534,10.065,14.468,10.065,13.384,10.065z M13.387,9.296
                                    c1.083,0,2.152,0,3.227,0c-0.189-0.757-0.847-1.273-1.601-1.277C14.243,8.015,13.58,8.528,13.387,9.296z" />
                                        <circle fill-rule="evenodd" clip-rule="evenodd" cx="15.344" cy="21.088" r="0.973" />
                                        <circle fill-rule="evenodd" clip-rule="evenodd" cx="15.344" cy="21.087" r="0.317" />
                                    </svg>
                                    <span><?php echo html_escape($this->common->languageTranslator('ltr_frontend_settings')); ?></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php echo (in_array("site-settings", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/site-settings"><?php echo html_escape($this->common->languageTranslator('ltr_site_settings')); ?></a></li>
                                    <li <?php echo (in_array("home-page", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/home-page"><?php echo html_escape($this->common->languageTranslator('ltr_home_page')); ?></a></li>
                                    <li <?php echo (in_array("about-page", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/about-page"><?php echo html_escape($this->common->languageTranslator('ltr_about_page')); ?></a></li>
                                    <li <?php echo (in_array("course-page", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/course-page"><?php echo html_escape($this->common->languageTranslator('ltr_course_page')); ?></a></li>
                                    <!-- <li <?php echo (in_array("course-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/course-manage"><?php echo html_escape($this->common->languageTranslator('ltr_course_manager')); ?></a></li> -->
                                    <li <?php echo (in_array("blog-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/blog-manage"><?php echo html_escape($this->common->languageTranslator('ltr_blog_manager')); ?></a></li>
                                    <li <?php echo (in_array("facility-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/facility-manage"><?php echo html_escape($this->common->languageTranslator('ltr_facility_manager')); ?></a></li>

                                    <li <?php echo (in_array("contact-page", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/contact-page"><?php echo html_escape($this->common->languageTranslator('ltr_contact_page')); ?></a></li>
                                    <li <?php echo (in_array("privacy-policy", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/privacy-policy"><?php echo html_escape($this->common->languageTranslator('ltr_privacy_policy')); ?></a></li>
                                    <li <?php echo (in_array("terms-conditions", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/terms-conditions"><?php echo html_escape($this->common->languageTranslator('ltr_terms_conditions')); ?></a></li>
                                </ul>
                            </li>
                            <!-- <li class="has_sub_menu <?php echo (in_array("general-settings", $cur_arr)) ? 'active' : ''; ?>"><a href="javascript:void(0);">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="28px" height="28px">
                                        <g>
                                            <g>
                                                <path d="M509.952,223.895c-1.685-12.864-8.96-24.021-19.989-30.677c-10.859-6.549-23.872-7.723-36.011-3.2c-9.813,3.712-21.077-1.387-25.6-11.499c-5.205-11.605-11.584-22.72-19.008-33.045c-6.613-9.173-5.376-21.205,2.859-27.989c9.813-8.064,15.296-19.989,15.04-32.683c-0.256-12.907-6.357-24.789-16.683-32.64c-17.024-12.907-35.584-23.616-55.189-31.872c-12.053-5.077-25.429-4.373-36.736,1.856c-11.115,6.144-18.667,16.811-20.757,29.333c-1.771,10.56-11.541,17.621-22.933,16.448c-12.459-1.323-25.429-1.323-37.867,0c-11.285,1.195-21.163-5.888-22.933-16.448c-2.091-12.523-9.643-23.211-20.757-29.333c-11.328-6.251-24.725-6.933-36.736-1.856c-19.627,8.256-38.187,18.965-55.211,31.872C91.115,60.012,85.035,71.895,84.779,84.78c-0.256,12.715,5.227,24.619,15.061,32.747c8.213,6.763,9.451,18.795,2.859,27.968c-7.445,10.325-13.824,21.44-19.029,33.045c-4.501,10.133-15.787,15.211-25.835,11.413c-11.861-4.416-24.896-3.243-35.776,3.285c-11.051,6.635-18.325,17.813-19.989,30.677C0.704,234.497,0,245.313,0,256.001c0,10.688,0.704,21.504,2.048,32.107c1.685,12.864,8.96,24.021,19.989,30.677c10.859,6.528,23.851,7.723,36.011,3.2c9.792-3.733,21.056,1.365,25.6,11.499c5.205,11.605,11.584,22.72,19.008,33.045c6.613,9.173,5.376,21.205-2.859,27.989c-9.813,8.064-15.296,19.989-15.04,32.683c0.256,12.907,6.357,24.789,16.683,32.64c17.024,12.907,35.584,23.616,55.189,31.872c12.053,5.077,25.408,4.373,36.736-1.856c11.115-6.144,18.667-16.811,20.757-29.333c1.771-10.56,11.627-17.621,22.933-16.448c12.437,1.323,25.408,1.323,37.867,0c11.413-1.131,21.163,5.888,22.933,16.448c2.091,12.523,9.643,23.211,20.757,29.333c6.315,3.477,13.227,5.227,20.224,5.227c5.589,0,11.179-1.131,16.491-3.371c19.605-8.256,38.165-18.987,55.189-31.872c10.347-7.829,16.427-19.733,16.683-32.619c0.256-12.715-5.227-24.64-15.04-32.725c-8.213-6.763-9.451-18.795-2.859-27.968c7.445-10.325,13.824-21.44,19.029-33.045c4.523-10.133,15.829-15.189,25.6-11.499l0.235,0.085c11.904,4.459,24.917,3.243,35.776-3.285c11.051-6.656,18.325-17.813,19.989-30.699c1.365-10.688,2.069-21.461,2.069-32.085C512,245.377,511.296,234.604,509.952,223.895z M488.768,285.377c-0.811,6.336-4.395,11.861-9.813,15.125c-5.227,3.179-11.541,3.733-17.515,1.493l-0.128-0.043c-20.352-7.531-43.328,2.475-52.437,22.827c-4.608,10.283-10.283,20.16-16.875,29.312c-13.248,18.432-10.389,42.901,6.635,56.896c4.736,3.904,7.381,9.664,7.253,15.808c-0.128,6.336-3.115,12.181-8.235,16.064c-15.573,11.819-32.597,21.653-50.581,29.205c-5.952,2.517-12.608,2.176-18.155-0.875c-5.355-2.965-9.003-8.107-10.005-14.144c-3.392-20.288-20.757-34.411-41.387-34.411c-1.579,0-3.2,0.064-4.821,0.192c-10.987,1.152-22.421,1.152-33.408,0c-22.699-2.581-42.56,12.309-46.208,34.155c-1.003,6.037-4.651,11.2-10.005,14.144c-5.568,3.072-12.203,3.392-18.176,0.875c-17.984-7.573-35.008-17.387-50.581-29.205c-5.12-3.861-8.107-9.728-8.235-16.043c-0.128-6.144,2.517-11.904,7.275-15.808c17.024-13.995,19.861-38.464,6.613-56.896c-6.592-9.173-12.245-19.029-16.853-29.312c-9.131-20.395-32.192-30.357-52.821-22.677c-5.696,2.133-12.032,1.6-17.259-1.579c-5.419-3.243-9.003-8.768-9.813-15.125c-1.259-9.685-1.899-19.584-1.899-29.355c0-9.771,0.64-19.669,1.92-29.376c0.811-6.336,4.395-11.861,9.813-15.125c5.205-3.157,11.541-3.733,17.493-1.493c20.373,7.595,43.435-2.368,52.565-22.784c4.608-10.283,10.283-20.139,16.875-29.291c13.248-18.432,10.389-42.901-6.635-56.896c-4.736-3.904-7.381-9.664-7.253-15.808c0.128-6.336,3.115-12.181,8.235-16.064c15.573-11.819,32.597-21.632,50.581-29.205c5.952-2.517,12.587-2.197,18.155,0.875c5.355,2.944,9.003,8.107,10.005,14.165c3.648,21.845,23.509,36.587,46.208,34.155c10.965-1.152,22.4-1.152,33.408,0c22.571,2.411,42.56-12.309,46.208-34.155c1.003-6.037,4.651-11.2,10.005-14.144c5.568-3.093,12.181-3.413,18.176-0.875c17.984,7.573,35.008,17.387,50.581,29.205c5.12,3.861,8.107,9.728,8.235,16.043c0.128,6.144-2.517,11.904-7.275,15.808c-17.024,13.995-19.861,38.464-6.613,56.896c6.592,9.173,12.245,19.029,16.853,29.312c9.131,20.395,32.213,30.379,52.821,22.677c5.717-2.155,12.011-1.579,17.259,1.579c5.419,3.264,9.003,8.789,9.813,15.125c1.259,9.792,1.899,19.669,1.899,29.376C490.667,265.708,490.027,275.585,488.768,285.377z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M256,149.335c-58.816,0-106.667,47.851-106.667,106.667S197.184,362.668,256,362.668s106.667-47.851,106.667-106.667S314.816,149.335,256,149.335z M256,341.335c-47.061,0-85.333-38.272-85.333-85.333s38.272-85.333,85.333-85.333s85.333,38.272,85.333,85.333S303.061,341.335,256,341.335z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span><?php echo html_escape($this->common->languageTranslator('ltr_general_settings')); ?></span>
                                </a>
                                <ul class="sub-menu"> -->
                                    <!-- General Settings -->
                                    <!-- <li <?php /*echo (in_array("language-settings", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/language-settings"><?php echo html_escape($this->common->languageTranslator('ltr_language_settings')); ?></a></li>
                                    <li <?php echo (in_array("email-settings", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/email-settings"><?php echo html_escape($this->common->languageTranslator('ltr_email_settings'));*/ ?></a></li> -->
                                <!-- </ul>
                            </li> -->
                        <?php
                        } ?>
                        <?php
                        // print_r($_SESSION);
                        if ($this->session->userdata('super_admin') == 1 && $this->session->userdata('role') == 1) {
                        ?>
                            <!-- <li <?php echo in_array("certificate", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>admin/certificate">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 480 480" style="enable-background:new 0 0 480 480;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M448,24H80c-17.673,0-32,14.327-32,32v256H8c-4.418,0-8,3.582-8,8c0,17.673,14.327,32,32,32h232v96    c0.001,4.418,3.583,7.999,8.002,7.998c2.121,0,4.154-0.843,5.654-2.342L320,411.312l42.344,42.344 c1.5,1.5,3.534,2.344,5.656,2.344c1.052,0.003,2.093-0.203,3.064-0.608c2.989-1.239,4.937-4.157,4.936-7.392v-96h24 c17.673,0,32-14.327,32-32V64h40c4.418,0,8-3.582,8-8C480,38.327,465.673,24,448,24z M416,56v256h-32v16h29.848 c-2.857,4.948-8.135,7.997-13.848,8h-24v-8h-16v100.688l-34.344-34.344c-3.124-3.123-8.188-3.123-11.312,0L280,428.688V328h-16v8 H32c-5.713-0.003-10.991-3.052-13.848-8H56h200v-16H64V56c0-8.837,7.163-16,16-16h340.448C417.569,44.843,416.033,50.366,416,56z M434.152,48c4.426-7.648,14.214-10.26,21.863-5.833c2.421,1.401,4.432,3.413,5.833,5.833H434.152z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M395.416,274.36L385.168,256l10.288-18.344c2.168-3.85,0.805-8.728-3.044-10.896c-0.194-0.109-0.393-0.211-0.596-0.304 l-19.096-8.744l-2.464-20.88c-0.521-4.387-4.501-7.521-8.888-7c-0.204,0.024-0.407,0.056-0.608,0.096l-20.624,4.088 l-14.264-15.448c-3.193-3.243-8.41-3.284-11.653-0.091c-0.031,0.03-0.061,0.061-0.091,0.091l-14.264,15.448l-20.624-4.088   c-4.334-0.857-8.543,1.962-9.4,6.296c-0.04,0.201-0.072,0.404-0.096,0.608l-2.464,20.88l-19.096,8.76   c-4.017,1.839-5.783,6.587-3.944,10.604c0.093,0.203,0.194,0.402,0.304,0.596L254.832,256l-10.288,18.344   c-2.168,3.85-0.805,8.728,3.044,10.896c0.194,0.109,0.393,0.211,0.596,0.304l19.096,8.76l2.464,20.896 c0.521,4.387,4.501,7.521,8.888,7c0.204-0.024,0.407-0.056,0.608-0.096l20.624-4.088l14.264,15.448  c3.001,3.243,8.062,3.439,11.305,0.439c0.152-0.141,0.298-0.287,0.439-0.439l14.264-15.448l20.624,4.088    c2.186,0.447,4.459-0.053,6.256-1.376c1.788-1.318,2.947-3.321,3.2-5.528l2.464-20.88l19.096-8.76  c4.017-1.839,5.783-6.587,3.944-10.604C395.627,274.753,395.525,274.554,395.416,274.36z M369.024,259.904l8.232,14.688 l-15.296,7.016c-2.536,1.164-4.282,3.565-4.608,6.336l-1.968,16.744l-16.536-3.272c-2.725-0.566-5.546,0.346-7.424,2.4L320,316.2 l-11.424-12.368c-1.514-1.637-3.642-2.568-5.872-2.568c-0.522-0.003-1.042,0.051-1.552,0.16l-16.536,3.272l-1.968-16.744 c-0.326-2.771-2.072-5.172-4.608-6.336l-15.296-7.016l8.232-14.688c1.376-2.44,1.409-5.403,0-7.824v0.032l-8.232-14.688   l15.296-7.016c2.536-1.164,4.282-3.565,4.608-6.336l1.968-16.744l16.536,3.272c2.724,0.559,5.542-0.352,7.424-2.4L320,195.8 l11.424,12.368c1.877,2.055,4.699,2.967,7.424,2.4l16.536-3.272l1.968,16.744c0.326,2.771,2.072,5.172,4.608,6.336l15.296,7.016
                                    l-8.232,14.688C367.662,254.51,367.662,257.474,369.024,259.904z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M320,216c-22.091,0-40,17.909-40,40c0.026,22.08,17.92,39.973,40,40c22.091,0,40-17.909,40-40
                                    C360,233.909,342.091,216,320,216z M320,280c-13.255,0-24-10.745-24-24c0-13.255,10.745-24,24-24s24,10.745,24,24
                                    C344,269.255,333.255,280,320,280z" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="176" y="72" width="128" height="16" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="96" y="120" width="288" height="16" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="96" y="152" width="288" height="16" />
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <rect x="104" y="256" width="104" height="16" />
                                            </g>
                                        </g>
                                    </svg>
                                    <span><?php echo html_escape($this->common->languageTranslator('ltr_certificate')); ?></span>
                                </a></li> -->
                            <?php
                        }

                        if (isset($access->enquiry) || $this->session->userdata['super_admin'] == 1) {
                            if ($access->enquiry == '1' || $this->session->userdata['super_admin'] == 1) {  ?>
                                <!-- Enquiry -->
                        <?php }
                        } ?>

                        <!-- End of Navbar -->

                    </ul>
                </div>
            </div>
        </header>
    </div>
    <div class="edu_admin_header edu_top_header">
        <div class="edu_header_left">
            <div class="edu_header_close">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="edu_page_title">
                <p><?php if (isset($title) && !empty($title)) {
                        echo html_escape($title);
                    } ?></p>
            </div>

        </div>

        <div class="edu_admin_header_info">
            <div class="edu_responsive_search">
                <a href="javascript:void(0);" class="edu_srch_btn">
                    <i class="icofont-search"></i>
                </a>
            </div>

            <div class="edu_admin">
                <div class="edu_admin_inner">
                    <?php if ($this->session->userdata('role') == '1') {  ?>
                        <a class="edu_admin_bar" href="javascript:void(0);"> <span class="icofont-user-alt-4"></span><?php echo (isset($this->session->userdata['name'])) ? $this->session->userdata['name'] : ''; ?>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;" xml:space="preserve">
                                <g>
                                    <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751
                                    c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0
                                    c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z" />
                                </g>
                            </svg>
                        </a>
                    <?php } ?>
                    <div class="edu_admin_option">
                        <?php if ($this->session->userdata('role') == '1') {  ?>
                            <a href="<?php echo base_url(); ?>admin/change-password"><i class="icofont-user"></i><?php echo html_escape($this->common->languageTranslator('ltr_change_password')); ?></a>
                        <?php } ?>
                        <a href="javascript:void(0);" title="Logout" class="cnfmlogOutBtn"><i class="icofont-logout"></i><span><?php echo html_escape($this->common->languageTranslator('ltr_logout')); ?></span></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">