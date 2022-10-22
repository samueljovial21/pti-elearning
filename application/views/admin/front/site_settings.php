<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_siteSetting_wrapper">
			<div class="pxn_admin_informationdiv edu_main_wrapper">
				<form class="pxn_amin form" enctype="multipart/form-data" method="post">
					<div class="edu_site_setting_wrap edu_from_wrapper">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							    <div class="form-group">
    							    <label><?php echo html_escape($this->common->languageTranslator('ltr_favicon'));?><?php echo (!empty($site_Details) && !empty($site_Details['0']['site_favicon']))?'':'<sup>*</sup>';?></label>
    							    <div class="edu_d_flex">
        							    <?php
        								if(!empty($site_Details) && !empty($site_Details['0']['site_favicon'])){
        								?>
        								<div class="edu_prev_img">
        									<div>
        									    <img src="<?php echo base_url('uploads/site_data/'.$site_Details['0']['site_favicon'])?>">
        									</div>
        								</div>
        								<?php } ?>
    								    <input type="file" name="site_favicon" value="<?php echo !empty($site_Details)?$site_Details['0']['site_favicon']:'';?>" data-valid="image" data-error="Please select a jpg/png favicon image." class="form-control <?php echo (!empty($site_Details) && !empty($site_Details['0']['site_favicon']))?'':'require';?>">
    									<p class="fileNameShow"></p>
        							</div>
        							<p class="pxn-ins"><?php echo html_escape($this->common->languageTranslator('ltr_favicon_size'));?></p>	
							    </div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							    <div class="form-group">  
							        <label><?php echo html_escape($this->common->languageTranslator('ltr_site_logo'));?><?php echo (!empty($site_Details) && !empty($site_Details['0']['site_logo']))?'':'<sup>*</sup>';?></label>
							        <div class="edu_d_flex">
        							    <?php
        								if(!empty($site_Details) && !empty($site_Details['0']['site_logo'])){
        								?>
        								<div class="edu_prev_img logoImgPrev">
        									<div>
        									    <img src="<?php echo base_url('uploads/site_data/'.$site_Details['0']['site_logo']) ;?>">
        									</div>
        								</div>
        								<?php } ?>
    								    <input type="file" name="site_logo" value="<?php echo !empty($site_Details)?$site_Details['0']['site_logo']:'';?>" data-valid="image" data-error="Please select a jpg/png logo image." class="form-control <?php echo (!empty($site_Details) && !empty($site_Details['0']['site_logo']))?'':'require';?>">
    									<p class="fileNameShow"></p>
    								</div>
    								<p class="pxn-ins"><?php echo html_escape($this->common->languageTranslator('ltr_site_logo_size'));?></p>
    							</div>
							</div>

							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							    <div class="form-group">  
							        <label><?php echo html_escape($this->common->languageTranslator('ltr_mini_site_logo'));?><?php echo (!empty($site_Details) && !empty($site_Details['0']['site_logo']))?'':'<sup>*</sup>';?></label>
							        <div class="edu_d_flex">
        							    <?php
        								if(!empty($site_Details) && !empty($site_Details['0']['site_minilogo'])){
        								?>
        								<div class="edu_prev_img logoImgPrev">
        									<div>
        									    <img src="<?php echo base_url('uploads/site_data/'.$site_Details['0']['site_minilogo']) ;?>">
        									</div>
        								</div>
        								<?php } ?>
    								    <input type="file" name="site_minilogo" value="<?php echo !empty($site_Details)?$site_Details['0']['site_minilogo']:'';?>" data-valid="image" data-error="Please select a jpg/png logo image." class="form-control <?php echo (!empty($site_Details) && !empty($site_Details['0']['site_logo']))?'':'require';?>">
    									<p class="fileNameShow"></p>
    								</div>
    								<p class="pxn-ins"><?php echo html_escape($this->common->languageTranslator('ltr_minisite_logo_size'));?></p>
    							</div>
							</div>



							<div class="col-lg-4 col-md-4 col-sm-12 col-12">
    							<div class="form-group">    
    							    <label><?php echo html_escape($this->common->languageTranslator('ltr_site_preloader'));?> <?php echo (!empty($site_Details) && !empty($site_Details['0']['site_loader']))?'':'<sup>*</sup>';?></label>
    							    <div class="edu_d_flex">
        							    <?php
        								if(!empty($site_Details) && !empty($site_Details['0']['site_loader'])){
        								?>
        								<div class="edu_prev_img">
        								    <div>
        									    <img src="<?php echo base_url('uploads/site_data/'.$site_Details['0']['site_loader'])?>">
        									</div>
        								</div>
        								<?php } ?>
    								    <input type="file" name="site_loader" value="<?php echo !empty($site_Details)?$site_Details['0']['site_loader']:'';?>" data-valid="image" data-error="Please select a gif preloader image." class="form-control <?php echo (!empty($site_Details) && !empty($site_Details['0']['site_loader']))?'':'require';?>">
    									<p class="fileNameShow"></p>
    								</div>
    								<p class="pxn-ins"><?php echo html_escape($this->common->languageTranslator('ltr_site_preloader_size'));?></p>	
    							</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_site_title'));?><sup>*</sup></label>
									<input type="text" class="form-control require" name="site_title" value="<?php echo !empty($site_Details)?$site_Details['0']['site_title']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_site_title'));?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_site_author_name'));?><sup>*</sup></label>
									<input type="text" name="site_author" value="<?php echo !empty($site_Details)?$site_Details['0']['site_author']:'';?>" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_author_name'));?>">
								</div>
							</div> 
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_site_keywords'));?><sup>*</sup></label>
									<textarea rows="3" class="form-control require" name="site_keywords"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_site_keywords'));?>"><?php echo !empty($site_Details)?$site_Details['0']['site_keywords']:'';?></textarea> 
									<p class="pxn-ins"><?php echo html_escape($this->common->languageTranslator('ltr_site_keywords_note'));?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_site_description'));?><sup>*</sup></label>
									<textarea rows="3" class="form-control require" name="site_description"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_site_description'));?>"><?php echo !empty($site_Details)?$site_Details['0']['site_description']:'';?></textarea>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_enrollment_word'));?><sup>*</sup></label>
									<input type="text" name="enrollment_word" value="<?php echo !empty($site_Details)?$site_Details['0']['enrollment_word']:'';?>" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_enrollment_word'));?>">
									<p class="pxn-ins"><?php echo html_escape($this->common->languageTranslator('ltr_enrollment_word_note'));?></p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_copyright_text'));?><sup>*</sup></label>
									<input type="text" name="copyright_text" value="<?php echo !empty($site_Details)?$site_Details['0']['copyright_text']:'';?>" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_copyright_text'));?>">
								</div>
							</div>
							<div class="edu_btn_wrapper">
								<div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
									<button type="button" class="btn btn-primary updateSiteDetails"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
									<a href="<?php echo base_url();?>" class="edu_admin_btn " target="_blank"><?php echo html_escape($this->common->languageTranslator('ltr_visit_site'));?></a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>		
	</div>
</section>