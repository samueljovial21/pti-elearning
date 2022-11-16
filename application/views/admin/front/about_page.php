<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_about_setting_wrapper">
		<form class="pxn_amin" method="post">
		    <div class="edu_admin_informationdiv">
    			<div class="edu_main_wrapper  edu_from_wrapper mb_30">
    			    <div class="edu_section_wrap">
    					<div class="row">
    					    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    						    <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_first_section'));?></h4>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
    								<label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
    							    <input type="text" class="form-control require" name="abt_frst_heading" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_frst_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
    							</div>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
    								<label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
    							    <input type="text" class="form-control" name="abt_frst_sub_heading" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_frst_sub_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
    							</div>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
    								<label><?php echo html_escape($this->common->languageTranslator('ltr_started_year'));?><sup>*</sup></label>
    							    <input type="number" class="form-control require" name="abt_year" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_year']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_since_year'));?>">
    							</div>
    						</div>
    						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    						    <div class="form-group">
    								<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
									<?php
									$breaks = array("<br />","<br>","<br/>"); 	
									?>
    							    <textarea rows="3" class="form-control require" name="abt_frst_desc" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"><?php echo !empty($about_Details)?str_replace($breaks, "\n", $about_Details['0']['abt_frst_desc']):'';?></textarea>
    							</div>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    							<div class="form-group">
        							<label><?php echo html_escape($this->common->languageTranslator('ltr_first_image'));?><?php echo (!empty($about_Details) && !empty($about_Details['0']['abt_frst_img']))?'':'<sup>*</sup>';?></label>
        							<div class="edu_d_flex">
            							<?php
            							if(!empty($about_Details) && !empty($about_Details['0']['abt_frst_img'])){
            							?>
            							<div class="edu_prev_img">
            							    <div>
            								    <img src="<?php echo base_url('uploads/site_data/'.$about_Details['0']['abt_frst_img'])?>">
            								</div>
            							</div>
            							<?php } ?>
        							    <input type="file" data-valid="image" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?>" class="form-control <?php echo (!empty($about_Details) && !empty($about_Details['0']['abt_frst_img']))?'':'require';?>" name="abt_frst_img" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_frst_img']:'';?>" >
    									<p class="fileNameShow"></p>
        							</div>
        						</div>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    							<div class="form-group">
        							<label><?php echo html_escape($this->common->languageTranslator('ltr_second_image'));?><?php echo (!empty($about_Details) && !empty($about_Details['0']['abt_sec_img']))?'':'<sup>*</sup>';?></label>
        							<div class="edu_d_flex">
            							<?php
            							if(!empty($about_Details) && !empty($about_Details['0']['abt_sec_img'])){
            							?>
            							<div class="edu_prev_img">
            							    <div>
            								    <img src="<?php echo base_url('uploads/site_data/'.$about_Details['0']['abt_sec_img'])?>">
            								</div>
            							</div>
            							<?php } ?>
        							    <input type="file" data-valid="image" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?>" class="form-control <?php echo (!empty($about_Details) && !empty($about_Details['0']['abt_sec_img']))?'':'require';?>" name="abt_sec_img" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_sec_img']:'';?>" >
    									<p class="fileNameShow"></p>
        							</div>
        						</div>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="edu_main_wrapper edu_about_wrapper edu_from_wrapper mb_30">
                    <div class="edu_section_wrap">
    					<div class="row">
    					    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    						    <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_second_section'));?></h4>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
    							    <input type="text" class="form-control require" name="abt_sec_heading" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_sec_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
    							</div>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
    							    <textarea rows="3" class="form-control require" name="abt_sec_desc" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"><?php echo !empty($about_Details)?str_replace($breaks, "\n", $about_Details['0']['abt_sec_desc']):'';?></textarea>
    							</div>
    						</div>
    					    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_button_text'));?><sup>*</sup></label>
    							    <input type="text" class="form-control require" name="abt_secbtn_text" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_secbtn_text']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_button_text'));?>">
    							</div>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_button_url'));?><sup>*</sup></label>
    							    <input type="text" class="form-control require" data-valid="url" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_url_msg'));?>" name="abt_secbtn_url" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_secbtn_url']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_button_url'));?>" data-symb="no">
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="edu_main_wrapper edu_about_wrapper edu_from_wrapper">
    				<div class="edu_section_wrap">
    					<div class="row">
    					    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    						    <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_third_section'));?></h4>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
    							    <input type="text" class="form-control require" name="abt_thrd_heading" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_thrd_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
    							</div>
    						</div>
    					    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
    							    <input type="text" class="form-control" name="abt_thrd_sub_heading" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_thrd_sub_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
    							</div>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
    						    <div class="form-group">
                                    <label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
    							    <textarea rows="3" class="form-control require" name="abt_thrd_desc" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"><?php echo !empty($about_Details)?str_replace($breaks, "\n", $about_Details['0']['abt_thrd_desc']):'';?></textarea>
    							</div>
    						</div>
    					    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    							<div class="form-group">
        							<label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?> <?php echo (!empty($about_Details) && !empty($about_Details['0']['abt_thrd_img']))?'':'<sup>*</sup>';?></label>
        							<div class="edu_d_flex">
            							<?php
            							if(!empty($about_Details) && !empty($about_Details['0']['abt_thrd_img'])){
            							?>
            							<div class="edu_prev_img">
            							    <div>
            								    <img src="<?php echo base_url('uploads/site_data/'.$about_Details['0']['abt_thrd_img'])?>">
            								</div>
            							</div>
            							<?php } ?>
        							    <input type="file" data-valid="image" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?>" class="form-control <?php echo (!empty($about_Details) && !empty($about_Details['0']['abt_thrd_img']))?'':'require';?>" name="abt_thrd_img" value="<?php echo !empty($about_Details)?$about_Details['0']['abt_thrd_img']:'';?>" >
    									<p class="fileNameShow"></p>
        							</div>
        						</div>
    						</div>
    						<div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
    							<div class="edu_btn_wrap"> 
    								<button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/about_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
			</div>
		</form>
					
	</div>
</section>