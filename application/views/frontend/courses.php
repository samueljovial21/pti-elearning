<!----- Page Title Start ----->
		<section class="edu_page_title_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_page_title_text">
							<h1><?php echo html_escape($this->common->languageTranslator('ltr_courses_offered'));?></h1>
							<ul>
								<li><a href="<?php echo base_url();?>"><?php echo html_escape($this->common->languageTranslator('ltr_home'));?></a></li>
								<li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_courses_offered'));?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Course Info Section Start ----->
		<section class="edu_courseInfo_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 col-md-7 col-sm-12 col-12">
						<div class="edu_courseInfo_detail mb_30">
							<h4 class="edu_subTitle"><?php echo !empty($frontend_details[0]['frst_crse_sub_heading'])?$frontend_details[0]['frst_crse_sub_heading']:'E-Academy';?></h4>
							<h2 class="edu_heading"><?php $tt =html_escape($this->common->languageTranslator('ltr_online_learning')); echo !empty($frontend_details[0]['frst_crse_heading'])?$frontend_details[0]['frst_crse_heading']: $tt;?></h2>
							<p><?php $ttt =html_escape($this->common->languageTranslator('ltr_officia_deserunt')); echo !empty($frontend_details[0]['frst_crse_desc'])?$frontend_details[0]['frst_crse_desc']: $ttt;?></p>
						</div>
					</div>
					<?php
						$totalCourse = $this->db_model->countAll('courses use index (id)');
					?>
					<div class="col-lg-5 col-md-5 col-sm-12 col-12">
						<div class="edu_courseInfo_box relative mb_30">
							<img src="<?php echo base_url(); ?>assets/images/course.png" alt=""/>
							<p><?php if($batches) {echo count($batches);}else echo "0 "; ?>+ <?php echo html_escape($this->common->languageTranslator('ltr_courses'));?></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Courses Section ----->
		<section class="edu_courses_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_heading_wrapper">
							<h4 class="edu_subTitle"><?php $ttd =html_escape($this->common->languageTranslator('ltr_enhance')); echo !empty($frontend_details[0]['sec_crse_sub_heading'])?$frontend_details[0]['sec_crse_sub_heading']: $ttd;?></h4>
							<h4 class="edu_heading"><?php $cttd =html_escape($this->common->languageTranslator('ltr_our_courses')); echo !empty($frontend_details[0]['sec_crse_heading'])?$frontend_details[0]['sec_crse_heading']:$cttd ;?></h4>
							<img src="<?php echo base_url();?>assets/images/border.png" alt=""/>
						</div>
					</div>
				</div>
			</div>
			
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 padder0">
						<div class="edu_courses_section">
							<div class="row">
							<?php 
							if(!empty($batches)){
							    
								foreach($batches as $value){
									?>
									<div class="col-lg-4 col-md-4 col-sm-6 col-12">
										<div class="edu_courses_box">
											<div class="edu_courses_imgbox">
												<img src="<?php if(!empty($value['batch_image'])) { echo base_url('uploads\batch_image/').$value['batch_image'] ; }else{ echo base_url('uploads/site_data/'.$site_Details['0']['site_logo']); } ?>" alt="image">
												<a href="<?php echo base_url('enroll-now/'.$value['id']); ?>" class="courses_atc"><?php echo html_escape($this->common->languageTranslator('ltr_enroll_now'));?></a>
												<a href="<?php echo base_url('enroll-now/'.$value['id']); ?>" class="edu_btn courses_price"><?php if($value['batch_type']==2){ if(!empty($value['batch_offer_price'])){ echo '<s>'.$currency_decimal.' '.$value['batch_price'].'</s> / '.$currency_decimal.' '.$value['batch_offer_price']; }else{ echo $currency_decimal.' '.$value['batch_price'];} }else{ echo "Free";} ?></a>
												<?php if(!empty($value['batch_offer_price'])){ ?>
												<span class="edu_courses_flag"><?php echo html_escape($this->common->languageTranslator('ltr_offer')); ?></span>
												<?php } ?>
											</div>
											<div class="edu_courses_cntnbox ">
											<h2 class="edu_courses_title text-white"><?php echo $value['batch_name'];?></h2>
											<p class="edu_courses_des text-white"><?php echo $value['description']; ?></p>
											<a href="<?php echo base_url('courses-details/'.$value['id']); ?>" class="edu_courses_view mt-2"><?php echo html_escape($this->common->languageTranslator('ltr_course_view'));?> <i class="fas fa-long-arrow-alt-right pl-1"></i></a> 
											</div>
										</div>
									</div>
									<?php
								}
							}
							else{
							?>
            					<!--<div class="col-lg-4 col-md-4 col-sm-6 col-12">-->
            					<!--	<div class="edu_courses_box">-->
            					<!--		<div class="edu_courses_imgbox">-->
            					<!--		    <img src="http://themes91.in/ci/e-academy_test/assets/images/course01.jpg" alt="image">-->
            					<!--		    <a href="#" class="courses_atc"><?php echo html_escape($this->common->languageTranslator('ltr_add_to_cart'));?></a>-->
            					<!--		    <a href="#" class="edu_btn courses_price"><?php echo html_escape($this->common->languageTranslator('ltr_course_price'));?></a>-->
            					<!--		    <span class="edu_courses_flag"><?php echo html_escape($this->common->languageTranslator('ltr_best_seller'));?></span>-->
            					<!--	    </div>-->
            					<!--	    <div class="edu_courses_cntnbox">-->
            					<!--	    <div class="edu_courses_rwrap">-->
                	<!--					    <ul class="edu_courses_rating">-->
                	<!--					        <li><img src="http://themes91.in/ci/e-academy_test/assets/images/star.svg" alt="image"></li>-->
                	<!--					        <li><img src="http://themes91.in/ci/e-academy_test/assets/images/star.svg" alt="image"></li>-->
                	<!--					        <li><img src="http://themes91.in/ci/e-academy_test/assets/images/star.svg" alt="image"></li>-->
                	<!--					        <li><img src="http://themes91.in/ci/e-academy_test/assets/images/blank_star.svg" alt="image"></li>-->
                	<!--					        <li><img src="http://themes91.in/ci/e-academy_test/assets/images/blank_star.svg" alt="image"></li>-->
                	<!--					        <li><img src="http://themes91.in/ci/e-academy_test/assets/images/blank_star.svg" alt="image"></li>-->
                	<!--					    </ul>-->
                	<!--					    <p class="edu_courses_rno"><span><?php echo html_escape($this->common->languageTranslator('ltr_course_rating'));?></span> <?php echo html_escape($this->common->languageTranslator('ltr_course_rati_no'));?></p>-->
                	<!--					</div>-->
            					<!--		<h2 class="edu_courses_title"><?php echo html_escape($this->common->languageTranslator('ltr_course_title'));?></h2>-->
            					<!--		<p class="edu_courses_des"><?php echo html_escape($this->common->languageTranslator('ltr_course_des'));?></p>-->
            					<!--		<a href="" class="edu_courses_view mt-2"><?php echo html_escape($this->common->languageTranslator('ltr_course_view'));?> <i class="fas fa-long-arrow-alt-right pl-1"></i></a> -->
            					<!--	    </div>-->
            					<!--	</div>-->
            					<!--</div>-->
							<?php } ?>
            				</div>
						</div>
					</div>
				</div>
			</div>
	
		</section>
		
		
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