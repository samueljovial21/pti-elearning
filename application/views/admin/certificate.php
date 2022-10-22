<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_siteSetting_wrapper">
	    
	    	
			<div class="pxn_admin_informationdiv edu_main_wrapper">
				<form class="pxn_amin form" enctype="multipart/form-data" method="post">
					<div class="edu_site_setting_wrap edu_from_wrapper">
						<div class="row">
					
						<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">  
							        <label><?php echo html_escape($this->common->languageTranslator('ltr_certificate_logo'));?><?php echo (!empty($certi_setting) && !empty($certi_setting['0']['certificate_logo']))?'':'<sup>*</sup>';?></label>
							        <div class="edu_d_flex">
        							    <?php
        								if(!empty($certi_setting) && !empty($certi_setting['0']['certificate_logo'])){
        								?>
        								<div class="edu_prev_img logoImgPrev">
        									<div>
        									    <img src="<?php echo base_url('uploads/site_data/'.$certi_setting['0']['certificate_logo'])?>">
        									</div>
        								</div>
        								<?php } ?>
    								    <input type="file" name="certificate_logo" value="<?php echo !empty($certi_setting)?$certi_setting['0']['certificate_logo']:'';?>" data-valid="image" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?><?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?>" class="form-control <?php echo (!empty($certi_setting) && !empty($certi_setting['0']['certificate_logo']))?'':'require';?>">
    									<p class="fileNameShow"></p>
    								</div>
    								<p class="pxn-ins"><?php echo html_escape($this->common->languageTranslator('ltr_dimension_180'));?></p>
    							</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?> <sup>*</sup></label>
									<input type="text" class="form-control require" name="heading" value="<?php echo !empty($certi_setting)?$certi_setting['0']['heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?> <sup>*</sup></label>
									<input type="text" name="sub_heading" value="<?php echo !empty($certi_setting)?$certi_setting['0']['sub_heading']:'';?>" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
								</div>
							</div> 
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
							        <label><?php echo html_escape($this->common->languageTranslator('ltr_title'));?> <sup>*</sup></label>
							        <input type="text" name="title" value="<?php echo !empty($certi_setting)?$certi_setting['0']['title']:'';?>" class="form-control require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?> <sup>*</sup></label>
									<textarea rows="3" class="form-control require" name="description"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"><?php echo !empty($certi_setting)?$certi_setting['0']['description']:'';?></textarea>
									<p class="pxn-ins"><?php echo html_escape($this->common->languageTranslator('ltr_note'));?> : <?php echo html_escape($this->common->languageTranslator('ltr_wherever_batch'));?> </p>
								</div>
							</div>
							<div class="col-lg-4 col-md- col-sm-12 col-12">
							    <div class="form-group">
    							    <label><?php echo html_escape($this->common->languageTranslator('ltr_signature'));?><?php echo (!empty($certi_setting) && !empty($certi_setting['0']['signature_image']))?'':'<sup>*</sup>';?></label>
    							    <div class="edu_d_flex">
        							    <?php
        								if(!empty($certi_setting) && !empty($certi_setting['0']['signature_image'])){
        								?>
        								<div class="edu_prev_img">
        									<div>
        									    <img src="<?php echo base_url('uploads/site_data/'.$certi_setting['0']['signature_image'])?>">
        									</div>
        								</div>
        								<?php } ?>
    								    <input type="file" name="signature_image" value="<?php echo !empty($certi_setting)?$certi_setting['0']['signature_image']:'';?>" data-valid="image" data-error="<?php echo html_escape($this->common->languageTranslator('ltr_valid_image_msg'));?>" class="form-control <?php echo (!empty($certi_setting) && !empty($certi_setting['0']['signature_image']))?'':'require';?>">
    									<p class="fileNameShow"></p>
        							</div>
        								
							    </div>
							</div>
							
							<div class="edu_btn_wrapper">
								<div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
									<button type="button" class="btn btn-primary updateCertificateSetting"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
									<a href="<?php echo base_url();?>admin/view-certificate-sample" class="btn btn-primary" target="_blank"><?php echo html_escape($this->common->languageTranslator('ltr_view_certificate'));?> </a>
									   <!--<input type="button" value="Open In New Tab" id="open_new_tab" />-->

								</div>
							</div>
						</div>
					</div>
				</form>
			</div>		
	</div>
</section>