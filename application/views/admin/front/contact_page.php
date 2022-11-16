<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_contant_setting_wrapper">
		<div class="pxn_admin_informationdiv edu_main_wrapper">
			<form class="pxn_amin" method="post">
				<div class="edu_contact_form_wrapper edu_from_wrapper">
					<div class="row">
					    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
							    <input type="text" class="form-control require" name="cont_heading" value="<?php echo !empty($contact_Details)?$contact_Details['0']['cont_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
							    <input type="text" class="form-control" name="cont_sub_heading" value="<?php echo !empty($contact_Details)?$contact_Details['0']['cont_sub_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_form_heading'));?><sup>*</sup></label>
							    <input type="text" class="form-control require" name="cont_form_heading" value="<?php echo !empty($contact_Details)?$contact_Details['0']['cont_form_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_form_heading'));?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_mobile_number'));?><sup>*</sup></label>
							    <input type="text" data-valid="mobile" data-error="Please enter a valid mobile number." class="form-control require" name="mobile" value="<?php echo !empty($contact_Details)?$contact_Details['0']['mobile']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_mobile_number'));?>" maxlength="12">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_email'));?><sup>*</sup></label>
							    <input type="text" data-valid="email" data-error="Please enter a valid email." class="form-control require" name="email" value="<?php echo !empty($contact_Details)?$contact_Details['0']['email']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_email'));?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_facebook'));?></label>
							    <input type="text" class="form-control" name="facebook" value="<?php echo html_escape($contact_Details['0']['facebook']);?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_facebook'));?>" data-valid="url" data-error="Please use http or https in URL." data-symb="no">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_you_tube'));?></label>
							    <input type="text" class="form-control" name="youtube"  value="<?php echo html_escape($contact_Details['0']['youtube']);?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_you_tube'));?>" data-valid="url" data-error="Please use http or https in URL." data-symb="no">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_twitter'));?></label>
							    <input  type="text" class="form-control" name="twitter" value="<?php echo html_escape($contact_Details['0']['twitter']);?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_twitter'));?>" data-valid="url" data-error="Please use http or https in URL." data-symb="no">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_instagram'));?></label>
							    <input type="text" class="form-control" name="instagram" value="<?php echo html_escape($contact_Details['0']['instagram']);?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_instagram'));?>" data-valid="url" data-error="Please use http or https in URL." data-symb="no">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_linked_in'));?></label>
							    <input type="text" class="form-control" name="linkedin" value="<?php echo html_escape($contact_Details['0']['linkedin']);?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_linked_in'));?>" data-valid="url" data-error="Please use http or https in URL." data-symb="no">
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_google_API'));?></label>
							    <input  type="text" class="form-control" name="map_api" value="<?php echo html_escape($contact_Details['0']['map_api']);?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_google_API'));?>">
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_address'));?><sup>*</sup></label>
								<?php
									$breaks = array("<br />","<br>","<br/>"); 	
								?>
							    <textarea rows="3" class="form-control require" name="address" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_address'));?>"><?php echo !empty($contact_Details)?str_replace($breaks, "\n", $contact_Details['0']['address']):'';?></textarea>
							</div>
						</div>
						<div class="edu_btn_wrapper">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
								<button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/contact_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>		
	</div>
</section>