<!----- Page Title Start ----->
		<section class="edu_page_title_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_page_title_text">
							<h1><?php echo html_escape($this->common->languageTranslator('ltr_about_us'));?></h1>
							<ul>
								<li><a href="<?php echo base_url();?>"><?php echo html_escape($this->common->languageTranslator('ltr_home'));?></a></li>
								<li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_about_us'));?></a></li>
							</ul>
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
							<span class="edu_about_time"><?php echo html_escape($this->common->languageTranslator('ltr_since'));?> <?php echo !empty($frontend_details[0]['abt_year'])?$frontend_details[0]['abt_year']:'1995';?></span>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="edu_about_detail mb_30">
							<h4 class="edu_subTitle"><?php echo !empty($frontend_details[0]['abt_frst_sub_heading'])?$frontend_details[0]['abt_frst_sub_heading']:'About E-Academy';?></h4>
							<h2 class="edu_heading"><?php echo !empty($frontend_details[0]['abt_frst_heading'])?$frontend_details[0]['abt_frst_heading']:'Why Choose Us From thousands';?></h2>
							<p class="mb-3"><?php echo !empty($frontend_details[0]['abt_frst_desc'])?$frontend_details[0]['abt_frst_desc']:'Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eesdoeit dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation and in ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
							Excepteur sint occaecat cupidatat noesn proident sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut peerspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantiuws totam rem aperiam, eaque ipsa quae.';?></p>
						</div>
					</div>
				</div> 
			</div>
		</section>
		<!----- Mission Section Start ----->
		<section class="edu_mission_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 col-md-12 col-sm-12 col-12 text-center offset-lg-1">
						<div class="edu_mission_text">
							<h1 class="white"><?php echo !empty($frontend_details[0]['abt_sec_heading'])?$frontend_details[0]['abt_sec_heading']:'We take care of your Careers Do not worry';?></h1>
							<h6 class="white"><?php echo !empty($frontend_details[0]['abt_sec_desc'])?$frontend_details[0]['abt_sec_desc']:'we are very cost friendly and we would love to be a part of your home happiness for a long Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod.';?></h6>
							<a href="<?php echo !empty($frontend_details[0]['abt_secbtn_url'])?$frontend_details[0]['abt_secbtn_url']:base_url('contact-us');?>" class="edu_btn edu_white_btn"><?php echo !empty($frontend_details[0]['abt_secbtn_text'])?$frontend_details[0]['abt_secbtn_text']:'Contact Us';?></a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Vission Section Start ----->
		<section class="edu_vission_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="edu_vission_detail mb_30">
							<h4 class="edu_subTitle"><?php echo !empty($frontend_details[0]['abt_thrd_sub_heading'])?$frontend_details[0]['abt_thrd_sub_heading']:'Our Mission';?></h4>
							<h2 class="edu_heading"><?php echo !empty($frontend_details[0]['abt_thrd_heading'])?$frontend_details[0]['abt_thrd_heading']:'Why Choose Us';?></h2>
							<p class="mb-3"><?php echo !empty($frontend_details[0]['abt_thrd_desc'])?$frontend_details[0]['abt_thrd_desc']:'Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore eesdoeit dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation and in ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
							<p>Excepteur sint occaecat cupidatat noesn proident sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut peerspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantiuws totam rem aperiam, eaque ipsa quae.';?></p>
						</div>
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="edu_vission_img relative mb_30">
							<img class="edu_vission_big_img parallax" src="<?php echo !empty($frontend_details[0]['abt_thrd_img'])?base_url('uploads/site_data/').$frontend_details[0]['abt_thrd_img']:base_url('uploads/site_data/').'assets/images/vission_img.png';?>" alt=""/>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>