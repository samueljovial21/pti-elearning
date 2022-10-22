

<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_siteSetting_wrapper">
	    
			<div class="pxn_admin_informationdiv edu_main_wrapper">
				<form class="pxn_amin form" enctype="multipart/form-data" method="post">
					<div class="edu_site_setting_wrap edu_from_wrapper">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_firebase_key'));?><sup>*</sup></label>
									<input type="text" class="form-control require" name="firebase_key" value="<?php if(!empty($firebase_key)){ echo $firebase_key ;} ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_key_fire'));?>">
									<!-- <textarea class="form-control require" name="firebase_key" rows="4" cols="50" value="<?php if(!empty($firebase_key)){ echo $firebase_key ;} ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_key_fire'));?>"> -->

								</div>
							</div>
							
							<div class="edu_btn_wrapper">
								<div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
									<button type="button" class="btn btn-primary updateFirebaseDetails"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
									
									<!--<button type="button" class="btn btn-primary updateTestEmailDetails"><?php echo html_escape($this->common->languageTranslator('ltr_test_email'));?></button>-->
									
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>		
	</div>
</section>