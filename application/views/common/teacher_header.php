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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/toastr.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/timepicker/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/magnific-popup.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/icofont.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/font.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/select2.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/summernote.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/backend.css?' . date('his') . '=' . date('his'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/backend-rtl.css?' . time(); ?>" />
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
        var ltr_add_book = "<?php echo html_escape($this->common->languageTranslator('ltr_add_book')); ?>";
        var ltr_edit_book = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_book')); ?>";
        var ltr_add_notes = "<?php echo html_escape($this->common->languageTranslator('ltr_add_notes')); ?>";
        var ltr_edit_notes = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_notes')); ?>";
        var ltr_add = "<?php echo html_escape($this->common->languageTranslator('ltr_add')); ?>";
        var ltr_edit = "<?php echo html_escape($this->common->languageTranslator('ltr_edit')); ?>";
        var ltr_add_old_paper = "<?php echo html_escape($this->common->languageTranslator('ltr_add_old_paper')); ?>";
        var ltr_edit_old_paper = "<?php echo html_escape($this->common->languageTranslator('ltr_edit_old_paper')); ?>";
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

    $cur_arr = explode('/', $_SERVER['REQUEST_URI']);

    $timezoneDB = $this->db_model->select_data('timezone', 'site_details', array('id' => 1));

    if (isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])) {
        date_default_timezone_set($timezoneDB[0]['timezone']);
    }

    $admin_id = $this->session->userdata('admin_id');
    $teacher_id = $this->session->userdata('uid');
    $condN = "admin_id = $admin_id AND teacher_id = $teacher_id AND status = 1 AND read_status = 0";
    $notice_count = $this->db_model->countAll('notices use index(id)', $condN);


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
    if (isset($lastrecord['access']))
        $access = json_decode($lastrecord['access']);

    ?>
    <div class="edu_header_sidebar">
        <header class="edu_left_header">
            <div class="edu_admin_header_left">
                <div class="edu_admin_logo">
                    <a href="<?php echo base_url('teacher/dashboard') ?>"><img src="<?php if (!empty($logo['teach_image'])) {
                                                                                        echo base_url('uploads/admin/' . $logo['teach_image']);
                                                                                    } else {
                                                                                        echo html_escape($this->common->siteLogo);
                                                                                    } ?>" class="logoRelativeCls main_logo" alt="Logo"></a>
                    <a href="#"><img src="<?= base_url() ?>assets/images/mini_logo.png" class="mini_logo" alt="Minilogo"></a>
                    <div class="edu_header_close responsive_btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="edu_admin_header_right">
                <div class="edu_admin_menu">
                    <ul>
                        <li <?php echo in_array("dashboard", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/dashboard">
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
                                <span><?php echo html_escape($this->common->languageTranslator('ltr_dashboard')); ?> </span>
                            </a></li>
                        <?php
                        if (isset($access->assignment)) {
                            if ($access->assignment == '1') { ?>
                                <li <?php echo in_array("homework-manage", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/homework-manage">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M509.071,86.613l-39.176-39.176c-3.904-3.905-10.236-3.903-14.142,0l-26.085,26.085c-1.318-3.99-5.08-6.875-9.508-6.875
                                        H279.817c-19.155,0-36.105,9.62-46.273,24.283c-10.168-14.663-27.118-24.283-46.273-24.283H46.917
                                        c-5.523,0-10.012,4.489-10.012,10.012v16.697H10c-5.523,0-10,4.478-10,10v354.135c0,5.522,4.477,10,10,10h447.076
                                        c5.523,0,10-4.478,10-10V142.752l41.996-41.996C512.977,96.85,512.976,90.518,509.071,86.613z M223.538,447.491H20V113.356h16.905
                                        v292.909c0,5.522,4.477,10,10,10h176.633V447.491z M223.538,396.265H56.905v-28.357h130.366c13.677,0,26.413,4.944,36.267,14
                                        V396.265z M187.271,347.907H56.905V86.647h130.366c20.002,0,36.273,16.272,36.273,36.273v167.481c0,5.522,4.477,10,10,10
                                        s10-4.478,10-10v-167.48c0-20.001,16.272-36.273,36.273-36.273H410.17v6.371L297.345,205.844c-1.367,1.367-2.309,3.102-2.71,4.993
                                        l-10.568,49.744c-0.704,3.312,0.316,6.755,2.71,9.149c1.895,1.895,5.723,3.269,9.149,2.71l49.744-10.567
                                        c1.891-0.401,3.625-1.343,4.993-2.71l59.507-59.507v148.251H279.817c-16.901,0-33.297,5.837-46.273,16.26
                                        C220.567,353.743,204.172,347.907,187.271,347.907z M313.586,220.054c4.063,4.063,9.122,6.848,14.753,8.198
                                        c1.239,5.485,4.009,10.563,8.115,14.67c0.129,0.128,0.258,0.256,0.389,0.382l-30.014,6.376l6.376-30.014
                                        C313.331,219.796,313.457,219.926,313.586,220.054z M410.171,367.908v28.357H243.538v-14.346
                                        c9.856-9.063,22.597-14.011,36.28-14.011H410.171z M447.076,447.491H243.538v-31.226h176.633c5.523,0,10-4.478,10-10V179.997
                                        c0-0.112-0.003-0.223-0.006-0.334l16.911-16.911V447.491z M351.76,229.783c-0.409-0.303-0.797-0.638-1.163-1.003
                                        c-2.228-2.229-3.293-5.306-2.92-8.443c0.347-2.923-0.611-5.85-2.619-8.002c-1.896-2.032-4.546-3.178-7.311-3.178
                                        c-0.163,0-0.326,0.004-0.49,0.012c-2.729,0.143-6.595-0.323-9.529-3.258c-0.365-0.365-0.7-0.754-1.002-1.162L431.883,99.592
                                        l25.034,25.034L351.76,229.783z M471.059,110.483l-25.034-25.034l16.799-16.799l25.034,25.034L471.059,110.483z"></path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path d="M243.35,327.121c-0.13-0.641-0.32-1.271-0.57-1.88c-0.25-0.601-0.56-1.181-0.92-1.721c-0.37-0.55-0.78-1.06-1.24-1.52
                                        c-0.47-0.46-0.98-0.88-1.52-1.25c-0.55-0.36-1.13-0.66-1.73-0.91c-0.6-0.25-1.23-0.45-1.87-0.57c-1.29-0.26-2.62-0.26-3.91,0
                                        c-0.64,0.12-1.27,0.32-1.87,0.57c-0.6,0.25-1.18,0.55-1.73,0.91c-0.54,0.37-1.06,0.79-1.52,1.25c-0.46,0.46-0.88,0.97-1.24,1.52
                                        c-0.361,0.54-0.67,1.12-0.92,1.721c-0.25,0.609-0.44,1.239-0.57,1.88c-0.13,0.64-0.2,1.3-0.2,1.949c0,0.65,0.07,1.31,0.2,1.95
                                        c0.129,0.641,0.32,1.27,0.57,1.87c0.25,0.61,0.56,1.19,0.92,1.73c0.36,0.55,0.78,1.06,1.24,1.52c0.46,0.46,0.98,0.88,1.52,1.24
                                        c0.55,0.36,1.13,0.67,1.73,0.92c0.6,0.25,1.23,0.44,1.87,0.57c0.65,0.13,1.3,0.199,1.95,0.199c0.66,0,1.31-0.069,1.96-0.199
                                        c0.64-0.13,1.27-0.32,1.87-0.57c0.6-0.25,1.18-0.56,1.73-0.92c0.54-0.36,1.05-0.78,1.52-1.24c1.86-1.86,2.93-4.439,2.93-7.07
                                        C243.55,328.421,243.48,327.761,243.35,327.121z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_assignment_manager')); ?></span>
                                    </a></li>
                            <?php }
                        }
                        if (isset($access->live_class)) {
                            if ($access->live_class == '1') { ?>
                                <!--<li <?php echo in_array("live-class", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/live-class">-->
                                <!--        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">-->
                                <!--            <g>-->
                                <!--                <path d="M472,72H376V40a8,8,0,0,0-11.97-6.95L320,58.21V40a8,8,0,0,0-8-8H144a8,8,0,0,0-8,8V72H40A32.036,32.036,0,0,0,8,104V376a32.036,32.036,0,0,0,32,32H204.9l-10.67,32H168a8,8,0,0,0-8,8v24a8,8,0,0,0,8,8H344a8,8,0,0,0,8-8V448a8,8,0,0,0-8-8H317.77L307.1,408H472a32.042,32.042,0,0,0,32-32V104A32.042,32.042,0,0,0,472,72ZM320,76.64l40-22.85V154.21l-40-22.85ZM152,48H304V160H152ZM336,456v8H176v-8ZM211.1,440l10.67-32h68.46l10.67,32ZM488,376a16.021,16.021,0,0,1-16,16H40a16.021,16.021,0,0,1-16-16V360H488Zm0-32H24V104A16.021,16.021,0,0,1,40,88h96v80a8,8,0,0,0,8,8H312a8,8,0,0,0,8-8V149.79l44.03,25.16A8,8,0,0,0,376,168V88h96a16.021,16.021,0,0,1,16,16Z" />-->
                                <!--                <path d="M96,368H48a8,8,0,0,0,0,16H96a8,8,0,0,0,0-16Z" />-->
                                <!--                <path d="M128,368h-8a8,8,0,0,0,0,16h8a8,8,0,0,0,0-16Z" />-->
                                <!--                <path d="M160,312H352a32.036,32.036,0,0,0,32-32V224a32.036,32.036,0,0,0-32-32H160a32.036,32.036,0,0,0-32,32v56A32.036,32.036,0,0,0,160,312Zm-16-88a16.019,16.019,0,0,1,16-16H352a16.019,16.019,0,0,1,16,16v56a16.019,16.019,0,0,1-16,16H160a16.019,16.019,0,0,1-16-16Z" />-->
                                <!--                <path d="M168,288h32a8,8,0,0,0,0-16H176V224a8,8,0,0,0-16,0v56A8,8,0,0,0,168,288Z" />-->
                                <!--                <path d="M224,288a8,8,0,0,0,8-8V224a8,8,0,0,0-16,0v56A8,8,0,0,0,224,288Z" />-->
                                <!--                <path d="M312,288h32a8,8,0,0,0,0-16H320V256h8a8,8,0,0,0,0-16h-8v-8h24a8,8,0,0,0,0-16H312a8,8,0,0,0-8,8v56A8,8,0,0,0,312,288Z" />-->
                                <!--                <path d="M264.308,282.2a8,8,0,0,0,15.384,0l16-56a8,8,0,1,0-15.384-4.4L272,250.88,263.692,221.8a8,8,0,1,0-15.384,4.4Z" />-->
                                <!--            </g>-->
                                <!--        </svg>-->
                                <!--        <span>Live class</span>-->
                                <!--    </a></li>-->
                            <?php }
                        }

                        if (isset($access->extraclasses)) {
                            if ($access->extraclasses == '1') { ?>
                                <!--<li <?php echo in_array("extra-classes", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/extra-classes">-->
                                <!--        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">-->
                                <!--            <g>-->
                                <!--                <path d="m459.943 100.795c9.954-10.714 16.057-25.052 16.057-40.795 0-33.084-26.916-60-60-60s-60 26.916-60 60c0 15.743 6.103 30.081 16.057 40.795-14.691 7.698-27.135 19.124-36.057 33.019-8.922-13.896-21.366-25.321-36.057-33.019 9.954-10.714 16.057-25.052 16.057-40.795 0-33.084-26.916-60-60-60s-60 26.916-60 60c0 15.743 6.103 30.081 16.057 40.795-14.691 7.698-27.135 19.123-36.057 33.019-8.922-13.896-21.366-25.321-36.057-33.019 9.954-10.714 16.057-25.052 16.057-40.795 0-33.084-26.916-60-60-60s-60 26.916-60 60c0 15.743 6.103 30.081 16.057 40.795-30.32 15.887-51.057 47.668-51.057 84.205v100c0 8.284 6.716 15 15 15h20c0 15.743 6.103 30.081 16.057 40.795-30.32 15.887-51.057 47.668-51.057 84.205v72c0 8.284 6.716 15 15 15h480c8.284 0 15-6.716 15-15v-72c0-36.537-20.737-68.318-51.057-84.205 9.954-10.714 16.057-25.052 16.057-40.795h20c8.284 0 15-6.716 15-15v-100c0-36.537-20.737-68.318-51.057-84.205zm-73.943-40.795c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm30 60c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm-190-60c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm30 60c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm-190-60c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm30 60c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm-30 180c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm90 0h40c0 15.743 6.103 30.081 16.057 40.795-14.691 7.698-27.135 19.123-36.057 33.019-8.922-13.896-21.366-25.321-36.057-33.019 9.954-10.714 16.057-25.052 16.057-40.795zm70 0c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm90 0h40c0 15.743 6.103 30.081 16.057 40.795-14.691 7.698-27.135 19.124-36.057 33.019-8.922-13.896-21.366-25.321-36.057-33.019 9.954-10.714 16.057-25.052 16.057-40.795zm-60 60c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm-160 0c34.159 0 62.248 26.486 64.81 60h-129.62c2.562-33.514 30.651-60 64.81-60zm385 122h-450v-32h450zm-.19-62h-129.62c2.562-33.514 30.65-60 64.81-60s62.248 26.486 64.81 60zm-94.81-120c0-16.542 13.458-30 30-30s30 13.458 30 30-13.458 30-30 30-30-13.458-30-30zm95-30h-13.072c-10.391-17.916-29.769-30-51.928-30s-41.537 12.084-51.928 30h-56.144c-10.391-17.916-29.769-30-51.928-30s-41.537 12.084-51.928 30h-56.144c-10.391-17.916-29.769-30-51.928-30s-41.537 12.084-51.928 30h-13.072v-60h450z"></path>-->
                                <!--            </g>-->
                                <!--        </svg>-->
                                <!--        <span><?php echo html_escape($this->common->languageTranslator('ltr_extra_classes')); ?></span>-->
                                <!--    </a></li>-->
                            <?php }
                        }
                        if (isset($access->course_content)) {
                            if ($access->course_content == '1') { ?>
                                <li class="has_sub_menu <?php echo (in_array("book-manage", $cur_arr) || in_array("notes-manage", $cur_arr) || in_array("old-paper", $cur_arr)) ? 'active' : ''; ?>">
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
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_library_manager')); ?></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li <?php echo (in_array("book-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/book-manage"><?php echo html_escape($this->common->languageTranslator('ltr_books')); ?></a></li>
                                        <!--<li <?php echo (in_array("notes-manage", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/notes-manage"><?php echo html_escape($this->common->languageTranslator('ltr_notes')); ?></a></li>-->
                                        <li <?php echo (in_array("old-paper", $cur_arr)) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/old-paper"><?php echo html_escape($this->common->languageTranslator('ltr_old_papers')); ?></a></li>
                                    </ul>
                                </li>
                            <?php }
                        }
                        
                        if (isset($access->video_lecture)) {
                            if ($access->video_lecture == '1') { ?>

                                <!--<li <?php echo in_array("video-manage", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/video-manage">-->
                                <!--        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">-->
                                <!--            <g>-->
                                <!--                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.753,23.958c-7.167,0-14.334,0-21.506,0-->
                                <!--    c0-5.968,0-11.938,0-17.916c7.166,0,14.336,0,21.506,0C25.753,12.009,25.753,17.981,25.753,23.958z M22.153,23.233-->
                                <!--    c0-5.502,0-10.986,0-16.465c-4.784,0-9.551,0-14.314,0c0,5.497,0,10.976,0,16.465C12.612,23.233,17.375,23.233,22.153,23.233z-->
                                <!--     M4.975,6.761c0,0.722,0,1.427,0,2.125c0.721,0,1.425,0,2.124,0c0-0.717,0-1.416,0-2.125C6.389,6.761,5.69,6.761,4.975,6.761z-->
                                <!--     M22.903,6.755c0,0.712,0,1.421,0,2.133c0.712,0,1.416,0,2.117,0c0-0.719,0-1.423,0-2.133C24.31,6.755,23.615,6.755,22.903,6.755z-->
                                <!--     M7.095,11.761c0-0.722,0-1.426,0-2.124c-0.72,0-1.424,0-2.125,0c0,0.717,0,1.416,0,2.124C5.682,11.761,6.38,11.761,7.095,11.761z-->
                                <!--     M25.021,11.761c0-0.722,0-1.426,0-2.124c-0.72,0-1.424,0-2.124,0c0,0.717,0,1.416,0,2.124-->
                                <!--    C23.607,11.761,24.307,11.761,25.021,11.761z M7.099,14.629c0-0.725,0-1.424,0-2.128c-0.715,0-1.42,0-2.123,0-->
                                <!--    c0,0.718,0,1.421,0,2.128C5.69,14.629,6.389,14.629,7.099,14.629z M22.9,12.497c0,0.722,0,1.425,0,2.124c0.72,0,1.426,0,2.125,0-->
                                <!--    c0-0.717,0-1.416,0-2.124C24.315,12.497,23.615,12.497,22.9,12.497z M7.101,15.371c-0.722,0-1.426,0-2.123,0-->
                                <!--    c0,0.72,0,1.424,0,2.124c0.717,0,1.415,0,2.123,0C7.101,16.784,7.101,16.086,7.101,15.371z M25.021,17.498c0-0.723,0-1.428,0-2.126-->
                                <!--    c-0.72,0-1.424,0-2.124,0c0,0.718,0,1.416,0,2.126C23.607,17.498,24.307,17.498,25.021,17.498z M7.106,18.242-->
                                <!--    c-0.711,0-1.421,0-2.133,0c0,0.711,0,1.416,0,2.116c0.72,0,1.424,0,2.133,0C7.106,19.647,7.106,18.954,7.106,18.242z M22.9,18.232-->
                                <!--    c0,0.723,0,1.427,0,2.126c0.72,0,1.426,0,2.125,0c0-0.718,0-1.416,0-2.126C24.315,18.232,23.615,18.232,22.9,18.232z M4.976,21.102-->
                                <!--    c0,0.722,0,1.427,0,2.124c0.721,0,1.424,0,2.123,0c0-0.719,0-1.416,0-2.124C6.389,21.102,5.688,21.102,4.976,21.102z-->
                                <!--     M25.021,23.233c0-0.724,0-1.427,0-2.124c-0.72,0-1.424,0-2.124,0c0,0.717,0,1.416,0,2.124-->
                                <!--    C23.607,23.233,24.307,23.233,25.021,23.233z"></path>-->
                                <!--                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.131,14.996c0-0.918-0.001-1.836,0-2.755-->
                                <!--    c0.001-0.434,0.253-0.586,0.624-0.374c1.617,0.923,3.234,1.846,4.851,2.771c0.356,0.204,0.355,0.511-0.002,0.717-->
                                <!--    c-1.616,0.923-3.233,1.848-4.851,2.77c-0.37,0.212-0.621,0.06-0.622-0.375C12.13,16.833,12.131,15.914,12.131,14.996z-->
                                <!--     M12.864,12.758c0,1.506,0,2.98,0,4.479c1.313-0.749,2.6-1.485,3.92-2.241C15.459,14.239,14.175,13.506,12.864,12.758z"></path>-->
                                <!--            </g>-->
                                <!--        </svg>-->
                                <!--        <span><?php echo html_escape($this->common->languageTranslator('ltr_video_lecture_manager')); ?> </span>-->
                                <!--    </a></li>-->
                            <?php }
                        }
                        
                        if (isset($access->question_manager)) {
                            if ($access->question_manager == '1') { ?>
                                <li <?php echo in_array("question-manage", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/question-manage">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84
                                            c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z"></path>
                                                        <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869
                                            c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389
                                            c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291
                                            c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z"></path>
                                                        <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256
                                            C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216
                                            C472,375.377,375.393,472,256,472z"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_question_manager')); ?> </span>
                                    </a></li>
                            <?php }
                        }
                        if (isset($access->student_manage)) {
                            if ($access->student_manage == '1') {   ?>
                                <li class="<?php echo (in_array("student-details", $cur_arr)) ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>teacher/student-details">
                                        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m256 386c42.239 0 85-13.739 85-40v-56.835l40-17.778v104.613c0 5.522 4.478 10 10 10s10-4.478 10-10v-120c0-4.434-2.771-7.812-6.123-9.22l-134.816-59.918c-2.586-1.15-5.537-1.15-8.123 0l-135 60c-3.61 1.605-5.938 5.186-5.938 9.138 0 3.951 2.327 7.533 5.938 9.138l54.062 24.027v56.835c0 26.261 42.76 40 85 40zm65-40c0 5.981-22.115 20-65 20s-65-14.019-65-20v-47.945l60.938 27.084c1.293.574 2.678.861 4.062.861s2.769-.287 4.062-.861l60.938-27.085zm-175.379-89.999 110.379-49.058 110.379 49.058-110.379 49.056z" />
                                                <path d="m502 36h-492c-5.523 0-10 4.477-10 10v420c0 5.522 4.477 10 10 10h201c5.523 0 10-4.478 10-10s-4.477-10-10-10h-191v-310h472v310h-191c-5.522 0-10 4.478-10 10s4.478 10 10 10h201c5.522 0 10-4.478 10-10v-420c0-5.523-4.478-10-10-10zm-10 90h-472v-70h286v20c0 5.522 4.478 10 10 10s10-4.478 10-10v-20h40v20c0 5.522 4.478 10 10 10s10-4.478 10-10v-20h40v20c0 5.522 4.478 10 10 10s10-4.478 10-10v-20h46z" />
                                                <circle cx="256" cy="466" r="10" />
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_student_details')); ?></span>
                                    </a>
                                </li>
                        <?php }
                        } ?>
                        <?php if (isset($access->exam)) {
                            if ($access->exam == '1') { ?>
                                <li class="has_sub_menu <?php echo (in_array("exam-manage", $cur_arr) || in_array("practice-result", $cur_arr) || in_array("mock-result", $cur_arr) || in_array("create-exam", $cur_arr)) ? 'active' : ''; ?>"><a href="javascript:void(0);" class="">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                            <g>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.207,4.605c0.082,0.068,0.172,0.131,0.248,0.206
                                        c1.086,1.085,2.172,2.172,3.256,3.259c0.048,0.047,0.098,0.095,0.137,0.149c0.1,0.138,0.081,0.327-0.041,0.442
                                        c-0.132,0.124-0.28,0.125-0.428,0.037c-0.063-0.037-0.112-0.096-0.166-0.148c-1.037-1.038-2.076-2.075-3.111-3.116
                                        c-0.098-0.1-0.193-0.143-0.335-0.141c-3.551,0.003-7.103,0.002-10.654,0.002c-0.688,0-1.125,0.438-1.125,1.129
                                        c-0.002,5.716-0.002,11.434,0,17.149c0,0.69,0.435,1.129,1.126,1.129c2.928,0,5.858,0,8.786,0.001c0.087,0,0.195-0.012,0.256,0.031
                                        c0.089,0.067,0.185,0.167,0.211,0.271c0.05,0.185-0.093,0.294-0.229,0.389c-3.126,0-6.253,0-9.379,0
                                        c-0.28-0.138-0.581-0.243-0.834-0.418c-0.36-0.241-0.515-0.64-0.627-1.045c0-5.954,0-11.909,0-17.864
                                        c0.136-0.28,0.242-0.579,0.414-0.835c0.244-0.362,0.643-0.51,1.047-0.627C10.574,4.605,14.392,4.605,18.207,4.605z"></path>
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
                                         M19.258,24.694c-0.496-0.495-1.003-1.001-1.483-1.482c0,0.461,0,0.97,0,1.482C18.29,24.694,18.793,24.694,19.258,24.694z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.604,10.149c-0.102,0-0.182,0-0.26,0
                                        c-0.926,0-1.854,0.004-2.779,0c-0.854-0.004-1.512-0.481-1.731-1.258c-0.041-0.147-0.067-0.305-0.069-0.457
                                        c-0.008-0.562-0.004-1.124-0.003-1.685c0-0.26,0.128-0.406,0.348-0.404c0.221,0.001,0.341,0.144,0.341,0.408
                                        c0.001,0.521,0,1.042,0,1.563c0.001,0.708,0.423,1.135,1.134,1.138c1.066,0.004,2.136,0,3.205,0.001c0.42,0,0.51,0.092,0.51,0.516
                                        c0,2.197,0,4.396,0,6.594c0,0.074,0.001,0.15-0.012,0.221c-0.028,0.178-0.136,0.278-0.314,0.285c-0.18,0.01-0.3-0.076-0.344-0.249
                                        c-0.021-0.091-0.022-0.188-0.022-0.282c-0.002-2.036-0.002-4.071-0.002-6.106C22.604,10.346,22.604,10.26,22.604,10.149z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.128,21.935c-0.312,0-0.622,0.001-0.934,0
                                        c-0.311-0.004-0.438-0.133-0.439-0.449c-0.001-0.635-0.002-1.271,0-1.904c0.001-0.291,0.132-0.424,0.42-0.428
                                        c0.649-0.003,1.298-0.003,1.945,0c0.271,0.004,0.406,0.13,0.408,0.397c0.006,0.662,0.007,1.322-0.001,1.985
                                        c-0.003,0.269-0.138,0.393-0.407,0.396C10.791,21.936,10.458,21.935,10.128,21.935z M10.822,21.239c0-0.473,0-0.921,0-1.375
                                        c-0.461,0-0.909,0-1.375,0c0,0.433-0.003,0.851,0.004,1.268c0.001,0.036,0.057,0.103,0.089,0.103
                                        C9.963,21.241,10.388,21.239,10.822,21.239z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.128,10.847c0.338,0,0.676-0.003,1.014,0.002
                                        c0.25,0.003,0.381,0.118,0.385,0.368c0.008,0.674,0.009,1.35,0,2.025c-0.004,0.254-0.145,0.373-0.406,0.375
                                        c-0.647,0.001-1.296,0.001-1.945,0c-0.286-0.002-0.419-0.135-0.42-0.427c-0.002-0.642-0.002-1.283,0-1.925
                                        c0.001-0.293,0.126-0.415,0.42-0.418C9.492,10.845,9.811,10.847,10.128,10.847z M10.822,12.913c0-0.459,0-0.906,0-1.358
                                        c-0.461,0-0.909,0-1.359,0c0,0.464,0,0.911,0,1.358C9.925,12.913,10.367,12.913,10.822,12.913z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.067,15.689c-0.555,0-1.109,0.002-1.663,0
                                        c-0.263,0-0.407-0.127-0.407-0.346c0.001-0.216,0.15-0.344,0.41-0.344c1.109,0,2.217,0,3.327,0c0.257,0,0.407,0.133,0.406,0.349
                                        s-0.148,0.341-0.41,0.341C18.178,15.69,17.621,15.689,17.067,15.689z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.001,10.847c0.548,0,1.096-0.001,1.642,0.001
                                        c0.277,0.001,0.431,0.131,0.426,0.349c-0.006,0.208-0.165,0.343-0.421,0.343c-1.109,0.002-2.217,0-3.325,0
                                        c-0.179,0-0.326-0.063-0.385-0.237c-0.05-0.153-0.018-0.307,0.132-0.392c0.076-0.044,0.178-0.06,0.269-0.061
                                        C13.893,10.844,14.446,10.847,15.001,10.847z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.732,16.897c0.392-0.587,0.754-1.141,1.132-1.684
                                        c0.065-0.094,0.191-0.188,0.298-0.2c0.097-0.01,0.232,0.067,0.302,0.148c0.105,0.124,0.071,0.278-0.019,0.413
                                        c-0.381,0.568-0.758,1.136-1.135,1.703c-0.074,0.112-0.144,0.228-0.225,0.337c-0.143,0.187-0.358,0.21-0.529,0.052
                                        c-0.236-0.223-0.464-0.454-0.688-0.688c-0.149-0.155-0.145-0.349-0.007-0.49c0.136-0.138,0.331-0.145,0.49,0.002
                                        C9.479,16.609,9.592,16.746,9.732,16.897z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.116,12.926c0.439,0,0.879-0.001,1.317,0
                                        c0.254,0.001,0.394,0.119,0.398,0.33c0.007,0.216-0.146,0.359-0.396,0.359c-0.887,0.003-1.77,0.003-2.656,0
                                        c-0.248,0-0.404-0.146-0.399-0.357c0.004-0.209,0.147-0.331,0.396-0.332C17.225,12.925,17.671,12.926,18.116,12.926z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.637,17.765c-0.438,0-0.879,0.002-1.316,0
                                        c-0.255,0-0.394-0.117-0.396-0.329c-0.007-0.217,0.142-0.358,0.394-0.36c0.886-0.002,1.771-0.002,2.655,0
                                        c0.246,0.002,0.411,0.153,0.404,0.358c-0.007,0.204-0.155,0.331-0.402,0.331C15.529,17.767,15.083,17.765,14.637,17.765z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.646,21.241c0.439,0,0.879-0.002,1.317,0.001
                                        c0.261,0,0.413,0.132,0.413,0.342c0,0.205-0.16,0.349-0.413,0.349c-0.878,0.002-1.757,0.002-2.635,0
                                        c-0.258,0-0.407-0.137-0.405-0.351c0-0.219,0.139-0.34,0.406-0.341C13.769,21.239,14.207,21.241,14.646,21.241z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.638,19.847c-0.432,0-0.864,0.002-1.297-0.001
                                        c-0.274,0-0.414-0.114-0.417-0.33c-0.007-0.226,0.142-0.36,0.414-0.362c0.871-0.001,1.743-0.003,2.614,0
                                        c0.344,0.004,0.543,0.283,0.363,0.524c-0.067,0.09-0.223,0.157-0.341,0.161C15.53,19.857,15.085,19.847,14.638,19.847z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.43,17.765c-0.324,0-0.648,0.004-0.973,0
                                        c-0.244-0.003-0.388-0.134-0.386-0.345c0.002-0.2,0.159-0.343,0.394-0.345c0.661-0.004,1.323-0.004,1.985,0.002
                                        c0.236,0,0.385,0.145,0.382,0.352c-0.002,0.216-0.137,0.335-0.39,0.336C19.104,17.769,18.767,17.765,18.43,17.765z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.311,12.926c0.331,0,0.661-0.002,0.992,0.001
                                        c0.223,0.003,0.378,0.138,0.382,0.331c0.006,0.197-0.154,0.356-0.384,0.357c-0.667,0.003-1.336,0.005-2.003,0
                                        c-0.238-0.001-0.381-0.144-0.374-0.357c0.002-0.206,0.139-0.328,0.374-0.331C13.635,12.924,13.973,12.926,14.311,12.926z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6,15.689c-0.114,0-0.229,0.004-0.344-0.002
                                        c-0.2-0.009-0.33-0.142-0.332-0.332c-0.006-0.193,0.12-0.343,0.313-0.352c0.243-0.011,0.487-0.01,0.731,0
                                        c0.187,0.006,0.335,0.168,0.333,0.343c-0.002,0.177-0.148,0.331-0.337,0.341C13.845,15.694,13.722,15.689,13.6,15.689z"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.745,19.839c-0.128,0-0.256,0.012-0.385-0.002
                                        c-0.177-0.021-0.275-0.137-0.287-0.314c-0.011-0.176,0.077-0.324,0.249-0.34c0.287-0.027,0.579-0.025,0.867-0.003
                                        c0.177,0.014,0.277,0.181,0.259,0.354c-0.02,0.176-0.118,0.288-0.297,0.306C18.017,19.851,17.88,19.84,17.745,19.839
                                        C17.745,19.839,17.745,19.839,17.745,19.839z"></path>
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_exam')); ?></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li <?php echo in_array("create-exam", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/create-exam"><?php echo html_escape($this->common->languageTranslator('ltr_create_paper')); ?></a></li>
                                        <li <?php echo in_array("exam-manage", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/exam-manage"><?php echo html_escape($this->common->languageTranslator('ltr_manage_paper')); ?></a></li>
                                        <li <?php echo in_array("practice-result", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/practice-result"><?php echo html_escape($this->common->languageTranslator('ltr_practice_result')); ?></a></li>
                                        <li <?php echo in_array("mock-result", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/mock-result"><?php echo html_escape($this->common->languageTranslator('ltr_mock_test_result')); ?></a></li>
                                    </ul>
                                </li>
                            <?php }
                        }
                        if (isset($access->notice)) {
                            if ($access->notice == '1') { ?>
                                <li <?php echo in_array("notice", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/notice">
                                        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m488.5 61h-465c-12.958 0-23.5 10.542-23.5 23.5v276.143c0 4.143 3.358 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-276.143c0-4.687 3.813-8.5 8.5-8.5h465c4.687 0 8.5 3.813 8.5 8.5v59.571c0 4.143 3.358 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-59.571c0-12.958-10.542-23.5-23.5-23.5z"></path>
                                                <path d="m504.5 171.571c-4.142 0-7.5 3.357-7.5 7.5v248.429c0 4.687-3.813 8.5-8.5 8.5h-465c-4.687 0-8.5-3.813-8.5-8.5v-31.857c0-4.143-3.358-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v31.857c0 12.958 10.542 23.5 23.5 23.5h465c12.958 0 23.5-10.542 23.5-23.5v-248.429c0-4.142-3.358-7.5-7.5-7.5z"></path>
                                                <path d="m461.5 414.542c8.547 0 15.5-6.953 15.5-15.5v-286.084c0-8.547-6.953-15.5-15.5-15.5h-411c-8.547 0-15.5 6.953-15.5 15.5v286.084c0 8.547 6.953 15.5 15.5 15.5zm-411.5-15.5v-286.084c0-.275.224-.5.5-.5h411c.276 0 .5.225.5.5v286.084c0 .275-.224.5-.5.5h-411c-.276 0-.5-.225-.5-.5z"></path>
                                                <path d="m320.501 263.75c2.171 7.119 9.689 11.156 16.851 8.975l93.979-28.662c7.119-2.172 11.145-9.731 8.975-16.851 0-.001 0-.001 0-.001l-28.663-93.978c-2.174-7.127-9.698-11.153-16.852-8.976l-25.047 7.639c-4.318-6.382-11.623-10.586-19.892-10.586-13.224 0-23.984 10.752-23.999 23.972l-25.041 7.637c-7.12 2.172-11.146 9.731-8.974 16.851zm29.352-127.438c4.034 0 7.589 2.695 8.666 6.622 1.604 5.879-2.87 11.378-8.666 11.378-5.015 0-9-4.115-9-9 0-4.963 4.038-9 9-9zm-19.323 23.228c4.331 5.891 11.377 9.696 19.11 9.766 13.134.09 23.596-10.235 24.184-22.865.002-.036.006-.072.007-.108l23.901-7.29 27.788 91.109-91.109 27.787-27.787-91.108z"></path>
                                                <path d="m85.953 293.097h41.626v69.918c0 7.444 6.056 13.5 13.5 13.5h98.252c7.444 0 13.5-6.056 13.5-13.5v-98.252c0-7.444-6.056-13.5-13.5-13.5h-26.333c-2.378-7.209-8.084-12.915-15.293-15.293v-54.625c0-7.444-6.056-13.5-13.5-13.5h-26.333c-3.157-9.571-12.179-16.5-22.793-16.5s-19.636 6.929-22.793 16.5h-26.333c-7.444 0-13.5 6.056-13.5 13.5v98.252c0 7.444 6.056 13.5 13.5 13.5zm127.052-26.834h24.826v95.252h-95.252v-75.918-19.334h24.826c3.223 9.767 12.427 16.5 22.8 16.5 10.333 0 19.558-6.677 22.8-16.5zm-22.8-16.5c4.962 0 9 4.037 9 9s-4.038 9-9 9c-5.042 0-9-4.146-9-9 0-4.963 4.037-9 9-9zm-55.126-83.418c4.962 0 9 4.037 9 9s-4.038 9-9 9-9-4.037-9-9 4.037-9 9-9zm-47.626 16.5h24.826c.022.067.051.131.074.198 3.289 9.683 12.411 16.302 22.726 16.302 10.386 0 19.574-6.724 22.8-16.5h24.826v53.118c-.091.03-.179.067-.269.098-6.98 2.396-12.509 7.89-14.927 14.913-.033.097-.073.191-.105.289h-26.326c-7.444 0-13.5 6.056-13.5 13.5v13.334h-40.125z"></path>
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_notice')); ?></span>
                                    </a></li>
                            <?php }
                        }
                        
                        if (isset($access->student_leave)) {
                            if ($access->student_leave == '1') { ?>
                                <li class="<?php echo (in_array("manage-student-leave", $cur_arr)) ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>teacher/manage-student-leave">
                                        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="m256 386c42.239 0 85-13.739 85-40v-56.835l40-17.778v104.613c0 5.522 4.478 10 10 10s10-4.478 10-10v-120c0-4.434-2.771-7.812-6.123-9.22l-134.816-59.918c-2.586-1.15-5.537-1.15-8.123 0l-135 60c-3.61 1.605-5.938 5.186-5.938 9.138 0 3.951 2.327 7.533 5.938 9.138l54.062 24.027v56.835c0 26.261 42.76 40 85 40zm65-40c0 5.981-22.115 20-65 20s-65-14.019-65-20v-47.945l60.938 27.084c1.293.574 2.678.861 4.062.861s2.769-.287 4.062-.861l60.938-27.085zm-175.379-89.999 110.379-49.058 110.379 49.058-110.379 49.056z" />
                                                <path d="m502 36h-492c-5.523 0-10 4.477-10 10v420c0 5.522 4.477 10 10 10h201c5.523 0 10-4.478 10-10s-4.477-10-10-10h-191v-310h472v310h-191c-5.522 0-10 4.478-10 10s4.478 10 10 10h201c5.522 0 10-4.478 10-10v-420c0-5.523-4.478-10-10-10zm-10 90h-472v-70h286v20c0 5.522 4.478 10 10 10s10-4.478 10-10v-20h40v20c0 5.522 4.478 10 10 10s10-4.478 10-10v-20h40v20c0 5.522 4.478 10 10 10s10-4.478 10-10v-20h46z" />
                                                <circle cx="256" cy="466" r="10" />
                                            </g>
                                        </svg>
                                        <span><?php echo html_escape($this->common->languageTranslator('ltr_manage_student_leave')); ?></span>
                                    </a>
                                </li>
                        <?php }
                        } ?>


                        <li class="<?php echo (in_array("apply-leave", $cur_arr)) ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>teacher/apply-leave">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M400.003,152H256.001c-5.523,0-10,4.477-10,10s4.477,10,10,10h144.002c5.523,0,10-4.477,10-10S405.526,152,400.003,152z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M365.011,202.931c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07
                                        s1.07,5.21,2.93,7.07s4.44,2.93,7.07,2.93s5.21-1.07,7.07-2.93c1.86-1.86,2.93-4.44,2.93-7.07S366.871,204.791,365.011,202.931z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M263.061,45.931c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07
                                        s1.07,5.21,2.93,7.07c1.86,1.86,4.44,2.93,7.07,2.93s5.21-1.07,7.07-2.93c1.86-1.86,2.93-4.44,2.93-7.07
                                        S264.921,47.791,263.061,45.931z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M315.878,200h-59.877c-5.523,0-10,4.477-10,10s4.477,10,10,10h59.877c5.523,0,10-4.477,10-10S321.401,200,315.878,200z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M400.003,260H256.001c-5.523,0-10,4.477-10,10s4.477,10,10,10h144.002c5.523,0,10-4.477,10-10S405.526,260,400.003,260z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M365.011,310.931c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07
                                        s1.07,5.21,2.93,7.07s4.44,2.93,7.07,2.93s5.21-1.07,7.07-2.93c1.86-1.86,2.93-4.44,2.93-7.07S366.871,312.791,365.011,310.931z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M315.878,308h-59.877c-5.523,0-10,4.477-10,10s4.477,10,10,10h59.877c5.523,0,10-4.477,10-10S321.401,308,315.878,308z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M400.003,368H256.001c-5.523,0-10,4.477-10,10s4.477,10,10,10h144.002c5.523,0,10-4.477,10-10S405.526,368,400.003,368z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M365.011,418.931c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21,1.07-7.07,2.93c-1.86,1.86-2.93,4.44-2.93,7.07
                                        s1.07,5.21,2.93,7.07s4.44,2.93,7.07,2.93s5.21-1.07,7.07-2.93c1.86-1.86,2.93-4.44,2.93-7.07S366.871,420.791,365.011,418.931z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M315.878,416h-59.877c-5.523,0-10,4.477-10,10s4.477,10,10,10h59.877c5.523,0,10-4.477,10-10S321.401,416,315.878,416z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M419.243,39.001h-76.379C331.823,28.48,316.898,22,300.479,22h-8.76C285.022,8.742,271.263,0,256,0
                                        s-29.021,8.742-35.719,22H211.5c-16.419,0-31.343,6.48-42.384,17.001H92.759c-26.885,0-48.758,21.873-48.758,48.758v375.484
                                        c0,26.885,21.873,48.758,48.758,48.758h326.483c26.885,0,48.758-21.873,48.758-48.758V87.759
                                        C468.001,60.874,446.128,39.001,419.243,39.001z M211.501,42h15.586c4.498,0,8.442-3.003,9.639-7.338
                                        C239.111,26.029,247.037,20,256.001,20c8.964,0,16.89,6.029,19.274,14.662c1.197,4.335,5.142,7.338,9.639,7.338h15.565
                                        c21.705,0,39.571,16.75,41.354,38.001H170.147C171.93,58.75,189.797,42,211.501,42z M448.001,463.244
                                        c0,15.857-12.901,28.758-28.758,28.758H92.759c-15.857,0-28.758-12.901-28.758-28.758V87.759
                                        c0-15.857,12.901-28.758,28.758-28.758h62.347c-3.276,7.512-5.105,15.794-5.105,24.5v6.5c0,5.523,4.477,10,10,10H351.98
                                        c5.523,0,10-4.477,10-10v-6.5c0-8.705-1.829-16.988-5.105-24.5h62.368c15.857,0,28.758,12.901,28.758,28.758V463.244z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M192.41,149.596c-3.905-3.905-10.237-3.905-14.142-0.001l-42.762,42.763l-13.173-13.174
                                        c-3.905-3.904-10.237-3.904-14.143,0c-3.905,3.905-3.905,10.237,0,14.143l20.245,20.245c1.953,1.953,4.512,2.929,7.071,2.929
                                        c2.559,0,5.119-0.976,7.071-2.929l49.833-49.833C196.315,159.834,196.315,153.502,192.41,149.596z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M168.001,368h-48c-5.523,0-10,4.477-10,10v48c0,5.523,4.477,10,10,10h48c5.523,0,10-4.477,10-10v-48
                                        C178.001,372.477,173.524,368,168.001,368z M158.001,416h-28v-28h28V416z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M168.001,260h-48c-5.523,0-10,4.477-10,10v48c0,5.523,4.477,10,10,10h48c5.523,0,10-4.477,10-10v-48
                                        C178.001,264.477,173.524,260,168.001,260z M158.001,308h-28v-28h28V308z"></path>
                                        </g>
                                    </g>
                                </svg>
                                <span><?php echo html_escape($this->common->languageTranslator('ltr_apply_leave')); ?></span>
                            </a>
                            <?php if (isset($access->exam)) {
                                if ($access->exam == '1') { ?>
                        <li <?php echo in_array("academic-record", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/academic-record">
                                <svg enable-background="new 0 0 511.958 511.958" viewBox="0 0 511.958 511.958" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="m56.732 415.97c.149 0 .3-.004.45-.013 4.135-.245 7.288-3.795 7.044-7.931-6.469-109.157-5.302-219.857 3.469-329.025 1.305-16.228 14.06-29.245 30.331-30.953 7.877-.833 15.844-1.608 23.777-2.314v13.001c0 13.973 11.368 25.341 25.342 25.341s25.342-11.368 25.342-25.341v-16.666c7.237-.405 14.546-.761 21.871-1.062v17.728c0 13.973 11.368 25.341 25.341 25.341 13.974 0 25.342-11.368 25.342-25.341v-18.947c7.28-.056 14.59-.056 21.871 0v18.948c0 13.973 11.368 25.341 25.342 25.341s25.342-11.368 25.342-25.341v-17.729c7.325.301 14.634.656 21.87 1.062v16.667c0 13.973 11.368 25.341 25.342 25.341s25.342-11.368 25.342-25.341v-13.001c7.912.705 15.878 1.479 23.777 2.314 16.266 1.707 29.021 14.724 30.326 30.953 1.224 15.209 2.324 30.838 3.27 46.452.241 3.98 3.544 7.047 7.479 7.047.152 0 .306-.004.46-.014 4.135-.25 7.283-3.805 7.033-7.939-.951-15.712-2.059-31.441-3.291-46.749-1.885-23.423-20.269-42.208-43.707-44.667-8.42-.89-16.916-1.71-25.348-2.453v-5.337c.001-13.974-11.368-25.342-25.341-25.342s-25.342 11.368-25.342 25.341v1.703c-7.239-.401-14.549-.75-21.87-1.048v-.655c0-13.973-11.368-25.341-25.342-25.341-13.788 0-25.031 11.07-25.328 24.787-7.29-.055-14.609-.055-21.899 0-.297-13.717-11.54-24.787-25.328-24.787-13.973 0-25.341 11.368-25.341 25.341v.655c-7.321.298-14.632.647-21.871 1.048v-1.703c0-13.973-11.368-25.341-25.341-25.341s-25.342 11.368-25.342 25.341v5.337c-8.456.745-16.954 1.566-25.349 2.453-23.443 2.46-41.827 21.246-43.712 44.668-8.826 109.861-10.001 221.264-3.492 331.115.236 3.984 3.541 7.056 7.481 7.056zm297.734-390.629c0-5.702 4.64-10.341 10.342-10.341s10.342 4.639 10.342 10.341v33.395c0 5.702-4.64 10.341-10.342 10.341s-10.342-4.639-10.342-10.341zm-72.554 0c0-5.702 4.64-10.341 10.342-10.341s10.342 4.639 10.342 10.341v33.395c0 5.702-4.64 10.341-10.342 10.341s-10.342-4.639-10.342-10.341zm-72.553 0c0-5.702 4.639-10.341 10.341-10.341s10.342 4.639 10.342 10.341v33.395c0 5.702-4.64 10.341-10.342 10.341s-10.341-4.639-10.341-10.341zm-72.555 0c0-5.702 4.64-10.341 10.342-10.341s10.342 4.639 10.342 10.341v33.395c0 5.702-4.64 10.341-10.342 10.341s-10.342-4.639-10.342-10.341z"></path>
                                        <path d="m464.09 153.957c-.201-4.137-3.688-7.328-7.854-7.128-4.137.201-7.328 3.717-7.128 7.854 4.869 100.5 3.236 202.466-4.854 303.065-1.307 16.223-14.061 29.236-30.328 30.943-104.805 11.023-211.089 11.023-315.903 0-16.267-1.707-29.021-14.721-30.327-30.946-.482-5.963-.965-12.304-1.516-19.954-.298-4.131-3.871-7.236-8.02-6.941-4.131.297-7.239 3.888-6.941 8.02.554 7.695 1.039 14.078 1.525 20.083 1.885 23.416 20.269 42.196 43.711 44.657 52.934 5.567 106.22 8.35 159.523 8.349 53.291 0 106.599-2.784 159.514-8.349 23.444-2.459 41.828-21.24 43.713-44.658 8.142-101.24 9.785-203.855 4.885-304.995z"></path>
                                        <path d="m403.367 139.486h-223.017c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h223.018c4.143 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.501-7.5z"></path>
                                        <path d="m141.084 139.486h-33.798c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h33.798c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path>
                                        <path d="m131.685 124.834v-13.538c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v13.538c0 4.142 3.357 7.5 7.5 7.5 4.142 0 7.5-3.357 7.5-7.5z"></path>
                                        <path d="m403.367 210.773h-223.017c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h223.018c4.143 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.501-7.5z"></path>
                                        <path d="m141.084 210.773h-33.798c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h33.798c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path>
                                        <path d="m131.685 196.121v-13.538c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v13.538c0 4.142 3.357 7.5 7.5 7.5 4.142 0 7.5-3.358 7.5-7.5z"></path>
                                        <path d="m403.367 282.06h-223.017c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h223.018c4.143 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.501-7.5z"></path>
                                        <path d="m141.084 282.06h-33.798c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h33.798c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path>
                                        <path d="m131.685 267.408v-13.537c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v13.537c0 4.142 3.357 7.5 7.5 7.5 4.142 0 7.5-3.358 7.5-7.5z"></path>
                                        <path d="m403.367 353.347h-223.017c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h223.018c4.143 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.501-7.5z"></path>
                                        <path d="m141.084 353.347h-33.798c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h33.798c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"></path>
                                        <path d="m131.685 338.694v-13.537c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v13.537c0 4.142 3.357 7.5 7.5 7.5 4.142 0 7.5-3.358 7.5-7.5z"></path>
                                        <path d="m403.367 424.633h-223.017c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h223.018c4.143 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.501-7.5z"></path>
                                        <path d="m99.786 432.133c0 4.142 3.357 7.5 7.5 7.5h33.798c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-33.798c-4.142 0-7.5 3.358-7.5 7.5z"></path>
                                        <path d="m131.685 409.981v-13.538c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v13.538c0 4.142 3.357 7.5 7.5 7.5 4.142 0 7.5-3.357 7.5-7.5z"></path>
                                    </g>
                                </svg>
                                <span><?php echo html_escape($this->common->languageTranslator('ltr_academic_record')); ?> </span>
                            </a></li>
                    <?php }
                            }
                            if (isset($access->doubtsask)) {
                                if ($access->doubtsask == '1') { ?>
                        <!--<li <?php echo in_array("doubts-class", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/doubts-class">-->
                        <!--        <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">-->
                        <!--            <g>-->
                        <!--                <path d="m471.367 146.669h-108.468v-75.335c0-22.404-18.228-40.632-40.633-40.632h-281.633c-22.405 0-40.633 18.228-40.633 40.632v111.686c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-111.686c0-14.134 11.499-25.632 25.633-25.632h281.634c14.134 0 25.633 11.498 25.633 25.632v198.803c0 14.134-11.498 25.633-25.632 25.633h-162.238c-4.218 0-8.182 1.643-11.16 4.622l-49.7 49.7c-.139.141-.372.37-.854.171-.483-.2-.483-.528-.483-.724v-37.986c0-8.703-7.081-15.783-15.784-15.783h-41.416c-14.134 0-25.633-11.499-25.633-25.633v-57.117c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v57.117c0 22.405 18.228 40.633 40.633 40.633h41.416c.433 0 .784.352.784.783v37.986c0 6.406 3.824 12.13 9.743 14.581 1.965.815 4.02 1.21 6.056 1.21 4.1-.001 8.118-1.604 11.146-4.631l39.323-39.324v64.729c0 22.404 18.227 40.632 40.632 40.632h90.834c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-90.834c-14.134 0-25.632-11.498-25.632-25.632v-75.334h158.167c22.404 0 40.632-18.228 40.632-40.633v-108.468h108.468c14.134 0 25.633 11.499 25.633 25.633v198.803c0 14.134-11.499 25.632-25.633 25.632h-41.416c-8.703 0-15.784 7.08-15.784 15.783v37.986c0 .196 0 .523-.483.725-.48.2-.715-.03-.853-.171l-49.699-49.698c-2.98-2.982-6.944-4.625-11.161-4.625h-41.402c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h41.402c.205 0 .406.083.553.23l49.7 49.7c3.027 3.026 7.046 4.631 11.146 4.631 2.035-.001 4.092-.396 6.056-1.21 5.919-2.451 9.743-8.175 9.743-14.582v-37.986c0-.432.352-.783.784-.783h41.416c22.405 0 40.633-18.228 40.633-40.632v-198.803c-.003-22.405-18.231-40.633-40.636-40.633z" />-->
                        <!--                <path d="m231.934 352.97c0 13.271 10.796 24.066 24.066 24.066 13.271 0 24.066-10.796 24.066-24.066s-10.795-24.067-24.066-24.067c-13.27 0-24.066 10.796-24.066 24.067zm33.132 0c0 4.999-4.067 9.066-9.066 9.066s-9.066-4.067-9.066-9.066 4.067-9.066 9.066-9.066 9.066 4.067 9.066 9.066z" />-->
                        <!--                <path d="m157.383 253.569c0 13.27 10.797 24.066 24.067 24.066 13.271 0 24.066-10.796 24.066-24.066 0-13.271-10.796-24.066-24.066-24.066s-24.067 10.796-24.067 24.066zm33.134 0c0 4.999-4.067 9.066-9.066 9.066-5 0-9.067-4.067-9.067-9.066s4.067-9.066 9.067-9.066c4.998 0 9.066 4.067 9.066 9.066z" />-->
                        <!--                <path d="m205.517 172.937c21.462-9.945 34.639-32.09 32.994-55.905-1.95-28.296-24.759-51.105-53.052-53.058-15.796-1.094-31.485 4.463-43.033 15.242-11.552 10.781-18.177 26.024-18.177 41.82 0 13.271 10.797 24.066 24.067 24.066s24.066-10.796 24.066-24.066c0-2.578.998-4.871 2.885-6.632 1.854-1.729 4.302-2.58 6.877-2.411 4.306.297 8.05 4.042 8.347 8.352.273 3.948-1.979 7.602-5.604 9.09-16.709 6.861-27.505 23.073-27.505 41.302v16.566c0 13.271 10.796 24.067 24.066 24.067s24.067-10.797 24.067-24.067v-14.366zm-8.041-12.853c-4.228 1.735-6.959 5.917-6.959 10.652v16.566c0 5-4.067 9.067-9.067 9.067-4.999 0-9.066-4.067-9.066-9.067v-16.566c0-12.12 7.145-22.886 18.202-27.427 9.614-3.947 15.59-13.592 14.871-23.998-.806-11.689-10.592-21.477-22.289-22.283-.572-.039-1.141-.059-1.706-.059-6.142 0-11.921 2.263-16.426 6.467-4.935 4.604-7.652 10.855-7.652 17.6 0 4.999-4.067 9.066-9.066 9.066-5 0-9.067-4.067-9.067-9.066 0-11.653 4.889-22.9 13.411-30.855 8.518-7.952 20.078-12.059 31.766-11.242 20.863 1.438 37.682 18.259 39.12 39.125 1.256 18.212-9.222 35.1-26.072 42.02z" />-->
                        <!--                <path d="m429.167 352.97c0-13.271-10.796-24.066-24.066-24.066s-24.066 10.796-24.066 24.066 10.796 24.066 24.066 24.066 24.066-10.796 24.066-24.066zm-33.133 0c0-4.999 4.067-9.066 9.066-9.066s9.066 4.067 9.066 9.066-4.067 9.066-9.066 9.066c-4.998 0-9.066-4.067-9.066-9.066z" />-->
                        <!--                <path d="m330.551 377.036c13.27 0 24.066-10.796 24.066-24.066s-10.796-24.066-24.066-24.066c-13.271 0-24.067 10.796-24.067 24.066s10.796 24.066 24.067 24.066zm0-33.133c4.999 0 9.066 4.067 9.066 9.066s-4.067 9.066-9.066 9.066c-5 0-9.067-4.067-9.067-9.066s4.067-9.066 9.067-9.066z" />-->
                        <!--            </g>-->
                        <!--        </svg>-->
                        <!--        <span><?php echo html_escape($this->common->languageTranslator('ltr_doubts_class')); ?></span>-->
                        <!--    </a></li>-->
                    <?php }
                            }
                            if (isset($access->event)) {
                                if ($access->event == '1') { ?>
                        <li <?php echo in_array("event", $cur_arr) ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>teacher/event">
                                <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="m488.5 61h-465c-12.958 0-23.5 10.542-23.5 23.5v276.143c0 4.143 3.358 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-276.143c0-4.687 3.813-8.5 8.5-8.5h465c4.687 0 8.5 3.813 8.5 8.5v59.571c0 4.143 3.358 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-59.571c0-12.958-10.542-23.5-23.5-23.5z"></path>
                                        <path d="m504.5 171.571c-4.142 0-7.5 3.357-7.5 7.5v248.429c0 4.687-3.813 8.5-8.5 8.5h-465c-4.687 0-8.5-3.813-8.5-8.5v-31.857c0-4.143-3.358-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v31.857c0 12.958 10.542 23.5 23.5 23.5h465c12.958 0 23.5-10.542 23.5-23.5v-248.429c0-4.142-3.358-7.5-7.5-7.5z"></path>
                                        <path d="m461.5 414.542c8.547 0 15.5-6.953 15.5-15.5v-286.084c0-8.547-6.953-15.5-15.5-15.5h-411c-8.547 0-15.5 6.953-15.5 15.5v286.084c0 8.547 6.953 15.5 15.5 15.5zm-411.5-15.5v-286.084c0-.275.224-.5.5-.5h411c.276 0 .5.225.5.5v286.084c0 .275-.224.5-.5.5h-411c-.276 0-.5-.225-.5-.5z"></path>
                                        <path d="m320.501 263.75c2.171 7.119 9.689 11.156 16.851 8.975l93.979-28.662c7.119-2.172 11.145-9.731 8.975-16.851 0-.001 0-.001 0-.001l-28.663-93.978c-2.174-7.127-9.698-11.153-16.852-8.976l-25.047 7.639c-4.318-6.382-11.623-10.586-19.892-10.586-13.224 0-23.984 10.752-23.999 23.972l-25.041 7.637c-7.12 2.172-11.146 9.731-8.974 16.851zm29.352-127.438c4.034 0 7.589 2.695 8.666 6.622 1.604 5.879-2.87 11.378-8.666 11.378-5.015 0-9-4.115-9-9 0-4.963 4.038-9 9-9zm-19.323 23.228c4.331 5.891 11.377 9.696 19.11 9.766 13.134.09 23.596-10.235 24.184-22.865.002-.036.006-.072.007-.108l23.901-7.29 27.788 91.109-91.109 27.787-27.787-91.108z"></path>
                                        <path d="m85.953 293.097h41.626v69.918c0 7.444 6.056 13.5 13.5 13.5h98.252c7.444 0 13.5-6.056 13.5-13.5v-98.252c0-7.444-6.056-13.5-13.5-13.5h-26.333c-2.378-7.209-8.084-12.915-15.293-15.293v-54.625c0-7.444-6.056-13.5-13.5-13.5h-26.333c-3.157-9.571-12.179-16.5-22.793-16.5s-19.636 6.929-22.793 16.5h-26.333c-7.444 0-13.5 6.056-13.5 13.5v98.252c0 7.444 6.056 13.5 13.5 13.5zm127.052-26.834h24.826v95.252h-95.252v-75.918-19.334h24.826c3.223 9.767 12.427 16.5 22.8 16.5 10.333 0 19.558-6.677 22.8-16.5zm-22.8-16.5c4.962 0 9 4.037 9 9s-4.038 9-9 9c-5.042 0-9-4.146-9-9 0-4.963 4.037-9 9-9zm-55.126-83.418c4.962 0 9 4.037 9 9s-4.038 9-9 9-9-4.037-9-9 4.037-9 9-9zm-47.626 16.5h24.826c.022.067.051.131.074.198 3.289 9.683 12.411 16.302 22.726 16.302 10.386 0 19.574-6.724 22.8-16.5h24.826v53.118c-.091.03-.179.067-.269.098-6.98 2.396-12.509 7.89-14.927 14.913-.033.097-.073.191-.105.289h-26.326c-7.444 0-13.5 6.056-13.5 13.5v13.334h-40.125z"></path>
                                    </g>
                                </svg>
                                <span><?php echo html_escape($this->common->languageTranslator('ltr_event')); ?></span>
                            </a></li>
                <?php }
                
                            }?>
                            
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
                    <a class="edu_admin_bar edu_admin_with_img" href="javascript:void(0);">
                        <?php
                        if (isset($this->session->userdata['profile_img']) && !empty($this->session->userdata['profile_img'])) {
                            echo '<img src="' . base_url('uploads/teachers/') . $this->session->userdata['profile_img'] . '" />';
                        } else {
                            echo '<span class="icofont-user-alt-4"></span>';
                        }
                        if (!empty($this->session->userdata['name'])) {
                            $name = $this->session->userdata['name'];
                            echo substr($name, 0, 15);
                        }
                        ?>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 451.847 451.847" style="enable-background:new 0 0 451.847 451.847;" xml:space="preserve">
                            <g>
                                <path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751
                    			c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0
                    			c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z" />
                            </g>
                        </svg>
                    </a>
                    <div class="edu_admin_option">
                        <a href="<?php echo base_url(); ?>teacher/profile"><i class="icofont-user"></i><?php echo html_escape($this->common->languageTranslator('ltr_my_profile')); ?></a>
                        <a href="javascript:void(0);" title="Logout" class="cnfmlogOutBtn"><i class="icofont-logout"></i><?php echo html_escape($this->common->languageTranslator('ltr_logout')); ?></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">