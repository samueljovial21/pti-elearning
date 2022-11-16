<!DOCTYPE html>
<html <?php if($this->common->language_name=='arabic'){echo 'lang="ar" dir="rtl"';}else if($this->common->language_name=='french'){echo 'lang="fr" dir="ltr"';}else if($this->common->language_name=='english'){echo 'lang="en" dir="ltr"';} ?> >
<!-- Begin Head -->
  <head>
    <!----- Required MetaTags ----->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="<?php echo html_escape($this->common->siteKeywords); ?>">
    <meta name="description" content="<?php echo html_escape($this->common->siteDescription); ?>">
    <meta name="author" content="<?php echo html_escape($this->common->siteAuthorName); ?>">
    <!----- Style css ----->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/icofont.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/toastr.min.css';?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/frontend-rtl.css?<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/frontend-style.css?<?php echo time();?>">
    
	<!----- Favicon ----->
	<link rel="shortcut icon" type="image/ico" href="<?php echo html_escape($this->common->siteFavicon); ?>" />
	<!----- Title ----->
    <title><?php echo html_escape($this->common->siteTitle).((isset($title) && !empty($title)) ? ' | '.$title:'');?></title>
	<script>
		var base_url = "<?php echo base_url();?>";
		var site_logo = "<?php echo base_url();?>assets/images/favicon.png";
		var rzp_key ="<?php echo $this->common->rzp_key ?>";
        var ltr_status_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_status_msg')); ?>";
		var ltr_matching_msg = "<?php echo html_escape($this->common->languageTranslator('ltr_matching_msg')); ?>";
		var ltr_select_chapter ="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?>";
		var ltr_select_subject ="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?>";
		var ltr_subject ="<?php echo html_escape($this->common->languageTranslator('ltr_subject')); ?>";
		var ltr_teacher ="<?php echo html_escape($this->common->languageTranslator('ltr_teacher')); ?>";
		var ltr_select_teacher ="<?php echo html_escape($this->common->languageTranslator('ltr_select_teacher')); ?>";
		var ltr_start_date ="<?php echo html_escape($this->common->languageTranslator('ltr_start_date')); ?>";
		var ltr_end_date ="<?php echo html_escape($this->common->languageTranslator('ltr_end_date')); ?>";
		var ltr_start_time ="<?php echo html_escape($this->common->languageTranslator('ltr_start_time')); ?>";
		var ltr_end_time ="<?php echo html_escape($this->common->languageTranslator('ltr_end_time')); ?>";
        var ltr_cant_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_cant_msg')); ?>";
        var ltr_are_you_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_are_you_msg')); ?>";
        var ltr_add_course ="<?php echo html_escape($this->common->languageTranslator('ltr_add_course')); ?>";
        var ltr_edit_course ="<?php echo html_escape($this->common->languageTranslator('ltr_edit_course')); ?>";
        var ltr_add_doubts_date_class ="<?php echo html_escape($this->common->languageTranslator('ltr_add_doubts_date_class')); ?>";
        var ltr_add_new_exam ="<?php echo html_escape($this->common->languageTranslator('ltr_add_new_exam')); ?>";
        var ltr_end_date_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_end_date_msg')); ?>";
        var ltr_subject_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_subject_msg')); ?>";
        var ltr_characters_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_characters_msg')); ?>";
        var ltr_password_student_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_password_student_msg')); ?>";
        var ltr_enrollment_id ="<?php echo html_escape($this->common->languageTranslator('ltr_enrollment_id')); ?>";
        var ltr_password ="<?php echo html_escape($this->common->languageTranslator('ltr_password')); ?>";
        var ltr_add_another_student ="<?php echo html_escape($this->common->languageTranslator('ltr_add_another_student')); ?>";
        var ltr_select_batch_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch_msg')); ?>";
		var ltr_select_batch ="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch')); ?>";
        var ltr_changed_batch_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_changed_batch_msg')); ?>";
        var ltr_changed_password_for_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_changed_password_for_msg')); ?>";
        var ltr_confirm_password_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_confirm_password_msg')); ?>";
        var ltr_password_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_password_msg')); ?>";
        var ltr_subject_name_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_subject_name_msg')); ?>";
        var ltr_letters_characters_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_letters_characters_msg')); ?>";
        var ltr_subject_updated_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_subject_updated_msg')); ?>";
        var ltr_subject_add_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_subject_add_msg')); ?>";
        var ltr_subject_exists_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_subject_exists_msg')); ?>";
        var ltr_are_you_so_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_are_you_so_msg')); ?>";
        var ltr_subject_delete_alert_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_subject_delete_alert_msg')); ?>";
        var ltr_atleast_chapter_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_atleast_chapter_msg')); ?>";
        var ltr_add_chapter_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_add_chapter_msg')); ?>";
        var ltr_exists_chapter_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_exists_chapter_msg')); ?>";
        var ltr_chapter_name_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_chapter_name_msg')); ?>";
        var ltr_chapter_updated_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_chapter_updated_msg')); ?>";
        var ltr_chapter_delete_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_chapter_delete_msg')); ?>";
        var ltr_loading_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_loading_msg')); ?>";
        var ltr_select_subject_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject_msg')); ?>";
        var ltr_select_subject_both_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject_both_msg')); ?>";
        var ltr_word_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_word_msg')); ?>";
        var ltr_answer_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_answer_msg')); ?>";
        var ltr_start_date_greater_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_start_date_greater_msg')); ?>";
        var ltr_add_teacher ="<?php echo html_escape($this->common->languageTranslator('ltr_add_teacher')); ?>";
        var ltr_edit_teacher ="<?php echo html_escape($this->common->languageTranslator('ltr_edit_teacher')); ?>";
        var ltr_update_teacher ="<?php echo html_escape($this->common->languageTranslator('ltr_update_teacher')); ?>";
        var ltr_add_extra_class ="<?php echo html_escape($this->common->languageTranslator('ltr_add_extra_class')); ?>";
        var ltr_add_class ="<?php echo html_escape($this->common->languageTranslator('ltr_add_class')); ?>";
        var ltr_edit_extra_class ="<?php echo html_escape($this->common->languageTranslator('ltr_edit_extra_class')); ?>";
        var ltr_update_class ="<?php echo html_escape($this->common->languageTranslator('ltr_update_class')); ?>";
        var ltr_past_time_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_past_time_msg')); ?>";
        var ltr_end_greater_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_end_greater_msg')); ?>";
        var ltr_today_greater_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_today_greater_msg')); ?>";
        var ltr_class_already_added_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_class_already_added_msg')); ?>";
        var ltr_valid_time_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_valid_time_msg')); ?>";
        var ltr_select_date_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_select_date_msg')); ?>";
        var ltr_atleast_question_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_atleast_question_msg')); ?>";
        var ltr_select_year_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_select_year_msg')); ?>";
        var ltr_select_paper_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_select_paper_msg')); ?>";
        var ltr_add_facility ="<?php echo html_escape($this->common->languageTranslator('ltr_add_facility')); ?>";
        var ltr_edit_facility ="<?php echo html_escape($this->common->languageTranslator('ltr_edit_facility')); ?>";
        var ltr_add_assignment ="<?php echo html_escape($this->common->languageTranslator('ltr_add_assignment')); ?>";
        var ltr_edit_assignment ="<?php echo html_escape($this->common->languageTranslator('ltr_edit_assignment')); ?>";
        var ltr_update_assignment ="<?php echo html_escape($this->common->languageTranslator('ltr_update_assignment')); ?>";
        var ltr_select_from_date_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_select_from_date_msg')); ?>";
        var ltr_select_to_date_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_select_to_date_msg')); ?>";
        var ltr_batch_inactive_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_batch_inactive_msg')); ?>";
        var ltr_mark_complete ="<?php echo html_escape($this->common->languageTranslator('ltr_mark_complete')); ?>";
        var ltr_complete ="<?php echo html_escape($this->common->languageTranslator('ltr_complete')); ?>";
        var ltr_all_fields_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_all_fields_msg')); ?>";
        var ltr_hide_password ="<?php echo html_escape($this->common->languageTranslator('ltr_hide_password')); ?>";
        var ltr_change_password ="<?php echo html_escape($this->common->languageTranslator('ltr_change_password')); ?>";
        var ltr_new_password_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_new_password_msg')); ?>";
        var ltr_all_test_record_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_all_test_record_msg')); ?>";
        var ltr_once_deleted_alert_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_once_deleted_alert_msg')); ?>";
        var ltr_are_deleted_alert_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_are_deleted_alert_msg')); ?>";
        var ltr_updated_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_updated_msg')); ?>";
        var ltr_alert_updated_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_alert_updated_msg')); ?>";
        var ltr_category_changed_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_category_changed_msg')); ?>";
        var ltr_invalid_birth_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_invalid_birth_msg')); ?>";
        var ltr_to_greater_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_to_greater_msg')); ?>";
        var ltr_message ="<?php echo html_escape($this->common->languageTranslator('ltr_message')); ?>";
        var ltr_add_live_class ="<?php echo html_escape($this->common->languageTranslator('ltr_add_live_class')); ?>";
        var ltr_edit_live_class ="<?php echo html_escape($this->common->languageTranslator('ltr_edit_live_class')); ?>";
        var ltr_atleast_student_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_atleast_student_msg')); ?>";
        var ltr_atleast_date_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_atleast_date_msg')); ?>";
        var ltr_maximum40_characters_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_maximum40_characters_msg')); ?>";
        var ltr_maximum50_characters_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_maximum50_characters_msg')); ?>";
        var ltr_double_class_date_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_double_class_date_msg')); ?>";
		var ltr_ok ="<?php echo html_escape($this->common->languageTranslator('ltr_ok')); ?>";
		var ltr_cancel ="<?php echo html_escape($this->common->languageTranslator('ltr_cancel')); ?>";
		var ltr_select_student ="<?php echo html_escape($this->common->languageTranslator('ltr_select_student')); ?>";
		var ltr_description ="<?php echo html_escape($this->common->languageTranslator('ltr_description')); ?>";
		var ltr_can_remove_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_can_remove_msg')); ?>";
		var ltr_some_required ="<?php echo html_escape($this->common->languageTranslator('ltr_some_required')); ?>";
        var ltr_only_letters_msg ="<?php echo html_escape($this->common->languageTranslator('ltr_only_letters_msg')); ?>";
        var ltr_search ="<?php echo html_escape($this->common->languageTranslator('ltr_search')); ?>";
        var ltr_show ="<?php echo html_escape($this->common->languageTranslator('ltr_show')); ?>";
        var ltr_heading  ="<?php echo html_escape($this->common->languageTranslator('ltr_heading')); ?>";
        var ltr_sub_heading  ="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading')); ?>";
        var ltr_batch_speci_heading  ="<?php echo html_escape($this->common->languageTranslator('ltr_batch_speci_heading')); ?>";
        var ltr_fecherd  ="<?php echo html_escape($this->common->languageTranslator('ltr_fecherd')); ?>";
        var ltr_email  ="<?php echo html_escape($this->common->languageTranslator('ltr_email')); ?>";
        var ltr_wrong_credentials_msg  ="<?php echo html_escape($this->common->languageTranslator('ltr_wrong_credentials_msg')); ?>";
        var ltr_batch_spe_msg  ="<?php echo html_escape($this->common->languageTranslator('ltr_batch_spe_msg')); ?>";
        var ltr_you_delete  ="<?php echo html_escape($this->common->languageTranslator('ltr_you_delete')); ?>";
        var ltr_i_learn  ="<?php echo html_escape($this->common->languageTranslator('ltr_i_learn')); ?>";
        var ltr_chapters  ="<?php echo html_escape($this->common->languageTranslator('ltr_chapters')); ?>";
        var ltr_offer_price_msg  ="<?php echo html_escape($this->common->languageTranslator('ltr_offer_price_msg')); ?>";
        var ltr_batch_price_msg  ="<?php echo html_escape($this->common->languageTranslator('ltr_batch_price_msg')); ?>";
        var ltr_payment_msg  ="<?php echo html_escape($this->common->languageTranslator('ltr_payment_msg')); ?>";
        var ltr_something_msg  ="<?php echo html_escape($this->common->languageTranslator('ltr_something_msg')); ?>";
        var ltr_enter_your_name="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_name')); ?>";
        var ltr_enter_your_email="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_email')); ?>";
        var ltr_valid_enter_your_email="<?php echo html_escape($this->common->languageTranslator('ltr_valid_enter_your_email')); ?>";
        var ltr_enter_your_phone="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_phone')); ?>";
        var ltr_valid_enter_your_phone="<?php echo html_escape($this->common->languageTranslator('ltr_valid_enter_your_phone')); ?>";
        var ltr_enter_your_message="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_message')); ?>";
        var ltr_send="<?php echo html_escape($this->common->languageTranslator('ltr_send')); ?>";
        var ltr_no_result="<?php echo html_escape($this->common->languageTranslator('ltr_no_result')); ?>";

	</script>
  </head>
  <body class="<?php if($this->common->language_name=='arabic'){ echo 'rtl' ;}?>">
	<!----- Preloader Box ----->
	<div class="edu_preloader">
		<div class="edu_status">
			<img src="<?php echo html_escape($this->common->siteLoader); ?>" alt="loader">
		</div>
	</div>
	<!----- Preloader Box ----->
	<?php
	$timezoneDB = $this->db_model->select_data('timezone','site_details',array('id'=>1));

	if(isset($timezoneDB[0]['timezone']) && !empty($timezoneDB[0]['timezone'])){
		date_default_timezone_set($timezoneDB[0]['timezone']);
	}
	?>
	<!----- Main Wraapper ----->
	<section class="main_wrapper">
		<!----- Header Start ----->
		<header>
			<div class="edu_header_top">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="edu_social_wrapper">
								<ul>
									<li><?php echo html_escape($this->common->languageTranslator('ltr_follow_us_on')); ?></li>
									<?php 
									if(!empty($frontend_details[0]['facebook']))
										echo ' <li><a href="'.$frontend_details[0]['facebook'].'" class="edu_social_icon" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
									
									if(!empty($frontend_details[0]['youtube']))
										echo ' <li><a href="'.$frontend_details[0]['youtube'].'" class="edu_social_icon" target="_blank"><i class="fab fa-youtube"></i></a></li>';

									// if(!empty($frontend_details[0]['twitter']))
									// 	echo ' <li><a href="'.$frontend_details[0]['twitter'].'" class="edu_social_icon" target="_blank"><i class="fab fa-twitter"></i></a></li>';

									if(!empty($frontend_details[0]['instagram']))
										echo ' <li><a href="'.$frontend_details[0]['instagram'].'" class="edu_social_icon" target="_blank"><i class="fab fa-instagram"></i></a></li>';

									// if(!empty($frontend_details[0]['linkedin']))
									// 	echo ' <li><a href="'.$frontend_details[0]['linkedin'].'" class="edu_social_icon" target="_blank"><i class="fab fa-linkedin"></i></a></li>';
									?>
                                </ul>
							</div>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
							<div class="edu_header_info">
								<ul>
									<li>
										<?php
										if(!empty($frontend_details[0]['email']))
											echo '<a href="mailto:'.$frontend_details[0]['email'].'"><i class="fas fa-envelope"></i>'.$frontend_details[0]['email'].'</a>';
										else
											echo '<a href="mailto:example@email.com"><i class="fas fa-envelope"></i>example@email.com</a>';
										?>
									</li>
									<li>
										<?php
										if(!empty($frontend_details[0]['mobile']))
											echo '<a href="tel:+'.$frontend_details[0]['mobile'].'"><i class="fas fa-phone-volume"></i>'.$frontend_details[0]['mobile'].'</a>';
										else
											echo '<a href="tel:+91 9999999999"><i class="fas fa-phone-volume"></i>+91 9999999999</a>';
										?>
									</li>
									<li>
									  <?php if(!empty($_SESSION['role'])){ ?>
									    <a href="javascript:void(0);" title="<?php echo html_escape($this->common->languageTranslator('ltr_logout')); ?>" class="cnfmlogOutBtn"><i class="icofont-logout"></i><span><?php echo html_escape($this->common->languageTranslator('ltr_logout')); ?></span></a>
									  <?php }else{ ?>
										<a href="<?php echo base_url('login');?>"><i class="fas fa-sign-in-alt"></i><?php echo html_escape($this->common->languageTranslator('ltr_login')); ?></a>
									<?php } ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="edu_header_wrapper">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-lg-3 col-md-4 col-sm-4 col-10">
							<div class="edu_logo">
								<a href="<?php echo base_url();?>"><img class="front_logo" src="<?php echo html_escape($this->common->siteLogo); ?>" alt="logo" /></a>
							</div>
						</div>
						<div class="col-lg-9 col-md-8 col-sm-8 col-2">
							<div class="edu_main_menu main_menu_parent">
								<!----- Header Menus ----->
								<div class="edu_nav_items main_menu_wrapper text-right">
									<ul>
										<li><a href="<?php echo base_url();?>">Beranda</a></li>
										<li><a href="<?php echo base_url('about-us');?>">Profil</a></li>
										<li><a href="<?php echo base_url('courses-offered');?>">Course Kami</a></li>
										<!-- <li><a href="<?php echo base_url('blog');?>">Blog</a></li> -->
										<li class="has_submenu">
											<a href="javascript:void(0);">Galeri</a>
											<ul class="sub_menu">
												<li><a href="<?php echo base_url('gallery');?>">Foto</a></li>
												<li><a href="<?php echo base_url('video-gallery');?>">Video</a></li>
											</ul>
										</li>
										<li><a href="<?php echo base_url('facilities');?>">Fasilitas</a></li>
										<li><a href="<?php echo base_url('contact-us');?>">Kontak Kami</a></li>
									</ul>
								</div>
								<div class="menu_btn_wrap">
								<?php 
								if(!empty($frontend_details[0]['header_btn_txt']) && !empty($frontend_details[0]['header_btn_url'])){
									echo '<a class="edu_btn" href="'.$frontend_details[0]['header_btn_url'].'">'.$frontend_details[0]['header_btn_txt'].'</a>';
								}
								?>
									<a href="javascript:void(0);" class="menu_btn">
										<span></span>
										<span></span>
										<span></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>