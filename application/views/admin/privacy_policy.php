<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_siteSetting_wrapper">
			<div class="pxn_admin_informationdiv edu_main_wrapper">
				<form class="pxn_amin form" enctype="multipart/form-data" method="post">
					<div class="edu_site_setting_wrap edu_from_wrapper">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
									<textarea rows="3" class="form-control summernote require" name="description"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"><?php echo !empty($privacypolicy)?$privacypolicy['0']['description']:'';?></textarea>
								</div>
							</div>
							<div class="edu_btn_wrapper">
								<div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
									<button type="button" class="btn btn-primary updatePrivacyPolicy"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>		
	</div>
</section>