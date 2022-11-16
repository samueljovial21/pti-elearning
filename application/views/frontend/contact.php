<!----- Page Title Start ----->
		<section class="edu_page_title_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_page_title_text">
							<h1>Kontak Kami</h1>
							<ul>
								<li><a href="<?php echo base_url();?>"><?php echo html_escape($this->common->languageTranslator('ltr_home'));?></a></li>
								<li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_contact_us'));?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Contact Section Start ----->
		<section class="edu_contact_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_heading_wrapper">
							<h4 class="edu_subTitle"><?php echo !empty($frontend_details[0]['cont_sub_heading'])?$frontend_details[0]['cont_sub_heading']:'START WITH US';?></h4>
							<h4 class="edu_heading"><?php echo !empty($frontend_details[0]['cont_heading'])?$frontend_details[0]['cont_heading']:'Contact Us for Your Query';?></h4>
							<img src="<?php echo base_url(); ?>assets/images/border.png" alt=""/>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center" onclick="window.open('https://wa.me/6281379523955', '_blank');">
						<div class="edu_contact_section">
							<div class="edu_contact_section_inner">
								<i class="icofont-ui-dial-phone"></i>
								<h4><?php echo html_escape($this->common->languageTranslator('ltr_contact_no'));?></h4>
								<?php
								if(!empty($frontend_details[0]['mobile']))
									echo '<a href="tel:+'.$frontend_details[0]['mobile'].'">'.$frontend_details[0]['mobile'].'</a>';
								else
									echo '<a href="tel:+91 9999999999">+91 9999999999</a>';
								?>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center" onclick="window.open('https://maps.app.goo.gl/oPrEdc6vjPJdJcRc7', '_blank');">
						<div class="edu_contact_section">
							<div class="edu_contact_section_inner">
								<i class="icofont-map-pins"></i>
								<h4>Alamat kami</h4>
								<?php
								if(!empty($frontend_details[0]['address']))
									echo '<a>'.$frontend_details[0]['address'].'</a>';
								else
									echo '<a>04 A, Agroha Nagar, Dewas, Madhya Pradesh 455001</a>';
								?>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center">
						<div class="edu_contact_section">
							<div class="edu_contact_section_inner">
								<i class="icofont-email"></i>
								<h4><?php echo html_escape($this->common->languageTranslator('ltr_email_us_on'));?></h4>
								<?php
								if(!empty($frontend_details[0]['email']))
									echo '<a href="mailto:'.$frontend_details[0]['email'].'">'.$frontend_details[0]['email'].'</a>';
								else
									echo '<a href="mailto:example@email.com">example@email.com</a>';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Map Section Start ----->
		<section class="edu_map_wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
						<div class="edu_map_container">
							<?php
								if(!empty($frontend_details[0]['address']) && !empty($frontend_details[0]['map_api']))
									echo '<iframe src="https://www.google.com/maps/embed/v1/place?key='.$frontend_details[0]['map_api'].'&q='.urlencode($frontend_details[0]['address']).'" class="embed-responsive-item" frameborder="0" allowfullscreen></iframe>';
								else
									echo '';
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!----- Contact Form Section Start ----->
		<!-- <section class="edu_form_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
						<div class="edu_form_container <?php echo (empty($frontend_details[0]['map_api']))?'withoutMapFrm':'';?>">
							<h4><?php $ltr_send_message = html_escape($this->common->languageTranslator('ltr_send_message')); echo !empty($frontend_details[0]['cont_form_heading'])?$frontend_details[0]['cont_form_heading']: $ltr_send_message;?></h4>
							<input type="hidden" value="<?php echo base_url()?>" id="baseUrlId">
							<form method="post">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="edu_field_holder">
											<input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_name'));?> *" name="name">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="edu_field_holder">
											<input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_email'));?> *" data-valid="email" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_enter_your_email'));?>" name="email">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="edu_field_holder">
											<input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_subject'));?> *" name="subject">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="edu_field_holder">
											<input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_phone'));?> *" data-valid="mobile" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_enter_your_phone'));?>" name="mobile" maxlength="12">
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="edu_field_holder">
											<textarea placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_message'));?> *" class="edu_form_field require" name="message"></textarea>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<button type="button" class="edu_btn enquiryFormSubmit"><?php echo html_escape($this->common->languageTranslator('ltr_submit'));?></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section> -->
	</section>