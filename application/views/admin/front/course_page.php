<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_course_setting_wrapper">
		<form class="pxn_amin" method="post">
		    <div class="edu_admin_informationdiv">
       <!-- 		<div class="edu_main_wrapper edu_courses_wrapper edu_from_wrapper mb_30">-->
       <!-- 			<div class="edu_section_wrap">-->
       <!-- 				<div class="row">-->
       <!-- 				    <div class="col-lg-12 col-md-12 col-sm-12 col-12">-->
       <!-- 					    <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_first_section'));?></h4>-->
       <!-- 					</div>-->
       <!-- 					<div class="col-lg-6 col-md-6 col-sm-12 col-12">-->
       <!-- 					    <div class="form-group">-->
       <!-- 							<label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>-->
       <!-- 						    <input type="text" class="form-control require" name="frst_crse_heading" value="<?php echo !empty($course_Details)?$course_Details['0']['frst_crse_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">-->
       <!-- 						</div>-->
       <!-- 					</div>-->
       <!-- 					<div class="col-lg-6 col-md-6 col-sm-12 col-12">-->
       <!-- 					    <div class="form-group">-->
       <!-- 							<label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>-->
       <!-- 						    <input type="text" class="form-control" name="frst_crse_sub_heading" value="<?php echo !empty($course_Details)?$course_Details['0']['frst_crse_sub_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">-->
       <!-- 						</div>-->
       <!-- 					</div>-->
       <!-- 					<div class="col-lg-12 col-md-12 col-sm-12 col-12">-->
       <!-- 						<div class="form-group">-->
       <!-- 							<label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>-->
									<!--<?php $breaks = array("<br />","<br>","<br/>"); ?>-->
       <!-- 							<textarea name="frst_crse_desc" class="form-control require" rows="3"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>"><?php echo !empty($course_Details)?str_replace($breaks, "\n", $course_Details['0']['frst_crse_desc']):'';?></textarea>-->
       <!-- 						</div> -->
       <!-- 					</div>-->
       <!-- 				</div>-->
       <!-- 			</div>-->
    			<!--</div>-->
    			<div class="edu_main_wrapper edu_courses_wrapper edu_from_wrapper mb_30">
        			<div class="edu_section_wrap">
        				<div class="row">
        					<!--<div class="col-lg-12 col-md-12 col-sm-12 col-12">-->
        					<!--    <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_second_section'));?></h4>-->
        					<!--</div>-->
        					<div class="col-lg-6 col-md-6 col-sm-12 col-12">
        					    <div class="form-group">
        							<label><?php echo html_escape($this->common->languageTranslator('ltr_heading'));?><sup>*</sup></label>
        						    <input type="text" class="form-control require" name="sec_crse_heading" value="<?php echo !empty($course_Details)?$course_Details['0']['sec_crse_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_heading'));?>">
        						</div>
        					</div>
        					<div class="col-lg-6 col-md-6 col-sm-12 col-12">
        					    <div class="form-group">
        							<label><?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?></label>
        						    <input type="text" class="form-control" name="sec_crse_sub_heading" value="<?php echo !empty($course_Details)?$course_Details['0']['sec_crse_sub_heading']:'';?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sub_heading'));?>">
        						</div>
        					</div>
                        
        					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        					    <div class="edu_btn_wrapper">
        							<button type="button" class="btn btn-primary updateDetails" data-url="front_ajax/course_settings"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
        						</div>
        					</div>
        				</div>
        			</div>
    			</div>
    		</div>
		</form>
	</div>
</section>