<!----- Banner Wraapper ----->
		<section class="edu_banner_wrapper relative">
			<div class="swiper-container homeBannerSlider">
				<div class="swiper-wrapper">
				<?php 
					if(!empty($frontend_details[0]['slider_details'])){
						$sliders = json_decode($frontend_details[0]['slider_details'],true);
					}else{
						$sliders = '';
					}

					if(!empty($sliders)){
						for($i=0;$i<count($sliders['slider_heading']);$i++){
					?>
					<div class="swiper-slide">
						<div class="innerSliderWrap">
							<div class="edu_banner_section" style="background-image:url(<?php echo !empty($sliders['slider_img'][$i])?base_url('uploads/site_data/').$sliders['slider_img'][$i]:base_url('uploads/site_data/').'assets/images/slider1.png';?>)">
								<div class="container-fluid">
									<div class="row justify-content-center">
										<div class="col-xl-8 col-lg-10 col-md-10 col-sm-12 col-12 text-center">
											<div class="edu_banner_text">
											<?php 
												if(isset($sliders['slider_subheading']) && !empty($sliders['slider_subheading'][$i])){
													echo '<h4 class="edu_subTitle animation_ttl1">'.$sliders['slider_subheading'][$i].'</h4>';
												}
												?>
												<h1 class="animation_ttl2"><?php echo !empty($sliders['slider_heading'][$i])?$sliders['slider_heading'][$i]:'Choose Best for your Education';?></h1>
												<p  class="animation_ttl2"><?php echo !empty($sliders['slider_desc'][$i])?$sliders['slider_desc'][$i]:'';?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
						}
					}
					?>
				</div>
			</div>
			<!----- Slider Arrows ----->
			<div class="edu_banner_button">
				<div class="ButtonNext"><span class="icofont-simple-right"></span></div>
				<div class="ButtonPrev"><span class="icofont-simple-left"></span></div>
			</div>
		</section>
		<!----- Call To Action Start ----->
		<section class="edu_callToAction_wrapper"> 
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="edu_callToAction_bg">
							<div class="edu_callToAction_bg_inner">
								<div class="col-lg-4 col-md-4 col-sm-12 col-12 p-0 text-center">
									<div class="edu_action_section counter_item">
										<i class="fas fa-user-graduate"></i>
										<h1><span class="count_no" data-to="<?php echo !empty($frontend_details[0]['total_toppers'])?$frontend_details[0]['total_toppers']:'654';?>" data-speed="3000"><?php echo !empty($frontend_details[0]['total_toppers'])?$frontend_details[0]['total_toppers']:'654';?></span><span>+</span></h1>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_our_toppers'));?></p>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-12 p-0 text-center">
									<div class="edu_action_section counter_item center">
										<i class="fas fa-users"></i>
										<h1><span class="count_no" data-to="<?php echo !empty($frontend_details[0]['trusted_students'])?$frontend_details[0]['trusted_students']:'156';?>" data-speed="3000"><?php echo !empty($frontend_details[0]['trusted_students'])?$frontend_details[0]['trusted_students']:'156';?></span><span>+</span></h1>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_trusted_teachers'));?></p>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-12 col-12 p-0 text-center">
									<div class="edu_action_section counter_item">
										<i class="fas fa-award"></i>
										<h1><span class="count_no" data-to="<?php echo !empty($frontend_details[0]['years_of_histry'])?$frontend_details[0]['years_of_histry']:'18';?>" data-speed="3000"><?php echo !empty($frontend_details[0]['years_of_histry'])?$frontend_details[0]['years_of_histry']:'18';?></span><span>+</span></h1>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_years_of_history'));?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- About Section Start ----->
		<section class="edu_about_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="edu_about_img relative mb_30">
							<img class="edu_about_big_img parallax" src="<?php echo !empty($frontend_details[0]['abt_frst_img'])?base_url('uploads/site_data/').$frontend_details[0]['abt_frst_img']:base_url('uploads/site_data/').'assets/images/about_img1.png';?>" alt=""/>
							<img class="edu_about_small_img parallax" src="<?php echo !empty($frontend_details[0]['abt_sec_img'])?base_url('uploads/site_data/').$frontend_details[0]['abt_sec_img']:base_url('uploads/site_data/').'assets/images/about_img2.png';?>" alt=""/>
							<span class="edu_about_time"><?php echo html_escape($this->common->languageTranslator('ltr_since'));?><?php echo !empty($frontend_details[0]['abt_year'])?$frontend_details[0]['abt_year']:'1995';?></span>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="edu_about_detail mb_30">
							<h4 class="edu_subTitle"><?php $hh = html_escape($this->common->languageTranslator('ltr_about_eacademy')); echo !empty($frontend_details[0]['abt_frst_sub_heading'])?$frontend_details[0]['abt_frst_sub_heading']: $hh;?></h4>
							<h2 class="edu_heading"><?php $hhd = html_escape($this->common->languageTranslator('ltr_home_thousands')); echo !empty($frontend_details[0]['abt_frst_heading'])?$frontend_details[0]['abt_frst_heading']:$hhd; ?></h2>
							<p class="mb-3"><?php $hhdt = html_escape($this->common->languageTranslator('ltr_home_text')); echo !empty($frontend_details[0]['abt_frst_desc'])?$frontend_details[0]['abt_frst_desc']:$hhdt;?></p>
							<a href="<?php echo base_url('about-us');?>" class="edu_btn"><?php echo html_escape($this->common->languageTranslator('ltr_read_more'));?></a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Service Section Start ----->
		<section class="edu_services_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_heading_wrapper">
							<h4 class="edu_subTitle"><?php echo !empty($frontend_details[0]['faci_sub_heading'])?$frontend_details[0]['faci_sub_heading']:'E-Academy';?></h4>
							<h4 class="edu_heading"><?php $hhdg = html_escape($this->common->languageTranslator('ltr_our_facilities')); echo !empty($frontend_details[0]['faci_heading'])?$frontend_details[0]['faci_heading']:$hhdg ;?></h4>
							<img src="<?php echo base_url(); ?>assets/images/border.png" alt=""/>
						</div>
					</div>
					<?php
						if(!empty($frontend_details[0]['faci_heading']) && 6 > 0){
							if(!empty($Allfacilities)){
								foreach($Allfacilities as $facility){ ?>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12 text-center">
										<div class="edu_services_section">
											<div class="edu_services_section_inner">
												<i class="<?php echo html_escape($facility['icon']);?>"></i>
												<h4><?php echo html_escape($facility['title']);?></h4>
												<p><?php echo html_escape($facility['description']);?></p>
											</div>
										</div>
									</div>
								<?php 
								}
							}
						}
					?>
				</div>
			</div>
		</section>					
		<!----- Selection Section Start ----->
		<?php 
		if(!empty($frontend_details[0]['selection'])){
			$selection = json_decode($frontend_details[0]['selection'],true);
			$newSeleArr = array_chunk($selection, 3,true);
			
			if(count($selection)>=3){
			?>
		<section class="edu_selection_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_heading_wrapper">
							<h4 class="edu_subTitle"><?php $top = html_escape($this->common->languageTranslator('ltr_toppers_here')); echo !empty($frontend_details[0]['selectn_subheading'])?$frontend_details[0]['selectn_subheading']:$top ;?></h4>
							<h4 class="edu_heading"><?php $topd = html_escape($this->common->languageTranslator('ltr_our_selections')); echo !empty($frontend_details[0]['selectn_heading'])?$frontend_details[0]['selectn_heading']: $topd ;?></h4>
							<img src="<?php echo base_url();?>assets/images/border.png" alt=""/>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="row extraMargin">
							<div class="edu_selection_slider">
								<div class="swiper-container selectionSlider">
									<div class="swiper-wrapper">
										<?php 
										$ltr_designation = html_escape($this->common->languageTranslator('ltr_designation'));
										foreach($newSeleArr as $select){
											echo '<div class="swiper-slide">
											<div class="row">';
											foreach($select as $key => $value){
											    $student_d = $this->db_model->select_data('name ,image','students use index (id)',array('status'=>1,'id'=>$key));
												if(!empty($student_d)){
    												echo '<div class="col-lg-4 col-md-6 col-sm-12 col-12">
    												<div class="edu_selection_section">
    													<div class="edu_selection_cap">
    														<i class="fas fa-graduation-cap"></i>
    													</div>
    													<div class="edu_selection_cap">
    														<i class="fas fa-graduation-cap"></i>
    													</div>
    													<div class="edu_selection_section_inner">
    														'.(!empty($student_d[0]['image'])?'<img src="'.base_url('uploads/students/').$student_d[0]['image'].'" alt="" />':'').
    														'<div class="edu_selection_info">
    															<a href="javascript:void(0);"><h4>'.$student_d[0]['name'].'</h4></a>
    															<p>'.$ltr_designation.' <span>'.$value.'</span></p>
    														</div>
    													</div>
    												</div>
    											</div>';
												}
											}
											echo '</div>
											</div>';
										}
										?>
									</div>
								</div>
								<!----- Selection Bullets ----->
								<div class="swiperPagination"></div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</section>
		<?php }
		   } ?>
		<!----- Courses Section ----->
		<section class="edu_courses_wrapper edu_courses_main">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_heading_wrapper">
							<h4 class="edu_subTitle"><?php $ltr_enhance = html_escape($this->common->languageTranslator('ltr_enhance')); echo !empty($frontend_details[0]['sec_crse_sub_heading'])?$frontend_details[0]['sec_crse_sub_heading']:$ltr_enhance ;?></h4>
							<h4 class="edu_heading white"><?php $ltr_our_courses = html_escape($this->common->languageTranslator('ltr_our_courses')); echo !empty($frontend_details[0]['sec_crse_heading'])?$frontend_details[0]['sec_crse_heading']:$ltr_our_courses;?></h4>
							<img src="<?php echo base_url();?>assets/images/border.png" alt=""/>
						</div>
					</div>
				</div>
			</div>
			<?php if(!empty($frontend_details[0]['sec_crse_heading']) && 6 > 0){ ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
						<div class="edu_courses_section">
							<ul class="nav nav-tabs" role="tablist">
							<?php
							    $ltr_our_courses = html_escape($this->common->languageTranslator('ltr_active'));
								$tabContent = '';
								//print_r($Allcourses);
								if(!empty($batches)){
									$i = 1;
									foreach($batches as $crs){ 
										if($i == 1){
											$activeMenu = 'active';
											$activeCont = 'in active show';
										}else{
											$activeMenu = '';
											$activeCont = '';
										}	
										
										if($crs['batch_type']==2){ 
											if(!empty($crs['batch_offer_price'])){ 
												$of_val= '<s>'.$currency_decimal.' '.$crs['batch_price'].'</s> / '.$currency_decimal.' '.$crs['batch_offer_price']; 
												$offer='<span class="edu_courses_flag">'.html_escape($this->common->languageTranslator('ltr_offer')).'</span>';
											}else{ 
												$of_val= $currency_decimal.' '.$crs['batch_price'];
												$offer="";
											}
										}else{ 
											$of_val= "Free";
												$offer="";

										} 
										echo '<li class="nav-item">
										<a class="nav-link '.$activeMenu.'" href="#courseType'.$i.'" role="tab" data-toggle="tab">
											<span class="edu_tab_icons">
												'.$crs['batch_name'].'
											</span>
										</a>
									</li>';?>
                                        
									<?php $tabContent .= '<div role="tabpanel" class="tab-pane fade '.$activeCont.'" id="courseType'.$i.'">
									<div class="edu_courses_content">
										<div class="edu_courses_content_inner">
											<div class="row">
												<div class="col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="edu_courses_img relative">
													'.$offer.'
														<a href="'.base_url('courses-details/'.$crs['id']).'"><div class="edu_courses_img_holder">
															<img src="'.base_url('uploads\batch_image/').$crs['batch_image'].'" alt=""/>
														</div></a>
													</div>
												</div>
												<div class="col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="edu_courses_detail">
														<h4><a href="'.base_url('courses-details/'.$crs['id']).'">'.$crs['batch_name'].'</a></h4>
														<p>'.$crs['description'].'</p>
														<ul>
															
															<li>
																<span class="edu_course_info_icon">
																	<a href="'.base_url('enroll-now/'.$crs['id']).'" class="edu_course_price ">'.$of_val.'</a>
																</span>
																
															</li>
															<li><span class="edu_course_info_icon">
																<a href="'.base_url('enroll-now/'.$crs['id']).'" class="edu_btn ">'.html_escape($this->common->languageTranslator('ltr_enroll_now')).'</a>
																</span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>';

								$i++;
								}
							}?>
							<li class="nav-item">
										<a class="nav-link " href="<?=base_url('courses-offered')?>">
											<span class="edu_tab_icons">
											More Courses
											</span>
										</a>
									</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="edu_courses_section">
							<div class="tab-content">
								<?php echo  $tabContent; ?>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<?php } ?>
		</section>
		<!----- Team Section Start ----->
		<?php 
		$teachers = $this->db_model->select_data('*','users use index (id)',array('status'=>1,'role'=>3,'parent_id'=>1),$frontend_details[0]['no_of_teacher']);
		if(!empty($teachers) ){							
		?>
		<section class="edu_team_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_heading_wrapper">
							<h4 class="edu_subTitle"><?php echo !empty($frontend_details[0]['teacher_subheading'])?$frontend_details[0]['teacher_subheading']:'Our Experts';?></h4>
							<h4 class="edu_heading"><?php echo !empty($frontend_details[0]['teacher_heading'])?$frontend_details[0]['teacher_heading']:'Qualified Teachers';?></h4>
							<img src="<?php echo base_url();?>assets/images/border.png" alt=""/>
						</div>
					</div>
				</div>
				<div class="row extraMargin">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
						<div class="team_slider swiper-container">
							<div class="swiper-wrapper">
							<?php
								if(!empty($frontend_details[0]['no_of_teacher']) && $frontend_details[0]['no_of_teacher'] > 0){
									if(!empty($teachers)){
									    $tc=0;
										foreach($teachers as $teach_r){ ?>
											<div class="swiper-slide">
												<div class="edu_team_section">
													<div class="edu_team_img">
														<img src="<?php echo base_url('uploads/teachers/').$teach_r['teach_image'];?>" alt=""/>
													</div>
													<div class="edu_team_identity text-center">
														<a href="javascript:void(0);"><?php echo html_escape($teach_r['name']);?></a>
														<h6><?php echo html_escape($teach_r['teach_education']);?></h6>
													</div>
												</div>
											</div>
											<?php
										$tc++;
										}
									}
								}
							?>
							</div>
						</div>
						<div class="swiperTeamPagination"></div>
					</div>
				</div>
			</div>
		</section>
		<?php } ?>
		<!----- Testimonial Section ----->
		<?php if(!empty($frontend_details[0]['testimonial'])){
					$testimonial = json_decode($frontend_details[0]['testimonial'],true);
				?>
		<section class="edu_testimonial_wrapper">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_heading_wrapper">
							<h4 class="edu_subTitle"><?php echo !empty($frontend_details[0]['testi_subheading'])?$frontend_details[0]['testi_subheading']:'E- Academy Reviews';?></h4>
							<h4 class="edu_heading"><?php echo !empty($frontend_details[0]['testi_heading'])?$frontend_details[0]['testi_heading']:'What Student Says';?></h4>
							<img src="<?php echo base_url(); ?>assets/images/border.png" alt=""/>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="edu_testimonials_section">
							<div class="swiper-container testimonial_slider">
								<div class="swiper-wrapper">
									<?php 
									foreach($testimonial as $key => $value){
										$st_nameImg = explode('--',$key);
								        $student_dt = $this->db_model->select_data('name ,image','students use index (id)',array('status'=>1,'id'=>$key));
                                        if(!empty($student_dt)){
										echo '<div class="swiper-slide">
										<div class="edu_testimonial_section">
											<div class="edu_client_img">
												<span class="edu_testimonial_icon">
													<i class="icofont-quote-left"></i>
												</span>';
												if(!empty($student_dt[0]['image'])){
													echo '<img src="'.base_url('uploads/students/').$student_dt[0]['image'].'" alt=""/>';
												}
												echo '<div class="edu_client_quote">
													<h4>'.$student_dt[0]['name'].'</h4>
												</div>
											</div>
											<p>'.$value.' </p>
										</div>
									</div>';
                                        }
									}
									?>
								</div>
							</div>
							<!----- Slider Dots ----->
							<div class="swiperTestimonialPagination"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		} ?>
		<!----- Partner Start ----->
		<?php if(!empty($frontend_details[0]['client_imgs'])){?>
		<section class="edu_partner_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="partner_slider swiper-container">
							<div class="swiper-wrapper">
								<?php
								$clients = json_decode($frontend_details[0]['client_imgs'],true);
								foreach($clients as $cln){
									echo '<div class="swiper-slide">
										<div class="edu_partners_container mb_30 text-center">
											<a href="javascript:void(0);"><img src="'.base_url('uploads/site_data/').$cln.'" alt=""/></a>
										</div>
									</div>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php } ?>
	</section>