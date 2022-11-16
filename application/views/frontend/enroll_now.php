<!----- Page Title Start ----->
		<section class="edu_page_title_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<div class="edu_page_title_text">
							<h1><?php echo html_escape($this->common->languageTranslator('ltr_enroll_now'));?></h1>
							<ul>
								<li><a href="<?php echo base_url();?>"><?php echo html_escape($this->common->languageTranslator('ltr_home'));?></a></li>
								<li><a href="javascript:void(0);"><?php echo html_escape($this->common->languageTranslator('ltr_enroll_now'));?></a></li>
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
							<h4 class="edu_heading"><?php echo !empty($frontend_details[0]['cont_heading'])?$frontend_details[0]['cont_heading']:'Sign Up with, E-academy';?></h4>
							<img src="<?php echo base_url(); ?>assets/images/border.png" alt=""/>
						</div>
					</div>
					
				</div>
			</div>
		</section>
		<!----- Contact Form Section Start ----->
		<section class="edu_form_wrapper">
			<div class="container">
				<div class="row"> 
			
					<div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
						<div class="edu_form_container withoutMapFrm">
							<h4><?php echo html_escape($this->common->languageTranslator('ltr_sign_purchase'));?></h4>
							<input type="hidden" value="<?php echo base_url()?>" id="baseUrlId">
							<form method="post">
								<?php
							//	print_r($singel_batches);
    								if($singel_batches){
    								    ?>
    								        <input type="hidden" name="batchId" value="<?php echo $singel_batches[0]['id'] ;?>" id="batchId">
    							    	<?php 
								    }
								?>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="edu_field_holder">
										    <lable><?php echo html_escape($this->common->languageTranslator('ltr_name'));?> *</lable>
											<input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_name'));?> *" name="name" >
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="edu_field_holder">
										    <lable><?php echo html_escape($this->common->languageTranslator('ltr_email'));?> *</lable>
											<input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_email'));?> *" data-valid="email" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_enter_your_email'));?>" name="email">
										</div>
									</div>
									
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="edu_field_holder">
										    <lable><?php echo html_escape($this->common->languageTranslator('ltr_mobile_number'));?> *</lable>
											<input type="text" class="edu_form_field require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enter_your_phone'));?> *" data-valid="mobile" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_enter_your_phone'));?>" name="mobile" maxlength="12">
										</div>
									</div>
									
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<button type="button" class="edu_btn enrollNowSubmit"><?php echo html_escape($this->common->languageTranslator('ltr_submit'));?></button>
									</div>
								</div>
							</form> 
							<div id="paymentDetails"> </div>							
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>