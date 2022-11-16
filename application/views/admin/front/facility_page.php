<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_facility_seting_wrapper">
		<div class="pxn_admin_informationdiv edu_main_wrapper">
			<form class="pxn_amin" method="post">
				<div class="edu_facality_wrapper edu_from_wrapper">
					<div class="row">
					    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
							    <input type="text" class="form-control require" name="faci_heading" value="<?php echo !empty($facility_Details)?$facility_Details['0']['faci_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
						    <div class="form-group">
								<label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
							    <input type="text" class="form-control" name="faci_sub_heading" value="<?php echo !empty($facility_Details)?$facility_Details['0']['faci_sub_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
							</div>
						</div>
						
						<div class="edu_btn_wrapper">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
								<span> 
									<button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/facility_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>		
	</div>
</section>